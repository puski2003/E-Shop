<?php
require "connection.php";
session_start();
$amount=$_POST['amount'];
$id=$_POST['id'];

Database::iud("UPDATE cart SET amount = '".$amount."' WHERE `cart-id` = '".$id."' AND user_email = '".$_SESSION['email']."';");
echo"sucess";

?>