


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

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Facture</title>
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
            <!-- Bouton d'impression -->
            <div class="text-right mb-3">
              <button id="printButton" onclick="window.print()" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Imprimer</button>
            </div>
           
            <!-- Section principale de la facture avec la classe "invoice" -->
            <div class="invoice">
              <!-- Entête de la facture -->
              <div class="invoice-title" style="text-align: center;">
                  Rapport journalier [ <?php echo date("d/m/Y"); ?> ]<hr>
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
                ?>
                 <?php  echo "<img src='private/App/upload/" . $employe['photo'] . "' alt='Photo de l'employé' style='height:80px;width:80px;position:absolute;border-radius:10%;'>"; // Affichage de la photo de l'employé ?>

                <div class="text-right">
                  <!-- Adresses (à droite) -->
                 
                  <strong>Destinataire:</strong> Entreprise ABC<br>
                  <strong>Adresse:</strong> 456 Avenue des modèles, Ville, Pays<br>
                  <strong>Email:</strong> info@entrepriseabc.com<br>
                  <strong>Téléphone:</strong> +0987654321
                </div>
              </div>

              <table class="invoice-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Agent</th>
                    <th>Jour</th>
                    <th>Mois</th>
                    <th>Année</th>
                    <th>Heure Début</th>
                    <th>Heure Fin</th>
                    <th>Réaliser</th>
                    <th>Tâche</th>
                    <th>Cotation sur 10</th>
                    <th>Commentaire</th>
                  </tr>
                </thead>
                <tbody>
                <?php
              
               

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
                    'December' => 'Decembre'
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
                $sql = "SELECT c.agent, c.jour, c.mois, c.annee, c.realiser, c.heure_debut, c.heure_fin,c.commentaire, c.semaine, c.mois, c.annee, SUM(c.cotation) AS total_cotation, 
                            t.tache, t.pourcentage
                            FROM cotations c
                            JOIN taches t ON c.tache = t.id_tache
                            WHERE c.annee = :annee
                            AND c.jour = :jour
                            AND c.mois = :mois
                            AND c.agent = :agent
                            GROUP BY c.agent, c.jour, c.mois, c.annee,c.realiser, c.commentaire, t.tache, t.pourcentage,t.id_tache";

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
                $somme = 0;
                $pc = 0;
                $point_avoir = 0;
                $ctr = 0;
                // Boucle sur les résultats
                foreach ($resultats as $key => $resultat) {
                    echo "<tr>";
                    echo "<td>" . ($key + 1) . "</td>";
                    echo "<td>" . $resultat['agent'] . "</td>";
                    echo "<td>" . $resultat['jour'] . "</td>";
                    echo "<td>" . $resultat['mois'] . "</td>";
                    echo "<td>" . $resultat['annee'] . "</td>";
                    echo "<td>" . $resultat['heure_debut'] . "</td>";
                    echo "<td>" . $resultat['heure_fin'] . "</td>";
                    echo "<td>" . $resultat['realiser'] . "</td>";
                    echo "<td>" . $resultat['tache'] . "</td>";
                    echo "<td>" . $resultat['total_cotation'] . "</td>";
                    echo "<td>" . $resultat['commentaire'] . "</td>";
                    echo "</tr>";
                    $somme = $somme + $resultat['total_cotation'];
                    $pc = $pc + $resultat['pourcentage'];
                    $ctr = $ctr + 1;
                }
                $point_avoir = 10 * $ctr;
                $reponse = 0;
                if(isset($somme) && isset($point_avoir) && isset($pc) && !empty($somme) && !empty($point_avoir) && !empty($pc)) {
                  // Vérifier si le dénominateur n'est pas égal à zéro
                  if($point_avoir != 0) {
                      // Calculer la réponse
                      $reponse = ($somme*$pc)/$point_avoir;
                  } else {
                      echo "<strong style='text-align:center;color:red;'>Pas des informations trouvées pour aujourd'hui " . '</strong>';
                  }
                } else {
                  echo "<strong style='text-align:center;color:red;'>Pas des informations trouvées pour aujourd'hui " .'</strong>';
                }
                ?>
               
            </tbody>
              </table>
              <div class="invoice-total" style="font-size: 12px;">
                Total: <?php echo number_format($reponse,1) ."% Réussi sur " . $pc . ' %';  ?>
              </div>

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
