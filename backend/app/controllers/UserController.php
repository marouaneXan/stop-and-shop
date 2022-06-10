<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
class UserController
{
    // Display all customers
    public function index()
    {
        $users = new User();
        if ($users->get_all_customers()) {
            echo json_encode($users->get_all_customers());
        } else {
            echo json_encode(array(
                'message' => 'There is no Products available for this moment'
            ));
        }
    }

  //delete customer
  public function DeleteCustomers($id)
  {
    $Delete = new User();
    if ($Delete->DeleteCustomer($id)) {
      echo json_encode(array(
        'message' => 'Customer Deleted Successfully'
      ));
    } else {
      echo json_encode(array(
        'error' => 'Error on Deleting Customer'
      ));
    }
  }
}
