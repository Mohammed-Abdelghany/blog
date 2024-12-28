<?php
require_once "connect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap"
    rel="stylesheet">

  <title>Blog</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <!--

    TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing

    -->

  <!-- Additional CSS Files -->
  <link rel="stylesheet" href="assets/css/fontawesome.css">
  <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
  <link rel="stylesheet" href="assets/css/owl.css">

</head>

<body>

  <!-- ***** Preloader Start ***** -->
  <div id="preloader">
    <div class="jumper">
      <div></div>
      <div></div>
      <div></div>
    </div>
  </div>
  <!-- ***** Preloader End ***** -->

  <!-- Header -->
  <header class="padding-0">
    <nav class="navbar navbar-expand-lg">
      <div class="container">
        <!-- Branding -->
        <a class="navbar-brand" href="index.php">
          <h2><em>Blog</em></h2>
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive"
          aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Collapsible Navbar -->
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <!-- All Posts -->
            <?php if (basename($_SERVER['PHP_SELF']) == 'index.php') {
            ?>
            <li class="nav-item active"><?php }; ?>
              <a class="nav-link" href="index.php">All Posts
                <span class="sr-only">(current)</span>
              </a>
            </li>

            <!-- Add New Post -->
            <?php if (basename($_SERVER['PHP_SELF']) == 'addPost.php') {
              ?>
            <li class="nav-item active"><?php }; ?>
              <a class="nav-link" href="addPost.php">Add New Post</a>
            </li>

            <!-- Language: English -->
            <!-- <?php if (basename($_SERVER['PHP_SELF']) == 'q.php') {
                      ?>
            <li class="nav-item active"><?php }; ?>
              <a class="nav-link" href="#">English</a>
            </li> -->

            <!-- Language: Arabic -->
            <!-- <?php if (basename($_SERVER['PHP_SELF']) == 's.php') {
                      ?>
            <li class="nav-item active"><?php }; ?>
              <a class="nav-link" href="#">العربية</a>
            </li> -->

            <!-- Logout -->

            <li class="nav-item ">
              <a class="nav-link" href="Login.php">Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </header>