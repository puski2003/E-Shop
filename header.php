<header class="navbar navbar-expand-lg d-flex justify-content-between">

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

    <div class="offcanvas offcanvas-end d-sm-flex d-md-flex d-lg-none " tabindex="-1" id="offcanvas" aria-labelledby="offcanvasLabel">
        <div class="offcanvas-header">

            <button type="button" class="btn-close" data-bs-toggle="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 se " role="search" id="nav-search">
                <input type="search" class="form-control form-control" placeholder="Search...">
            </form>
            <ul class="navbar-nav" id="navbar">
                <li class="nav-item px-2 "><a class="nav-link off" href="home.html">Home</a></li>
                <li class="nav-item px-2"><a class="nav-link off" href="#">Store</a></li>
                <li class="nav-item px-2"><a class="nav-link off" href="#">AboutUs</a></li>
                <li class="nav-item px-2"><a class="nav-link off" href="#">ContactUs</a></li>
            </ul>



        </div>
        <div class="offcanvas-footer ">
            <div class="btn-set d-flex justify-content-evenly ">
                <a href="wishlist.php" class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="white" class="bi bi-heart-fill" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
                    </svg>
                    <span class="visually-hidden">Button</span>
                </a>
                <a href="login.php" class="btn btn-outline-secondary">
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
                <a href="cart.php" class="btn btn-outline-secondary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="white" class="bi bi-bag-fill" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1zm3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4h-3.5z" />
                    </svg>
                    </svg>
                    <span class="visually-hidden">Button</span>
                </a>

            </div>
        </div>
    </div>


    <div class="logo-container d-flex flex-row">
        <img src="Resources/logo.svg" class="navbar-brand mx-3" style="width: 3vw; ">
        <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3 se d-sm-none d-md-none d-lg-flex d-none py-3" role="search" id="nav-search">
            <div class="d-flex flex-row">
                <input type="search" class="form-control form-control" placeholder="Search..." aria-label="Search">
                <button class="btn " type="button" data-bs-toggle="offcanvas" data-bs-target="#advance-search" aria-controls="advance-search-backdrop">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-filter" viewBox="0 0 16 16">
                        <path d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>


            </div>
        </form>
    </div>
    <div class="navbar navbar-expand-lg justify-content-center primary-nav d-sm-none d-md-none d-lg-flex d-none">
        <ul class="navbar-nav d-flex  text-center ">
            <li class="nav-item px-2  "><a class="nav-link" href="index.php">Home</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="store.php?cat=0&&pg=0&&bd=0">Store</a></li>
            <li class="nav-item px-2"><a class="nav-link" href="#">AboutUs</a></li>

            <li class="nav-item px-2"><a class="nav-link" href="#">ContactUs</a></li>
        </ul>
    </div>


    <button class="navbar-toggler mx-2 " style="z-index: 2;" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
        <span class="navbar-toggler-icon "></span>
    </button>
    <div class="btn-set d-sm-none d-md-none d-lg-flex d-none px-5">
        <a href="wishlist.php" class="btn btn-outline-secondary">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="30" fill="currentColor" class="bi bi-heart-fill" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M8 1.314C12.438-3.248 23.534 4.735 8 15-7.534 4.736 3.562-3.248 8 1.314z" />
            </svg>
            <span class="visually-hidden">Button</span>
        </a>
        <a href="login.php" class="btn btn-outline-secondary">
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
        <a href="cart.php" class="btn btn-outline-secondary" id="cart-count">
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