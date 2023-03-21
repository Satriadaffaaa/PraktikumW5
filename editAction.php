<?php
include 'server/connection.php';

$id = $_POST['id'];
$username = $_POST['name'];
$email = $_POST['email'];
$password = ($_POST['password']);

$query = mysqli_query($conn, "UPDATE `users` SET `name` = '$username', `email` = '$email', `password` = '$password' WHERE `id` = $id");

if ($query) {
    echo "berhasil input data";
    header("location: welcome.php");
} else {
    echo "data gagal disimpan: " . mysqli_error($conn);
}
