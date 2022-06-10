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
        $sql = "SELECT o.id_order,p.nom as nom_pers,p.ville,p.email,pro.nom,pro.prix,pro.image,c.nom_cat,o.qtte,o.price_total,o.done_at,o.status from personne p,produit pro,categories c,orders o where p.id_pers=o.id_pers and pro.id_produit=o.id_produit and pro.id_category=c.id_cat";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute())
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        return 0;
    }

    // Function to update Product
    public function updateProduct($data, $id)
    {
        if ($this->getProductById($id)) {
            $sql = "UPDATE produit SET 
            nom=?,
            description=?,
            prix=?,
            image=0,
            id_category=?,
            quantite=?
            where id_produit = ?
            ";
            $sql = $this->connect()->prepare($sql);
            if ($sql->execute([$data['nom'], $data['description'], $data['prix'], $data['id_category'], $data['quantite'], $id]))
                return 1;
            return 0;
        }
    }
}
