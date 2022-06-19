<?php

class Basket extends DB
{

    //
    public function get_basket_by_id($id)
    {
        $sql = "SELECT b.id_basket,p.nom as nom_pers,p.ville,p.email,pro.id_produit,pro.nom,pro.prix,pro.quantite,pro.image,c.nom_cat,b.qtte from personne p,produit pro,categories c,basket b where p.id_pers=b.id_pers and pro.id_produit=b.id_produit and pro.id_category=c.id_cat and b.id_pers=?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id))) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return 'empty';
    }
    //
    public function ProductAlreadyExist($id_produit, $id_pers)
    {
        $sql = "SELECT * from basket where id_produit=?and id_pers=?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id_produit, $id_pers))) {
            if ($sql->rowCount() > 0)
                return 1;
        }
        return 0;
    }
    // Function to add product to basket
    public function addProductToBasket($data)
    {
        $sql = "INSERT INTO `basket`(`id_pers`, `id_produit`, `qtte`) VALUES (?,?,?)";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute([$data['id_pers'], $data['id_produit'], $data['qtte']])) {
            $query = "SELECT quantite from produit where id_produit =?";
            $query = $this->connect()->prepare($query);
            if ($query->execute([$data['id_produit']])) {
                $res = $query->fetch(PDO::FETCH_ASSOC);
                if ($res['quantite'] != 0) {
                    $res['quantite']--;
                    $query2 = "UPDATE produit SET quantite=" . $res['quantite'] . " where id_produit =?";
                    $query2 = $this->connect()->prepare($query2);
                    $query2->execute([$data['id_produit']]);
                }
            }
            return 1;
        }
        return 'Quantite equal 0';
    }

    //delete contact
    public function DeleteProductFromBasket($id)
    {
        $sql = "DELETE FROM basket WHERE id_basket=?";
        $select = "SELECT id_produit from basket where id_basket = ?";
        $sql = $this->connect()->prepare($sql);
        $select = $this->connect()->prepare($select);
        $select->execute(array($id));
        $res = $select->fetch(PDO::FETCH_ASSOC);
        if ($sql->execute([$id]) && $res) {
            $query = "UPDATE produit SET quantite=quantite+1 where id_produit =?";
            $query = $this->connect()->prepare($query);
            $query->execute([$res['id_produit']]);
            return true;
        }
        return false;
    }

    //delete contact
    public function DeleteProductFromBasketAfterPayment($id)
    {
        $sql = "DELETE FROM basket WHERE id_basket=?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute([$id]))
            return 1;
        return 0;
    }

    // Function to add order
    public function addOrder($data)
    {
        $sql = "insert into orders(id_pers,id_produit,qtte) values (?,?,?)";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute([$data['id_pers'], $data['id_produit'], $data['qtte']]))
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
    public function getAllProductInBasket()
    {
        $sql = "select * from basket";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute()) {
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return 0;
    }
}
