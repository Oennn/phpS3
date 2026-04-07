<?php





// J'avais déja fait le tp version ensweb, il est donc normal que ma mise en page soit légèrement différente que celle du tp de cette année.








function afficherTable(int $borne, bool $asText = false): void {
    if ($asText) {
        header("Content-Type: text/plain; charset=UTF-8"); //text brute au nav

        for ($i = 1; $i <= $borne; $i++) {
            for ($j = 1; $j <= $borne; $j++) {
                echo ($i * $j) . "\t";   //pour aligner
            }
            echo "\n"; 
        }
        return;
    }

    echo "<table>";
    for($i=1; $i <=$borne;$i++){
        echo "<tr>";
        for($j=1;$j<=$borne;$j++){
            $produit=$i*$j;
            echo"<td>$produit</td>";
        }
        echo "</tr>";
    }

    echo "</table>";
    
}

// multiplication.php?borne= cquetuv
function lireBorne(): ?int {
    if (!isset($_GET['borne'])) {
        return null; // pas disp
    }

    if (!ctype_digit($_GET['borne'])) {
        return null; // si pas int
    }

    $borne = (int) $_GET['borne'];

    if ($borne < 1 || $borne > 100) {
        return null; 
    }

    return $borne;
}

// multiplication.php?format=txt
// multiplication.php?format=html
function lireFormat(): string {
    if (!isset($_GET["format"])) { // obligé sinon erreur
        return "html";
    }

    $f = $_GET["format"];
    if ($f === "txt" || $f === "html") {
        return $f;
    }

    return "html";
}
// multiplication.php?download=1&format=txt 
function veutDownload(): bool {
    return isset($_GET["download"]) && $_GET["download"] == "1";
}

// --------------------
// Paramètres
// --------------------
$borne = 15; //de base
$format = lireFormat();

$tmp = lireBorne();


if (isset($_GET["borne"]) && $tmp === null) {
    header("Location: multiplication.php");
    exit; //pour arreter script
}


if ($tmp !== null) {
    $borne = $tmp;
}

if ($format === "txt") {
    header("Content-Type: text/plain; charset=UTF-8");
    if(veutDownload()) {
        header("Content-Disposition: attachment; filename=multiplication.txt"); //pour telecharger la page sans la montrer, donc reste sur html et pas txt
    }
    afficherTable($borne, true);
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>multiplication</title>
    <style>
        table { border: 1px solid black; margin: 3em auto; border-collapse: collapse; }
        td { border: 1px solid black; width: 3em; text-align: center; padding: .2em; }
        td { background: blanchedalmond; }
        tr:nth-child(odd) > td:nth-child(odd),
        tr:nth-child(even) > td:nth-child(even) { background: gold; }
        .erreur { font-weight: bold; color: red; }
        .menu { text-align: center; margin: 1em 0; }
        .menu a { margin: 0 .5em; }
    </style>
</head>
<body>
    <h1 style="text-align:center;">Table de multiplication</h1>
    <div class="menu">
    <!-- Liens pratiques pour tester -->
    <a href="multiplication.php?borne=<?php echo $borne; ?>&format=html">HTML</a>
    <a href="multiplication.php?borne=<?php echo $borne; ?>&format=txt">TXT</a>
    <a href="multiplication.php?borne=<?php echo $borne; ?>&format=txt&download=1">Télécharger</a>
    </div>
    <?php


        afficherTable($borne);

    ?>
</body>
</html>