<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Member</title>

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

<link href="styles/bootstrap.min.css" rel="stylesheet">
<link href="styles/layout.css" rel="stylesheet">
</head>
<body>
<?php include("includes/Sidebar.php"); ?>
<div class="main">
<?php include("includes/topbar.php"); ?>
<div class="card-box">
<h5>Edit Member Form</h5>
<?php
require("db.php");
$ID = $_GET['ID'];

if(!isset($_POST['btnsubmit'])){
    $sql = "SELECT * FROM tblmember WHERE ID=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $ID);
    $stmt->execute();
    $result = $stmt->get_result();
    if($row = $result->fetch_assoc()){
?>
<form method="post">
    <div class="col-md-6 mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" class="form-control" name="Name" value="<?php echo $row['Name']; ?>" required>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Gender</label>
        <select class="form-select" name="Gender" required>
            <option value="M" <?php if($row['Gender'] == 'M') echo 'selected'; ?>>M</option>
            <option value="F" <?php if($row['Gender'] == 'F') echo 'selected'; ?>>F</option>
            <option value="Other" <?php if($row['Gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select>
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Phone Number</label>
        <input type="text" class="form-control" name="Phone" value="<?php echo $row['Phone']; ?>">
    </div>

    <div class="col-md-6 mb-3">
        <label class="form-label">Join Date</label>
        <input type="date" class="form-control" name="JoinDate" value="<?php echo $row['JoinDate']; ?>">
    </div>

    <button type="submit" class="btn btn-success" name="btnsubmit">Update Member</button>
    <a href="member.php" class="btn btn-secondary">Cancel</a>
</form>
<?php 
    } 
} 

if(isset($_POST['btnsubmit'])){
    $Name = $_POST["Name"];
    $Gender = $_POST["Gender"]; 
    $Phone = $_POST["Phone"]; 
    $JoinDate = $_POST["JoinDate"]; 

    $sql = "UPDATE tblmember SET Name=?, Gender=?, Phone=?, JoinDate=? WHERE ID=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $Name, $Gender, $Phone, $JoinDate, $ID);
    
    if($stmt->execute() ==true){ header("Location:member.php"); }
    else{ echo "Error: " . $sql . "<br>" . $conn->error; }
}
?> 
</div>
</div>
</body>
</html>