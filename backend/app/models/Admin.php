<?php

class Admin extends DB
{
  //Function to display info admin
  public function get_data_admin()
  {
    $sql = "SELECT * from personne where role like 1";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute())
      return $sql->fetchAll(PDO::FETCH_ASSOC);
    return 0;
  }

  // Function to update Product
  public function updateDataAdmin($data)
  {
          $sql = "UPDATE personne SET 
          nom=?,
          prenom=?,
          date_naissance=?,
          ville=?,
          email=?
          where role = 1
          ";
          $sql = $this->connect()->prepare($sql);
          if ($sql->execute([$data['nom'], $data['prenom'], $data['date_naissance'], $data['ville'], $data['email']]))
              return 1;
          return 0;
  }
}
