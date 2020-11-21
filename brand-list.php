<title> brands </title>
<!-- PHP CODE -->
<?php
require_once "header.php";
require_once "navigation.php";
require_once "connection.php";

$category_query = 'SELECT * FROM category';
$result = mysqli_query($link, $category_query);
$categories = mysqli_fetch_all($result,1);

$query = "SELECT brands.brand_id, brands.brand_name FROM brands order by brand_id";
$result = mysqli_query($link, $query);
$numOfRecords = mysqli_num_rows($result);
$perPageRecords = 4;
$numOfPages = ceil( $numOfRecords/$perPageRecords );
$offset = isset($_GET['offset']) ? $_GET['offset'] - 1 : 0;
$offsetRecords = $offset * $perPageRecords;

$query = "SELECT brands.brand_id, brands.brand_name FROM brands order by brand_id LIMIT $offsetRecords , $perPageRecords";
$result = mysqli_query($link, $query);
?>
<!-- EDIT BRAND -->
<div class="container-fluid" id="edit_form" style="display: none;">
<form method="POST" id='editForm' >
<h4>EDIT BRAND</h4>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <input type="text" name="edit_brand_name" class="form-control" id="edit_brand_name">
    </div>
    <div class="col-md-4 mb-3">
    <input class="btn btn-primary edit-brand-button" type="submit" value="EDT BRAND" name="submit">
    </div>
  </div>
</form>
</div>
<!-- ADD BRAND -->
<div class="container-fluid">
<form method="POST" id='addForm'>
<h4>ADD BRAND</h4>
  <div class="form-row">
    <div class="col-md-4 mb-3">
      <input type="text" name="add_form" placeholder="ADD..." class="form-control" id="add_form">
    </div>

    <div class="col-md-4 mb-3">
      <select name="category" class="form-control" id="select_category">
        <?php 
        foreach($categories as $category){
            echo "<option value=".$category['category_id'].">".$category['category_name']."</option>";
        }
        ?> 
    </select> 
    </div>
    
    <div class="col-md-4 mb-3">
    <input type="hidden" value="brands" id="tableName">
    <input class="btn btn-primary add-button" type="submit" value="ADD BRAND" name="submit">
    </div>
  </div>
</form>
</div>

<!-- FILTER AND SORTING PHP CODE -->
<?php 
if(isset($_POST['order_by'])){
  $query = "SELECT brands.brand_id, brands.brand_name FROM brands order by {$_POST['order_by']} {$_POST['order_with']} ";
  $result = mysqli_query($link, $query);
}
if(isset($_POST['filter_submit']) ){
  if(!empty(trim($_POST['filter_by']))){
      $query = "SELECT brands.brand_id, brands.brand_name FROM brands WHERE brand_name LIKE  '%{$_POST['filter_by']}%' or category_name LIKE  '%{$_POST['filter_by']}%' ";
      $result = mysqli_query($link, $query);
    }else{
      $query = "SELECT brands.brand_id, brands.brand_name FROM brands order by brand_id";
      $result = mysqli_query($link, $query);
    }
}
?>

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
          <option value="brand_name">BY NAME</option>
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
    
<!-- BRANDS TABLE -->
<?php
if(isset($result->num_rows) && $result->num_rows>0){ ?>
<div class="container-fluid">
<h3> BRANDS TABLE </h3>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">BRAND ID</th>
      <th scope="col">BRAND NAME</th>
      <th scope="col">ACTION</th>
    </tr>
  </thead>
  <tbody>
  <?php while($resultset = mysqli_fetch_assoc($result)){  ?>
    <tr>
      <th><?php echo $resultset['brand_id'] ?></th>
      <td><?php echo $resultset['brand_name'] ?> </td>
      <td> 
        <a class="btn btn-primary edit-button" href="#" data-uniqueId=<?php echo $resultset['brand_id']?> data-tablename="brands">Edit</a> 
        <a class="btn btn-danger delete-button" href="#" data-uniqueId=<?php  echo $resultset['brand_id'] ?> data-tablename="brands">Delete </a>
      </td>
    </tr>
    <?php } ?>
  </tbody>
</table>
</div>
<?php }?>

<!-- PAGINATION NAV BAR -->
<nav aria-label="...">
<ul class="pagination">
  <?php for($i=1; $i <= $numOfPages; $i++){ ?>
        <li class="page-item ">
        <a class="page-link" href="brand-list.php?offset=<?php echo $i ?>"><?php echo $i ?></a>
        </li>
  <?php } ?>
</ul>
</nav>

<script type="application/javascript" src="ajax.js"></script>