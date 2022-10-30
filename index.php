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
    <title>page de connexion</title>
</head>
<body>
    <div align="center">
        <h1>Connexion</h1>
        <?php if(!empty($erreur)){ echo '<h3>'.$erreur.'</h3>'; } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
       <h3>
            <label for="pseudo">Pseudo</label><br>
            <input type="text" id="pseudo" name="pseudo"><br>

            <label for="mdp">Mots de Passe</label><br>
            <input type="password" id="mdp" name="mdp"><br><br>

            <input type="submit" name="formconnect" value="Se Connecter">
        </h3>
    </form>
    <a href="inscription.php">Je n'est pas encore créer un compte utilisateur</a>    <?php  /*
        if(isset($erreur)){
            echo $erreur;
        } */
    ?>
    </div>
    
</body>
</html>