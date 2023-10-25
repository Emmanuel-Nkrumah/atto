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

if (isset($_GET['id'])) {
    $contentId = $_GET['id'];
    $sql = "SELECT * FROM content WHERE id = ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("i", $contentId);
    $stmt->execute();
    $result = $stmt->get_result();
    $content = $result->fetch_assoc();
    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Display Content</title>
</head>
<body>
    <h2>Display Content</h2>
    <?php if (isset($content)) { ?>
        <h1><?php echo $content['title']; ?></h1>
        <p><?php echo $content['text_content']; ?></p>
    <?php } else { ?>
        <p>Content not found.</p>
    <?php } ?>
    <a href="index.php">Back to Content List</a>
</body>
</html>
