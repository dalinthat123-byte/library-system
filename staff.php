<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Staffs</title>

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
<?php $text = isset($_POST['txtsearch']) ? $_POST['txtsearch'] : null; ?>
<?php $filterby = isset($_POST['filterby']) ? $_POST['filterby'] : null; ?>
<form method="post">
<input type="radio" name="filterby" id="rbtid" value="StaffID" <?php echo($filterby=='StaffID' ? 'checked' : null) ?>>
<label for="rbtid">StaffID</label>
<input type="radio" name="filterby" id="rbtStaffName" value="StaffName" <?php echo($filterby=='StaffName' ? 'checked' : null) ?>>
<label for="rbtStaffName">Staff Name</label>
<input type="text" name="txtsearch" value="<?php echo($text) ?>">
<input type="submit" name="btnsearch" value="Search" class='btn btn-sm btn-primary'>
<input type="submit" name="btnreset" value="Reset" class='btn btn-sm btn-secondary'>
</form>
<table class="table table-bordered table-hover mt-3">
<thead>
<tr>
<th>StaffID</th>
<th>StaffName</th>
<th>Username</th>
<th>Password</th>
<th>Options</th>
</tr>
</thead>
<tbody>
<?php
require("db.php");
$sql = "SELECT * FROM tblstaff ";
//Search
if(isset($_POST["btnsearch"])){
switch($filterby){
case 'StaffID': $sql .= " where StaffID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s',$text);
break;
case 'StaffName': $sql .= " WHERE StaffName like CONCAT('%',?,'%')";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s',$text);
break;
}
}else{
$stmt = $conn->prepare($sql);
}
$stmt->execute();
$result = $stmt->get_result();
while($row = $result->fetch_assoc()){
echo "<tr>";
echo "<td>" . $row["StaffID"] . "</td>";
echo "<td>" . $row["StaffName"] . "</td>";
echo "<td>" . $row["Username"] . "</td>";
echo "<td>" . $row["Password"] . "</td>";
echo "<td>
<a href='Editstaff.php?StaffID=" . $row["StaffID"] . "' class='btn btn-sm btn-warning'>Edit</a> |
 <a href='Deletestaff.php?StaffID=" . $row["StaffID"] . "' class='btn btn-sm btn-danger'
 onclick='return confirm(\"Sure?\");'>Delete</a>
</td>";
echo "</tr>";
}
?>
</tbody>
</table>
<p>
<a href="Addstaff.php" class="btn btn-sm btn-success">AddNew Staff</a>
</p>
</div>
</div>
</body>
</html>