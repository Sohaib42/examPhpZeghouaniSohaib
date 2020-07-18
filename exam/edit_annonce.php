<?php 
require_once('connexion_bdd.php');
require_once('fonctions.php');
$idAnnonce = $_GET['id'];
$annonce = getAnnonce($pdo, $idAnnonce);
$errors = [];
$imageUrl = null;
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateEditForm();
    $errors = $returnValidation['errors'];
    $imageUrl = $returnValidation['image_link'];

    if( count($errors) === 0) {
        updateBdd($pdo, $imageUrl, $annonce['id']);
        header('Location: articles.php');
    }
}

?>
<form  method="post" action="edit_annonce.php?id=<?php echo($annonce['id']);?>" enctype="multipart/form-data">
    <label>Titre de l'article : </label>
    <input style="border-radius: 0.3em;" name="titre" placeholder="Titre de l'article" value="<?php echo($annonce['titre'])?>">
    <label>Contenu : </label>
    <textarea name="contenu" placeholder="Contenu de l'article"  value="<?php echo($annonce['contenu'])?>"></textarea>
    <label> Image : </label>
    <input type="text" name="image_link" placeholder="Entrer le lien de votre image hebergé"  value="<?php echo($annonce['image_link'])?>"><br><br>
    <button type="submit" style="border-radius: 0.3em;">Modifier l'article</button>