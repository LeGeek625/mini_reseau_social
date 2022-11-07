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
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="style.css">
    <script src="bootstrap/js/bootstrap.js"></script>
    <title>Document</title>
</head>
<body>
<nav class="navbar navbar-dark bg-primary">
  <!-- Navbar content -->
  
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Bienvenue <?php echo $userinfos['prenom'].' '.$userinfos['nom'] ?> </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" aria-current="page" href="#">Accueil</a>
        <a class="nav-link" href="#">Editer mon profil</a>
        <a class="nav-link" href="deconnection.php">Déconnection</a>
        <a class="nav-link disabled" href="#">message</a>
        <a class="nav-link disabled" href="#">invitations</a>
      </div>
    </div>
  </div>

</nav>

<div > <p></p></div>

<div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img src="image/avatar.png" alt=""/>
                            <div class="file btn btn-lg btn-primary">
                                Changement de Photo
                                <input type="file" name="file"/>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                    <?php echo $userinfos['prenom'].' '.$userinfos['nom'] ?>
                                    </h5>
                                    <h6>
                                       Developeur WEB mobile à l'uvs
                                    </h6>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Mes Infos Personnel</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Editer mon profil"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-work">
                            <p></p>
                            <p>Réseau social <br>
                            <a href="">Facebook</a><br/>
                            <a href="">Twitter</a><br/>
                            <a href="">Instagramme</a></p>
                            
                            <p>PASSION <br>
                            <a href="">Sport</a><br/>
                            <a href="">Shopping</a><br/>
                            <a href="">Tourisme</a><br/>
                            <a href="">Pêche</a><br/>
                            <a href="">Lecture</a><br/></p>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Pseudo</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $userinfos['pseudo'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Prenom et Nom</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $userinfos['prenom'].' '.$userinfos['nom'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $userinfos['email'] ?> </p></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Sexe</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $userinfos['sexe'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Situation actuelle</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $userinfos['situation'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Description</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p><?php echo $userinfos['a_propos'] ?></p>
                                            </div>
                                        </div>
                            </div>
                          
                        </div>

</body>
</html>



