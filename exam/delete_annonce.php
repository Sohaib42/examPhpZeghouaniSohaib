<?php 
require_once ('connexion_bdd.php');
require_once ('fonctions.php');
$id = $_GET['id'];
 deleteAnnonce($pdo, $id); header('Location: articles.php'); ?>
