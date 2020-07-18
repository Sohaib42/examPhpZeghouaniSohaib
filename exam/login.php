<?php 
require_once('connexion_bdd.php');
require_once('fonctions.php');
$errors =[];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $errors = validationFormulaireLogin();
    if(count($errors) === 0){
        $errors = connexionUser($pdo);
    }
}
?>

<form action="admin.php" method="post">
    <label>
        Login
    </label>
    <input type="text" name="login" placeholder="Veuillez saisir votre login">
    <label>
        Password
    </label>
    <input type="password" name="password" placeholder="Veuillez saisir votre password">
    <input type="submit">
</form>

