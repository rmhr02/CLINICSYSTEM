<?php
session_start(); // Start a session to store user information after login

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$database = "clinic_data";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query to check if the username and password match
    $sql = "SELECT * FROM account WHERE Username = '$username' AND Password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        $_SESSION['username'] = $user['Username'];

        header("Location: index.php");
        exit();
    } else {
        echo "<script>alert('Invalid Username or Password. Please try again.'); window.location.href='login.php';</script>";
    }
}

$conn->close();
?>
