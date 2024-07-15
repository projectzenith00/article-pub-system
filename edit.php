<?php
include 'config.php';

$id = $_GET['id'];
$sql = "SELECT * FROM articles WHERE id=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image']['name'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    if ($image) {
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        $sql = "UPDATE articles SET image='$target_file', title='$title', date='$date', content='$content' WHERE id=$id";
    } else {
        $sql = "UPDATE articles SET title='$title', date='$date', content='$content' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Article updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Article</title>
</head>
<body>
    <h1>Edit Article</h1>
    <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <label for="image">Image:</label>
        <input type="file" name="image"><br>
        <label for="title">Title:</label>
        <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
        <label for="date">Date:</label>
        <input type="date" name="date" value="<?php echo $row['date']; ?>" required><br>
        <label for="content">Content:</label>
        <textarea name="content" required><?php echo $row['content']; ?></textarea><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>

<?php $conn->close(); ?>
