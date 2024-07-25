<?php
session_start();
require_once "includes/database.php";

if(isset($_GET['category_id']) && is_numeric($_GET['category_id'])) {
    // Retrieve and sanitize category_id from URL
    $category_id = htmlspecialchars($_GET['category_id']);

    try {
        // SQL query to fetch products based on category ID
        $query = "SELECT * FROM products WHERE category_id = :category_id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->execute();
        $products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch all products

    } catch (PDOException $e) {
        // Handle database errors if any
        die("Error: " . $e->getMessage());
    }
} else {
    // Redirect or show error message if category_id parameter is missing or invalid
    header("Location: index.html"); // Redirect to homepage or appropriate error page
    exit(); // Stop further execution
}
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
                <li><a href="index.html">Home</a></li>
                <li><a href="category.html">Products</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="login.php">Login/Logout</a></li>
            </ul>
    </nav>
</header>
<body class="productpage">

  <main class="product_page">
    <?php foreach ($products as $product): ?>
    <div class="product_card">
        <div class="image">
            <img src="<?php echo $product['image_path']; ?>" alt="Product Image">
        </div>
        <div class="product_text">
            <div class="product_name">
                <p><?php echo $product['product_name']; ?></p>
            </div>
            <div class="product_description">
                <p><?php echo $product['product_description']; ?></p>
            </div>
            <div class="product_price">
                <p>R<?php echo $product['product_price']; ?></p>
            </div>
        </div>
        <form action="includes/add_to_cart.php" method="post">
            <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">
            <button type="submit" class="add_to_cart">Add to Cart</button>
        </form>
    </div>
    <?php endforeach; ?>
      
  </main>

</body>
</html>
