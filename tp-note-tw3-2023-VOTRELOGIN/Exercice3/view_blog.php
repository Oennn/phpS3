<?php
// ============= INCLUSION DES FICHIERS NÉCESSAIRES =============
// Inclure le fichier connection.php qui contient la fonction dbConnect()
require_once 'connection.php';
// Inclure le fichier Blog.php qui contient la classe Blog
require_once 'Blog.php';

// ============= INITIALISATION =============
// Créer une connexion à la base de données
$conn = dbConnect();
// Créer une instance de la classe Blog
$blog = new Blog($conn);
// Initialiser la variable $error pour stocker les messages d'erreur
$error = '';
// Initialiser la variable $article à null
$article = null;

// ============= RÉCUPÉRATION ET VALIDATION DE L'ID =============
// Vérifier si le paramètre "id" a été fourni dans l'URL (GET)
if (isset($_GET['id'])) {
    // Récupérer la valeur de l'ID depuis l'URL
    $id = $_GET['id'];

    // ========== VALIDATION DE L'ID ==========
    // Vérifier que l'ID est un nombre
    if (!is_numeric($id)) {
        // Si ce n'est pas un nombre, enregistrer une erreur
        $error = 'ID invalide.';
    } else {
        // ========== RÉCUPÉRATION DE L'ARTICLE ==========
        // Appeler la méthode obtenirArticleById() pour récupérer l'article
        $article = $blog->obtenirArticleById($id);

        // Vérifier si l'article a été trouvé
        if ($article === null) {
            // L'article n'existe pas, enregistrer une erreur
            $error = 'Article non trouvé.';
        }
    }
} else {
    // Si l'ID n'a pas été fourni dans l'URL
    $error = 'Aucun ID fourni.';
}
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Voir un article du blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            max-width: 800px;
        }
        .article {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            margin: 20px 0;
        }
        .article h2 {
            margin-top: 0;
            color: #333;
        }
        .meta {
            color: #666;
            font-size: 14px;
            margin-bottom: 15px;
        }
        .content {
            line-height: 1.6;
            color: #333;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
        .actions {
            margin-top: 20px;
        }
        a {
            display: inline-block;
            margin-right: 15px;
            padding: 10px 15px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 4px;
        }
        a:hover {
            background-color: #0056b3;
        }
        .edit {
            background-color: #28a745;
        }
        .edit:hover {
            background-color: #218838;
        }
        .delete {
            background-color: #dc3545;
        }
        .delete:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
<h1>Voir un article du blog</h1>

<?php if (!empty($error)): ?>
    <p class="error">Erreur : <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if ($article !== null): ?>
    <div class="article">
        <h2><?php echo htmlspecialchars($article['title']); ?></h2>
        <div class="meta">
            <p>
                <strong>Créé le :</strong> <?php echo htmlspecialchars($article['created']); ?><br>
                <strong>Mis à jour le :</strong> <?php echo htmlspecialchars($article['updated']); ?>
            </p>
        </div>
        <div class="content">
            <?php echo nl2br(htmlspecialchars($article['article'])); ?>
        </div>
    </div>

    <div class="actions">
        <a href="update_blog.php?id=<?php echo $article['article_id']; ?>" class="edit">ÉDITER</a>
        <a href="supprimer_blog.php?id=<?php echo $article['article_id']; ?>" class="delete" onclick="return confirm('Êtes-vous sûr?');">SUPPRIMER</a>
        <a href="index.php">Retour à la liste</a>
    </div>
<?php endif; ?>

</body>
</html>


