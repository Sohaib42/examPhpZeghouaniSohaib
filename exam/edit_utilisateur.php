<?php 
require_once('connexion_bdd.php');
require_once('fonctions.php');
$idUser = $_GET['id'];
$user = getUser($pdo, $idUser);
$errors = [];
if ( $_SERVER['REQUEST_METHOD'] === 'POST'){
    $returnValidation = validateEditUserForm();
    $errors = $returnValidation['errors'];

    if( count($errors) === 0) {
        updateUser($pdo, $user['id']);
        header('Location: adminregister.php');
    }
}
?>

<form  method="post" action="edit_utilisateur.php?id=<?php echo($user['id']);?>" enctype="multipart/form-data">
    <label>
        Login
    </label>
    <input name="login" required type="text" placeholder="login" value="<?php echo($user['login']);?>">
    <label>
        Nom
    </label>
    <input name="nom" type="text"  placeholder="Nom" value="<?php echo($user['nom']);?>">
    <label>
        Prénom
    </label>
    <input name="prenom" type="text"  placeholder="Prénom" value="<?php echo($user['prenom']);?>">
    <button type="submit">Modifier</button>
</form>