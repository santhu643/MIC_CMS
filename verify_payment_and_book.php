<?php
// verify_payment_and_book.php
require_once 'config.php';
require('vendor/razorpay/razorpay/Razorpay.php');
require_once 'EncryptionUtils.php';
header('Content-Type: application/json');

try {
    $api = new Razorpay\Api\Api($razorpay_key_id, $razorpay_key_secret);
    
    // Get payment details from POST
    $razorpay_order_id = $_POST['razorpay_order_id'];
    $razorpay_payment_id = $_POST['razorpay_payment_id'];
    $razorpay_signature = $_POST['razorpay_signature'];
    
    // Verify payment signature
    $attributes = [
        'razorpay_order_id' => $razorpay_order_id,
        'razorpay_payment_id' => $razorpay_payment_id,
        'razorpay_signature' => $razorpay_signature
    ];
    
    $api->utility->verifyPaymentSignature($attributes);
    

    
    try {
        // First get the existing booking details
        $sql = "SELECT b.id, b.seat_id, sl.seat_number 
                FROM student_bookings b
                JOIN seat_layouts sl ON b.seat_id = sl.id
                WHERE b.order_id = ? AND b.booking_status = 'pending'";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $razorpay_order_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows === 0) {
            throw new Exception("No pending booking found for this order");
        }
        
        $booking = $result->fetch_assoc();
        
        // Update the booking with payment details
        $updateSql = "UPDATE student_bookings 
                     SET payment_id = ?,
                         payment_mode = 'razorpay',
                         fee_status = 'completed',
                         booking_status = 'confirmed',
                         updated_at = CURRENT_TIMESTAMP
                     WHERE id = ?";
        
        $stmt = $conn->prepare($updateSql);
        $stmt->bind_param("si", $razorpay_payment_id, $booking['id']);
        
        if (!$stmt->execute()) {
            throw new Exception("Error updating booking: " . $stmt->error);
        }
        
        $conn->commit();
        
        echo json_encode([
            'success' => true,
            'seat_number' => $booking['seat_number'],
            'booking_id' => $encrypted_booking_id = EncryptionUtils::encrypt($booking['id']),
        ]);
        
    } catch (Exception $e) {
        $conn->rollback();
        throw $e;
    }
    
} catch (Exception $e) {
    if (!isset($conn)) {
        $conn = new mysqli($servername, $username, $password, $dbname);
    }
    
    // Delete the pending booking
    if (isset($razorpay_order_id)) {
        $deleteSql = "DELETE FROM student_bookings WHERE order_id = ? AND booking_status = 'pending'";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("s", $razorpay_order_id);
        $stmt->execute();
    }
    
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

if (isset($conn)) {
    $conn->close();
}
?>