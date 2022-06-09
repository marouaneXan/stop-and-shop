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
}
