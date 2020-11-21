<?php
$link = mysqli_connect("localhost","root","","store");
if (mysqli_connect_errno()) {
    die(mysqli_connect_error($link));
}
?>