<?php
require "connection.php";
session_start();
if (empty($_SESSION["fname"])) {
    $_SESSION["fname"] = "";
}

?>
<?php
if (isset($_SESSION['email'])) {
    $rsProf = Database::search("SELECT * FROM profile_img WHERE `users_email`='" . $_SESSION['email'] . "';");
    $num_row = $rsProf->num_rows;
    if ($num_row > 0) {
        $data = $rsProf->fetch_assoc();
        $profPicUrl = $data['path'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Raleway:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css" />
    <link rel="stylesheet" href="home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://js.stripe.com/v3/"></script>

    <link rel="icon" href="Resources/logo.svg">

    <title>Home</title>
</head>

<body onload="loadingCards();">

    <header class="navbar navbar-expand-lg d-flex justify-content-between">



        <div class="offcanvas offcanvas-end d-sm-flex d-md-flex d-lg-none " tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
            <div class="offcanvas-header">

                <button type="button" class="btn-close" data-bs-toggle="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 se " role="search" id="nav-search">
                    <input type="search" class="form-control form-control" placeholder="Search...">
                </form>
                <ul class="navbar-nav" id="navbar">
                    <li class="nav-item px-2 "><a class="nav-link off" href="#">Home</a></li>
                    <li class="nav-item px-2"><a class="nav-link off" href="store.php?cat=0&&pg=0&&bd=0">Store</a></li>
                    <li class="nav-item px-2"><a class="nav-link off" href="#">AboutUs</a></li>
                    <li class="nav-item px-2"><a class="nav-link off" href="#">ContactUs</a></li>
                </ul>



            </div>
            <div class="offcanvas-footer ">
                <div class="btn-set d-flex justify-content-evenly ">
                    <a class="btn btn-outline-secondary" href="wishlist.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="white" class="bi bi-heart-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                        </svg>
                        <span class="visually-hidden">Button</span>
                    </a>
                    <a class="btn btn-outline-secondary" href="login.php">
                        <?php
                        if (isset($profPicUrl)) {
                        ?>
                            <img src="<?php echo ($profPicUrl) ?>" style="width: 33px; height:33px;border-radius: 50%;
            overflow: hidden;">
                        <?php
                        } else {
                        ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                                <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                            </svg>


                        <?php
                        }
                        ?>
                    </a>
                    <a class="btn btn-outline-secondary" href="cart.php">
                        <?php

                        if (isset($_SESSION['email'])) {
                            $rs = Database::search("SELECT count(`cart-id`) as cart_count FROM `cart` WHERE `user_email`= '" . $_SESSION['email'] . "'");
                            $row = $rs->fetch_assoc();
                            $count = $row['cart_count'];

                            if ($count > 0) {


                        ?>
                                <span class="cart-not" style="background-color:#bde6fa;
    position: relative;
    margin-left:-23px;
    left: 65%;
    z-index: 5000;
    

    padding-left: 6px;
    padding-right:6px;
   
   
    border-radius: 50%;
    color:black;"><?php echo ($count); ?></span>
                        <?php
                            }
                        }
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="white" class="bi bi-bag-fill" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                        </svg>
                        </svg>

                    </a>

                </div>
            </div>
        </div>




        <div class="d-flex flex-row">
            <form class="col-12 col-lg-auto mb-3 mb-lg-0  se d-sm-none d-md-none d-lg-flex d-none ps-5" role="search" id="nav-search">
                <input type="search" class="form-control form-control" placeholder="Search..." aria-label="Search">
            </form>
            <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#advance-search" aria-controls="advance-search-backdrop">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                    <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg>
            </button>
        </div>
        <img src="Resources/logo.svg" class="navbar-brand mx-3" style="width: 30vw;">
        <button class="navbar-toggler mx-2 " style="z-index: 2;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
            <span class="navbar-toggler-icon "></span>
        </button>
        <div class="btn-set d-sm-none d-md-none d-lg-flex d-none px-5">

            <a class="btn btn-outline-secondary" href="wishlist.php">

                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                </svg>
                <span class="visually-hidden">Button</span>
            </a>
            <a class="btn btn-outline-secondary" href="login.php">
                <?php
                if (isset($profPicUrl)) {
                ?>
                    <img src="<?php echo ($profPicUrl) ?>" style="width: 33px; height:33px;border-radius: 50%;
            overflow: hidden;">
                <?php
                } else {
                ?>
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="currentColor" class="bi bi-person-fill" viewBox="0 0 16 16">
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3Zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z"></path>
                    </svg>


                <?php
                }
                ?>
            </a>
            <a class="btn btn-outline-secondary" href="cart.php">
                <?php

                if (isset($_SESSION['email'])) {
                    $rs = Database::search("SELECT count(`cart-id`) as cart_count FROM `cart` WHERE `user_email`= '" . $_SESSION['email'] . "'");
                    $row = $rs->fetch_assoc();
                    $count = $row['cart_count'];

                    if ($count > 0) {


                ?>
                        <span class="cart-not" style="background-color:#bde6fa;
    position: relative;
    margin-left:-23px;
    left: 65%;
    z-index: 5000;
    

    padding-left: 6px;
    padding-right:6px;
   
   
    border-radius: 50%;
    color:black;"><?php echo ($count); ?></span>
                <?php
                    }
                }
                ?>
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="currentColor" class="bi bi-bag-fill" viewBox="0 0 16 16">
                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                </svg>
                </svg>
                <span class="visually-hidden">Button</span>
            </a>

        </div>



    </header>


    <div class="navbar navbar-expand-lg justify-content-center primary-nav d-sm-none d-md-none d-lg-flex d-none">
        <ul class="navbar-nav d-flex  text-center ms-4">
            <li class="nav-item px-2 ms-5 "><a class="nav-link" href="#">Home</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="store.php?cat=0&&pg=0&&bd=0">Store</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="#">AboutUs</a></li>

            <li class="nav-item px-2"><a class="nav-link" href="#">ContactUs</a></li>
        </ul>
    </div>

    <!-- <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
        <div class="carousel-inner">
            <div class="carousel-item active carousel-bg-img1">


            </div>
            <div class="carousel-item carousel-bg-img2">


            </div>
            <div class="carousel-item carousel-bg-img3">


            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div> -->
    <div class="slider">

        <div class="swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Slides -->
                <div class="swiper-slide banner1 d-flex justify-content-evenly align-items-center">
                    <div class="banner-text text-1">
                        <h5 style="font-weight: 400;">Sleek & Stylish</h5>
                        <h1>Discover <br>HP's Laptop Lineup</h1>
                    </div>
                    <div style="overflow-y: hidden;">

                        <img src="images/lap-slider.png" class="bottle bottle1 ">


                    </div>

                </div>
                <div class="swiper-slide banner2 d-flex justify-content-evenly align-items-center">
                    <div class="banner-text text-2">
                        <h5 style="font-weight: 400;">Unleash Possibilities</h5>
                        <h1> The World of <br>iPhones Awaits</h1>
                    </div>
                    <div style="overflow-y: hidden;">

                        <img src="images/phone-slider.png" class="bottle box bot2" style="height: 58vh;">


                    </div>
                </div>
                <div class="swiper-slide banner3 d-flex justify-content-evenly align-items-center">
                    <div class="banner-text text-3">
                        <h5 style="font-weight: 400;">"The Heart of Your Home</h5>
                        <h1>Apple <br>HomePod Mini</h1>
                    </div>
                    <div style="overflow-y: hidden;">

                        <img src="images/homepod-slider1.png" class="bottle bot2 cream1">
                        <img src="images/homepod-slider2.png" class="bottle bot1 cream2" style="margin-left: -7vw; height:40vh;width:40vh;margin-top:20px">

                    </div>
                </div>

            </div>
            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- If we need scrollbar -->
            <div class="swiper-scrollbar"></div>
        </div>


    </div>
    <div class="row ch">


        <div class="image-container catgery mx-lg-3" >

            <h2>LAPTOPS</h2>
        </div>
        <div class="image-container  catgery mx-lg-3">
            <h2>MOBILE PHONES</h2>

        </div>
        <div class="image-container catgery mx-lg-3">
            <h2>HEADPHONES</h2>
        </div>
    </div>
    <div class="my-5 text-center">
        <h2>WEEKLY FEATURED PRODUCTS</h2>
    </div>
    <div class="row d-lg-flex justify-content-lg-center" id="cardcons" >
        <?php
        $wfrs = Database::search('SELECT * FROM weekly_featured INNER JOIN    product ON  weekly_featured.product_id =product.id; ');
        $wfnum = $wfrs->num_rows;
        for ($i = 0; $i < $wfnum; $i++) {
            $wfdata = $wfrs->fetch_assoc();
        ?>
            <a class="btn col-lg-2 col-md-3 col-sm-4 col-6 card-con mx-lg-4 g-2" href="single-product.php?product-id=<?php echo($wfdata['product_id'])?>">
                <div class="card card<?php echo ($i) ?> cardT my-lg-2">
                    <div class="d-flex justify-content-center" style="overflow-y:hidden">
                        <div class="card-img-top  Wproduct Wproduct1" alt="..." style=" background-image: url('<?php echo ($wfdata['image_1']) ?>');" onmouseover="this.style.backgroundImage = 'url(\'<?php echo ($wfdata['image_2']) ?>\')';" onmouseout="this.style.backgroundImage = 'url(\'<?php echo ($wfdata['image_1']) ?>\')';"></div>
                    </div>
                    <div class="card-body" style="font-family: lato;overflow-y:hidden;">
                        <h5 class="card-title"><?php echo ($wfdata['title']) ?></h5>
                        <h3 style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                            LKR<?php echo ($wfdata['price']) ?>
                        </h3>
                        <div class="ratting">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
            </a>


        <?php
        }

        ?>
    </div>
    <!-- <div class="row d-lg-flex justify-content-lg-center" id="cardcons">
        
        <div class="col-lg-2 col-md-3  col-sm-4 col-6 card-con mx-lg-4  g-2">
            <div class="card card1 cardT  my-lg-2">
                <div class="d-flex justify-content-center">
                    <div class="card-img-top  Wproduct Wproduct2" alt="..."></div>
                </div>
                <div class="card-body" style="font-family: lato;">
                    <h5 class="card-title" style="font-size: 18px;">Apple iPhone 11 </h5>
                    <h3 style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                        $100
                    </h3>
                    <div class="ratting">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-2 col-md-3  col-sm-4 col-6 card-con mx-lg-4  g-2">
            <div class="card card2 cardT my-lg-2">
                <div class="d-flex justify-content-center">
                    <div class="card-img-top  Wproduct Wproduct3" alt="..."></div>
                </div>

                <div class="card-body" style="font-family: lato;">
                    <h5 class="card-title" style="font-size: 18px;">Apple iPhone X</h5>
                    <h3 style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                        $100
                    </h3>
                    <div class="ratting">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-2 col-md-3 col-sm-4 col-6  card-con mx-lg-4  g-2">
            <div class="card card3 cardT my-lg-2">
                <div class="d-flex justify-content-center">
                    <div class="card-img-top  Wproduct Wproduct4" alt="..."></div>
                </div>
                <div class="card-body" style="font-family: lato;">
                    <h5 class="card-title " style="font-size: 18px;">Cubitt Smart Watch</h5>
                    <h3 style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                        $100
                    </h3>
                    <div class="ratting">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
            </div>
        </div>

    </div> -->
    <div class="my-5 text-center">
        <h2>BEST SELLING PRODUCTS</h2>
        
    </div>
    <div class="row d-lg-flex justify-content-lg-center mb-5" id="cardcons2">
        <?php
        $wfrs = Database::search('SELECT * FROM weekly_featured INNER JOIN    product ON  weekly_featured.product_id =product.id; ');
        $wfnum = $wfrs->num_rows;
        for ($i = 0; $i < $wfnum; $i++) {
            $wfdata = $wfrs->fetch_assoc();
        ?>
            <a class="btn col-lg-2 col-md-3 col-sm-4 col-6 card-con mx-lg-4 g-2" href="single-product.php?product-id=<?php echo($wfdata['product_id'])?>">
                <div class="card card<?php echo ($i) ?> cardT my-lg-2">
                    <div class="d-flex justify-content-center" style="overflow-y:hidden">
                        <div class="card-img-top  Wproduct Wproduct1" alt="..." style=" background-image: url('<?php echo ($wfdata['image_1']) ?>');" onmouseover="this.style.backgroundImage = 'url(\'<?php echo ($wfdata['image_2']) ?>\')';" onmouseout="this.style.backgroundImage = 'url(\'<?php echo ($wfdata['image_1']) ?>\')';"></div>
                    </div>
                    <div class="card-body" style="font-family: lato;overflow-y:hidden;">
                        <h5 class="card-title"><?php echo ($wfdata['title']) ?></h5>
                        <h3 style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                            LKR<?php echo ($wfdata['price']) ?>
                        </h3>
                        <div class="ratting">
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star checked"></span>
                            <span class="fa fa-star"></span>
                            <span class="fa fa-star"></span>
                        </div>
                    </div>
                </div>
            </a>


        <?php
        }

        ?>
    </div>
    <!-- <div class="row d-lg-flex justify-content-lg-center">
        <div class="col-lg-2 col-md-3 col-sm-4  col-6 card-con ">
            <div class="card">
                <div  class="card-img-top  Wproduct Wproduct1" alt="..."></div>
                <div class="card-body" style="font-family: lato;">
                    <h5 class="card-title">OnePlus 8 Pro</h5>
                    <h3
                        style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                        $100
                    </h3>
                    <div class="ratting">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
              </div>            
         </div>
         <div class="col-lg-2 col-md-3  col-sm-4 col-6 card-con">
            <div class="card" >
                <div  class="card-img-top  Wproduct Wproduct2" alt="..."></div>
                <div class="card-body" style="font-family: lato;">
                    <h5 class="card-title" style="font-size: 18px;">Apple iPhone 11 </h5>
                    <h3
                        style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                        $100
                    </h3>
                    <div class="ratting">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
              </div>            
         </div>
         <div class="col-lg-2 col-md-3  col-sm-4 col-6 card-con">
            <div class="card" >
                <div class="card-img-top  Wproduct Wproduct3" alt="..."></div>
                <div class="card-body" style="font-family: lato;">
                    <h5 class="card-title" style="font-size: 18px;">Apple iPhone X 64GB</h5>
                    <h3
                        style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                        $100
                    </h3>
                    <div class="ratting">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
              </div>            
         </div>
         <div class="col-lg-2 col-md-3 col-sm-4 col-6 card-con ">
            <div class="card" >
                <div  class="card-img-top  Wproduct Wproduct4" alt="..."></div>
                <div class="card-body" style="font-family: lato;">
                    <h5 class="card-title " style="font-size: 18px;">Cubitt Smart Watch</h5>
                    <h3
                        style="font-size: 16px;color: rgb(165, 61, 61);overflow: hidden;">
                        $100
                    </h3>
                    <div class="ratting">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star"></span>
                        <span class="fa fa-star"></span>
                    </div>
                </div>
              </div>            
         </div>
        
    </div>
    <div class="row d-lg-flex  justify-content-lg-center py-5 mb-5  " style="background-color:#bde6fae4;">
        
        <div class="col-lg-3 col-12 " >
            <div class="card "  >
               <div class="card-img-top pt-3  justify-content-center " >
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                    <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                  </svg>
               </div>
                <div class="card-body " >
                  <h5 class="card-title">FREE SHIPPING ON ALL ORDRES</h5>
                  <p class="card-text text-center">Get Free Shipping on all orders over $75 and free returns to our UK returns centre! Items are dispatched from the US and will arrive in 5-8 days.</p>
                </div>
              </div>            
         </div>
         <div class="col-lg-3 col-12 ">
            <div class="card" >
               <div class="card-img-top pt-3 d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                    <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
                  </svg>
               </div>
                <div class="card-body" >
                  <h5 class="card-title">AMAZING CUSTOMER SERVICE</h5>
                  <p class="card-text text-center">Get Free Shipping on all orders over $75 and free returns to our UK returns centre! Items are dispatched from the US and will arrive in 5-8 days.</p>
                </div>
              </div>            
         </div>
         <div class="col-lg-3 col-12 ">
            <div class="card" >
               <div class="card-img-top pt-3 d-flex justify-content-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-star" viewBox="0 0 16 16">
                    <path d="M2.866 14.85c-.078.444.36.791.746.593l4.39-2.256 4.389 2.256c.386.198.824-.149.746-.592l-.83-4.73 3.522-3.356c.33-.314.16-.888-.282-.95l-4.898-.696L8.465.792a.513.513 0 0 0-.927 0L5.354 5.12l-4.898.696c-.441.062-.612.636-.283.95l3.523 3.356-.83 4.73zm4.905-2.767-3.686 1.894.694-3.957a.565.565 0 0 0-.163-.505L1.71 6.745l4.052-.576a.525.525 0 0 0 .393-.288L8 2.223l1.847 3.658a.525.525 0 0 0 .393.288l4.052.575-2.906 2.77a.565.565 0 0 0-.163.506l.694 3.957-3.686-1.894a.503.503 0 0 0-.461 0z"/>
                  </svg>
               </div>
                <div class="card-body" >
                  <h5 class="card-title">NO CUSTOMS OR DUTY FEES!</h5>
                  <p class="card-text text-center">We pay these fees so you don’t have to! The total billed at checkout is the final amount you pay, inclusive of VAT, with no additional charges at the time of delivery!</p>
                </div>
              </div>            
         </div>

    </div> -->
    <div class="footer" style="background-color: rgb(74, 78, 78);">
        <div class="foot-logo d-flex justify-content-center py-5">
            <img src="Resources/logo.svg" style="width: 5%;">
        </div>
        <div class="foot-links py-4">
            <div class="row text-center">
                <div class="col-3">
                    <p class="link" style="color:rgb(159, 196, 196)">Location</p>
                </div>
                <div class="col-3">
                    <p class="link" style="color:rgb(159, 196, 196)">Email Info </p>
                </div>
                <div class="col-3">
                    <p class="link" style="color:rgb(159, 196, 196)">contact</p>
                </div>
                <div class="col-3">
                    <p class="link" style="color:rgb(159, 196, 196)">After Service</p>
                </div>
            </div>
        </div>
        <div>

        </div>
    </div>






    <div class="offcanvas offcanvas-start" tabindex="-1" id="advance-search" aria-labelledby="advance-search-backdrop" data-bs-backdrop="false">
        <div class="offcanvas-header" style="overflow-y: hidden;">
            <h4 class="offcanvas-title" id="offcanvasWithBackdropLabel" style="font-family:'Lato', sans-serif; ;">
                Advance Search</h4>
            <button type="button" class="btn-close text-reset px-5" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body product-container-table">
            <div class="category-title-containe d-flex justify-content-start align-items-center ps-4  " style="border-bottom:solid 0.25px rgba(128, 128, 128, 0.46);height: 10vh; width: 100vw;">
                <h5 class="category-title " style="overflow: hidden;">Product Categories</h5>
            </div>
            <div class="fill ps-5 pt-4">
                <div class="form-check py-1 ">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        iPhone
                    </label>
                </div>
                <div class="form-check py-1">
                    <input class="form-check-input " type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Phone Accessories
                    </label>
                </div>
                <div class="form-check py-1">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Phone Cases
                    </label>
                </div>
                <div class="form-check py-1">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Postpaid Phones
                    </label>
                </div>
                <div class="form-check py-1">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Prepaid Phones
                    </label>
                </div>
                <div class="form-check py-1">
                    <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
                    <label class="form-check-label" for="flexCheckChecked">
                        Prepaid Plans
                    </label>
                </div>
            </div>
            <div class="category-title-containe d-flex justify-content-start align-items-center ps-5  " style="border-bottom:solid 0.25px rgba(128, 128, 128, 0.46);border-top:solid 0.25px rgba(128, 128, 128, 0.46);height: 10vh; width: 100vw;">
                <h6 class="category-title " style="overflow: hidden;font-size: 15px;"><b>Filter by price</b>
                </h6>
            </div>
            <div class="price-filter d-flex justify-content-center ">
                <h6 class="category-title " style="overflow: hidden;font-size: 14px;"><b>$230 — $5,440</b>
                </h6>
            </div>
            <div class="range-container d-flex justify-content-center">
                <input type="range" class="form-range slider" min="0" max="5" step="0.5" id="customRange3">
            </div>
            <div class="fil ">
                <div class="category-title-containe d-flex justify-content-start align-items-center ps-4  " style="border-bottom:solid 0.25px rgba(128, 128, 128, 0.46);border-top:solid 0.25px rgba(128, 128, 128, 0.46);height: 10vh; width: 100vw;">
                    <h5 class="category-title " style="overflow: hidden;">Brands</h5>
                </div>
                <div class="fill ps-5 pt-4">
                    <div class="form-check py-1 ">
                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                            Apple
                        </label>
                    </div>
                    <div class="form-check py-1">
                        <input class="form-check-input " type="checkbox" value="" id="flexCheckChecked">
                        <label class="form-check-label" for="flexCheckChecked">
                            Samsumg
                        </label>
                    </div>

                </div>

            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js" integrity="sha512-wC/cunGGDjXSl9OHUH0RuqSyW4YNLlsPwhcLxwWW1CR4OeC2E1xpcdZz2DeQkEmums41laI+eGMw95IJ15SS3g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js" integrity="sha512-z4OUqw38qNLpn1libAN9BsoDx6nbNFio5lA6CuTp9NlK83b89hgyCVq+N5FdBJptINztxn1Z3SaKSKUS5UP60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/Flip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery.stellar@0.6.2/jquery.stellar.min.js"></script>
    <script src="script.js"></script>

</body>

</html>