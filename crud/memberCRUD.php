<?php

require "../app/database.php";

$db = new DB;

$query = "";

if(isset($_POST['save'])) {

    if($_POST['extend'] == 0) {
        $memberId = $_POST['member-id'];
        $rfid = $_POST['rfid'];
        $membership = date("Y-m-d H:i:s", strtotime($_POST['membership-date']));
    
        $query = $db->query("UPDATE member SET rfid=$rfid, membership='$membership' WHERE id=$memberId");
    
        header('Location: ../member.php');
        exit;
    } else {

        $name = $_POST['namee'];
        $promo = $_POST['promo'];
        $price = $_POST['totalprice'];
        $extend = $_POST['extend'];

        $sale = $db->query("INSERT INTO sale (name, reason, promo, profit) VALUES ('$name', 'membership renewal', '$promo', $price);");

        $memberId = $_POST['member-id'];
        $rfid = $_POST['rfid'];
        $membership = date("Y-m-d H:i:s", strtotime("+$extend months", strtotime($_POST['membership-date'])));
    
        $query = $db->query("UPDATE member SET rfid=$rfid, membership='$membership' WHERE id=$memberId");

        header('Location: ../member.php');
        exit;
    }
    
} 

if(isset($_POST['remove'])) {
    $memberId = $_POST['member-id'];

    $query = $db->query("UPDATE member SET removed=1 WHERE id=$memberId");

    header('Location: ../member.php');
    exit;
} 

if(isset($_POST['add-member'])) {
    $name = $_POST['name'];
    $rfid = $_POST['rfid'];
    $membership = date("Y-m-d H:i:s", strtotime($_POST['membership']));

    $promo = $_POST['promo'];
    $price = $_POST['total'];

    $query = $db->query("INSERT INTO member (name, rfid, membership) VALUES ('$name', $rfid, '$membership');");

    $sale = $db->query("INSERT INTO sale (name, reason, promo, profit) VALUES ('$name', 'new membership', '$promo', $price);");

    header('Location: ../member.php');
    exit;
} 


?>

?>