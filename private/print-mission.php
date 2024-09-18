


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
  <title>Impression - Mission</title>
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
        .invoice {
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        .table th,
        .table td {
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        .procedure {
            margin-top: 30px;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }

        .signature-text {
            font-size: 12px;
            color: #666666;
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
                Impression du jour <hr>
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
                echo "<div class='col-md-6'>";
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

              <div class="procedure">
                <p> <strong>Mission : </strong> Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ex voluptas officiis, optio ut animi vel at illo ipsa mollitia maxime accusantium iure praesentium est laboriosam nisi facilis impedit dolores libero.</p>
                
            </div>
            <!-- Tableau -->
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="3">Nom de la Tâche</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Colonne 1</td>
                        <td>Colonne 2</td>
                        <td>Colonne 3</td>
                    </tr>
                    <!-- Autres lignes ici -->
                </tbody>
            </table>
           
            <div class="signature">
                <div>
                    <p class="signature-text">Texte à lire avant de signer</p>
                    <p class="signature-text">Signature Gauche</p>
                </div>
                <div>
                    <p class="signature-text">Texte à lire avant de signer</p>
                    <p class="signature-text">Signature Droite</p>
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
