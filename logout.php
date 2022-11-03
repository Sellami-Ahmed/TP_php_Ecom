<?php
session_start(); 
unset($_SESSION['UserData']['Username']);
$_SESSION['alert']='<div class="alert alert-success text-center"" role="alert">
Successeful Logout
</div>';
header("Location:loginPage.php"); 
?>