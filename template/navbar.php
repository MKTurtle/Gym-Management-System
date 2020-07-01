<div class="navbar">
    <img src="./web/images/uniflex.jpg" alt="uniflex">
    <ul class="nav">
        <?php

            $userControl = $_SESSION["account"];


                if($userControl == "admin") {
                    $urls = array(
                        'Dashboard' => './',
                        'Users' => './user.php',
                        'Members' => './member.php',
                        'Attenance' => './attendance.php',
                        'RFID' => './rfid.php', //to be changed
                        'Walk In' => './walkin.php', //to be changed
                        'Schedule' => './schedule.php', 
                        'Log Out' => './logout.php', 
                    );
                } else {
                    $urls = array(
                        'Dashboard' => './',
                        'Members' => './member.php',
                        'Attenance' => './attendance.php',
                        'RFID' => './rfid.php', //to be changed
                        'Walk In' => './walkin.php', //to be changed
                        'Schedule' => './schedule.php', 
                        'Log Out' => './logout.php', 
                    );
                }

            foreach ($urls as $name => $url) {
                print '<li '.(($currentPage === $name) ? ' class="navbar-active" ': '').
                    '><a href="'.$url.'">'.$name.'</a></li>';
            }
        ?>
    </ul>
</div>


<div class="container"> <!-- Container of navbar & content -->

    

