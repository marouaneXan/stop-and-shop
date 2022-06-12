<?php

class Product extends DB
{
    //Function to display all product
    public function Number_of_products()
    {
        $sql = "SELECT * from produit";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute())
            return $sql->rowCount();
        return 0;
    }

    //Function to display all product
    public function get_all_products()
    {
        $sql = "SELECT p.id_produit,p.nom,p.description,p.prix,p.image,c.nom_cat,p.quantite FROM produit p,categories c where p.id_category=c.id_cat";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute())
            return $sql->fetchAll(PDO::FETCH_ASSOC);
        return 0;
    }

    //Function to get product by id
    public function getProductById($id)
    {
        $sql = "SELECT p.id_produit,p.nom,p.description,p.prix,p.image,c.nom_cat,p.quantite FROM produit p,categories c where p.id_category=c.id_cat and p.id_produit=?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id)))
            return $sql->fetch(PDO::FETCH_ASSOC);
        return 0;
    }

    // Function to search for product
    public function search_product($nom_cat,$nom_produit)
    {
        if(!empty($nom_cat) && empty($nom_produit)){
            $sql="SELECT p.id_produit,p.nom,p.description,p.prix,p.image,c.nom_cat,p.quantite FROM produit p,categories c where p.id_category=c.id_cat and c.nom_cat like '$nom_cat'";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute())
            return $sql->fetchAll(PDO::FETCH_ASSOC);
                return 0;
        }elseif(empty($nom_cat) && !empty($nom_produit)){
            $sql="SELECT p.id_produit,p.nom,p.description,p.prix,p.image,c.nom_cat,p.quantite FROM produit p,categories c where p.id_category=c.id_cat and p.nom like'$nom_produit'";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute())
            return $sql->fetchAll(PDO::FETCH_ASSOC);
                return 0;
        }elseif(!empty($nom_produit) && !empty($nom_cat)){
            $sql="SELECT p.id_produit,p.nom,p.description,p.prix,p.image,c.nom_cat,p.quantite FROM produit p,categories c where p.id_category=c.id_cat and (p.nom like '$nom_produit' and c.nom_cat like'$nom_cat' )";
            $sql=$this->connect()->prepare($sql);
            if($sql->execute())
                return $sql->fetchAll(PDO::FETCH_ASSOC);
            return 0;
        }
    }


    // Function to add new Product
    public function addProduct($data)
    {
        $sql = "INSERT INTO produit (`nom`,`description`,`prix`,`image`,`id_category`,`quantite`) VALUES (?,?,?,?,?,?)";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute([$data['nom'], $data['description'], $data['prix'],$data['image'], $data['id_category'], $data['quantite']]))
            return 1;
        return 0;
    }

    //Function to delete product
    public function DeleteProduct($id)
    {
        $sql = "DELETE FROM produit WHERE id_produit = ?";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id)))
            return 1;
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
            image=?,
            id_category=?,
            quantite=?
            where id_produit = ?
            ";
            $sql = $this->connect()->prepare($sql);
            if ($sql->execute([$data['nom'], $data['description'], $data['prix'], $data['id_category'],'image1.png', $data['quantite'], $id]))
                return 1;
            return 0;
        }
    }
}
