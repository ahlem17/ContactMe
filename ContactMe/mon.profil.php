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
 $requete = $bdd->prepare('SELECT * FROM membres WHERE id = :moi');
 $requete->execute(array(':moi'=>$id));
 while ($r = $requete->fetch()) {
     echo "<h3 style=\" margin-left:150px;\">".$r['nom'] ." " .$r['prenom']."</h3>";
     echo "<br> Pseudo :"." " .$r['pseudo'];
     echo "<br> <br> Date de naissance :"." " .$r['birthdate'];
     echo "<br> <br> Genre :"." " .$r['genre'];
     echo "<br> <br> Proféssion :"." " . $r['profession'];
     echo "<br> <br> Adresse :"." " . $r['adresse'];
     echo "<br> <br> Adresse mail :"." " . $r['mail'];
     echo "<br> <br> Téléphone :"." " . $r['tel'];
    }
?>