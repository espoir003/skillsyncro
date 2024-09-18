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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique de Pourcentage Réussi</title>
    <!-- Bibliothèque ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>
<body>
    <div id="chart"></div>

    <script>
        // Récupérer les données depuis le serveur
        fetch('private/graph.php') // Remplacez 'votre_page_php.php' par le nom de votre fichier PHP contenant les données JSON
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
                        name: 'Pourcentage Réussi',
                        data: series
                    }],
                    xaxis: {
                        categories: labels
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
