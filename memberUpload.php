<?php
// SET THE DESTINATION FOLDER
$id = $_POST["memberId"];

$source = $_FILES["upimage"]["tmp_name"];
$destination = "./web/images/members/$id.png";

// MOVE UPLOADED FILE TO DESTINATION
echo move_uploaded_file($source, $destination) ? "OK" : "ERROR UPLOADING";
?>