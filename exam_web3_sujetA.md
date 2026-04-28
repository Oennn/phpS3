# Examen Web 3 - Sujet A

**Programmation Web 3 - SINFL4A1**  
**L1 Informatique - UCN – 2ème Semestre**  
**Durée de l'épreuve : 1 h**  
**Date : 30/4/2025**

---

## Partie I : QCM (20 questions)

### 1. Quel type de données PHP est retourné par json_decode() par défaut ?
A. Un tableau associatif  
B. Un objet stdClass  
C. Une chaîne de caractères  
D. Un entier  

---

### 2. Quelle fonction permet de formater une chaîne de caractères avec des valeurs ?
A. printf()  
B. sprintf()  
C. Les deux  
D. Aucune  

---

### 3. Quel est le rôle de la fonction array_filter() ?
A. Créer un nouveau tableau  
B. Fusionner deux tableaux  
C. Filtrer les éléments selon un critère  
D. Supprimer tous les éléments  

---

### 4. Que retourne le code suivant ?
```php
<?php
$obj = new stdClass();
$obj->prop = "test";
echo isset($obj->prop) ? "existe" : "n existe pas";
?>
```
A. "existe"  
B. "n existe pas"  
C. Rien  
D. Erreur  

---

### 5. Quelle est la différence entre explode() et str_split() ?
A. explode() divise par délimiteur, str_split() par caractère  
B. Pas de différence  
C. str_split() est plus rapide  
D. explode() ne fonctionne pas avec les délimiteurs  

---

### 6. Que produit array_unique() ?
A. Retire les doublons  
B. Retourne les doublons  
C. Trie le tableau  
D. Fusionne les tableaux  

---

### 7. Que retourne le code suivant ?
```php
<?php
$arr = [1, 2, 3];
var_dump(in_array("3", $arr));
?>
```
A. bool(false)  
B. bool(true)  
C. string("3")  
D. Erreur  

---

### 8. Comment créer une classe immuable en PHP ?
A. Utiliser le mot-clé `readonly`  
B. Rendre toutes les propriétés private  
C. Ajouter `final` à la classe  
D. Les deux A et B  

---

### 9. Quel est le résultat de strrev("PHP") ?
A. "PHP"  
B. "HPP"  
C. string(3)  
D. Erreur  

---

### 10. Que fait la fonction array_map() ?
A. Filtre des éléments  
B. Applique une fonction à chaque élément  
C. Fusionne des tableaux  
D. Crée un nouveau tableau  

---

### 11. Comment accéder à un élément de tableau dans un template utilisateur (par sécurité) ?
A. `$tab[0]`  
B. `$tab["key"]` avec filter_var()  
C. `htmlspecialchars($tab[$_GET['key']])`  
D. `echo $tab[$_GET['key']]`  

---

### 12. Que retourne intval("42abc") ?
A. Erreur  
B. "42abc"  
C. 42  
D. 0  

---

### 13. Quel est le comportement de yield en PHP ?
A. Arrête la boucle  
B. Retourne une valeur et suspend la fonction (générateur)  
C. Crée un nouvel objet  
D. Valide une condition  

---

### 14. Que produit le code suivant ?
```php
<?php
$x = 5;
$y = "5";
var_dump($x === $y);
?>
```
A. bool(true)  
B. bool(false)  
C. null  
D. string("5")  

---

### 15. Quel est le résultat de array_keys(["a"=>1, "b"=>2]) ?
A. [1, 2]  
B. ["a", "b"]  
C. ["a"=>1, "b"=>2]  
D. 2  

---

### 16. Comment créer une classe avec une propriété calculée (read-only) ?
A. Utiliser `__get()` magique  
B. Rendre public  
C. Utiliser const  
D. Impossible  

---

### 17. Que retourne strpos("bonjour", "j") ?
A. 0  
B. -1  
C. 3  
D. false  

---

### 18. Quel est le type retourné par var_dump()?
A. string  
B. int  
C. void (rien)  
D. array  

---

### 19. Comment vérifier si une clé existe dans un tableau sans erreur ?
A. `$tab["key"]` directement  
B. `isset($tab["key"])`  
C. `empty($tab["key"])`  
D. `$tab["key"] != null`  

---

### 20. Que fait array_reduce() ?
A. Réduit la taille du tableau  
B. Applique une fonction pour réduire le tableau à une seule valeur  
C. Supprime les éléments  
D. Trie en ordre inverse

---

## Partie II : Réponse en une ligne

### 1. Comment vérifier qu'une chaîne commence par un préfixe ?
**Réponse :** `str_starts_with("chaîne", "préfixe")` (PHP 8+) ou `strpos("chaîne", "préfixe") === 0`

---

### 2. Quelle est la différence entre array_search() et in_array() ?
**Réponse :** `array_search()` retourne la clé si trouvée (ou false), `in_array()` retourne un booléen.

---

### 3. Comment appliquer htmlspecialchars() à tous les éléments d'un tableau ?
**Réponse :** `$tab = array_map('htmlspecialchars', $tab);`

---

### 4. Que signifie le modificateur `u` dans une regex en PHP ?
**Réponse :** Mode Unicode pour gérer les caractères UTF-8.

---

### 5. Comment créer un tableau de nombres de 1 à 10 ?
**Réponse :** `$tab = range(1, 10);`

---

### 6. Quel est le rôle de trim() en PHP ?
**Réponse :** Elle supprime les espaces (et caractères whitespace) au début et à la fin d'une chaîne.

---

### 7. Comment fusionner deux tableaux associatifs sans perdre les clés ?
**Réponse :** `$merged = $tab1 + $tab2;` ou `$merged = array_merge($tab1, $tab2);`

---

### 8. Que retourne preg_match_all() ?
**Réponse :** Le nombre de correspondances trouvées (entier).

---

### 9. Comment convertir un tableau en chaîne JSON ?
**Réponse :** `$json = json_encode($tab);`

---

### 10. Quel est le type de la variable après exécution : `$x = [1, 2, 3][1];` ?
**Réponse :** int (type entier, car la valeur est 2)

---

### 11. Comment supprimer les espaces blancs d'une chaîne ?
**Réponse :** `$str = str_replace(' ', '', $str);` ou `$str = preg_replace('/\s+/', '', $str);`

---

### 12. Quelle est la différence entre break et continue dans une boucle ?
**Réponse :** `break` arrête la boucle complètement, `continue` passe à l'itération suivante.

---

### 13. Comment cloner un objet en PHP ?
**Réponse :** `$copie = clone $obj;`

---

### 14. Que produit implode(",", ["a","b","c"]) ?
**Réponse :** "a,b,c" (les éléments joints par le délimiteur)

---

### 15. Comment vérifier si une variable n'est pas définie ?
**Réponse :** `!isset($var)` ou `is_null($var)`

---

### 16. Écrire une fonction qui compte les voyelles dans une chaîne :
```php
<?php
function compterVoyelles($str) {
    return preg_match_all('/[aeiouAEIOU]/', $str);
}
echo compterVoyelles("Bonjour"); // 3
?>
```

---

## Partie III : Exercice

Implémentez une classe **Gestionnaire** avec les attributs publics : `$personnes`, `$notes`, `$moyennes`.

Méthodes à implémenter :
- **ajouter($nom, $notes)** : ajoute une personne avec ses notes (tableau)
- **moyenne($nom)** : retourne la moyenne de la personne
- **meilleursEtudiants($n)** : retourne les n meilleurs étudiants
- **audienceA($limite)** : retourne les étudiants avec moyenne >= limite, triés décroissant

Exemple d'utilisation :
```php
<?php
$g = new Gestionnaire();
$g->ajouter("Alice", [15, 18, 14]);     // moyennes: 15.67
$g->ajouter("Bob", [10, 12, 11]);       // moyennes: 11
$g->ajouter("Charlie", [18, 19, 20]);   // moyennes: 19
echo $g->moyenne("Alice") . "\n";       // 15.67
print_r($g->meilleursEtudiants(2));     // Charlie, Alice
print_r($g->audienceA(15));             // Charlie, Alice
?>
```

---

**Fin du sujet A**


