<?php
include 'config.php';

$sql = "SELECT * FROM articles ORDER BY date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Article Publishing System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
    <h1>Articles</h1>
    <a href="create.php">Create New Article</a>
    <table>
        <tr>
            <th>Image</th>
            <th>Title</th>
            <th>Date</th>
            <th>Content</th>
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><img src="<?php echo $row['image']; ?>" alt="Article Image" width="100"></td>
            <td><?php echo $row['title']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo substr($row['content'], 0, 100); ?>...</td>
            <td>
                <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                <a href="send_email.php?id=<?php echo $row['id']; ?>">Send</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</body>
</html>

<?php $conn->close(); ?>
