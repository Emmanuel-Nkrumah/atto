<?php
// Replace with your actual database credentials
$host = "localhost";
$dbUsername = "";
$dbPassword = "";
$database = "atto_db";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Create a database connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $database);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Perform database query to validate the username and password
    $sql = "SELECT * FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a matching user was found in the database
    if ($result->num_rows > 0) {
        // Authentication successful, set a session variable to indicate the user is authenticated
        session_start();
        $_SESSION["authenticated"] = true;
        header("Location: admin.php");
        exit();
    } else {
        // Authentication failed, redirect back to the login page with an error message
        header("Location: login.php?error=1");
        exit();
    }

    // Close the database connection
    $conn->close();
}
?>
