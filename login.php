<!DOCTYPE html>
<html>
<head>
<title>Register</title>
</head>
<body>
<?php
include_once "header.php";
include_once "navigation.php";
include_once "connection.php";
?>
<div class="container">

<form class="well form-horizontal" action=" " method="post"  id="login_form">
<fieldset>

<!-- Form Name -->
<legend><center><h2><b>LOGIN Form</b></h2></center></legend><br>

<!-- Text input-->
<div class="form-group">
    <label class="col-md-4 control-label">E-Mail</label>  
    <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
        <input name="email" placeholder="E-Mail Address" class="form-control"  type="text" id="email">
        </div>
    </div>
</div>

<!-- Text input-->
<div class="form-group">
    <label class="col-md-4 control-label" >Password</label> 
    <div class="col-md-4 inputGroupContainer">
        <div class="input-group">
        <input name="password" placeholder="Password" class="form-control"  type="password" id="password">
        </div>
    </div>
</div>

<!-- Button -->
<div class="form-group">
    <div class="col-md-4"><br>
        <button name="submit" type="submit" class="btn btn-warning">LOGIN</button>
    </div>
</div>

</fieldset>
</form>

</div>
</div>
</body>
</html>

<script type="application/javascript" src="ajax.js"></script>


