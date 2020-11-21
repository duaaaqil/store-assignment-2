<title> PRODUCT </title>
<!-- PHP CODE -->
<?php
require_once "header.php";
require_once "navigation.php";
require_once "connection.php";

$brand_query = "SELECT * FROM brands ";
$result = mysqli_query($link, $brand_query);
$brands = mysqli_fetch_all($result,1);


$category_query = 'SELECT * FROM category';
$result = mysqli_query($link, $category_query);
$categories = mysqli_fetch_all($result,1);

$query = "SELECT product.product_id, product.product_name,product.product_price, product.product_image_file, category.category_name, brands.brand_name FROM product inner join category on product.category_id = category.category_id inner join brands on product.brand_id = brands.brand_id";
$result = mysqli_query($link, $query);
$numOfRecords = mysqli_num_rows($result);
$perPageRecords = 4;
$numOfPages = ceil( $numOfRecords/$perPageRecords );
$offset = isset($_GET['offset']) ? $_GET['offset'] - 1 : 0;
$offsetRecords = $offset * $perPageRecords;

$query = "SELECT product.product_id, product.product_name,product.product_price, product.product_image_file, category.category_name, brands.brand_name FROM product inner join category on product.category_id = category.category_id inner join brands on product.brand_id = brands.brand_id order by product_id LIMIT $offsetRecords , $perPageRecords";
$result = mysqli_query($link, $query);
?>
<!-- FILTER AND SORTING PHP CODE -->
<?php 
if(isset($_POST['order_by'])){
  $query = "SELECT product.product_id, product.product_name,product.product_price, product.product_image_file, category.category_name, brands.brand_name FROM product inner join category on product.category_id = category.category_id inner join brands on product.brand_id = brands.brand_id order by {$_POST['order_by']} {$_POST['order_with']}";
  $result = mysqli_query($link, $query);
}
if(isset($_POST['filter_submit']) ){
  if(!empty(trim($_POST['filter_by']))){
      $query = "SELECT product.product_id, product.product_name,product.product_price, product.product_image_file, category.category_name, brands.brand_name FROM product inner join category on product.category_id = category.category_id inner join brands on product.brand_id = brands.brand_id  WHERE product_name LIKE  '%{$_POST['filter_by']}%' or product_price LIKE  '%{$_POST['filter_by']}%'";
      $result = mysqli_query($link, $query);
    }else{
      $query = "SELECT product.product_id, product.product_name,product.product_price, product.product_image_file, category.category_name, brands.brand_name FROM product inner join category on product.category_id = category.category_id inner join brands on product.brand_id = brands.brand_id";
      $result = mysqli_query($link, $query);
    }
}
?>
<!-- EDIT PRODUCT  -->
<div class="container-fluid" style="display: none;">
<form method="POST" id='editForm'  enctype="multipart/form-data" >
<h4>ADD PRODUCT</h4>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <input type="text" name="edit_product_name" placeholder="PRODUCT NAME" class="form-control" id="edit_product_name">
    </div>
    <div class="col-md-4 mb-3">
      <input type="number" class="form-control"  placeholder="PRODUCT PRICE" id="edit_price_name"> 
    </div>
  </div>
  <div class="form-row">  
    
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
    <label>CHOOSE BRAND </label>
      <select name="edit_brand" class="form-control" id="edit_select_brand">
        <?php 
        foreach($brands as $brand){
            echo "<option value=".$brand['brand_id'].">".$brand['brand_name']."</option>";
        }
        ?> 
    </select> 
    </div>
    <div class="col-md-4 mb-3">
    <label>CHOOSE CATEGORY </label>
      <select name="edit_category" class="form-control" id="edit_select_category">
        <?php 
        foreach($categories as $category){
            echo "<option value=".$category['category_id'].">".$category['category_name']."</option>";
        }
        ?> 
    </select> 
    </div>
  </div>
  <div class="input-group mb-3">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile02 edit_file_name" name="file_name">
            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
        </div>
        <div class="input-group-append">
            <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
        </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <input type="hidden" value="product" id="tableName">
      <input class="btn btn-primary edit-product" type="submit" value="EDIT PRODUCT" name="submit">
    </div>
  </div>
</form>
</div>
<!-- ADD PRODUCT -->
<div class="container-fluid">
<form method="POST" id='addForm'  enctype="multipart/form-data">
<h4>ADD PRODUCT</h4>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <input type="text" name="add_form" placeholder="PRODUCT NAME" class="form-control" id="add_form">
    </div>
    <div class="col-md-4 mb-3">
      <input type="number" class="form-control" id="add_product_price" placeholder="PRODUCT PRICE" id="price"> 
    </div>
  </div>
  <div class="form-row">  
    
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
    <label>CHOOSE BRAND </label>
      <select name="brand" class="form-control" id="select_brand">
        <?php 
        foreach($brands as $brand){
            echo "<option value=".$brand['brand_id'].">".$brand['brand_name']."</option>";
        }
        ?> 
    </select> 
    </div>
    <div class="col-md-4 mb-3">
    <label>CHOOSE CATEGORY </label>
      <select name="category" class="form-control" id="select_category">
        <?php 
        foreach($categories as $category){
            echo "<option value=".$category['category_id'].">".$category['category_name']."</option>";
        }
        ?> 
    </select> 
    </div>
  </div>
  <div class="input-group mb-3">
        <div class="custom-file">
            <input type="file" class="custom-file-input" id="inputGroupFile02" name="file_name">
            <label class="custom-file-label" for="inputGroupFile02" aria-describedby="inputGroupFileAddon02">Choose file</label>
        </div>
        <div class="input-group-append">
            <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
        </div>
  </div>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <input type="hidden" value="product" id="tableName">
      <input class="btn btn-primary add-button" type="submit" value="ADD BRAND" name="submit">
    </div>
  </div>
</form>
</div>

<!-- FILTER FORM -->
<div class="container-fluid">
<form method="POST">
<h4>FILTER</h4>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <input type="text" name="filter_by" placeholder="search..." class="form-control">
    </div>
    <div class="col-md-4 mb-3">
      <input class="btn btn-primary" type="submit" value="filter" name="filter_submit">
    </div>
  </div>
</form>
</div>
<!-- SORTING FORM -->
<div class="container-fluid">
<form method="POST">
<h4>ORDER TABLE</h4>
  <div class="form-row">
    <div class="col-md-6 mb-3">
      <label>ORDER BY</label>
        <select name="order_by" class="form-control">
          <option value="product_name">BY NAME</option>
          <option value="product_price">BY PRICE</option>
          <option value="brand_id">BY BRAND</option>
          <option value="category_id">BY CATEGORY</option>
        </select>
      <label>ORDER WITH</label>
        <select name="order_with" class="form-control">
          <option value="asc">ASCENDING</option>
          <option value="desc">DESCENDING</option>
        </select>
    </div>
  </div>
  <input class="btn btn-primary " type="submit" value="ORDER TABLE" name="sort_submit">
</form>
</div>   
<!-- PRODUCTS TABLE -->
<?php
if(isset($result->num_rows) && $result->num_rows>0){ ?>
<div class="container-fluid">
<h3> PRODUCTS TABLE </h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">PRODUCT ID</th>
      <th scope="col">PRODUCT NAME</th>
      <th scope="col">PRODUCT PRICE</th>
      <th scope="col">PRODUCT IMAGE FILE</th>
      <th scope="col">BRAND NAME</th>
      <th scope="col">CATEGORY NAME</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
  <?php while($resultset = mysqli_fetch_assoc($result)){  ?>
    <tr>
      <th><?php echo $resultset['product_id'] ?></th>
      <td><?php echo $resultset['product_name'] ?> </td>
      <td><?php echo $resultset['product_price'] ?></td>
      <td><img width="100" height="100" src='<?php echo IMAGE_UPLOAD_PATH."/{$resultset['file_name']}" ?>' alt="BROKEN" class="rounded img-thumbnail"></td>
      <td><?php echo $resultset['brand_name'] ?></td>
      <td><?php echo $resultset['category_name'] ?> </td>
      <td> 
        <a class="btn btn-primary" href="edit_product.php?product_id=<?php echo $resultset['product_id'] ?>">Edit</a> 
        <a class="btn btn-danger delete-button" href="#" data-uniqueId=<?php  echo $resultset['product_id'] ?> data-tablename="product">Delete </a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
<?php }?>
<!-- PAGINATION NAV BAR -->

<script type="application/javascript" src="ajax.js"></script>