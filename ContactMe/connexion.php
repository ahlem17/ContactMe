<?php 
 session_start();
 //liaison
 include_once 'functions/function.bd.php';
 include_once 'functions/connexion.class.php';
 $bdd = bdd();
 //vérification
 if(isset($_POST['pseudo']) AND isset($_POST['mdp'])){
     $connexion = new connexion($_POST['pseudo'],$_POST['mdp']);
     $verif = $connexion->verif();
     if($verif =="ok"){
         if($connexion->session()){
             header('Location: index2.php');
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
     <title>ContactMe - Connexion</title> 
     <link rel="stylesheet" type="text/css" href="css/style.css" />
     <link rel="shortcut icon" href="icons/icon.ico" />
 </head>
 <!--body-->
 <body id="body">
     <div class="logo"><a href="index.php"><img src="icons/logo.png"></a></div>
     <div class="main">
         <!--formulaire de connexion-->    
         <form method="post" action="connexion.php" class="login">
             <p>
                 <input name="pseudo" type="text" placeholder="Pseudo..." onfocus="this.value = '';" required /><br>
                 <input name="mdp" type="password" placeholder="Mot de passe..." onfocus="this.value = '';"  required /><br></br>
                 <div class="submit">
                     <input type="submit" value="Connexion"/>
                 </div> 
                 <!--get message d'erreur-->
                 <?php 
                     if(isset($erreur)){
                         echo "<script type=\"text/javascript\">\n";
                         echo "  alert(\"$erreur\");\n";
                         echo "</script>\n\n";
                        }
                 ?>
             </p>                
         </form>        
     </div>       
 </body>
</html>
