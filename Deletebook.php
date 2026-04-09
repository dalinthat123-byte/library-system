<?php
require 'db.php';

$Isbn = $_GET["Isbn"];

$sql = "DELETE FROM tblbook WHERE Isbn = ?";

$stmt = $conn->prepare($sql);

$stmt->bind_param("s", $Isbn);

if($stmt->execute()){
    header("Location: book.php");
    exit(); 
} else {
    echo "Error deleting record: " . $conn->error;
}
?>