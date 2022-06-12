<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class BasketController
{

    //get single cart
    public function readBasketProductById($id)
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

    // create new product
    public function create($id_pers, $id_produit)
    {
        $add = new Basket();
        $data = [
            'qte' => $_POST['qtte'],
            'id_pers' => $id_pers,
            'id_produit' => $id_produit
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($add->addProductToBasket($data)) {
                echo json_encode(array(
                    'message' => 'Product Added successfully In Your Basket'
                ));
            } else {
                echo json_encode(array(
                    'error' => 'Error on Adding new Product To Basket'
                ));
            }
        }
    }

    //delete product
  public function DeleteProductFromBasket($id_basket)
  {
    $Delete = new Basket();
    if ($Delete->DeleteProductFromBasket($id_basket)) {
      echo json_encode(array(
        'message' => 'Product Deleted Successfully'
      ));
    } else {
      echo json_encode(array(
        'message' => 'Error on Deleting this product'
      ));
    }
  }
}
