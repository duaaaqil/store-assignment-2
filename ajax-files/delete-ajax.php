<?php
require_once "connection.php";
$table_name = $_POST['tName'];
$id = $_POST['id'];
//echo $id;
$query = "";
switch ($table_name) {
    case "category":
        $query = "delete from category where category_id = " . $id;
        break;
    case "brands":
        $query = "delete from brands where brand_id = " . $id;
        break;
    case "product" :
        $query = "delete from product where product_id = " . $id;
        break;
}
echo $query;
$result = mysqli_query($link, $query);
echo $result;
?>