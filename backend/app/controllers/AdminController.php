<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class AdminController{
    public function index(){
        $number_of_products=new Product();
        $number_of_clients=new User();
        $number_of_orders=new Order();
        $number_of_contacts=new Contact();
        $data=[
            'number_of_products'=>$number_of_products->Number_of_products(),
            'number_of_clients'=>$number_of_clients->number_of_client(),
            'number_of_orders'=>$number_of_orders->number_of_order(),
            'number_of_contacts'=>$number_of_contacts->number_of_contact(),
        ];

        echo json_encode($data);
    }
    // Display information admin
    public function DataAdmin()
    {
        $admin = new Admin();
        echo json_encode($admin->get_data_admin());
    }
}