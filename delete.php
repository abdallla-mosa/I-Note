<?php
include_once "connection.php";

$connections -> deleteNote($_POST["id"]);

header("location: index.php");
?>