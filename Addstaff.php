<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Add Staff</title>

 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bungee&family=Fredoka:wght@300..700&display=swap"
        rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">

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