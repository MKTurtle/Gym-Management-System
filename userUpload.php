<?php
// SET THE DESTINATION FOLDER
$id = $_POST["user-id"];

$source = $_FILES["upimage"]["tmp_name"];
$destination = "./web/images/users/$id.png";

// MOVE UPLOADED FILE TO DESTINATION
echo move_uploaded_file($source, $destination) ? "OK" : "ERROR UPLOADING";
?>