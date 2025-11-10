<?php
include 'db.php';

$id = $_GET['id'];

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM vehicles WHERE id=$id"));

if (!empty($data['image']) && file_exists('uploads/' . $data['image'])) {
    unlink('uploads/' . $data['image']);
}

mysqli_query($conn, "DELETE FROM vehicles WHERE id=$id");

header('Location: index.php');
?>
