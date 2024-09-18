<?php

session_start();

if(!isset($_SESSION['id'])){
  header("location: login");
}else{
  if(!isset($_SESSION['type'])){
    $_SESSION['type'] = "1";
  }
}

if(!isset($_SESSION['employee_id'])){
  header("location: home");
}else{
    $date = date('Y-m-d'); // Obtient la date actuelle du système
    function jourDeLaSemaine($date) {
        // Obtient le jour de la semaine (1 pour lundi, 2 pour mardi, etc.)
        $jour_semaine = date('N', strtotime($date));
        
        // Tableau associatif pour traduire le nombre en nom du jour
        $jours = array(
            1 => 'Lundi',
            2 => 'Mardi',
            3 => 'Mercredi',
            4 => 'Jeudi',
            5 => 'Vendredi',
            6 => 'Samedi',
            7 => 'Dimanche'
        );
        
        // Retourne le nom du jour
        return $jours[$jour_semaine];
    }
    
    $jour = jourDeLaSemaine($date);
    
    
    function moisDeLAnnee($date) {
        // Obtient le numéro du mois (1 pour janvier, 2 pour février, etc.)
        $numero_mois = date('n', strtotime($date));
        
        // Tableau associatif pour traduire le numéro en nom du mois
        $mois = array(
            1 => 'Janvier',
            2 => 'Fevrier',
            3 => 'Mars',
            4 => 'Avril',
            5 => 'Mai',
            6 => 'Juin',
            7 => 'Juillet',
            8 => 'Aout',
            9 => 'Septembre',
            10 => 'Octobre',
            11 => 'Novembre',
            12 => 'Decembre'
        );
        
        // Retourne le nom du mois
        return $mois[$numero_mois];
    }
    
    $mois = moisDeLAnnee($date);
    
    function semaineDuMois($date) {
        // Obtenir le numéro de semaine dans l'année
        $semaine_annee = date('W', strtotime($date));
        
        // Obtenir le mois
        $mois = date('n', strtotime($date));
        
        // Obtenir le début de la semaine du mois
        $debut_semaine_mois = date('W', strtotime(date('Y-m-01', strtotime($date))));
        
        // Calculer la semaine du mois
        $semaine_mois = $semaine_annee - $debut_semaine_mois + 1;
        
        return 'Semaine' . $semaine_mois;
    }

    $semaine = semaineDuMois($date);
    $annee = date('Y');
    $agent = $_SESSION['employee_id'];
}

$_SESSION['mois_id'] = $mois;
$_SESSION['jour_id'] = $jour;
$_SESSION['semaine_id'] = $semaine;
$_SESSION['annee'] = $annee;

?>
<?php
// Inclusion du fichier d'autoloading des classes
include("App/classes/main.php");
include("App/classes/child.php");


// Utilisation de l'espace de noms MyApp pour la classe Agent


// Instanciation de la classe Main
$main = new MyApp\Main();

// Appel de la méthode connect
$pdo = $main->connect();




// Requête SQL pour sélectionner les tâches en fonction des critères de la table responsabilite
$sql = "SELECT t.id_tache, t.tache, t.pourcentage
        FROM taches t
        JOIN responsabilite r ON t.id_respo = r.id_respo
        WHERE r.agent = :agent";
         
        //  AND r.annee = :annee 
        //  AND r.mois = :mois

// Préparation de la requête
$stmt = $pdo->prepare($sql);

// Liaison des valeurs avec les paramètres de la requête
$stmt->bindParam(':agent', $agent);
// $stmt->bindParam(':annee', $annee);
// $stmt->bindParam(':mois', $mois);

// Exécution de la requête
$stmt->execute();

// Récupération des résultats
$taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>SkillSyncro - Cotations de l'employée</title>
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
         

          
        <div class="row clearfix">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            
            <div class="card-body">
                <form id="agentForm" method="POST" action="" >
                    <h3>Côtation journalière</h3>
                    <fieldset>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-tasks"></i></span>
                                        </div>
                                        <select class="form-control" name="tache" required>
                                            <option value="">Selectionner la Tâche</option>
                                            
                                            <?php
                                            // Boucle à travers les employés et crée une option pour chacun
                                            foreach ($taches as $tache) {
                                                // Construit la valeur de l'option en utilisant l'ID de l'employé
                                                $value = $tache['id_tache'];
                                                // Construit le texte de l'option en utilisant le nom, le postnom et le prénom de l'employé
                                                $text = $tache['tache'] . ' [' . $tache['pourcentage'] . ' %]';
                                                // Affiche l'option
                                                echo "<option value=\"$value\">$text</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-float">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-check-circle"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="realiser" placeholder="Tâche réalisée">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-check"></i></span>
                                </div>
                                <input type="number" class="form-control" name="cotation" min="1" max="10" placeholder="Côte réussi sur 10">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-comment"></i></span>
                                </div>
                                <textarea class="form-control" name="commentaire" placeholder="Commentaire"></textarea>
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                        </div>
                                        <input type="time" class="form-control" name="heure_debut" placeholder="Heure Début">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-clock"></i></span>
                                        </div>
                                        <input type="time" class="form-control" name="heure_fin" placeholder="Heure Fin">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Enregistre</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                    </fieldset>
                </form>
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
    xhr.open("POST", "private/App/includes/cotation-actuel.php", true); // true pour une requête asynchrone
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