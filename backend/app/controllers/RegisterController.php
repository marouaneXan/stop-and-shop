<?php
header('Access-Control-Allow-Origin:*');
header('Content-Type: application/json');
header('Access-Control-Allow-Methods:*');
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

class RegisterController
{
    // Create new account for client
    public function sign_up()
    {
        $register = new User();
        // stocking data
        $data = [
            'nom' => trim($_POST['nom']),
            'prenom' => trim($_POST['prenom']),
            'date_naissance' => trim($_POST['date_naissance']),
            'ville' => trim($_POST['ville']),
            'email' => trim($_POST['email']),
            'password' => password_hash(trim($_POST['password']), PASSWORD_DEFAULT)
        ];
        // check if the method is POST
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // check if email already exist
            if ($register->email_already_exist($data['email'])) {
                echo json_encode(
                    array('error' => 'This email is already exist')
                );
            } elseif ($register->sign_up($data)) {
                echo json_encode(
                    array('message' => 'Create new account successfully')
                );
            }
        }
    }
    public function login(){
        $register = new User();
        $data = [
            'email' => trim($_POST['email']),
            'password' => trim($_POST['password'])
        ];
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // print_r($register->login($data));
            if ($register->login($data)) {
                echo json_encode(
                    array(
                        'user_info' => $register->login($data),
                    )
                );
            } else {
                echo json_encode(
                    array('error' => 'error Login')
                );
            }
        }
    }
}
