<?php

class Order extends DB
{

    // get number of order
    public function number_of_order()
    {
        $sql = "SELECT * FROM orders";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute())
            return $sql->rowCount();
        return 0;
    }

    // get all order
    public function get_all_orders()
    {
        $sql = "SELECT o.id_order,p.nom as nom_pers,p.ville,p.email,pro.nom,pro.prix,pro.image,c.nom_cat,o.qtte,o.price_total,o.done_at from personne p,produit pro,categories c,orders o where p.id_pers=o.id_pers and pro.id_produit=o.id_produit and pro.id_category=c.id_cat";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute())
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        return 0;
    }
}
