<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  require "connection.php";
 
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="single-product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Raleway:wght@300;400;600;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="icon" href="Resources/logo.svg">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <title>Single Product</title>
</head>

<body>
    <?php include "header.php"?>
    <?php
  
   $id=$_GET['product-id'];
   $rs = Database::search("SELECT * FROM `product` WHERE `id`='".$id."'");
   $num=$rs->num_rows;
   if($num=="1"){
    $d=$rs->fetch_assoc();
    $title=$d['title'];
    $qty=$d['qty'];
    $des=$d['description'];
    $price=$d['price'];
    $image1=$d['image_1'];
    $image2=$d['image_2'];
   }
?>
    <div class="product-container" style="background-color:#bde6fae4;"></div>
    <div class="Sproduct" style="background-color: #bde6fae4;">
        <div class="" >
            <div class="d-lg-flex justify-content-lg-center " style="margin: 0; padding: 0;">
                <div class="row offset-lg-1 col-lg-10 col-md-12 col-12 product-dis d-md-flex justify-content-md-center py-4"
                    style="padding: 0;margin: 0;">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 bodere">
                        <div class="image1" style="background-image: url(<?php echo($image1);?>);"></div>
                        <div class="image2"style="background-image: url(<?php echo($image2);?>);"></div>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <nav class="pb-5" style="border-bottom:solid 0.5px rgba(128, 128, 128, 0.23);">
                            <ol class="breadcrumb pt-5 ">
                                <li class="breadcrumb-item "><a href="#"
                                        style="color: rgb(120, 117, 117);text-decoration: none;">Home</a></li>
                                <li class="breadcrumb-item "><a href="#"
                                        style="color: rgb(120, 117, 117);text-decoration: none;">Store</a></li>
                                <li class="breadcrumb-item active" style="color: rgb(120, 117, 117);"><?php echo($title);?>
                                </li>
                            </ol>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <h5 class="product-head"><?php echo($title);?></h5>
                                </div>
                                <div class="col-6 col-sm-12 col-md-6 col-lg-6 ">
                                    <H5 style="font-weight: 800;font-family: 'Lato', sans-serif;color: rgb(198, 33, 33);
                                ">LKR <?php echo($price);?></H5>
                                    <div class="d-flex flex-row">
                                        <label class="pt-2 pe-1" style="font-size: 14px;">Amount: </label>
                                        <input type="number" min="1" step="1" value="1" class="form-control "
                                            style="width: 30%; height: 30%;" id="amount-product">
                                    </div>
                                    <button class="btn btn-success mt-2" onclick="AddCart('<?php echo($id);?>');">ADD TO CART</button>
                                </div>

                            </div>
                        </nav>
                        <div>
                            <h4 class="py-3">Description :</h4>
                            <P style="font-size: 13px;">
                            <?php echo($des);?>
                            </P>
                        </div>

                    </div>

                </div>
            </div>





        </div>
    </div>
   
<?php include "footer.php"?>
<script src="script.js"></script>
</body>

</html>