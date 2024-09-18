<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location: login");
}else{
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = "1";
  }
}
if(!isset($_SESSION['mois_id']) and !isset($_SESSION['annee']) and !isset($_SESSION['employee_id'])){
    header('location: home');
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SkillSyncro - Stat Semestriel</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
  <!-- Main start -->
  <div id="app">
    <div class="main-wrapper">
      <?php include("../import/main.php"); ?>
      <!-- Main Content -->
      <div class="main-content">
        <a href="resultat-semaine" class="btn btn-primary btn-block">Impression pour <?php echo $_SESSION['semaine_id']; ?> mois de <?php echo $_SESSION['mois_id']; ?></a>
        <div id="chart"></div>
      </div>
      <?php include("../import/footer.php"); ?>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Librairies -->
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>

  <script>
    // Récupérer les données depuis le serveur
    fetch('private/recupere-semaine.php') // Remplacez 'private/day.php' par le chemin de votre fichier PHP contenant les données JSON
      .then(response => response.json())
      .then(data => {
        // Préparer les données pour le graphique
        const labels = data.map(item => item.label);
        const series = data.map(item => item.value);

        // Configuration du graphique
        const options = {
          chart: {
            height: 400,
            type: 'area',
            zoom: {
              enabled: false
            }
          },
          colors: ['#5E72E4'], // Couleur des lignes
          series: [{
            name: 'Points réussis Total',
            data: series
          }],
          xaxis: {
            categories: labels,
            labels: {
              style: {
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Roboto, sans-serif',
                cssClass: 'apexcharts-xaxis-label'
              }
            }
          },
          yaxis: {
            max: Math.max(...series), // Utilisez la valeur maximale des séries de données comme limite maximale de l'axe y
            labels: {
              style: {
                fontSize: '14px',
                fontWeight: 500,
                fontFamily: 'Roboto, sans-serif',
                cssClass: 'apexcharts-yaxis-label'
              }
            }
          },
          grid: {
            borderColor: '#f1f1f1',
            padding: {
              left: 0,
              right: 0
            }
          },
          stroke: {
            curve: 'smooth'
          },
          fill: {
            type: 'gradient',
            gradient: {
              shadeIntensity: 1,
              opacityFrom: 0.7,
              opacityTo: 0,
              stops: [0, 90, 100]
            }
          },
          markers: {
            size: 6,
            colors: ['#5E72E4'],
            strokeWidth: 0,
            hover: {
              size: 10
            }
          },
          tooltip: {
            enabled: true,
            theme: 'light',
            style: {
              fontSize: '14px',
              fontFamily: 'Roboto, sans-serif'
            }
          }
        };

        // Création du graphique
        const chart = new ApexCharts(document.querySelector('#chart'), options);

        // Afficher le graphique
        chart.render();
      })
      .catch(error => console.error('Erreur lors du chargement des données:', error));
  </script>
</body>

</html>
