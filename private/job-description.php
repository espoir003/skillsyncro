<?php
session_start();

if (!isset($_SESSION['id'])) {
    header("location: login");
} else {
    if (!isset($_SESSION['type'])) {
        $_SESSION['type'] = "1";
    }
}


if(!isset($_SESSION['annee']) and !isset($_SESSION['employee_id'])){
    header("location: home");
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

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>JobDescription </title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <!-- Styles pour la facture -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .invoice {
            background-color: #ffffff;
            border: 1px solid #e1e1e1;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 1000px;
            margin: 0 auto;
        }

        .invoice-title {
            font-size: 24px;
            color: #333333;
            margin-bottom: 20px;
        }

        .invoice-number {
            font-size: 16px;
            color: #666666;
        }

        .invoice-address {
            margin-top: 20px;
            font-size: 14px;
            color: #666666;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 30px;
        }

        .invoice-table th,
        .invoice-table td {
            border: 1px solid #e1e1e1;
            padding: 10px;
            text-align: left;
        }

        .invoice-total {
            margin-top: 20px;
            font-size: 18px;
            color: #333333;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #666666;
            text-align: center;
        }

        .footer-signature {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }
    </style>
</head>

<body>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                       

                        <!-- Section principale de la facture avec la classe "invoice" -->
                        <div class="invoice">
                            <!-- Entête de la facture -->
                            <div class="invoice-title" style="text-align: center;font-family:cursive;">
                                Job Description pour L'année <?php echo date('Y'); ?><hr>
                            </div>

                            <div class="invoice-address">
                                <?php
                                // Préparation de la requête SQL pour récupérer les informations de l'employé
                                $sql = "SELECT nom, postnom, prenom, poste, photo
                                    FROM agent
                                    WHERE id_agent = :id_agent";

                                // Préparation de la requête SQL
                                $stmt = $pdo->prepare($sql);

                                // Liaison des paramètres
                                $stmt->bindParam(':id_agent', $_SESSION['employee_id']);

                                // Exécution de la requête
                                $stmt->execute();

                                // Récupération des résultats
                                $employe = $stmt->fetch(PDO::FETCH_ASSOC);

                                // Affichage des informations de l'employé
                                echo "<div style='font-family:cursive;'>";
                                echo "<strong>Nom:</strong> " . $employe['nom'] . " " . $employe['postnom'] . " " . $employe['prenom'] . "<br>";
                                echo "<strong>Poste:</strong> " . $employe['poste'] . "<br>";
                                echo "</div>";

                                echo "<img src='private/App/upload/" . $employe['photo'] . "' alt='Photo de l'employé' style='height:80px;width:80px;position:absolute;border-radius:10%;'>"; // Affichage de la photo de l'employé
                                ?>

                                <div class="text-right" style='font-family:cursive;'>
                                    <!-- Adresses (à droite) -->
                                    <strong>Entreprise :</strong> InterVision<br>
                                    <strong>Adresse:</strong> Avenue Equateur n°24/26 Kinshasa / Gombe<br>
                                    <strong>Email:</strong> info@intervision.cd | sales@intervision.cd<br>
                                    <strong>Téléphone:</strong> ++243 999000000
                                </div>
                            </div>
                            <hr>
                            <p style="text-align:justify;font-family:cursive;">
                              <?php
                                $annee = 2024;
                                  $sql = "SELECT mission
                                  FROM mission
                                  WHERE agent = :id_agent and annee = :annee";

                                  // Préparation de la requête SQL
                                  $stmt = $pdo->prepare($sql);

                                  // Liaison des paramètres
                                  $stmt->bindParam(':id_agent', $_SESSION['employee_id']);
                                  $stmt->bindParam(':annee',$annee);

                                  // Exécution de la requête
                                  $stmt->execute();

                                  // Récupération des résultats
                                  $employe = $stmt->fetch(PDO::FETCH_ASSOC);

                              ?>
                              <strong>Mission  </strong><?php if(empty($employe['mission'])){
                                  echo "<em style='color:red;'> Pas de mission pour cet employer pour l'année " . $_SESSION['annee'] . ' Veuillez plutôt l\'ajouter où contacter un expert si l\'erreur persiste.' . "</em>";
                              }else{
                                echo "<p style='font-family:cursive;text-align:justify;'>". $employe['mission'] . "</p>";
                              }  ?>
                            </p>
                            <table class="invoice-table">
                                <thead style='font-family:cursive;font-size:10px;'>
                                    <tr>
                                        <th>#</th>
                                        <th>Responsabilité</th>
                                        <th>Tâche</th>
                                        <?php if($_SESSION['type'] == "Admin"){ ?>
                                        <th>Pourcentage</th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody style='font-family:cursive;font-size:11px;'>
                                    <?php
                                    $Ttache = 0;
                                    $Trespo = 0;
                                    // Obtention de l'année actuelle
                                    $annee_actuelle = $_SESSION['annee'];

                                    // Préparation de la requête SQL pour récupérer les données de la table cotations
                                    $sql = "SELECT r.id_respo, r.responsabilite, r.agent, r.annee, r.mois, 
                                    t.id_tache, t.tache AS tache_name, t.pourcentage AS tache_pourcentage,
                                    r.pourcentage AS responsabilite_pourcentage
                                FROM responsabilite r
                                JOIN taches t ON t.id_respo = r.id_respo
                                WHERE r.annee = :annee
                                AND r.agent = :agent
                                GROUP BY r.id_respo, r.responsabilite, r.agent, r.annee, r.mois, t.id_tache, t.tache, t.pourcentage, r.pourcentage";
                    

                                    // Préparation de la requête SQL
                                    $stmt = $pdo->prepare($sql);

                                    // Liaison des paramètres
                                    $stmt->bindParam(':annee', $annee_actuelle);
                                    $stmt->bindParam(':agent', $_SESSION['employee_id']);

                                    // Exécution de la requête
                                    $stmt->execute();

                                    // Récupération des résultats
                                    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                    // Initialisation de la semaine actuelle
                                    $currentWeek = '';

                                    foreach ($resultats as $key => $resultat) {
                                        // Vérification si la semaine a changé
                                        if ($resultat['id_respo'] != $currentWeek) {
                                            $id = $resultat['id_respo'];
                                            // Si oui, affichage de la ligne fusionnée pour la nouvelle semaine
                                            echo "<tr style='background-color: #f2f2f2;'>";
                                            echo "<td colspan='2' style='text-align:center;'>" . $resultat['responsabilite'] . "</td>";
                                            echo "<td style='background-color:teal;color:white;'>" . $resultat['responsabilite_pourcentage'] . " %" . "</td>"; // Affichage du pourcentage de la responsabilité dans la colonne pourcentage
                                           if($_SESSION['type'] == "Admin"){
                                            echo "<td>
                                            <span style='display:inline;'>
                                                <a href='responsability/$id' class='btn btn-success update-task' update-task-id='" . $resultat['id_respo'] . "' style='color:white;'><i class='fas fa-edit'></i></a>
                                    
                                                <a href='delete/?v=" . $resultat['id_respo'] . "' class='btn btn-danger supprime' onclick=\"if (!confirm('Êtes-vous sûr de vouloir supprimer cette responsabilité  ? si oui sachez toutes ces tâches serons supprimée definitivement.')) { return false; }\">X</a>
                                            </span>
                                          </td>";
                                    
                                            } // Ajout d'une cellule vide pour l'icône de suppression
                                            echo "</tr>";
                                            // Mise à jour de la semaine actuelle
                                            $currentWeek = $resultat['id_respo'];
                                    
                                            // Réinitialisation de la somme des pourcentages
                                            $totalTachePourcentage = 0;
                                            $Trespo = $Trespo + $resultat['responsabilite_pourcentage'];
                                        }
                                        
                                        // Ajout du pourcentage de la tâche au total
                                        $totalTachePourcentage += $resultat['tache_pourcentage'];
                                        
                                        echo "<tr data-task-id='" . $resultat['id_tache'] . "'>"; // Ajout de l'attribut data-task-id
                                        echo "<td>" . $resultat['id_tache']  . "</td>";
                                        if($_SESSION['type'] == "Admin"){
                                        echo "<td class='editable-cell' contenteditable='true' data-column='tache'>" . $resultat['tache_name'] . "</td>"; // Utilisation de tache_name pour afficher le nom de la tâche
                                        echo "<td class='editable-cell' contenteditable='true' data-column='pourcentage'>" . $resultat['tache_pourcentage'] . "</td>"; // Affichage du pourcentage de la tâche
                                        }else{
                                            echo "<td class='editable-cell' data-column='tache'>" . $resultat['tache_name'] . "</td>"; // Utilisation de tache_name pour afficher le nom de la tâche
                                            echo "<td class='editable-cell' data-column='pourcentage'>" . $resultat['tache_pourcentage'] . "</td>"; // Affichage du pourcentage de la tâche
                                        } 
                                        if($_SESSION['type'] == "Admin"){
                                        echo "<td>"; // Cellule pour l'icône de suppression
                                        echo "<button class='btn btn-danger delete-task' data-task-id='" . $resultat['id_tache'] . "'><i class='fas fa-trash'></i></button>"; // Bouton de suppression avec l'icône
                                        echo "<a href='#' class='btn btn-success reload' onclick=\"location.reload(); return false;\"><i class='fas fa-sync'></i></a>";
                                        echo "</td>";
                                        }
                                        echo "</tr>";
                                        
                                        
                                        // Affichage du total des pourcentages des tâches pour la responsabilité
                                        if ($key + 1 < count($resultats) && $resultats[$key + 1]['id_respo'] != $currentWeek) {
                                            echo "<tr>";
                                            echo "<td colspan='2'><strong>Total des tâches</strong></td>";
                                            if($totalTachePourcentage <> $resultat['responsabilite_pourcentage'] ){
                                                echo "<td id='total-tasks' colspan='2' style='text-align:centre;background-color:red;color:white;'><strong id='total-tasks'>" . $totalTachePourcentage . " %" . "</strong></td>"; // Ajout de l'identifiant "total-tasks"
                                            }else{
                                                echo "<td id='total-tasks' colspan='2' style='text-align:centre;background-color:green;color:white;'><strong id='total-tasks'>" . $totalTachePourcentage . " %" . "</strong></td>"; // Ajout de l'identifiant "total-tasks"
                                            }
                                            echo "</tr>";
                                        }
                                        
                                        // Ajoutez une condition supplémentaire pour vérifier si c'est le dernier groupe de tâches
                                        if ($key + 1 === count($resultats)) {
                                            // Si c'est le dernier groupe de tâches, affichez également le total des tâches
                                            echo "<tr>";
                                            echo "<td colspan='2'><strong>Total des tâches</strong></td>";
                                            if($totalTachePourcentage <> $resultat['responsabilite_pourcentage'] ){
                                                echo "<td id='total-tasks' colspan='2' style='text-align:centre;background-color:red;color:white;'><strong id='total-tasks'>" . $totalTachePourcentage . " %" . "</strong></td>"; // Ajout de l'identifiant "total-tasks"
                                            }else{
                                                echo "<td id='total-tasks' colspan='2' style='text-align:centre;background-color:green;color:white;'><strong id='total-tasks'>" . $totalTachePourcentage . " %" ."</strong></td>"; // Ajout de l'identifiant "total-tasks"
                                            }
                                            echo "</tr>";
                                        }

                                       
                                       
                                    }
                                    echo "<tr>";
                                    if($Trespo > 100){
                                       echo "<td colspan='2' style='background-color:red;color:white;'><strong>Attention la sommation des pourcentages des responsabilités depasse 100% veuillez de réduire.</strong></td>";
                                    }elseif($Trespo < 100){
                                        echo "<td colspan='2' style='background-color:red;color:white;'><strong>Attention la sommation des pourcentages des responsabilités est inferière à 100% veuillez revoir ou d'augmenter.</strong></td>";
                                    }else{
                                        echo "<td colspan='2'><strong>Total des responsabilites correcte</strong></td>";
                                    }
                                    if($Trespo < 100 or $Trespo > 100){
                                        echo "<td id='total-tasks' colspan='2' style='text-align:centre;background-color:red;color:white;'><strong id='total-tasks'>" . $Trespo . " %" . "</strong></td>"; // Ajout de l'identifiant "total-tasks"
                                    }else{
                                        echo "<td id='total-tasks' colspan='2' style='text-align:centre;background-color:green;color:white;'><strong id='total-tasks'>" . $Trespo . " %" . "</strong></td>"; // Ajout de l'identifiant "total-tasks"
                                    }
                                     echo "</tr>";
                                    
                                    
                                    ?>
                                </tbody>
                            </table>

                            <div class="footer">
                                <div class="footer-signature" style='font-family:cursive;font-size:10px;'>
                                    <div>
                                        Signature Employé
                                    </div>
                                    <div>
                                        Signature DG
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!-- Bouton d'impression -->
                        <div class="text-right mb-3">
                            <button id="printButton" onclick="window.print()" class="btn btn-warning btn-icon icon-left"><i class="fas fa-print"></i> Imprimer</button>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="errorModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p id="errorMessage"></p>
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

    <script>
<?php if($_SESSION['type'] == "Admin"){ ?>
const editableCells = document.querySelectorAll(".editable-cell");

// Ajoutez un gestionnaire d'événements pour chaque cellule éditable
editableCells.forEach(cell => {
    cell.addEventListener("blur", function() {
        const taskId = cell.parentElement.dataset.taskId; // Récupérez l'identifiant de la tâche
        const column = cell.dataset.column; // Colonne modifiée (par exemple, "tache" ou "pourcentage")
        const newValue = cell.innerText.trim(); // Nouvelle valeur de la cellule

        // Création de l'objet XMLHttpRequest
        const xhr = new XMLHttpRequest();

        // Configuration de la requête
        xhr.open("POST", "private/update_task.php", true);
        xhr.setRequestHeader("Content-Type", "application/json");

        // Gestionnaire d'événement de la réponse
        // Gestionnaire d'événement pour la réponse de la requête AJAX
        xhr.onload = function() {
            if (xhr.status >= 200 && xhr.status < 300) {
                // Succès de la requête
                const response = JSON.parse(xhr.responseText);
                if (!response.success) {
                    // Affichage d'une alerte si la mise à jour a échoué
                    alert(response.message);
                } else {
                    // Mise à jour réussie, éventuellement effectuer d'autres actions
                }
            } else {
                // Erreur lors de la requête
                console.error("Erreur lors de la requête AJAX :", xhr.statusText);
            }
        };


        // Gestionnaire d'événement en cas d'erreur réseau
        xhr.onerror = function() {
            console.error("Erreur lors de la requête AJAX1 : Réseau indisponible");
        };

        // Envoi des données JSON
        xhr.send(JSON.stringify({ taskId, column, newValue }));
    });
});








// Sélectionner tous les boutons de suppression
const deleteTaskButtons = document.querySelectorAll(".delete-task");

// Ajouter un gestionnaire d'événements pour chaque bouton de suppression
deleteTaskButtons.forEach(button => {
    button.addEventListener("click", function() {
        const taskId = button.dataset.taskId; // Récupérer l'identifiant de la tâche à supprimer

        // Confirmer avec l'utilisateur s'il veut vraiment supprimer la tâche
        const confirmation = confirm("Êtes-vous sûr de vouloir supprimer cette tâche ?");
        if (confirmation) {
            // Création de l'objet XMLHttpRequest
            const xhr = new XMLHttpRequest();

            // Configuration de la requête
            xhr.open("POST", "private/delete_task.php", true); // Assurez-vous de créer ce fichier
            xhr.setRequestHeader("Content-Type", "application/json");

            // Gestionnaire d'événement de la réponse
            xhr.onload = function() {
                if (xhr.status >= 200 && xhr.status < 300) {
                    // Succès de la requête
                    const response = JSON.parse(xhr.responseText);
                    if (!response.success) {
                        // Affichage d'une alerte si la suppression a échoué
                        alert(response.message);
                    } else {
                        // Suppression réussie, éventuellement actualiser la page ou effectuer d'autres actions
                        location.reload(); // Recharger la page après la suppression
                    }
                } else {
                    // Erreur lors de la requête
                    console.error("Erreur lors de la requête AJAX :", xhr.statusText);
                }
            };

            // Gestionnaire d'événement en cas d'erreur réseau
            xhr.onerror = function() {
                console.error("Erreur lors de la requête AJAX : Réseau indisponible");
            };

            // Envoi des données JSON
            xhr.send(JSON.stringify({ taskId }));
        }
    });
});






       

        // Confirmer avec l'utilisateur s'il veut vraiment supprimer les responsabilites
            // Sélection du lien
            var lien = document.querySelectorAll('a.delete');

            // Ajout d'un gestionnaire d'événements pour le clic sur le lien
            lien.forEach(function(element) {
            element.addEventListener('click', function(event) {
                // Empêcher le comportement par défaut du lien
                event.preventDefault();

                // Récupérer l'URL du lien
                var href = this.getAttribute('href');

                // Extraire l'ID de l'employé de l'URL
                var supprime = href.split('/')[1];

                // Envoyer une requête AJAX pour stocker l'ID de l'employé dans une variable de session
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'private/App/includes/supprimer-respo.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Traitement de la réponse si nécessaire
                    // Par exemple, vous pouvez rediriger l'utilisateur vers la page de sélection d'année ici
                    window.location.href = 'delete--'; // Remplacez 'selectioner-une-annee' par le chemin de votre page de sélection d'année
                }
                };
                xhr.send('delete=' + supprime);
            });
            });
        
 




    </script>

<script>
    
    // Sélection du lien pour modifier respo
    var lien = document.querySelectorAll('a.update-task');

    // Ajout d'un gestionnaire d'événements pour le clic sur le lien
    lien.forEach(function(element) {
      element.addEventListener('click', function(event) {
        // Empêcher le comportement par défaut du lien
        event.preventDefault();

        // Récupérer l'URL du lien
        var href = this.getAttribute('href');

        // Extraire l'ID de l'employé de l'URL
        var respo = href.split('/')[1];

        // Envoyer une requête AJAX pour stocker l'ID de l'employé dans une variable de session
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'private/App/includes/respo.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
            // Traitement de la réponse si nécessaire
            // Par exemple, vous pouvez rediriger l'utilisateur vers la page de sélection d'année ici
            window.location.href = 'responsability'; // Remplacez 'selectioner-une-annee' par le chemin de votre page de sélection d'année
          }
        };
        xhr.send('respo=' + respo);
      });
    });
<?php } ?>
  </script>

</body>

</html>
