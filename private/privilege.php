<?php
session_start();
if(!isset($_SESSION['id'])){
  header("location: login");
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
  <title>Privilege</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/bundles/datatables/datatables.min.css">
  <link rel="stylesheet" href="assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
  <?php include("../import/main.php"); ?>
  <!-- Main Content -->
  <div class="main-content">
    <section class="section">
      <div class="section-body">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- <div class="card-header">
                <h4>Export Table</h4>
              </div> -->
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-striped table-hover" id="tableExport" style="width:100%;">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Type</th>
                        <th>Privilege</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                    // Connexion à la base de données
                    try {
                        $pdo = new PDO('mysql:host=localhost;dbname=skillsyncro', 'root', '');
                        // Définir le mode d'erreur PDO à exception
                        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                        // Requête pour sélectionner les utilisateurs
                        $query = "SELECT * FROM user";
                        $stmt = $pdo->prepare($query);
                        $stmt->execute();

                        // Vérifier s'il y a des utilisateurs trouvés
                        if ($stmt->rowCount() > 0) {
                            // Afficher les utilisateurs dans le tableau
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo "<tr>";
                                echo "<td>" . htmlspecialchars($row['is_user']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['email']) . "</td>";
                                echo "<td>" . htmlspecialchars($row['type']) . "</td>";
                                echo "<td>";
                                // Vérifiez le type d'utilisateur pour décider du lien
                                if($row['type'] == "Admin") {
                                    echo "<a href=\"#\"><i class=\"fas fa-cogs\"></i> Droit d'accès</a>";
                                } else {
                                    echo "<a href=\"droit-access/{$row['is_user']}\" class=\"btn btn-primary user\"><i class=\"fas fa-cogs\"></i> Droit d'accès</a>";

                                }
                                echo "</td>";
                                echo "<td><a href=\"#\" class=\"btn-delete\"><i class=\"fas fa-trash\"></i> Supprimer</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            // Si aucun utilisateur n'est trouvé
                            echo "<tr><td colspan='6'>Aucun utilisateur trouvé</td></tr>";
                        }
                    } catch (PDOException $e) {
                        // En cas d'erreur de connexion à la base de données
                        echo "Erreur de connexion à la base de données : " . $e->getMessage();
                    }
                    ?>


                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php
    include("../import/footer.php");
    ?>
  </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/dataTables.buttons.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.flash.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/jszip.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/pdfmake.min.js"></script>
  <script src="assets/bundles/datatables/export-tables/vfs_fonts.js"></script>
  <script src="assets/bundles/datatables/export-tables/buttons.print.min.js"></script>
  <script src="assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script>
    // Sélection du lien
    var lien = document.querySelectorAll('a.user');

    // Ajout d'un gestionnaire d'événements pour le clic sur le lien
    lien.forEach(function(element) {
      element.addEventListener('click', function(event) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();

        // Récupérer l'URL du lien
        var href = this.getAttribute('href');

        // Extraire l'ID de l'employé de l'URL
        var user_id = href.split('/')[1];

        // Envoyer une requête AJAX pour stocker l'ID de l'employé dans une variable de session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'private/App/includes/url-droit.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse si nécessaire
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page de sélection d'année ici
            window.location.href = 'droit-access'; // Remplacez 'selectioner-une-annee' par le chemin de votre page de sélection d'année
          }
        };
        xhr.send('user_id=' + user_id);
      });
    });
  </script>
</body>

</html>
