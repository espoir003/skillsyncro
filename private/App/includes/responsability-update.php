<?php
session_start();

// Inclusion du fichier d'autoloading des classes
include("../classes/main.php");
include("../classes/child.php");

// Informations de connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "skillsyncro"; // Nom de la base de données

try {
    // Connexion à la base de données avec PDO
    $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
    $pdo = new PDO($dsn, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    // En cas d'erreur de connexion, afficher le message d'erreur
    echo "Erreur de connexion : " . $e->getMessage();
    exit(); // Arrêter l'exécution du script
}
// Utilisation de l'espace de noms MyApp pour la classe Agent
use MyApp\Main;

use MyApp\Config;

$sql = "SELECT SUM(pourcentage) AS total_pourcentage FROM responsabilite WHERE id_respo = :respo";

// Préparation de la requête SQL
$stmt = $pdo->prepare($sql);

// Liaison des paramètres
$stmt->bindParam(':respo', $_SESSION['respo']);

// Exécution de la requête
$stmt->execute();

// Récupération des résultats
$employe = $stmt->fetch(PDO::FETCH_ASSOC);

// Création d'une instance de la classe Agent
$agent = new Config();

// Appel de la méthode insertAgent() pour insérer un agent dans la base de données
$message = $agent->updateResponsabilite($employe['total_pourcentage']);
?>