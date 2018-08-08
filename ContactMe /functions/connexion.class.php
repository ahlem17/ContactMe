<?php 
 //liaison
 include_once 'function.bd.php';
 class connexion{
     //constructeur
     public function __construct($pseudo,$mdp) {
         $this->pseudo = $pseudo;
         $this->mdp = $mdp;
         $this->bdd = bdd();
        }
     //vérification
     public function verif(){
         $requete = $this->bdd->prepare('SELECT * FROM membres WHERE pseudo = :pseudo');
         $requete->execute(array('pseudo'=> $this->pseudo));
         $reponse = $requete->fetch();
         // si le ŝeudo existe
         if($reponse){ 
             // si mot de passe correcte
             if($this->mdp == $reponse['mdp']){
                 return 'ok';
                }
             else {
                 $erreur = 'Erreur!,le mot de passe est érroné';
                 return $erreur;
                } 
            }
         else {
             $erreur = 'Erreur!,pseudo introuvable';
             return $erreur;
            }    
        }
     //ouvrir une session   
     public function session(){
         $requete = $this->bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo ');
         $requete->execute(array('pseudo'=>  $this->pseudo));
         $requete = $requete->fetch();
         $_SESSION['id'] = $requete['id'];
         $_SESSION['pseudo'] = $this->pseudo;
         return 1;
        }   
    }
?>