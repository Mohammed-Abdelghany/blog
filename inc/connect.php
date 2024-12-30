<?php

session_start();
// تفاصيل الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";
$password = "";
$dbname = "mydb";
$port = 3307;

// تعطيل عرض الأخطاء في الصفحة
mysqli_report(MYSQLI_REPORT_OFF);

// محاولة الاتصال بقاعدة البيانات
$conn = mysqli_connect($host, $user, $password, $dbname, $port);

// التحقق من الاتصال
if (!$conn) {
  // إذا فشل الاتصال، إعادة التوجيه إلى صفحة الخطأ
  header("Location: ../errors.php");
  exit();
}

// إذا كان الاتصال ناجحًا



if (
  !isset($_SESSION['login']) &&
  basename($_SERVER['PHP_SELF']) != 'Login.php' &&
  basename($_SERVER['PHP_SELF']) != 'register.php'
) {
  header("Location: ../index.php");
  exit();
}