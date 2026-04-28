<?php
/**
 * 📚 RÉFÉRENCE COMPLÈTE DES FONCTIONS PHP UTILES
 * Document de référence pour les fonctions PHP les plus courantes
 * Idéal pour apprentissage et consultation rapide
 */

// ============================================================================
// 1️⃣ FONCTIONS DE CHAÎNES DE CARACTÈRES (String Functions)
// ============================================================================

/**
 * strlen($string) - Retourne la longueur d'une chaîne
 * Retour: int (nombre de caractères)
 */
// Exemple: strlen("Hello") => 5

/**
 * strtolower($string) - Convertit en minuscules
 * Retour: string
 */
// Exemple: strtolower("HELLO") => "hello"

/**
 * strtoupper($string) - Convertit en majuscules
 * Retour: string
 */
// Exemple: strtoupper("hello") => "HELLO"

/**
 * ucfirst($string) - Première lettre en majuscule
 * Retour: string
 */
// Exemple: ucfirst("hello") => "Hello"

/**
 * ucwords($string) - Première lettre de chaque mot en majuscule
 * Retour: string
 */
// Exemple: ucwords("hello world") => "Hello World"

/**
 * trim($string, $characters) - Supprime les espaces/caractères au début et fin
 * Retour: string
 */
// Exemple: trim("  hello  ") => "hello"

/**
 * ltrim($string) - Supprime les espaces au début
 * Retour: string
 */
// Exemple: ltrim("  hello") => "hello"

/**
 * rtrim($string) - Supprime les espaces à la fin
 * Retour: string
 */
// Exemple: rtrim("hello  ") => "hello"

/**
 * substr($string, $start, $length) - Extrait une partie de chaîne
 * Retour: string
 */
// Exemple: substr("Hello World", 0, 5) => "Hello"

/**
 * strpos($haystack, $needle, $offset) - Trouve la position d'une sous-chaîne
 * Retour: int (position) ou false
 */
// Exemple: strpos("Hello World", "World") => 6

/**
 * strrpos($haystack, $needle) - Trouve la DERNIÈRE position d'une sous-chaîne
 * Retour: int ou false
 */
// Exemple: strrpos("Hello Hello", "Hello") => 6

/**
 * str_replace($search, $replace, $string) - Remplace une chaîne par une autre
 * Retour: string
 */
// Exemple: str_replace("World", "PHP", "Hello World") => "Hello PHP"

/**
 * str_repeat($input, $times) - Répète une chaîne X fois
 * Retour: string
 */
// Exemple: str_repeat("Ha", 3) => "HaHaHa"

/**
 * explode($delimiter, $string, $limit) - Divise une chaîne en tableau
 * Retour: array
 */
// Exemple: explode(",", "a,b,c") => ["a", "b", "c"]

/**
 * implode($glue, $array) - Joint les éléments d'un tableau avec une chaîne
 * Retour: string
 */
// Exemple: implode(",", ["a", "b", "c"]) => "a,b,c"

/**
 * str_split($string, $length) - Divise une chaîne en tableau de caractères
 * Retour: array
 */
// Exemple: str_split("Hello", 2) => ["He", "ll", "o"]

/**
 * strcmp($str1, $str2) - Compare deux chaînes
 * Retour: int (0=égal, <0=str1<str2, >0=str1>str2)
 */
// Exemple: strcmp("a", "b") => -1

/**
 * strrev($string) - Inverse une chaîne
 * Retour: string
 */
// Exemple: strrev("Hello") => "olleH"

/**
 * htmlspecialchars($string) - Échappe les caractères HTML spéciaux
 * Retour: string
 */
// Exemple: htmlspecialchars("<script>") => "&lt;script&gt;"

/**
 * htmlentities($string) - Convertit les caractères en entités HTML
 * Retour: string
 */
// Exemple: htmlentities("Café") => "Caf&eacute;"

/**
 * strip_tags($string, $allowed) - Supprime les balises HTML/XML
 * Retour: string
 */
// Exemple: strip_tags("<p>Hello</p>") => "Hello"

/**
 * nl2br($string) - Convertit les sauts de ligne en <br>
 * Retour: string
 */
// Exemple: nl2br("Line1\nLine2") => "Line1<br>\nLine2"

/**
 * sprintf($format, $args) - Formate une chaîne
 * Retour: string
 */
// Exemple: sprintf("Hello %s", "World") => "Hello World"

/**
 * number_format($number, $decimals, $dec_point, $thousands_sep) - Formate un nombre
 * Retour: string
 */
// Exemple: number_format(1234.5678, 2, ".", ",") => "1,234.57"

/**
 * str_pad($input, $pad_length, $pad_string, $pad_type) - Ajoute des caractères
 * Retour: string
 */
// Exemple: str_pad("5", 3, "0", STR_PAD_LEFT) => "005"

/**
 * strstr($haystack, $needle, $before_needle) - Trouve le début d'une chaîne
 * Retour: string ou false
 */
// Exemple: strstr("Hello World", "World") => "World"

/**
 * str_contains($haystack, $needle) - Vérifie si contient (PHP 8+)
 * Retour: bool
 */
// Exemple: str_contains("Hello", "ell") => true

/**
 * str_starts_with($haystack, $needle) - Vérifie le début (PHP 8+)
 * Retour: bool
 */
// Exemple: str_starts_with("Hello", "He") => true

/**
 * str_ends_with($haystack, $needle) - Vérifie la fin (PHP 8+)
 * Retour: bool
 */
// Exemple: str_ends_with("Hello", "lo") => true

// ============================================================================
// 2️⃣ FONCTIONS MATHÉMATIQUES (Math Functions)
// ============================================================================

/**
 * abs($number) - Valeur absolue
 * Retour: int/float
 */
// Exemple: abs(-5) => 5

/**
 * round($number, $precision, $mode) - Arrondit un nombre
 * Retour: float
 */
// Exemple: round(3.14159, 2) => 3.14

/**
 * ceil($number) - Arrondit vers le haut
 * Retour: float
 */
// Exemple: ceil(3.2) => 4

/**
 * floor($number) - Arrondit vers le bas
 * Retour: float
 */
// Exemple: floor(3.8) => 3

/**
 * pow($base, $exponent) - Élève à la puissance
 * Retour: int/float
 */
// Exemple: pow(2, 3) => 8

/**
 * sqrt($number) - Racine carrée
 * Retour: float
 */
// Exemple: sqrt(16) => 4

/**
 * min(...$numbers) - Retourne le minimum
 * Retour: int/float
 */
// Exemple: min(5, 2, 8) => 2

/**
 * max(...$numbers) - Retourne le maximum
 * Retour: int/float
 */
// Exemple: max(5, 2, 8) => 8

/**
 * rand($min, $max) - Nombre aléatoire
 * Retour: int
 */
// Exemple: rand(1, 100) => nombre entre 1 et 100

/**
 * mt_rand($min, $max) - Nombre aléatoire (plus rapide)
 * Retour: int
 */
// Exemple: mt_rand(1, 10) => nombre entre 1 et 10

/**
 * sin($number), cos($number), tan($number) - Fonctions trigonométriques
 * Retour: float
 */
// Exemple: sin(0) => 0

/**
 * log($number, $base) - Logarithme
 * Retour: float
 */
// Exemple: log(8, 2) => 3

// ============================================================================
// 3️⃣ FONCTIONS DE TABLEAU (Array Functions)
// ============================================================================

/**
 * count($array) ou sizeof($array) - Compte les éléments
 * Retour: int
 */
// Exemple: count([1, 2, 3]) => 3

/**
 * sizeof($array) - Alias de count()
 * Retour: int
 */
// Exemple: sizeof([1, 2, 3]) => 3

/**
 * array_push($array, $value) - Ajoute à la fin
 * Retour: int (nouvelle longueur)
 */
// Exemple: array_push($arr, 4) => ajoute 4 à la fin

/**
 * array_pop($array) - Retire le dernier élément
 * Retour: mixed (élément retiré)
 */
// Exemple: array_pop($arr) => retire et retourne le dernier

/**
 * array_shift($array) - Retire le premier élément
 * Retour: mixed (élément retiré)
 */
// Exemple: array_shift($arr) => retire et retourne le premier

/**
 * array_unshift($array, $value) - Ajoute au début
 * Retour: int (nouvelle longueur)
 */
// Exemple: array_unshift($arr, 0) => ajoute 0 au début

/**
 * array_merge($array1, $array2) - Fusionne deux tableaux
 * Retour: array
 */
// Exemple: array_merge([1], [2]) => [1, 2]

/**
 * array_combine($keys, $values) - Crée un tableau associatif
 * Retour: array
 */
// Exemple: array_combine(["a", "b"], [1, 2]) => ["a"=>1, "b"=>2]

/**
 * array_keys($array) - Retourne les clés
 * Retour: array
 */
// Exemple: array_keys(["a"=>1, "b"=>2]) => ["a", "b"]

/**
 * array_values($array) - Retourne les valeurs
 * Retour: array
 */
// Exemple: array_values(["a"=>1, "b"=>2]) => [1, 2]

/**
 * in_array($needle, $haystack, $strict) - Vérifie si valeur existe
 * Retour: bool
 */
// Exemple: in_array(2, [1, 2, 3]) => true

/**
 * array_key_exists($key, $array) - Vérifie si clé existe
 * Retour: bool
 */
// Exemple: array_key_exists("a", ["a"=>1]) => true

/**
 * array_search($needle, $haystack) - Trouve la clé d'une valeur
 * Retour: mixed (clé) ou false
 */
// Exemple: array_search(2, [1, 2, 3]) => 1

/**
 * array_slice($array, $offset, $length) - Extrait une partie
 * Retour: array
 */
// Exemple: array_slice([1, 2, 3, 4], 1, 2) => [2, 3]

/**
 * array_splice($array, $offset, $length, $replacement) - Remplace une partie
 * Retour: array (partie retirée)
 */
// Exemple: array_splice($arr, 1, 2) => retire et retourne 2 éléments à partir de 1

/**
 * array_reverse($array, $preserve_keys) - Inverse un tableau
 * Retour: array
 */
// Exemple: array_reverse([1, 2, 3]) => [3, 2, 1]

/**
 * sort($array) - Trie un tableau (ordre croissant)
 * Retour: bool
 */
// Exemple: sort($arr) => trie $arr en place

/**
 * rsort($array) - Trie en ordre décroissant
 * Retour: bool
 */
// Exemple: rsort($arr) => trie $arr inversé

/**
 * asort($array) - Trie en gardant les clés
 * Retour: bool
 */
// Exemple: asort($arr) => trie avec associations clé=>valeur

/**
 * ksort($array) - Trie par clés
 * Retour: bool
 */
// Exemple: ksort($arr) => trie par clés

/**
 * usort($array, $callback) - Trie avec fonction personnalisée
 * Retour: bool
 */
// Exemple: usort($arr, fn($a,$b)=>$a-$b) => trie avec comparateur

/**
 * array_unique($array) - Retire les doublons
 * Retour: array
 */
// Exemple: array_unique([1, 2, 2, 3]) => [1, 2, 3]

/**
 * array_filter($array, $callback) - Filtre les éléments
 * Retour: array
 */
// Exemple: array_filter([1, 2, 3], fn($x)=>$x>1) => [2, 3]

/**
 * array_map($callback, $array) - Applique une fonction à chaque élément
 * Retour: array
 */
// Exemple: array_map(fn($x)=>$x*2, [1, 2, 3]) => [2, 4, 6]

/**
 * array_reduce($array, $callback, $initial) - Réduit le tableau
 * Retour: mixed
 */
// Exemple: array_reduce([1,2,3], fn($c,$x)=>$c+$x, 0) => 6

/**
 * array_column($array, $column_key, $index_key) - Extrait une colonne
 * Retour: array
 */
// Exemple: array_column([["id"=>1,"name"=>"A"]], "name") => ["A"]

/**
 * array_flip($array) - Échange clés et valeurs
 * Retour: array
 */
// Exemple: array_flip(["a"=>1, "b"=>2]) => [1=>"a", 2=>"b"]

/**
 * array_chunk($array, $size) - Divise en sous-tableaux
 * Retour: array
 */
// Exemple: array_chunk([1,2,3,4], 2) => [[1,2], [3,4]]

/**
 * array_pad($array, $size, $value) - Complète avec une valeur
 * Retour: array
 */
// Exemple: array_pad([1, 2], 5, 0) => [1, 2, 0, 0, 0]

/**
 * implode($glue, $array) - Joint les éléments
 * Retour: string
 */
// Exemple: implode(",", [1, 2, 3]) => "1,2,3"

/**
 * explode($delimiter, $string) - Divise une chaîne
 * Retour: array
 */
// Exemple: explode(",", "1,2,3") => [1, 2, 3]

// ============================================================================
// 4️⃣ FONCTIONS DE VARIABLES (Variable Functions)
// ============================================================================

/**
 * isset($variable) - Vérifie si variable existe ET n'est pas NULL
 * Retour: bool
 */
// Exemple: isset($x) => true si $x existe et n'est pas NULL

/**
 * empty($variable) - Vérifie si variable est "vide"
 * Retour: bool
 */
// Exemple: empty($x) => true si "", 0, false, NULL, [], "0"

/**
 * is_null($variable) - Vérifie si NULL
 * Retour: bool
 */
// Exemple: is_null(NULL) => true

/**
 * is_int($variable) ou is_integer() - Vérifie si entier
 * Retour: bool
 */
// Exemple: is_int(5) => true

/**
 * is_float($variable) - Vérifie si décimal
 * Retour: bool
 */
// Exemple: is_float(5.5) => true

/**
 * is_string($variable) - Vérifie si chaîne
 * Retour: bool
 */
// Exemple: is_string("Hello") => true

/**
 * is_bool($variable) - Vérifie si booléen
 * Retour: bool
 */
// Exemple: is_bool(true) => true

/**
 * is_array($variable) - Vérifie si tableau
 * Retour: bool
 */
// Exemple: is_array([1, 2]) => true

/**
 * is_object($variable) - Vérifie si objet
 * Retour: bool
 */
// Exemple: is_object($obj) => true si objet

/**
 * is_callable($variable) - Vérifie si callable/fonction
 * Retour: bool
 */
// Exemple: is_callable('strlen') => true

/**
 * is_numeric($variable) - Vérifie si numérique
 * Retour: bool
 */
// Exemple: is_numeric("123") => true

/**
 * is_scalar($variable) - Vérifie si scalaire (int/float/string/bool)
 * Retour: bool
 */
// Exemple: is_scalar(5) => true

/**
 * gettype($variable) - Retourne le type
 * Retour: string
 */
// Exemple: gettype(5) => "integer"

/**
 * intval($variable, $base) - Convertit en entier
 * Retour: int
 */
// Exemple: intval("123") => 123

/**
 * floatval($variable) - Convertit en décimal
 * Retour: float
 */
// Exemple: floatval("123.45") => 123.45

/**
 * strval($variable) - Convertit en chaîne
 * Retour: string
 */
// Exemple: strval(123) => "123"

/**
 * boolval($variable) - Convertit en booléen
 * Retour: bool
 */
// Exemple: boolval(1) => true

/**
 * var_dump($variable) - Affiche le type et la valeur (détaillé)
 * Retour: null
 */
// Exemple: var_dump(123) => int(123)

/**
 * print_r($variable, $return) - Affiche lisible (human readable)
 * Retour: string ou null
 */
// Exemple: print_r([1, 2]) => Array ( [0] => 1 [1] => 2 )

/**
 * echo $variable - Affiche une sortie (constructeur de langage)
 * Retour: void
 */
// Exemple: echo "Hello" => affiche "Hello"

/**
 * print $variable - Affiche une sortie (constructeur de langage)
 * Retour: int (1)
 */
// Exemple: print "Hello" => affiche "Hello"

// ============================================================================
// 5️⃣ FONCTIONS DE FICHIERS (File Functions)
// ============================================================================

/**
 * file_exists($filename) - Vérifie si fichier existe
 * Retour: bool
 */
// Exemple: file_exists("test.txt") => true/false

/**
 * is_file($filename) - Vérifie si c'est un fichier
 * Retour: bool
 */
// Exemple: is_file("test.txt") => true/false

/**
 * is_dir($pathname) - Vérifie si c'est un répertoire
 * Retour: bool
 */
// Exemple: is_dir("folder") => true/false

/**
 * is_readable($filename) - Vérifie si lisible
 * Retour: bool
 */
// Exemple: is_readable("test.txt") => true/false

/**
 * is_writable($filename) - Vérifie si writable
 * Retour: bool
 */
// Exemple: is_writable("test.txt") => true/false

/**
 * filesize($filename) - Taille du fichier en bytes
 * Retour: int
 */
// Exemple: filesize("test.txt") => 1024

/**
 * file_get_contents($filename) - Lit tout le fichier
 * Retour: string
 */
// Exemple: file_get_contents("test.txt") => contenu du fichier

/**
 * file_put_contents($filename, $data, $flags) - Écrit dans fichier
 * Retour: int (bytes écrits)
 */
// Exemple: file_put_contents("test.txt", "Hello") => crée/écrase fichier

/**
 * file($filename) - Lit le fichier ligne par ligne
 * Retour: array
 */
// Exemple: file("test.txt") => tableau de lignes

/**
 * fopen($filename, $mode) - Ouvre un fichier
 * Retour: resource ou false
 */
// Exemple: fopen("test.txt", "r") => ressource fichier

/**
 * fclose($handle) - Ferme un fichier
 * Retour: bool
 */
// Exemple: fclose($fp) => true/false

/**
 * fread($handle, $length) - Lit du fichier
 * Retour: string
 */
// Exemple: fread($fp, 100) => 100 caractères

/**
 * fwrite($handle, $string) ou fputs() - Écrit dans fichier
 * Retour: int (bytes écrits)
 */
// Exemple: fwrite($fp, "Hello") => 5

/**
 * fgets($handle, $length) - Lit une ligne
 * Retour: string
 */
// Exemple: fgets($fp) => ligne suivante

/**
 * unlink($filename) - Supprime un fichier
 * Retour: bool
 */
// Exemple: unlink("test.txt") => true/false

/**
 * rename($oldname, $newname) - Renomme un fichier
 * Retour: bool
 */
// Exemple: rename("old.txt", "new.txt") => true/false

/**
 * copy($source, $dest) - Copie un fichier
 * Retour: bool
 */
// Exemple: copy("test.txt", "test_copy.txt") => true/false

/**
 * mkdir($pathname, $mode, $recursive) - Crée un répertoire
 * Retour: bool
 */
// Exemple: mkdir("newfolder") => true/false

/**
 * rmdir($dirname) - Supprime un répertoire (vide)
 * Retour: bool
 */
// Exemple: rmdir("folder") => true/false

/**
 * scandir($directory) - Liste les fichiers
 * Retour: array
 */
// Exemple: scandir(".") => [".", "..", "file.txt", ...]

/**
 * glob($pattern) - Trouve fichiers par pattern
 * Retour: array
 */
// Exemple: glob("*.txt") => ["file1.txt", "file2.txt"]

/**
 * basename($path, $suffix) - Retourne le nom du fichier
 * Retour: string
 */
// Exemple: basename("/path/to/file.txt") => "file.txt"

/**
 * dirname($path) - Retourne le répertoire
 * Retour: string
 */
// Exemple: dirname("/path/to/file.txt") => "/path/to"

/**
 * pathinfo($path, $options) - Info sur le chemin
 * Retour: array/string
 */
// Exemple: pathinfo("/path/to/file.txt")["extension"] => "txt"

// ============================================================================
// 6️⃣ FONCTIONS DE DATE ET HEURE (Date/Time Functions)
// ============================================================================

/**
 * time() - Timestamp actuel (secondes depuis 1970)
 * Retour: int
 */
// Exemple: time() => 1617878400

/**
 * date($format, $timestamp) - Formate une date
 * Retour: string
 */
// Exemple: date("Y-m-d") => "2024-04-07"

/**
 * strtotime($time, $now) - Convertit chaîne en timestamp
 * Retour: int ou false
 */
// Exemple: strtotime("2024-04-07") => 1712438400

/**
 * mktime($hour, $minute, $second, $month, $day, $year) - Crée timestamp
 * Retour: int
 */
// Exemple: mktime(0, 0, 0, 4, 7, 2024) => timestamp

/**
 * checkdate($month, $day, $year) - Vérifie validité date
 * Retour: bool
 */
// Exemple: checkdate(4, 31, 2024) => false

/**
 * microtime($get_as_float) - Microsecondes actuelles
 * Retour: string ou float
 */
// Exemple: microtime(true) => 1617878400.1234

// ============================================================================
// 7️⃣ FONCTIONS DE REGEX (Regular Expressions)
// ============================================================================

/**
 * preg_match($pattern, $subject, $matches) - Test si pattern match
 * Retour: int (1=match, 0=no match, false=erreur)
 */
// Exemple: preg_match("/Hello/", "Hello World") => 1

/**
 * preg_match_all($pattern, $subject, $matches) - Tous les matches
 * Retour: int (nombre de matches)
 */
// Exemple: preg_match_all("/\d+/", "123 456") => 2

/**
 * preg_replace($pattern, $replacement, $subject) - Remplace par pattern
 * Retour: string
 */
// Exemple: preg_replace("/\d+/", "X", "123 456") => "X X"

/**
 * preg_split($pattern, $subject, $limit) - Divise par pattern
 * Retour: array
 */
// Exemple: preg_split("/\s+/", "a b  c") => ["a", "b", "c"]

/**
 * preg_quote($str, $delimiter) - Échappe les caractères regex
 * Retour: string
 */
// Exemple: preg_quote("$40") => "\$40"

// ============================================================================
// 8️⃣ FONCTIONS DE SESSION (Session Functions)
// ============================================================================

/**
 * session_start() - Démarre la session
 * Retour: bool
 */
// Exemple: session_start() => true/false

/**
 * session_destroy() - Détruit la session
 * Retour: bool
 */
// Exemple: session_destroy() => true/false

/**
 * session_id($id) - Obtient ou définit l'ID session
 * Retour: string
 */
// Exemple: session_id() => ID session

/**
 * $_SESSION[] - Superglobal pour stocker données session
 * Retour: array
 */
// Exemple: $_SESSION["user"] = "John" => stocke dans session

/**
 * isset($_SESSION[$key]) - Vérifie clé session
 * Retour: bool
 */
// Exemple: isset($_SESSION["user"]) => true/false

/**
 * unset($_SESSION[$key]) - Supprime clé session
 * Retour: void
 */
// Exemple: unset($_SESSION["user"]) => supprime

// ============================================================================
// 9️⃣ FONCTIONS SUPER-GLOBALES (Superglobals)
// ============================================================================

/**
 * $_GET - Paramètres d'URL (GET)
 * Accès: $_GET["key"]
 */
// Exemple: http://example.com?name=John => $_GET["name"] = "John"

/**
 * $_POST - Données de formulaire (POST)
 * Accès: $_POST["key"]
 */
// Exemple: formulaire POST => $_POST["field"] = valeur

/**
 * $_REQUEST - GET + POST + COOKIE
 * Accès: $_REQUEST["key"]
 */
// Exemple: $_REQUEST["data"] => vient de GET, POST ou COOKIE

/**
 * $_SERVER - Info du serveur
 * Accès: $_SERVER["key"]
 */
// Exemple: $_SERVER["REQUEST_METHOD"] => "GET" ou "POST"

/**
 * $_COOKIE - Cookies du client
 * Accès: $_COOKIE["key"]
 */
// Exemple: $_COOKIE["user"] => valeur du cookie

/**
 * $_SESSION - Variables de session
 * Accès: $_SESSION["key"]
 */
// Exemple: $_SESSION["user_id"] => valeur en session

/**
 * $_FILES - Fichiers uploadés
 * Accès: $_FILES["field"]["key"]
 */
// Exemple: $_FILES["file"]["name"] => nom du fichier

/**
 * $_ENV - Variables d'environnement
 * Accès: $_ENV["key"]
 */
// Exemple: $_ENV["PATH"] => valeur environnement

/**
 * $_GLOBALS - Toutes les variables globales
 * Accès: $_GLOBALS["varname"]
 */
// Exemple: $_GLOBALS["x"] => accès global

/**
 * $GLOBALS - Alias de $_GLOBALS
 * Accès: $GLOBALS["varname"]
 */
// Exemple: $GLOBALS["x"] = 5 => définit globalement

// ============================================================================
// 🔟 FONCTIONS DE FLUX (Output Buffer Functions)
// ============================================================================

/**
 * ob_start() - Démarre la capture de sortie
 * Retour: bool
 */
// Exemple: ob_start() => capture ce qui suit

/**
 * ob_get_contents() - Obtient le contenu capturé
 * Retour: string ou false
 */
// Exemple: ob_get_contents() => contenu buffer

/**
 * ob_clean() - Vide le buffer
 * Retour: bool
 */
// Exemple: ob_clean() => vide sans retourner

/**
 * ob_end_clean() - Vide et arrête la capture
 * Retour: bool
 */
// Exemple: ob_end_clean() => vide et arrête

/**
 * ob_end_flush() - Envoie et arrête la capture
 * Retour: bool
 */
// Exemple: ob_end_flush() => envoie au navigateur

/**
 * ob_get_level() - Niveau d'imbrication du buffer
 * Retour: int
 */
// Exemple: ob_get_level() => 2

/**
 * ob_get_flush() - Retourne et envoie
 * Retour: bool
 */
// Exemple: ob_get_flush() => retourne et envoie

// ============================================================================
// 1️⃣1️⃣ FONCTIONS D'ERREUR (Error Handling)
// ============================================================================

/**
 * trigger_error($message, $error_type) - Trigger une erreur
 * Retour: void
 */
// Exemple: trigger_error("Erreur!", E_USER_ERROR)

/**
 * set_error_handler($callback) - Définit handler d'erreur
 * Retour: mixed
 */
// Exemple: set_error_handler(fn($n,$s)=>echo $s)

/**
 * error_reporting($level) - Définit le niveau d'erreur
 * Retour: int
 */
// Exemple: error_reporting(E_ALL) => rapporte toutes erreurs

/**
 * ini_set($option, $value) - Définit une option ini
 * Retour: string (ancienne valeur)
 */
// Exemple: ini_set("display_errors", "1")

/**
 * ini_get($option) - Obtient une option ini
 * Retour: string
 */
// Exemple: ini_get("max_execution_time") => "30"

// ============================================================================
// 1️⃣2️⃣ FONCTIONS DE CLASSE ET OBJET (Class/Object Functions)
// ============================================================================

/**
 * class_exists($class, $autoload) - Vérifie si classe existe
 * Retour: bool
 */
// Exemple: class_exists("MyClass") => true/false

/**
 * method_exists($object, $method) - Vérifie si méthode existe
 * Retour: bool
 */
// Exemple: method_exists($obj, "myMethod") => true/false

/**
 * property_exists($object, $property) - Vérifie si propriété existe
 * Retour: bool
 */
// Exemple: property_exists($obj, "myProp") => true/false

/**
 * get_class($object) - Retourne le nom de la classe
 * Retour: string ou false
 */
// Exemple: get_class($obj) => "MyClass"

/**
 * get_class_methods($class) - Retourne les méthodes
 * Retour: array
 */
// Exemple: get_class_methods("MyClass") => ["method1", "method2"]

/**
 * get_class_vars($class) - Retourne les propriétés
 * Retour: array
 */
// Exemple: get_class_vars("MyClass") => ["prop1"=>default, ...]

/**
 * get_object_vars($object) - Retourne les propriétés de l'objet
 * Retour: array
 */
// Exemple: get_object_vars($obj) => ["prop1"=>val, ...]

/**
 * is_a($object, $class) - Vérifie si instance/subclass
 * Retour: bool
 */
// Exemple: is_a($obj, "MyClass") => true/false

/**
 * is_subclass_of($object, $class) - Vérifie si subclass
 * Retour: bool
 */
// Exemple: is_subclass_of($obj, "Parent") => true/false

/**
 * instanceof - Opérateur pour vérifier le type
 * Syntaxe: $obj instanceof ClassName
 */
// Exemple: if ($obj instanceof MyClass) => true/false

// ============================================================================
// 1️⃣3️⃣ FONCTIONS DE SÉCURITÉ (Security Functions)
// ============================================================================

/**
 * md5($string) - Hash MD5 (non sûr pour mots de passe)
 * Retour: string (32 caractères hex)
 */
// Exemple: md5("password") => "5f4dcc3b5aa765d61d8327deb882cf99"

/**
 * sha1($string) - Hash SHA1 (non sûr pour mots de passe)
 * Retour: string (40 caractères hex)
 */
// Exemple: sha1("password") => "5baa61e4c9b93f3f0682250b6cf8331b7ee68fd8"

/**
 * password_hash($password, $algo, $options) - Hash sûr (PHP 5.5+)
 * Retour: string
 */
// Exemple: password_hash("pwd", PASSWORD_DEFAULT) => hash sûr

/**
 * password_verify($password, $hash) - Vérifie mot de passe
 * Retour: bool
 */
// Exemple: password_verify("pwd", $hash) => true/false

/**
 * password_needs_rehash($hash, $algo) - Vérifie si rehash nécessaire
 * Retour: bool
 */
// Exemple: password_needs_rehash($hash, PASSWORD_DEFAULT)

/**
 * hash($algo, $data) - Hash avec algo spécifié
 * Retour: string
 */
// Exemple: hash("sha256", "data") => hash SHA256

/**
 * htmlspecialchars($string) - Échappe HTML
 * Retour: string
 */
// Exemple: htmlspecialchars("<script>") => "&lt;script&gt;"

/**
 * htmlentities($string) - Convertit en entités
 * Retour: string
 */
// Exemple: htmlentities("Café") => "Caf&eacute;"

/**
 * strip_tags($string, $allowed) - Supprime balises
 * Retour: string
 */
// Exemple: strip_tags("<p>Hello</p>") => "Hello"

/**
 * addslashes($string) - Échappe guillemets
 * Retour: string
 */
// Exemple: addslashes("It's") => "It\'s"

/**
 * stripslashes($string) - Supprime slashes
 * Retour: string
 */
// Exemple: stripslashes("It\'s") => "It's"

/**
 * urlencode($string) - Encode pour URL
 * Retour: string
 */
// Exemple: urlencode("hello world") => "hello+world"

/**
 * urldecode($string) - Décode depuis URL
 * Retour: string
 */
// Exemple: urldecode("hello+world") => "hello world"

/**
 * base64_encode($data) - Encode en base64
 * Retour: string
 */
// Exemple: base64_encode("Hello") => "SGVsbG8="

/**
 * base64_decode($data) - Décode depuis base64
 * Retour: string
 */
// Exemple: base64_decode("SGVsbG8=") => "Hello"

/**
 * json_encode($value) - Convertit en JSON
 * Retour: string
 */
// Exemple: json_encode(["a"=>1]) => '{"a":1}'

/**
 * json_decode($json, $assoc) - Décode JSON
 * Retour: mixed
 */
// Exemple: json_decode('{"a":1}', true) => ["a"=>1]

// ============================================================================
// 1️⃣4️⃣ FONCTIONS HTTP (HTTP Functions)
// ============================================================================

/**
 * header($header, $replace, $http_response_code) - Envoie header HTTP
 * Retour: void
 */
// Exemple: header("Content-Type: application/json")

/**
 * headers_sent($file, $line) - Vérifie si headers envoyés
 * Retour: bool
 */
// Exemple: headers_sent() => true/false

/**
 * http_response_code($code) - Définit code HTTP
 * Retour: int
 */
// Exemple: http_response_code(404) => définit 404

/**
 * setcookie($name, $value, $expires, $path, $domain, $secure, $httponly) - Crée cookie
 * Retour: bool
 */
// Exemple: setcookie("user", "John", time()+3600)

/**
 * setrawcookie($name, $value) - Crée cookie (raw)
 * Retour: bool
 */
// Exemple: setrawcookie("data", "value")

/**
 * getallheaders() - Obtient tous les headers
 * Retour: array
 */
// Exemple: getallheaders() => ["Host"=>"...", "User-Agent"=>"..."]

/**
 * http_build_query($data) - Crée query string
 * Retour: string
 */
// Exemple: http_build_query(["a"=>1, "b"=>2]) => "a=1&b=2"

// ============================================================================
// 1️⃣5️⃣ FONCTIONS INCLUSIONS (Include/Require)
// ============================================================================

/**
 * include $file - Inclut un fichier (continue si erreur)
 * Retour: mixed (ce que le fichier retourne)
 */
// Exemple: include "header.php" => inclut et exécute

/**
 * require $file - Requiert un fichier (erreur si absent)
 * Retour: mixed
 */
// Exemple: require "config.php" => erreur si absent

/**
 * include_once $file - Inclut once (une fois max)
 * Retour: mixed
 */
// Exemple: include_once "helpers.php" => une seule fois

/**
 * require_once $file - Requiert once
 * Retour: mixed
 */
// Exemple: require_once "database.php" => une seule fois

// ============================================================================
// 1️⃣6️⃣ FONCTIONS DIVERSES (Miscellaneous Functions)
// ============================================================================

/**
 * sleep($seconds) - Pause l'exécution
 * Retour: int (0 if success)
 */
// Exemple: sleep(2) => pause 2 secondes

/**
 * usleep($microseconds) - Pause en microsecondes
 * Retour: int
 */
// Exemple: usleep(500000) => pause 0.5 secondes

/**
 * exit($status) ou die($status) - Arrête l'exécution
 * Retour: void
 */
// Exemple: exit("Erreur!") => affiche et arrête

/**
 * unset($variable) - Supprime une variable
 * Retour: void
 */
// Exemple: unset($x) => $x n'existe plus

/**
 * define($name, $value, $case_insensitive) - Définit constante
 * Retour: bool
 */
// Exemple: define("PI", 3.14159) => constante PI

/**
 * defined($name) - Vérifie si constante existe
 * Retour: bool
 */
// Exemple: defined("PI") => true/false

/**
 * constant($name) - Obtient valeur de constante
 * Retour: mixed
 */
// Exemple: constant("PI") => 3.14159

/**
 * version_compare($version1, $version2, $operator) - Compare versions
 * Retour: int ou bool
 */
// Exemple: version_compare("1.2", "1.3", "<") => true

/**
 * phpversion($extension) - Version PHP
 * Retour: string
 */
// Exemple: phpversion() => "8.0.1"

/**
 * extension_loaded($extension) - Vérifie extension
 * Retour: bool
 */
// Exemple: extension_loaded("pdo") => true/false

/**
 * get_defined_constants() - Obtient toutes les constantes
 * Retour: array
 */
// Exemple: get_defined_constants() => [...constantes...]

/**
 * get_defined_vars() - Obtient toutes les variables
 * Retour: array
 */
// Exemple: get_defined_vars() => [...variables...]

/**
 * get_defined_functions() - Obtient toutes les fonctions
 * Retour: array
 */
// Exemple: get_defined_functions() => [...fonctions...]

/**
 * function_exists($function) - Vérifie si fonction existe
 * Retour: bool
 */
// Exemple: function_exists("strlen") => true

/**
 * call_user_func($callback, ...$args) - Appelle fonction
 * Retour: mixed
 */
// Exemple: call_user_func("strlen", "Hello") => 5

/**
 * call_user_func_array($callback, $params) - Appelle avec array
 * Retour: mixed
 */
// Exemple: call_user_func_array("strlen", ["Hello"]) => 5

/**
 * func_get_args() - Obtient les arguments d'une fonction
 * Retour: array
 */
// Exemple: func_get_args() => [...args...]

/**
 * func_num_args() - Nombre d'arguments
 * Retour: int
 */
// Exemple: func_num_args() => 3

/**
 * func_get_arg($index) - Obtient un argument
 * Retour: mixed
 */
// Exemple: func_get_arg(0) => premier argument

/**
 * eval($code) - Exécute du code PHP (DANGEREUX!)
 * Retour: mixed
 */
// Exemple: eval("echo 'Hello';") => exécute la chaîne

/**
 * assert($assertion, $description) - Assertion
 * Retour: void
 */
// Exemple: assert($x > 0, "x doit être positif")

/**
 * dump() - Affiche variable (var_dump + die)
 * Retour: void
 */
// Exemple: dump($x) => affiche et arrête

// ============================================================================
// END OF REFERENCE
// ============================================================================

?>
