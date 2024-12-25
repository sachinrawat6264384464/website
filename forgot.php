<?php
session_start();
include('../_conn.php'); // Include database connection

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form was submitted
if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action === 'send_otp') {
        // Step 1: Send OTP to email and store it in the database
        $email = $_POST['uemail'];

        require '../PHPMailer/src/Exception.php';
        require '../PHPMailer/src/PHPMailer.php';
        require '../PHPMailer/src/SMTP.php';

        function sendOtpEmail($email, $otp) {
            $mail = new PHPMailer(true);
            try {
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'satyarthigwl@gmail.com';
                $mail->Password   = 'xqwh uhkq kqgh cnpx';
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port       = 587;

                // Recipients
                $mail->setFrom('noreply@yourdomain.com', 'Ajjaks');
                $mail->addAddress($email);

                // Content
                $mail->Subject = 'Your OTP Code';
                $mail->Body    = "Your OTP code is: $otp";

                if ($mail->send()) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e) {
                echo 'Mailer Error: ' . $mail->ErrorInfo;
                return false;
            }
        }

        // Generate a 6-digit OTP
        $otp = str_pad(rand(0, 999999), 6, '0', STR_PAD_LEFT);

        // Send OTP via email
        if (sendOtpEmail($email, $otp)) {
            echo json_encode(['status' => 'success', 'message' => 'OTP sent to your email.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to send OTP.']);
        }

        // Insert OTP into the 'vf' table
        $stmt = $conn->prepare("INSERT INTO vf (email, otp, created_at) VALUES (?, ?, NOW()) ON DUPLICATE KEY UPDATE otp = ?, created_at = NOW()");
        $stmt->bind_param("sss", $email, $otp, $otp);
        $stmt->execute();
        $stmt->close();
        exit();
    }

    if ($action === 'verify_otp') {
        $email = $_POST['uemail'];
        $otp = $_POST['uotp'];

        // Check OTP in the database
        $stmt = $conn->prepare("SELECT * FROM vf WHERE email = ? AND otp = ?");
        $stmt->bind_param("ss", $email, $otp);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // OTP is valid, delete it from the table
            $stmt = $conn->prepare("DELETE FROM vf WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            echo json_encode(['status' => 'success']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Invalid OTP.']);
        }
        $stmt->close();
        exit();
    }

    if ($action === 'change_password') {
        // Step 3: Change Password
        $email = $_POST['uemail'];
        $newPassword = $_POST['upassword'];

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_BCRYPT);

        // Update user's password in the users table
        $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
        $stmt->bind_param("ss", $hashedPassword, $email);
        if ($stmt->execute() && $stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Password changed successfully in users table.']);
        } else {
            // If not updated in users table, try updating in admins table
            $stmt = $conn->prepare("UPDATE admins SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashedPassword, $email);
            if ($stmt->execute() && $stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => 'Password changed successfully in admins table.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Failed to update password in both tables.']);
            }
        }
        $stmt->close();
        exit();
    }
}
?>
