<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>AddUser</title>
<!-- Bootstrap -->
<link href="styles/bootstrap.min.css" rel="stylesheet">
<link href="styles/layout.css" rel="stylesheet">
</head>
<body>
<!-- Sidebar -->
<?php include("includes/Sidebar.php"); ?>
<!-- Main Content -->
<div class="main">
<!-- Topbar -->
<?php include("includes/Topbar.php"); ?>
<div class="card-box">
<h5>Create User Form</h5>
<form method="post">
<div class="col-md-6 mb-3">
<label class="form-label">Staff Name</label>
<input type="text" class="form-control" name="staffname">
</div>
<div class="col-md-6 mb-3">
<label class="form-label">User Name</label>
<input type="text" class="form-control" name="username">
</div>
<div class="col-md-6 mb-3">
<label class="form-label">Password</label>
<input type="password" class="form-control" name="password">
</div>
<div class="col-md-6 mb-3">
<label class="form-label">Confirm Password</label>
<input type="password" class="form-control" name="cpassword">
</div>
<button type="submit" class="btn btn-success" name="btnsubmit">Save</button>
<button type="reset" class="btn btn-secondary">Reset</button>
</form>
<?php
if(isset($_POST['btnsubmit'])){
require("db.php");
$staffname = $_POST["staffname"];
$username = $_POST["username"];
$password = $_POST["password"];
$cpassword = $_POST["cpassword"];
if($password != $cpassword){ die("<p style='color:red;'>password and con-password not match!!</p>"); }
$sql = "INSERT INTO tblstaff(staffname,username, password) VALUES(?,?,?);";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss",$staffname,$username,md5($password));
if($stmt->execute() ==true){ header("Location:staff.php"); }
else{ echo "Error: " . $sql . "<br>" . $conn->error; }
}
?>
</div>
</div>
</body>
</html>