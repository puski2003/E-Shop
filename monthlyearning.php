<?php
require 'stripe-php/init.php'; 
// Replace with your actual Stripe API key
\Stripe\Stripe::setApiKey('sk_test_51PMyUGDLRGeC8WnLZDlny8rqfeWWVzNkhD4h6MFY3laXdcXe1X84RorhXnARYnV1Nnn2PyOy72oMFxwZEy5jJUu800mkgNdeAC');

// Example: Retrieve transactions for the current month
$now = new DateTimeImmutable();
$monthStart = $now->modify('first day of this month');
$monthEnd = $now->modify('last day of this month');

$transactions = \Stripe\BalanceTransaction::all([
   'limit' => 100,
]);

$totalEarnings = 0;
foreach ($transactions->data as $transaction) {
    if ($transaction->type === 'charge') { // Filter for successful charges
        $totalEarnings += $transaction->amount / 100; // Convert cents to dollars
    }
}

echo "Total Monthly Earnings: $$totalEarnings";

?>