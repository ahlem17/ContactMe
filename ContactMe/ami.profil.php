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
     $q=htmlspecialchars($_GET['q']);
     $requete = $bdd->prepare('SELECT * FROM membres WHERE id = :ami');
     $requete->execute(array(':ami'=>$q));
     while ($r = $requete->fetch()) { $amii=$r['pseudo'];}
?> 
     <!DOCTYPE html>
     <html lang="fr"> 
         <head>
             <meta charset="utf-8">
             <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
             <meta name="description" content="">
             <meta name="viewport" content="width=device-width, initial-scale=1">
             <title>ContactMe - <?php echo $amii; ?></title> 
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
             <!--Ami profil-->
             <?php 
                 $requete = $bdd->prepare('SELECT * FROM membres WHERE id = :ami');
                 $requete->execute(array(':ami'=>$q));
                 while ($r = $requete->fetch()) { $amii=$r['pseudo'];?>
                     <div  id="affiche2">
                         <h3 style=" margin-left:150px;">
                             <?php echo $r['nom'] ." " .$r['prenom'];?>
                         </h3>
                         <br> Pseudo : <?php echo $r['pseudo']; ?>

                         <?php 
                             function Age($date_naissance){
                                 $arr1 = explode('/', $date_naissance);
                                 $arr2 = explode('/', date('Y/m/d'));
        
                                 if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[2] <= $arr2[2]))){
                                     return $arr2[0] - $arr1[0]; 
                                    }
                                 else{
                                     return $arr2[0] - $arr1[0] - 1;
                                    }    
                                }
                             $date=$r['birthdate'];
                             $age = Age($date);
                         ?> 

                         <br> <br> Age : <?php echo $age . " ans"; ?>

                         <br> <br> Genre : <?php echo $r['genre']; ?>

                         <br> <br> Proféssion : <?php echo $r['profession']; ?>

                         <br> <br> Adresse : <?php echo $r['adresse']; ?>

                         <br> <br> Adresse mail :  <?php echo $r['mail']; ?>

                         <br> <br> Téléphone : <?php echo $r['tel']; ?>             
                     </div> 
                     <?php
                    }
                    ?>
             <div style="margin-top: 130px; padding: 5px; position: fixed;"><div id="affiche"></div></div>
             <div style="margin-top: 100px; margin-left: 550px;padding: 5px; position: fixed;">
             <button type="button" class="add" onclick="window.location.href='index2.php'""><img src="icons/return.png"></button>
         </div>
         </body>
     </html>          
     <?php       
    }
     ?>
 


