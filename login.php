<?php
session_start();

// Connect to database
$conn = new mysqli("localhost", "root", "052405", "visitor_inquiry");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect form data
$username = $_POST['username'];
$password = $_POST['password'];

// Query the database
$sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
$result = $conn->query($sql);

// Check if user exists
if ($result->num_rows === 1) {

    // Store user in session
    $_SESSION['user'] = $username;

    // Redirect to dashboard
    header("Location: dashboard.php");
    exit();
    
} else {
    echo "<script>
        alert('Invalid username or password!');
        window.location.href = 'index.html';
    </script>";
}

$conn->close();
?>
