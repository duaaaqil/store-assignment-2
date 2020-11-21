<?php
require_once "connection.php";
$table_name = $_POST['tName'];
$query = "";
switch ($table_name) {
    case "category":
        $add_form_value = $_POST['addValue'];
        $query = "INSERT INTO `category` (`category_name`) VALUES ('$add_form_value')";
        break;
    case "brands":
        $add_form_value = $_POST['addValue'];
        $query = "INSERT INTO `brands` (`brand_name`) VALUES ('$add_form_value')";
        break;
    case "product" :
        $selectCategory = $_POST['selectCategory'];
        $selectBrand = $_POST['selectBrand'];
        $price = $_POST['price'];
        $ext = ['jpg','jpeg','png'];
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
                            $query = "INSERT INTO product (product_name,product_price, product_image_file,brand_id,category_id) VALUES ('$add_form_value', $price, '$new_file_name','$selectBrand', '$selectCategory')";
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
echo $query;
$result = mysqli_query($link, $query);
echo $result;

?>