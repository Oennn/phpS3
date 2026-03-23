<?php

declare(strict_types=1);
define('DB_SERVER', 'mysql.info.unicaen.fr');
define('DB_PORT', '3306');
define('DB_NAME', 'chabaud221_bd');
define('DB_USER', 'chabaud221');
define('DB_PASS', 'aiphie3mu6ciP9Ae');
define('DB_DSN',
    "mysql:host=" . DB_SERVER .
    ";port=" . DB_PORT .
    ";dbname=" . DB_NAME .
    ";charset=utf8mb4"

);

/*
http://localhost/phpS3/TP9_Sujet/TP9_Sujet/index.php


define('DB_DSN', 'mysql:host=localhost;port=3306;dbname=tp9_bd;charset=utf8mb4');
define('DB_USER', 'root');
define('DB_PASS', '');

//chez moi