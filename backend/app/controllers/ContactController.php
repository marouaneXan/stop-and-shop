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


  // create new product
  public function addContact()
  {
    $contact = new Contact();
    $data = [
      'email' => trim($_POST['email']),
      'subject' => trim($_POST['subject']),
      'message' => trim($_POST['message'])
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($contact->addContact($data)) {
        echo json_encode(array(
          'message' => 'Contact Added successfully'
        ));
      } else {
        echo json_encode(array(
          'error' => 'Error on Adding new Contact'
        ));
      }
    }
  }
  
  //delete contact
  public function DeleteContact($id)
  {
    $Delete = new Contact();
    if ($Delete->DeleteContact($id)) {
      echo json_encode(array(
        'message' => 'Contact Deleted Successfully'
      ));
    } else {
      echo json_encode(array(
        'message' => 'Error on Deleting Contact'
      ));
    }
  }
}
