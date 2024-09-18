<?php
session_start();

// Récupérer l'ID de l'employé à partir de la requête POST
if (isset($_POST['supprimer'])) {
    $supprimer = $_POST['supprimer'];

    // Stocker l'ID de l'employé dans une variable de session
    $_SESSION['supprimer'] = $supprimer;

    // Répondre avec un statut HTTP 200 (OK)
    http_response_code(200);
    exit; // Terminer le script
} else {
    // Répondre avec un statut HTTP 400 (Bad Request) si l'ID de l'employé n'est pas fourni
    http_response_code(400);
    exit; // Terminer le script
}

?>