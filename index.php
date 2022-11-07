<?php
include('connect.php');
//verification des données du formulaire
if(isset($_POST['formconnect']))
{       //assainissement des données avec htmlspecialchars
        $pseudo=htmlspecialchars($_POST['pseudo']);
        $mdp=md5($_POST['mdp']);
    if(!empty($_POST['pseudo']) AND !empty($_POST['mdp'])){
       $requser= $objet_pdo->prepare("SELECT * FROM membres WHERE pseudo = ? AND mots_de_passe = ?");
       $requser->execute(array($pseudo, $mdp));
       $userexiste= $requser->rowCount();
       if ($userexiste == 1) {
           $user_infos = $requser->fetch();
           $_SESSION['id']= $user_infos['id'];
           $_SESSION['pseudo']= $user_infos['pseudo'];
           $_SESSION['mots_de_passe']= $user_infos['mots_de_passe'];
           header('Location:membre.php?id='.$_SESSION['id']);
       }else {
           $erreur= "Mauvais pseudo ou mots de passe";
       }
    }else{
        $erreur = "tous les champs doivent être compléter";
    }
}
//fonction qui verifie si l'utilisateur à le droit de se connecter
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <title>page de connexion</title>
</head>
<body>
    <div class="text-center">
        
        <?php if(!empty($erreur)){ echo '<h3>'.$erreur.'</h3>'; } ?>
    <main align="center" class="w-100%">
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
  
         <p class="h3 mb-3 fw-normal">Connexion</p> 
    <div class="mb-3" >
            <label for="pseudo" class="form-label" >Pseudo</label>
           <div> <input align="center" type="text" id="pseudo" name="pseudo"  class="form-control-larg"></div>
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
            <label for="mdp" class="form-label" >Mots de Passe</label>
           <div> <input align="center" type="password" id="mdp" name="mdp"  class="form-control-larg"></div>
            <div class="mb-3 form-check">
             <input align="center" type="checkbox" class="form-control-larg" id="exampleCheck1" >
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
            <input type="submit" name="formconnect" value="Se Connecter" class="btn btn-primary">
  
    </form>
   
    <a  href="inscription.php">Je n'est pas encore créer un compte utilisateur</a>   
    </main>
     
    <?php /* if(isset($erreur)){ echo $erreur; } */ ?>
    </div>
</body>
</html>