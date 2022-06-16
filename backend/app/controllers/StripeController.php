<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class StripeController
{
    // public function getSession()
    // {
    //     $stripe = new \Stripe\StripeClient(
    //         'sk_test_51LB6MQIcWRr970L6kHcSvzX9e8ynkP8PATMa5NreBTeTZRH3ODwea00wdabzS8bihm65tesfYAED2oTOs8w4kWde00SJHILSa7'
    //     );
    //     $checkout = $stripe->checkout->sessions->create([
    //         'success_url' => 'http://localhost:8080/',
    //         'cancel_url' => 'http://localhost:8080/avocatProfile/',
    //         'line_items' => [
    //             [
    //                 'price_data' => [
    //                     'currency' => 'mad',
    //                     'unit_amount' => $consultation["prix"] * 100,
    //                     'product_data' => [
    //                         'name' => "consultation " . $consultation["type"]
    //                     ]
    //                 ],

    //                 'quantity' => 1,
    //             ],
    //         ],
    //         'mode' => 'payment',
    //     ]);
    // }
}
