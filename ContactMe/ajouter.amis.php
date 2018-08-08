<?php
 //connexion
 $dsn='mysql:dbname=ContactMe;host=127.0.0.1';
 $user='secrt';
 $password='bd1996';
 try{
     $bdd=new PDO($dsn,$user,$password);
    } 
 catch (PDOException $e){
     echo'connection failled :' .$e->getMessage();
    }
 session_start();
 $id=$_SESSION['id'];
?>   
<form method="post" action="index2.php">
  <input type="text" name="ami" style=" width: 200px; height: 30px; border: 1px solid gray;" placeholder="Entrer pseudo de votre ami...">
  <input type="submit" name="ajouter" value="ajouter" style="background: green;color: #fff;cursor: pointer; width: 100px; height: 30px;">
</form>
