<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders</title>
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
<body class="view_orders_page">
    <main class="view_orders_page">
        <?php
            require_once 'includes/view_orders.inc.php';
            display_orders();
        ?>
    </main>
</body>
</html>