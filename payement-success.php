<?php
require "connection.php";

session_start();
$products=$_SESSION['cart_products'];
print_r($products);
?>

