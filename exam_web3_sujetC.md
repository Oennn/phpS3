# Examen Web 3 - Sujet C

**Programmation Web 3 - SINFL4A1**  
**L1 Informatique - UCN – 2ème Semestre**  
**Durée de l'épreuve : 1 h**  
**Date : 30/4/2025**

---

## Partie I : QCM (20 questions)

### 1. Quel est le résultat de $arr[] = "valeur" ?
A. Erreur de syntaxe  
B. Ajoute "valeur" à la fin du tableau  
C. Remplace le premier élément  
D. Retourne false  

---

### 2. Que retourne is_callable("strlen") ?
A. false  
B. true  
C. string("strlen")  
D. Erreur  

---

### 3. Comment créer une constante de classe en PHP ?
A. `$this->CONST = "valeur"`  
B. `const CONST = "valeur"`  
C. `define('CONST', 'valeur')`  
D. `static CONST = "valeur"`  

---

### 4. Que produit le code suivant ?
```php
<?php
$a = [1, 2];
$b = $a;
$b[0] = 99;
echo $a[0];
?>
```
A. 1  
B. 99  
C. null  
D. Erreur  

---

### 5. Quel est le rôle de la fonction callable() ?
A. Appeler une fonction  
B. Vérifier si une variable peut être appelée comme fonction  
C. Créer une fonction  
D. Valider un argument  

---

### 6. Que retourne round(2.567, 2) ?
A. 2.56  
B. 2.57  
C. 2.6  
D. 3  

---

### 7. Comment obtenir le nombre de paramètres d'une fonction avec ReflectionFunction ?
A. `$r->getNumberOfParameters()`  
B. `$r->getParameters()`  
C. `$r->countParams()`  
D. `count($r->params)`  

---

### 8. Que retourne isset($var) si $var = null ?
A. true  
B. false  
C. null  
D. Erreur  

---

### 9. Quel est le résultat de random_int(1, 10) ?
A. Un nombre aléatoire entre 1 et 10 (inclus)  
B. Entre 0 et 10  
C. Toujours 5  
D. Un float  

---

### 10. Comment vérifier qu'une classe implémente une interface ?
A. `instanceof Interface`  
B. `$obj instanceof Interface`  
C. `is_interface($obj)`  
D. `class_implements($obj)`  

---

### 11. Que produit extract(["c"=>3, "d"=>4]) ?
A. Crée les variables $c et $d  
B. Retourne ["c", "d"]  
C. Fusionne avec $GLOBALS  
D. Retourne 2  

---

### 12. Quel est le résultat de date("Y-m-d") ?
A. Année-mois-jour au format string  
B. Un timestamp  
C. Un objet DateTime  
D. Erreur  

---

### 13. Comment accéder à la méthode magique __call() ?
A. En appelant une méthode qui n'existe pas  
B. Directement via __call()  
C. Via call()  
D. Impossible  

---

### 14. Que retourne le code suivant ?
```php
<?php
$obj = (object) ["name" => "test"];
echo $obj->name;
?>
```
A. test  
B. Erreur  
C. ["name" => "test"]  
D. null  

---

### 15. Comment lister tous les fichiers d'un dossier ?
A. `scandir("./")`  
B. `readdir("./")`  
C. `listdir("./")`  
D. `getdir("./")`  

---

### 16. Quel est le type du résultat de file_get_contents() ?
A. bool  
B. string  
C. array  
D. object  

---

### 17. Comment comparer deux objets en PHP ?
A. `$obj1 == $obj2` (valeurs égales)  
B. `$obj1 === $obj2` (même instance)  
C. Impossible  
D. A et B  

---

### 18. Que retourne array_values() ?
A. Les clés du tableau  
B. Les valeurs avec clés numériques (0, 1, 2...)  
C. Les clés et valeurs  
D. false  

---

### 19. Comment utiliser le splat operator (...) ?
A. `function test(...$args)` pour un nombre variable d'arguments  
B. Pour multiplier  
C. Pour répéter  
D. Impossible  

---

### 20. Que produit usort() ?
A. Trie un tableau en place  
B. Retourne un nouveau tableau trié  
C. Retourne true/false  
D. Supprime les doublons

---

## Partie II : Réponse en une ligne

### 1. Comment créer une URL-safe base64 encoding ?
**Réponse :** `str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($data));`

---

### 2. Quel est le rôle du mot-clé `use` dans une classe ?
**Réponse :** Il importe des traits ou des espaces de noms (namespaces).

---

### 3. Comment obtenir l'heure actuelle au format timestamp Unix ?
**Réponse :** `time()` ou `strtotime('now')`

---

### 4. Que retourne array_column() ?
**Réponse :** Extrait une colonne spécifique d'un tableau multidimensionnel.

---

### 5. Comment vérifier la capacité d'une variable à être sérialisée ?
**Réponse :** `serialize($var)` retourne une chaîne sérialisée, ou tester `is_object()`, `is_array()`

---

### 6. Quel est le formato complet pour un timestamp formaté ?
**Réponse :** `date('Y-m-d H:i:s', time())` ou `date('Y-m-d H:i:s')`

---

### 7. Comment empêcher la modification d'une propriété d'objet ?
**Réponse :** `private` accès contrôlé, `readonly` propriété (PHP 8.1+), ou `__set()` magique

---

### 8. Que signifie `->` en PHP ?
**Réponse :** Accède à une propriété ou méthode d'un objet (non-statique).

---

### 9. Comment faire un décalage de tableau circulaire (rotate) ?
**Réponse :** `$rotated = array_merge(array_slice($arr, 1), array_slice($arr, 0, 1));`

---

### 10. Quel est le résultat de `microtime(true)` ?
**Réponse :** Un float représentant le temps en microsecondes avec précision.

---

### 11. Comment nettoyer tous les espaces blancs (y compris tabs, newlines) ?
**Réponse :** `preg_replace('/\s+/', '', $str);`

---

### 12. Que retourne `get_class($obj)` ?
**Réponse :** Le nom de la classe de l'objet en tant que chaîne.

---

### 13. Comment créer un tableau avec les clés d'un autre ?
**Réponse :** `array_flip($original)` (inverse clés/valeurs) ou `array_fill_keys(array_keys($arr), null)`

---

### 14. Quel est le type de `null` ?
**Réponse :** "NULL" (type null en PHP)

---

### 15. Comment vérifier qu'une chaîne ne contient que des chiffres ?
**Réponse :** `ctype_digit($str)` ou `preg_match('/^\d+$/', $str)`

---

### 16. Filtrer un tableau pour ne garder que les valeurs > 5 :
```php
<?php
$tab = [1, 3, 6, 8, 2, 9];
$filtered = array_filter($tab, function($v) { return $v > 5; });
print_r($filtered); // [6, 8, 9]
?>
```

---

## Partie III : Exercice

Implémentez une classe **Bibliothèque** avec les attributs publics : `$livres`, `$emprunts`, `$historique`.

Méthodes à implémenter :
- **ajouterLivre($titre, $auteur, $quantite)** : ajoute un livre au catalogue
- **emprunter($usager, $titre)** : enregistre un emprunt (décrémenter quantité)
- **restituer($usager, $titre)** : restitue un livre (incrémenter quantité)
- **livresEmpruntesBy($usager)** : retourne les livres empruntés par un usager
- **inventaire()** : retourne l'état des stocks (titre => quantité)

Exemple d'utilisation :
```php
<?php
$bibli = new Bibliothèque();
$bibli->ajouterLivre("PHP Guide", "John", 3);
$bibli->ajouterLivre("Web Dev", "Jane", 2);
$bibli->emprunter("Alice", "PHP Guide");     // 2 exemplaires restants
$bibli->emprunter("Bob", "PHP Guide");       // 1 restant
$bibli->restituer("Alice", "PHP Guide");     // 2 restants
print_r($bibli->inventaire());               // ["PHP Guide" => 2, "Web Dev" => 2]
print_r($bibli->livresEmpruntesBy("Bob"));   // ["PHP Guide"]
?>
```

---

**Fin du sujet C**


