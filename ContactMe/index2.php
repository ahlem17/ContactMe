<?php 
 //liaison
 session_start();
 $id=$_SESSION['id'];
 $ps=$_SESSION['pseudo'];
 include_once 'functions/function.bd.php';
 $bdd = bdd();
 //page d'accueil en ligne
 if(!isset($_SESSION['id'])){
      header('Location: index.php');
    }
 else{
?> 
     <!DOCTYPE html>
     <html lang="en"> 
         <head>
             <meta charset="utf-8">
             <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
             <meta name="description" content="">
             <meta name="viewport" content="width=device-width, initial-scale=1">
             <title>ContactMe - Index</title> 
             <link rel="stylesheet" type="text/css" href="css/style.css" />
             <link rel="shortcut icon" href="icons/icon.ico" />
         </head>
         <!--body-->
         <body id="body2">
             <!--logo-->
             <div class="logo"><a href="index.php"><img src="icons/logo.png"></a></div>
             <!--Menu profil-->
             <div id="mn">
                 <ul id="menu">
                     <li> <a> <?php echo $ps;  ?></a>
                         <ul class="sousmenu">
                             <li><a   id="lien">Voir profile</a></li>                     
                             <li><a id="up">Parametre</a></li>
                             <li><a href="deconnexion.php">Déconnection</a></li> 
                         </ul>  
                     </li>               
                 </ul>
             </div>
             <!--Script de menu profil-->
             <script >
                 window.onload = initEvent;
                 function initEvent(){
                     document.getElementById('lien').onclick = lienOnclick;
                     document.getElementById('up').onclick = lienOnclick2;
                    }
                 function lienOnclick(){
                     var xhttp = new XMLHttpRequest();
                     xhttp.onreadystatechange = function() {
                         if (this.readyState == 4 && this.status == 200) {
                             document.getElementById("affiche").innerHTML =this.responseText;
                            }
                        };
                     xhttp.open("GET", "mon.profil.php", true);
                     xhttp.send();
                     return false;
                    }
                 function lienOnclick2(){
                     var xhttp = new XMLHttpRequest();
                     xhttp.onreadystatechange = function() {
                         if (this.readyState == 4 && this.status == 200) {
                             document.getElementById("affiche").innerHTML =this.responseText;
                            }
                        };
                     xhttp.open("GET", "modifier.mon.profil.php", true);
                     xhttp.send();
                     return false;
                    }
             </script>
             <!--Table des contacts-->
             <h1 class="entete">Mes amis</h1>
             <?php
                 $requete = $bdd->prepare('SELECT id_contact FROM amis WHERE id_ajout = :moi');
                 $requete->execute(array(':moi'=>$id));
               ?>
             <div  id="table1">
                 <div id="table"> 
                     <table>
                         <?php
                             while ($r = $requete->fetch()) {
                                 $idami=$r['id_contact'];
                                 $requete1 = $bdd->prepare('SELECT * FROM membres WHERE id = :ami');
                                 $requete1->execute(array(':ami'=>$idami));
                                      while ($r1 = $requete1->fetch()) {
                           ?>
                                         <tr>
                                             <td><a href="ami.profil.php?q=<?php  echo $r1['id'] ; ?>" onclick="loadAmi()"><?php  echo $r1['pseudo'] ; ?></a></td>
                                         </tr>
                                              
                                         <?php
                                        }
                                    }
                                        ?>
                     </table>
                 </div>
             </div>
             <!--boutton d'ajout et suppression--> 
             <div id="btn2">
                 <button type="button" class="return" onclick="window.location.href='index2.php'""><img src="icons/return.png"></button>
                 <button type="button" class="supp" onclick="loadDel()"><img src="icons/delete.png"></button>
                 <button type="button" class="add" onclick="loadAdd()"><img src="icons/add.png"></button>
             </div>
             <!--Zone d'affichage-->
             <div id="affiche"> </div>
             <div id="affiche1"> </div>
             <!--Script d'ajout et suppression-->
             <script>
                 function loadAdd() {
                     var xhttp = new XMLHttpRequest();
                     xhttp.onreadystatechange = function() {
                         if (this.readyState == 4 && this.status == 200) {
                             document.getElementById("affiche1").innerHTML =this.responseText;
                            }
                        };
                     xhttp.open("GET", "ajouter.amis.php", true);
                     xhttp.send();
                    }  

                    function loadDel() {
                     var xhttp = new XMLHttpRequest();
                     xhttp.onreadystatechange = function() {
                         if (this.readyState == 4 && this.status == 200) {
                             document.getElementById("table1").innerHTML =this.responseText;
                            }
                        };
                     xhttp.open("GET", "supprimer.amis.php", true);
                     xhttp.send();
                    }    
             </script>
             <!--Ajout et suppression et modiffication opération-->
             <?php
                 
                 if (isset($_POST['ami']) AND isset($_POST['ajouter'])) {
                     $ami=$_POST['ami'];
                     $requete = $bdd->prepare('SELECT id FROM membres WHERE pseudo = :ami');
                     $requete->execute(array(':ami'=>$ami));
                     $r = $requete->fetch();
                     $id_ami=$r['id'];  
                     if ($r){
                         if ($id_ami!=$id) {
                             $requete2 = $bdd->prepare('INSERT INTO amis(id_ajout,id_contact) VALUES(:moi,:toi)');
                             $requete2->execute(array(
                                 ':moi'=>  $id,
                                 ':toi'=>  $id_ami
                               )); 
                             echo "<script type=\"text/javascript\">\n";
                             echo "  alert(\"Félicitation!vous êtes ami avec $ami\");\n";
                             echo "</script>\n\n"; 
                             header('Location: index2.php');
                           }
                         else{
                             echo "<script type=\"text/javascript\">\n";
                             echo "  alert(\"Erreur!C'est votre pseudo\");\n";
                             echo "</script>\n\n";
                           }
                        }
                     else{
                         echo "<script type=\"text/javascript\">\n";
                         echo "  alert(\"Aucun membre avec ce pseudo!\");\n";
                         echo "</script>\n\n";
                     }   
                    }

                 if(isset($_POST['Sup'])){ 
                     if(isset($_POST['id'])){ 
                         $box=$_POST['id'];
                         foreach ($box as $id) {
                             $reqs = $bdd->prepare('DELETE FROM amis WHERE id_contact = :id');
                             $reqs->bindValue('id',$id);
                             $reqs->execute();
                            }
                         echo "<script type=\"text/javascript\">\n";
                         echo "  alert(\"La suppression a été bien éfectuer!\");\n";
                         echo "</script>\n\n";
                         header('Location: index2.php'); 
                        }
                     else{
                         echo "<script type=\"text/javascript\">\n";
                         echo "  alert(\"Aucun Ami n'a été séléctionné!\");\n";
                         echo "</script>\n\n";
                     }   
                    }

                 if(isset($_POST['update'])){ 
                     $requete = $bdd->prepare('SELECT * FROM membres WHERE id = :moi');
                     $requete->execute(array(':moi'=>$id));
                     while ($r = $requete->fetch()) {
                         $name=$r['nom'];
                         $lastname= $r['prenom']; 
                         $mdp= $r['mdp'];
                         $genre= $r['genre'];
                        }
                     $newdate=$_POST['newdate'];
                     $newprof=$_POST['newprof'];  
                     $newadress=$_POST['newadress'];
                     $newmail=$_POST['newmail'];
                     $newtel=$_POST['newtel'];
                     $stmt = $bdd->prepare('UPDATE membres SET nom =:nom, prenom = :prenom , pseudo = :pseudo , mdp = :mdp, genre = :genre, birthdate = :newdate , profession = :newprof , adresse = :newadress , mail = :newmail , tel = :newtel WHERE  id = :id');                       
                     $stmt->bindParam(':nom', $name);
                     $stmt->bindParam(':prenom', $lastname);    
                     $stmt->bindParam(':pseudo', $ps);
                     $stmt->bindParam(':mdp', $mdp);
                     $stmt->bindParam(':genre', $genre);
                     $stmt->bindParam(':newdate', $newdate);    
                     $stmt->bindParam(':newprof', $newprof);
                     $stmt->bindParam(':newadress', $newadress);
                     $stmt->bindParam(':newmail', $newmail);    
                     $stmt->bindParam(':newtel', $newtel);
                     $stmt->bindParam(':id', $id);
                     $r=$stmt->execute();
                     if ($r) {
                         echo "<script type=\"text/javascript\">\n";
                         echo "  alert(\"Votre profil a été bien modifier!\");\n";
                         echo "</script>\n\n";
                        } 
                    }
               ?>

         </body>
     </html>          
     <?php       
    }
     ?>
 