<?php
require "connection.php";

session_start();

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