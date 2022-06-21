<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class BasketController
{

    public function index($id){
        $count=new Basket();
        $numberProductBasket=$count->getNumberOfProductInBasketById($id);
        echo json_encode($numberProductBasket);
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

    // create new product in basket
    public function create()
    {
        $add = new Basket();
        $data = [
            'qtte' => 1,
            'id_pers' => $_POST['id_pers'],
            'id_produit' => $_POST['id_produit'],
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($add->ProductAlreadyExist($data['id_produit'],$data['id_pers'])==0) {
                $add->addProductToBasket($data);
                echo json_encode(array(
                    'message' => 'Product Added successfully In Your Basket'
                ));
            } else {
                echo json_encode(array(
                    'error' => 'Product already exist in the basket'
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
                'error' => 'Error on Deleting this product'
            ));
        }
    }

}
