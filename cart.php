<?php
session_start();
require_once "includes/database.php";


if (!isset($_SESSION['user_id'])) {
    // User is not logged in, display message and optionally redirect to login page
    $_SESSION['cart_message'] = "You need to log in to add items to your cart.";
    header("Location: login.php"); // Redirect to login page
    exit(); // Ensure script stops executing after redirect
}


$user_id = $_SESSION['user_id'];

try {
    $query = "SELECT user_cart.*, products.product_name, products.product_price, products.image_path 
              FROM user_cart 
              JOIN products ON user_cart.product_id = products.product_id
              WHERE user_cart.user_id = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->execute();
    $cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

<body class="cart_page">
  <main class="cart_page">
        <?php if (!empty($cart_items)): ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="cart_card">
                    <div class="cart_image">
                        <img src="<?php echo $item['image_path']; ?>" alt="Product Image" draggable="false">
                    </div>
                    <div class="cart_text">
                        <div class="product_name">
                            <p><?php echo $item['product_name']; ?></p>
                        </div>
                        <div class="product_price">
                            <p>R<?php echo $item['product_price']; ?></p>
                        </div>
                        <div class="product_quantity">
                            <p>Quantity: <?php echo $item['quantity']; ?></p>
                        </div>
                    </div>
                    <div class="cart_buttons">
                        <form action="includes/remove_from_cart.php" method="post">
                            <input type="hidden" name="cart_item_id" value="<?php echo $item['cart_id']; ?>">
                            <button type="submit" class="remove_button">Remove from Cart</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>    
            <div class="cart_total_button">
                <div class="continue_shopping">
                    <a href="category.html">Continue Shopping</a>
                </div>       
                <div class="cart_total">
                    <p>Total: R<?php echo number_format($total_price, 2); ?></p>
                </div>
                <div class="checkout_button">
                    <form action="checkout.php" method="post">
                        <button type="submit" class="checkout_button">Proceed to Checkout</button>
                    </form>
                </div>        
            </div>
            
            
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
  </main>
</body>
</html>

