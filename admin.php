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
<script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
<body>
    <h1>Admin Panel</h1>
    <li><a href="add_content.php">Add Inspiration</a></li>
    
    <h2>Content List</h2>
    <ul>
        <?php foreach ($content as $row) { ?>
            <li>
                
                <form method="post">
                    <table border="2" color="black">
                    <tr>
                        <th>TITLE</th>
                        <th>TEXT CONTENT</th>
                        <th>ACTION</th>
                    </tr>
                    <tr>
                        <td><input type="text" name="edit_title" value="<?php echo $row['title']; ?>" required></td>
                        <td><textarea name="edit_text_content" required><?php echo $row['text_content']; ?></textarea></td>
                        <td><input type="submit" name="edit" value="Edit" style="background: blue;">
                        <form method="post">
                    <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                    <input type="submit" name="delete" value="Delete" style="background: red;" class= "fa fa-home">
                </form></td>
                    </tr>
                    </table>

                    <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                   
                    
                    
                    
                    
                </form>
                
            </li>
        <?php } ?>
    </ul>
    <li><a href="index.php" class="fas fa-home">home</a></li>
</body>
</html>