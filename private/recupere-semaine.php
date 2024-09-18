<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("location: login");
} else {
    if (!isset($_SESSION['type'])) {
        $_SESSION['type'] = "1";
    }
}

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

// Obtention du mois actuel en français
$mois_fr_actuel = $_SESSION['mois_id'];

// Obtention de l'année actuelle
$annee_actuelle = $_SESSION['annee'];

$semaine = $_SESSION['semaine_id'];

// Préparation de la requête SQL pour récupérer les données de la table cotations
$sql = "SELECT c.agent, c.jour, c.mois, c.annee, c.realiser, c.semaine, SUM(c.cotation) AS total_cotation, 
               t.tache, t.pourcentage
        FROM cotations c
        JOIN taches t ON c.tache = t.id_tache
        WHERE c.annee = :annee
        AND c.mois = :mois
        AND c.agent = :agent
        AND c.semaine = :semaine
        GROUP BY c.agent, c.jour, c.mois, c.annee, c.realiser, c.semaine, t.tache, t.pourcentage";

// Préparation de la requête SQL
$stmt = $pdo->prepare($sql);

// Liaison des paramètres
$stmt->bindParam(':annee', $annee_actuelle);
$stmt->bindParam(':mois', $mois_fr_actuel);
$stmt->bindParam(':agent', $_SESSION['employee_id']);
$stmt->bindParam(':semaine', $semaine);

// Exécution de la requête
$stmt->execute();

// Récupération des résultats
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialisation des données pour le graphique
$data = array();

// Initialisation d'un tableau pour stocker les cotations par semaine
$cotations_par_semaine = array();

foreach ($resultats as $resultat) {
    $semaine = $resultat['jour'];
    $total_cotation = $resultat['total_cotation'];
    
    // Vérifie si la semaine existe déjà dans le tableau
    if (!isset($cotations_par_semaine[$semaine])) {
        // Si non, initialise la somme des cotations pour cette semaine
        $cotations_par_semaine[$semaine] = $total_cotation;
    } else {
        // Si oui, ajoute les cotations à la somme existante
        $cotations_par_semaine[$semaine] += $total_cotation;
    }
}

// Construction des données pour le graphique
foreach ($cotations_par_semaine as $semaine => $somme_cotation) {
    $label = "#" . $semaine;
    $data[] = array(
        "label" => $label,
        "value" => $somme_cotation
    );
}

// Affichage des données au format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
