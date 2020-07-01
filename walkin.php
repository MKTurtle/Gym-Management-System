<?php

$title = 'Walk In';
$currentPage = 'Walk In';
$pageFile = 'walkin';

require "./app/database.php";
require "./app/WalkinController.php";

$walkin = new Walkin();

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if ($_POST['member-type'] == "nonMember") {
        $walkin->insert($_POST['member-type'], $_POST['name']);

        $walkin->sales('walkin', $_POST['name'], $_POST['promo'], $_POST['price']);

        $msg = "Walkin Successful";
    } elseif ($_POST['member-type'] == "member") {
        $walkin->insert($_POST['member-type'], $_POST['name']);

        $msg = "Walkin Successful";
    } else {
        $msg = "Walkin Error";
    }
    

    
}


?>

<?php include('./template/head.php'); ?>




<body>
    <?php include('./template/navbar.php'); ?>

    <div class="content">
        <div class="walk-in">
            <h2> Walk In Registration</h2>
            <form action="#" method="post">
                <p class="walk-in-info">
                    <label for="member-type">Member type</label>

                    <select id="membertype" name="member-type" onchange="hidePromo()">
                        <option value="nonMember">Non Member</option>
                        <option value="member">Member</option>
                    </select>
                </p>

                <p class="walk-in-info">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" autocomplete="off" required>
                </p>

                <p class="walk-in-info" id = "promoInfo">
                    <label for="promo">Promo</label>
                    <select id="promo" name="promo" onchange="changePromo()">
                        <option value="none">None</option>
                        <option value="student">Student</option>
                    </select>
                </p>

                <p class="walk-in-info" id = "priceInfo">
                    <label for="price">Price</label>
                    <input type="text" id="price" name="price" autocomplete="off" value="180" readonly="readonly">
                </p>

                <input type="submit">
            </form>
            <h4> <?php echo "$msg"; ?> </h4>
        </div>


    </div>

    <script type="text/javascript" src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/ui/1.10.1/jquery-ui.min.js"></script>
    <?php include('./template/footer.php'); ?>