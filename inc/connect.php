<?php
session_start();
$conn = new mysqli("localhost", "root", "", "mydb", 3307);
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}



if (
  !isset($_SESSION['login']) &&
  basename($_SERVER['PHP_SELF']) != 'Login.php' &&
  basename($_SERVER['PHP_SELF']) != 'register.php'
) {
  header("Location: Login.php");
  exit();
}