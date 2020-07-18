<?php
require_once 'connexion_bdd.php';
require_once 'fonctions.php';
$errors = [];
$imageUrl = null;
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateForm();
    $errors = $returnValidation['errors'];
    if( count($errors) === 0) {
        addBdd($pdo, $returnValidation['image_link']);
        header('Location: articles.php');
    };
}
?>
<form  method="post" action="add_annonce.php" enctype="multipart/form-data">
    <label>Titre de l'article : </label>
    <input style="border-radius: 0.3em;" name="titre" placeholder="Titre de l'article">
    <label>Contenu : </label>
    <textarea name="contenu" placeholder="Contenu de l'article"></textarea>
    <label> Image : </label>
    <input type="text" name="image_link" placeholder="Entrer le lien de votre image hebergé"><br><br>
    <input name="nom_prenom_utilisateur" type="text" value="Entrer votre nom d'utilisateur"><br>
    <button type="submit" style="border-radius: 0.3em;">Ajouter l'article</button>
</form>