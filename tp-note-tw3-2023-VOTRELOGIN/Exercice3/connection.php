<?php
// ============= FONCTION DE CONNEXION À LA BASE DE DONNÉES =============
// Fonction qui établit une connexion PDO à la base de données MySQL
// Paramètres: aucun (utilise les constantes de config.php)
// Retour: objet PDO ou null si erreur
function dbConnect(): ?PDO {
    // Inclure le fichier de configuration qui contient les constantes DB_HOST, DB_USER, etc.
    require_once('config.php');

    // Options de connexion PDO pour configurer le comportement
    // Tableau associatif avec les options PDO
    $options = [
        // MYSQL_ATTR_INIT_COMMAND: commande exécutée à la connexion
        // SET NAMES utf8: définir l'encodage des caractères en UTF-8
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        // ATTR_ERRMODE: mode de gestion des erreurs
        // PDO::ERRMODE_EXCEPTION: lever une exception en cas d'erreur (idéal pour le try-catch)
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ];

    // Utiliser un bloc try-catch pour gérer les erreurs de connexion
    try {
        // Construire le DSN (Data Source Name) en combinant DB_HOST et DB_NAME
        // Format: "mysql:host=localhost;dbname=blog;charset=utf8mb4"
        $dsn = DB_HOST . DB_NAME;
        // Créer une nouvelle instance PDO (connexion à la base de données)
        // Paramètres: DSN, utilisateur, mot de passe, options
        $connection = new PDO($dsn, DB_USER, DB_PASS, $options);
        // Retourner la connexion établie
        //echo "Connexion  établie ! <br> ";
        return $connection;
    } catch (PDOException $e) {
        // Si une exception PDO est levée (erreur de connexion)
        // Afficher un message d'erreur avec le détail fourni par PDO
        echo "Connexion à MySQL impossible : ", $e->getMessage();
        // Optionnellement arrêter l'exécution du script (commenté)
        //exit(); // Arrêter l'exécution du script en cas d'échec de connexion
        // Retourner null pour indiquer l'échec
        return null;
    }
}
?>
