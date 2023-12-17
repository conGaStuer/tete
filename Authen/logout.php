<?php 
session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] != "" ) {
    unset($_SESSION["username"]);
}
if(isset($_SESSION['password']) && $_SESSION['password'] != "" ) {
    unset($_SESSION["password"]);
}
header("Location: ../Authen/login.php");