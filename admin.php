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
    <div class="header-main-logo">
        <a href="index.html"><img src="images/Logo.jpeg" alt="Logo"></a>
    </div>
    <nav class="header-main-nav">
        <h1><a href="admin.php">ADMIN DASHBOARD</a></h1>
    </nav>
</header>

<body class="admin-page">
    <div class="admin-container">
        <div class="admin-button">
            <a href="add_product.php" class="Add-Product">Add Product</a>
            <a href="remove_product.php" class="Remove-Product">Remove Product</a>
            <a href="view_orders.php" class="view-orders">View Orders</a>
        </div>
    </div>
</body>

</html>