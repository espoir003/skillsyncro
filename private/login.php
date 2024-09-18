<?php

session_start();
// Inclusion du fichier d'autoloading des classes
include("App/classes/main.php");
include("App/classes/child.php");

// Instanciation de la classe Main
$main = new MyApp\Config();
if(isset($_POST['email'])){
  $main->login($_POST["email"],md5($_POST['password']));
  echo md5($_POST['password']);
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SkillSyncro - Login</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <div class="loader"></div>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
            <div class="card card-primary">
              <div class="card-header">
                <h4>Login</h4>
              </div>
              <div class="card-body">
              <form method="POST"action="" class="needs-validation" id="agentForm" novalidate>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                    <div class="invalid-feedback">
                        Veuillez remplir votre adresse email.
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                    <div class="invalid-feedback">
                        Veuillez remplir votre mot de passe.
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="3">Se connecter</button>
                    <button type="reset" class="btn btn-secondary btn-lg btn-block" tabindex="4">Réinitialiser</button>
                </div>
            </form>

               
              </div>
            </div>
           
          </div>
        </div>
      </div>
    </section>
  </div>
  <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <div id="myModalContent"></div>
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