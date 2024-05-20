<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require "connection.php";
require 'phpPugins/src/Exception.php';
require 'phpPugins/src/PHPMailer.php';
require 'phpPugins/src/SMTP.php';
$email=$_POST['email'];
$Npass=$_POST['Npass'];
$Rpass=$_POST['Rpass'];
$Vcode=$_POST['verificationCode'];
if(empty($Npass)){
    echo("Enter the New Password");
}elseif(empty($Rpass)){
    echo("Renter the New Password ");
}elseif($Npass!=$Rpass){
   echo("Passwords does not match");
}elseif(strlen($Npass)<5 || strlen($Npass)>20){
    echo("The password is between 5-20<br>");
}else{

    if($Vcode==""){
        $code = uniqid();
        $rs= Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
        if ($rs->num_rows==1){
            $mail = new PHPMailer(true);
            Database::iud("UPDATE user SET verification_code='".$code."'");
    
        try {
            
            $mail->IsSMTP();                                     
            $mail->Host       = 'smtp.gmail.com';                     
            $mail->SMTPAuth   = true;                                
            $mail->Username   = 'pasidurajapaksha202@gmail.com';                 
            $mail->Password   = 'rxibeicmxcmyzwlp';                              
            $mail->SMTPSecure = 'ssl';       
            $mail->Port       = 465;                                   
        
            $mail->setFrom('pasidurajapaksha202@gmail.com', 'Eshop Reset Password');
              
            $mail->addAddress($email);           
            $mail->addReplyTo('pasidurajapaksha202@gmail.com', 'Eshop Reset Password');          
         
            
            $mail->isHTML(true); 
            $mail->Subject = 'Eshop Password Reset';
            $mail->Body    = "<H2>Hello This is your Verification Code</h2><br><h1>'".$code."'</h1>";
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
            $mail->send();
            echo("Verification code has been sent");
            
            
           
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        }
        else{
            echo("Email does not exits");
        }
    }
    else{
        $d=Database::search("SELECT `verification_code` FROM `user` WHERE `email`='".$email."' ");
       if( $d->num_rows==1){
        $row = $d->fetch_assoc();
      $dbVerificationCode = $row['verification_code'];
      
    if ($dbVerificationCode == $Vcode) {
            Database::iud("UPDATE `user` SET `password`='".$Npass."'");
            echo("Password is Changed");
        }else{
            echo("verification code is Incorrect");
        }
       }
    }
  
}
