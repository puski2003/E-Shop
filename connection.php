<?php
class Database{
 public static $connection;

 public static function setUpconnction(){
 if (!isset($connection)){
    Database::$connection=new mysqli("localhost","root","Pakaya2003","eshop","3308");

 }
 }
 public static function iud($q){
    Database::setUpconnction();
    Database::$connection->query($q);

 }
 public static function search($q){
    Database::setUpconnction();
    $rs=Database::$connection->query($q);
    return $rs;
    

 }

}



?>