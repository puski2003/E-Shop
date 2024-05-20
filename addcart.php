<?php
require "connection.php";
session_start();
$id=$_POST['id'];
if(isset($_POST['amount'])){
    $amount=$_POST['amount'];
}
else{
    $amount="1";
}

$email=$_SESSION['email'];
$que=$_POST['que'];
if($que=="insert"){
    Database::iud("INSERT INTO `cart`(`product_id`,`user_email`,`amount`) VALUES('".$id."','".$email."','".$amount."') ");

}
if($que=="delete"){
    Database::iud("DELETE FROM `cart` WHERE `cart-id`='".$id."'");

}
echo(Database::$connection->error);
?>