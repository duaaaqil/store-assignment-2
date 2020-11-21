<?php
include_once "connection.php";

$email = $_POST['email'];
$password = $_POST['password'];
$query = "";

$query = "SELECT * FROM registeredusers";
$result = mysqli_query($link, $query);
$registeredUsers = mysqli_fetch_all($result,1);
foreach($registeredUsers as $registeredUser ){
    if($registeredUser['email'] == $email && $registeredUser['password'] == $password ){
        echo "YOU ARE SUCCESSFULLY LOGIN";

    }else{
        echo "LOGIN CREDENTIALS ARE NOT CORRECT";
    }
}

?>