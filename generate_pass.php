<?php
require_once('config.php');
require_once 'EncryptionUtils.php';

try {
    // Get the booking_id from the URL
    if (isset($_GET['booking_id'])) {
        $encrypted_id = $_GET['booking_id'];
        // $encrypted_id = $booking_id;
        echo json_encode($encrypted_id);
        $booking_id = EncryptionUtils::decrypt($encrypted_id);
        echo json_encode($booking_id);
        // SQL Query to fetch data for the given booking_id
        $sql = "SELECT 
                sb.regno,
                sb.name,
                sb.seat_id,
                sb.payment_id,
                sb.amount,
                b.bus_number,
                sl.seat_number,
                sp.name as stop_name,
                sb.branch,
                sb.semester,
                sb.remarks,
                DATE_FORMAT(sb.created_at, '%Y-%m-%d %h:%i:%s %p') as booking_date,
                sp.name as route_name
            FROM student_bookings sb
            JOIN buses b ON sb.bus_id = b.id
            JOIN seat_layouts sl ON sb.seat_id = sl.id
            JOIN stopping_points sp ON sb.stopping_point_id = sp.id
            WHERE sb.id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $booking_id);
        $stmt->execute();
        $result = $stmt->get_result();
        $booking = $result->fetch_assoc();

        if (!$booking) {
            throw new Exception("Booking not found");
        }
    }
} catch (Exception $e) {
    die("Error: " . $e->getMessage());
}

if (isset($conn)) {
    $conn->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .bus-pass {
            width: 800px;
            padding: 30px;
            background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
            border-radius: 20px;
            position: relative;
            overflow: hidden;
            margin: 40px auto;
        }

        /* Watermark Container */
        .watermark-container {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none;
            z-index: 1;
            overflow: hidden;
        }

        /* Individual Watermark */
        .watermark {
            position: absolute;
            font-size: 24px;
            color: rgba(200, 200, 200, 0.15);
            transform: rotate(-45deg);
            white-space: nowrap;
            user-select: none;
        }

        .bus-pass::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #FF5733 0%, #FF8C5A 100%);
        }

        /* Ensure all content is above watermark */
        .header, .info-section, .footer {
            position: relative;
            z-index: 2;
        }

        .header {
            text-align: center;
            padding-bottom: 25px;
            position: relative;
        }

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
            height: 3px;
            background: #FF5733;
            border-radius: 2px;
        }

        .header img {
            width: 100px;
            height: 100px;
            margin-bottom: 15px;
            filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        }

        .header h2 {
            font-size: 24px;
            font-weight: 700;
            color: #2C3E50;
            margin: 10px 0;
        }

        .header h4 {
            color: #FF5733;
            font-size: 20px;
            font-weight: 600;
        }

        .info-section {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            gap: 20px;
        }

        .info-box {
            flex: 1;
            background: rgba(255, 255, 255, 0.9);
            padding: 25px;
            border-radius: 15px;
            border-color: black;
            transition: transform 0.3s ease;
        }

        .info-box:hover {
            transform: translateY(-5px);
        }

        .info-box h5 {
            color: #FF5733;
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0f2f5;
        }

        .info-box p {
            margin: 12px 0;
            color: #4a5568;
        }

        .info-box strong {
            color: #2C3E50;
            font-weight: 600;
        }

        .footer {
            background: linear-gradient(135deg, #FF5733 0%, #FF8C5A 100%);
            color: white;
            text-align: center;
            padding: 20px;
            border-radius: 15px;
            margin-top: 30px;
            position: relative;
        }

        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.1) 0%, rgba(255, 255, 255, 0) 100%);
            border-radius: 15px;
        }

        .footer p {
            font-weight: 600;
            margin-bottom: 15px;
        }

        .footer ul {
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        .footer li {
            margin: 8px 0;
            font-size: 14px;
            opacity: 0.9;
        }

        @media print {
            body {
                background: white;
            }
            .bus-pass {
                box-shadow: none;
            }
        }
    </style>
</head>
<body>
    <div id="bus-pass" class="bus-pass">
        <!-- Watermark Container -->
        <div class="watermark-container" id="watermarkContainer"></div>

        <div class="header">
            <img src="image/icons/mkce_s.png" alt="MKCE Logo">
            <h2>M.KUMARASAMY COLLEGE OF ENGINEERING</h2>
            <h4>Bus Allotment Order (2024-2025)</h4>
        </div>

        <div class="info-section">
            <div class="info-box">
                <h5>Student Information</h5>
                <p><strong>Name:</strong> <?= $booking['name'] ?></p>
                <p><strong>Reg No:</strong> <?= $booking['regno'] ?></p>
                <p><strong>Department:</strong> <?= $booking['branch'] ?></p>
                <p><strong>Year & Semester:</strong> <?= $booking['semester'] ?></p>
            </div>

            <div class="info-box">
                <h5>Bus Details</h5>
                <p><strong>Bus No:</strong> <?= $booking['bus_number'] ?></p>
                <p><strong>Seat No:</strong> <?= $booking['seat_number'] ?></p>
                <p><strong>Route:</strong> <?= $booking['route_name'] ?></p>
                <p><strong>Stop:</strong> <?= $booking['stop_name'] ?></p>
            </div>
        </div>

        <div class="info-section">
            <div class="info-box">
                <h5>Payment Information</h5>
                <p><strong>Amount:</strong> ₹<?= number_format($booking['amount'], 2) ?></p>
                <?php
                if ($booking['amount'] == 0.00) {
                    ?>
                    <p><strong>Remarks:</strong> <?= $booking['remarks'] ?></p>
                    <?php
                }
                ?>
                <p><strong>Payment ID:</strong> <?= $booking['payment_id'] ?></p>
                <p><strong>Date:</strong> <?= $booking['booking_date'] ?></p>
            </div>
        </div>

        <div class="footer">
            <p>Important Notes:</p>
            <ul>
                <li>1. This is a system-generated receipt. No signature required.</li>
                <li>2. Carry this pass during travel.</li>
                <li>3. This pass is non-transferable.</li>
            </ul>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

    <script>
        // Create watermark pattern
        function createWatermarks() {
            const container = document.getElementById('watermarkContainer');
            const regno = '<?= $booking['regno'] ?>';
            const verticalSpacing = 100;    // Space between rows
            const horizontalSpacing = 200;  // Increased space between watermarks in same line

            for (let y = -100; y < container.offsetHeight + 100; y += verticalSpacing) {
                for (let x = -100; x < container.offsetWidth + 100; x += horizontalSpacing) {
                    const watermark = document.createElement('div');
                    watermark.className = 'watermark';
                    watermark.textContent = regno;
                    watermark.style.left = x + 'px';
                    watermark.style.top = y + 'px';
                    container.appendChild(watermark);
                }
            }
        }

        // Create watermarks when page loads
        window.onload = function() {
            createWatermarks();

            const { jsPDF } = window.jspdf;
            const pdf = new jsPDF();

            const busPass = document.getElementById('bus-pass');

            html2canvas(busPass).then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgWidth = 190;
                const imgHeight = canvas.height * imgWidth / canvas.width;

                pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
                pdf.save('bus-pass.pdf');

                window.location.href = 'bus_booking.php';
                setTimeout(() => {
                    window.close();
                }, 2000);
            });
        }
    </script>
</body>
</html>