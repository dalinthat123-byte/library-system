<?php
require 'db.php';
$StaffID= $_GET["StaffID"];
$sql = "delete from tblstaff where StaffID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$StaffID);
if($stmt->execute() ==true){
header("Location:staff.php");
}else{
echo "Error: " . $sql . "<br>" . $conn->error;
}
?>