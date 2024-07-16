<?php
include 'config.php';

$sql = "SELECT * FROM articles ORDER BY date DESC";
$sqldir = "SHOW VARIABLES LIKE 'datadir'";
$result = $conn->query($sql); ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Article Publishing System</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
        <link rel="stylesheet" type="text/css" href="styles.css" />
    </head>
    <body>
        <div class="form-container">
        <h1 class="heading">Articles</h1>
        
        <table class="list">
            <tr>
                <th>Image</th>
                <th>Title</th>
                <th>Date</th>
                <th>Content</th>
                <th>Actions</th>
            </tr>
            <?php while($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><img src="<?php echo $row['image']; ?>" alt="Article Image" width="100" /></td>
                <td><?php echo $row['title']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo substr($row['content'], 0, 100); ?>...</td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
                    <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </table>

        <table>
            <tr>
            
                <td><br />
        <table>
            <tr>
                <td>
                    <form action="send_email.php" method="post" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td width="20%">
                                    <label for="date">Articles Published on:</label>
                                </td>
                                <td>
                                    <input type="date" name="date" required />
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                    <label for="date">Enter email address:</label>
                                </td>
                                <td>
                                    <input type="email" name="email" required />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <input type="submit" class= "send-button" value="Send" />
                                </td>
                                <td>
                                    <div class="create-article-button-container">
                                    <a class="create-article-button" href="create.php">Create New Article</a>
                                    </div>
                                </td>
                            
                            </tr>
                        </table>
                    </form>
                </td>
            </tr>
        </table></td>
            </tr>
        </table>
    </div>
    </body>
</html>

<?php $conn->close(); ?>
