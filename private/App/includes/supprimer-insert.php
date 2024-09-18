<?php
// insert_agent.php
session_start();
// Inclusion du fichier d'autoloading des classes
include("../classes/main.php");
include("../classes/child.php");


// Utilisation de l'espace de noms MyApp pour la classe Agent
use MyApp\Main;

use MyApp\Config;

// Création d'une instance de la classe Agent
$agent = new Config();

// Appel de la méthode insertAgent() pour insérer un agent dans la base de données
$message = $agent->supprimerAgent($_SESSION['supprimer']);
?>