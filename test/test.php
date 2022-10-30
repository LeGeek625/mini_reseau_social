<?php
//connexion à la base de données
$objet_pdo = new PDO('mysql:host=localhost;dbname=rs_base','root',''); //or die('connexion à la base de données à echoué');
$objet_pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//verification des données du formulaire
if(isset($_POST['formInscription']))
{       //assainissement des données avec htmlspecialchars
        $prenom=htmlspecialchars(trim($_POST['prenom']));
        $nom=htmlspecialchars(trim($_POST['nom']));
        $pseudo=htmlspecialchars(trim($_POST['pseudo']));
        $sexe=htmlspecialchars(trim($_POST['sexe']));
        $situation=htmlspecialchars(trim($_POST['situation']));
        $mdp=md5(trim($_POST['mdp']));
        $mdp2=md5(trim($_POST['mdp2']));
        $email=htmlspecialchars(trim($_POST['email']));
        $email2=htmlspecialchars(trim($_POST['confirm_email']));
        $a_propos=htmlspecialchars(trim($_POST['a_propos']));
    if(!empty($_POST['prenom']) AND !empty($_POST['nom']) AND !empty($_POST['pseudo']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['email']) AND !empty($_POST['confirm_email']) AND !empty($_POST['a_propos'])){


        //vérification de la longueur des entres
        $prenomlength = strlen($prenom);
        $nomlength = strlen($nom);
        $pseudolength = strlen($pseudo);
        $mdplength = strlen($mdp);
        $emaillength = strlen($email);
        $a_proposlength = strlen($a_propos);

        if($prenomlength <= 100){
            if($nomlength <= 100){
                if ($pseudolength <= 100) {
                    $reqpseudo = $objet_pdo->prepare("SELECT * FROM membres WHERE pseudo = ?");
                    $reqpseudo->execute(array($pseudo));
                    $doublons_pseudo = $reqpseudo->rowCount();
                    if ($doublons_pseudo == 0) {
                        
                    
                    if ($mdplength <= 100) {
                        $reqmdp = $objet_pdo->prepare("SELECT * FROM membres WHERE mots_de_passe = ?");
                        $reqmdp->execute(array($mdp));
                        $doublons_de_mdp = $reqmdp->rowCount();
                        if($doublons_de_mdp == 0) {
                            if($mdp == $mdp2){
                                if ($emaillength <= 100) {
                                        if($email == $email2){
                                            // Supprimer tous les caractères illégaux du courrier électronique
                                            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
                                            // Valider l’adresse e-mail
                                            if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
                                                $reqmail = $objet_pdo->prepare("SELECT * FROM membres WHERE email = ?");
                                                $reqmail->execute(array($email));
                                                $doublons_email = $reqmail->rowCount();
                                                if($doublons_email == 0) {
                                                    if($a_proposlength <= 2500){
                                                        $insertion_membre=$objet_pdo->prepare("INSERT INTO membres(prenom, nom, pseudo, sexe, situation, mots_de_passe, email, a_propos) VALUES(?,?,?,?,?,?,?,?)");
                                                        $insertion_membre->execute(array($prenom, $nom, $pseudo, $sexe, $situation, $mdp, $email, $a_propos));
                                                        $erreur="votre compte a été créer";
                                                    }else {
                                                        $erreur= "Désolé mais votre desciption 'A propos de vous' est trop longue";
                                                    }
                                                }else {
                                                    $erreur= "ce mail est déjà enregistré par quelqu'un d'autre";
                                                }
                                            } else {
                                                $erreur= "L'email n’est pas valide";
                                            }
                                        }else {
                                            $erreur= "vos mail ne correspondent pas";
                                        }
                            
                                } else {
                                    $erreur = "votre email est trop longue";
                                }
                            } else{
                                $erreur ="vos mots de passe ne corresponde pas";
                            }
                              
                        }else{
                            $erreur= "ce mots de passe existe déjà";
                        }
                    }else {
                        $erreur = "votre mots de passe est trop longue";
                    }
                    } else {
                        $erreur = "Ce pseudo existe déjà";
                    }
                }else {
                    $erreur= "Votre pseudo est trop longue";
                }
            }else{
                $erreur="votre nom est trop longue";
            }
        }else{
            $erreur="votre prenom est trop longue";
        }
    }else{
        $erreur = "tous les champs doivent être compléter";
    }
}


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>page d'inscription</title>
</head>
<body>
    <div align="center">
        <h1>Inscription</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
       <h3> 
            <label for="prenom">Prenom</label><br>
            <input type="text" id="prenom" name="prenom"><br>

            <label for="nom">Nom</label><br>
            <input type="text" id="nom" name="nom"><br>

            <label for="pseudo">Pseudo</label><br>
            <input type="text" id="pseudo" name="pseudo"><br>

            <label for="sexe">Sexe</label><br>
            <select name="sexe" id="sexe">
                <option value="Homme">Homme</option>
                <option value="Femme">Femme</option>
            </select> <br>

            <label for="situation">Situation</label><br>
            <select name="situation" id="situation">
                <option value="Célibataire">Célibataire</option>
                <option value="En Couple">En Couple</option>
                <option value="Divorcé">Divorcé</option>
                <option value="Veuf(ve)">Veuf(ve)</option>
            </select> <br>
           
            <label for="mdp">Mots de Passe</label><br>
            <input type="password" id="mdp" name="mdp"><br>
            
            <label for="mdp2">Confirmation Mots de Passe</label><br>
            <input type="password" id="mdp2" name="mdp2"><br>
            
            <label for="email">Email</label><br>
            <input type="email" id="email" name="email"><br>

            <label for="confirm_email">Confirmation email</label><br>
            <input type="email" id="confirm_email" name="confirm_email"><br>

            <label for="a_propos">A propos</label><br>
            <textarea name="a_propos" id="a_propos" cols="30" rows="5"></textarea><br><br>

            <input type="submit" name="formInscription" value="je m'inscrit">
        </h3>
    </form>

    <a href="index.php?page=login">J'ai déjà un compte utilisateur</a>

    <?php 
        if(isset($erreur)){
            echo $erreur;
        } 
    ?>
    </div>
    
</body>
</html>