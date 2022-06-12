<?php

class Basket extends DB
{

    //
    public function get_cart_by_id($id)
    {
        $sql = "cart.id_cart,p.nom as nom_pers,p.ville,p.email,pro.nom,pro.prix,pro.image,c.nom_cat,cart.qtte,cart.price_total from personne p,produit pro,categories c,cart where p.id_pers=cart.id_pers and pro.id_produit=cart.id_cart and pro.id_category=c.id_cat and cart.id_cart=?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id))) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return 'empty';
    }

    // Function to add product to basket
    public function addProductToBasket($data)
    {
        $sql = "INSERT INTO `basket`(`id_pers`, `id_produit`, `qtte`, `price_total`) VALUES (?,?,?,?,?)";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute([$data['id_pers'], $data['id_produit'], $data['qtte'], $data['price_total']]))
            return 1;
        return 0;
    }

    //delete contact
    public function DeleteProductFromBasket($id)
    {
        $sql = "DELETE FROM basket WHERE id=?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id)))
            return 1;
        return 0;
    }
}
