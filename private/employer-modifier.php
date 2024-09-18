
<?php

session_start();

if(!isset($_SESSION['id'])){
  header("location: login");
}else{
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = "1";
  }
}
// Informations de connexion à la base de données
$host = "localhost";
$username = "root";
$password = "";
$dbname = "skillsyncro"; // Nom de la base de données

 try {
     // Connexion à la base de données avec PDO
     $dsn = "mysql:host=" . $host . ";dbname=" . $dbname;
     $pdo = new PDO($dsn, $username, $password);
     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
 } catch (PDOException $e) {
     // En cas d'erreur de connexion, afficher le message d'erreur
     echo "Erreur de connexion : " . $e->getMessage();
     exit(); // Arrêter l'exécution du script
 }
 if($_SESSION['type'] <> "Admin"){
    header("location: home");
  }

 if(!isset($_SESSION['modifier'])){
    header("location: home");
 }else{
    $id_agent = $_SESSION['modifier'];
 }



 // Préparation de la requête SQL pour récupérer les informations de l'employé
 $sql = "SELECT nom, postnom, prenom, poste
 FROM agent
 WHERE id_agent = :id_agent";

// Préparation de la requête SQL
$stmt = $pdo->prepare($sql);

// Liaison des paramètres
$stmt->bindParam(':id_agent', $id_agent);

// Exécution de la requête
$stmt->execute();

// Récupération des résultats
$employe = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SkillSyncro - Modification de l'employé</title>
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
                    <h4 class="card-title text-center mb-4">Modification des informations de <?= $employe['nom'] ?> - <?= $employe['prenom'] ?></h4>
                    <form method="POST" action="" enctype="multipart/form-data" id="agentForm">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="nom" value="<?= $employe['nom'] ?>" name="nom" placeholder="Nom">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="postnom" name="postnom" placeholder="Post-nom Facultatif...">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="text" class="form-control" id="prenom" value="<?= $employe['prenom'] ?>" name="prenom" placeholder="Prénom">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-venus-mars"></i></span>
                                    </div>
                                    <select class="form-control" id="sexe" name="sexe" required>
                                        <option value="">Sélectionner le sexe</option>
                                        <option value="homme">Homme</option>
                                        <option value="femme">Femme</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-briefcase"></i></span>
                                    </div>
                                    <input type="text" class="form-control" value="<?= $employe['poste'] ?>" id="poste" name="poste" placeholder="Poste">
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-camera"></i></span>
                                    </div>
                                    <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="photo" name="photo" required accept="image/*">

                                        <label class="custom-file-label" for="photo">Photo de profile</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                           
                        <button type="submit" class="btn btn-primary">Mettre a jour</button>
                        <button type="reset" class="btn btn-primary">Reinitialiser</button>
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
  <!-- Script JavaScript pour afficher la fenêtre modale -->
  <!-- Script JavaScript pour afficher la fenêtre modale -->
<!-- Script JavaScript pour afficher la fenêtre modale -->
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
    xhr.open("POST", "private/App/includes/modifier-insert.php", true); // true pour une requête asynchrone
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

<script>
    document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    });
</script>
</body>


</html>