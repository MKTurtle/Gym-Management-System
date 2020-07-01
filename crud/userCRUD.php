<?php

require "../app/database.php";

$db = new DB;

$query = "";
$query1 = "";
$query2 = "";

if(isset($_POST['save'])) {
    $user_id = $_POST['userId'];
    $username = $_POST['username'];
    $account = $_POST['account'];
    $staffId = $_POST['staff-id'];
    $position_id = ($_POST['position'] == "owner") ? 1 : 2;

    echo $account;
    echo $staffId;

    $query1 = $db->query("UPDATE user SET username='$username', account='$account' WHERE id=$user_id");
    $query2 = $db->query("UPDATE staff SET position_id=$position_id WHERE id=$staffId");

    header('Location: ../user.php');
    exit;
} 

if(isset($_POST['remove'])) {
    $user_id = $_POST['userId'];

    $query = $db->query("UPDATE user SET removed=1 WHERE id=$user_id");

    header('Location: ../user.php');
    exit;
} 

if(isset($_POST['add-user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $account = $_POST['account'];
    $fullName = $_POST['full-name'];
    $position_id = ($_POST['position'] == "owner") ? 1 : 2;

    $query1 = $db->query("INSERT INTO staff (name, position_id) VALUES ('$fullName', $position_id);");
    $query2 = $db->query("INSERT INTO user (username, password, staff_id, account ) VALUES ('$username', '$password', LAST_INSERT_ID(), '$account');");

    header('Location: ../user.php');
    exit;
} 




?>