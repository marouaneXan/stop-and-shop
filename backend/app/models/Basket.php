<?php

class Basket extends DB
{

    //
    public function get_basket_by_id($id)
    {
        $sql = "basket.id_basket,p.nom as nom_pers,p.ville,p.email,pro.nom,pro.prix,pro.image,c.nom_cat,basket.qtte,basket.price_total from personne p,produit pro,categories c,basket where p.id_pers=basket.id_pers and pro.id_produit=basket.id_basket and pro.id_category=c.id_cat and basket.id_basket=?";
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
