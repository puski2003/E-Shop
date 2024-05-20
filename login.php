<?php
require "connection.php";
session_start();
if (empty($_SESSION["fname"])) {
    $_SESSION["fname"] = "";
}
$email = "";
$password = "";

if (isset($_COOKIE["email"]) && isset($_COOKIE["password"])) {
    $email = $_COOKIE["email"];
    $password = $_COOKIE["password"];
    $remmcheck = "checked";
} else {
    $email = "";
    $password = "";
    $remmcheck = "";
}


?>
<?php
if (isset($_SESSION['email'])){
    ?>
    
    
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Raleway:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="Resources/logo.svg">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    <link rel="stylesheet" href="account.css">

    <title>Account</title>
</head>

<body style="overflow-y: visible;">
<?php include "header.php"?>
    <div class="modal fade" id="exampleModal" data-bs-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content1" style="  background-color:rgba(183, 104, 104, 0.505) !important; backdrop-filter: blur(15px) !important;">
                <div class="d-flex justify-content-end px-3 pt-2">

                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="" id="response">

                    </div>
                </div>

            </div>
        </div>
    </div>


  
    <div class="row container-account">
        <div class="col-2 acc-cols me-4">
            <div class="d-flex fle justify-content-center mt-4">
                
                <?php
                if(isset($profPicUrl)){
                    ?>
              <img src="<?php echo($profPicUrl)?>" class="acc-prof-pic">
              <?php
                }else{
                    ?>
                      <img src="Resources/prof-img1.jpg" class="acc-prof-pic">
                
                    
                    <?php
                }
                ?>

            </div>
            <div class="row mt-3 text-center">
                <h5><?php echo ($_SESSION['fname']) ?>&nbsp;<?php echo ($_SESSION['lname']) ?> </h5>
            </div>
            <div class="d-flex justify-content-center">
                <a class="link  text-decoration-none" style="color: rgba(16, 16, 16, 0.564);">Log Out</a>
            </div>
            <div class="d-flex justify-content-center pt-5 mt-4">
                <input type="file" id="profile-pic-id" class="d-none" onchange="ProfPicUpdate();">
                <label for="profile-pic-id" class="btn btn-primary"> Update Profile Image</label>
            </div>


        </div>
        <div class="col-8 acc-cols">
            <div class="text-center mt-3">
                <h4>Profile Settings</h4>
            </div>

            <div class="row d-flex justify-content-center">
                <div class="col-10">
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label ms-2">First Name</label>
                        </div>
                        <div class="col-6">
                            <label class="form-label ms-2">Last Name</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <?php
                            $rs = Database::search("SELECT `fname` FROM `user` WHERE `email`='" . $_SESSION["email"] . "'");
                            $n = $rs->num_rows;
                            if ($n == 1) {
                                $d = $rs->fetch_assoc() ?>
                                <input class=" form-control " type="text" value="<?php echo ($d['fname']) ?>" id="prof-fname">
                            <?php
                            }

                            ?>
                        </div>
                        <div class="col-6">
                            <?php
                            $rs = Database::search("SELECT `lname` FROM `user` WHERE `email`='" . $_SESSION["email"] . "'");
                            $n = $rs->num_rows;
                            if ($n == 1) {
                                $d = $rs->fetch_assoc() ?>
                                <input class=" form-control " type="text" value="<?php echo ($d['lname']) ?>" id="prof-lname">
                            <?php
                            }

                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label ms-2">Mobile Number</label>
                        </div>
                        <div class="col-12">
                            <?php
                            $rs = Database::search("SELECT `mobile` FROM `user` WHERE `email`='" . $_SESSION["email"] . "'");
                            $n = $rs->num_rows;
                            if ($n == 1) {
                                $d = $rs->fetch_assoc() ?>
                                <input class=" form-control " type="text" value="<?php echo ($d['mobile']) ?>" id="prof-mobile">
                            <?php
                            }

                            ?>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label ms-2">Registered Date</label>
                        </div>
                        <div class="col-12">
                            <?php
                            $rs = Database::search("SELECT `joined_date` FROM `user` WHERE `email`='" . $_SESSION["email"] . "'");
                            $n = $rs->num_rows;
                            if ($n == 1) {
                                $d = $rs->fetch_assoc() ?>
                                <input class=" form-control " type="text" value="<?php echo ($d['joined_date']) ?>" readonly disabled>
                            <?php
                            }

                            ?>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label ms-2">Address Line 01</label>
                        </div>
                        <div class="col-12">
                            <input class=" form-control " type="text" id="prof-address1">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label ms-2">Address Line 02</label>
                        </div>
                        <div class="col-12">
                            <input class=" form-control " type="text" id="prof-address2">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label ms-2">Provice</label>
                        </div>
                        <div class="col-6">
                            <label class="form-label ms-2">District</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">

                            <select class="form-control" id="prof-provice" onchange="ProviceClick(event)">
                                <?php
                                $rs = Database::search("SELECT * FROM `province` ");
                                $n = $rs->num_rows;
                                for ($x = 0; $x < $n; $x++) {
                                    $d = $rs->fetch_assoc();



                                ?>
                                    <option value="<?php echo ($d['province_id']); ?>"><?php echo ($d['province_name']); ?></option>

                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="prof-District" onchange="DistrictClick(event)">
                                <?php
                                $rs = Database::search("SELECT * FROM `district` ");
                                $n = $rs->num_rows;
                                for ($x = 0; $x < $n; $x++) {
                                    $d = $rs->fetch_assoc();



                                ?>
                                    <option value="<?php echo ($d['district_id']); ?>"><?php echo ($d['district_name']); ?></option>

                                <?php
                                }

                                ?>

                            </select>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-6">
                            <label class="form-label ms-2">City</label>
                        </div>
                        <div class="col-6">
                            <label class="form-label ms-2">Gender</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6" >
                            <select class="form-control" id="prof-city">
                                <?php
                                $rs = Database::search("SELECT * FROM `city` ");
                                $n = $rs->num_rows;
                                for ($x = 0; $x < $n; $x++) {
                                    $d = $rs->fetch_assoc();



                                ?>
                                    <option value="<?php echo ($d['city_id']); ?>"><?php echo ($d['city_name']); ?></option>

                                <?php
                                }

                                ?>

                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-control" id="prof-gender">
                                <?php

                                $rs = Database::search("SELECT*FROM `gender`");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $d = $rs->fetch_assoc();


                                ?>
                                    <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?> </option>

                                <?php
                                }

                                ?>

                            </select>
                        </div>

                    </div>
                    <div class="row d-flex justify-content-center mt-4 mb-4">
                        <button class="btn btn-primary col-4" onclick="UpdateProf();">Update Changes</button>
                    </div>



                </div>
            </div>
        </div>

    </div>

    <script src="script.js">

    </script>

</body>

</html>
    
    
    
    
    <?php
}else{
    ?>
    
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Raleway:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="Resources/logo.svg">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="login.css">
    <title>Account</title>
</head>

<body>
<?php include "header.php"?>
    <div class="modal fade" id="exampleModal" data-bs-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content1" style="  background-color:rgba(183, 104, 104, 0.505) !important; backdrop-filter: blur(15px) !important;">
                <div class="d-flex justify-content-end px-3 pt-2">

                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="" id="response">

                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="forgetPassword" data-bs-backdrop="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content modal-content2" style="   background-color:rgba(120, 113, 113, 0.427) !important;; backdrop-filter: blur(15px) !important;">
                <div class="d-flex justify-content-end px-3 pt-2">

                    <button type="button" class="btn-close " data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-6"  id="NewPassCon">
                            <label>New Password</label>
                            <div class="btn-group">
                                <input  id="newPassword" type="password"  class="form-control">
                                <button onclick="ShowHidePs('newPassword')" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg></button>


                            </div>
                        </div>
                        <div class="col-6" id="RNewPassCon">
                            <label>Retype New Password</label>
                            <div class="btn-group">
                                <input  id="RnewPassword"  type="password"class="form-control">
                                <button  onclick="ShowHidePs('RnewPassword')" class="btn"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                    </svg></button>


                            </div>
                        </div>
                        
                        <div class="col-12 d-none" id="VCodeCon">
                            <label>Verification Code</label>

                            <input id="VCodeConI"  type="text" class="form-control">




                        </div>


                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                    <div class="errResetPas" id="errResetPas">
                    <svg class="d-none" id="loadingSvg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto;  display: block; shape-rendering: auto;" width="40px" height="40px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                            <g transform="translate(80,50)">
                                <g transform="rotate(0)">
                                    <circle cx="0" cy="0" r="6" fill="#72faff" fill-opacity="1">
                                        <animateTransform attributeName="transform" type="scale" begin="-0.875s" values="1.5 1.5;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite" />
                                        <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.875s" />
                                    </circle>
                                </g>
                            </g>
                            <g transform="translate(71.21320343559643,71.21320343559643)">
                                <g transform="rotate(45)">
                                    <circle cx="0" cy="0" r="6" fill="#72faff" fill-opacity="0.875">
                                        <animateTransform attributeName="transform" type="scale" begin="-0.75s" values="1.5 1.5;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite" />
                                        <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.75s" />
                                    </circle>
                                </g>
                            </g>
                            <g transform="translate(50,80)">
                                <g transform="rotate(90)">
                                    <circle cx="0" cy="0" r="6" fill="#72faff" fill-opacity="0.75">
                                        <animateTransform attributeName="transform" type="scale" begin="-0.625s" values="1.5 1.5;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite" />
                                        <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.625s" />
                                    </circle>
                                </g>
                            </g>
                            <g transform="translate(28.786796564403577,71.21320343559643)">
                                <g transform="rotate(135)">
                                    <circle cx="0" cy="0" r="6" fill="#72faff" fill-opacity="0.625">
                                        <animateTransform attributeName="transform" type="scale" begin="-0.5s" values="1.5 1.5;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite" />
                                        <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.5s" />
                                    </circle>
                                </g>
                            </g>
                            <g transform="translate(20,50.00000000000001)">
                                <g transform="rotate(180)">
                                    <circle cx="0" cy="0" r="6" fill="#72faff" fill-opacity="0.5">
                                        <animateTransform attributeName="transform" type="scale" begin="-0.375s" values="1.5 1.5;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite" />
                                        <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.375s" />
                                    </circle>
                                </g>
                            </g>
                            <g transform="translate(28.78679656440357,28.786796564403577)">
                                <g transform="rotate(225)">
                                    <circle cx="0" cy="0" r="6" fill="#72faff" fill-opacity="0.375">
                                        <animateTransform attributeName="transform" type="scale" begin="-0.25s" values="1.5 1.5;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite" />
                                        <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.25s" />
                                    </circle>
                                </g>
                            </g>
                            <g transform="translate(49.99999999999999,20)">
                                <g transform="rotate(270)">
                                    <circle cx="0" cy="0" r="6" fill="#72faff" fill-opacity="0.25">
                                        <animateTransform attributeName="transform" type="scale" begin="-0.125s" values="1.5 1.5;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite" />
                                        <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="-0.125s" />
                                    </circle>
                                </g>
                            </g>
                            <g transform="translate(71.21320343559643,28.78679656440357)">
                                <g transform="rotate(315)">
                                    <circle cx="0" cy="0" r="6" fill="#72faff" fill-opacity="0.125">
                                        <animateTransform attributeName="transform" type="scale" begin="0s" values="1.5 1.5;1 1" keyTimes="0;1" dur="1s" repeatCount="indefinite" />
                                        <animate attributeName="fill-opacity" keyTimes="0;1" dur="1s" repeatCount="indefinite" values="1;0" begin="0s" />
                                    </circle>
                                </g>
                            </g>
                            <!-- [ldio] generated by https://loading.io/ -->
                        </svg>
                    </div>
                    <div>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="ResetPass();">Submit</button>

                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="conatainBox">
        <div class="row w-100 ">
            <div class="col-lg-4 col-10 col-md-8 offset-lg-4 offset-md-2 container">

                <div class="front-content d-flex align-items-center">
                    <div class="row g-2">
                        <div class="col-12  back">
                        </div>
                        <div class="col-12">
                            <h1>Create Account </h1>
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="reponse-text w-25 " style="margin:0 ; padding:0;" id="reponse-text">
                                <div id="rep-t"></div>

                            </div>
                        </div>
                        <div class="col-12 col-lg-6  p-lg-0 ps-lg-4  px-4 ">
                            <input class="form-control" name=fn id="fn" type="text" placeholder="First Name">


                        </div>
                        <div class=" col-12 col-lg-6 p-lg-0 pe-lg-4 px-lg-2 px-4  ">
                            <input class="form-control" name="ln" id="ln" type="text" placeholder="Last Name">


                        </div>
                        <div class="col-12 px-lg-4 px-4  ">
                            <input class="form-control" name="email" id="email" type="email" placeholder=" Email">

                        </div>
                        <div class="col-12 px-lg-4 px-4 ">
                            <input class="form-control" name="pw" id="pw" type="password" placeholder="password">

                        </div>
                        <div class="col-12 col-lg-6 ps-lg-4  px-lg-1 px-4 ">
                            <input class="form-control" name="pno" id="pno" type="number" placeholder="Mobile">

                        </div>
                        <div class="col-12  col-lg-6 pe-lg-4 px-lg-1  px-4">
                            <select class="form-control" id="gender">
                                <option name="gender" disabled selected value="0">Select Your Gender</option>
                                <?php
                              
                                $rs = Database::search("SELECT*FROM `gender`");
                                $n = $rs->num_rows;

                                for ($x = 0; $x < $n; $x++) {
                                    $d = $rs->fetch_assoc();


                                ?>
                                    <option value="<?php echo $d["id"]; ?>"><?php echo $d["gender_name"]; ?> </option>

                                <?php
                                }

                                ?>
                            </select>

                        </div>
                        <div class="col-12 col-lg-6 g-2 d-grid px-lg-1  ps-lg-4 px-4">
                            <button id="res-bt" class="btn btn-primary" type="button" class="btn btn-primary" onclick="SignUp();">Sign Up</button>
                        </div>

                        <div class="col-12 col-lg-6  g-2  d-grid px-lg-1 pe-lg-4 px-4">
                            <button class="btn btn-dark" onclick="rotateContent()"> Sign In</button>
                        </div>

                    </div>

                </div>
                <div class="back-content d-flex align-items-center">
                    <div class="row g-2">
                        <div class="col-12 back">
                        </div>
                        <div class="col-12">
                            <h1>Login</h1>
                        </div>
                        <div class="col-12 px-4  ">
                            <input class="form-control" id="sign-email" value="<?php echo $email ?>" type="email" placeholder=" Email">

                        </div>
                        <div class="col-12 px-4">
                            <input class="form-control" id="sign-pass" value="<?php echo $password ?>" type="password" placeholder="password">

                        </div>

                        <div class="col-6 text-start p-lg-0 ps-lg-4  px-4">
                            <input id="rememberMe" class="form-check-input" <?php echo $remmcheck ?> type="checkbox">
                            <label class="form-label ">Remember me</label>

                        </div>
                        <div class="col-6   text-end p-lg-0 pe-lg-4  px-4">
                            <a href="#forgetpassword" class="link-primary" onclick="forgetPass();">Forget Password?</a>
                        </div>
                        <div class="col-12 col-lg-6 d-grid  px-lg-1  ps-lg-4 px-4">
                            <button class="btn btn-primary" onclick="rotateContent()">Sign Up</button>
                        </div>

                        <div class="col-12 col-lg-6 d-grid  px-lg-1  pe-lg-4 px-4 ">
                            <button class="btn btn-dark" onclick="SignIn();"> Sign In</button>
                        </div>
                    </div>

                </div>

            </div>
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

    <script src="script.js">

    </script>

</body>

</html> 
    
    <?php
}
?>
