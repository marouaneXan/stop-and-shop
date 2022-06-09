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
}
