<?php 

function getUserByLogin($pdo, $login)
{

    $res = $pdo->prepare('SELECT * FROM utilisateur WHERE login = :login');
    $res->execute([
        'login' => $login
    ]);
    return $res->fetch();
}
function getAnnonce($pdo,$id)
{
    $res = $pdo->prepare('SELECT * FROM annonce WHERE id = :id');
    $res->execute(['id'=> $id]);
    return $res->fetch();
}
function getUser($pdo,$id)
{
    $res = $pdo->prepare('SELECT * FROM utilisateur WHERE id = :id');
    $res->execute(['id'=> $id]);
    return $res->fetch();}

function validationFormulaireRegister($pdo)
{   
    if(empty($_POST['login'])){
        $errors[] = 'Veuillez renseigner un login';
    }
    if(getUserByLogin($pdo, $_POST['login']) !== false){
        $errors[]  = 'Impossible login déjà existant';
    }

    if(empty($_POST['nom'])){
        $errors[] = 'Veuillez renseigner un nom';
    }

    if(empty($_POST['prenom'])){
        $errors[] = 'Veuillez renseigner un prénom';
    }

    if(empty($_POST['password'])){
        $errors[] = 'Veuillez renseigner un mot de passe';
    }

    return $errors;
}
function registerUser($pdo){
    try{
    $res = $pdo->prepare('INSERT INTO utilisateur (login, nom, prenom, password) 
    VALUES (:login, :nom, :prenom, :password)');
  $res->execute([
      ':login'=> $_POST['login'],
      ':nom'=> $_POST['nom'],
      ':prenom'=> $_POST['prenom'],
      ':password' => md5($_POST['password'])
  ]);

} catch (\Exception $e) {
  var_dump($e); 
  die();
}

}
function validationFormulaireLogin(){
$errors = [];
    if(empty($_POST['login'])) {
        $errors[] = 'Veuillez saisir votre login';
    }

    if(empty($_POST['password'])) {
        $errors[] = 'Veuillez saisir votre password';
    }

    return $errors;
}

function connexionUser($pdo){
    $errors = [];
    $res = $pdo->prepare('SELECT * FROM utilisateur WHERE login = :login AND password = :mdp');
    $res->execute([
        'login'=> $_POST['login'],
        'mdp'=> md5($_POST['password'])
    ]);

    $res = $res->fetch();
    if(!$res) {
        $errors[] = 'Identifiants incorrecte';
        return $errors;
    } else {
        $_SESSION['utilisateur'] = $res;
        header('Location: admin.php');
    }
}
function validateForm() {
    $errors = [];
    if (strlen($_POST['titre'])<=7) {
        $errors[] = 'Veuillez saisir un nom d\'au moins 7 caractères';
    }
    if ( empty($_POST['contenu'])) {
        $errors[] = 'Un article sans contenu? Connaît pas.';
    }   
}
function validateEditForm() {
    $errors = [];
    if (empty($_POST['titre'])) {
        $errors[] = 'Veuillez renseigner un nouveau titre';
    }
    if (empty($_POST['contenu'])) {
        $errors[] = 'Un article sans contenu? Connaît pas.';
    }   
}
function validateEditUserForm() {
    $errors = [];
    if (empty($_POST['login'])){
        $errors[] = 'Veuillez renseigner un nouveau login';
    }
    if (empty($_POST['nom'])){
        $errors[] = 'Veuillez renseigner un nouveau nom';
    }
    if (empty($_POST['prenom'])){
        $errors[] = 'Veuillez renseigner un nouveau prenom';
    }
}
function addBdd($pdo, $imageUrl){
    $req = $pdo->prepare(
    'INSERT INTO annonce(titre,contenu,image_link,nom_prenom_utilisateur)
    VALUES(:titre, :contenu, :image_link, :nom_prenom_utilisateur)');
    $req->execute([
    'titre' => $_POST['titre'],
    'contenu' => $_POST['contenu'],
    'nom_prenom_utilisateur' => $_POST['nom_prenom_utilisateur'],
    'image_link' => $_POST['image_link']
    ]);
    }
function deleteAnnonce($pdo,$id){
    $res = $pdo->prepare('DELETE FROM annonce WHERE id = :id');
    $res ->execute(['id'=>$id]);
}
function deleteUser($pdo,$id){
    $res = $pdo->prepare('DELETE FROM utilisateur WHERE id =:id');
    $res ->execute(['id'=>$id]);
}
function updateBdd($pdo, $imageUrl, $id){
    if(!is_null($imageUrl)){
    $req = $pdo->prepare('UPDATE annonce SET titre = :titre, contenu = :contenu  image_link = :image_link WHERE id = :id');
    $req->execute([
    'titre' => $_POST['titre'],
    'contenu' => $_POST['contenu'],
    'image_link' => $_POST['image_link'],
    'id'=> $id
    ]);
    } else {
    $req = $pdo->prepare('UPDATE annonce SET titre = :titre, contenu = :contenu WHERE id = :id');
    $req->execute([
    'titre' => $_POST['titre'],
    'contenu' => $_POST['contenu'],
    'id'=> $id
    ]);
    }
}
function updateUser($pdo, $id){
    $req = $pdo->prepare('UPDATE utilisateur SET login = :login, nom = :nom  prenom = :prenom WHERE id = :id');
    $req->execute([
    'login' => $_POST['login'],
    'nom' => $_POST['nom'],
    'prenom' => $_POST['prenom'],
    'id'=> $id
    ]);
    }