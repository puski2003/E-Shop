<?php
require "connection.php";
session_start();
if (empty($_SESSION["fname"])) {
    $_SESSION["fname"] = "";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="single-product.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Raleway:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="icon" href="Resources/logo.svg">

    <title>Order History</title>
</head>

<body style="overflow-x: hidden;">
    <?php include "header.php" ?>
    <div class="product-container" style="background-color:#bde6fae4"></div>
    <div class="Sproduct" style="background-color:#bde6fae4">
        <div class="" style="height: 100vh;">
            <div class="d-lg-flex justify-content-lg-center " style="margin: 0; padding: 0;">
                <div class="row offset-lg-1 col-lg-11 col-md-12 col-12 product-dis d-md-flex justify-content-md-center py-4" style="padding: 0;margin: 0;">
                    <div class="d-flex justify-content-start px-5 align-items-center" style="font-weight:800;font-family: 'Lato', sans-serif; ;">
                        <h4>Order History</h4>
                        <svg width="40" height="40" class="m-2 mx-3" fill="#C4E9FB" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                            <path d="M504 255.5c.3 136.6-111.2 248.4-247.8 248.5-59 0-113.2-20.5-155.8-54.9-11.1-8.9-11.9-25.5-1.8-35.6l11.3-11.3c8.6-8.6 22.4-9.6 31.9-2C173.1 425.1 212.8 440 256 440c101.7 0 184-82.3 184-184 0-101.7-82.3-184-184-184-48.8 0-93.1 19-126.1 49.9l50.8 50.8c10.1 10.1 2.9 27.3-11.3 27.3H24c-8.8 0-16-7.2-16-16V38.6c0-14.3 17.2-21.4 27.3-11.3l49.4 49.4C129.2 34.1 189.6 8 256 8c136.8 0 247.7 110.8 248 247.5zm-180.9 78.8l9.8-12.6c8.1-10.5 6.3-25.5-4.2-33.7L288 256.3V152c0-13.3-10.7-24-24-24h-16c-13.3 0-24 10.7-24 24v135.7l65.4 50.9c10.5 8.1 25.5 6.3 33.7-4.2z" />
                        </svg>


                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-12 ">
                        <div class="row my-3" style="font-size: 12px;border-bottom: solid 0.25px rgba(128, 128, 128, 0.46); ">
                            <div class="col-2"></div>
                            <div class="col-4">
                                <p>Order ID</p>
                            </div>

                            <div class="col-2">
                                <p>Subtotal</p>
                            </div>
                            <div class="col-2">
                                <p>Status</p>
                            </div>




                        </div>

                        <div class="bodere" style="overflow-y: scroll; overflow-x: hidden; height: 70vh;">
                            <?php
                            $rs = Database::search("SELECT * FROM `order` WHERE `order`.user_email='" . $_SESSION['email'] . "' ;");

                            $num = $rs->num_rows;
                            if ($num >= "1") {
                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                                    $rs1 = Database::search("SELECT `order`.id, SUM(product.price * order_product.quantity) AS total_sub_total FROM `order` INNER JOIN order_product ON `order`.id = order_product.order_id INNER JOIN product ON product.id = order_product.product_id WHERE `order`.id = '" . $d['id'] . "' GROUP BY `order`.id;
");
                                    $d1 = $rs1->fetch_assoc();
                            ?>
                                    <div class="row  " style="font-size: 16px; font-family: 'Lato', sans-serif; " >
                                    <div class="col-2"></div>
                                        <div class="col-4 pt-2">
                                            <p><?php echo ($d['id']); ?></p>
                                        </div>
                                        <div class="col-2 pt-2">
                                            <p>LKR <?php echo ($d1['total_sub_total']); ?></p>
                                        </div>
                                       <?php
                                       
                                       if($d['status']=="pending"){?>
                                        <div class="col-2 pt-2">
                                           <div style="background-color:#F7CB73;width:50%; height:30px;border-radius:1em">
                                           <p style="color:white ;text-align:center"> <?php echo ($d['status']); ?></p>
                                           </div>
                                        </div>
                                       <?php


                                       }
                                       if($d['status']=="completed"){?>
                                       
                                       <div class="col-2 pt-2">
                                           <div style="background-color:#22bb33;width:50%; height:30px;border-radius:1em">
                                           <p style="color:white ;text-align:center"> <?php echo ($d['status']); ?></p>
                                           </div>
                                        </div>
                                       <?php

                                        
                                       }
                                       if($d['status']=="rejected"){?>
                                       
                                       
                                       <div class="col-2 pt-2">
                                           <div style="background-color:#bb2124;width:50%; height:30px;border-radius:1em">
                                           <p style="color:white ;text-align:center"> <?php echo ($d['status']); ?></p>
                                           </div>
                                        </div>
                                       <?php

                                        
                                       }
                                       ?>


                                        
                                    </div>
                            <?php
                                }
                            }

                            ?>
                        </div>

                    </div>

                </div>





            </div>
        </div>
        <?php include "footer.php" ?>
        <script src="script.js"></script>

</body>

</html>