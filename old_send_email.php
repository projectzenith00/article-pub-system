<!-- <?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $sql = "SELECT * FROM articles WHERE date='$date'";
    $result = $conn->query($sql);

    $to = "recipient@example.com";
    $subject = "Published Articles on $date";
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

    $message = "<html><body>";
    $message .= "<h1>Published Articles on $date</h1>";
    while($row = $result->fetch_assoc()) {
        $message .= "<div>";
        $message .= "<img src='" . $row['image'] . "' alt='Article Image' width='100'><br>";
        $message .= "<h2>" . $row['title'] . "</h2>";
        $message .= "<p>" . $row['content'] . "</p>";
        $message .= "</div><br>";
    }
    $message .= "</body></html>";

    if (mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully";
    } else {
        echo "Failed to send email";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
</head>
<body>
    <h1>Send Email with Published Articles</h1>
    <form action="send_email.php" method="post">
        <label for="date">Date:</label>
        <input type="date" name="date" required><br>
        <input type="submit" value="Send Email">
    </form>
</body>
</html>

<?php $conn->close(); ?>
 -->


 <?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $date = $_POST['date'];
    $sql = "SELECT * FROM articles WHERE date='$date'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $to = "recipient@example.com";
        $subject = "Published Articles on $date";
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: sender@example.com" . "\r\n";

        $message = "<html><body>";
        $message .= "<h1>Published Articles on $date</h1>";
        while($row = $result->fetch_assoc()) {
            $message .= "<div style='margin-bottom: 20px;'>";
            $message .= "<img src='" . $row['image'] . "' alt='Article Image' style='width:100px;height:auto;'><br>";
            $message .= "<h2>" . $row['title'] . "</h2>";
            $message .= "<p>" . $row['content'] . "</p>";
            $message .= "</div>";
        }
        $message .= "</body></html>";

        if (mail($to, $subject, $message, $headers)) {
            echo "Email sent successfully";
        } else {
            echo "Failed to send email";
        }
    } else {
        echo "No articles found for the specified date.";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Send Email</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            text-align: center;
            margin-top: 20px;
        }

        label {
            margin-right: 10px;
        }

        input[type="date"], input[type="submit"] {
            padding: 5px 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Send Email with Published Articles</h1>
    <form action="send_email.php" method="post">
        <label for="date">Date:</label>
        <input type="date" name="date" required><br>
        <input type="submit" value="Send Email">
    </form>
</body>
</html>
