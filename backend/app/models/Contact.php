<?php
class Contact extends DB
{
  // get number of order
  public function number_of_contact()
  {
    $sql = "SELECT * FROM contact";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute())
      return $sql->rowCount();
    return 0;
  }

  // Function to get all gategories
  public function get_all_contacts()
  {
    $sql = "SELECT * FROM contact  ORDER BY id DESC";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute())
      return $sql->fetchAll(PDO::FETCH_ASSOC);
    return 0;
  }




  // Function to add new Contact
  public function addContact($data)
  {
    $sql = "INSERT INTO `contact`( `email`, `subject`, `message`) VALUES (?,?,?)";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute([$data['email'], $data['subject'], $data['subject'] ]))
      return 1;
    return 0;
  }

  //delete contact
  public function DeleteContact($id)
  {
    $sql = "DELETE FROM contact WHERE id=?";
    $sql = $this->connect()->prepare($sql);
    if ($sql->execute(array($id)))
      return 1;
    return 0;
  }
}
