<?php

class Attendance extends DB
{

    function __construct(){
        parent::__construct();
    }


    function selectAll() {

        $allDetails = $this->query("SELECT * FROM attendance");
        
        return $allDetails;
    }
}

?>