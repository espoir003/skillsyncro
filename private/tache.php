
<?php
session_start();

if(!isset($_SESSION['id'])){
  header("location: login");
}else{
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = "1";
  }
}
// Inclusion du fichier d'autoloading des classes
include("App/classes/main.php");
include("App/classes/child.php");

if(!isset($_SESSION['employee_id'])){
    header('location: home');
}

// Instanciation de la classe Main
$main = new MyApp\Main();
$agent = $_SESSION['employee_id'];
// Appel de la méthode connect
$pdo = $main->connect();
$sql = "SELECT * FROM responsabilite where agent =$agent ";
$stmt = $pdo->query($sql);
$employes = $stmt->fetchAll(PDO::FETCH_ASSOC);

   // Préparation de la requête SQL pour récupérer les informations de l'employé
$sqlite = "SELECT nom, prenom FROM agent
   WHERE id_agent = :agent";

// Préparation de la requête SQL
$stmtt = $pdo->prepare($sqlite);

// Liaison des paramètres
$stmtt->bindParam(':agent', $_SESSION['employee_id']);

// Exécution de la requête
$stmtt->execute();

// Récupération des résultats
$employer = $stmtt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SkillSyncro - Enregistrement des tâches</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="assets/css/app.min.css">
  <!-- Template CSS -->
  <link rel="stylesheet" href="assets/css/style.css">
  <link rel="stylesheet" href="assets/css/components.css">
  <!-- Custom style CSS -->
  <link rel="stylesheet" href="assets/css/custom.css">
  <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
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
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title text-center mb-4">Tâches pour chaque résponsabilité de <?php echo $employer['nom'] ?> - <?php echo $employer['prenom'] ?></h4>
                    <form method="POST" action="" id="agentForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user-tag"></i></span>
                                    </div>
                                    <select class="form-control" id="responsabilite" name="id_respo">
                                        <option value="">Selectionner la résponsabilité</option>
                                       
                                        <?php
                                        // Boucle à travers les employés et crée une option pour chacun
                                        foreach ($employes as $employe) {
                                            // Construit la valeur de l'option en utilisant l'ID de l'employé
                                            $value = $employe['id_respo'];
                                            // Construit le texte de l'option en utilisant le nom, le postnom et le prénom de l'employé
                                            $text = $employe['responsabilite'] . ' | ' . $employe['annee']  . ' ['. $employe['pourcentage'] . '%]';
                                            // Affiche l'option
                                            echo "<option value=\"$value\">$text</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-percentage"></i></span>
                                    </div>
                                    <input type="number" min="1" max="100" class="form-control" id="pourcentage" name="pourcentage" placeholder="Pourcentage">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-tasks"></i></span>
                                </div>
                                <textarea class="form-control" id="tache" name="tache" placeholder="Tâche pour cette résponsabilité"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Enregistré</button>
                        <button type="reset" class="btn btn-primary btn-block">Réinitialiser</button>
                    </form>
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
    xhr.open("POST", "private/App/includes/tache.php", true); // true pour une requête asynchrone
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