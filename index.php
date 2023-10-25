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
    

<h2>Content List</h2>
    <ul id="content-list">
        <?php foreach ($content as $row) { ?>
            <li>
                <strong class="content-title" data-title="<?php echo $row['title']; ?>" data-content-id="<?php echo $row['id']; ?>">
                    <?php echo $row['title']; ?>
                </strong>
                <p class="content-text" data-content="<?php echo $row['text_content']; ?>"></p>
            </li>
        <?php } ?>
    </ul>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var contentTitles = document.querySelectorAll(".content-title");

            contentTitles.forEach(function(title) {
                title.addEventListener("click", function() {
                    var contentId = title.getAttribute("data-content-id");
                    window.location.href = "display_content.php?id=" + contentId;
                });
            });
        });
    </script>
    <li><a href="login.php">admin</a></li>
</body>


</html>