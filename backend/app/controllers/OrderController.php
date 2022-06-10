<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
class OrderController
{
  // Display all orders
  public function index()
  {
    $orders = new Order();
    if ($orders->get_all_orders()) {
      echo json_encode($orders->get_all_orders());
    } else {
      echo json_encode(array(
        'message' => 'There is no order yet'
      ));
    }
  }
}
