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
    <link rel="icon" href="Resources/logo.svg">

    <script src="https://js.stripe.com/v3/"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Cart</title>
</head>

<body style="overflow-x: hidden;" onload="finalsubcal();">
    <?php include "header.php" ?>
    <div class="product-container" style="background-color:#bde6fae4;"></div>
    <div class="Sproduct" style="background-color:#bde6fae4 ;padding-bottom:0;">
        <div class="" style="height: 100vh;">
            <div class="d-lg-flex justify-content-lg-center " style="margin: 0; padding: 0;">
                <div class="row offset-lg-1 col-lg-11 col-md-12 col-12 product-dis d-md-flex justify-content-md-center py-4" style="padding: 0;margin: 0;">
                    <?php

                    if (isset($_SESSION["email"])) {
                    ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-8 bodere" style="height: 70vh;overflow-y: scroll;">
                            <div class="row" style="font-size: 12px;border-bottom: solid 0.25px rgba(128, 128, 128, 0.46);">
                                <div class="col-2"></div>
                                <div class="col-4">
                                    <p>Product</p>
                                </div>
                                <div class="col-1">
                                    <p>Price</p>
                                </div>
                                <div class="col-2">
                                    <p>Amount</p>
                                </div>
                                <div class="col-2">
                                    <p>Subtotal</p>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <?php

                            if (isset($_SESSION["email"])) {
                            ?>

                                <div id="cart-empty-msg" style="width: 100%;height:80%;text-align:center;letter-spacing: 2px;" class="d-flex justify-content-center align-items-center d-none">

                                    Cart Is Empty

                                </div> <?php
                                    } else {
                                        ?>

                                <div class="d-flex justify-content-center align-items-center flex-column" style="height:80%;">
                                    <div class="d-flex justify-content-center flex-column  align-items-center">
                                        <img src="./images/emptycart.svg" style="width:80%" />
                                        <h3 class="py-3 text-align-center">
                                            <b>Your Cart is empty</b>
                                        </h3>



                                    </div>
                                    <div>
                                        <button class="btn btn-primary">Sign in to your account

                                        </button>
                                    </div>

                                </div>
                            <?php

                                    }
                            ?>




                            <?php
                            if (isset($_SESSION["email"])) {
                                $rs = Database::search("SELECT * FROM product INNER JOIN cart ON product.id= cart.product_id WHERE user_email='" . $_SESSION["email"] . "';");

                                $num = $rs->num_rows;
                                if ($num >= "1") {
                                    for ($x = 0; $x < $num; $x++) {
                                        $d = $rs->fetch_assoc();
                            ?> 
                            
                            
                                        <div  class="row " style="font-size: 16px; font-family: 'Lato', sans-serif; " id="cart-con-<?php echo ($d['cart-id']); ?>">
                                            <div class="col-2 pt-2">
                                                <div class="cart-img" style="background-image: url(<?php echo ($d['image_1']) ?>);"></div>
                                            </div>
                                            <div class="col-4 pt-2">
                                                <p><?php echo ($d['title']); ?></p>
                                            </div>
                                            <div class="col-1 pt-2">
                                                <p><?php echo ($d['price']); ?></p>
                                            </div>
                                            <div class="col-2 pt-1"><input id="cart-amount-<?php echo ($d['cart-id']); ?>" type="number" class="form-control" min="1" value="<?php echo ($d['amount']); ?>" style="width: 50%;" onchange="updateSubTotal('<?php echo ($d['price']); ?>','<?php echo ($d['cart-id']); ?>');"></div>
                                            <div class="col-2 pt-2">
                                                <p id="cart-sub-<?php echo ($d['cart-id']); ?>" class="subtotals"><?php echo ((int)$d['price'] * (int)$d['amount']); ?></p>
                                            </div>
                                            <div class="col-1 pt-2"><button class="btn btn-close" onclick="DeleteCart(<?php echo ($d['cart-id']); ?>)"></button></div>
                                        </div>
                            <?php
                                    }
                                }
                            }
                            ?>



                        </div>
                        <div class="col-lg-4 col-md-6 col-sm-12 col-12 mt-md-2 mt-sm-2 mt-2 mt-lg-0 ">
                            <h5 style="font-weight: 600;" class="ms-2 ms-sm-2 ms-md-2 ms-lg-0"> CART TOTALS</h5>
                            <div class="row pt-5 py-3" style="font-family: 'Lato', sans-serif;border-bottom: solid 0.001px rgba(128, 128, 128, 0.274);">
                                <div class="col-8">Subtotal</div>
                                <div class="col-4" id="final-sub"></div>
                            </div>
                            <div class="row pt-5 py-3" style="font-family: 'Lato', sans-serif;border-bottom: solid 0.001px rgba(128, 128, 128, 0.274);">
                                <div class="col-8">Shiping</div>
                                <div class="col-4">
                                    <div style="font-size: 13px ;display: flex;justify-content: space-between; flex-direction: column;">
                                        <div style="display: flex;justify-content: space-between;" class="py-2">
                                            <label class="form-check-label">Flat rate</label>
                                            <input type="radio" class="form-check-input " id="delfee" checked name="del-fee" onchange="finalsubcal();">
                                        </div>
                                        <div style="display: flex;justify-content: space-between;" class="py-2">
                                            <label class="form-check-label">Local PickUp</label>
                                            <input type="radio" class="form-check-input ms-1 ms-3" name="del-fee" value="" onchange="finalsubcal();">
                                        </div>
                                    </div>
                                </div>





                            </div>
                            <div class="row pt-5 py-3" style="font-family: 'Lato', sans-serif;">
                                <div class="col-8">Total</div>
                                <div class="col-4" id="final-total"></div>
                            </div>
                            <div class=" pt-5 py-3 d-flex justify-content-center  " style="font-family: 'Lato', sans-serif;">
                                <button class=" col-11 btn  btn-primary " onclick="checkout();">
                                    Proceed to checkout
                                </button>


                            </div>


                        </div>
                </div> <?php
                    } else {
                        ?>
                <div class="d-flex justify-content-center align-items-center flex-column" style="height:70vh;">
                    <div class="d-flex justify-content-center flex-column  align-items-center">
                        <img src="./images/emptycart.svg" style="width:80%" />
                        <h3 class="py-3 text-align-center">
                            <b>Your Cart is empty</b>
                        </h3>



                    </div>
                    <div>
                        <a href="login.php" style="text-decoration: none;">
                            <button class="btn btn-primary">Sign in to your account

                            </button>
                        </a>
                    </div>

                </div>


            <?php

                    }
            ?>
            </div>





        </div>
    </div>
    <?php include "footer.php" ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="script.js"></script>

</body>

</html>