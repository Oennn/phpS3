<?php
$dicoprix = array(
"jambon" => 3,
"sauce_tomate" => 1.5,
"poivrons" => 2,
"oignons" => 1,
"champignons" => 2,
"mozzarella" => 1.5,
"creme_fraiche" => 1.5,
"chevre" => 2,
"tomates" => 2,
"lardons" => 2.5,
"saumon" => 4,
"merguez" => 3
);
$monDicoPizzas = array(
"reine" => ["jambon","mozzarella","sauce_tomate","champignons"],
"vesuvio" => ["merguez","jambon","mozzarella","poivrons","oignons"],
"cabri" => ["chevre","lardons","creme_fraiche","mozzarella"],
"napoli" => ["jambon","tomates","mozzarella","sauce_tomate",
"champignons","poivrons","oignons"],
"neptune" => ["saumon","creme_fraiche","champignons"]
);
$dicoprix2 = array(
"jambon" => 3.2,
"sauce_tomate" => 1.4,
"poivrons" => 2.1,
"oignons" => 0.95,
"champignons" => 2.0,
"mozzarella" => 1.6,
"creme_fraiche" => 1.4,
"chevre" => 2.2,
"tomates" => 1.9,
"lardons" => 2.7,
"saumon" => 4.0,
"merguez" => 2.9,
"anchois" => 2.3
);

function combien(array $dico): int {
    return count($dico);
}

function prix_moyen(array $dico): float {
    return array_sum($dico) / count($dico);
}

function moinscher(array $dico): array {
    $min = min($dico);
    $res = [];
    foreach ($dico as $ingredient => $prix) {
        if ($prix === $min) {
            $res[] = $ingredient;
        }
    }
    return $res;
}

function dollars(array &$dico): void {
    $taux = 1.12;
    foreach ($dico as $ingredient => $prix) {
        $dico[$ingredient] = $prix * $taux;
    }
}

function prixpizza(array $ingredients, array $dicoprix): float {
    $somme = 0;
    foreach ($ingredients as $ingredient) {
        $somme += $dicoprix[$ingredient];
    }
    return $somme;
}

function gestion(array $dicoprix1, array $dicoprix2): array {
    foreach ($dicoprix1 as $ingredient => $prix) {
        if (array_key_exists($ingredient, $dicoprix2)) {
            if ($prix < $dicoprix2[$ingredient]) {
                $dicoprix2[$ingredient] = $prix;
            }
        } else {
            // Ajouter l'ingrédient s'il n'existe pas dans dicoprix2
            $dicoprix2[$ingredient] = $prix;
        }
    }
    return $dicoprix2;
}

function possible(array $dicopizzas, float $budget, array $dicoprix): array {
    $resultat = [];
    echo "\nbudget = $budget\n";

    foreach ($dicopizzas as $pizza => $ingredients) {
        if ($budget >= prixpizza($ingredients, $dicoprix) * 1.5) {
            $resultat[] = $pizza;
        }
    }

    return $resultat;
}

function fusion(array $dicoprix, array $dicopizzas): array {
    $menu = [];
    foreach ($dicopizzas as $pizza => $ingredients) {
        $menu[$pizza] = [
            "ingredients" => $ingredients,
            "prix" => prixpizza($ingredients, $dicoprix) * 1.5
        ];
    }
    return $menu;
}

function affichage(array $menu): void {
    echo "\nMenu des pizzas :\n";
    foreach ($menu as $pizza => $infos) {
        $ingredients = implode("/", $infos["ingredients"]);
        echo "* Pizza $pizza : {$infos['prix']} euros -- $ingredients\n";
    }
}

function inter(array $l1, array $l2): bool {
    foreach ($l1 as $a) {
        foreach ($l2 as $b) {
            if ($a === $b) {
                return true;
            }
        }
    }
    return false;
}

function sansAllergie(array $dicopizzas, array $listeallergenes): array {
    $pizzas = [];

    foreach ($dicopizzas as $pizza => $ingredients) {
        if (!inter($ingredients, $listeallergenes)) {
            $pizzas[] = $pizza;
        }
    }



    return $pizzas;
}

/**************************************************
 * 3. SECTION TESTS
 **************************************************/

echo "Nombre d'ingrédients = " . combien($dicoprix) . "\n\n";
echo "Prix moyen = " . round(prix_moyen($dicoprix), 2) . "\n\n";
echo "Ingredients les moins chers = " . moinscher($dicoprix)[0] . "\n\n";

$res_dollars = $dicoprix;
echo "Apres conversion en dollars :\n";
dollars($res_dollars);
foreach($res_dollars as $ingredient_dollars=>$prix){
    echo"$ingredient_dollars -> $prix\n";
}
echo "\n";
foreach ($monDicoPizzas as $pizza => $ingredients) {
    echo "Prix $pizza = " . (1.5 * prixpizza($ingredients, $dicoprix)) . "\n";
}
echo "\n";
$res = gestion($dicoprix, $dicoprix2);
echo "Nombre total d'ingredients apres fusion = " . count($res) . "\n";
echo "Prix retenu pour oignons = " . $res["oignons"] . "\n";
echo "Prix retenu pour merguez = " . $res["merguez"] . "\n";
echo "Prix retenu pour sauce_tomate = " . $res["sauce_tomate"] . "\n";
echo "Prix retenu pour anchois = " . $res["anchois"] . "\n";
echo "\n";
$res_possible1=possible($monDicoPizzas, 12.00, $dicoprix);
echo"Pizzas possibles : ";
foreach ($res_possible1 as $pizza) {
    echo "$pizza ";
}
echo "\n\n";


$res_possible2=possible($monDicoPizzas, 16.00, $dicoprix);
echo"Pizzas possibles : ";
foreach ($res_possible2 as $pizza) {
    echo "$pizza ";
}
echo "\n\n";



$menu = fusion($dicoprix, $monDicoPizzas);
affichage($menu);


echo "\n";
$listeallergenes = ["saumon", "lardons"];
$res_SansAllergie=sansAllergie($monDicoPizzas, $listeallergenes);

echo "\n\nAllergenes : " . implode(" ", $listeallergenes);
echo "\nPizzas sans allergie : " . implode(" ", $res_SansAllergie) . "\n";




/*
foreach ($dicoprix as $ingredient => $prix) {
    echo "$ingredient coûte $prix euros\n";
}if(isset($tab2[$ingredient])) pour regarder si dans tab2 on a le meme ingredient, en partant du meme type de tableau pour les 2
$tab2[$ingredient] renvoie la clé, un int ici
    */

/*
function combien(array $dico): int {
    $cpt = 0;
    foreach ($dico as $value) {
        $cpt++;
    }
    return $cpt;
}
*/

/*
$monDicoPizzas=array(
                          "reine"=>["jambon","mozarella","saucetomate","champignons"],
                          "vesuvio"=>['merguez','jambon','mozarella','poivrons','oignons'],
                          "cabri"=>["chevre","lardons","cremefraiche","mozarella"],
                          "napoli"=>["jambon","tomates","mozarella","saucetomate","champignons","poivrons","oignons"],
                          "neptune"=>['saumon','cremefraiche','champignons']);

($monDicoPizzas as $pizza => $ingredients)
$ingredients = liste des ingrédients
$pizza = nom de la pizza
($ingredients as $ingredient)
$ingredient = ingredient seul



$nouveauDico = [
    "reine" => [
        "ingredients" => ["jambon","mozarella","saucetomate","champignons"],
        "prix" => 12
    ],
    "vesuvio" => [
        "ingredients" => ["merguez","jambon","mozarella","poivrons","oignons"],
        "prix" => 15
    ],
    ...
];
$nouveauDico["reine"] renvoie : 
[
  "ingredients" => ["jambon","mozarella","saucetomate","champignons"],
  "prix" => 12
]

$prixReine = $nouveauDico["reine"]["prix"]; renvoie prix

$ingredientsReine = $nouveauDico["reine"]["ingredients"]; renvoie ingredients

acceder a un ingredient précis : 
$premierIngredient = $nouveauDico["reine"]["ingredients"][0]; // "jambon"
$dernierIngredient = $nouveauDico["reine"]["ingredients"][3]; // "champignons"


Chercher un ingrédient précis dans toutes les pizzas
quelles pizzas contiennent "champignons" ?
2 foreach nécessaires (pizzas → ingrédients)

foreach ($dico as $pizza => $ingredients) {
        foreach ($ingredients as $ingredient)

selon:
foreach ($dicoTest as $nomPizza => $infos) 
dicoTest=
[
  "reine" => [ //$pizza
      "ingredients" => [...], //$infos[ingredients] donne juste la liste
      "prix" => 8.5 //$infos[prix] donne juste le prix, C’est strictement équivalent à $dicoTest[$nomPizza]["prix"];
  ],
  ...
]
Récupérer le prix d’une pizza:
$prixPizza = $dicoTest["$pizza"]["prix"]; avec prix defini

Récupérer la liste des ingrédients
$ingredientsPizza = $dicoTest["pizza"]["ingredients"]; avec ingredients defini


Vérifier si une pizza contient un ingrédient précis
if (in_array("jambon", $dicoTest["pizza"]["ingredients"])) {
    echo "La pizza reine contient du jambon";
}




Récupérer toutes les pizzas qui contiennent un ingrédient
$pizzasAvecJambon = [];
foreach pour une liste d ingredients, et remplacer jambon par $ingredientListe
foreach ($dicoTest as $nomPizza => $infos) {
    if (in_array("jambon", $infos["ingredients"])) {
        $pizzasAvecJambon[] = $nomPizza;
    }
}
*/
?>