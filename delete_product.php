<?php
session_start();
include_once('connection.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];

    // SQL query to delete the product
    $sql = "DELETE FROM product WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "success";
    } else {
        echo "error";
    }
} else {
    echo "Invalid request";
}

$conn->close();
?>
