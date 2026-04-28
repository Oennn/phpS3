# Examen Web 3 - Sujet D

**Programmation Web 3 - SINFL4A1**  
**L1 Informatique - UCN – 2ème Semestre**  
**Durée de l'épreuve : 1 h**  
**Date : 30/4/2025**

---

## Partie I : QCM (20 questions)

### 1. Que retourne basename("/path/to/file.txt") ?
A. "/path/to/"  
B. "file.txt"  
C. "/path/to"  
D. "file"  

---

### 2. Quel est le rôle de password_hash() ?
A. Créer un hash MD5  
B. Hasher de manière sécurisée avec salt  
C. Chiffrer une chaîne  
D. Encoder en base64  

---

### 3. Comment vérifier un hash de mot de passe ?
A. `$hash === password_hash($pwd)`  
B. `password_verify($pwd, $hash)`  
C. `md5($pwd) === $hash`  
D. `compare($pwd, $hash)`  

---

### 4. Que produit le code suivant ?
```php
<?php
$arr = [1 => "a", 0 => "b"];
ksort($arr);
var_dump($arr);
?>
```
A. [1 => "a", 0 => "b"]  
B. [0 => "b", 1 => "a"]  
C. ["b", "a"]  
D. Erreur  

---

### 5. Quel est le résultat de ceil(4.3) ?
A. 4.0  
B. 4  
C. 5  
D. 4.3  

---

### 6. Comment créer un générateur simple ?
A. Avec for + yield  
B. Avec function() => {}  
C. Avec generator()  
D. Impossible  

---

### 7. Que retourne floatval("3.14abc") ?
A. 3.14  
B. "3.14abc"  
C. 3  
D. Erreur  

---

### 8. Comment vérifier qu'un fichier existe ?
A. `is_file($path)`  
B. `file_exists($path)`  
C. Les deux  
D. Aucune  

---

### 9. Que produit ucfirst("test") ?
A. "Test"  
B. "TEST"  
C. "test"  
D. "tEST"  

---

### 10. Quelle est la différence entre $GLOBALS et global $var ?
A. Pas de différence  
B. $GLOBALS accède à tous, global déclare une variable spécifique  
C. global est plus rapide  
D. $GLOBALS est PHP 5 uniquement  

---

### 11. Que fait array_intersect() ?
A. Retourne les clés communes  
B. Retourne les valeurs communes  
C. Fusionne les tableaux  
D. Compare les tailles  

---

### 12. Comment obtenir le dernier élément d'un tableau fixe ?
A. `$arr[count($arr) - 1]`  
B. `$arr[-1]`  
C. `$arr[end($arr)]`  
D. `array_pop($arr)`  

---

### 13. Quel est le type de DateInterval en PHP ?
A. class  
B. interface  
C. trait  
D. function  

---

### 14. Que produit le code suivant ?
```php
<?php
$a = "5";
$b = 5;
var_dump($a == $b);
?>
```
A. bool(false)  
B. bool(true)  
C. string("5")  
D. int(5)  

---

### 15. Comment créer une constante avec PHP 8.1+ ?
A. `const CONST = "value"`  
B. `define('CONST', 'value')`  
C. `public CONST = "value"`  
D. `static CONST = "value"`  

---

### 16. Que retourne feof($handle) ?
A. Retourne true si fin du fichier  
B. Ferme le fichier  
C. Retourne le contenu  
D. Vérifie l'existence  

---

### 17. Quel est le résultat de str_pad("5", 3, "0", STR_PAD_LEFT) ?
A. "5"  
B. "005"  
C. "500"  
D. "50"  

---

### 18. Comment créer un closure qui accède aux variables externes ?
A. `$f = function() use ($x) { ... }`  
B. `$f = fn() => $x`  
C. Les deux  
D. Impossible  

---

### 19. Que produit array_rand() ?
A. Une clé aléatoire (ou tableau de clés)  
B. Une valeur aléatoire  
C. Mélange le tableau  
D. Retourne 0 ou 1  

---

### 20. Comment vérifier le type MIME d'un fichier ?
A. `mime_content_type()` (dépréciée)  
B. `finfo_file()`  
C. `pathinfo()`  
D. `stat()`

---

## Partie II : Réponse en une ligne

### 1. Comment convertir un tableau en objet ?
**Réponse :** `(object) $array;`

---

### 2. Que retourne preg_split() ?
**Réponse :** Un tableau contenant les chaînes divisées selon le motif regex.

---

### 3. Comment accéder à une propriété dynamique d'un objet ?
**Réponse :** `$obj->$propName` ou `$obj->{$propName}`

---

### 4. Quel est le rôle de stripslashes() ?
**Réponse :** Supprime les antislashes échappés (contraire de addslashes()).

---

### 5. Comment créer une fonction variable en PHP ?
**Réponse :** `$func = 'strlen'; echo $func("test");` (4)

---

### 6. Que signifie NaN en PHP ?
**Réponse :** "Not a Number" - une valeur float invalide due à opération mathématique.

---

### 7. Comment déboguer avec xdebug ?
**Réponse :** Installer xdebug, configurer php.ini, utiliser IDE ou var_dump().

---

### 8. Comment vérifier si une méthode statique existe ?
**Réponse :** `method_exists('ClassName', 'methodName')`

---

### 9. Que retourne abs(-5) ?
**Réponse :** 5 (valeur absolue)

---

### 10. Comment supprimer le cache d'opcache ?
**Réponse :** `opcache_reset();` ou redémarrer PHP-FPM.

---

### 11. Comment vérifier si deux objets sont identiques ?
**Réponse :** `$obj1 === $obj2` (même instance)

---

### 12. Quel est le rôle de get_defined_vars() ?
**Réponse :** Retourne un tableau associatif de toutes les variables définies.

---

### 13. Comment convertir une chaîne en type booléen ?
**Réponse :** `(bool) $str;` ou `boolval($str);`

---

### 14. Que signifie INF en PHP ?
**Réponse :** Infini (Infinity) - résultat d'une opération mathématique infinie.

---

### 15. Comment vérifier que toutes les clés existent dans un tableau ?
**Réponse :** `count(array_intersect_key(array_flip($clés), $tableau)) === count($clés)`

---

### 16. Implémenter une fonction qui double chaque élément :
```php
<?php
$arr = [1, 2, 3];
$doubled = array_map(function($x) { return $x * 2; }, $arr);
print_r($doubled); // [2, 4, 6]
?>
```

---

## Partie III : Exercice

Implémentez une classe **Panier** avec les attributs publics : `$articles`, `$prix_unitaire`, `$quantites`.

Méthodes à implémenter :
- **ajouterArticle($nom, $prix, $qte)** : ajoute un article au panier
- **retirer($nom)** : supprime un article entièrement
- **ajusterQte($nom, $qte)** : modifie la quantité
- **total()** : calcule le total TTC (20% TVA)
- **resume()** : affiche le détail de chaque article avec HT, TVA, TTC

Exemple d'utilisation :
```php
<?php
$panier = new Panier();
$panier->ajouterArticle("Livre", 15.00, 2);      // 2×15€
$panier->ajouterArticle("Stylo", 2.50, 4);       // 4×2.50€
echo $panier->total() . "\n";                     // 54.00 (HT) + TVA
$panier->ajusterQte("Stylo", 2);                 // 2 stylos
echo $panier->total() . "\n";                     // Total mis à jour
$panier->resume();                                // Détails complets
?>
```

---

**Fin du sujet D**


