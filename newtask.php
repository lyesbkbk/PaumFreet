<?php
session_start();

include("./connexion_bdd.php");

//variable de session board_id
$board_id = 213;
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
$taskresp = $_POST['responsible'];
$tasktitle = $_POST['titre'];
$taskdesc = $_POST['description'];
$taskstatus = $_POST['status'];
$taskcategory = $_POST['category'];
$taskend = $_POST['enddate'];
$taskdiff = $_POST['difficulty'];
$taskpoint = $_POST['points'];

try {
    // Création de la requête
    $rqt = "INSERT INTO tasks (board_id, author_id, titre, 'description', end_date, responsible, 'status', category, 'point', difficulty) VALUES (:board_id, :author_id, :titre, :dsc, :end_date, :responsible, :statu, :category, :pts, :difficulty)";
    
    $stmt = $conn->prepare($rqt);
    
    $stmt->bindParam(':boar_id', $board_id );
    $stmt->bindParam(':author_id', $id);
    $stmt->bindParam(':titre', $tasktitle);
    $stmt->bindParam(':dsc', $taskdesc);
    $stmt->bindParam(':end_date', $taskend);
    $stmt->bindParam(':responsible', $taskresp);
    $stmt->bindParam(':statu', $taskstatus);
    $stmt->bindParam(':category', $taskcategory);
    $stmt->bindParam(':pts', $taskpoint);
    
    $stmt->execute();
    echo("Nouvelle tâche ajoutée !");
    
    
    } catch(Exception $e) {
        echo "Problème rencontré lors de l'ajout de la tâche : " . $e->getMessage();
    }