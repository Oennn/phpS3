<?php
// ============= DONNÉES DE TEST =============
// Tableau 2D contenant une grille de 5 lignes x 6 colonnes avec des lettres et symboles
$grille = [
    ['P', 'Y', 'T', 'H', 'O', 'N'], // Ligne 1 (contient PYTHON horizontalement)
    ['R', '*', 'A', 'U', 'M', 'A'], // Ligne 2
    ['O', 'M', 'B', 'R', 'E', '*'], // Ligne 3
    ['G', 'A', 'L', 'E', 'T', 'S'], // Ligne 4
    ['*', 'T', 'E', '*', 'S', 'U']  // Ligne 5
];
// Chaîne de mots séparés par des wildcards (*)
$chaine = "BONJOUR*CA*VA";
// Tableau avec des éléments à valider (certains vides, certains avec !)
$liste = ['UN', 'EXEMPLE', '', 'A', 'B', 'TRAITER', '!'];

// ============= FONCTION 1 =============
// Fonction qui cherche un mot dans la grille (horizontalement et verticalement)
// Paramètres: $grille (tableau 2D) et $mot (chaîne à rechercher)
// Retour: true si trouvé, false sinon
function chercherDansGrille($grille, $mot) {
    // Obtenir le nombre de lignes dans la grille
    $lignes = count($grille);
    // Obtenir le nombre de colonnes (en supposant que la première ligne a la même longueur)
    $colonnes = count($grille[0]);
    // Obtenir la longueur du mot recherché
    $motLen = strlen($mot);

    // ========== RECHERCHE HORIZONTALE (gauche à droite) ==========
    // Parcourir chaque ligne de la grille
    for ($i = 0; $i < $lignes; $i++) {
        // Parcourir chaque position horizontale où le mot pourrait commencer
        // La condition $j <= $colonnes - $motLen évite de dépasser les limites
        for ($j = 0; $j <= $colonnes - $motLen; $j++) {
            // Supposer que le mot est trouvé à cette position
            $trouve = true;
            // Vérifier chaque caractère du mot
            for ($k = 0; $k < $motLen; $k++) {
                // Comparer le caractère de la grille avec le caractère du mot
                // Utiliser !== pour vérifier aussi le type (stricte)
                if ($grille[$i][$j + $k] !== $mot[$k]) {
                    // Le caractère ne correspond pas, mot non trouvé
                    $trouve = false;
                    break; // Arrêter la boucle interne
                }
            }
            // Si le mot a été trouvé (tous les caractères correspondent)
            if ($trouve) {
                return true; // Retourner true immédiatement
            }
        }
    }

    // ========== RECHERCHE VERTICALE (haut à bas) ==========
    // Parcourir chaque colonne de la grille
    for ($j = 0; $j < $colonnes; $j++) {
        // Parcourir chaque position verticale où le mot pourrait commencer
        // La condition $i <= $lignes - $motLen évite de dépasser les limites
        for ($i = 0; $i <= $lignes - $motLen; $i++) {
            // Supposer que le mot est trouvé à cette position
            $trouve = true;
            // Vérifier chaque caractère du mot
            for ($k = 0; $k < $motLen; $k++) {
                // Comparer le caractère de la grille avec le caractère du mot
                // Utiliser [$i + $k][$j] pour chercher verticalement (change les lignes, pas colonnes)
                if ($grille[$i + $k][$j] !== $mot[$k]) {
                    // Le caractère ne correspond pas
                    $trouve = false;
                    break; // Arrêter la boucle interne
                }
            }
            // Si le mot a été trouvé (tous les caractères correspondent)
            if ($trouve) {
                return true; // Retourner true immédiatement
            }
        }
    }

    // Si on arrive ici, le mot n'a pas été trouvé
    return false;
}

// ============= FONCTION 2 =============
// Fonction qui traite une chaîne contenant des mots séparés par des wildcards (*)
// Paramètres: $grille (tableau 2D) et $chaine (chaîne avec wildcards)
// Retour: tableau avec le statut de chaque mot (trouvé ou non)
function traiterChaine($grille, $chaine) {
    // Diviser la chaîne par le wildcard * pour obtenir les mots
    // explode() convertit une chaîne en tableau
    $mots = explode('*', $chaine);
    // Initialiser un tableau vide pour stocker les résultats
    $resultats = [];

    // Parcourir chaque mot de la chaîne
    foreach ($mots as $mot) {
        // Vérifier si le mot n'est pas vide
        // empty() retourne true pour les chaînes vides
        if (!empty($mot)) {
            // Chercher le mot dans la grille
            $trouve = chercherDansGrille($grille, $mot);
            // Stocker le résultat en utilisant le mot comme clé
            // Utiliser un ternaire pour retourner 'Trouvé' ou 'Non trouvé'
            $resultats[$mot] = $trouve ? 'Trouvé' : 'Non trouvé';
        }
    }

    // Retourner le tableau avec tous les résultats
    return $resultats;
}

// ============= FONCTION 3 =============
// Fonction qui valide les éléments d'une liste (pas vide, pas de !)
// Paramètres: $liste (tableau d'éléments)
// Retour: tableau avec le statut de validation de chaque élément
function validerListe($liste) {
    // Initialiser un tableau vide pour stocker les résultats
    $resultats = [];

    // Parcourir chaque élément de la liste
    foreach ($liste as $item) {
        // Vérifier si l'élément est vide
        if (empty($item)) {
            // Ajouter un résultat pour élément vide
            $resultats[] = ['item' => '(vide)', 'valide' => false];
        }
        // Vérifier si l'élément contient le caractère !
        elseif (strpos($item, '!') !== false) {
            // Ajouter un résultat pour élément contenant !
            // strpos() retourne la position si trouvé, false sinon
            $resultats[] = ['item' => $item, 'valide' => false];
        }
        // Sinon, l'élément est valide
        else {
            // Ajouter un résultat pour élément valide
            $resultats[] = ['item' => $item, 'valide' => true];
        }
    }

    // Retourner le tableau avec tous les résultats de validation
    return $resultats;
}

// ============= EXÉCUTION =============
// Traiter la chaîne et stocker les résultats
// Chaque mot de la chaîne sera recherché dans la grille
$resultatChaine = traiterChaine($grille, $chaine);
// Valider chaque élément de la liste
// Chaque élément sera marqué comme valide ou non
$validerElements = validerListe($liste);
?>

<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Recherche dans la grille</title>
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
        .grille {
            margin-top: 20px;
        }
        .grille table {
            border: 2px solid black;
        }
        .grille td {
            border: 1px solid #999;
            width: 30px;
            height: 30px;
            text-align: center;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Recherche de mots dans la grille</h1>

    <h2>Grille de caractères</h2>
    <div class="grille">
        <table>
            <?php foreach ($grille as $ligne): ?>
                <tr>
                    <?php foreach ($ligne as $char): ?>
                        <td><?php echo htmlspecialchars($char); ?></td>
                    <?php endforeach; ?>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>

    <h2>Résultats de recherche - Chaîne: "<?php echo htmlspecialchars($chaine); ?>"</h2>
    <table>
        <tr>
            <th>Mot</th>
            <th>Statut</th>
        </tr>
        <?php foreach ($resultatChaine as $mot => $statut): ?>
            <tr>
                <td><?php echo htmlspecialchars($mot); ?></td>
                <td><?php echo $statut; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <h2>Validation de la liste</h2>
    <table>
        <tr>
            <th>Élément</th>
            <th>Valide</th>
        </tr>
        <?php foreach ($validerElements as $elem): ?>
            <tr>
                <td><?php echo htmlspecialchars($elem['item']); ?></td>
                <td><?php echo $elem['valide'] ? '✓ Oui' : '✗ Non'; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>

