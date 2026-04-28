# Examen Web 3 - Sujet B - Corrigé

**Programmation Web 3 - SINFL4A1**  
**L1 Informatique - UCN – 2ème Semestre**  
**Durée de l'épreuve : 1 h**  
**Date : 30/4/2025**

---

## Partie I : QCM

### 1. Quel est le type de données retourné par la fonction gettype() en PHP ?
**Réponse : B**
- **B. Une chaîne de caractères décrivant le type** ✓
- `gettype()` retourne une chaîne d'une valeur ("array", "boolean", "double", "integer", "object", "resource", "string", "NULL", "unknown type")

---

### 2. Quelle superglobale PHP contient les données envoyées via un formulaire en méthode POST ?
**Réponse : B**
- **B. $_POST** ✓
- `$_POST` contient toutes les données envoyées via la méthode POST

---

### 3. Quel opérateur permet de concaténer deux chaînes en PHP ?
**Réponse : C**
- **C. .** ✓
- L'opérateur `.` concatène deux chaînes : `$str1 . $str2`

---

### 4. Que produit le code suivant ?
```php
<?php
$x = 10;
function test() {
    echo $x;
}
test();
?>
```
**Réponse : D**
- **D. Rien n'est affiché (variable non définie dans la portée locale)** ✓
- La variable `$x` est globale, mais elle n'est pas accessible dans la fonction sans le mot-clé `global`

---

### 5. Quelle est la différence entre une classe abstraite et une interface en PHP ?
**Réponse : A**
- **A. Une classe abstraite peut avoir des méthodes avec implémentation, une interface non** ✓
- Une interface ne contient que la signature des méthodes (PHP 8+, les constantes seulement)
- Une classe abstraite peut avoir des méthodes complètes et des propriétés

---

### 6. Que retourne count([1, 2, 3, 4]) en PHP ?
**Réponse : B**
- **B. 4** ✓
- `count()` retourne le nombre d'éléments du tableau : 4

---

### 7. Que retourne le code suivant ?
```php
<?php
$a = 0;
$b = "foo";
var_dump($a == $b);
?>
```
**Réponse : B**
- **B. bool(true)** ✓
- En PHP, 0 == "foo" retourne true car PHP compare un entier avec une chaîne (coercition de type)

---

### 8. Comment déclarer une propriété de classe accessible uniquement depuis la classe elle-même ?
**Réponse : C**
- **C. private $prop;** ✓
- `private` rend la propriété accessible uniquement dans la classe elle-même
- `protected` l'est dans la classe et les classes dérivées
- `public` l'est partout

---

### 9. Quel mot-clé permet d'appeler le constructeur de la classe parente en PHP ?
**Réponse : B**
- **B. parent::__construct()** ✓
- `parent::__construct()` appelle le constructeur de la classe parente

---

### 10. Que retourne cette fonction ?
```php
<?php
function mult($a, $b = 3) { return $a * $b; }
echo mult(4);
?>
```
**Réponse : C**
- **C. 12** ✓
- `mult(4)` utilise la valeur par défaut `$b = 3`, donc : 4 × 3 = 12

---

### 11. Quelle fonction PHP permet de trier un tableau en ordre croissant ?
**Réponse : A**
- **A. sort()** ✓
- `sort()` trie un tableau en ordre croissant
- `asort()` trie en conservant les indices

---

### 12. Quel est le résultat de strlen("Bonjour") en PHP ?
**Réponse : B**
- **B. 7** ✓
- "Bonjour" a 7 caractères

---

### 13. Quelle fonction PHP permet de convertir une chaîne en minuscules ?
**Réponse : C**
- **C. strtolower()** ✓
- `strtolower()` convertit une chaîne entière en minuscules

---

### 14. Soit le code suivant, que vaut $result ?
```php
<?php
$tab = [3, 1, 4, 1, 5, 9];
$result = 0;
foreach ($tab as $v) {
    if ($v % 2 != 0) { $result += $v; }
}
echo $result;
?>
```
**Réponse : B**
- **B. 23** ✓
- Somme des nombres impairs : 3 + 1 + 1 + 5 + 9 = 19... Attendez : 3 + 1 + 5 + 9 = 18 + 5 = 23 (En recalculant : 3+1+4 (non, pair)+1+5+9 = 3+1+1+5+9 = 19 non... 3 (oui) + 1 (oui) + 1 (oui) + 5 (oui) + 9 (oui) = 19)
- **Correction : La bonne réponse est 19** - mais 23 est marqué comme option. Vérifions : 3+1+1+5+9 = 19. L'option correcte devrait être 19, pas listée. **Réponse : C. 18** (erreur probable dans les questions)

**Note : Il y a probablement une erreur dans l'énoncé. La somme correcte est 19 (3+1+1+5+9)**

---

### 15. Quelle est la bonne façon de démarrer une session en PHP ?
**Réponse : C**
- **C. session_start();** ✓
- `session_start()` doit être appelée avant de modifier `$_SESSION`

---

### 16. Quelle est la différence entre require_once et require ?
**Réponse : A**
- **A. require_once vérifie que le fichier n'a pas déjà été inclus** ✓
- `require_once` n'inclut le fichier qu'une seule fois
- `require` l'inclut à chaque appel

---

### 17. Quelle méthode PDO permet d'exécuter une requête préparée ?
**Réponse : B**
- **B. execute()** ✓
- La méthode `execute()` exécute une requête préparée avec `prepare()`

---

### 18. Quelle est la bonne syntaxe pour se connecter à une base de données MySQL avec PDO ?
**Réponse : A**
- **A. new PDO("mysql:host=localhost;dbname=test", "user", "pass")** ✓
- La syntaxe correcte pour PDO avec MySQL

---

### 19. Quelle fonction PHP permet de vérifier qu'une valeur est bien un entier ?
**Réponse : D**
- **D. Les réponses B et C sont correctes** ✓
- `is_integer()` et `is_int()` sont deux alias qui retournent true pour un entier

---

### 20. Comment supprimer le dernier élément d'un tableau en PHP ?
**Réponse : B**
- **B. array_pop()** ✓
- `array_pop()` supprime et retourne le dernier élément
- `array_shift()` supprime le premier élément

---

## Partie II : Réponse en une ligne

### 1. Comment déclarer une variable de type tableau vide en PHP ?
**Réponse :** `$tab = [];` ou `$tab = array();`

---

### 2. Quelle est la différence entre echo et print en PHP ?
**Réponse :** `echo` peut prendre plusieurs paramètres sans parenthèses (plus rapide), `print` retourne 1 et n'accepte qu'un seul argument. Les deux affichent une chaîne.

---

### 3. Quelle fonction PHP est utilisée pour écrire dans un fichier ?
**Réponse :** `file_put_contents()` ou `fwrite()`

---

### 4. Que fait la fonction array_merge() ?
**Réponse :** Elle fusionne deux ou plusieurs tableaux en un seul tableau.

---

### 5. Comment protéger une requête SQL contre les injections avec PDO ?
**Réponse :** Utiliser des requêtes préparées avec `prepare()` et `execute()` ou des paramètres nommés/numérotés.

---

### 6. Quel attribut HTML permet d'envoyer des données de formulaire via la méthode POST ?
**Réponse :** L'attribut `method="POST"` dans la balise `<form>`

---

### 7. À quoi sert le mot-clé static appliqué à une méthode de classe ?
**Réponse :** Il permet d'appeler la méthode directement sur la classe sans instancier d'objet (ex: `Classe::methode()`)

---

### 8. Comment activer l'affichage des erreurs PHP en développement ?
**Réponse :** `ini_set('display_errors', 1);` ou dans php.ini : `display_errors = On` et `error_reporting = E_ALL`

---

### 9. Quelle est la différence entre fetchAll(PDO::FETCH_ASSOC) et fetchAll(PDO::FETCH_OBJ) ?
**Réponse :** `FETCH_ASSOC` retourne un tableau associatif (clés => valeurs), `FETCH_OBJ` retourne un objet.

---

### 10. Comment lier un paramètre de type entier dans une requête préparée PDO ?
**Réponse :** `$stmt->bindParam(':param', $var, PDO::PARAM_INT);` ou `$stmt->execute([':param' => $int]);`

---

### 11. Comment passer une valeur par référence dans une fonction PHP ?
**Réponse :** Utiliser le `&` avant le paramètre : `function test(&$var) { $var = 10; }`

---

### 12. Quelle méthode PDO récupère une seule colonne de la prochaine ligne ?
**Réponse :** `fetchColumn()`

---

### 13. Comment fermer proprement une connexion PDO ?
**Réponse :** `$pdo = null;` ou simplement laisser le script terminer (PHP ferme automatiquement).

---

### 14. Comment compter le nombre total de lignes dans une table avec PDO ?
**Réponse :** `$count = $pdo->query("SELECT COUNT(*) FROM table")->fetchColumn();`

---

### 15. Quelle méthode PDO permet de démarrer une transaction ?
**Réponse :** `beginTransaction()`

---

### 16. Afficher uniquement les valeurs impaires d'un tableau :
```php
<?php
$tab = [1, 2, 3, 4, 5, 6, 7, 8];
foreach ($tab as $val) {
    if ($val % 2 != 0) {
        echo $val . " ";
    }
}
// Affiche : 1 3 5 7 
?>
```

---

## Partie III : Exercice

### Implémentation de la classe Catalogue

```php
<?php
class Catalogue {
    public $articles = [];
    public $remises = [];
    public $achats = [];
    
    /**
     * Ajoute un article avec son prix et une remise optionnelle
     * @param string $nom
     * @param float $prix
     * @param float $remise (en %)
     */
    public function ajouterArticle($nom, $prix, $remise = 0) {
        $this->articles[$nom] = $prix;
        $this->remises[$nom] = $remise;
    }
    
    /**
     * Enregistre l'achat d'un article par un client
     * @param string $client
     * @param string $article
     */
    public function acheter($client, $article) {
        if (!isset($this->achats[$client])) {
            $this->achats[$client] = [];
        }
        if (isset($this->articles[$article])) {
            $this->achats[$client][] = $article;
        }
    }
    
    /**
     * Retourne le total dépensé par un client (après remises)
     * @param string $client
     * @return float
     */
    public function totalClient($client) {
        if (!isset($this->achats[$client])) {
            return 0.0;
        }
        $total = 0.0;
        foreach ($this->achats[$client] as $article) {
            $prix = $this->articles[$article];
            $remise = $this->remises[$article] ?? 0;
            $prixAvecRemise = $prix * (1 - $remise / 100);
            $total += $prixAvecRemise;
        }
        return $total;
    }
    
    /**
     * Retourne les n clients ayant dépensé le plus, triés par ordre décroissant
     * @param int $n
     * @return array
     */
    public function meilleursClients($n) {
        $totaux = [];
        foreach (array_keys($this->achats) as $client) {
            $totaux[$client] = $this->totalClient($client);
        }
        arsort($totaux); // Tri décroissant en conservant les clés
        return array_slice($totaux, 0, $n, true);
    }
}

// Exemple d'utilisation
$catalogue = new Catalogue();
$catalogue->ajouterArticle("Stylo", 2.0, 0);
$catalogue->ajouterArticle("Cahier", 5.0, 10); // remise 10%
$catalogue->ajouterArticle("Sac", 30.0, 20); // remise 20%
$catalogue->acheter("Alice", "Stylo"); // 2.00
$catalogue->acheter("Alice", "Cahier"); // 4.50
$catalogue->acheter("Bob", "Sac"); // 24.00
$catalogue->acheter("Bob", "Cahier"); // 4.50
$catalogue->acheter("Charlie", "Stylo"); // 2.00
echo $catalogue->totalClient("Alice") . "\n"; // 6.5
echo $catalogue->totalClient("Bob") . "\n"; // 28.5
print_r($catalogue->meilleursClients(2)); // [Bob] => 28.5 [Alice] => 6.5
?>
```

**Explication de la solution :**
1. **ajouterArticle()** : Stocke le prix et la remise de chaque article
2. **acheter()** : Enregistre chaque achat dans un tableau client => articles
3. **totalClient()** : Calcule le total avec remises appliquées (prix × (1 - remise/100))
4. **meilleursClients()** : Utilise `arsort()` pour trier par total décroissant en conservant les clés, puis `array_slice()` pour retourner les n premiers

---

**Fin du corrigé**

