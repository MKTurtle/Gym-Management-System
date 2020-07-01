<?php

class Walkin extends DB
{

    function __construct(){
        parent::__construct();
    }


    function insert($memberType, $name) {
        $query = $this->query("insert into attendance (name, member) values ('$name', '$memberType');");

        return $query;
    }

    function sales($memberType, $name, $promo, $price) {
        $query = $this->query("insert into sale (name, reason, promo, profit) values ('$name', '$memberType', '$promo', $price);");

        return $query;
    }
}

?>