    <?php
    require_once 'inc/connect.php';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $email = trim($_POST['email']);
      $password = $_POST['password'];
      if (empty($email)) {

        $_SESSION['errors']['email'] = "Email is required";
      }
      if (empty($password)) {

        $_SESSION['errors']['password'] = "password is required";
      }
      $sql = "SELECT email, `password` , id  FROM users where email = '$email' and password = '$password'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) == 1) {
        $id = mysqli_fetch_assoc($result)['id'];
        $_SESSION['login'] = ["email" => $email, "pssword" => $password, "id" => $id];
        header("location: index.php?id=" . $_SESSION['login']['id']);
        exit();
      } else {

        $_SESSION['errors']['wrong'] = "Wrong email or password";
      }
    } else {
      $_SESSION['errors']['request'] = "bad request";
      unset($_SESSION['login']);
    }



    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login</title>
      <style>
      /* Root Variables for Colors */
      :root {
        --primary-bg: #607d8b4a;
        --primary-color: #03a9f47a;
        --hover-color: #8000ff;
        --text-color: white;
        --border-radius: 10px;
        --transition-time: 0.3s;
      }

      /* Universal Box Sizing */
      * {
        box-sizing: border-box;
      }

      /* Body Styling */
      body {
        display: flex;
        flex-direction: column;
        align-items: center;
        width: 100%;
        min-height: 100vh;
        padding: 20px;
        background-color: var(--primary-bg);
        margin: 0;
      }

      /* Navigation Bar */
      .nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
        padding: 10px;
        height: 100px;
      }

      .nav .links {
        display: flex;
        gap: 10px;
      }

      .nav .links a {
        color: var(--text-color);
        padding: 5px 15px;
        background-color: var(--primary-color);
        text-decoration: none;
        border-radius: var(--border-radius);
        transition: background-color var(--transition-time);
      }

      .nav .links a:hover {
        background-color: var(--hover-color);
      }

      /* Form Styling */
      .form {
        width: 800px;
        padding-top: 200px;
        background-color: rgba(255, 255, 255, 0.42);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        display: flex;
        flex-direction: column;
        gap: 15px;
      }

      .input {
        width: 100%;
        padding: 10px;
        height: 45px;
        border: none;
        border-radius: var(--border-radius);
        outline: none;
      }

      .input:focus {
        border: 2px solid var(--hover-color);
      }

      form button {
        width: 50%;
        padding: 10px;
        border: none;
        border-radius: var(--border-radius);
        color: var(--text-color);
        background-color: var(--primary-color);
        transition: background-color var(--transition-time);
        align-self: center;
      }

      form button:hover {
        background-color: var(--hover-color);
      }

      form span a {
        text-decoration: none;
        color: black;
        font-weight: bold;
      }

      /* Alert Styling */
      .form .container {
        display: flex;
        flex-direction: column;
        gap: 5px;
      }

      .alert {
        border-radius: var(--border-radius);
        background-color: #f8d7da;
        color: #721c24;
        padding: 10px;
        font-size: 13px;
        font-weight: bold;
      }

      /* Remember Checkbox */
      .remember {
        display: flex;
        align-items: center;
        gap: 10px;
      }

      /* Responsive Design */
      @media (max-width: 768px) {
        .form {
          width: 90%;
        }

        .input {
          width: 100%;
        }

        form button {
          width: 100%;
          margin-top: 10px;
        }

        .nav .links {
          flex-direction: column;
          gap: 5px;
        }
      }
      </style>
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    </head>

    <body>



      <form class="form " action="Login.php" method="post">

        <h3 style="position:relative; left:38% ">Login Here</h3>
        <div class="container">

          <input placeholder="Enter Email" class="input" type="email" name="email" id="" value="">
          <?php
          if (!empty($_SESSION['errors']['email'])) {


          ?>
          <div class="alert alert-danger" role="alert">
            <p style="position:relative;top:-2px"><?php echo $_SESSION['errors']['email'];
                                                  }
                                                  unset($_SESSION['errors']['email']) ?>
            </p>

          </div>

        </div>

        <div class="container">

          <input class="input" placeholder="Enter Password" type="password" name="password" id="">
          <?php
          if (!empty($_SESSION['errors']['password'])) {


          ?>

          <div class="alert alert-danger" role="alert">
            <p style="position:relative;top:-2px"><?php echo $_SESSION['errors']['password'];
                                                  }
                                                  unset($_SESSION['errors']['password']) ?> </p>
          </div>
        </div>
        <button type="submit" name="submit">Login</button>

      </form>
      <a href="register.php">Register</a>
      <div class="container">
        <?php
        if (!empty($_SESSION['errors']['wrong'])) { ?>
        <div class="alert alert-danger" role="alert">
          <p style="position:relative;top:-2px"><?php echo $_SESSION['errors']['wrong'];
                                                }
                                                unset($_SESSION['errors']['wrong'])
                                                  ?>

          </p>


        </div>
    </body>

    </html>