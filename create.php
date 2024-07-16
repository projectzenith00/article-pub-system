<?php

include 'config.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $image = $_FILES['image']['name'];

    $title = $_POST['title'];

    $date = $_POST['date'];

    $content = $_POST['content'];

    $target_dir = "uploads/";

    $target_file = $target_dir . basename($image);

    $uploadOk = 1;

    $targetFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);

        if ($check !== false) {

                $uploadOk = 1;

            }
 else {

                echo "File is not an image.";

                $uploadOk = 0;

            }


            if (file_exists($target_file)) {

                echo "Sorry, file already exists.";

                $uploadOk = 0;

            }


            if ($_FILES["image"]["size"] > 500000) {

                echo "Sorry, your file is too large.";

                $uploadOk = 0;

            }


            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif") {

                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

                $uploadOk = 0;

            }


            
            if ($uploadOk == 0) {

                echo "Sorry, your file was not uploaded.";

         
            }
 else {

                if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

                        $sql = "INSERT INTO articles (image, title, date, content) VALUES ('$target_file', '$title', '$date', '$content')";

                        if ($conn->query($sql) === TRUE) {

                            echo "New article created successfully";

                        }
 else {

                            echo "Error: " . $sql . "" . $conn->error;

                        }

                    }
 else {

                        echo "Sorry, there was an error uploading your file.";

                    }

            }

    }

?>

<!DOCTYPE html>
<html>
<head>
    <title>Create Article</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
    <div class="form-container">
     <h1 class="heading">Create Article</h1>
  <!--   <form action="create.php
" method="post" enctype="multipart/form-data">
        <label for="image">Image:</label>
        <input type="file" name="image" required>
        <label for="title">Title:</label>
        <input type="text" name="title" required>
        <label for="date">Date:</label>
        <input type="date" name="date" required>
        <label for="content">Content:</label>
        <textarea name="content" required></textarea>
        <input type="submit" value="Create">
    </form> -->



    <form action="create.php
" method="post" enctype="multipart/form-data">
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
                <input type="text" name="title" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="date">Date:</label>
            </td>
            <td>
                <input type="date" name="date" required>
            </td>
        </tr>
        <tr>
            <td>
                <label for="date">Content:</label>
            </td>
            <td>
                <textarea rows="10" cols="50" name="content" required></textarea>
            </td>
        </tr>
        <tr>
            <td>
                <div class="create-article-button-container">
                                    <a class="create-article-button" href="index.php">Back to Home </a>
                                    </div></td></tr><tr>
            <td>
                <div class="create-article-button-container">
                                    <input class="create-article-button" type="submit" value="Create">
                                    </div></td>
        </tr>
        </table>
    </form>
</div>
</body>
</html>
