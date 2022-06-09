<?php

class User extends DB
{
  // create new account for client
  public function sign_up($data)
  {
    $sql = "INSERT INTO personne(`nom`, `prenom`, `date_naissance`, `ville`, `email`, `password`, `role`) VALUES (?,?,?,?,?,?,?)";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute(array($data['nom'], $data['prenom'], $data['date_naissance'], $data['ville'], $data['email'], $data['password'],0)))
      return 1;
    return 0;
  }

  // login for client
  public function login($data)
  {
    $sql = "SELECT * FROM personne";
    $sql = $this->connect()->prepare($sql);
    $sql->execute();
    $result=$sql->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
      if (password_verify($data['password'], $row['password']) && $data['email']===$row['email'])
        return $row;
    }return 0;
  }

  // check if the adress email already exist

  public function email_already_exist($email)
  {
    $sql = "SELECT * FROM personne where email like ?";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute(array($email)))
      if ($sql->rowCount()>0)
        return 1;
    return 0;
  }

  // get number of client
  public function number_of_client()
  {
    $sql = "SELECT * FROM personne where role like 0";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute())
      return $sql->rowCount();
    return 0;
  }

  //delete client
  public function DeleteUser($id)
    {
        $sql = "DELETE FROM personne WHERE id_pers=? and role like 0";
        $sql = $this->connect()->prepare($sql);
        if ($sql->execute(array($id)))
            return 1;
        return 0;
    }
}
