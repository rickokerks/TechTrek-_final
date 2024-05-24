<?php
session_start();
include ('dbcon.php');  // Database connection
require 'vendor/autoload.php';  // Composer's autoload file for PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendemail_verify($username, $email)
{
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
        $mail->Username = "techtrek124@gmail.com";
        $mail->Password = "zmyi bpbj gdan snmv";  // Replace with your app password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom("techtrek124@gmail.com", "TechTrek");
        $mail->addAddress($email);

        $mail->isHTML(true);
        $mail->Subject = "Email Verification from TechTrek Inventory Manager";
        $mail->Body = "<h2>You have successfully registered at TechTrek!</h2>
                       <h5>Welcome, $username!</h5>";
        $mail->send();
        echo 'Verification email has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

if (isset($_POST['signup_btn'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];

    if (!$conn) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    $duplicate = mysqli_query($conn, "SELECT * FROM login WHERE username = '$username' OR email = '$email'");

    if (mysqli_num_rows($duplicate) > 0) {
        echo "<script>alert('Username or Email has already been taken.');</script>";
        echo "<script>window.location.href = 'register.html';</script>";
    } else {
        if ($password == $confirmpassword) {
            $hashed_password = $password;
            $query = "INSERT INTO login (username, email, password) VALUES ('$username', '$email', '$password')";
            if (mysqli_query($conn, $query)) {
                echo "<script>alert('Registration Successful!');</script>";
                echo "<script>window.location.href = 'index.html';</script>";
                sendemail_verify($username, $email);
            } else {
                echo "<script>alert('Registration failed. Please try again.');</script>";
            }
        } else {
            echo "<script>alert('Passwords do not match.');</script>";
            echo "<script>window.location.href = 'register.html';</script>";
        }
    }
}
?>