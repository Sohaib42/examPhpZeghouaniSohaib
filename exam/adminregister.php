<?php 
require_once('connexion_bdd.php');
require_once('fonctions.php');
$errors = [];
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $errors = validationFormulaireRegister($pdo);
    if(count($errors) === 0){
        registerUser($pdo);
        header('Location: login.php');
    }
}

?>
<html>
    <head>
    </head>
<body>
    <br>
    <h1> Ajout d'utilisateur </h1>
    <form method="post" enctype="multipart/form-data">
    <label>
        Login
    </label>
    <input name="login" required type="text" placeholder="login">
    <label>
        Nom
    </label>
    <input name="nom" type="text"  placeholder="Nom">
    <label>
        Prénom
    </label>
    <input name="prenom" type="text"  placeholder="Prénom">

    <label>
        Password
    </label>
    <input name="password" type="password"  placeholder="Mot de passe">
    <input type="submit">

</form>
</body>
</html>
<ul>
<?php
    if(count($errors)>0){
    echo('<h2>Les erreurs du formulaire : </h2>
    <ul>');
    foreach ($errors as $err){
        echo('<li>'.$err.'</li>');
    }
echo('</ul>');
    }
?>
</ul>
<?php $reponse = $pdo->query('SELECT * FROM utilisateur');
while ($data = $reponse->fetch())
{
?>
<div><hr>
    <h3><?php echo('Login : '.$data['login']); ?></h1><br>
    <h3><?php echo('Nom : '.$data['nom']); ?></h1><br>
    <h3><?php echo('Prénom : '.$data['prenom']); ?></h1><br>
    <a title="Supprimer l'utilisateur" href="delete_utilisateur.php?id=<?php echo($data['id']);?>">Supprimer l'utilisateur</a>
    <a title="Editer l'utilisateur" href="edit_utilisateur.php?id=<?php echo($data['id']);?>">Editer l'utilisateur</a>
    <hr>
</div>

<?php
}
?>