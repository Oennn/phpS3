<?php 
// Définir le fuseau horaire à Paris
date_default_timezone_set('Europe/Paris');

// Récupérer l'adresse IP du client qui visite la page
$ip = $_SERVER["REMOTE_ADDR"];

// Obtenir le timestamp actuel (nombre de secondes depuis 1970)
$timestamp = time();

// Convertir le timestamp en date format jour/mois/année
$date = date('d/m/Y', $timestamp);

// Convertir le timestamp en heure format heure:minute:seconde
$heure = date('H:i:s', $timestamp);
$NbVisites=0;

// Créer une chaîne avec IP, date et heure séparées par des virgules
$tab="$ip,$date,$heure\n";
$fichier = 'visiteurs.txt';

// Vérifier si le fichier existe, sinon le créer
if (!file_exists($fichier)) {
    touch($fichier);
}

// Ouvrir le fichier en mode ajout ('a+') pour ajouter une nouvelle visite
$f = fopen($fichier, 'a+');

// Écrire la visite actuelle (IP, date, heure) dans le fichier
fwrite($f, $tab);
fclose($f);

// Lire toutes les lignes du fichier (ignorer les lignes vides)
$lignes = file($fichier, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Compter le nombre total de visites enregistrées
$cpt=count($lignes);

// Parcourir chaque ligne du fichier pour compter les visites de l'IP actuelle
foreach($lignes as $ligne){
    // Séparer les données de la ligne par la virgule
    $parts=explode(',',$ligne);

    // Récupérer l'IP de cette visite (première partie avant la virgule)
    $lesIp= $parts[0];
    if($ip ===$lesIp){
    $NbVisites++;
    }
}
// Fonction pour afficher toutes les visites dans une table HTML
function afficherTable($lignes): void {
    echo "<table>";

    // Créer l'en-tête du tableau
    echo "<thead>";
    echo "<tr>";
    // Colonnes de la table
    echo "<th>Adresse IP du client</th>";
    echo "<th>Jour/Mois/Année</th>";
    echo "<th>Heure/Minute/Seconde</th>";
    echo "</tr>";
    echo "</thead>";

    // Créer le corps du tableau avec les données
    echo "<tbody>";
    // Parcourir chaque visite enregistrée
    foreach($lignes as $ligne){
        // Séparer les données (IP, date, heure) par la virgule
        $parts = explode(',', $ligne);
        echo "<tr>";
        for($j = 0; $j < count($parts); $j++){
            echo "<td>" .$parts[$j] . "</td>";
        }
        echo "</tr>";
    }echo "</tbody>";

    echo "</table>";
}



$visite= "Visite de $ip le $date à $heure => Votre $NbVisites visite sur mon site (sur $cpt visites au total)\n";
        

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Historique des visites</title>
    <style>
        body {
            max-width: 50em;
            margin: auto;
            font-family: sans-serif;
            display:block;
        }
        th{
            background-color: #eee;
        }
        table {
            border-collapse: collapse;
            text-indent: initial;
            border-spacing: 2px;
        }
        table th,
        table td {
            border: 1px solid #000;
            padding: 6px;
        }
    </style>
</head>
<body>
    <h1>Bienvenue sur mon site</h1>
    <p><?php echo $visite ?></p>
    <h1>Historique</h1>
    <?php afficherTable($lignes)?>
</body>
</html>