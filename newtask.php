<?php
session_start();

include("./connexion_bdd.php");


$email = $_SESSION["email"];

echo($email);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

try {
$rqt = "SELECT id, email, firstname FROM users WHERE email = :email" ;

$stmt = $conn->prepare($rqt);

$stmt->bindParam(':email', $email);

$stmt->execute();

$result = $stmt->fetch();
} catch(Exception $e) {
    echo $e->getMessage();
    exit;
}

$id = $result['id'];

