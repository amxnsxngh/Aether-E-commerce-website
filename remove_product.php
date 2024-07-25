<?php
require_once 'includes/session_config.php';
require_once 'includes/remove_view.php';

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
    <div class="header-main-logo">
        <a href="index.html"><img src="images/Logo.jpeg" alt="Logo"></a>
    </div>
    <nav class="header-main-nav">
        <h1><a href="admin.php">ADMIN DASHBOARD</a></h1>
    </nav>
</header>
<body class="add_products">
    <div class="Form-container">
        <form action="includes/remove_product.inc.php" method="POST">
        
        <h1>Remove Product</h1>

        <div class="text-box">
            <input type="text" name= "product_name" placeholder="Product Name" >
        </div>

        <button type="submit" class="login-button">REMOVE</button>

        </form>
        <?php
        check_remove_success()
        ?>

    </div>
    
</body>
</html>