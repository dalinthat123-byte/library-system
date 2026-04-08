<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Staff</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bungee&family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
<link href="styles/bootstrap.min.css" rel="stylesheet">
<link href="styles/layout.css" rel="stylesheet">
</head>
<body>
<?php include("includes/Sidebar.php"); ?>
<div class="main">
<?php include("includes/topbar.php"); ?>
<div class="card-box">
<h5>Edit Staff Form</h5>
<?php
if(!isset($_POST['btnsubmit'])){
    require("db.php");
    $StaffID = $_GET['StaffID'];
    $sql = "SELECT * FROM tblstaff WHERE StaffID=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$StaffID);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row=$result->fetch_assoc()){
?>
<form method="post" >
    <div class="col-md-6 mb-3">
        <label for="StaffName" class="form-label">StaffName</label>
        <input type="text" class="form-control" id="StaffName" name="StaffName" value="<?php echo($row['StaffName']) ?>">
    </div>
    <div class="col-md-6 mb-3">
        <label for="username" class="form-label">UserName</label>
        <input type="text" class="form-control" id="username" name="username" value="<?php echo($row['Username']) ?>">
    </div>
    <div class="col-md-6 mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
    <div class="col-md-6 mb-3">
        <label for="cpassword" class="form-label">Confirm-Password</label>
        <input type="password" class="form-control" id="cpassword" name="cpassword">
    </div>
    <button type="submit" class="btn btn-success" name="btnsubmit">Save</button>
    <button type="reset" class="btn btn-secondary">Reset</button>
</form>
<?php 
    } 
} 

if(isset($_POST['btnsubmit'])){
    require("db.php");
    $StaffID = $_GET['StaffID'];
    $StaffName = $_POST["StaffName"];
    $Username = $_POST["username"]; // Fixed: matched to lowercase 'name' in HTML
    $Password = $_POST["password"]; 
    $cPassword = $_POST["cpassword"]; 

    if(!empty($Password)){
        if($Password != $cPassword){ 
            die("<p style='color:red;'>password and con-password not match!!</p>"); 
        }
        $sql = "UPDATE tblstaff SET StaffName=?, Username=?, Password=? WHERE StaffID=?";
        $stmt = $conn->prepare($sql);
        $hashedPass = md5($Password);
        $stmt->bind_param("sssi", $StaffName, $Username, $hashedPass, $StaffID);
    } else {
        $sql = "UPDATE tblstaff SET StaffName=?, Username=? WHERE StaffID=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssi", $StaffName, $Username, $StaffID);
    }

    if($stmt->execute()){
        header("Location:staff.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
    }
}
?> </div>
</div>
</body>
</html>