
Send_otp.php 
 
<?php 
// Start the session 
session_start(); 
 
// Include PHPMailer classes 
require 'PHPMailer/src/PHPMailer.php'; 
require 'PHPMailer/src/SMTP.php'; 
require 'PHPMailer/src/Exception.php'; 
 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\Exception; 
 
// Enable error reporting 
error_reporting(E_ALL); 
ini_set('display_errors', 1); 
 
// Function to send OTP 
function sendOtp($email) { 
    // Generate a random OTP 
    $otp = rand(100000, 999999); 
     
    // Store OTP in session for later verification 
    $_SESSION['otp'] = $otp; 
    $_SESSION['otp_email'] = $email; 
 
    // Create a new PHPMailer instance 
    $mail = new PHPMailer(); 
     
    // SMTP configuration 
    $mail->isSMTP(); 
    $mail->Host = 'smtp.gmail.com'; // Your SMTP server 
    $mail->SMTPAuth = true; 
    $mail->Username = 'cmrworkshop056@gmail.com'; // Your email 
    $mail->Password = 'jhuq vaud rqdo xkde'; // Your email password (App 
password if 2FA is enabled) 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port = 587; 
 
    // Email content 
    $mail->setFrom('cmaworkshoe056@gmail.com', 'Your Name'); 
    $mail->addAddress($email); 
    $mail->Subject = 'Your OTP Code'; 
    $mail->Body = "Your OTP code is: $otp"; 
 
    // Send email 
    if ($mail->send()) { 
        return true; // Email sent successfully 
    } else { 
        // Log the error message 
        echo 'Mailer Error: ' . $mail->ErrorInfo; 
        return false; // Email sending failed 
    } 
} 
 
// Handle form submission 
if ($_SERVER["REQUEST_METHOD"] === "POST") { 
    $email = $_POST['email']; 
 
    if (sendOtp($email)) { 
        // Redirect to the OTP verification page 
        header("Location: verify_otp.php"); 
        exit(); 
    } else { 
        echo "Failed to send OTP. Please try again later."; 
    } 
} 
?> 
 
