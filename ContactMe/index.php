<?php 
 //liaison
 session_start();
 include_once 'functions/function.bd.php';
 $bdd = bdd();
 //page d'accueil hors ligne
 if(!isset($_SESSION['id'])){
?> 
     <!DOCTYPE html>
     <html lang="en"> 
         <head>
             <meta charset="utf-8">
             <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
             <meta name="description" content="">
             <meta name="viewport" content="width=device-width, initial-scale=1">
             <title>ContactMe - Bienvenue</title> 
             <link rel="stylesheet" type="text/css" href="css/style.css" />
             <link rel="shortcut icon" href="icons/icon.ico" />
         </head>
         <!--body-->
         <body id="body">
             <div class="logo"><a href="index.php"><img src="icons/logo.png"></a></div>
             <h1  style="color: #ffffff; text-align: center; font-family: Avantgarde, TeX Gyre Adventor, URW Gothic L,sans-serif ;">Gardez votre contact avec vos amis en ligne gratuitement</h1>
             <div class="btn">
                 <button type="button" class ="bouton" style="background: #2add47; width: 200px;height: 40px; margin-left: 20px;"  onclick="window.location.href='connexion.php'">Connexion</button>
                 <button type="button" class ="bouton" style="background: #2add47; width: 200px; height: 40px; margin-left: 80px;"  onclick="window.location.href='inscription.php'">Inscriez vous</button>
             </div>
         </body>
     </html>
     <?php
    }
    else{
     header('Location: index2.php');  
    }
     ?>    
