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

    <title>Wishlist</title>
</head>

<body style="overflow-x: hidden;">
    <?php include "header.php" ?>
    <div class="product-container" style="background-color:#bde6fae4"></div>
    <div class="Sproduct" style="background-color:#bde6fae4">
        <div class="" style="height: 100vh;">
            <div class="d-lg-flex justify-content-lg-center " style="margin: 0; padding: 0;">
                <div class="row offset-lg-1 col-lg-11 col-md-12 col-12 product-dis d-md-flex justify-content-md-center py-4" style="padding: 0;margin: 0;">
                    <div class="d-flex justify-content-start px-5" style="font-weight:800;font-family: 'Lato', sans-serif; ;">
                        <h4>Wishlist</h4>
                        <svg xmlns="http://www.w3.org/2000/svg" width="21" height="21" fill="#bde6fa" class="bi bi-heart-fill mt-1 mx-2" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                        </svg>



                    </div>
                    <div class="col-12 col-sm-12 col-md-6 col-lg-12 ">
                        <div class="row" style="font-size: 12px;border-bottom: solid 0.25px rgba(128, 128, 128, 0.46);">
                            <div class="col-2"></div>
                            <div class="col-4">
                                <p>Product</p>
                            </div>
                            <div class="col-1">
                                <p>Price</p>
                            </div>
 
                           
                            <div class="col-1"></div>
                            <div class="col-1"></div>

                        </div>

                        <div class="bodere" style="overflow-y: scroll; overflow-x: hidden; height: 70vh;">
                            <?php
                            $rs = Database::search("SELECT * FROM product INNER JOIN wishlist ON product.id= wishlist.product_id ;");

                            $num = $rs->num_rows;
                            if ($num >= "1") {
                                for ($x = 0; $x < $num; $x++) {
                                    $d = $rs->fetch_assoc();
                            ?>
                                    <div class="row  " style="font-size: 16px; font-family: 'Lato', sans-serif; " id="wish-con-<?php echo ($d['product_id']); ?>">
                                        <div class="col-2 pt-2">
                                            <div class="cart-img" style="background-image: url(<?php echo($d['image_1'])?>);"></div>
                                        </div>
                                        <div class="col-4 pt-2">
                                            <p><?php echo ($d['title']); ?></p>
                                        </div>
                                        <div class="col-1 pt-2">
                                            <p><?php echo ($d['price']); ?></p>
                                        </div>
                                       
                                        
                                        <div class="col-1 pt-1"><button class="btn">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
                                                </svg>
                                            </button></div>

                                        <div class="col-1 pt-2"><button class="btn btn-close" onclick="DeleteWishList(<?php echo ($d['product_id']); ?>)"></button></div>
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