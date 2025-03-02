<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include '../includes/db.php';

$user_id = $_SESSION['user_id'];  // Assuming user ID is stored in session

// Handle Add to Cart with Quantity
if (isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = isset($_POST['quantity']) ? (int)$_POST['quantity'] : 1;  // Default to 1 if quantity is not set

    // Check if product is already in the user's cart
    $stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
    $cart_item = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($cart_item) {
        // Update quantity if the product is already in the cart
        $new_quantity = $cart_item['quantity'] + $quantity;
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
        $stmt->execute([$new_quantity, $user_id, $product_id]);
    } else {
        // Add new product to the cart
        $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)");
        $stmt->execute([$user_id, $product_id, $quantity]);
    }
}

// Handle Product Removal from Cart
if (isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    $stmt = $conn->prepare("DELETE FROM cart WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$user_id, $product_id]);
}

// Handle Quantity Update
if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['product_id'];
    $quantity = (int)$_POST['quantity'];

    // Update the quantity in the cart
    $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE user_id = ? AND product_id = ?");
    $stmt->execute([$quantity, $user_id, $product_id]);
}

// Fetch the user's cart items
$stmt = $conn->prepare("SELECT * FROM cart WHERE user_id = ?");
$stmt->execute([$user_id]);
$cart_items = $stmt->fetchAll(PDO::FETCH_ASSOC);

$total_cost = 0;  // Initialize total cost variable
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="css/style.css">
    <style>

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            color: #333;
        }

        header {
    background-color: #984ca5;
    color: white;
    padding: 20px;
    text-align: center;
    position: relative;
}

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0 20px;
    width: 100%; /* Ensures full width */
}

header h1 {
    margin: 0;
    font-size: 2em;
}

/* Updated navigation styling to align buttons in one row */
nav {
    display: flex;
    align-items: center; /* Align buttons vertically centered */
}

nav a, .logout-button {
    color: white;
    text-decoration: none;
    margin: 0 15px;
    font-size: 1em;
    text-transform: uppercase;
    display: inline-block;
}

nav a:hover, .logout-button:hover {
    text-decoration: underline;
}

.logout-button {
    background-color: #ff5733;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.logout-button:hover {
    background-color: #e84e2f;
}

/* Cart Link - Fixed beside Register button */
.cart-link {
    color: white;
    display: flex;
    align-items: center;
    text-decoration: none;
    font-size: 1.1em;
}



.cart-icon {
    width: 25px;
    height: 25px;
    margin-right: 8px;
}
.back-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 10px;
            
        }
        .back-actions a {
            background-color:rgb(231, 207, 229);
            color: white;
            padding: 6px 10px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.6em;
            transition: background-color 0.3s;
        }
        .back-actions a:hover {
            background-color:#0e0ca3;
        }
        .container {
            width: 90%;
            max-width: 1200px;
            margin: 40px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h2 {
            text-align: center;
            font-size: 2em;
            margin-bottom: 20px;
        }
        .cart-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 15px;
            margin-bottom: 15px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }
        .cart-item img {
            max-width: 100px;
            border-radius: 8px;
            margin-right: 20px;
        }
        .item-details {
            flex-grow: 1;
        }
        .item-name {
            font-size: 1.2em;
            font-weight: bold;
            color: #343a40;
        }
        .item-price {
            font-size: 1.1em;
            color: #495057;
        }
        .item-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .item-actions button, .item-actions form button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 8px 12px;
            margin-left: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .item-actions button:hover, .item-actions form button:hover {
            background-color: #0056b3;
        }
        .quantity {
            width: 60px;
            padding: 5px;
            margin-right: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .cart-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
        }
        .cart-actions a {
            background-color: #984ca5;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1.1em;
            transition: background-color 0.3s;
        }
        .cart-actions a:hover {
            background-color: #984ca5;
        }
        .total-cost {
            font-size: 1.6em;
            font-weight: bold;
            color: #343a40;
            text-align: center;
            margin-top: 20px;
        }
        .empty-cart {
            text-align: center;
            font-size: 1.2em;
            color: #6c757d;
        }
    </style>
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
    <div class="container">
        <h2>Your Cart</h2>
        <?php
        if (empty($cart_items)) {
            echo "<p class='empty-cart'>Your cart is empty.</p>";
        } else {
            // Fetch product details for each cart item
            $product_ids = array_column($cart_items, 'product_id');
            $placeholders = implode(',', array_fill(0, count($product_ids), '?'));
            $stmt = $conn->prepare("SELECT * FROM products WHERE id IN ($placeholders)");
            $stmt->execute($product_ids);
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

            foreach ($products as $product) {
                $quantity = 0;
                foreach ($cart_items as $cart_item) {
                    if ($cart_item['product_id'] == $product['id']) {
                        $quantity = $cart_item['quantity'];
                        break;
                    }
                }
                $total_cost += $product['price'] * $quantity; // Add product price * quantity to total cost

                echo "<div class='cart-item'>
                        <img src='../images/{$product['image']}' alt='{$product['name']}' class='item-image'>
                        <div class='item-details'>
                            <div class='item-name'>{$product['name']}</div>
                            <div class='item-price'>\${$product['price']} x $quantity</div>
                        </div>
                        <div class='item-actions'>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='product_id' value='{$product['id']}'>
                                <input type='number' name='quantity' value='$quantity' class='quantity' min='1' required>
                                <button type='submit' name='update_quantity'>Update Quantity</button>
                            </form>
                            <form method='POST' style='display:inline;'>
                                <input type='hidden' name='product_id' value='{$product['id']}'>
                                <button type='submit' name='remove_from_cart'>Remove</button>
                            </form>
                        </div>
                      </div>";
            }
        }
        ?>
        <?php if (!empty($cart_items)) : ?>
            <div class="total-cost">
                Total: $<?= number_format($total_cost, 2); ?>
            </div>
        <?php endif; ?>
        <div class="cart-actions">
            <a href="../next_page1.php">Back to Shop</a>
            <a href="../order.php">Proceed to Checkout</a>
        </div>
    </div>
</body>
</html>