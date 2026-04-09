<?php
include("db.php");
function countstaffname($conn) {
$sql = "SELECT COUNT(*) AS total FROM tblstaff";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
return $row['total'];
}
return 0;
}

?>

