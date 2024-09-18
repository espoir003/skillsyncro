<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - SkillSyncro</title>
    <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <style>
        .step-content {
            display: none;
        }
        .step-content.active {
            display: block;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0" style="text-align: center;">Welcome  - Lancement de l'application SkillSyncro</h4>
                </div>
                <div class="card-body">
                <form method="POST">
                    <!-- Step 1 -->
                    <div class="step-content active" id="step1">
                        <h5 class="text-center mb-4">Étape 1: Créer un compte</h5>
                        <p class="text-center">Bienvenue dans notre application. Pour commencer, veuillez créer un compte en remplissant le formulaire ci-dessous :</p>
                       
                            <div class="form-group">
                                <input type="text" class="form-control" name="nom" placeholder="Nom">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="passe" placeholder="Mot de passe">
                            </div>
                            <button type="button" class="btn btn-primary btn-block" onclick="nextStep()">Suivant</button>
                       
                    </div>
                    <!-- Step 2 -->
                    <div class="step-content" id="step2">
                        <h5 class="text-center mb-4">Étape 2: Explorer les fonctionnalités</h5>
                        <p>Pour utiliser pleinement notre application, suivez ces étapes :</p>
                        <ol>
                            <li>Connectez-vous avec vos informations d'identification nouvellement créées.</li>
                            <li>Explorez les différentes fonctionnalités disponibles dans le tableau de bord.</li>
                            <li>Utilisez les options de menu pour naviguer entre les sections.</li>
                        </ol>
                        <p>Une fois que vous avez terminé, vous pouvez commencer à profiter de toutes les fonctionnalités que nous proposons. Bonne exploration !</p>
                        <input type="submit" class="btn btn-primary btn-block" value="Terminer">
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function nextStep() {
        document.getElementById('step1').classList.remove('active');
        document.getElementById('step2').classList.add('active');
    }

   
</script>
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
</body>
</html>
