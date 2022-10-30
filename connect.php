<?php
session_start();
//connexion à la base de données
$objet_pdo = new PDO('mysql:host=localhost;dbname=rs_base','root',''); //or die('connexion à la base de données à echoué');
$objet_pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>