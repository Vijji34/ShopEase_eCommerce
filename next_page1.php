<?php
session_start();
include 'includes/db.php'; // Include the database connection

// Fetch products from the database
$stmt = $conn->query("SELECT * FROM product1");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<style>
   .back-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 10px;
            
        }
        .back-actions a {
            background-color:rgb(241, 244, 245);
            color: black;
            padding: 6px 10px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.6em;
            transition: background-color 0.3s;
        }
        .back-actions a:hover {
            background-color:#0e0ca3;
            color: white;
        }
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Store</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="header-container">
        <div class="back-actions">
            <a href="index.php">Back to Shop</a>
            
        </div>
            <h1>Welcome to Our Store</h1>
            <nav>
                <a href="pages/login.php">Login</a>
                <a href="pages/register.php">Register</a>
                <a href="pages/cart.php" class="cart-link">
                    <img src="images/cart.png" alt="Cart" class="cart-icon">
                    Cart
                </a>
                <form method="POST" style="display: inline;">
                    <button type="submit" name="logout" class="logout-button">Logout</button>
                </form>
            </nav>
        </div>
    </header>
    
    <div class="main-container">
        <main>
            <h2>Products</h2>
            <div class="product-list">
            <?php if (empty($products)) : ?>
                <p>No products available.</p>
            <?php else : ?>
                <?php foreach ($products as $product) : ?>
                    <div class="product">
                        <h3><?= htmlspecialchars($product['name']); ?></h3>
                        <p>Price: $<?= number_format($product['price'], 2); ?></p>
                        <p><?= htmlspecialchars($product['description']); ?></p>
                        
                        <?php if (!empty($product['image'])) : ?>
                            <a href="next_page2.php?product_id=<?= $product['id']; ?>">
                        
                                <img  src="images/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>" class="product-image" >
                            </a>
                        <?php endif; ?>
                       
                        <form method="POST" action="pages/cart.php">
                            <input type="hidden" name="product_id" value="<?= $product['id']; ?>">
                            <button type="submit" name="add_to_cart" class="add-to-cart-button">Add to Cart</button>
                        </form>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </main>
    </div>
    <footer>
        <p>&copy; <?= date('Y'); ?> Online Store. All rights reserved.</p>
    </footer>
</body>
</html>