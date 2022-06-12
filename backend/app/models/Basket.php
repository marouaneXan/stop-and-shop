<?php

class Basket extends DB
{

    //
    public function get_basket_by_id($id)
    {
        $sql = "select b.id_basket,p.nom as nom_pers,p.ville,p.email,pro.nom,pro.prix,pro.image,c.nom_cat,b.qtte,b.price_total from personne p,produit pro,categories c,b where p.id_pers=b.id_pers and pro.id_produit=b.id_b and pro.id_category=c.id_cat and b.id_pers=?";
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

    // Function to update status of order
    public function updateQteOfProduct($qte, $id)
    {
        $sql = "UPDATE basket SET qtte=? where id_basket like ?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute([$qte, $id]))
            return 1;
        return 0;
    }
}
