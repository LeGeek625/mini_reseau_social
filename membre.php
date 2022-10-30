<?php  
include('connect.php');
if (isset($_GET['id']) AND $_GET['id'] > 0) {
   $getid = intval($_GET['id']);
   $requser = $objet_pdo->prepare('SELECT * FROM membres WHERE id = ?');
   $requser->execute(array($getid));
   $userinfos = $requser->fetch();

}  
   ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Bienvenue <?php echo $userinfos['pseudo'] ?> <div> <a  href="deconnection.php">Déconnection</a></div></h2>
<div class="menu">
    <h3>
        <a href="#">Accueil</a><br>
        <a href="update.php">Changer vos information</a><br>
        <a href="#">Les membres</a><br>
        <a href="#">Vos amis</a><br>
        <a href="#">invitations</a><br>
        <a href="#">message</a>
    </h3>
</div> 
<hr>
    <div>
        <b>
                
            <h3>Mes infos Personnel :</h3>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Prenom et Nom : <?php echo '<em>'.$userinfos['prenom'].' '.$userinfos['nom'].'</em>' ?> </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Pseudo : <?php echo '<em>'.$userinfos['pseudo'].'</em>' ?> </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Sexe : <?php echo '<em>'.$userinfos['sexe'].'</em>' ?> </p> 
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Situation : <?php echo '<em>'.$userinfos['situation'].'</em>' ?> </p> 
            <p>&nbsp;&nbsp;&nbsp;&nbsp;Email : <?php echo '<em>'.$userinfos['email'].'</em>' ?> </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;A propos de vous : <?php echo '<em>'.$userinfos['a_propos'].'</em>' ?> </p> 
        </b> 
    </div>
</body>
</html>



