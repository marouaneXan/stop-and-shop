<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class BasketController
{

    //get single cart
    public function read_single_product($id)
    {
        $single_product = new Basket();
        if ($single_product->get_cart_by_id($id)) {
            echo json_encode($single_product->get_cart_by_id($id));
        } else {
            echo json_encode(array(
                'error' => 'empty'
            ));
        }
    }
}
