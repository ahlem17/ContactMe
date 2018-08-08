<?php session_start();
 //liaison
 include_once 'functions/function.bd.php';
 include_once 'functions/inscription.class.php';
 $bdd = bdd();
 //vérification
 if(isset($_POST['pseudo']) AND isset($_POST['email']) AND isset($_POST['mdp'])  AND isset($_POST['mdp2']) AND isset($_POST['nom']) AND isset($_POST['prenom']) AND isset($_POST['adresse']) AND isset($_POST['profession']) AND isset($_POST['tel'])AND isset($_POST['genre']) AND isset($_POST['naissance'])){
  
     $inscription = new inscription($_POST['pseudo'],$_POST['email'],$_POST['mdp'],$_POST['mdp2'],$_POST['nom'],$_POST['prenom'],$_POST['adresse'],$_POST['profession'],$_POST['tel'],$_POST['genre'],$_POST['naissance']);
     $verif = $inscription->verif();
     if($verif == "ok"){
         //Tout est bon
         if($inscription->enregistrement()){
             if($inscription->session()){ 
                 //Tout est mis en session
                 header('Location: index2.php');
                }
            }
         else{ 
             //Erreur lors de l'enregistrement
             echo 'Une erreur est survenue';
            }   
        }  
     else {
         $erreur = $verif;
        }   
    }
?>
<!DOCTYPE html>
<html lang="en"> 
 <head>
     <meta charset="utf-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
     <meta name="description" content="">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <title>ContactMe - Inscription</title> 
     <link rel="stylesheet" type="text/css" href="css/style.css" />
     <link rel="shortcut icon" href="icons/icon.ico" />
 </head>
 <!--body-->
 <body id="body">
     <div class="logo"><a href="index.php"><img src="icons/logo.png"></a></div>
     <!--formulaire d'inscription-->
     <form method="post" action="inscription.php" class="register">
         <h1 class="h1">Inscription</h1>
         <label class="obinfo">* Informations obligatoires</label>
         <fieldset class="row1">
             <legend>Informations du compte</legend>
             <p>
                 <label>Pseudo *</label>
                  <input name="pseudo" type="text" onfocus="this.value = '';" required /><br>
                  <label>Email *</label>
                  <input name="email" type="email" onfocus="this.value = '';" required /><br>
             </p>
             <p>
                 <label>Mot de passe *</label>
                 <input name="mdp" type="password" onfocus="this.value = '';" required /><br>
                 <label>Confirmer le mot de passe *</label>
                 <input name="mdp2" type="password" onfocus="this.value = '';" required /><br>
             </p>
         </fieldset>
         <br><br><br>
         <fieldset class="row2">
             <legend>Informations personnel</legend>
             <p>
                 <label>Nom *</label>
                 <input name="nom" type="text" onfocus="this.value = '';"  required /><br>
             </p>
             <p>
                 <label>Prénom *</label>
                 <input name="prenom" type="text" onfocus="this.value = '';" required /><br>
             </p>        
             <p>
                 <label>Téléphone *</label>
                 <input name="tel" type="text" onfocus="this.value = '';" required  maxlength="10" /><br>
             </p>
             <p>
                 <label>Adresse *</label>
                 <input name="adresse" type="text" onfocus="this.value = '';" required /><br>
             </p>
             <p>
                 <label>Profession *</label>
                 <input name="profession" type="text" onfocus="this.value = '';"  required /><br>
             </p>      
         </fieldset>
         <fieldset class="row3">
             <legend>Informations supplémentaires</legend>
             <br><br><br>
             <p>
                 <label >Genre *</label>
                 <input type="radio" name="genre" value="homme" required/>
                 <label class="gender">Homme</label>
                 <input type="radio" name="genre" value="femme" required />
                 <label class="gender">Femme</label>
             </p>
             <br><br><br>
             <p>
                 <label>Date de naissance *</label>
                 <input name="naissance" type="date"  required /><br>
             </p>           
         </fieldset>
         <div>
              <button class="button">Inscription &raquo;</button>
         </div>
         <!--get message d'erreur-->
         <?php 
             if(isset($erreur)){
                 echo "<script type=\"text/javascript\">\n";
                 echo "  alert(\"$erreur\");\n";
                 echo "</script>\n\n";
                }
         ?> 
     </form>                           
 </body>
</html>