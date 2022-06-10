<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
class ContactController
{
  //Display all contact
  public function index()
  {
    $all_contacts = new Contact();
    if ($all_contacts->get_all_contacts()) {
      echo json_encode($all_contacts->get_all_contacts());
    } else {
      echo json_encode(array(
        'error' => 'Empty'
      ));
    }
  }
}
