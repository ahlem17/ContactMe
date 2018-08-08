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
?>
<form method="post" action="index2.php">
 <label for="brihdates">Date de naissance : </label>
 <input type="date" name="newdate" id="brihdates" value="<?php echo $r['birthdate']; ?> "  style=" width: 200px; height: 30px; border: 1px solid gray;"><br><br>

 <label for="prof">Proféssion : </label>
 <input type="text" name="newprof" id="prof"
     	value="<?php echo $r['profession']; ?> " style=" width: 200px; height: 30px; border: 1px solid gray;"><br><br>

 <label for="adress">Adresse : </label>
 <input type="text" name="newadress" id="adress"
     	value="<?php echo $r['adresse']; ?> " style=" width: 200px; height: 30px; border: 1px solid gray;"><br><br>

 <label for="mail">Email : </label>
 <input type="email" name="newmail" id="mail" value="<?php echo $r['mail']; ?> " style=" width: 200px; height: 30px; border: 1px solid gray;"><br><br>

 <label for="tel">Tel : </label>
 <input type="tel" name="newtel" id="tel" value="<?php echo $r['tel']; ?> " style=" width: 200px; height: 30px; border: 1px solid gray;"><br><br>

 <input type="submit" name="update" value="Modifier" style="background: green;color: #fff;cursor: pointer; width: 100px; height: 30px;">    	
</form>
<?php
 }
?>