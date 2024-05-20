<?php
require "connection.php";
session_start();
$uname =$_POST['uname'];
$pass =$_POST['pass'];
$remember=$_POST['rememberMe'];
if (empty($uname)){
    echo("enter the email");
}elseif(empty($pass)){
    echo("enter the password");
}else{
    
 $sql = Database::search("SELECT * FROM `user` WHERE `email`='".$uname."' ");
 
 if ($sql->num_rows==1){
    $d = $sql->fetch_assoc();
   
    if($d['email']=$uname && $d['password']=$pass){
        $_SESSION["fname"]=$d['fname'];
        $_SESSION["lname"]=$d['lname'];
        $_SESSION["email"]=$uname;
        
        
        if($remember=="true"){
            setcookie("email",$uname,time()+(60*60*24*365)); 
            setcookie("password",$pass,time()+(60*60*24*365)); 


        }
        else{
            setcookie("email","",-1);
            setcookie("password","",-1);
        }
        echo("success");

    }
    else{
        echo("incorrect email or password");
    }
 }else{
    echo("incorrect email or password");
 }
 
 echo(Database::$connection->error);
        

}
?>