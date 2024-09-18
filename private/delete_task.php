<?php
session_start();

// Vérifier si la requête est une requête POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    // Vérifier si l'identifiant de la tâche a été envoyé
    if (isset($data['taskId'])) {
        // Informations de connexion à la base de données
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "skillsyncro";

        try {
            // Connexion à la base de données avec PDO
            $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
            $pdo = new PDO($dsn, $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Requête SQL pour supprimer la tâche avec l'identifiant donné
            $sql = "DELETE FROM taches WHERE id_tache = :taskId";

            // Préparation de la requête SQL
            $stmt = $pdo->prepare($sql);

            // Liaison des paramètres
            $stmt->bindParam(':taskId', $data['taskId']);

            // Exécution de la requête
            $stmt->execute();

            // Envoyer une réponse JSON indiquant que la suppression a réussi
            echo json_encode(["success" => true, "message" => "La tâche a été supprimée avec succès."]);
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur de connexion ou d'exécution de requête, envoyer une réponse JSON d'erreur
            echo json_encode(["success" => false, "message" => "Erreur lors de la suppression de la tâche : " . $e->getMessage()]);
            exit();
        }
    } else {
        // Si l'identifiant de la tâche n'a pas été envoyé, envoyer une réponse JSON d'erreur
        echo json_encode(["success" => false, "message" => "Identifiant de la tâche manquant."]);
        exit();
    }
} else {
    // Si la requête n'est pas une requête POST, envoyer une réponse JSON d'erreur
    echo json_encode(["success" => false, "message" => "Méthode de requête non autorisée."]);
    exit();
}
?>
