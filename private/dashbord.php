<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location: login");
}else{
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = "1";
  }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SkillSyncro - home</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/chartist/dist/chartist.min.css">


</head>

<body>
  <!-- Main start -->
  <div id="app">
    <div class="main-wrapper">
      <?php include("../import/main.php"); ?>
      <!-- Main Content -->
      <div class="main-content">
      <a href="#" class="btn btn-primary btn-block">Statistique de l'évolutions générale</a>
           <div id="chart"></div>

      </div>
      <?php include("../import/footer.php"); ?>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Librairies -->
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
 
  <script>
        // Récupérer les données depuis le serveur
        fetch('private/day-dashbord.php') //
            .then(response => response.json())
            .then(data => {
                // Préparer les données pour le graphique
                const labels = data.map(item => item.label);
                const series = data.map(item => item.value);

                // Configuration du graphique
                const options = {
                    chart: {
                        type: 'bar'
                    },
                    series: [{
                        name: 'Point réussi',
                        data: series
                    }],
                    xaxis: {
                        categories: labels
                    },
                    yaxis: {
                        max: 10
                    },
                    tooltip: {
                        y: {
                            formatter: function(value) {
                                return value;
                            }
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
