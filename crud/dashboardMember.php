<?php

require "../app/database.php";

$db = new DB;

$query = "";
?>

<!DOCTYPE html>
<html>
    <body>
        <?php 

        if(isset($_POST['date-select'])) {

            $q = $_POST['date-select'];

            if ($q == 0) {
                $query = $db->queryRow("SELECT * FROM attendance WHERE member = 'member';");

                echo $query;
            } else {
                $month = date("n", strtotime("$q"));
                $year = date("Y", strtotime("$q"));
    
                $query = $db->queryRow("SELECT * FROM attendance WHERE member = 'member' and month(date) = $month AND YEAR(date) = $year;");
    
                echo $query;
            }

            
        }
        ?>
    </body>
</html>
