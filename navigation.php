<!DOCTYPE html>
<html>
<?php require_once("header.php");?>
<body>
<div class="container-fluid">
<nav class="navbar navbar-expand-lg navbar-light bg-info">
  <a class="navbar-brand" href="index.php">STORE</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
    <!-- <div class="login_nav_bar"> -->
      <li class="nav-item active login_nav_bar">
        <a class="nav-link" href="brand-list.php">BRANDS <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item login_nav_bar">
        <a class="nav-link" href="category-list.php">CATEGORIES</a>
      </li>
      <li class="nav-item login_nav_bar">
        <a class="nav-link" href="product-list.php">PRODUCTS</a>
      </li>
      <li class="nav-item not_login_nav_bar">
        <a class="nav-link disabled" href="#">LOGIN/REGISTER</a>
      </li>
    </ul>
  </div>
</nav>
</div>
</body>
</html>