<?php 
require_once ('connexion_bdd.php');
require_once ('fonctions.php');
$id = $_GET['id'];
 deleteUser($pdo, $id); header('Location: adminregister.php'); ?>
