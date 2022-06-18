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

  //get orders by id user
  public function readOrdersByIdClient($id)
  {
      $single_product = new Basket();
      if ($single_product->get_basket_by_id($id)) {
          echo json_encode($single_product->get_basket_by_id($id));
      } else {
          echo json_encode(array(
              'error' => 'empty'
          ));
      }
  }
  // Update status order
  public function updateStatusOrder($id)
  {
    $update = new Order();
    $status = trim($_POST['status']);
    if ($update->updateStatus($status, $id)) {
      echo json_encode(array(
        'message' => 'Status Updated successfully'
      ));
    } else {
      echo json_encode(array(
        'error' => 'Error on updating Status'
      ));
    }
  }

  //function to insert order after payment
  public function InsertOrderAfterPayment($id)
  {
    $basket = new Basket();
    $data=[
      'id_pers' => trim($_POST['id_pers']),
      'id_produit' => trim($_POST['id_produit']),
      'qtte' => trim($_POST['qtte']),
      // 'status' => trim($_POST['status'])
    ];
    if($basket->addOrder($data)){
      $basket->DeleteProductFromBasketAfterPayment($id);
      echo json_encode(array(
        'message'=>'Payement successfully'
      ));
    }else{
      echo json_encode(array(
        'error'=>'error on Payment'
      ));
    }
  }
}
