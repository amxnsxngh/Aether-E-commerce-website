<?php
session_start(); // Start the session to access session variables

// Include database connection
require_once 'includes/database.php'; // Adjust the path as per your file structure

// Initialize variables
$user_id = null;
$error_message = null;
$last_order_id = null; // Initialize variable to store last added order ID
$user_email = null; // Initialize variable to store user's email address

// Check if user_id session variable is set
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    // Set error message if session variable is not set
    $error_message = "Error: User session not found. Please log in again.";
}

// Retrieve last added order ID and user's email based on user_id
if ($user_id) {
    try {
        // Query to retrieve the last added order ID and user's email based on user_id
        $stmt = $pdo->prepare("SELECT order_id, email FROM orders WHERE user_id = :user_id ORDER BY order_id DESC LIMIT 1");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Fetch the last added order ID and user's email
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($result) {
            $last_order_id = $result['order_id'];
            $user_email = $result['email'];
        } else {
            $error_message = "No orders found for this user.";
        }

    } catch (PDOException $e) {
        // Handle database query errors
        $error_message = "Database Error: " . $e->getMessage();
    }
} else {
    // Handle case where user_id is not set
    $error_message = "Error: User ID not found in session.";
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
<body class="order_confirmed_page">
    <main class="order_confirmed_page">
        <div class="Form-container">
            <h1>Order Complete</h1>
            <div class="confirm_message">
                <h1>Thank you for shopping with us!</h1>
                <?php if ($last_order_id): ?>
                    <p>Order Reference: <?php echo $last_order_id; ?></p>
                    <?php else: ?>
                        <p><?php echo $error_message; ?></p>
                    <?php endif; ?>

                <p>Your order at Aether has been confirmed, a confirmation email will be sent to you at: <p><?php echo htmlspecialchars($user_email); ?></p>
            </div>
            
        </div>
    </main>
</body>
</html>
