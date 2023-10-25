<?php
// Connect to the database (replace with your credentials)
$host = "localhost";
$username = ""; // Replace with your actual username
$password = ""; // Replace with your actual password
$database = "atto_db"; // Replace with your actual database name

$mysqli = new mysqli('localhost','root','','atto_db');
 

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $text_content = $_POST['text_content'];
    $sql = "INSERT INTO content (title, text_content) VALUES (?, ?)";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ss", $title, $text_content);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['edit'])) {
    $id = $_POST['edit_id'];
    $title = $_POST['edit_title'];
    $text_content = $_POST['edit_text_content'];
    $sql = "UPDATE content SET title = ?, text_content = ? WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("ssi", $title, $text_content, $id);
    $stmt->execute();
    $stmt->close();
}

if (isset($_POST['delete'])) {
    $id = $_POST['delete_id'];
    $sql = "DELETE FROM content WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

// Fetch content from the database
$result = $mysqli->query("SELECT * FROM content");
$content = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $content[] = $row;
    }
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <form method="post">
        <label>Title:</label>
        <input type="text" name="title" required><br>
        <label>Text Content:</label>
        <textarea name="text_content" required></textarea><br>
        <input type="submit" name="submit" value="Upload">
    </form>
    <li><a href="admin.php">admin content</a></li>
    <li><a href="index.php">home</a></li>
</body>
</html>