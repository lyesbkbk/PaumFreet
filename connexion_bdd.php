<?php

$dsn = 'pgsql:dbname=paumfreet_bdd;host=postgresql-paumfreet.alwaysdata.net';
$user = 'paumfreet';
$password = 'Simplon';


try {
    $conn = new PDO($dsn, $user, $password);
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}
