<html>
    <head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    </head> 
<body>
<nav class="navbar navbar-light bg-light">
  <a class="navbar-brand" href="#">
    <img src="https://png.pngtree.com/png-clipart/20190905/original/pngtree-settings-icon-png-image_4525907.jpg" width="30" height="30" class="d-inline-block align-top" alt="Logo">
    Gestion annonces :
  </a>
  <a class="navbar-brand" href="add_annonce.php">Ajouter une annonce</a>
</nav>
</body>
</html>
<?php 
require_once('connexion_bdd.php');
require_once('fonctions.php');
$reponse = $pdo->query('SELECT * FROM annonce');
while ($data = $reponse->fetch())
{
    ?>
    <h1><?php echo('Titre : '.$data['titre']); ?></h1>
    <img height="100px" src="<?php echo($data['image_link'])?>">
    <p><?php echo($data['contenu'])?></p>
    
    <a title="Supprimer l'annonce" href="delete_annonce.php?id=<?php echo($data['id']);?>">Supprimer l'annonce</a>
    <a title="Editer l'annonce" href="edit_annonce.php?id=<?php echo($data['id']); ?>">
 Editer l'annonce
 </a>
    <?php
}
$reponse->closeCursor()
?>