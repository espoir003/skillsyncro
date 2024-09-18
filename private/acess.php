<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location: login");
} else {
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = "1";
  }
}
if(!isset($_SESSION['user_id'])){
    header("location: home");
}
if($_SESSION['type'] <> "Admin"){
  header("location: home");
}

// Inclusion du fichier d'autoloading des classes
include("App/classes/main.php");
include("App/classes/child.php");

// Utilisation de l'espace de noms MyApp pour la classe Agent

// Instanciation de la classe Main
$main = new MyApp\Main();

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SkillSyncro - Droit d'access</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.1.0/css/select2.min.css" rel="stylesheet">
  <style>
    /* Styles CSS pour la fenêtre modale */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
    }

    /* Style pour le contenu de la modal */
    #myModalContent {
        text-align: center;
        font-size: 18px;
        line-height: 1.6;
    }
</style>
</head>

<body>

    <!-- main start -->

      <?php include("../import/main.php"); ?>

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          <div class="container mt-5">
            <div class="row justify-content-center">
              <div class="col-md-6">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-center mb-4">Droit D'access</h4>
                    <form method="POST" action="" id="agentForm">
                      <div class="row">
                      <?php
                        // Connexion à la base de données
                        $pdo = $main->connect();

                        // Récupérer les ID des employés associés à l'utilisateur connecté depuis la table privilege
                        $admin_id = $_SESSION['user_id'];
                        $sql = "SELECT employer FROM privilege WHERE admin = :admin_id";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':admin_id', $admin_id);
                        $stmt->execute();
                        $selected_employers = $stmt->fetchAll(PDO::FETCH_COLUMN);

                        // Sélectionner tous les employés depuis la table des employés
                        $sql_employes = "SELECT * FROM agent";
                        $stmt_employes = $pdo->query($sql_employes);
                        $employes = $stmt_employes->fetchAll(PDO::FETCH_ASSOC);

                        // Générer les cases à cocher dans votre formulaire
                        $count = 0;
                        foreach ($employes as $employe) {
                            $id = 'agent_' . $employe['id_agent'];
                            $name = 'agents[]';
                            $text = $employe['nom'] . ' ' . $employe['postnom'] . ' ' . $employe['prenom'];
                            $checked = in_array($employe['id_agent'], $selected_employers) ? 'checked' : '';
                            echo "<div class=\"col-md-6\">";
                            echo "<div class=\"custom-control custom-switch\">";
                            echo "<input type=\"checkbox\" class=\"custom-control-input\" id=\"$id\" name=\"$name\" value=\"{$employe['id_agent']}\" $checked>";
                            echo "<label class=\"custom-control-label\" for=\"$id\">$text</label>";
                            echo "</div>";
                            echo "</div>";
                            $count++;
                            if ($count % 2 == 0) {
                                echo "</div><div class=\"row\">";
                            }
                        }
                        ?>

                      </div>
                      <div class="row">
                        <div class="col-md-6">
                          <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-check-circle"></i> Valider
                          </button>
                        </div>
                        <div class="col-md-6">
                          <button type="reset" class="btn btn-secondary btn-block">
                            <i class="fas fa-undo"></i> Réinitialiser
                          </button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>

     <?php include("../import/footer.php"); ?>

    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span>
        <div id="myModalContent"></div>
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
    // Récupération de la fenêtre modale
    var modal = document.getElementById("myModal");

    // Récupération du bouton de fermeture
    var span = document.getElementsByClassName("close")[0];

    // Fonction pour afficher la fenêtre modale avec un message donné
    function showModal(message) {
      var modalContent = document.getElementById("myModalContent");
      modalContent.textContent = message; // Ajouter le message au contenu de la fenêtre modale
      modal.style.display = "block"; // Afficher la fenêtre modale
    }

    // Fonction pour masquer la fenêtre modale
    function hideModal() {
      modal.style.display = "none"; // Masquer la fenêtre modale
    }

    // Fermeture de la fenêtre modale lors du clic sur le bouton de fermeture
    span.onclick = hideModal;

    // Fermeture de la fenêtre modale lors du clic en dehors de celle-ci
    window.onclick = function (event) {
      if (event.target == modal) {
        hideModal();
      }
    };

    // Fonction pour envoyer les données du formulaire avec AJAX
    function submitForm() {
      // Récupération des données du formulaire
      var formData = new FormData(document.getElementById("agentForm"));

      // Création de l'objet XMLHttpRequest
      var xhr = new XMLHttpRequest();

      // Configuration de la requête AJAX
      xhr.open("POST", "private/App/includes/access.php", true); // true pour une requête asynchrone
      xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");

      // Gestionnaire d'événement de chargement
      xhr.onload = function () {
        if (xhr.status === 200) {
          // Affichage du message de réponse dans la fenêtre modale
          showModal(xhr.responseText);
        } else {
          // Affichage d'un message d'erreur en cas d'échec de la requête
          alert('Une erreur s\'est produite lors de l\'envoi des données.');
        }
      };

      // Envoi de la requête AJAX avec les données du formulaire
      xhr.send(formData);
    }

    // Gestionnaire d'événement pour soumettre le formulaire
    document.getElementById("agentForm").addEventListener("submit", function (event) {
      event.preventDefault(); // Empêcher le comportement par défaut du formulaire
      submitForm(); // Appeler la fonction pour envoyer les données avec AJAX
    });
  </script>

</body>

</html>
