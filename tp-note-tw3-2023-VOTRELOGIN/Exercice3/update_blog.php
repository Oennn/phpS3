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
// Initialiser la variable $success pour stocker les messages de succès
$success = '';
// Initialiser la variable $article à null
$article = null;

// ============= RÉCUPÉRATION ET VALIDATION DE L'ID (PAGE INITIAL) =============
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

// ============= TRAITEMENT DE LA MISE À JOUR (ENVOI DU FORMULAIRE) =============
// Vérifier si le formulaire a été soumis avec la méthode POST et le bouton update
// && $article !== null: vérifier que l'article a bien été chargé
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update']) && $article !== null) {
    // Récupérer l'ID du formulaire caché (pour éviter de modifier l'ID)
    $id = $_POST['id'];
    // Récupérer le titre du formulaire
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    // Récupérer le contenu de l'article du formulaire
    // Utiliser une variable différente pour ne pas écraser $article
    $article_content = isset($_POST['article']) ? trim($_POST['article']) : '';

    // ========== VALIDATION ==========
    // Vérifier que le titre et l'article ne sont pas vides
    if (empty($title) || empty($article_content)) {
        // Si vide, enregistrer le message d'erreur
        $error = 'Le titre et l\'article ne peuvent pas être vides.';
    } else {
        // ========== MISE À JOUR EN BASE DE DONNÉES ==========
        // Appeler la méthode mettreAJourArticle() de la classe Blog
        if ($blog->mettreAJourArticle($id, $title, $article_content)) {
            // Si la mise à jour a réussi
            $success = 'Article mis à jour avec succès !';
            // Rediriger l'utilisateur vers index.php après 2 secondes
            header("Refresh: 2; url=index.php");
        } else {
            // Si la mise à jour a échoué
            $error = 'Erreur lors de la mise à jour de l\'article.';
        }
    }
}
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Éditer une entrée de blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 600px;
        }
        label {
            display: block;
            margin-top: 10px;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            font-family: Arial, sans-serif;
            box-sizing: border-box;
        }
        textarea {
            height: 300px;
            resize: vertical;
        }
        input[type="submit"] {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }
        input[type="submit"]:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
        .success {
            color: green;
            margin: 10px 0;
        }
        a {
            display: block;
            margin-top: 15px;
            color: #007bff;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
<h1>Éditer une entrée de blog</h1>

<?php if (!empty($error)): ?>
    <p class="error">Erreur : <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p class="success"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<?php if ($article !== null): ?>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($article['article_id']); ?>">

        <p>
            <label for="title">Titre :</label>
            <input name="title" type="text" id="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : htmlspecialchars($article['title']); ?>">
        </p>

        <p>
            <label for="article">Article :</label>
            <textarea name="article" id="article"><?php echo isset($_POST['article']) ? htmlspecialchars($_POST['article']) : htmlspecialchars($article['article']); ?></textarea>
        </p>

        <p>
            <strong>Créé le :</strong> <?php echo htmlspecialchars($article['created']); ?><br>
            <strong>Mis à jour le :</strong> <?php echo htmlspecialchars($article['updated']); ?>
        </p>

        <p>
            <input type="submit" name="update" value="Mettre à jour l'article" id="update">
        </p>
    </form>
<?php endif; ?>

<a href="index.php">Retour à la liste des articles</a>
</body>
</html>
