<?php
// Configuration de la base de données
// À adapter selon votre serveur MySQL local

// Pour XAMPP local :
define('DB_HOST', 'mysql:host=localhost;');
define('DB_NAME', 'dbname=tp10_bd;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_DSN', 'mysql:host=localhost;port=3306;dbname=tp10_bd;charset=utf8mb4');

// Pour un serveur distant :
// define('DB_HOST', 'mysql:host=mysql.info.unicaen.fr;port=3306;');
// define('DB_NAME', 'dbname=chahir_bd;charset=utf8mb4');
// define('DB_USER', 'chahir');
// define('DB_PASS', 'votreMotDePasse');
?>

