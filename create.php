<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_FILES['image']['name'];
    $title = $_POST['title'];
    $date = $_POST['date'];
    $content = $_POST['content'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO articles (image, title, date, content) VALUES ('$target_file', '$title', '$date', '$content')";
        if ($conn->query($sql) === TRUE) {
            echo "New article created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Article</title>
</head>
<body>
    <h1>Create New Article</h1>
    <form action="create.php" method="post" enctype="multipart/form-data">
        <label for="image">Image:</label>
        <input type="file" name="image" required><br>
        <label for="title">Title:</label>
        <input type="text" name="title" required><br>
        <label for="date">Date:</label>
        <input type="date" name="date" required><br>
        <label for="content">Content:</label>
        <textarea name="content" required></textarea><br>
        <input type="submit" value="Create">
    </form>
</body>
</html>
