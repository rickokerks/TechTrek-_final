<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "authenticate";

    // Create connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Use prepared statement to prevent SQL injection
    $query = "SELECT * FROM login WHERE username=?";

    if ($stmt = $conn->prepare($query)) {
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            $plaintext_password_from_db = $user['password']; // Retrieve plaintext password
            if ($password == $plaintext_password_from_db) {
                // Successful login, redirect to Test.html
                header("Location: Test.html");
                exit();
            } else {
                echo "<script>alert('Incorrect password. Please try again.'); window.location.href='index.html';</script>";
                exit();
            }
        } else {
            echo "<script>alert('Username not found. Please try again.'); window.location.href='index.html';</script>";
            exit();
        }

        
    } else {
        echo "<script>alert('Failed to prepare statement.'); window.location.href='index.html';</script>";
        exit();
    }


}
?>