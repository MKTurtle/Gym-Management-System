<?php

$title = 'RFID Scanner';
$currentPage = 'RFID';
$pageFile = 'rfid';

require "./app/database.php";
require "./app/RfidController.php";

$rfid = new Rfid();

$msg = "";
$memberId = "";
$memberName = "";
$memberStatus = "";
$tryy = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($rfid->checker($_POST['rfid']) === 1) {

        foreach ($rfid->selectAll($_POST['rfid']) as $members) {
            $memberId = $members['id'];
            $memberName = $members['name'];
            $memberStatus = $members['status'];
            $tryy = "<img src='./web/images/members/$memberId.png'  onerror=\"this.src='uniflex.jpg'\" alt=''>";
        }

        if ($rfid->dateChecker($_POST['rfid']) === 1) {
            $rfid->insert($_POST['rfid']);

            $msg = "Scan successful";
        } else {
            $msg = "Membership has expired";
        }

    } else {
        $msg = "RFID Code is nonexisting on the database";
    }
}

?>

<?php include('./template/head.php'); ?>

<body>
    <?php include('./template/navbar.php'); ?>

    <div class="content">
        <div class="rfid-scanner">
            <h2> RFID Scanner</h2>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <input type="number" id="rfid" name="rfid" onblur="this.focus()" autofocus>
            </form>
        </div>
        <div class="member-info">
            <?php echo $tryy; ?>
            <h4> <?php echo "$memberName"; ?> </h4>
            <h4> <?php echo "$memberStatus"; ?> </h4>
            <h4 style="color: red;"> <?php echo "$msg"; ?> </h4>
        </div>
    </div>

    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>

    <?php include('./template/footer.php'); ?>