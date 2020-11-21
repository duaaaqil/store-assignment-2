<?php
include_once "constants.php";
$link = mysqli_connect(HOST,USER,PASSWORD,DATABASE);
if (mysqli_connect_errno()) {
    die(mysqli_connect_error($link));
}
?>