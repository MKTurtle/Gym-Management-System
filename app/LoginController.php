<?php

class Login extends DB
{

    function __construct(){
        parent::__construct();
    }


    function selectAll($username, $password) {
        $allDetails = $this->query("SELECT * FROM user WHERE username = '$username' AND password = '$password';");
        
        return $allDetails;
    }

    function checker($username, $password) {
        $allDetails = $this->queryRow("SELECT * FROM user WHERE username = '$username' AND password = '$password';");
        
        return $allDetails;
    }
}

?>