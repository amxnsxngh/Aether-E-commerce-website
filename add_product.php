<?php
require_once 'includes/session_config.php';
require_once 'includes/add_view.php';

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
        <form action="includes/add_product.inc.php" method="POST">
        <h1>Add New Product</h1>
        <div class="text-box">
            <input type="text" name= "product_name" placeholder="Product Name" >
        </div>

        <div class="text-box">
            <input type="text" name= "product_description" placeholder="Product Description" >
        </div>

        <div class="text-box">
          <input type="number" name= "product_price" placeholder="Product Price" >
        </div>

        <div class="text-box">
          <input type="number" name= "product_quantity" placeholder="Quantity" >
        </div>

        <div class="drop-image">
          <input type="text" name= "image_path" placeholder="Image path" >
        </div>

        <div class="drop-down">
            <select name= "category">
                <option value="" disabled selected>Select Category</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
            </select>
        </div>

        <button type="submit" class="login-button">ADD</button>

        </form>
        <?php
        check_add_success()
        ?>

    </div>
    
</body>
</html>