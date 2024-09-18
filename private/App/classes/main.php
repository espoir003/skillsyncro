<?php
// Déclaration du namespace
namespace MyApp;

// Classe parente pour gérer la connexion à la base de données
class Main {
    // Propriétés pour la connexion à la base de données
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "skillsyncro"; // Nom de la base de données

    // Méthode pour établir la connexion à la base de données
    public function connect() {
        try {
            $dsn = "mysql:host=" . $this->host . ";dbname=" . $this->dbname;
            $pdo = new \PDO($dsn, $this->username, $this->password);
            $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            exit();
        }
    }
}

?>