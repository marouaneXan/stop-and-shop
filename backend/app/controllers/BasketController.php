<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class BasketController
{

    public function index(){
        echo 'hello';
    }
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
    public function create()
    {
        $add = new Basket();
        $data = [
            'qtte' => $_POST['qtte'],
            'id_pers' => $_POST['id_pers'],
            'id_produit' => $_POST['id_produit'],
            'price_total' => $_POST['price_total']
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


    // Update quantite of product in basket
    public function updateQteOfProduct($id)
    {
        $update = new Basket();
        $data = [
            'qtte'=>trim($_POST['qtte']),
            'price_total'=>trim($_POST['price_total'])
        ];
        if ($update->updateQteOfProduct($data, $id)) {
            echo json_encode(array(
                'message' => 'Quantite Updated successfully'
            ));
        } else {
            echo json_encode(array(
                'error' => 'Error on updating quantite'
            ));
        }
    }
}
