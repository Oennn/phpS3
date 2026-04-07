<?php
if (isset($_GET['nom']) && !empty($_GET['nom'])) { // si nom existe dans url et que sa valeur est pas vide (donc != de 0 null ou chaine vide)
/*
La fonction empty() retourne true dans les cas suivants :
La variable n'existe pas (pas de notice d'erreur)
La variable vaut : "" (chaîne vide), 0, false, null, un tableau vide []
isset est pas necessaire
// Si tu veux juste vérifier que le paramètre existe
// (même s'il est vide)
if (isset($_GET['action'])) {
    $action = $_GET['action'];  // Peut être vide
}

 */
    $nom = $_GET['nom'];
    if ($nom === 'VotreNom') {

        $nom = 'DUPONT';
    }
    else{    
        $nom = htmlspecialchars($nom, ENT_QUOTES); //securise si le nom est bizarre
    }
}
 else {

    $nom = 'DUPONT';
}
//https://dev-chabaud221.users.info.unicaen.fr/page_perso.php?nom=neo pour moi
echo <<<HTML
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page HTML générée par PHP</title>
</head>
<body>
    <h1>Page personelle</h1>
    <p>Bienvenue sur la page personnelle de <strong>$nom</strong>.</p>
    <a href="page_perso.php?nom=VotreNom">$nom</a> <!-- pas sure de ce qui est demandé, sinon j'aurai laissé VotreNom à la place de $nom -->
</body>
</html>
HTML;


// il s affiche une page avec marqué ce qu il y a dans le html.
//que le code d une page html
?>
