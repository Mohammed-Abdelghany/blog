<?php
require_once('inc/connect.php');



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <style>
  * {
    box-sizing: border-box;
  }

  .nav .links a:hover,
  button:hover {
    background-color: #8000ff;
  }

  body {
    display: flex;
    flex-direction: column;
    align-content: center;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 100px;
    padding: 20px;
    background-color: #607d8b4a;
  }

  .nav {
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 100px;
    padding: 10px;
    margin: 0;
  }

  .nav .links {
    width: 15%;
    display: flex;
    justify-content: space-around;
  }

  .nav .links a {
    color: white;
    padding: 4px 10px;
    background-color: #03a9f47a;
    text-decoration: none;
    border-radius: 4px;
    transition: all 1s;
  }

  .input {
    outline: none;
    border: none;
    width: 300px;
    height: 45px;
    border-radius: 10px;
    padding: 10px;
  }

  .form {
    width: 430px;
    height: 425px;
    display: flex;
    flex-direction: column;
    align-items: center;
    align-content: center;
    justify-content: space-between;
    background-color: rgba(255, 255, 255, 0.423);
    backdrop-filter: blur(30px);
    padding: 30px;
    -webkit-filter-blur: 10%;
    border-radius: 30px;
  }

  form button {
    border: none;
    padding: 10px 20px;
    border-radius: 10px;
    color: white;
    background-color: #03a9f47a;
    transition: all 1s;
  }

  form span a {
    text-decoration: none;
    color: black;
    font-weight: bold;
  }

  .remember {
    width: 135px;
    height: 32px;
    display: flex;
    flex-direction: row;
    align-content: center;
    justify-content: space-around;
    align-items: center;
  }

  .wrong {
    color: red;
  }
  </style>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>

<body>
  <div class="nav">
    <div class="links">
      <!-- <a href="Login.php">Log in</a> -->
      <!-- <a href="Register.php">Register</a> -->
    </div>
  </div>
  <div>
    <?php
    require_once 'inc/connect.php';

    ?>

    <form class="form" action="register.php" method="post">

      <h3>Register Here</h3>
      <input placeholder="Enter Name" class="input" type="text" name="name" id="" value="">
      <input placeholder="Enter Email" class="input" type="email" name="email" id="" value="">
      <input class="input" placeholder="Enter Password" type="password" name="password" id="">
      <input class="input" placeholder="Enter your phone " type="text" name="phone" id="">
      <button type="submit" name="submit">Register</button>



    </form>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
      $name = trim($_POST['name']);
      $email = trim($_POST['email']);
      $password = $_POST['password'];
      $phone = $_POST['phone'];
      if (empty($name) || empty($email) || empty($password) || empty($phone)) {
        $_SESSION['errors']['register'] = "All fields are required";
      } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['errors']['email'] = "Invalid email format";
      } elseif (strlen($phone) !== 11) {
        $_SESSION['errors']['phone'] = "phone must be at least 11 numbers";
      } elseif (strlen($password) < 8) {
        $_SESSION['errors']['password'] = "Password must be at least 8 characters long";
      } else {

        $sql_email = "SELECT email FROM users WHERE email = '$email'";
        $sql = "INSERT INTO users (name, email, password, phone) VALUES ('$name', '$email', '$password', '$phone')";
        $result_email = mysqli_query($conn, $sql_email);
        if (!mysqli_num_rows($result_email) == 1) {
          if (empty($_SESSION['errors'])) {
            if (mysqli_query($conn, $sql)) {



    ?>

    <?php
              $_SESSION['newaccount'] = 'congrats now U have account plese login in ';
              header('Location: Login.php');
            }
          }
        } else {
          $_SESSION['errors']['email'] = "Email already exists";
        }
      }
    }
    ?>

  </div>
  <a href="Login.php">Login</a>
  <?php
  if (!empty($_SESSION['errors'])) { ?>
  <?php foreach ($_SESSION['errors'] as $error) {
    ?>

  <div class="alert alert-danger" style="border-radius: 10px; width:300px" role="alert">
    <?php echo $error; ?>

  </div>
  <?php
    }
    unset($_SESSION['errors']);
  }

  ?>
</body>

</html>