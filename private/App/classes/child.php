<?php

// Déclaration du namespace
namespace MyApp;

// Classe enfant pour gérer les agents
class Config extends Main {
  
    public function insertAgent()
    {
        // Vérification si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérification si les champs requis sont vides
            if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['poste']) || empty($_POST['password']) || empty($_POST['id'])) {
                echo "Tous les champs sont requis.";
                return; // Arrêter l'exécution de la fonction ici
            }else{
                // Récupération des données du formulaire
            $nom = htmlspecialchars($_POST['nom']);
            $postnom = htmlspecialchars($_POST['postnom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $poste = htmlspecialchars($_POST['poste']);
            $password = htmlspecialchars($_POST['password']);
            $id = htmlspecialchars($_POST['id']);

            // Vérification et traitement de l'upload de la photo
            $photo = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $nomFichier = $_FILES['photo']['name'];
                $extension = pathinfo($nomFichier, PATHINFO_EXTENSION);
                $nouveauNomFichier = uniqid() . '.' . $extension;
                $cheminDestination = '../upload/' . $nouveauNomFichier;
                move_uploaded_file($_FILES['photo']['tmp_name'], $cheminDestination);
                $photo = $nouveauNomFichier;
            }

            // Insertion de l'agent dans la base de données
            $pdo = Main::connect();
            $sql = "INSERT INTO agent (nom, postnom, prenom, poste, photo, password, id) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$nom, $postnom, $prenom, $poste, $photo, $password, $id]);

            if ($result) {
                echo "Employer inséré avec succès !"; // Retourner le message de succès
            } else {
                echo "Une erreur s'est produite lors de l'insertion de l'agent."; // Retourner le message d'erreur
            }
            }

            
        }
    }
    public function modifierAgent($id)
    {
        // Vérification si le formulaire a été soumis
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Vérification si les champs requis sont vides
            if (empty($_POST['nom']) || empty($_POST['prenom']) || empty($_POST['poste'])) {
                echo "Tous les champs sont requis.";
                return; // Arrêter l'exécution de la fonction ici
            }else{
                // Récupération des données du formulaire
            $nom = htmlspecialchars($_POST['nom']);
            $postnom = htmlspecialchars($_POST['postnom']);
            $prenom = htmlspecialchars($_POST['prenom']);
            $poste = htmlspecialchars($_POST['poste']);

            // Vérification et traitement de l'upload de la photo
            $photo = null;
            if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
                $nomFichier = $_FILES['photo']['name'];
                $extension = pathinfo($nomFichier, PATHINFO_EXTENSION);
                $nouveauNomFichier = uniqid() . '.' . $extension;
                $cheminDestination = '../upload/' . $nouveauNomFichier;
                move_uploaded_file($_FILES['photo']['tmp_name'], $cheminDestination);
                $photo = $nouveauNomFichier;
            }
            // Insertion de l'agent dans la base de données
            $pdo = Main::connect();
            $sql = "UPDATE agent set nom = ?, postnom = ?, prenom = ?, poste = ?, photo = ? where id_agent = ?";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$nom, $postnom, $prenom, $poste, $photo, $id]);

            if ($result) {
                echo "Employer modifier avec succès !"; // Retourner le message de succès
            } else {
                echo "Une erreur s'est produite lors de modification de l'employer."; // Retourner le message d'erreur
            }
            }

            
        }
    }
    public function supprimerAgent($id)
    {
        
            // Vérification si les champs requis sont vides
            if (empty($id)) {
                echo "<script> alert('Une erreur s'est produite lors de modification de l'employer.'); </script>"; // Retourner le message d'erreur
                echo "<script>document.location = '../../home',</script>";
            
            }else{
            // Insertion de l'agent dans la base de données
            $pdo = Main::connect();
            $sql = "DELETE from agent where id_agent = ?";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$id]);

            if ($result) {
                echo "<script> alert('Employer supprimer avec succès !'); </script>"; // Retourner le message de succès
                header("location: home");
            } else {
                echo "<script> alert('Une erreur s'est produite lors de modification de l'employer.'); </script>"; // Retourner le message d'erreur
                echo "<script>document.location = '../../home',</script>";
            }
            }

            
          }
    public function supprimerRespo($id)
    {
        
            // Vérification si les champs requis sont vides
            if (empty($id)) {
                echo "<script> alert('Une erreur s'est produite lors de la suppression.'); </script>"; // Retourner le message d'erreur
                echo "<script>document.location = '../home',</script>";
            
            }else{
            // Insertion de l'agent dans la base de données
            $pdo = Main::connect();
            $sql = "DELETE from responsabilite where id_respo = ?";
            $stmt = $pdo->prepare($sql);
            $result = $stmt->execute([$id]);

            if ($result) {
                echo "<script> alert('Responsabilité supprimer avec succès !'); </script>"; // Retourner le message de succès
                header("location: ../affichage-jd");
            } else {
                echo "<script> alert('Une erreur s'est produite lors de la suppression 2.'); </script>"; // Retourner le message d'erreur
                echo "<script>document.location = '../home',</script>";
            }
            }

            
          }


    /**
     * Ajout des missions
     */
    public function insertMission()
    {
        try {
            // Vérification si la méthode de requête est POST
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                echo "La méthode de requête n'est pas valide pour ajouter une mission.";
                return;
            }
    
            // Récupération des données du formulaire
            $agent = htmlspecialchars($_POST['agent']);
            $annee = htmlspecialchars($_POST['annee']);
            $mission = htmlspecialchars($_POST['mission']);
    
            // Vérification si les valeurs sont vides
            if (empty($agent) || empty($annee) || empty($mission)) {
                echo "Tous les champs sont requis pour ajouter une mission.";
                return;
            }
    
            // Vérifier si l'agent a déjà une mission pour l'année saisie
            $pdo = $this->connect();
            $sql = "SELECT COUNT(*) AS count FROM mission WHERE agent = :agent AND annee = :annee";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':agent', $agent);
            $stmt->bindParam(':annee', $annee);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            if ($row['count'] > 0) {
                echo "L'employé a déjà une mission pour l'année $annee.";
                return;
            }
    
            // Préparation de la requête SQL avec des paramètres nommés
            $sql = "INSERT INTO mission (agent, annee, mission) VALUES (:agent, :annee, :mission)";
            $stmt = $pdo->prepare($sql);
    
            // Liaison des valeurs avec les paramètres de la requête
            $stmt->bindParam(':agent', $agent);
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':mission', $mission);
    
            // Exécution de la requête
            $result = $stmt->execute();
    
            // Vérification du résultat de l'exécution
            if ($result) {
                echo "Mission ajoutée avec succès !";
            } else {
                echo "Une erreur s'est produite lors de l'ajout de la mission.";
            }
    
        } catch (\PDOException $e) {
            echo "Erreur lors de l'ajout de la mission : " . $e->getMessage();
        }
    }
    
    
    /**
     * Responsablité
     */
    public function insertResponsabilite()
    {
        try {
            // Vérification si la méthode de requête est POST
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                echo "La méthode de requête n'est pas valide pour ajouter une responsabilité.";
                return;
            }
    
            // Récupération des données du formulaire
            $responsabilite = htmlspecialchars($_POST['responsabilite']);
            $pourcentage = htmlspecialchars($_POST['pourcentage']);
            $agent = htmlspecialchars($_POST['agent']);
            $annee = htmlspecialchars($_POST['annee']);
            $mois = htmlspecialchars($_POST['mois']);
    
            // Vérification si les valeurs sont vides
            if (empty($responsabilite) || empty($pourcentage) || empty($agent) || empty($annee) || empty($mois)) {
                echo "Tous les champs sont requis pour ajouter une responsabilité.";
                return;
            }
    
            // Calcul du trimestre en fonction du mois
            $trimestres = [
                1 => ['Janvier', 'Fevrier', 'Mars'],
                2 => ['Avril', 'Mai', 'Juin'],
                3 => ['Juillet', 'Aout', 'Septembre'],
                4 => ['Octobre', 'Novembre', 'Decembre']
            ];
    
            $trimestre = null;
            foreach ($trimestres as $key => $value) {
                if (in_array($mois, $value)) {
                    $trimestre = $key;
                    break;
                }
            }
    
            // Vérification si le mois appartient à un trimestre
            if ($trimestre === null) {
                echo "Mois invalide pour le trimestre.";
                return;
            }
    
            // Vérification si les mois du trimestre sont valides
            $moisTrimestre = $trimestres[$trimestre];
            if (!isset($moisTrimestre) || !is_array($moisTrimestre) || !in_array($mois, $moisTrimestre)) {
                echo "Mois invalide pour le trimestre.";
                return;
            }
    
            // Préparation de la requête SQL avec des paramètres nommés
            $pdo = $this->connect();
            $sql = "SELECT SUM(pourcentage) AS total_pourcentage FROM responsabilite WHERE agent = :agent AND annee = :annee AND mois IN (:mois1, :mois2, :mois3)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':agent', $agent);
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':mois1', $moisTrimestre[0]);
            $stmt->bindParam(':mois2', $moisTrimestre[1]);
            $stmt->bindParam(':mois3', $moisTrimestre[2]);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    
            $total_pourcentage = $row['total_pourcentage'] + $pourcentage;
    
            // Vérification si le pourcentage total dépasse 100%
            if ($total_pourcentage > 100) {
                echo "Le total du pourcentage pour ce trimestre dépasse 100%, Veuillez réduire !";
                return;
            }
            /////////------------- Préparation de la requête SQL avec des paramètres nommés pour verifier si l'agent a une mission.---------------//////
            $pdo = $this->connect();
            $sql = "SELECT * FROM mission WHERE agent = :agent AND annee = :annee";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':agent', $agent);
            $stmt->bindParam(':annee', $annee);
            $stmt->execute();
            $row = $stmt->fetch(\PDO::FETCH_ASSOC);
            // Vérification si le pourcentage total dépasse 100%
            if (empty($row['agent'])) {
                echo "Desolée cet employer n'a pas une mission pour cette année";
                return;
            }
    
            // Préparation de la requête SQL pour l'insertion de la responsabilité
            $sql = "INSERT INTO responsabilite (responsabilite, pourcentage, agent, annee, mois) VALUES (:responsabilite, :pourcentage, :agent, :annee, :mois)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':responsabilite', $responsabilite);
            $stmt->bindParam(':pourcentage', $pourcentage);
            $stmt->bindParam(':agent', $agent);
            $stmt->bindParam(':annee', $annee);
            $stmt->bindParam(':mois', $mois);
            $result = $stmt->execute();
    
            // Vérification du résultat de l'exécution
            if ($result) {
                echo "Responsabilité ajoutée avec succès !";
            } else {
                echo "Une erreur s'est produite lors de l'ajout de la responsabilité.";
            }
        } catch (\PDOException $e) {
            echo "Erreur lors de l'ajout de la responsabilité : " . $e->getMessage();
        }
    }


    /**
     * Pour les tâches
     */

     public function insertTache()
     {
         try {
             // Vérification si la méthode de requête est POST
             if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                 echo "La méthode de requête n'est pas valide pour ajouter une tâche.";
                 return;
             }
     
             // Récupération des données du formulaire
             $tache = htmlspecialchars($_POST['tache']);
             $id_respo = htmlspecialchars($_POST['id_respo']);
             $pourcentage = htmlspecialchars($_POST['pourcentage']);
     
             // Vérification si les valeurs sont vides
             if (empty($tache) || empty($id_respo)) {
                 echo "Tous les champs sont requis pour ajouter une tâche.";
                 return;
             }
     
             // Connexion à la base de données
             $pdo = $this->connect();
     
             // Récupération du pourcentage maximum autorisé pour la responsabilité
             $sql_respo = "SELECT pourcentage FROM responsabilite WHERE id_respo = :id_respo";
             $stmt_respo = $pdo->prepare($sql_respo);
             $stmt_respo->bindParam(':id_respo', $id_respo);
             $stmt_respo->execute();
             $respo_row = $stmt_respo->fetch(\PDO::FETCH_ASSOC);
     
             $pourcentage_max_respo = $respo_row['pourcentage'];
     
             // Calcul du total des pourcentages des tâches existantes pour cette responsabilité
             $sql_total_pourcentage = "SELECT SUM(pourcentage) AS total_pourcentage FROM taches WHERE id_respo = :id_respo";
             $stmt_total_pourcentage = $pdo->prepare($sql_total_pourcentage);
             $stmt_total_pourcentage->bindParam(':id_respo', $id_respo);
             $stmt_total_pourcentage->execute();
             $total_pourcentage_row = $stmt_total_pourcentage->fetch(\PDO::FETCH_ASSOC);
     
             $total_pourcentage = $total_pourcentage_row['total_pourcentage'];
     
             // Calcul du nouveau pourcentage total avec la tâche actuelle
             $nouveau_total_pourcentage = $total_pourcentage + $pourcentage;
     
             // Vérification si le nouveau total dépasse le pourcentage maximum autorisé
             if ($nouveau_total_pourcentage > $pourcentage_max_respo) {
                 echo "En tenant compte des pourcentages précédents sur la tâche pour cette responsabilité, celle-ci dépasse le pourcentage de responsabilité autorisé.";
                 return;
             }
     
             // Préparation de la requête SQL pour insérer la tâche
             $sql_insert_tache = "INSERT INTO taches (tache, id_respo, pourcentage) VALUES (:tache, :id_respo, :pourcentage)";
             $stmt_insert_tache = $pdo->prepare($sql_insert_tache);
             $stmt_insert_tache->bindParam(':tache', $tache);
             $stmt_insert_tache->bindParam(':id_respo', $id_respo);
             $stmt_insert_tache->bindParam(':pourcentage', $pourcentage);
     
             // Exécution de la requête d'insertion de la tâche
             $result_insert_tache = $stmt_insert_tache->execute();
     
             // Vérification du résultat de l'exécution
             if ($result_insert_tache) {
                 echo "Tâche ajoutée avec succès !";
             } else {
                 echo "Une erreur s'est produite lors de l'ajout de la tâche.";
             }
     
         } catch (\PDOException $e) {
             echo "Erreur lors de l'ajout de la tâche : " . $e->getMessage();
         }
     }
     
/***add user */
public function createUser()
{
    try {
        // Vérification si la méthode de requête est POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            echo "La méthode de requête n'est pas valide pour créer un utilisateur.";
            return;
        }

        // Récupération des données du formulaire
        $email = htmlspecialchars($_POST['email']);
        $nom = htmlspecialchars($_POST['nom']);
        $password = htmlspecialchars($_POST['password']);

        // Vérification si les valeurs sont vides
        if (empty($email) || empty($nom) || empty($password)) {
            echo "Tous les champs sont requis pour créer un utilisateur.";
            return;
        }

        // Vérification de l'unicité de l'email
        $pdo = $this->connect();
        $sql = "SELECT COUNT(*) AS count FROM user WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($row['count'] > 0) {
            echo "Un utilisateur avec cet email existe déjà.";
            return;
        }

        // Hachage du mot de passe avec MD5
        $hashedPassword = md5($password);

        // Insertion de l'utilisateur dans la base de données
        $sql = "INSERT INTO user (email, nom, password) VALUES (:email, :nom, :hashedPassword)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':password', $hashedPassword);
        $result = $stmt->execute();

        if ($result) {
            echo "Utilisateur créé avec succès !";
        } else {
            echo "Une erreur s'est produite lors de la création de l'utilisateur.";
        }

    } catch (\PDOException $e) {
        echo "Erreur lors de la création de l'utilisateur : " . $e->getMessage();
    }
}



     /**
      * connexion utilisateur
      */

      public function loginUser()
      {
          try {
              // Vérification si la méthode de requête est POST
              if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                  echo "La méthode de requête n'est pas valide pour se connecter.";
                  return;
              }
      
              // Récupération des données du formulaire
              $email = htmlspecialchars($_POST['email']);
              $password = htmlspecialchars($_POST['password']);
      
              // Vérification si les valeurs sont vides
              if (empty($email) || empty($password)) {
                  echo "Tous les champs sont requis pour se connecter.";
                  return;
              }
      
              // Recherche de l'utilisateur dans la base de données
              $pdo = $this->connect();
              $sql = "SELECT * FROM user WHERE email = :email AND password = :password";
              $stmt = $pdo->prepare($sql);
              $stmt->bindParam(':email', $email);
              $stmt->bindParam(':password', $password);
              $stmt->execute();
              $user = $stmt->fetch(\PDO::FETCH_ASSOC);
      
              // Vérification si l'utilisateur existe et si le mot de passe est correct
              if ($user) {
                  // Démarre la session et stocke l'ID de l'utilisateur
                  session_start();
                  $_SESSION['user_id'] = $user['id'];
      
                  // Redirection vers la page d'accueil
                  header("Location: home");
                  exit;
              } else {
                  echo "Identifiants incorrects. Veuillez réessayer.";
              }
      
          } catch (\PDOException $e) {
              echo "Erreur lors de la connexion : " . $e->getMessage();
          }
      }
      

      /**
       * Côtations
       */

       public function insertCotation()
{
    try {
        // Vérification si la méthode de requête est POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            echo "La méthode de requête n'est pas valide pour ajouter une cotation.";
            return;
        }

        // Vérification si les variables de session existent, sinon, afficher un message d'erreur
        if (!isset($_SESSION['employee_id']) || !isset($_SESSION['mois_id']) || !isset($_SESSION['semaine_id']) || !isset($_SESSION['annee']) || !isset($_SESSION['jour_id']) || !isset($_SESSION['user'])) {
            echo "Erreur : Veuillez vous déconnecter puis vous reconnecter.";
            return;
        }

        // Récupération des données du formulaire
        $agent = $_SESSION['employee_id'];
        $mois = $_SESSION['mois_id'];
        $semaine = $_SESSION['semaine_id'];
        $annee = $_SESSION['annee'];
        $jour = $_SESSION['jour_id'];
        $user = $_SESSION['user'];
        $tache = htmlspecialchars($_POST['tache']);
        $realiser = htmlspecialchars($_POST['realiser']);
        $cotation = htmlspecialchars($_POST['cotation']);
        $commentaire = htmlspecialchars($_POST['commentaire']);
        $heure_debut = htmlspecialchars($_POST['heure_debut']);
        $heure_fin = htmlspecialchars($_POST['heure_fin']);

        // Vérification si les valeurs sont vides
        if (empty($tache) || empty($realiser) || empty($cotation) || empty($heure_debut) || empty($heure_fin)) {
            echo "Tous les champs sont requis pour ajouter une cotation.";
            return;
        }

        // Préparation de la requête SQL avec des paramètres nommés
        $pdo = $this->connect();
        $sql = "INSERT INTO cotations (agent, tache, jour, realiser, cotation, commentaire, heure_debut, heure_fin, semaine, mois, annee, user) VALUES (:agent, :tache, :jour, :realiser, :cotation, :commentaire, :heure_debut, :heure_fin, :semaine, :mois, :annee, :user)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':agent', $agent);
        $stmt->bindParam(':tache', $tache);
        $stmt->bindParam(':jour', $jour);
        $stmt->bindParam(':realiser', $realiser);
        $stmt->bindParam(':cotation', $cotation);
        $stmt->bindParam(':commentaire', $commentaire);
        $stmt->bindParam(':heure_debut', $heure_debut);
        $stmt->bindParam(':heure_fin', $heure_fin);
        $stmt->bindParam(':semaine', $semaine);
        $stmt->bindParam(':mois', $mois);
        $stmt->bindParam(':annee', $annee);
        $stmt->bindParam(':user', $user);

        // Exécution de la requête
        $result = $stmt->execute();

        // Vérification du résultat de l'exécution
        if ($result) {
            echo "Cotation ajoutée avec succès !";
        } else {
            echo "Une erreur s'est produite lors de l'ajout de la cotation.";
        }

    } catch (\PDOException $e) {
        echo "Erreur lors de l'ajout de la cotation : " . $e->getMessage();
    }
}

public $user;
public $pass;
public function login($user,$pass){
    $this->user = $user;
    $this->pass = $pass;
        $cnx = $this->connect();
        $sql = "SELECT *FROM user WHERE email=:user and password=:pass";
        $query = $cnx->prepare($sql);
        $query->bindParam(':user', $user, \PDO::PARAM_STR);
        $query->bindParam(':pass', $pass, \PDO::PARAM_STR);
        $query->execute();
        $results = $query->fetchAll(\PDO::FETCH_OBJ);
        if ($query->rowCount() > 0) {
            foreach ($results as $result) {
                $_SESSION['id'] = $result->is_user;
                $_SESSION['nom'] = $result->nom;
                $_SESSION['type'] = $result->type;
            }
            echo "<script> document.location='home';</script>";
        } else {
            echo "<script>alert('les coordonnée sont invalides');</script>";
        }
}


/**
     * création de variable d'insertion des utilisateurs
     */
    public $email;
    public $passe;
    public $nom;
    public $type;
    // création de methode d'insertion d'un utilisateur

    public function user($email,$nom,$passe,$type)
    {
        $this->email = $email;
        $this->nom = $nom;
        $this->passe = $passe;
        $this->type = $type;
        if(empty($email) || empty($nom) || empty($passe) || empty($type)){
            echo "Tous les champs sont requis pour ajouter une cotation.";
            return;
        }

        $cnx = $this->connect();
        $sql = "INSERT INTO `user`(`email`, `nom`, `password`, `type`)
         VALUES(:email,:nom,:passe,:type)";
        $query = $cnx->prepare($sql);
        $query->bindParam(':email', $email, \PDO::PARAM_STR);
        $query->bindParam(':nom', $nom, \PDO::PARAM_STR);
        $query->bindParam(':passe', $passe, \PDO::PARAM_STR);
        $query->bindParam(':type', $type, \PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $cnx->lastInsertId();
        if ($lastInsertId) {
            echo "<script>alert('Utilisateur crée avec success ✔');</script>";
            echo "<script> document.location = 'add-user'; </script>";
            
        } else {
            echo "<script>alert('Erreur veuillez ressayer s'il vous plaît ! ❌');</script>";
        
        }
    }
    
    public function privilege()
    {
        try {
            // Vérification si la méthode de requête est POST
            if ($_SERVER["REQUEST_METHOD"] !== "POST") {
                echo "La méthode de requête n'est pas valide pour ajouter une mission.";
                return;
            }
    
            // Récupération des données du formulaire
            $agents = isset($_POST['agents']) ? $_POST['agents'] : array();
            $admin_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
    
            // Connexion à la base de données
            $pdo = $this->connect();
    
            // Début de la transaction
            $pdo->beginTransaction();
    
            // Supprimer les anciennes entrées de la table des privilèges pour cet administrateur
            $delete_sql = "DELETE FROM privilege WHERE admin = :admin_id";
            $delete_stmt = $pdo->prepare($delete_sql);
            $delete_stmt->bindParam(':admin_id', $admin_id);
            $delete_stmt->execute();
    
            // Préparation de la requête SQL pour l'insertion dans la table privilege
            $insert_sql = "INSERT INTO privilege (admin, employer) VALUES (:admin_id, :employer_id)";
            $insert_stmt = $pdo->prepare($insert_sql);
    
            // Liaison des paramètres et exécution de la requête pour chaque agent sélectionné
            foreach ($agents as $employer_id) {
                $insert_stmt->bindParam(':admin_id', $admin_id);
                $insert_stmt->bindParam(':employer_id', $employer_id);
                $insert_stmt->execute();
            }
    
            // Validation de la transaction
            $pdo->commit();
    
            // Affichage du message de succès
            echo "Les privilèges ont été enregistrés avec succès !";
    
        } catch (\PDOException $e) {
            // En cas d'erreur de connexion à la base de données
            $pdo->rollBack();
            echo "Erreur lors de l'enregistrement des privilèges : " . $e->getMessage();
        }
    }
     
    public $pc;
    public function updateResponsabilite($pc)
{
    $this->pc = $pc;
    try {
        // Vérification si la méthode de requête est POST
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            echo "La méthode de requête n'est pas valide pour mettre à jour une responsabilité.";
            return;
        }

        // Récupération des données du formulaire
        $id_respo = $_SESSION['respo'];
        $responsabilite = htmlspecialchars($_POST['responsabilite']);
        $pourcentage = htmlspecialchars($_POST['pourcentage']);

        // Vérification si les valeurs sont vides
        if (empty($responsabilite) || empty($pourcentage)) {
            echo "Tous les champs sont requis pour mettre à jour une responsabilité.";
            return;
        }
        $totalResponsabilitePourcentage = $this->calculateTotalResponsabilitePourcentage($id_respo);
        // Calcul de la somme des pourcentages des tâches pour l'id_respo spécifié
        $totalTachesPourcentage = $this->calculateTotalTachesPourcentage($id_respo);

        // Vérification si la somme des pourcentages des tâches dépasse le pourcentage de la responsabilité
        $nouveauTotalTachesPourcentage = $totalTachesPourcentage;
        $nouveauTotalResponsabilitePourcentage = $totalResponsabilitePourcentage + $pourcentage;
        if ($pourcentage < $nouveauTotalTachesPourcentage) {
            echo "La somme des pourcentages des tâches dépasse le pourcentage de responsabilité. La mise à jour n'est pas autorisée.";
            return;
        }

        // Calcul de la somme des pourcentages de la responsabilité pour l'id_respo spécifié
        

        // Calcul de la somme des pourcentages de toutes les responsabilités
        $totalAllResponsabilitePourcentage = $this->calculateTotalAllResponsabilitePourcentage($id_respo);

        // Vérification si la somme des pourcentages de la responsabilité dépasse 100%
        

        if (($totalAllResponsabilitePourcentage + $pourcentage) - $pc - 10 > 100) {
            echo "La somme des pourcentages de la responsabilité dépasse 100% ou dépasse la somme de toutes les responsabilités. La mise à jour n'est pas autorisée.";
            return;
        }

        // Mise à jour de la responsabilité dans la base de données
        $pdo = $this->connect();
        $sql = "UPDATE responsabilite SET responsabilite = :responsabilite, pourcentage = :pourcentage WHERE id_respo = :id_respo";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':responsabilite', $responsabilite);
        $stmt->bindParam(':pourcentage', $pourcentage);
        $stmt->bindParam(':id_respo', $id_respo);
        $result = $stmt->execute();

        if ($result) {
            echo "Mise à jour de la responsabilité effectuée avec succès ! ";
        } else {
            echo "Une erreur s'est produite lors de la mise à jour de la responsabilité.";
        }

    } catch (\PDOException $e) {
        echo "Erreur lors de la mise à jour de la responsabilité : " . $e->getMessage();
    }
}

private function calculateTotalTachesPourcentage($id_respo)
{
    // Calcul de la somme des pourcentages des tâches pour l'id_respo spécifié
    $pdo = $this->connect();
    $sql = "SELECT SUM(pourcentage) AS total_pourcentage FROM taches WHERE id_respo = :id_respo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_respo', $id_respo);
    $stmt->execute();
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $row['total_pourcentage'] ?? 0;
}

private function calculateTotalResponsabilitePourcentage($id_respo)
{
    // Calcul de la somme des pourcentages de la responsabilité pour l'id_respo spécifié
    $pdo = $this->connect();
    $sql = "SELECT SUM(pourcentage) AS total_pourcentage FROM responsabilite WHERE id_respo = :id_respo";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_respo', $id_respo);
    $stmt->execute();
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $row['total_pourcentage'] ?? 0;
}

private function calculateTotalAllResponsabilitePourcentage($id_respo)
{
    // Calcul de la somme de tous les pourcentages de la table responsabilite, à l'exception de la responsabilité de l'utilisateur actuel
    $pdo = $this->connect();
    $sql = "SELECT SUM(pourcentage) AS total_pourcentage FROM responsabilite WHERE agent = :agent";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':agent', $_SESSION['employee_id']);
    $stmt->execute();
    $row = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $row['total_pourcentage'] ?? 0;
}




}

?>
