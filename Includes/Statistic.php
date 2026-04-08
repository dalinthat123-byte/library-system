<?php
include("db.php");
function countUser($conn) {
$sql = "SELECT COUNT(*) AS total FROM tblstaff";
$result = $conn->query($sql);
if ($result && $row = $result->fetch_assoc()) {
return $row['total'];
}
return 0;
}

?>