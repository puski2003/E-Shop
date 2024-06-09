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
    <link rel="stylesheet" href="store.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Raleway:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Store</title>
    <link rel="icon" href="Resources/logo.svg">

</head>

<body onload="catProductLoad('<?php echo ($_GET['cat']) ?>','<?php echo ($_GET['pg']) ?>','<?php echo ($_GET['bd']) ?>','<?php echo isset($_GET['key']) ? $_GET['key'] : null; ?>');">
    <?php include "header.php" ?>
    <div class="hero">

        <div class="overlay d-flex justify-content-center flex-column align-items-center">
            <h1>STORE</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb ">
                    <li class="breadcrumb-item "><a href="index.php" class="text-light">Home</a></li>
                    <li class="breadcrumb-item active">Store</li>
                </ol>
            </nav>
        </div>

    </div>

    <div id="cart-toast" class="toast align-items-center text-white bg-green border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Producted Added to Cart
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div class=" row sort-container ">
        <div class="col-lg-10 col-md-9  col-sm-8 col-6"></div>
        <div class="sort col-lg-2 col-md-3 col-sm-4 col-6">
            <select class="form-select" aria-label="Default select example">

                <option value="popularity">Sort by popularity</option>
                <option value="average rating">Sort by average rating</option>
                <option value="latest" selected>Sort by latest</option>
                <option value="low">Sort by price:low to high</option>
                <option value="high">Sort by price:high to low</option>
            </select>
        </div>
    </div>
    <div class="row d-lg-flex justify-content-md-between">
        <div class="col-3">
            <div class="col-lg-12 d-lg-flex d-sm-none d-none " style="border-right:solid 0.25px rgba(128, 128, 128, 0.46);">

                <div class="row">
                    <div class="fil ">
                        <div class="category-title-containe d-flex justify-content-start align-items-center ps-4  " style="border-bottom:solid 0.25px rgba(128, 128, 128, 0.46);height: 10vh; width: 100vw;">
                            <h5 class="category-title " style="overflow: hidden;">Product Categories</h5>
                        </div>
                        <div class="fill  pt-4">
                            <?php
                            $rs = Database::search('SELECT * FROM `category`');
                            $n = $rs->num_rows;
                            for ($x = 0; $x < $n; $x++) {
                                $d = $rs->fetch_assoc(); ?>
                                <a class="btn py-1 d-flex justify-content-between " style="width: 100%;" href="store.php?cat=<?php echo ($d['cat_id']) ?>&&pg=0&&bd=0">

                                    <label class="form-check-label" for="flexCheckDefault">
                                        <?php echo ($d['cat_name']) ?>
                                    </label>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-caret-right" viewBox="0 0 16 16">
                                        <path d="M6 12.796V3.204L11.481 8 6 12.796zm.659.753 5.48-4.796a1 1 0 0 0 0-1.506L6.66 2.451C6.011 1.885 5 2.345 5 3.204v9.592a1 1 0 0 0 1.659.753z" />
                                    </svg>
                                </a>
                                <div>
                                    <ul>
                                        <?php if ($_GET['cat'] == $d['cat_id']) {
                                            $brandhascatRS = Database::search("SELECT * FROM brand_has_category INNER JOIN brand ON brand_has_category.brand_brand_id =brand.brand_id WHERE brand_has_category.category_cat_id='" . $d['cat_id'] . "';");
                                            $brandhascatnum = $brandhascatRS->num_rows;
                                            for ($i = 0; $i < $brandhascatnum; $i++) {
                                                $brandhascatdata = $brandhascatRS->fetch_assoc();

                                        ?>


                                                <li><a class="btn" href="store.php?cat=<?php echo ($d['cat_id']) ?>&&pg=0&&bd=<?php echo ($brandhascatdata['brand_id']) ?>"><?php echo ($brandhascatdata['brand_name']) ?></a></li>
                                        <?php
                                            }
                                        }
                                        ?>

                                    </ul>
                                </div>


                            <?php
                            }

                            ?>


                        </div>


                    </div>
                </div>


            </div>
            <div class="col-lg-12 d-lg-block d-sm-none d-none " style="border-right:solid 0.25px rgba(128, 128, 128, 0.46);">
                <div class="row">
                    <div class="fill">
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

            </div>
            <div class="col-lg-12 d-lg-block d-sm-none d-none " style="border-right:solid 0.25px rgba(128, 128, 128, 0.46);">
                <div class="fil ">
                    <div class="category-title-containe d-flex justify-content-start align-items-center ps-4  " style="border-bottom:solid 0.25px rgba(128, 128, 128, 0.46);border-top:solid 0.25px rgba(128, 128, 128, 0.46);height: 10vh; width: 100vw;">
                        <h5 class="category-title " style="overflow: hidden;">Product Status</h5>
                    </div>
                    <div class="fill ps-5 pt-4">
                        <div class="form-check py-1 ">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                In Stock
                            </label>
                        </div>
                        <div class="form-check py-1">
                            <input class="form-check-input " type="checkbox" value="" id="flexCheckChecked">
                            <label class="form-check-label" for="flexCheckChecked">
                                On Stock
                            </label>
                        </div>

                    </div>

                </div>
            </div>
        </div>

        <div class="col-9">
            <div class="row" id="cat_container">

            </div>



        </div>





    </div>

    <div class="row d-lg-flex justify-content-md-between pb-3 ">
        <div class="col-lg-3 d-lg-block d-sm-none d-none banner" style="border-right:solid 0.25px rgba(128, 128, 128, 0.46);">

        </div>

        <div class="col-lg-2 col-md-4  col-sm-6 col-12 ">

        </div>





    </div>
    <?php include "footer.php" ?>



    <script src="script.js"></script>
</body>

</html>