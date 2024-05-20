<?php

require "connection.php";
$fname =$_POST["fname"];
$lname =$_POST["lname"];
$email =$_POST["email"];
$address1 =$_POST["address1"];
$address2 =$_POST["address2"];
$province =$_POST["province"];
$city =$_POST["city"];
$district =$_POST["district"];
$mobile =$_POST["pnum"];
$gender =$_POST["gender"];


if (empty($fname)){
    echo("Please enter the first name<br>");
}elseif(strlen($fname)>45){
    echo("First name should be less than 45 characters<br>");
}
if (empty($lname)){
    echo("Please enter the last name<br>");
}elseif(strlen($lname)>45){
    echo("Last name should be less than 45 characters<br>");
}
elseif(strlen($mobile)!=10){
    echo("Mobile number should conatain 10 characters<br>");
}elseif(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
 echo("Invalid mobile number<br>");
}
elseif($gender==0){
    echo("Enter the Gender");
}
elseif(empty($address1)){
  echo("Enter the Address Line1");
}else{
 

}
   

?>