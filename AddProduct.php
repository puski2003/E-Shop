<?php
session_start();
include "connection.php";
$email=$_SESSION['email'];
$pname=$_POST['pname'];
$price=$_POST['price'];
$stock=$_POST['stock'];
$DFO=$_POST['DFO'];
$DFC=$_POST['DFC'];
$category=$_POST['category'];
$desc=$_POST['description'];
$condition=$_POST['condition'];
$model=$_POST['model'];
$brand=$_POST['brand'];
$color=$_POST['color'];
if(isset($_FILES['images'])){
    $image=$_FILES['images'];
}


if(empty($pname)){
    echo("Enter the Product Name");
}else if(empty($price)){
 echo("Enter the Price of the Product");
}else if(empty($stock)){
    echo('Enter the stock amount');
}else if (empty($DFC)){
    echo("Enter the Delivery Fee for Colombo");
}
else if (empty($DFO)){
    echo("Enter the Delivery Fee for Other");
}else if($category=="0"){
    echo("Select the Category");
}else if($brand=="0"){
    echo("Select the Brand");
}else if($model=="0"){
    echo("Select the Model");
}
else if($condition=="0"){
    echo("Select the Condition");
}
else if($color=="0"){
    echo("Select the Color");
}
else if (empty($image)){
    echo("Select a Product Image");
}
else{

$d =new DateTime();
$tz=new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);        
$date= $d->format("Y-m-d H:i:s");;
$res1=Database::search("SELECT * FROM `model_has_brand`WHERE `model_model_id`='".$model."'AND `brand_brand_id`='".$brand."' ");
$num_res= $res1->num_rows;

if($num_res=="1"){
   $mod_data=$res1->fetch_assoc();
   $model_has_brand=$mod_data['id'];

}
if($num_res=="0"){
   
    Database::iud("INSERT INTO `model_has_brand`(`model_model_id`,`brand_brand_id`) VALUES ('".$model."','".$brand."') ");
      
    $res2=Database::search("SELECT * FROM `model_has_brand`WHERE `model_model_id`='".$model."'AND `brand_brand_id`='".$brand."' ");
    $mod_data=$res2->fetch_assoc();
   
   $model_has_brand=$mod_data['id'];

}
$res5=Database::search("SELECT * FROM `brand_has_category` WHERE `brand_brand_id`='".$brand."' AND `category_cat_id`='".$category."'");
$num_res2=$res5->num_rows;
if($num_res2<1){
    Database::iud("INSERT INTO `brand_has_category`(`brand_brand_id`,`category_cat_id`) VALUES ('".$brand."','".$category."') ");
}




$imageCount = count($image['name']);
$image1;
$image2;
$typematch=true;
for($i=0;$i<$imageCount;$i++){
   
    $fileName=$image['name'][$i];
    $fileTempName= $image['tmp_name'][$i];
    $fileError=$image['error'][$i];
    $fileType =$image['type'][$i];
    $allowesTypes = array("image/png","image/jpeg","image/svg");
  
    
    if(in_array($fileType,$allowesTypes)){
        $fileExt= explode("/",$fileType);
        $fileActualExt= (end($fileExt));
        $UplaodFileName=uniqid('',true).".".$fileActualExt;
        $fileDestination='Resources/Upload/products'.$UplaodFileName;
        if($i==0){
            $image1=$fileDestination;
           
        }
        if($i==1){
            $image2=$fileDestination;
        }
        move_uploaded_file($fileTempName,$fileDestination);
        
    }
    else{
 $typematch=false;
    }
}

if($typematch==false){
    echo("one or more image file type does not support");
}
else if(empty($desc) && empty($image2)){
   
   
    Database::iud("INSERT INTO `product`(`price`,`qty`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`category_cat_id`,`model_has_brand_id`,`color_clr_id`,`status_status_id`,`condition_condition_id`,`users_email`,`image_1`,`image_2`) VALUES('".$price."','".$stock."','".$pname."','".$date."','".$DFC."','".$DFO."','".$category."','".$model_has_brand."','".$color."','1','".$condition."','".$email."','".$image1."');  ");
    echo ("success");
}else if
(empty($desc)){
   
   
    Database::iud("INSERT INTO `product`(`price`,`qty`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`category_cat_id`,`model_has_brand_id`,`color_clr_id`,`status_status_id`,`condition_condition_id`,`users_email`,`image_1`,`image_2`) VALUES('".$price."','".$stock."','".$pname."','".$date."','".$DFC."','".$DFO."','".$category."','".$model_has_brand."','".$color."','1','".$condition."','".$email."','".$image1."','".$image2."');  ");
    echo ("success");
}else if(empty($image2)){
 Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`category_cat_id`,`model_has_brand_id`,`color_clr_id`,`status_status_id`,`condition_condition_id`,`users_email`,`image_1`) VALUES('".$price."','".$stock."','".$desc."','".$pname."','".$date."','".$DFC."','".$DFO."','".$category."','".$model_has_brand."','".$color."','1','".$condition."','".$email."','".$image1."');  ");
 echo ("success");
}elseif($image1 && $image2 && $desc){
  
   
    Database::iud("INSERT INTO `product`(`price`,`qty`,`description`,`title`,`datetime_added`,`delivery_fee_colombo`,`delivery_fee_other`,`category_cat_id`,`model_has_brand_id`,`color_clr_id`,`status_status_id`,`condition_condition_id`,`users_email`,`image_1`,`image_2`) VALUES('".$price."','".$stock."','".$desc."','".$pname."','".$date."','".$DFC."','".$DFO."','".$category."','".$model_has_brand."','".$color."','1','".$condition."','".$email."','".$image1."','".$image2."');  ");

    echo ("success"); 
    
}

}









?>