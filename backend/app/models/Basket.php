<?php

class Basket extends DB
{

    //
    public function get_basket_by_id($id)
    {
        $sql = "SELECT b.id_basket,p.nom as nom_pers,p.ville,p.email,pro.nom,pro.prix,pro.image,c.nom_cat,b.qtte from personne p,produit pro,categories c,basket b where p.id_pers=b.id_pers and pro.id_produit=b.id_produit and pro.id_category=c.id_cat and b.id_pers=?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id))) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return 'empty';
    }
    //
    public function ProductAlreadyExist($id_produit){
        $sql="SELECT * from basket where id_produit=?";
        $sql = $this->connect()->prepare($sql);
        // return $sql->execute(array($id_produit));
        if($sql->execute(array($id_produit))){
            if($sql->rowCount()>0)
              return 1;
        }return 0;
    }
    // Function to add product to basket
    public function addProductToBasket($data)
    {
        $sql1 = "INSERT INTO `basket`(`id_pers`, `id_produit`, `qtte`) VALUES (?,?,?)";
        $sql1 = $this->connect()->prepare($sql1);
        if ($sql1->execute([$data['id_pers'], $data['id_produit'], $data['qtte']]))
            $sql2="SELECT p.quantite from produit p where id_produit=?";
            $sql2->execute([$data['id_produit']]);

        return 0;
    }

    //delete contact
    public function DeleteProductFromBasket($id)
    {
        $sql = "DELETE FROM basket WHERE id_basket=?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id)))
            return 1;
        return 0;
    }

    // Function to update status of order
    public function updateQteOfProduct($data, $id)
    {
        $sql = "UPDATE basket SET qtte=? where id_basket = ?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute([$data['qtte'], $id]))
            return 1;
        return 0;
    }

    //get number of products in basket
    public function getNumberOfProductInBasketById($id_pers)
    {
        $sql = "SELECT * FROM basket where id_pers = ?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id_pers)))
            return $sql->rowCount();
        return 0;
    }
    public function getAllProductInBasket(){
        $sql="select * from basket";
        $sql = $this->connect()->prepare($sql);
        if($sql->execute()){
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }return 0;
    }
}
