<?php

require "connection.php";
$fname =$_POST["fname"];
$lname =$_POST["lname"];
$email =$_POST["email"];
$password =$_POST["password"];
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
elseif(empty($email)){
    echo("Please enter the Email address<br>");

}
elseif(strlen($email)>100){
    echo("Email should be less than 100 characters<br>");

}
elseif(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Inavalid Email<br>");
}
elseif(strlen($password)<5||strlen($password)>20){
    echo("The password is between 5-20<br>");
}
elseif(strlen($mobile)!=10){
    echo("Mobile number should conatain 10 characters<br>");
}elseif(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
 echo("Invalid mobile number<br>");
}
elseif($gender==0){
    echo("Enter the Gender");
}
else{
     $rs = Database::search("SELECT * FROM `user` WHERE `email` = '". $email ."' OR `mobile` = '" . $mobile . "'");
     
     $n =$rs->num_rows;
 
     if($n>0){
         echo("Your Username or Mobile number already exist<br>");

    }else{
        $d =new DateTime();
        $tz=new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);        
        $date= $d->format("Y-m-d H:i:s");
        $sql=Database::iud("INSERT INTO `eshop`.`user` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `status`,`gender_id`) VALUES ( '".$fname."', '".$lname."','".$email."','".$password."','".$mobile."', '".$date."',1,'".$gender."');");
        echo(Database::$connection->error);
        
        echo ("success");
        
       

     }
}
?>