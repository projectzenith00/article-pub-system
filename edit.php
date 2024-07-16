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
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <div class="form-container">
     <h1 class="heading">Edit Article</h1>
    <form action="edit.php?id=<?php echo $id; ?>" method="post" enctype="multipart/form-data">
        <table>
        <tr>
            <td>
                <label for="image">Image:</label>
            </td>
            <td>
                <input type="file" name="image">
            </td>
        </tr>
        <tr>
            <td>
                <label for="image">Title:</label>
            </td>
            <td>
                <input type="text" name="title" value="<?php echo $row['title']; ?>" required><br>
            </td>
        </tr>
        <tr>
            <td>
                <label for="date">Date:</label>
            </td>
            <td>
                <input type="date" name="date" value="<?php echo $row['date']; ?>" required><br>
            </td>
        </tr>
        <tr>
            <td>
                <label for="date">Content:</label>
            </td>
            <td>
                <textarea rows="10" cols="50" name="content" required><?php echo $row['content']; ?></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <div class="create-article-button-container">
                                    <a class="create-article-button" href="index.php">Back to Home </a>
                                    </div></td></tr><tr>
            <td>
                <div class="create-article-button-container">
                                    <input class="create-article-button" type="submit" value="Update">
                                    </div></td>
        </tr>
        </table>
    </form>
</div>
</body>
</html>

<?php $conn->close(); ?>
