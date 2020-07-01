<?php
    session_start();


    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ./");
        exit;
    }
?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo($title); ?></title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="stylesheet" type="text/css" href="./web/css/global.css">

<link rel="stylesheet" type="text/css" href="./web/css/<?php echo ($pageFile); ?>.css">


</head>