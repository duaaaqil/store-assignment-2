<?php
require_once "connection.php";
$table_name = $_POST['tName'];
$id = $_POST['id'];
$category_name_To_edit = $_POST['category_name_To_edit'];
$brand_name_To_edit = $_POST['brand_name_To_edit'];
$product_name_To_edit = $_POST['product_name_To_edit'];
$product_price_To_edit =  $_POST['product_price_To_edit'];
$product_brand_To_edit =  $_POST['product_brand_To_edit'];
$product_category_To_edit = $_POST['product_category_To_edit'];

$query = "";
switch ($table_name) {
    case "category":
        $get_category_name_query = "select category_name from category where category_id = " . $id;
        $result = mysqli_query($link, $get_category_name_query);
        $category_name = mysqli_fetch_object($result);
        $category_name = $category_name->category_name;
        $query = "update category set category_name = '{$category_name_To_edit}' where category_id = " . $id;
        break;
    case "brands":
        $get_brand_name_query = "select brand_name from brands where brand_id = " . $id;
        $result = mysqli_query($link, $get_brand_name_query);
        $brand_name = mysqli_fetch_object($result);
        $brand_name = $brand_name->brand_name;
        $query = "update brands set brand_name = '{$brand_name_To_edit}' where brand_id = " . $id;
        break;
    case "product" :
        $records = "select* from product where product_id = " . $id;
        $result = mysqli_query($link, $fetch_record);
        $records = mysqli_fetch_assoc($result);

        if (isset($_FILES['file_name']) && !($_FILES['file_name']['error'])) {
            $file_name = $_FILES['file_name']['name'];
            $tmp_name = $_FILES['file_name']['tmp_name'];
            $filename_explode =  explode('.',$file_name);
            $file_extension = array_pop($filename_explode);
            $new_file_name = hash("sha256",$file_name.time()).".$file_name";
            $file_size = $_FILES['file_name']['size'];

            if (in_array($file_extension,$ext)) {
                if($file_size <= IMAGE_SIZE){
                    if (move_uploaded_file ($tmp_name,IMAGE_UPLOAD_PATH."/$new_file_name")) {
                        if (isset($add_form_value) && !empty(trim($add_form_value)) ) {
                            $query = "UPDATE product SET (product_name, product_price, product_image_file, brand_id, category_id) SET ('$product_name_To_edit','$product_price_To_edit','/upload/$_FILES['file_name']['name']','$product_brand_To_edit','$product_category_To_edit' ) where product_id = " . $id;
                            $result = mysqli_query($link,$query);
                            if ($result) {
                                header('location:product-list.php');
                            }
                            
                        }
                        else {
                            echo "product field cannot be empty !";
                        }

                    }
                    else{
                        echo "SOMETHING WENT WRONG FILE NOT MOVED !";
                    }
                }else{
                    echo "FILE SIZE NOT SUPPORTED";
                }
            }else{
                echo "FILE EXTENSION NOT SUPPORTED";
            }
        }
        break;
}
$result = mysqli_query($link, $query);
echo $query;
?>