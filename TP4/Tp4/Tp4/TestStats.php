<?php
require_once "Donnees.php";
require_once "Naissance.php";
require_once "StatistiquesNaissances.php";


$naissances = [];
foreach ($donnees as $ligne){

    $naissances[] = Naissance::fromArray($ligne);
}

$stats = new StatistiquesNaissances($naissances);

$total = $stats->total();
$totalM = $stats->totalSexe("M");
$totalF = $stats->totalSexe("F");
$propM = $stats->proportionSexe("M");
$propF = $stats->proportionSexe("F");
$garcons2012 = $stats->totalSexeAnnee("M", 2012);
$filles2012 = $stats->totalSexeAnnee("F", 2012);

echo "Nombre total de personnes : $total ($totalM M + $totalF F)\n";
echo "Proportion de garcons : $propM% des naissances.\n";
echo "Proportion de filles : $propF% des naissances.\n";
echo "Nombre de garcons nes en 2012 : $garcons2012\n";
echo "Nombre de filles nees en 2012 : $filles2012\n";
