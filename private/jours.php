<?php

session_start();

if(!isset($_SESSION['id'])){
  header("location: login");
}else{
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = "1";
  }
}

if(!isset($_SESSION['semaine_id']) and !isset($_SESSION['mois_id']) and !isset($_SESSION['annee']) and !isset($_SESSION['employee_id'])){
  header("location: home");
}
if($_SESSION['type'] <> "Admin"){
  header("location: home");
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SkillSyncro - Les jours</title>
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

    <!-- main start -->

      <?php include("../import/main.php"); ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="row ">

            
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <a href="update/Lundi"  class="font-15 jour-link" style="color: black;">
                          <h5 class="font-12">
                             Sélectionner le jour
                            </h5>
                            </a>
                          <h2 class="mb-3 font-18">Lundi</h2>
                         
                        </div>
                      </div>
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <a href="update/Lundi" class="font-15 jour-link">
                            <img src="assets/img/years.png" alt="">
                          </a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <a href="update/Mardi"  class="font-15 jour-link" style="color: black;">
                          <h5 class="font-12">
                             Sélectionner le jour
                            </h5>
                            </a>
                          <h2 class="mb-3 font-18">Mardi</h2>
                         
                        </div>
                      </div>
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <a href="update/Mardi" class="font-15 jour-link">
                            <img src="assets/img/years.png" alt="">
                          </a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <a href="update/Mercredi"  class="font-15 jour-link" style="color: black;">
                          <h5 class="font-12">
                             Sélectionner le jour
                            </h5>
                            </a>
                          <h2 class="mb-3 font-18">Mercredi</h2>
                         
                        </div>
                      </div>
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <a href="update/Mercredi" class="font-15 jour-link">
                            <img src="assets/img/years.png" alt="">
                          </a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <a href="update/Jeudi"  class="font-15 jour-link" style="color: black;">
                          <h5 class="font-12">
                             Sélectionner le jour
                            </h5>
                            </a>
                          <h2 class="mb-3 font-18">Jeudi</h2>
                         
                        </div>
                      </div>
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <a href="update/Jeudi" class="font-15 jour-link">
                            <img src="assets/img/years.png" alt="">
                          </a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <a href="update/Vendredi"  class="font-15 jour-link" style="color: black;">
                          <h5 class="font-12">
                             Sélectionner le jour
                            </h5>
                            </a>
                          <h2 class="mb-3 font-18">Vendredi</h2>
                         
                        </div>
                      </div>
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img" class="font-15 jour-link">
                          <a href="update/Vendredi">
                            <img src="assets/img/years.png" alt="">
                          </a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <a href="update/Samedi"  class="font-15 jour-link" style="color: black;">
                          <h5 class="font-12">
                             Sélectionner le jour
                            </h5>
                            </a>
                          <h2 class="mb-3 font-18">Samedi</h2>
                         
                        </div>
                      </div>
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <a href="update/Samedi" class="font-15 jour-link">
                            <img src="assets/img/years.png" alt="">
                          </a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <a href="update"  class="font-15 jour-link" style="color: black;">
                          <h5 class="font-12">
                             Sélectionner le jour
                            </h5>
                            </a>
                          <h2 class="mb-3 font-18">Dimanche</h2>
                         
                        </div>
                      </div>
                      
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <a href="update" class="font-15 jour-link">
                            <img src="assets/img/years.png" alt="">
                          </a>
                          
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
           
         

          </div>

          


          
          
        </section>

      </div>
     <?php
        include("../import/footer.php");
     ?>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/index.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script>
    // Sélection du lien
    var lien = document.querySelectorAll('a.jour-link');

    // Ajout d'un gestionnaire d'événements pour le clic sur le lien
    lien.forEach(function(element) {
      element.addEventListener('click', function(event) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();

        // Récupérer l'URL du lien
        var href = this.getAttribute('href');

        // Extraire l'ID de l'employé de l'URL
        var jour_id = href.split('/')[1];

        // Envoyer une requête AJAX pour stocker l'ID de l'employé dans une variable de session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'private/App/includes/url-jour.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse si nécessaire
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page de sélection d'année ici
            window.location.href = 'update'; // Remplacez 'selectionner-une-semaine' par le chemin de votre page de sélection d'année
          }
        };
        xhr.send('jour_id=' + jour_id);
      });
    });
  </script>
</body>

</html>