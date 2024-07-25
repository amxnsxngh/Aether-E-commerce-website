<?php
session_start();
require_once "includes/database.php";

if (!isset($_SESSION['user_id'])) {
    $_SESSION['cart_message'] = "You need to log in to add items to your cart.";
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

try {
    // Retrieve cart items
    $queryCart = "SELECT uc.product_id, uc.quantity, p.product_name, p.product_price, p.image_path
                  FROM user_cart uc
                  JOIN products p ON uc.product_id = p.product_id
                  WHERE uc.user_id = :user_id";
    $stmtCart = $pdo->prepare($queryCart);
    $stmtCart->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmtCart->execute();
    $cart_items = $stmtCart->fetchAll(PDO::FETCH_ASSOC);

    // Calculate total price
    $total_price = 0;
    foreach ($cart_items as $item) {
        $total_price += $item['product_price'] * $item['quantity'];
    }

} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="stylesheet" href="global.css">
  <link rel="stylesheet" href="content.css">
</head>

<header class="header-main">
    <div class="header-main-logo"><a href="index.html"><img src="images/Logo.jpeg"></a></div>
    <nav class="header-main-nav">
        <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="category.html">Products</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="login.php">Login/Logout</a></li>
        </ul>
    </nav>
</header>

<body class="checkout_page">
    <main class="checkout_page">
        <div class="Form-container">
            <h1>Order Summary</h1>
            <?php foreach ($cart_items as $item): ?>
                <div class="order_item">
                    <div class="item_details">
                        <p class="product_name"><?php echo $item['product_name']; ?></p>
                        <p class="product_price">Price: R<?php echo $item['product_price']; ?></p>
                        <p class="product_quantity">Quantity: <?php echo $item['quantity']; ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="order_total">
                <p>Grand Total: R<?php echo number_format($total_price, 2); ?></p>
            </div>
        </div>

        <div class="Form-container">
            <h1>Customer Information</h1>
            <form action="includes/place_order.php" method="POST">

                <div class="text-box">
                    <input type="text" name= "username" placeholder="Name" >
                </div>

                <div class="text-box">
                    <input type="number" name= "phone_number" placeholder="Phone Number" >
                </div>

                <div class="text-box">
                    <input type="email" name= "email" placeholder="email" >
                </div>

                <div class="text-box">
                    <input type="text" name= "address" placeholder="Address" >
                </div>

                <div class="drop-down">
                    <select name= "payment_method">
                        <option value="" disabled selected>Payment Method</option>
                        <option value="Cash">Cash on Delivery</option>
                        <option value="Card">Card on Delivery</option>
                    </select>
                </div>

                <button type="submit" class="login-button">Confirm Order</button>
            </form>
        </div>
    </main>
</body>