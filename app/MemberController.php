<?php

class Member extends DB
{

    function __construct(){
        parent::__construct();
    }


    function selectAll() {
        $allDetails = $this->query("SELECT id, name, rfid, DATE(membership) AS membership, if(membership >= CURDATE(), 'Active', 'Inactive') AS status FROM member WHERE removed = 0;");
        
        return $allDetails;
    }

    function expired() {
        $allDetails = $this->query("SELECT name FROM member WHERE membership <= CURDATE();");
        
        return $allDetails;
    }

    function checker() {
        $allDetails = $this->queryRow("SELECT name FROM member WHERE membership <= CURDATE();");
        
        return $allDetails;
    }
}

?>