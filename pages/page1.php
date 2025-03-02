<?php
session_start();
include 'includes/db.php'; // Include the database connection

// Fetch products from the database
$stmt = $conn->query("SELECT * FROM products");
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" >
<style>
   
       
    
    .section{
        display: flex;
        margin: 10px;
    }
    .image{
        width: 850px;
        background-image: url(Ns1.jpg);
        align-items: center;
        background-size: cover;
        height: 700px;
    }
   
    .bn{
        
        position: absolute;
        margin-top: 650px; 
    }
    button{
        width:130px;
        height: 50px;
        margin-left: 85px;
        color: rgb(213, 212, 219);
       border-radius: 5px;
       font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        background-color: rgb(224, 16, 158);
    }
    button:hover{
        background-color: rgb(27, 27, 92);
        color: black;
    }

.metter{
     
    width: 100%;
    margin-left: 30px;
    
}
.metter h1{
    font-size: 20px;
}
.metter p{
    font-size: 15px;
    color: green;
}
span{
    font-size: 15px;
    text-decoration: line-through;
}

.dis{
    display: flex;
    position: absolute;
    border: 10px;
    box-shadow: inset;
    margin-top: 40px;
    box-sizing: border-box;
    border-color: black;
    border-color: azure;
}
.dis img{
    width: 200px;
    height: 200px;
}
.set{
    
margin-left: 30px;

}
.set p{
    color: black;
}

.about{
    width: 1400px;
    height: 300px;
    background-color: rgb(47, 47, 117);
}
.class{
    width: 1300px;
    height: 300px;
    display: flex;
    margin-top: 300px;
    margin-left: 60px;
}

 .c2 {
    margin-top: 30px;
    margin-left: 145px;
 }
 .c2 h1{
    font-size: 20px;
 }

</style>



</head>
<body>
    <div class="container">
        <div class="section">
<div class="image">
    <div class="bn">
    <button><i class="fa-solid fa-cart-shopping"></i> ADD TO CART</button>
    <button><i class="fa-solid fa-bolt-lightning"></i> BUY NOW</button></div>
</div>
<div class="metter">
<h1>
    R A Enterprises <br>Alloy Rhodium Silver Jewel Set  (Pack of 1)</h1>
<p>Special price</p>
<h1>₹599 <span>  ₹1,599</span>74% off</h1>
<h1>
    Product Description
</h1>
<div class="dis">
    <img src="Ns1.jpg" alt="">
    <div class="set">
        <h1>Complete Adornment Set for You</h1>
         <p>The jewel set includes a necklace, two earrings, and a maang <br> 
            tikka, providing a complete adornment set for you. This means that <br> you can effortlessly accessorise your entire look with  
             <br>this set, ensuring a cohesive and stylish appearance. The set is  <br> designed to complement each other, creating a harmonious <br> and balanced look when worn together.</p>
    </div>
    
</div>
</div>

       
</body>
</html>