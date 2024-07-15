<?php
include 'config.php';

$id = $_GET['id'];
$sql = "DELETE FROM articles WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Article deleted successfully";
} else {
    echo "Error deleting record: " . $conn->error;
}

$conn->close();
?>
