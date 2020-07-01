<?php

class Rfid extends DB
{

    function __construct(){
        parent::__construct();
    }

    function selectAll($rfid) {
        $allDetails = $this->query("SELECT id, name, rfid, DATE(membership) AS membership, if(membership >= CURDATE(), 'Active', 'Inactive') AS status FROM member WHERE rfid = $rfid AND removed = 0;");

        return $allDetails;
    }


    function checker($rfid) {
        $rowCheck = $this->queryRow("SELECT * FROM member WHERE rfid = $rfid AND removed = 0;");
        
        return $rowCheck;
    }

    function dateChecker($rfid) {
        $rowCheck = $this->queryRow("SELECT * FROM member WHERE  rfid = $rfid AND membership >= CURDATE() AND removed = 0;");
        
        return $rowCheck;
    }

    function insert($rfid) {

        $getName = $this->query("SELECT name FROM member where rfid=$rfid");
        
        foreach ($getName as $result) {
            $name = $result['name'];
        }

        $query = $this->query("insert into attendance (name, member) values ('$name', 'member');");

        return $query;
    }
}

?>