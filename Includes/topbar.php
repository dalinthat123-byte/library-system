<div class="topbar d-flex justify-content-between">
<h5>Build Bright Library</h5>
<?php
session_start();
if(isset($_SESSION['staffname'])){
echo("<div>Welcome, " . $_SESSION['staffname'] . "</div>");
}else{
header("Location:login.php");
}
?>
</div>
