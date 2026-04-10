<?php
include("db.php");

// Function to get counts dynamically
function getTableCount($conn, $table) {
    $sql = "SELECT COUNT(*) AS total FROM $table";
    $result = $conn->query($sql);
    if ($result && $row = $result->fetch_assoc()) {
        return $row['total'];
    }
    return 0;
}

$totalStaff = getTableCount($conn, 'tblstaff');
$totalMembers = getTableCount($conn, 'tblmember');
$totalBooks = getTableCount($conn, 'tblbook');
?>