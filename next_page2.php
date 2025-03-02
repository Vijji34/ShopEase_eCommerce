<?php
session_start();
include 'includes/db.php'; // Include the database connection

// Fetch products from the database
$stmt = $conn->query("SELECT * FROM product1_sub1");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<style>
/* General Styling */
body {
    font-family: 'Poppins', sans-serif;
    background-color: #f8f8f8;
    color: #333;
    margin: 0;
    padding: 0;
}

/* Container */
.container {
    width: 90%;
    height: auto;
    max-width: 1200px;
    margin: 20px auto;
}

/* Store Title */
h1 {
    font-size: 32px;
    font-weight: 700;
    color: #222;
    text-align: left;
    margin-bottom: 20px;
}

/* Product Grid */
.product-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 20px;
}

/* Product Card */
.product-card {
    background: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease-in-out;
}

.product-card:hover {
    transform: translateY(-5px);
}

/* Product Image */
.product-card img {
    width: 100%;
    height: 60%;
    display: block;
    border-bottom: 1px solid #ddd;
}

/* Product Details */
.product-card h2 {
    font-size: 20px;
    font-weight: 600;
    margin: 15px;
    color: #444;
}

/* Price Styling */
.price {
    font-size: 18px;
    font-weight: 600;
    color: #e91e63;
    margin: 0 15px;
}

.original-price {
    text-decoration: line-through;
    color: #888;
    margin-left: 10px;
}

.discount {
    color: green;
    font-weight: bold;
    margin-left: 5px;
}

/* Stock Availability */
.stock {
    font-size: 14px;
    color: #666;
    margin: 20px 15px;
}

/* Buy Now Button */

/* Button Container */
.button-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 20px 15px;
    padding-top: 40px;
}

/* Buttons */
.btn, .btn-cart {
    flex: 1;
    margin: 10px 15px;
    text-align: center;
    gap: 20px;
    padding: 17px 30px;
    font-weight: bold;
    border-radius: 5px;
    transition: background 0.3s ease-in-out;
    text-decoration: none;
    border: none;

    cursor: pointer;
}

/* Buy Now Button */
.btn {
    background: #984ca5;
    color: white;
    margin: 20px 15px;
}

.btn:hover {
    background: #0e0ca3;
}

/* Add to Cart Button */
.btn-cart {
    background: #ff9800;
    color: white;
}

.btn-cart:hover {
    background: #e68900;
}
.back-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 10px;
            
        }
        .back-actions a {
            background-color:rgb(241, 235, 241);
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
            <a href="next_page1.php">Back to Shop</a>
            
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
    <div class="container">
    <h1>Jewelry Store</h1>
    <div class="product-grid">
        <?php foreach ($products as $product) : ?>
            <div class="product-card">
                <img src="images/<?= htmlspecialchars($product['image_url']); ?>" alt="<?= htmlspecialchars($product['product_name']); ?>">
                <h2><?= htmlspecialchars($product['product_name']); ?></h2>
                <p class="price">
                    ₹<?= number_format($product['price'], 2); ?>
                    <span class="original-price">₹<?= number_format($product['original_price'], 2); ?></span>
                    <span class="discount"><?= $product['discount_percentage']; ?>% off</span>
                </p>
                <p class="stock">Stock: <?= $product['stock']; ?> available</p>
                <a href="order.php" class="btn">Buy Now</a>
                
                
            </div>
        <?php endforeach; ?>
    </div>
</div>

</body>
</html>
