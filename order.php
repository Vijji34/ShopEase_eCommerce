<?php
session_start();
include 'includes/db.php'; // Include the database connection

// Fetch products from the database
$stmt = $conn->query("SELECT * FROM product1");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
if (isset($_POST['buy_now'])) {
    echo "<script>
        setTimeout(function(){
            Swal.fire({
                icon: 'success',
                title: 'Thank You!',
                text: 'Your order has been successfully ordered. Thanks!',
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'index.php';
                }
            });
        }, 100);
    </script>";
}
?>
<style>
.back-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
            padding-top: 10px;
        }
        .back-actions a {
            background-color:rgb(238, 240, 238);
            color: black;
            padding: 6px 10px;
            border-radius: 50px;
            text-decoration: none;
            font-size: 0.6em;
            transition: background-color 0.3s;
        }
        .back-actions a:hover {
            background-color:#0e0ca3;
            color: white
        }

        button {
            background-color:#984ca5;
            color: white;
            padding: 10px 20px;
            border: none;
            margin-left:650px;
            margin-top: 350px;
            font-size: 18px;
            align-items: center;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
        }
        button:hover {
            background-color: #0e0ca3;
            color: white
        }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Now</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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

    <form method="post">
        <button type="submit" name="buy_now">Proceed to Order</button>
    </form>
</body>
</html>
