<?php
class Connexion extends CI_Model {
    function getConnection() {
        // Informations de connexion à la base de données
        $host = 'localhost'; // Adresse du serveur PostgreSQL
        $port = '5432';      // Port de connexion
        $dbname = 'systemecommercial'; // Nom de la base de données
        $user = 'postgres'; // Nom d'utilisateur PostgreSQL
        $password = 'postgres'; // Mot de passe PostgreSQL
    
        try {
            // Création d'une connexion à la base de données avec PDO
            $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$password";
            $pdo = new PDO($dsn);
    
            // Configuration supplémentaire pour afficher les erreurs PDO
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            return $pdo;
    
        } catch (PDOException $e) {
            // En cas d'erreur de connexion, affichez l'erreur et retournez null
            echo 'Erreur de connexion à la base de données : ' . $e->getMessage();
            return null;
        }
    }


    public function avoirTableConditionnee($NomTable){
        $pdo = $this->getConnection();
        $query = "SELECT * FROM ".$NomTable;
        // echo $query;
        $result = $pdo->query($query);
        $resultats = array();
        $a=0;

        // Parcourir les résultats
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Traitement des données...
            $resultats[$a] = $row;
            // var_dump($resultats);
            $a++;
        }

        return $resultats;
    }

    public function insertion($NomTable, $values){ // Metre values comme => '(data1, data2, 'data3')' par exemple
        $pdo = $this->getConnection();
        $sql = sprintf('insert into %s values%s',$NomTable, $values);
        // echo $sql;
        $pdo->query($sql);
    }
}
?>
