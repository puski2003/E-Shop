<?php
require "connection.php";
session_start();
$cat = $_POST['cat_id'];
$pg = $_POST['pg'];
$bd = $_POST['bd'];
if ($cat != "0" && $bd=="0") {
    $offset = $pg * 8;

    $rs = Database::search("SELECT * FROM `product` WHERE   product.category_cat_id='" . $cat . "' AND product.status_status_id='1' ORDER BY `datetime_added` DESC LIMIT 8 OFFSET $offset;");
    $n = $rs->num_rows;
    for ($x = 0; $x < $n; $x++) {
        $d = $rs->fetch_assoc();
?>
        <div class="col-lg-3 col-md-4  col-sm-6 col-12 ">
            <div class="card">
                <div class="card-im  Wproduct" style=" background-image: url('<?php echo ($d['image_1']) ?>');" onmouseover="this.style.backgroundImage = 'url(\'<?php echo ($d['image_2']) ?>\')';" onmouseout="this.style.backgroundImage = 'url(\'<?php echo ($d['image_1']) ?>\')';">
                    <div class="card-img-effect card-img-top">

                    </div>
                    <div class="card-body card-effect d-flex flex-column">
                        <h5 class="card-title"><?php echo ($d['title']) ?></h5>
                        <h3 style="font-size: 16px;color: rgb(165, 61, 61);margin-top: -10px;margin-bottom: -9px;overflow: hidden;">
                            LKR<?php echo ($d['price']) ?>
                        </h3>
                        <div class="ratting">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <div class="card-button d-flex flex-row justify-content-center overflow-hidden">
                            <button type="button" class="btn btn-outline-secondary mx-2 " onclick="AddCart('<?php echo($d['id'])?>');"> 
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                    </path>
                                </svg>
                                <span class="visually-hidden">Button</span>
                            </button>
                            <?php
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];
                            } else {
                                $email = "";
                            }
                            $wishrs = Database::search("SELECT * FROM `wishlist` WHERE `product_id`='" . $d['id'] . "' AND `user_email`='" . $email . "'  ");
                            if ($wishrs) {
                                if ($wishrs->num_rows < 1) {
                                    $isin = 2;
                                } else {
                                    $isin = 1;
                                }
                            }

                            ?>
                            <div id="wish-btn-con-<?php echo ($d['id']) ?>">
                                <button type="button" class="btn btn-outline-secondary mx-2 " onclick="toggleWishlist(<?php echo ($d['id']) ?>,<?php echo ($isin) ?>,'<?php echo ($email) ?>')">
                                    <svg id="heart-svg<?php echo ($d['id']); ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart <?php if ($isin == 1) {
                                                                                                                                                                                        echo ('d-none');
                                                                                                                                                                                    } ?>" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>
                                    <svg id="heart-fill-svg<?php echo ($d['id']); ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill <?php if ($isin == 2) {
                                                                                                                                                                                                echo ('d-none');
                                                                                                                                                                                            } ?>" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                    <span class="visually-hidden">Button</span>
                                </button>
                            </div>
                            <a href="single-product.php?product-id=<?php echo ($d['id']); ?>">
                                <button type="button" class="btn btn-outline-secondary mx-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                                        <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z" />
                                        <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    <span class="visually-hidden">Button</span>
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <div class="d-flex justify-content-center my-5 mt-5">
        <div class="btn-group pagination " role="group" aria-label="Basic example">

            <?php
            $pcountrs = Database::search("SELECT COUNT(product.id) AS `count` FROM `product` WHERE   product.status_status_id='1'AND  product.category_cat_id='" . $cat . "' ");
            $pcountda = $pcountrs->fetch_assoc();
            $count = $pcountda['count'];
            $pages = ceil($count / 8);
            for ($i = 0; $i < ($pages); $i++) {

            ?>
                <a type="button" class="btn pagination-btn" href="store.php?cat=<?php echo ($cat) ?>&&pg=<?php echo ($i) ?>&&bd=0"><?php echo ($i) ?> </a>


            <?php
            }


            ?>


        </div>

    </div>
    <?php


} else if($bd=="0")
{
    $offset = $pg * 8;


    $rs = Database::search("SELECT * FROM `product` WHERE product.status_status_id = '1' ORDER BY `datetime_added` DESC LIMIT 8 OFFSET $offset;");
    $n1 = $rs->num_rows;
    for ($x = 0; $x < $n1; $x++) {
        $d = $rs->fetch_assoc();
    ?>

        <div class="col-lg-3 col-md-4  col-sm-6 col-12 ">
            <div class="card">
                <div class="card-im  Wproduct" style=" background-image: url('<?php echo ($d['image_1']) ?>');" onmouseover="this.style.backgroundImage = 'url(\'<?php echo ($d['image_2']) ?>\')';" onmouseout="this.style.backgroundImage = 'url(\'<?php echo ($d['image_1']) ?>\')';">
                    <div class="card-img-effect card-img-top">

                    </div>
                    <div class="card-body card-effect d-flex flex-column">
                        <h5 class="card-title"><?php echo ($d['title']) ?></h5>
                        <h3 style="font-size: 16px;color: rgb(165, 61, 61);margin-top: -10px;margin-bottom: -9px;overflow: hidden;">
                            LKR<?php echo ($d['price']) ?>
                        </h3>
                        <div class="ratting ">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <div class="card-button d-flex flex-row justify-content-center overflow-hidden">
                            <button type="button" class="btn btn-outline-secondary mx-2 " onclick="AddCart('<?php echo($d['id'])?>');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                    </path>
                                </svg>
                                <span class="visually-hidden">Button</span>
                            </button>
                            <?php
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];
                            } else {
                                $email = "";
                            }
                            $wishrs = Database::search("SELECT * FROM `wishlist` WHERE `product_id`='" . $d['id'] . "' AND `user_email`='" . $email . "'  ");
                            if ($wishrs) {
                                if ($wishrs->num_rows < 1) {
                                    $isin = 2;
                                } else {
                                    $isin = 1;
                                }
                            }

                            ?>
                            <div id="wish-btn-con-<?php echo ($d['id']) ?>">
                                <button type="button" class="btn btn-outline-secondary mx-2 " onclick="toggleWishlist(<?php echo ($d['id']) ?>,<?php echo ($isin) ?>,'<?php echo ($email) ?>')">
                                    <svg id="heart-svg<?php echo ($d['id']); ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart <?php if ($isin == 1) {
                                                                                                                                                                                        echo ('d-none');
                                                                                                                                                                                    } ?>" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>
                                    <svg id="heart-fill-svg<?php echo ($d['id']); ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill <?php if ($isin == 2) {
                                                                                                                                                                                                echo ('d-none');
                                                                                                                                                                                            } ?>" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                    <span class="visually-hidden">Button</span>
                                </button>
                            </div>

                            <a href="single-product.php?product-id=<?php echo ($d['id']); ?>">
                                <button type="button" class="btn btn-outline-secondary mx-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                                        <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z" />
                                        <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    <span class="visually-hidden">Button</span>
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    <?php
    }
    ?>
    <div class="d-flex justify-content-center my-5 mt-5">
        <div class="btn-group pagination " role="group" aria-label="Basic example">

            <?php
            $pcountrs = Database::search("SELECT COUNT(product.id) AS `count` FROM `product` WHERE   product.status_status_id='1' ");
            $pcountda = $pcountrs->fetch_assoc();
            $count = $pcountda['count'];
            $pages = ceil($count / 8);
            for ($i = 0; $i < ($pages); $i++) {

            ?>
                <a type="button" class="btn pagination-btn" href="store.php?cat=<?php echo ($cat) ?>&&pg=<?php echo ($i) ?>&&bd=0"><?php echo ($i) ?> </a>


            <?php
            }


            ?>


        </div>

    </div>
<?php
}
else{
    $offset = $pg * 8;

    $rs = Database::search("SELECT product.* FROM model_has_brand INNER JOIN product ON model_has_brand.id = product.model_has_brand_id WHERE model_has_brand.brand_brand_id='".$bd."' AND product.status_status_id='1' ORDER BY `datetime_added` DESC LIMIT 8 OFFSET $offset;");
    $n = $rs->num_rows;
    for ($x = 0; $x < $n; $x++) {
        $d = $rs->fetch_assoc();
?>
        <div class="col-lg-3 col-md-4  col-sm-6 col-12 ">
            <div class="card">
                <div class="card-im  Wproduct" style=" background-image: url('<?php echo ($d['image_1']) ?>');" onmouseover="this.style.backgroundImage = 'url(\'<?php echo ($d['image_2']) ?>\')';" onmouseout="this.style.backgroundImage = 'url(\'<?php echo ($d['image_1']) ?>\')';">
                    <div class="card-img-effect card-img-top">

                    </div>
                    <div class="card-body card-effect d-flex flex-column">
                        <h5 class="card-title"><?php echo ($d['title']) ?></h5>
                        <h3 style="font-size: 16px;color: rgb(165, 61, 61);margin-top: -10px;margin-bottom: -9px;overflow: hidden;">
                            LKR<?php echo ($d['price']) ?>
                        </h3>
                        <div class="ratting">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                        <div class="card-button d-flex flex-row justify-content-center overflow-hidden">
                            <button type="button" class="btn btn-outline-secondary mx-2 " onclick="AddCart('<?php echo($d['id'])?>');">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-cart" viewBox="0 0 16 16">
                                    <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z">
                                    </path>
                                </svg>
                                <span class="visually-hidden">Button</span>
                            </button>
                            <?php
                            if (isset($_SESSION['email'])) {
                                $email = $_SESSION['email'];
                            } else {
                                $email = "";
                            }
                            $wishrs = Database::search("SELECT * FROM `wishlist` WHERE `product_id`='" . $d['id'] . "' AND `user_email`='" . $email . "'  ");
                            if ($wishrs) {
                                if ($wishrs->num_rows < 1) {
                                    $isin = 2;
                                } else {
                                    $isin = 1;
                                }
                            }

                            ?>
                            <div id="wish-btn-con-<?php echo ($d['id']) ?>">
                                <button type="button" class="btn btn-outline-secondary mx-2 " onclick="toggleWishlist(<?php echo ($d['id']) ?>,<?php echo ($isin) ?>,'<?php echo ($email) ?>')">
                                    <svg id="heart-svg<?php echo ($d['id']); ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart <?php if ($isin == 1) {
                                                                                                                                                                                        echo ('d-none');
                                                                                                                                                                                    } ?>" viewBox="0 0 16 16">
                                        <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z" />
                                    </svg>
                                    <svg id="heart-fill-svg<?php echo ($d['id']); ?>" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-heart-fill <?php if ($isin == 2) {
                                                                                                                                                                                                echo ('d-none');
                                                                                                                                                                                            } ?>" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                                    </svg>
                                    <span class="visually-hidden">Button</span>
                                </button>
                            </div>
                            <a href="single-product.php?product-id=<?php echo ($d['id']); ?>">
                                <button type="button" class="btn btn-outline-secondary mx-2 ">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z" />
                                        <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z" />
                                        <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z" />
                                    </svg>
                                    <span class="visually-hidden">Button</span>
                                </button>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    <?php } ?>
    <div class="d-flex justify-content-center my-5 mt-5">
        <div class="btn-group pagination " role="group" aria-label="Basic example">

            <?php
            $pcountrs = Database::search("SELECT COUNT(product.id) AS `count` FROM model_has_brand INNER JOIN product ON model_has_brand.id = product.model_has_brand_id WHERE model_has_brand.brand_brand_id='".$bd."' AND product.status_status_id='1' ");
            $pcountda = $pcountrs->fetch_assoc();
            $count = $pcountda['count'];
            $pages = ceil($count / 8);
            for ($i = 0; $i < ($pages); $i++) {

            ?>
                <a type="button" class="btn pagination-btn" href="store.php?cat=<?php echo ($cat) ?>&&pg=<?php echo ($i) ?>&&<?php echo ($bd) ?>"><?php echo ($i) ?> </a>


            <?php
            }


            ?>


        </div>

    </div>

   <?php 
}
?>