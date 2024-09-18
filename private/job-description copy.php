<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("location: login");
} else {
    if (!isset($_SESSION['type'])) {
        $_SESSION['type'] = "1";
    }
}


if(!isset($_SESSION['annee']) and !isset($_SESSION['employee_id'])){
    header("location: home");
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

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>JobDescription </title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <!-- Styles pour la facture -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .invoice {
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        .invoice-title {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }

        .invoice-number {
            font-size: 16px;
            color: #666666;
        }

        .invoice-address {
            margin-top: 20px;
            font-size: 14px;
            color: #666666;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #e1e1e1;
            padding: 10px;
            text-align: left;
        }

        .invoice-total {
            margin-top: 20px;
            font-size: 18px;
            color: #333333;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #666666;
            text-align: center;
        }

        .footer-signature {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                       

                        <!-- Section principale de la facture avec la classe "invoice" -->
                        <div class="invoice">
                            <!-- Entête de la facture -->
                            <div class="invoice-title" style="text-align: center;">
                                Job Description pour L'année <?php echo $_SESSION['annee'] ?><hr>
                            </div>

                            <div class="invoice-address">
                                <?php
                                // Préparation de la requête SQL pour récupérer les informations de l'employé
                                $sql = "SELECT nom, postnom, prenom, poste, photo
                                    FROM agent
                                    WHERE id_agent = :id_agent";

                                // Préparation de la requête SQL
                                $stmt = $pdo->prepare($sql);

                                // Liaison des paramètres
                                $stmt->bindParam(':id_agent', $_SESSION['employee_id']);

                                // Exécution de la requête
                                $stmt->execute();

                                // Récupération des résultats
                                $employe = $stmt->fetch(PDO::FETCH_ASSOC);

                                // Affichage des informations de l'employé
                                echo "<div>";
                                echo "<strong>Nom:</strong> " . $employe['nom'] . " " . $employe['postnom'] . " " . $employe['prenom'] . "<br>";
                                echo "<strong>Poste:</strong> " . $employe['poste'] . "<br>";
                                echo "</div>";

                                echo "<img src='private/App/upload/" . $employe['photo'] . "' alt='Photo de l'employé' style='height:80px;width:80px;position:absolute;border-radius:10%;'>"; // Affichage de la photo de l'employé
                                ?>

                                <div class="text-right">
                                    <!-- Adresses (à droite) -->
                                    <strong>Destinataire:</strong> Entreprise ABC<br>
                                    <strong>Adresse:</strong> 456 Avenue des modèles, Ville, Pays<br>
                                    <strong>Email:</strong> info@entrepriseabc.com<br>
                                    <strong>Téléphone:</strong> +0987654321
                                </div>
                            </div>
                            <hr>
                            <p style="text-align:justify;">
                              <?php

                                  $sql = "SELECT mission
                                  FROM mission
                                  WHERE agent = :id_agent and annee = :annee";

                                  // Préparation de la requête SQL
                                  $stmt = $pdo->prepare($sql);

                                  // Liaison des paramètres
                                  $stmt->bindParam(':id_agent', $_SESSION['employee_id']);
                                  $stmt->bindParam(':annee', $_SESSION['annee']);

                                  // Exécution de la requête
                                  $stmt->execute();

                                  // Récupération des résultats
                                  $employe = $stmt->fetch(PDO::FETCH_ASSOC);

                              ?>
                              <strong>Mission : </strong><?php if(empty($employe['mission'])){
                                  echo "<em style='color:red;'> Pas de mission pour cet employer pour l'année " . $_SESSION['annee'] . ' Veuillez plutôt l\'ajouter où contacter un expert si l\'erreur persiste.' . "</em>";
                              }else{
                                echo "<em>". $employe['mission'] . "</em>";
                              }  ?>
                            </p>
                            <table class="invoice-table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tâche</th>
                                        <th>Pourcentage</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                  

                                    // Obtention de l'année actuelle
                                    $annee_actuelle = $_SESSION['annee'];


                                    // Préparation de la requête SQL pour récupérer les données de la table cotations
                                    $sql = "SELECT r.id_respo, r.responsabilite,r.agent,r.annee,r.mois, 
                                                t.tache, t.pourcentage,t.id_tache
                                            FROM responsabilite r
                                            JOIN taches t ON t.id_respo = r.id_respo
                                            WHERE r.annee = :annee
                                            AND r.agent = :agent
                                            GROUP BY r.id_respo, r.responsabilite,r.agent,r.annee,r.mois,t.tache, t.pourcentage";

                                    // Préparation de la requête SQL
                                    $stmt = $pdo->prepare($sql);

                                    // Liaison des paramètres
                                    $stmt->bindParam(':annee', $annee_actuelle);
                                    $stmt->bindParam(':agent', $_SESSION['employee_id']);

                                    // Exécution de la requête
                                    $stmt->execute();

                                    // Récupération des résultats
                                    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);


                                    // Initialisation de la semaine actuelle
                                    $currentWeek = '';

                                    // Boucle sur les résultats
                                    foreach ($resultats as $key => $resultat) {

                                        // Vérification si la semaine a changé
                                        if ($resultat['id_respo'] != $currentWeek) {
                                            // Si oui, affichage de la ligne fusionnée pour la nouvelle semaine
                                            echo "<tr style='background-color: #f2f2f2;'>";
                                            echo "<td colspan='9' style='text-align:center;'>" . $resultat['responsabilite'] . "</td>";
                                            echo "</tr>";

                                            // Mise à jour de la semaine actuelle
                                            $currentWeek = $resultat['id_respo'];

                                    
                                        }
                                           
                                            // Affichage des données normalement
                                            echo "<tr>";
                                            echo "<td>" . ($key + 1) . "</td>";
                                            echo "<td>" . $resultat['tache'] . "</td>";
                                            echo "<td>" . $resultat['pourcentage'] . "</td>";
                                            echo "</tr>";                             
                                    }

                                    ?>
                                </tbody>
                            </table>
                           

                            <div class="footer">
                                <div class="footer-signature">
                                    <div>
                                        Signature Employé
                                    </div>
                                    <div>
                                        Signature DG
                                    </div>
                                </div>
                            </div>

                        </div>
                         <!-- Bouton d'impression -->
                        <div class="text-right mb-3">
                            <button id="printButton" onclick="window.print()" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Imprimer</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>


</body>

</html>
