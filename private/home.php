<?php

session_start();

if(!isset($_SESSION['id'], $_SESSION['type'], $_SESSION['nom'])){
  header("location: login");
}else{
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = "1";
  }
}


// Inclusion du fichier d'autoloading des classes
include("App/classes/main.php");
include("App/classes/child.php");

// Instanciation de la classe Main
$main = new MyApp\Main();

// Appel de la méthode connect
$pdo = $main->connect();
$sql = "SELECT * FROM agent";
$stmt = $pdo->query($sql);
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
</head>

<body>
  <!-- Main start -->
  <div id="app">
    <div class="main-wrapper">
      <?php include("../import/main.php"); ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row ">
        
        <?php
if ($_SESSION['type'] == "Admin") {
    $sql_employes = "SELECT * FROM agent";
} else {
    $pdo = $main->connect();
    $sql_privilege = "SELECT employer FROM privilege WHERE admin = :admin_id";
    $stmt_privilege = $pdo->prepare($sql_privilege);
    $stmt_privilege->bindParam(':admin_id', $_SESSION['id']);
    $stmt_privilege->execute();
    $selected_employers = $stmt_privilege->fetchAll(PDO::FETCH_COLUMN);

    $sql_employes = "SELECT * FROM agent WHERE id_agent IN (" . implode(",", $selected_employers) . ")";
}

$stmt_employes = $pdo->query($sql_employes);
$employes = $stmt_employes->fetchAll(PDO::FETCH_ASSOC);

foreach ($employes as $employe): ?>
    <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="card">
            <div class="card-statistic-4">
                <div class="align-items-center justify-content-between">
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                            <div class="card-content">
                                <a href="cotations/<?= $employe['id_agent'] ?>" title="Cliquez pour sélectionner une année" class="font-15 employee-link" style="color: black;">
                                    <h5 class="font-15"><?= $employe['nom'] ?> <?= $employe['postnom'] ?> <?= $employe['prenom'] ?></h5>
                                </a>
                                <h2 class="mb-3 font-12"><?= $employe['poste'] ?></h2>
                            </div>
                        </div>
                        <div class="position-absolute" style="bottom: 0; left: 0; margin-bottom: 10px; margin-left: 10px;">
                            <a href="jd-annee/<?= $employe['id_agent'] ?>" class="btn btn-secondary btn-sm jd">
                                Générer un JD
                            </a>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                            <div class="position-relative">
                                <div class="banner-img mt-3">
                                    <a href="cotations/<?= $employe['id_agent'] ?>" class="employee-link">
                                        <img src="private/App/upload/<?= $employe['photo'] ?>" alt="<?= $employe['nom'] ?> <?= $employe['postnom'] ?>" title="<?= $employe['nom'] ?> <?= $employe['postnom'] ?>" style="max-width: 80px;">
                                    </a>
                                </div>
                                <div class="dropdown position-absolute" style="bottom: 0; right: 0;">
                                <?php if($_SESSION['type'] == "Admin"){

                                ?>    
                                <button class="btn btn-secondary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-ellipsis-v"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item modifier" href="modifier-l-employer/<?= $employe['id_agent'] ?>">Modifier</a>
                                       
                                        <a class="dropdown-item supprimer" href="suppression/<?= $employe['id_agent'] ?>" onclick="if (!confirm('Êtes-vous sûr de vouloir supprimer ?')) { return document.location = 'home'; }">Supprimer</a>
                                         
                                      </div>
                                      <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>

          </div>
        </section>
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
    // Sélection du lien
    var lien = document.querySelectorAll('a.employee-link');

    // Ajout d'un gestionnaire d'événements pour le clic sur le lien
    lien.forEach(function(element) {
      element.addEventListener('click', function(event) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();

        // Récupérer l'URL du lien
        var href = this.getAttribute('href');

        // Extraire l'ID de l'employé de l'URL
        var employeeId = href.split('/')[1];

        // Envoyer une requête AJAX pour stocker l'ID de l'employé dans une variable de session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'private/App/includes/url.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse si nécessaire
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page de sélection d'année ici
            window.location.href = 'cotations'; // Remplacez 'selectioner-une-annee' par le chemin de votre page de sélection d'année
          }
        };
        xhr.send('employee_id=' + employeeId);
      });
    });
  </script>
  <script>
    // Sélection du lien
    var lien = document.querySelectorAll('a.jd');

    // Ajout d'un gestionnaire d'événements pour le clic sur le lien
    lien.forEach(function(element) {
      element.addEventListener('click', function(event) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();

        // Récupérer l'URL du lien
        var href = this.getAttribute('href');

        // Extraire l'ID de l'employé de l'URL
        var employeeId = href.split('/')[1];

        // Envoyer une requête AJAX pour stocker l'ID de l'employé dans une variable de session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'private/App/includes/url.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse si nécessaire
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page de sélection d'année ici
            window.location.href = 'jd-annee'; // Remplacez 'selectioner-une-annee' par le chemin de votre page de sélection d'année
          }
        };
        xhr.send('employee_id=' + employeeId);
      });
    });
  </script>
  <script>
    // Sélection du lien
    var lien = document.querySelectorAll('a.modifier');

    // Ajout d'un gestionnaire d'événements pour le clic sur le lien
    lien.forEach(function(element) {
      element.addEventListener('click', function(event) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();

        // Récupérer l'URL du lien
        var href = this.getAttribute('href');

        // Extraire l'ID de l'employé de l'URL
        var modifier = href.split('/')[1];

        // Envoyer une requête AJAX pour stocker l'ID de l'employé dans une variable de session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'private/App/includes/modifier.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse si nécessaire
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page de sélection d'année ici
            window.location.href = 'modifier-les-informations'; // Remplacez 'selectioner-une-annee' par le chemin de votre page de sélection d'année
          }
        };
        xhr.send('modifier=' + modifier);
      });
    });
  </script>
  <script>
    // Sélection du lien
    var lien = document.querySelectorAll('a.supprimer');

    // Ajout d'un gestionnaire d'événements pour le clic sur le lien
    lien.forEach(function(element) {
      element.addEventListener('click', function(event) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();

        // Récupérer l'URL du lien
        var href = this.getAttribute('href');

        // Extraire l'ID de l'employé de l'URL
        var supprimer = href.split('/')[1];

        // Envoyer une requête AJAX pour stocker l'ID de l'employé dans une variable de session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'private/App/includes/supprimer.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse si nécessaire
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page de sélection d'année ici
            window.location.href = 'suppression'; // Remplacez 'selectioner-une-annee' par le chemin de votre page de sélection d'année
          }
        };
        xhr.send('supprimer=' + supprimer);
      });
    });
  </script>
 
</body>
</html>
