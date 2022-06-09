<?php

class Category extends DB
{

   // get number of category
   public function number_of_category($data)
   {
      $sql = "SELECT * FROM categories";
      $sql = $this->connect()->prepare($sql);
      if ($sql->execute())
         return $sql->rowCount();
      return 0;
   }
   
   // Function to get all gategories
   public function get_all_categories()
   {
      $sql = "SELECT * FROM categories";
      $sql = $this->connect()->prepare($sql);
      if ($sql->execute())
         return $sql->fetchAll(PDO::FETCH_ASSOC);
      return 0;
   }

   // Function to add new category
   public function addCategory($nom_cat)
   {
      $sql = "INSERT INTO categories (`nom_cat`) values(?)";
      $sql = $this->connect()->prepare($sql);
      if ($sql->execute([$nom_cat]))
         return 1;
      return 0;
   }
}
