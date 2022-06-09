<?php
header('access-control-allow-origin: *');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');
class ProductController
{
  // Display all products
  public function index()
  {
    $all_products = new Product();
    if ($all_products->get_all_products()) {
      echo json_encode($all_products->get_all_products());
    } else {
      echo json_encode(array(
        'message' => 'There is no Products available for this moment'
      ));
    }
  }
  //get single product
  public function read_single_product($id)
  {
    $single_product = new Product();
    if ($single_product->getProductById($id)) {
      echo json_encode($single_product->getProductById($id));
    } else {
      echo json_encode(array(
        'message' => 'error'
      ));
    }
  }

  // create new product
  public function create()
  {
    $all_products = new Product();
    $data = [
      'nom' => trim($_POST['nom']),
      'description' => trim($_POST['description']),
      'prix' => trim($_POST['prix']),
      'image' => trim($_POST['image']),
      'id_category' => trim($_POST['id_category']),
      'quantite' => trim($_POST['quantite'])
    ];
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      if ($all_products->addProduct($data)) {
        echo json_encode(array(
          'message' => 'Product Added successfully'
        ));
      } else {
        echo json_encode(array(
          'error' => 'Error on Adding new Product'
        ));
      }
    }
  }

  //delete product
  public function DeleteProduct($id)
  {
    $Delete = new Product();
    if ($Delete->DeleteProduct($id)) {
      echo json_encode(array(
        'message' => 'Product Deleted Successfully'
      ));
    } else {
      echo json_encode(array(
        'message' => 'Error on Deleting product'
      ));
    }
  }

  // Update product
  public function updateProduct($id)
  {
    $update = new Product();
    $data = [
      'nom' => trim($_POST['nom']),
      'description' => trim($_POST['description']),
      'prix' => trim($_POST['prix']),
      // 'image' => uploadImage(),
      'id_category' => trim($_POST['id_category']),
      'quantite' => trim($_POST['quantite'])
    ];
    if ($update->updateProduct($data, $id)) {
      echo json_encode(array(
        'message' => 'Product Updated successfully'
      ));
    } else {
      echo json_encode(array(
        'error' => 'Error on updating Product'
      ));
    }
  }
}
