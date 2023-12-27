<?php
 include_once "connection.php";

 $connections = new Connections();

 $connections -> getNotes();
 if(isset($_POST["id"])){
    echo "<pre>";
    var_dump($_POST);
    $connections -> updateNote($_POST["id"],$_POST);
 }else{
 $connections -> addNote($_POST);
 };

 header("location: index.php")


?>