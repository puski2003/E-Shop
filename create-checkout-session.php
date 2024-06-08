<?php

require_once 'stripe-php/init.php';
require "connection.php";
session_start();

use Stripe\Stripe;


\Stripe\Stripe::setApiKey('sk_test_51O0gVtHoypIZDK3xTLWVVE2bnYWy1Li77NtgQ5wdUK9zsDNIMd4QTybYWsVTuAe6iwPi3MFUykgn8KtpaVO0yt2x00uoChJS8D');


$line_items = [];
$rs = Database::search("SELECT * FROM product INNER JOIN cart ON product.id= cart.product_id WHERE user_email='" . $_SESSION["email"] . "';");
$products=[];
$min = 10000000;
$max = 99999999;

$unique_id = mt_rand($min, $max);
$num = $rs->num_rows;
if ($num >= "1") {
    for ($x = 0; $x < $num; $x++) {
        $d = $rs->fetch_assoc();
        $products_object=[
            "id" => $d["id"],
            "amount" => $d["amount"],

        ];
        array_push($products,$products_object);

        $productdata=[
            'price_data' => [
                'currency' => 'lkr',
                'product_data' => [
                    'name' => $d['title'],
                    
                    
                ],
                'unit_amount' => $d['price']*10,
            ],
            'quantity' => $d['amount'],
        ];
        array_push($line_items, $productdata);
    }


}
$metadata = [
    "products" => $products,
  ];

$sessionData = [
    'payment_method_types' => ['card'],
    'line_items' => 
    $line_items,
    'mode' => 'payment',
    'success_url' => 'http://localhost/E-Shop/payement-success.php', // Replace with your success URL
    'cancel_url' => 'http://localhost/E-Shop/canceled.php',
    
    
     // Replace with your cancel URL
];

// Create a Checkout Session
try {
    $session = \Stripe\Checkout\Session::create($sessionData);
    if(isset($_SESSION['cart_products'])){
        unset($_SESSION['cart_products']);
        $_SESSION['cart_products'] = $products;
        $_SESSION['unique_id'] = $unique_id;


    }else{
        $_SESSION['cart_products'] = $products;
        $_SESSION['unique_id'] = $unique_id;

    }

    $response = [
        'sessionId' => $session->id,
    ];

    echo json_encode($response);
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
