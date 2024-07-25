<?php
require_once 'includes/session_config.php';
require_once 'includes/login_view.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Aether</title>
  <link rel="stylesheet" href="global.css">
  <link rel="stylesheet" href="content.css">
</head>

<header class="header-main">
    <div class="header-main-logo"><a href="index.html"><img src="images/Logo.jpeg"></a></div>
    <nav class="header-main-nav">
            <ul>
                <li><a href="category.html">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Login/Logout</a></li>
            </ul>
    </nav>
</header>

<body class="login-page">
    <div class="Form-container">
      <form action="includes/login.inc.php" method="post">
        <h1>Login</h1>
        <div class="text-box">
          <input type="email" name= "email" placeholder="Email Address" >
        </div>
        <div class="text-box">
          <input type="password" name= "password" placeholder="Password" >
        </div>
        <button type="submit" class="login-button">Login</button>
        <div class="Register-link">
          <p>
            Don't have an account? <a href="register.php">Register</a>
          </p>
        </div>
  
      <?php
      check_login_errors();
      ?>
      </form>
      <form action="includes/logout.php" method="POST">
        <button class="logout-button">Logout</button>
      </form>
    </div>
</body>

</html>