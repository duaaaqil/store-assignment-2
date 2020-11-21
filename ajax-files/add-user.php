<?php
include_once "connection.php";

$name = $_POST['name'];
$userName = $_POST['userName'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];
$email = $_POST['email'];

$query = "";
if($password == $confirm_password){
    $hashed_password = password_hash($password);
    echo ("user successfully registered");
    $query = "INSERT INTO registeredusers ( `name`, `user_name`, `password`, `email`) VALUES ('$name', '$userName', '$hashed_password', '$email')";
}else{
    echo ("password field doesn't match confirm password field");
}
$result = mysqli_query($link, $query);

?>