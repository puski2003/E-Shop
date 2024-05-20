<?php
require "connection.php";
$id = $_POST['id'];
Database::iud("DELETE FROM `product` WHERE `id`='".$id."'");
echo(Database::$connection->error);
?>