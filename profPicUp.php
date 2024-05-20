<?php
require "connection.php";
session_start();
$email= $_SESSION['email'];
$picFile= $_FILES["picFile"];
$fileName=$_FILES["picFile"]['name'];
$fileTempName=$_FILES["picFile"]['tmp_name'];
$fileSize=$_FILES["picFile"]['size'];
$fileError=$_FILES["picFile"]['error'];
$fileType=$_FILES["picFile"]['type'];
print_r($picFile);
$allowesTypes = array("image/png","image/jpeg","image/svg");
if(in_array($fileType,$allowesTypes)&& isset($email)){
    $fileExt= explode("/",$fileType);
    $fileActualExt= (end($fileExt));
    $UplaodFileName=uniqid('',true).".".$fileActualExt;
    $fileDestination='Resources/Upload/profImage'.$UplaodFileName;
    move_uploaded_file($fileTempName,$fileDestination);
    echo("sucess");
    $rs = Database::search("SELECT * FROM profile_img WHERE `users_email`='".$email."';");
    $num_row=$rs->num_rows;
    if ($num_row>0){
        Database::iud("UPDATE profile_img  SET  `path`='".$fileDestination."' WHERE `users_email`='".$email."'" );

    }else{
        Database::iud("INSERT INTO profile_img VALUES('".$fileDestination."','".$email."'); ");
    }

}else{
    echo("File type Does not Support");
}
?>