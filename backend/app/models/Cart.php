<?php

class Cart extends DB {

    public function get_cart_by_id($id){
        $sql="SELECT * FROM cart where id like ?";
        $sql=$this->connect()->prepare($sql);
        if($sql->execute(array($id))){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }return 'empty';
    }
}