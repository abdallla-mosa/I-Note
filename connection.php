<?php
class Connections{ 
 public PDO $pdo;
 public function __construct(){
     try{
         $this-> pdo = new PDO("mysql:host=localhost;dbname=notes;","abdullah-mosa","0117996974");
         $this-> pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     }catch(PDOException $e) {
         echo "Connection failed: " . $e->getMessage();
       }
 }
//  fetch all the notes
 public function getNotes(){
    $statement = $this->pdo->prepare(" SELECT  * FROM  notes ORDER BY create_date DESC "); 
    $statement -> execute();
   return $statement -> fetchAll(PDO::FETCH_ASSOC);
   
 }
//  add a notes
public function addNote($note){
    $statement = $this -> pdo -> prepare("INSERT INTO notes(title,description,create_date)
    VALUES(:title,:description,:create_date)");

    $statement -> bindValue("title",$note["title"]);
    $statement -> bindValue("description",$note["description"]);
    $statement -> bindValue("create_date",date("Y-m-d g:i:s A"));
    return $statement -> execute();
}
// remove a note 
public function deleteNote($id){
    $statement = $this->pdo->prepare("DELETE FROM notes WHERE id = :id");
    $statement -> bindValue("id",$id);
    return $statement -> execute();
}
// get a Note By Id 
public function getNoteById($id){
    $statement = $this -> pdo -> prepare("SELECT * FROM notes WHERE id = :id");
    $statement -> bindValue("id",$id);
    $statement -> execute();
    return $statement -> fetchAll(PDO::FETCH_ASSOC);
}
// update Note 
public function updateNote($id,$note){
    $statement =$this -> pdo -> prepare("UPDATE notes SET title =  :title ,description = :description WHERE id = :id");
    $statement -> bindValue("id",$id);
    $statement -> bindValue("title",$note['title']);
    $statement -> bindValue("description",$note['description']);
    return $statement -> execute();
}
}
return $connections = new Connections();
?>