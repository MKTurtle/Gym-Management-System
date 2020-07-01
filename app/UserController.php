<?php

class User extends DB
{

    function __construct(){
        parent::__construct();
    }


    function selectAll() {

        $allDetails = $this->query("SELECT user.id, user.username, user.staff_id, staff.name, user.account, position.name AS position_name FROM user
                                    INNER JOIN staff ON user.staff_id = staff.id
                                    INNER JOIN position ON staff.position_id = position.id
                                    WHERE user.removed = 0;");
        
        return $allDetails;
    }
}

?>