<?php
include 'server/connection.php';

$username = $_POST['name'];
$email = $_POST['email'];
$password = ($_POST['password']);

$query = "INSERT into users values('','$username','$email','$password','','','','')";

mysqli_query($conn,$query);

header("location: register.html");
?>