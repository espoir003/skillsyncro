<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location: login");
}else{
  if(!isset($_SESSION['type'])){
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

// Tableau associatif pour convertir les mois en français
$mois_fr = array(
    'January' => 'Janvier',
    'February' => 'Fevrier',
    'March' => 'Mars',
    'April' => 'Avril',
    'May' => 'Mai',
    'June' => 'Juin',
    'July' => 'Juillet',
    'August' => 'Aout',
    'September' => 'Septembre',
    'October' => 'Octobre',
    'November' => 'Novembre',
    'December' => 'Décembre'
);

// Obtention du mois actuel en français
$mois_fr_actuel = $mois_fr[date('F')];

// Tableau associatif pour convertir les jours de la semaine en français
$jours_fr = array(
    'Monday' => 'Lundi',
    'Tuesday' => 'Mardi',
    'Wednesday' => 'Mercredi',
    'Thursday' => 'Jeudi',
    'Friday' => 'Vendredi',
    'Saturday' => 'Samedi',
    'Sunday' => 'Dimanche'
);

// Obtenir le jour de la semaine actuel en français
$jour_fr_actuel = $jours_fr[date('l')];

// Obtention de l'année actuelle
$annee_actuelle = date('Y');

// Préparation de la requête SQL pour récupérer les données de la table cotations
$sql = "SELECT c.agent, c.jour, c.mois, c.annee,c.realiser, SUM(c.cotation) AS total_cotation, 
               t.tache, t.pourcentage
        FROM cotations c
        JOIN taches t ON c.tache = t.id_tache
        WHERE c.annee = :annee
        AND c.jour = :jour
        AND c.mois = :mois
        AND c.agent = :agent
        GROUP BY c.agent, c.jour, c.mois, c.annee,c.realiser, t.tache, t.pourcentage";

// Préparation de la requête SQL
$stmt = $pdo->prepare($sql);

// Liaison des paramètres
$stmt->bindParam(':annee', $annee_actuelle);
$stmt->bindParam(':jour', $jour_fr_actuel);
$stmt->bindParam(':mois', $mois_fr_actuel);
$stmt->bindParam(':agent', $_SESSION['employee_id']);

// Exécution de la requête
$stmt->execute();

// Récupération des résultats
$resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Initialisation des données pour le graphique
$data = array();

foreach ($resultats as $resultat) {
    // Formater la valeur de "Réaliser" pour que la première lettre soit en majuscule et les autres en minuscules
    $realiser = ucfirst(strtolower($resultat['realiser']));
    
    // Construire la chaîne pour le label du graphique avec "Réaliser" en haut et "Tache" en bas
    $label = $realiser . "<br>" . '[ '. strtoupper($resultat['tache']) .' ]'. "\n";
    
    // Ajout des données pour le graphique
    $data[] = array(
        "label" => $label,
        "value" => $resultat['total_cotation'] // Le nombre de points réussis pour cette tâche
    );
}

// Affichage des données au format JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
