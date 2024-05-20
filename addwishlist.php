<?php
require "connection.php";
session_start();
$id=$_POST['id'];
if(isset($_POST['amount'])){
    $amount=$_POST['amount'];
}

$email=$_SESSION['email'];
$que=$_POST['que'];
if($que=="insert"){
    Database::iud("INSERT INTO `wishlist`(`product_id`,`user_email`) VALUES('".$id."','".$email."') ");

}
if($que=="delete"){
    Database::iud("DELETE FROM `wishlist` WHERE `product_id`='".$id."' AND `user_email`='".$email."'");

}
echo(Database::$connection->error);
?>