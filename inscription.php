<?php
// Lance la session et inclut la connexion à la base de données 
session_start();
include("./connexion_bdd.php");

// On récupere les informations écrit dans le formulaire

$prenom = $_POST['prenom'];
$nom = $_POST['nom'];
$email = $_POST['mail'];
$mdp = $_POST['mdp'];
$confmdp = $_POST['confmdp'];

################## Email######################

//On valide le format de l'email grace a la fonction filter_var

$email = filter_var($email, $filter = FILTER_VALIDATE_EMAIL);

if(!$email){
    $email = filter_var($email, $filter = FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, $filter = FILTER_VALIDATE_EMAIL);
    if(!$email){
       echo("Veuillez insérez une adresse mail valide !");
    } else {
        return $email;
    }
   
}

################### Nom ########################
//Le nom et prénom va être stocké et affiché. On doit empêcher du code malicieux avec la fonction htmlspecialchars
$nom = htmlspecialchars($nom);
$prenom = htmlspecialchars($prenom);

############### Gestion des mots de passes ######################

if($mdp != $confmdp) {
    echo("Les mots de passes ne correspondent pas. Merci.");
    exit;
}
//Cryptage du mot de passe
$hash_mdp = password_hash($mdp, PASSWORD_DEFAULT);

// Les données sont propres, on va les insérer en base de données :

try {
// Création de la requête
$rqt = "INSERT INTO users (email, hashed_password, firstname, lastname) VALUES (:email, :hashed_password, :firstname, :lastname)";

$stmt = $conn->prepare($rqt);

$stmt->bindParam(':email', $email );
$stmt->bindParam(':hashed_password', $hash_mdp);
$stmt->bindParam(':firstname', $prenom);
$stmt->bindParam(':lastname', $nom);

$stmt->execute();
echo("Vous êtes inscrit connectez-vous !");


} catch(Exception $e) {
    echo "Problème rencontré lors de l'inscription : " . $e->getMessage();
}



header('Location: contact.html');






/*
echo($prenom);
echo($nom);
*/

