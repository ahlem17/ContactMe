<?php
 function bdd(){
     $dsn='mysql:dbname=ContactMe;host=127.0.0.1';
     $user='secrt';
     $password='bd1996';
     try{
         $bdd=new PDO($dsn,$user,$password);
        } 
     catch (PDOException $e){
	     echo'connection failled :' .$e->getMessage();
	    }
     return $bdd;
    }
?>
