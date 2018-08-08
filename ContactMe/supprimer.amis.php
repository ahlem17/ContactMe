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
 $id=$_SESSION['id']
 
?>
<form method="post" action="index2.php">
 <div id="table"> 
   <table>
     <?php
       $requete = $bdd->prepare('SELECT id_contact FROM amis WHERE id_ajout = :moi');
       $requete->execute(array(':moi'=>$id));
       while ($r = $requete->fetch()) {
         $idami=$r['id_contact'];
         $requete1 = $bdd->prepare('SELECT * FROM membres WHERE id = :ami');
         $requete1->execute(array(':ami'=>$idami));
         while ($r1 = $requete1->fetch()) {
     ?>
           <tr>
             <td>
               <input type="checkbox" name="id[]" class="other" value="<?php echo $r1['id'];?>"><?php  echo $r1['pseudo'] ; ?>
             </td>
           </tr>
           <?php
          }
        }
          ?>
   </table>
 </div>
 <br/><input style="background: red;color: #fff;cursor: pointer; margin-left: 300px; width: 100px; height: 30px;" type="submit" name="Sup" value=" Supprimer "/>
</form>
