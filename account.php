<?php
require "connection.php";
session_start();
if (empty($_SESSION["fname"])) {
    $_SESSION["fname"] = "";
    $_SESSION["email"] = "";
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
                <a class="link  text-decoration-none" style="color: rgba(16, 16, 16, 0.564);"><button class="btn" onclick="logout();">Log Out</button></a>
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
                                $rs = Database::search("SELECT * FROM `city` " );
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

    <script src="login.js">

    </script>

</body>

</html>