<?php
// Tableau simple contenant les extensions de domaine (TLD) pour tous les pays
$domaines = [
    ".fr", // France (Europe)
    ".uk", // Royaume-Uni (Europe)
    ".de", // Allemagne (Europe)
    ".it", // Italie (Europe)
    ".es", // Espagne (Europe)
    ".us", // États-Unis (Amérique)
    ".ca", // Canada (Amérique)
    ".mx", // Mexique (Amérique)
    ".cn", // Chine (Asie)
    ".jp", // Japon (Asie)
    ".za", // Afrique du Sud (Afrique)
    ".ng", // Nigéria (Afrique)
    ".au", // Australie (Océanie)
    ".nz", // Nouvelle-Zélande (Océanie)
    ".ma", // Maroc (Afrique)
    ".dz", // Algérie (Afrique)
];

// Tableau associatif qui mappe chaque extension de domaine à son pays
// Clé: extension (.fr, .uk, etc.) | Valeur: nom du pays
$ext_pays = [
    ".fr" => "France", // .fr -> France
    ".uk" => "Royaume-Uni", // .uk -> Royaume-Uni
    ".de" => "Allemagne", // .de -> Allemagne
    ".it" => "Italie", // .it -> Italie
    ".es" => "Espagne", // .es -> Espagne
    ".us" => "États-Unis", // .us -> États-Unis
    ".ca" => "Canada", // .ca -> Canada
    ".mx" => "Mexique", // .mx -> Mexique
    ".cn" => "Chine", // .cn -> Chine
    ".jp" => "Japon", // .jp -> Japon
    ".za" => "Afrique du Sud", // .za -> Afrique du Sud
    ".ng" => "Nigéria", // .ng -> Nigéria
    ".au" => "Australie", // .au -> Australie
    ".nz" => "Nouvelle-Zélande", // .nz -> Nouvelle-Zélande
    ".ma" => "Maroc", // .ma -> Maroc
    ".dz" => "Algérie", // .dz -> Algérie
];

// Tableau associatif qui mappe chaque continent à la liste de ses pays
// Clé: nom du continent | Valeur: array des pays du continent
$continent_pays = [
    "Europe" => ["France", "Royaume-Uni", "Allemagne", "Italie", "Espagne"], // Pays d'Europe
    "Amérique" => ["États-Unis", "Canada", "Mexique"], // Pays d'Amérique
    "Asie" => ["Chine", "Japon"], // Pays d'Asie
    "Afrique" => ["Afrique du Sud", "Nigéria", "Maroc", "Algérie"], // Pays d'Afrique
    "Océanie" => ["Australie", "Nouvelle-Zélande"], // Pays d'Océanie
];

// Tableau indexé contenant des adresses email d'exemple triées par continent
$adressesEmail = [
    // SECTION AFRIQUE : Emails depuis des domaines africains
    "john.doe@example.ma", // Email du Maroc
    "jane.smith@example.ng", // Email du Nigéria
    "alexander.hamilton@mail.za", // Email d'Afrique du Sud
    "emily.dickinson@mail.ma", // Email du Maroc
    "james.brown@example.za", // Email d'Afrique du Sud
    "maria.garcia@example.ma", // Email du Maroc
    "robert.johnson@mail.ma", // Email du Maroc
    "susan.white@example.dz", // Email d'Algérie
    "william.shakespeare@mail.dz", // Email d'Algérie
    "elizabeth.bennet@mail.ng", // Email du Nigéria

    // SECTION AMÉRIQUE : Emails depuis des domaines américains
    "user1@example.us", // Email des États-Unis
    "user2@example.us", // Email des États-Unis
    "user3@example.us", // Email des États-Unis
    "user4@example.us", // Email des États-Unis
    "user5@example.us", // Email des États-Unis

    // SECTION ASIE : Emails depuis des domaines asiatiques
    "user6@example.cn", // Email de Chine
    "user7@example.cn", // Email de Chine
    "user8@example.cn", // Email de Chine

    // SECTION EUROPE : Emails depuis des domaines européens
    "user11@orange.fr", // Email de France
    "user12@laposte.fr", // Email de France
    "user13@free.fr", // Email de France
    "user14@example.de", // Email d'Allemagne
    "user15@example.fr", // Email de France

    // SECTION OCÉANIE : Emails depuis des domaines océaniens
    "user16@example.au", // Email d'Australie
    "user17@example.au", // Email d'Australie
    "user18@example.au", // Email d'Australie
    "user19@example.au", // Email d'Australie
    "user20@example.au" // Email d'Australie
];

// ============= FONCTION 1 =============
// Fonction qui extrait le pays d'un email en analysant son domaine
// Paramètres: $email (adresse complète) et $ext_pays (tableau domaine=>pays)
// Retour: le nom du pays ou "Inconnu" si pas trouvé
function obtenirPays($email, $ext_pays) {
    // Extraire le domaine après le @ en utilisant substr + strrpos
    // strrpos() trouve la position du dernier @ dans l'email
    // substr() récupère tout ce qui suit
    $domaine = substr($email, strrpos($email, '@') + 1);
    
    // Parcourir chaque extension-pays du tableau $ext_pays
    // $ext = l'extension (.fr, .uk, etc.)
    // $pays = le nom du pays
    foreach ($ext_pays as $ext => $pays) {
        // Vérifier si l'extension est contenue dans le domaine
        // strpos() retourne la position ou false si non trouvé
        if (strpos($domaine, $ext) !== false) {
            // L'extension est trouvée, retourner le pays correspondant
            return $pays;
        }
    }
    // Si aucune extension n'a été trouvée, retourner "Inconnu"
    return "Inconnu";
}

// ============= FONCTION 2 =============
// Fonction qui trouve le continent en fonction du pays
// Paramètres: $pays (nom du pays) et $continent_pays (tableau continent=>[pays])
// Retour: le nom du continent ou "Inconnu" si pas trouvé
function obtenirContinent($pays, $continent_pays) {
    // Parcourir chaque continent et sa liste de pays
    // $continent = le nom du continent
    // $pays_list = tableau avec les pays du continent
    foreach ($continent_pays as $continent => $pays_list) {
        // Vérifier si le pays recherché est dans la liste du continent
        // in_array() vérifie si une valeur existe dans le tableau
        if (in_array($pays, $pays_list)) {
            // Pays trouvé, retourner le continent
            return $continent;
        }
    }
    // Si le pays n'a pas été trouvé, retourner "Inconnu"
    return "Inconnu";
}

// ============= FONCTION 3 =============
// Fonction principale qui traite tous les emails et les classe par pays/continent
// Paramètres: $adresses (tableau d'emails), $ext_pays et $continent_pays (tableaux de mapping)
// Retour: tableau d'arrays contenant email, pays et continent de chaque adresse
function afficherEmails($adresses, $ext_pays, $continent_pays) {
    // Initialiser un tableau vide pour stocker les résultats
    $resultat = [];
    
    // Parcourir chaque adresse email du tableau
    foreach ($adresses as $email) {
        // Appeler obtenirPays() pour extraire le pays de l'email
        $pays = obtenirPays($email, $ext_pays);
        // Appeler obtenirContinent() pour trouver le continent du pays
        $continent = obtenirContinent($pays, $continent_pays);
        
        // Ajouter un nouvel array au tableau résultat avec les 3 informations
        // Utiliser [] pour ajouter à la fin du tableau
        $resultat[] = [
            'email' => $email, // L'adresse email complète
            'pays' => $pays, // Le pays identifié
            'continent' => $continent // Le continent identifié
        ];
    }
    
    // Retourner le tableau complet avec tous les emails traités
    return $resultat;
}

// ============= EXÉCUTION =============
// Appeler la fonction afficherEmails() pour traiter tous les emails
// Stocker le résultat dans la variable $resultats pour utilisation dans le HTML
$resultats = afficherEmails($adressesEmail, $ext_pays, $continent_pays);
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Analyse des emails par domaine</title>
    <style>
        table {
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>Analyse des adresses emails par continent et pays</h1>
    
    <table>
        <tr>
            <th>Email</th>
            <th>Pays</th>
            <th>Continent</th>
        </tr>
        <?php foreach ($resultats as $item): ?>
            <tr>
                <td><?php echo htmlspecialchars($item['email']); ?></td>
                <td><?php echo htmlspecialchars($item['pays']); ?></td>
                <td><?php echo htmlspecialchars($item['continent']); ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

