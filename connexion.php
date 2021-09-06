<?php
include("./connexion_bdd.php");

$email = $_POST['mail'];
$mdp = $_POST['mdp'];

//Création de la requête en chaîne de caractère
$rqt = "SELECT id, email, hashed_password FROM users WHERE email = :email" ;
//Préparation de la requête
$stmt = $conn->prepare($rqt);
//On associe l'email au paramètre de la requête 
$stmt->bindParam(':email', $email);
//on éxecute la requête
$stmt->execute();
//On parcours les résultats





if($resultat = $stmt->fetch()) {

    $hash = $resultat["hashed_password"];
    //Pour vérifier un mot de passe on utilise la fonction php password_verify
    if(!password_verify($mdp, $hash)) {
        header('Location: inscription.html');
        exit;
    } else {

    session_start();
    $_SESSION["email"] = $email;
    header('Location: newtask.php');
    }
} else {
    header('Location: info.php');

} 


