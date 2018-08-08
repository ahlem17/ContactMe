<?php  
 //liaison
 include_once 'function.bd.php'; 
 class inscription{
    //constructeur
    public function __construct($pseudo,$email,$mdp,$mdp2,$nom,$prenom,$adresse,$profession,$tel,$genre,$naissance){
     $this->pseudo = $pseudo; 
     $this->email = $email;
     $this->mdp = $mdp;
     $this->mdp2 = $mdp2;
     $this->nom=$nom;
     $this->prenom=$prenom;
     $this->adresse=$adresse;
     $this->profession=$profession;
     $this->tel=$tel;
     $this->genre=$genre;
     $this->naissance=$naissance;
     $this->bdd = bdd();    
    }
   //vérification 
   public function verif(){
     //vérification si le pseudo et entre 5 et 20
     if(strlen($this->pseudo) > 4 AND strlen($this->pseudo) < 21 ){ 
       //syntaxe email
       $syntaxe = '#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#'; 
       //syntaxe téléphone
       $syntaxe3 = '#^(0|\+213)[567]([-. ]?[0-9]{2}){4}$#';
       $dn =  $this->bdd->prepare('SELECT id FROM membres WHERE pseudo = :pseudo ');
       $dn->execute(array('pseudo'=>  $this->pseudo));
       $dn = $dn->fetch();
       //si le pseudo n'existe pas déja
        if($dn==0){
         //email bien saissie
         if(preg_match($syntaxe,$this->email)){ 
           $em =  $this->bdd->prepare('SELECT id FROM membres WHERE mail = :mail ');
           $em->execute(array('mail'=>  $this->email));
           $em = $em->fetch();
           //si email n'existe pas déja
           if($em==0){
             //si le mot de passe est entre 5 et 20
             if(strlen($this->mdp) > 4 AND strlen($this->mdp) < 21 ){ 
               //les mots de passe sont identiques
               if($this->mdp == $this->mdp2){
                 //vérification num de téléphone
                 if(preg_match($syntaxe3,$this->tel)){
                   return 'ok';
                  }
                 else{
                   $erreur='Votre numéro de téléphone est incorrecte';
                   return $erreur;
                  }   
                }
               //mot de passe != 
               else { 
                 $erreur = 'Les mots de passe sont pas identique ';
                 return $erreur;
                }
              }
             //mauvais format du mot de passe 
             else {
               $erreur = 'Mot de passe doit être entre 5 et 20';
               return $erreur;
              }
            }
           else {
             $erreur = 'Email est déjà utilisé';
             return $erreur;
           }    
          }
         //email mauvais 
         else { 
           $erreur = 'Email érroné';
           return $erreur;
          }
        }
       //pseudo existe déja
       else {
         $erreur = 'Pseudo est déjà utilisé';
         return $erreur;
        }
      }
     //Pseudo mauvais
     else { 
       $erreur = 'Pseudo doit être entre 5 et 20';
       return $erreur;
      }   
    }
   //enregistrement
   public function enregistrement(){
     $requete = $this->bdd->prepare('INSERT INTO membres(pseudo,mail,mdp,nom,prenom,adresse,profession,tel,genre,birthdate) VALUES(:pseudo,:mail,:mdp,:nom,:prenom,:adresse,:profession,:tel,:genre,:naissance)');
     $requete->execute(array(
       ':pseudo'=>  $this->pseudo,
       ':mail' => $this->email,
       ':mdp' => $this->mdp,
       ':nom'=>$this->nom,
       ':prenom'=>$this->prenom,
       ':adresse'=>$this->adresse,
       ':profession'=>$this->profession,
       ':tel'=>$this->tel,
       ':genre'=>$this->genre,
       ':naissance'=>$this->naissance    
      ));
     return 1; 
    }
   //ouvrir session
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

