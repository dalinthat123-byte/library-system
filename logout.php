<?php
//delete session
session_start();
unset($_SESSION['staffname']);
header("Location:login.php");
?>