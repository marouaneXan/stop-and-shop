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
}
