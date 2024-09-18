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
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
  <title>SkillSyncro - Rapport</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-wxFlZo07I5krw0eK3XeRODLOOUC7LQCnfuu45I+h2bNnaEB3P0yAsoBw28IM84dGwaFViWgBZ0OWb7mtmLBR4A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    @media (max-width: 767px) {
      .table-responsive {
        overflow-x: auto;
      }
    }
  </style>
</head>
<body>
  <div id="app">
    <div class="main-wrapper">
      <?php include("../import/main.php"); ?>
      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-24">
                <div class="card">
                  <div class="boxs mail_listing">
                    <div class="inbox-center table-responsive">
                      <table class="table table-hover">
                        <thead>
                          <tr>
                            <th>Destinataire</th>
                            <th>Sujet</th>
                            <th>Heure</th>
                            <th>Statut</th> <!-- Nouvelle colonne -->
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="unread">
                            <td>Nelson Lane</td>
                            <td>
                              <span class="badge badge-primary">Work</span>
                              Lorem ipsum perspiciatis unde omnis iste natus
                            </td>
                            <td>12:30 PM</td>
                            <td>
                              <span class="badge badge-success">Côté</span>
                            </td>
                          </tr>
                          <tr class="unread">
                            <td>Kerry Mann</td>
                            <td>Lorem ipsum perspiciatis unde omnis iste natus</td>
                            <td>May 13</td>
                            <td>
                              <span class="badge badge-danger">Non Côté</span>
                            </td>
                          </tr>
                          <tr class="unread">
                            <td>Adam Peters</td>
                            <td>
                              <span class="badge badge-secondary">Shopping</span>
                              Lorem ipsum perspiciatis unde omnis
                            </td>
                            <td>May 12</td>
                            <td>
                              <span class="badge badge-success">Côté</span>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-sm-7">
                        <p class="p-15">Showing 1 - 15 of 200</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
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
  <!-- Vos scripts JavaScript -->
</body>
</html>
