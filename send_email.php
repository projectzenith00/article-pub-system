<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "article_publishing_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$date = date('Y-m-d');
$sql = "SELECT * FROM articles WHERE date='$date'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $articles = "";
    while($row = $result->fetch_assoc()) {
        $articles .= "<h2>" . $row["title"] . "</h2>";
        $articles .= "<img src='" . $row["image"] . "' alt='Article Image' width='100'><br>";
        $articles .= "<p>" . $row["content"] . "</p>";
    }

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'bulk.smtp.mailtrap.io';  
        $mail->SMTPAuth = true;
        $mail->Username = 'api'; 
        $mail->Password = '13ea0591b6d0254d76ad4e739cc8f721';
        $mail->SMTPSecure = 'tls'; 
        $mail->Port = 587; 

        //Recipients
        $mail->setFrom('contact@kentrogell.dev', 'Mailer');
        $mail->addAddress('knt.rogell@gmail.com', 'User'); 

       
        $mail->isHTML(true); 
        $mail->Subject = 'Published Articles for ' . $date;
        $mail->Body    = $articles;

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
    }
} else {
    echo "No articles found for today.";
}

$conn->close();
?>
