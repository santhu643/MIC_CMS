<?php
require 'config.php';
require_once 'EncryptionUtils.php';
header('Content-Type: application/json');

$action = $_GET['action'] ?? ($_POST['action'] ?? '');

if (empty($action)) {
    $jsonInput = file_get_contents('php://input');
    if (!empty($jsonInput)) {
        $jsonData = json_decode($jsonInput, true);
        $action = $jsonData['action'] ?? '';
    }
}

$response = ['success' => false, 'message' => ''];
// echo json_encode($action);
switch ($action) {

    case 'get_available_buses':
        $query = "SELECT DISTINCT b.*
            FROM buses b
            LEFT JOIN seat_layouts sl ON b.id = sl.bus_id
            LEFT JOIN student_bookings sb ON sl.id = sb.seat_id
            WHERE sb.id IS NULL
            OR EXISTS (
                SELECT 1
                FROM seat_layouts sl2
                WHERE sl2.bus_id = b.id
                AND NOT EXISTS (
                    SELECT 1
                    FROM student_bookings sb2
                    WHERE sb2.seat_id = sl2.id
                )
            )
            ORDER BY b.bus_number
        ";

        $result = mysqli_query($conn, $query);
        $buses = [];

        while ($row = mysqli_fetch_assoc($result)) {
            $buses[] = $row;
        }

        echo json_encode($buses);
        mysqli_close($conn);

        break;

    case 'get_stopping_points':
        if (!isset($_GET['bus_id'])) {
            die(json_encode(['error' => 'Bus ID is required']));
        }

        $query = "
            SELECT id, name, price, sequence 
            FROM stopping_points 
            WHERE bus_id = ? 
            ORDER BY sequence
        ";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $_GET['bus_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $stoppingPoints = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $stoppingPoints[] = $row;
        }

        echo json_encode($stoppingPoints);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);


        break;

    case 'check_seat_availability':
        try {
            // Start transaction
            $conn->begin_transaction();
            $formData = $_POST['formData'];
            // Get form data
            $regno = $conn->real_escape_string($formData['regno']);
            $name = $conn->real_escape_string($formData['name']);
            $gender = $conn->real_escape_string($formData['gender']);

            $branch = $conn->real_escape_string($formData['branch']);
            $graduation = $conn->real_escape_string($formData['graduation']);
            $year = $conn->real_escape_string($formData['year']);
            $semester = $conn->real_escape_string($formData['semester']);

            $bus_id = (int) $formData['bus_id'];
            $bus_number = (int) $formData['bus_number'];
            $stopping_point_id = (int) $formData['stopping_point_id'];
            $stop_name = $conn->real_escape_string($formData['stop_name']);
            $amount = (float) $formData['amount'];

            if ($gender !== 'Male' && $gender !== 'Female') {
                $response = ['status' => 404, 'message' => 'Kindly complete your basic profile details before booking a bus.'];
                echo json_encode($response);
                exit;
            }

            // Check if seat is available
            $sql = "WITH adjacent_occupied_seats AS (
                        SELECT DISTINCT sl1.id, sb2.gender as adjacent_gender
                        FROM seat_layouts sl1
                        JOIN seat_layouts sl2 ON 
                            sl1.bus_id = sl2.bus_id 
                            AND sl1.row_number = sl2.row_number
                            AND (
                                (sl1.position = 'left' AND sl2.position = 'left')
                                OR 
                                (sl1.position = 'right' AND sl2.position = 'right')
                                OR 
                                (sl1.seat_type = 'last_row' AND sl2.seat_type = 'last_row')
                            )
                        JOIN student_bookings sb2 ON sl2.id = sb2.seat_id 
                        WHERE sl1.bus_id = $bus_id
                        AND sl1.id != sl2.id
                    )
                    SELECT sl.id, sl.seat_number
                    FROM seat_layouts sl
                    LEFT JOIN student_bookings sb ON sl.id = sb.seat_id AND sb.bus_id = $bus_id
                    LEFT JOIN adjacent_occupied_seats adj ON sl.id = adj.id
                    WHERE sl.bus_id = $bus_id
                    AND sb.seat_id IS NULL
                    AND (
                        -- Handle regular seats
                        (sl.seat_type = 'regular' AND (
                            adj.id IS NULL 
                            OR adj.adjacent_gender = '$gender'
                        ))
                        OR
                        -- Handle last row seats
                        (sl.seat_type = 'last_row' AND (
                            adj.id IS NULL 
                            OR adj.adjacent_gender = '$gender'
                        ))
                    )
                    ORDER BY 
                        CASE 
                            WHEN '$gender' = 'Female' THEN sl.seat_number -- Ascending for females (1 to 60)
                            ELSE -sl.seat_number -- Descending for males (60 to 1)
                        END
                    LIMIT 1";

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $seat_id = $row['id'];
                $s_num = $row['seat_number'];

                // Create Razorpay Order
                require('vendor/razorpay/razorpay/Razorpay.php');
                $api = new Razorpay\Api\Api($razorpay_key_id, $razorpay_key_secret);

                $orderData = [
                    'receipt' => 'rcptid_' . time(),
                    'amount' => $amount * 100, // Convert to paise
                    'currency' => 'INR'
                ];

                $razorpayOrder = $api->order->create($orderData);
                // Get order ID as a string from the response
                $orderId = strval($razorpayOrder['id']);

                // Insert booking with pending status
                $insertSql = "INSERT INTO student_bookings (
                    regno, 
                    name, 
                    gender,
                    branch,
                    year,
                    semester,
                    graduation,
                    bus_id,
                    bus_num, 
                    seat_id,
                    seat_num, 
                    stopping_point_id,
                    stop_name, 
                    order_id,
                    amount, 
                    booking_status,
                    created_at
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', CURRENT_TIMESTAMP
                )";

                $stmt = $conn->prepare($insertSql);
                $stmt->bind_param(
                    "sssssssiiiiissd",
                    $regno,
                    $name,
                    $gender,
                    $branch,
                    $year,
                    $semester,
                    $graduation,
                    $bus_id,
                    $bus_number,
                    $seat_id,
                    $s_num,
                    $stopping_point_id,
                    $stop_name,
                    $orderId,  // Use the string order ID
                    $amount
                );

                if ($stmt->execute()) {
                    $booking_id = $conn->insert_id;
                    $conn->commit();

                    echo json_encode([
                        'available' => true,
                        'order_id' => $orderId,  // Use the string order ID
                        'booking_id' => EncryptionUtils::encrypt($booking_id),
                        'seat_number' => $row['seat_number']
                    ]);
                } else {
                    throw new Exception("Error inserting booking");
                }
            } else {
                $conn->commit();
                echo json_encode(['available' => false,'message'=>"No Seats Available. Conatct Office"]);
            }

        } catch (Exception $e) {
            $conn->rollback();
            error_log($e->getMessage());  // Log the error for debugging
            echo json_encode([
                'status' => 1001,
                'message' => $e->getMessage()
            ]);
        }

        $conn->close();

        break;

    case 'get_bus_layout':

        if (!isset($_GET['bus_id'])) {
            die(json_encode(['error' => 'Bus ID is required']));
        }

        $query = "
            SELECT 
                sl.id,
                sl.row_number,
                sl.seat_number,
                sl.seat_type,
                sl.position,
                CASE WHEN sb.id IS NOT NULL THEN 1 ELSE 0 END as is_occupied,
                sb.gender as occupant_gender
            FROM seat_layouts sl
            LEFT JOIN student_bookings sb ON sl.id = sb.seat_id
            WHERE sl.bus_id = ?
            ORDER BY sl.row_number, sl.seat_number
        ";

        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "i", $_GET['bus_id']);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        $seatLayout = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $seatLayout[] = $row;
        }

        echo json_encode($seatLayout);
        mysqli_stmt_close($stmt);
        mysqli_close($conn);

        break;

    case 'get_booking_details':

        if (!isset($_GET['seat_id'])) {
            echo json_encode(['error' => 'Seat ID is required']);
            exit;
        }

        $seat_id = mysqli_real_escape_string($conn, $_GET['seat_id']);

        // SQL query to get booking details
        $query = "SELECT 
            sb.id,
            sb.regno,
            sb.name,
            sb.gender,
            sb.branch,
            sb.year,
            sb.semester,
            sb.bus_id,
            sb.bus_num,
            sb.seat_id,
            sb.seat_num,
            sb.stopping_point_id,
            sb.stop_name,
            sb.payment_id,
            sb.order_id,
            sb.payment_mode,
            sb.amount,
            sb.fee_status,
            sb.booking_status,
            DATE_FORMAT(sb.created_at, '%d-%m-%Y %h:%i %p') as booking_date
        FROM student_bookings sb 
        WHERE sb.seat_id = '$seat_id'
        LIMIT 1";

        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo json_encode(['error' => 'Database error: ' . mysqli_error($conn)]);
            exit;
        }

        if (mysqli_num_rows($result) > 0) {
            $booking = mysqli_fetch_assoc($result);

            // Format year
            switch ($booking['year']) {
                case '1':
                    $yearText = '1st Year';
                    break;
                case '2':
                    $yearText = '2nd Year';
                    break;
                case '3':
                    $yearText = '3rd Year';
                    break;
                case '4':
                    $yearText = '4th Year';
                    break;
                default:
                    $yearText = $booking['year'];
            }

            // Format response
            $response = [
                'seat_num' => $booking['seat_num'],
                'regno' => $booking['regno'],
                'name' => $booking['name'],
                'gender' => $booking['gender'],
                'branch' => $booking['branch'],
                'year' => $yearText,
                'semester' => $booking['semester'] . ' Semester',
                'stop_name' => $booking['stop_name'],
                'amount' => number_format($booking['amount'], 2),
                'payment_mode' => $booking['payment_mode'],
                'fee_status' => $booking['fee_status'],
                'booking_status' => $booking['booking_status'],
                'booking_date' => $booking['booking_date']
            ];

            echo json_encode($response);
        } else {
            echo json_encode(['error' => 'No booking found for this seat']);
        }

        // Close database connection
        mysqli_close($conn);

        break;


    case 'manual_book_seat':
        try {
            // Start transaction
            $conn->begin_transaction();

            // Get form data
            $regno = $conn->real_escape_string($_POST['regno']);
            $name = $conn->real_escape_string($_POST['name']);
            $gender = $conn->real_escape_string($_POST['gender']);
            $branch = $conn->real_escape_string($_POST['branch']);
            $graduation = $conn->real_escape_string($_POST['graduation']);
            $year = $conn->real_escape_string($_POST['year']);
            $semester = $conn->real_escape_string($_POST['semester']);
            $bus_id = (int) $_POST['bus_id'];
            $bus_number = (int) $_POST['bus_number'];
            $route = $conn->real_escape_string($_POST['route']);
            $seat_id = (int) $_POST['seat_id'];
            $seat_num = (int) $_POST['seat_num'];
            $stopping_point_id = (int) $_POST['stopping_point_id'];
            $stop_name = $conn->real_escape_string($_POST['stop_name']);
            $amount = (float) $_POST['final_amount'];
            $remarks = $conn->real_escape_string($_POST['remarks']);
            if ($amount <= 0) {
                // For manual payment mode, only insert necessary fields
                $insertSql = "INSERT INTO student_bookings (
                    regno,
                    name,
                    gender,
                    branch,
                    graduation,
                    year,
                    semester,
                    bus_id,
                    bus_num,
                    route,
                    seat_id,
                    seat_num,
                    stopping_point_id,
                    stop_name,
                    amount,
                    remarks,
                    payment_mode,
                    booking_status,
                    fee_status,
                    payment_id,
                    order_id,
                    created_at
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, 'Manual', 'confirmed', 'Completed','NA','NA', CURRENT_TIMESTAMP
                )";

                // Prepare and bind parameters
                $stmt = $conn->prepare($insertSql);
                $stmt->bind_param(
                    "sssssssiisiiisds",  // 13 parameters: 7s + 5i + 1d
                    $regno,            // s
                    $name,             // s
                    $gender,           // s
                    $branch,           // s
                    $graduation,
                    $year,            // s
                    $semester,         // s
                    $bus_id,          // i
                    $bus_number,       // i
                    $route,             //s
                    $seat_id,         // i
                    $seat_num,        // i
                    $stopping_point_id,// i
                    $stop_name,       // s
                    $amount,
                    $remarks          // d
                );

                // Execute the statement
                if ($stmt->execute()) {
                    $booking_id = $conn->insert_id;
                    $conn->commit();

                    echo json_encode([
                        'success' => true,
                        'booking_id' => EncryptionUtils::encrypt($booking_id),
                        'message' => 'Manual booking created successfully'
                    ]);
                } else {
                    throw new Exception("Error inserting booking: " . $stmt->error);
                }
            } else {
                // Handle online payment case (your existing code for amount > 0)
                // ... add your online payment logic here ...

                // Create Razorpay Order
                require('razorpay-php/Razorpay.php');
                $api = new Razorpay\Api\Api($razorpay_key_id, $razorpay_key_secret);

                $orderData = [
                    'receipt' => 'rcptid_' . time(),
                    'amount' => $amount * 100, // Convert to paise
                    'currency' => 'INR'
                ];

                $razorpayOrder = $api->order->create($orderData);
                // Get order ID as a string from the response
                $orderId = strval($razorpayOrder['id']);

                $insertSql = "INSERT INTO student_bookings (
                    regno,
                    name,
                    gender,
                    branch,
                    graduation,
                    year,
                    semester,
                    bus_id,
                    bus_num,
                    route,
                    seat_id,
                    seat_num,
                    stopping_point_id,
                    stop_name,
                    amount,
                    remarks,
                    payment_mode,
                    booking_status,
                    fee_status,
                    payment_id,
                    order_id,
                    created_at
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, 'NA', 'pending', 'NA','NA',?, CURRENT_TIMESTAMP
                )";

                // Prepare and bind parameters
                $stmt = $conn->prepare($insertSql);
                $stmt->bind_param(
                    "sssssssiisiiisdss",  // 13 parameters: 7s + 5i + 1d
                    $regno,            // s
                    $name,             // s
                    $gender,           // s
                    $branch,           // s
                    $graduation,
                    $year,            // s
                    $semester,         // s
                    $bus_id,          // i
                    $bus_number,       // i
                    $route,             //s
                    $seat_id,         // i
                    $seat_num,        // i
                    $stopping_point_id,// i
                    $stop_name,       // s
                    $amount,
                    $remarks,          // d
                    $orderId
                );

                // Execute the statement
                if ($stmt->execute()) {

                    $booking_id = $conn->insert_id;
                    $conn->commit();

                    echo json_encode([
                        'order_id' => $orderId,  // Use the string order ID
                        'booking_id' => EncryptionUtils::encrypt($booking_id),
                        'message' => 'Manual booking created successfullyyyyyy'
                    ]);
                } else {
                    throw new Exception("Error inserting booking: " . $stmt->error);
                }


                $conn->commit();
            }

        } catch (Exception $e) {
            $conn->rollback();
            error_log($e->getMessage());  // Log the error for debugging
            echo json_encode([
                'error' => true,
                'message' => $e->getMessage()
            ]);
        }

        $conn->close();

        break;

    default:
        echo json_encode(['error' => 'Invalid action']);
}
