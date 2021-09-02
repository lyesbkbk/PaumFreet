<?php
session_start();

include("./connexion_bdd.php");
//include("./connexion.php");

$email = $_SESSION["email"];



$rqt = "SELECT id, prenom FROM users WHERE email = :email" ;

$stmt = $conn->prepare($rqt);

$stmt->bindParam(':email', $email);

$stmt->execute();

if($resultat = $stmt->fetch()) {
    $verif = $resultat["id"];
    echo($verif);
    echo("<html><body>$verif</body></html>");

}

/*
$verif = $resultat["id"];

echo($verif);
*/
/*
$userid = 0
$_SESSION["userid"] = 
*/