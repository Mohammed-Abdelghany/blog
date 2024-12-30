<?php session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Database Connection Failed</title>
  <style>
  body {
    margin: 0;
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: #f8d7da;
    color: #721c24;
  }

  .container {
    text-align: center;
    padding: 2rem;
    border: 1px solid #f5c6cb;
    background: #f8d7da;
    border-radius: 8px;
  }

  h1 {
    font-size: 4rem;
    margin: 0;
  }

  p {
    font-size: 1.5rem;
    margin: 1rem 0;
  }

  a {
    display: inline-block;
    margin-top: 1.5rem;
    padding: 0.75rem 1.5rem;
    font-size: 1.2rem;
    color: #fff;
    background-color: #dc3545;
    text-decoration: none;
    border-radius: 5px;
    transition: background-color 0.3s;
  }

  a:hover {
    background-color: #a71d2a;
  }

  @media (max-width: 600px) {
    h1 {
      font-size: 3rem;
    }

    p {
      font-size: 1.2rem;
    }

    a {
      font-size: 1rem;
    }
  }
  </style>
</head>

<body>
  <div class="container">
    <h1>Error</h1>
    <p>We're sorry, but the server connection has failed.</p>
    <a href="index.php">Try Again</a>
  </div>
</body>

</html>