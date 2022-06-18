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
        $sql = "SELECT o.id_order,p.nom as nom_pers,p.ville,p.email,pro.nom,pro.prix,pro.image,c.nom_cat,o.qtte,o.done_at,o.status from personne p,produit pro,categories c,orders o where p.id_pers=o.id_pers and pro.id_produit=o.id_produit and pro.id_category=c.id_cat";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute())
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        return 0;
    }

    // get all order by id client
    public function getOrderByIdClient($id)
    {
        $sql = "SELECT o.id_order,p.ville,pro.nom,pro.prix,pro.image,o.qtte,o.done_at,o.status from personne p,produit pro,orders o where p.id_pers=o.id_pers and pro.id_produit=o.id_produit  and o.id_pers=? ";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute([$id]))
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        return 0;
    }

    // Function to update status of order
    public function updateStatus($status, $id)
    {
            $sql = "UPDATE orders SET status=? where id_order like ?";
            $sql = $this->connect()->prepare($sql);
            if ($sql->execute([$status,$id]))
                return 1;
            return 0;
    }


    
    
}
