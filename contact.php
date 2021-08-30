<?php
/*
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);
*/

include("./connexion_bdd.php");

$prenom = $_POST['prenom'];
$email = $_POST['email'];
$tel = $_POST['tel'];
$msg = $_POST['msg'];

$email = filter_var($email, $filter = FILTER_VALIDATE_EMAIL);
//filter_var retourne soit la valeur email d'origine si elle est valider sinon elle retourne FALSE


//si le filtre retourne faux {
if(!$email){

    //Nettoyage de l'adresse mail en laissant uniquement les caractere autorisée et chiffres/lettres
    $email = filter_var($email, $filter = FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, $filter = FILTER_VALIDATE_EMAIL);

    //Apres nettoyage si le filter retourne encore FALSE alors on affiche un message d'erreur
    if(!$email){
       echo("Veuillez insérez une adresse mail valide !");
    } else {
        return $email;
    }

}

$prenom = htmlspecialchars($prenom);
//$tel = htmlspecialchars($tel);
$msg = htmlspecialchars($msg);

try {
$rqt = "INSERT INTO contact (prenom, email, tel, msg) VALUES (:prenom, :email, :tel, :msg)";

$stmt = $db->prepare($rqt);

$stmt->bindParam(':prenom', $prenom);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':tel', $tel);
$stmt->bindParam(':msg', $msg);

$stmt->execute();

} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}


echo($prenom);
echo($email);