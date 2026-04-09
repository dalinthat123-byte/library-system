<?php
require 'db.php';
$ID= $_GET["ID"];
$sql = "delete from tblmember where ID=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i",$ID);
if($stmt->execute() ==true){
header("Location:member.php");
}else{
echo "Error: " . $sql . "<br>" . $conn->error;
}
?>