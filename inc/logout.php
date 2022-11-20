<?php
session_start(); 
unset($_SESSION["loggedin"]);
unset($_SESSION["id"]);
unset($_SESSION["username"]);
$_SESSION['alert']='<div class="alert alert-success text-center"" role="alert">
Successeful Logout
</div>';
header("Location:loginPage.php"); 
?>