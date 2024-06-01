<?php
require "connection.php";

session_start();
$products = $_SESSION['cart_products'];
$num = count($products);

$min = 1000000000; 
$max = 9999999999; 
$unique_id = mt_rand($min, $max);

Database::iud("INSERT INTO `order` (id,user_email) VALUES ('".$unique_id."','" . $_SESSION['email'] . "')");
for ($x = 0; $x < $num; $x++) {
    $d = $products[$x];   
    Database::iud("INSERT INTO order_product( order_id,product_id,quantity) VALUES ( '".$unique_id."','".$d['id']."','".$d['amount']."')");
}
Database::$connection->commit();?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="success.css">
    <title>Success</title>
</head>
<body>
    
</body>
</html>