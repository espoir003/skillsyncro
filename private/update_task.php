<?php
session_start();

// Vérifie si la requête est de type POST
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Récupère les données envoyées via la requête AJAX
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifie si les données nécessaires sont présentes
    if (isset($data['taskId'], $data['column'], $data['newValue'])) {
        // Informations de connexion à la base de données
        $host = "localhost";
        $username = "root";
        $password = "";
        $dbname = "skillsyncro"; // Nom de la base de données

        try {
            // Connexion à la base de données avec PDO
            $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, renvoyer une réponse d'erreur
            echo json_encode(["success" => false, "message" => "Erreur de connexion à la base de données"]);
            exit();
        }

        // Échapper les données pour éviter les injections SQL
        $taskId = htmlspecialchars($data['taskId']);
        $column = htmlspecialchars($data['column']);
        $newValue = htmlspecialchars($data['newValue']);

        // Si la colonne est "nom_tache", mise à jour du nom de la tâche
        if ($column === "tache") {
            // Requête SQL pour mettre à jour le nom de la tâche dans la base de données
            $sqlUpdateName = "UPDATE taches SET tache = :newValue WHERE id_tache = :taskId";

            // Préparation de la requête SQL
            $stmtUpdateName = $pdo->prepare($sqlUpdateName);

            // Liaison des paramètres
            $stmtUpdateName->bindParam(':newValue', $newValue);
            $stmtUpdateName->bindParam(':taskId', $taskId);

            // Exécution de la requête
            try {
                $stmtUpdateName->execute();
                // Succès de la mise à jour
                echo json_encode(["success" => true]);
                exit();
            } catch (PDOException $e) {
                // En cas d'erreur lors de l'exécution de la requête, renvoyer une réponse d'erreur
                echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour du nom de la tâche : " . $e->getMessage()]);
                exit();
            }
        }

        // Pour les autres colonnes que "nom_tache", mise à jour du pourcentage
        // Requête SQL pour obtenir les données de la table taches
        $sql = "SELECT id_tache, pourcentage, id_respo FROM taches WHERE id_tache = :taskId";

        // Préparation de la requête SQL
        $stmt = $pdo->prepare($sql);

        // Liaison des paramètres
        $stmt->bindParam(':taskId', $taskId);

        // Exécution de la requête
        $stmt->execute();

        // Récupération des résultats
        $task = $stmt->fetch(PDO::FETCH_ASSOC);

        // Calcul de la somme des pourcentages
        $totalPercentage = $task['pourcentage'] + $newValue;

        // Requête SQL pour obtenir le pourcentage de la responsabilité
        $sqlResponsibility = "SELECT pourcentage FROM responsabilite WHERE id_respo = :responsibilityId";

        // Préparation de la requête SQL
        $stmtResponsibility = $pdo->prepare($sqlResponsibility);

        // Liaison des paramètres
        $stmtResponsibility->bindParam(':responsibilityId', $task['id_respo']);

        // Exécution de la requête
        $stmtResponsibility->execute();

        // Récupération du pourcentage de la responsabilité
        $responsibilityPercentage = $stmtResponsibility->fetchColumn();

        // Vérification si la somme des pourcentages dépasse le pourcentage de la responsabilité
        if ($totalPercentage > $responsibilityPercentage) {
            // Si la somme des pourcentages dépasse, renvoyer une réponse d'erreur
            echo json_encode(["success" => false, "message" => "La somme des pourcentages dépasse le pourcentage de la responsabilité"]);
            exit();
        }

        // Requête SQL pour mettre à jour la tâche dans la base de données
        $sqlUpdateTask = "UPDATE taches SET $column = :newValue WHERE id_tache = :taskId";

        // Préparation de la requête SQL
        $stmtUpdateTask = $pdo->prepare($sqlUpdateTask);

        // Liaison des paramètres
        $stmtUpdateTask->bindParam(':newValue', $newValue);
        $stmtUpdateTask->bindParam(':taskId', $taskId);

        // Exécution de la requête
        try {
            $stmtUpdateTask->execute();
            // Succès de la mise à jour
            echo json_encode(["success" => true]);
            exit();
        } catch (PDOException $e) {
            // En cas d'erreur lors de l'exécution de la requête, renvoyer une réponse d'erreur
            echo json_encode(["success" => false, "message" => "Erreur lors de la mise à jour de la tâche : " . $e->getMessage()]);
            exit();
        }

    } else {
        // Si des données nécessaires sont manquantes, renvoyer une réponse d'erreur
        echo json_encode(["success" => false, "message" => "Données manquantes"]);
        exit();
    }
} else {
    // Si la requête n'est pas de type POST, renvoyer une réponse d'erreur
    echo json_encode(["success" => false, "message" => "La requête doit être de type POST"]);
    exit();
}
?>
