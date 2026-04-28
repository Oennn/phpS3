<?php
// ============= CLASSE BLOG =============
// Classe pour gérer les opérations CRUD (Create, Read, Update, Delete) sur les articles du blog
class Blog {
    // Propriété privée pour stocker la connexion à la base de données
    // Le $ avant le nom indique que c'est une variable d'instance
    private $conn;
    
    // ============= CONSTRUCTEUR =============
    // Constructeur appelé quand on crée une nouvelle instance de la classe
    // Paramètre: $connection (objet PDO contenant la connexion MySQL)
    public function __construct($connection) {
        // Stocker la connexion dans la propriété $conn
        // $this-> permet d'accéder aux propriétés/méthodes de la classe
        $this->conn = $connection;
    }
    
    // ============= MÉTHODE 1 : INSÉRER UN ARTICLE =============
    // Méthode pour créer un nouvel article dans la base de données
    // Paramètres: $title (titre) et $article (contenu)
    // Retour: true si succès, false si erreur
    public function insererArticle($title, $article) {
        // Vérifier si la connexion existe
        if ($this->conn === null) {
            // Pas de connexion, retourner false
            return false;
        }
        
        // Utiliser un bloc try-catch pour gérer les erreurs
        try {
            // Requête SQL INSERT avec des placeholders (?) pour éviter les injections SQL
            $sql = "INSERT INTO blog (title, article) VALUES (?, ?)";
            // Préparer la requête (compilation/validation)
            $stmt = $this->conn->prepare($sql);
            // Exécuter la requête en passant les paramètres
            // Les ? sont remplacés par les valeurs dans le tableau
            return $stmt->execute([$title, $article]);
        } catch (PDOException $e) {
            // Si une erreur PDO se produit, l'afficher
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            // Retourner false en cas d'erreur
            return false;
        }
    }
    
    // ============= MÉTHODE 2 : OBTENIR TOUS LES ARTICLES =============
    // Méthode pour récupérer tous les articles de la base de données
    // Paramètres: aucun
    // Retour: tableau avec tous les articles (ou [] si erreur)
    public function obtenirArticles() {
        // Vérifier si la connexion existe
        if ($this->conn === null) {
            // Pas de connexion, retourner un tableau vide
            return [];
        }
        
        try {
            // Requête SQL SELECT pour récupérer tous les articles
            // ORDER BY created DESC: trier par date de création (plus récent d'abord)
            $sql = "SELECT article_id, title, article, created, updated FROM blog ORDER BY created DESC";
            // Préparer la requête
            $stmt = $this->conn->prepare($sql);
            // Exécuter la requête (pas de paramètres cette fois)
            $stmt->execute();
            // Récupérer tous les résultats sous forme de tableau associatif
            // PDO::FETCH_ASSOC: retourne des arrays avec clés = noms de colonnes
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Si une erreur se produit, l'afficher
            echo "Erreur lors de la récupération : " . $e->getMessage();
            // Retourner un tableau vide en cas d'erreur
            return [];
        }
    }
    
    // ============= MÉTHODE 3 : OBTENIR LES N DERNIERS ARTICLES =============
    // Méthode pour récupérer un nombre limité des articles les plus récents
    // Paramètres: $limite (nombre d'articles à retourner, défaut 5)
    // Retour: tableau avec les N derniers articles (ou [] si erreur)
    public function obtenirDerniersArticles($limite = 5) {
        // Vérifier si la connexion existe
        if ($this->conn === null) {
            // Pas de connexion, retourner un tableau vide
            return [];
        }
        
        try {
            // Requête SQL SELECT avec LIMIT pour limiter le nombre de résultats
            $sql = "SELECT article_id, title, article, created, updated FROM blog ORDER BY created DESC LIMIT ?";
            // Préparer la requête
            $stmt = $this->conn->prepare($sql);
            // Lier le paramètre LIMIT à la limite (? sera remplacé par 5)
            // bindValue(position, valeur, type_de_donnée)
            // position 1 = le premier ? de la requête
            // PDO::PARAM_INT = forcer le type entier
            $stmt->bindValue(1, $limite, PDO::PARAM_INT);
            // Exécuter la requête
            $stmt->execute();
            // Récupérer tous les résultats sous forme de tableau associatif
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Si une erreur se produit, l'afficher
            echo "Erreur lors de la récupération : " . $e->getMessage();
            // Retourner un tableau vide en cas d'erreur
            return [];
        }
    }
    
    // ============= MÉTHODE 4 : OBTENIR UN ARTICLE PAR ID =============
    // Méthode pour récupérer un seul article spécifique par son ID
    // Paramètres: $id (l'ID de l'article)
    // Retour: tableau associatif avec les données de l'article ou null
    public function obtenirArticleById($id) {
        // Vérifier si la connexion existe
        if ($this->conn === null) {
            // Pas de connexion, retourner null
            return null;
        }
        
        try {
            // Requête SQL SELECT avec WHERE pour filtrer par ID
            // L'ID est un entier unique, donc il ne peut y avoir qu'un résultat
            $sql = "SELECT article_id, title, article, created, updated FROM blog WHERE article_id = ?";
            // Préparer la requête
            $stmt = $this->conn->prepare($sql);
            // Exécuter la requête en passant l'ID
            $stmt->execute([$id]);
            // fetch() retourne une seule ligne (pas fetchAll)
            // Retourne null si aucun résultat n'est trouvé
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Si une erreur se produit, l'afficher
            echo "Erreur lors de la récupération : " . $e->getMessage();
            // Retourner null en cas d'erreur
            return null;
        }
    }
    
    // ============= MÉTHODE 5 : METTRE À JOUR UN ARTICLE =============
    // Méthode pour modifier un article existant
    // Paramètres: $id (ID de l'article), $title (nouveau titre), $article (nouveau contenu)
    // Retour: true si succès, false si erreur
    public function mettreAJourArticle($id, $title, $article) {
        // Vérifier si la connexion existe
        if ($this->conn === null) {
            // Pas de connexion, retourner false
            return false;
        }
        
        try {
            // Requête SQL UPDATE pour modifier les colonnes title et article
            // SET: spécifie les colonnes à modifier et les nouvelles valeurs
            // WHERE article_id = ?: ne modifier que l'article avec cet ID
            // NOTE: Les colonnes "created" et "updated" sont gérées automatiquement par MySQL
            $sql = "UPDATE blog SET title = ?, article = ? WHERE article_id = ?";
            // Préparer la requête
            $stmt = $this->conn->prepare($sql);
            // Exécuter la requête en passant les paramètres dans l'ordre
            // ? 1 = title, ? 2 = article, ? 3 = article_id
            return $stmt->execute([$title, $article, $id]);
        } catch (PDOException $e) {
            // Si une erreur se produit, l'afficher
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
            // Retourner false en cas d'erreur
            return false;
        }
    }
    
    // ============= MÉTHODE 6 : SUPPRIMER UN ARTICLE =============
    // Méthode pour supprimer un article de la base de données
    // Paramètres: $id (ID de l'article à supprimer)
    // Retour: true si succès, false si erreur
    public function supprimerArticle($id) {
        // Vérifier si la connexion existe
        if ($this->conn === null) {
            // Pas de connexion, retourner false
            return false;
        }
        
        try {
            // Requête SQL DELETE pour supprimer une ligne
            // WHERE article_id = ?: ne supprimer que l'article avec cet ID
            // ATTENTION: Le DELETE est permanent, pas d'annulation !
            $sql = "DELETE FROM blog WHERE article_id = ?";
            // Préparer la requête
            $stmt = $this->conn->prepare($sql);
            // Exécuter la requête en passant l'ID
            return $stmt->execute([$id]);
        } catch (PDOException $e) {
            // Si une erreur se produit, l'afficher
            echo "Erreur lors de la suppression : " . $e->getMessage();
            // Retourner false en cas d'erreur
            return false;
        }
    }
}

// ============= FIN DE LA CLASSE =============
?>
