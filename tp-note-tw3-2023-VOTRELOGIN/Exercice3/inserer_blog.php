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

// ============= TRAITEMENT DU FORMULAIRE =============
// Vérifier si le formulaire a été soumis avec la méthode POST et le bouton insert
// $_SERVER['REQUEST_METHOD'] === 'POST': la page a été accédée par un formulaire POST
// isset($_POST['insert']): le bouton "submit" nommé "insert" a été cliqué
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['insert'])) {
    // Récupérer le titre du formulaire
    // isset() vérifie que le champ existe
    // trim() supprime les espaces au début et fin
    $title = isset($_POST['title']) ? trim($_POST['title']) : '';
    // Récupérer le contenu de l'article du formulaire
    $article = isset($_POST['article']) ? trim($_POST['article']) : '';

    // ========== VALIDATION ==========
    // Vérifier que le titre et l'article ne sont pas vides
    if (empty($title) || empty($article)) {
        // Si vide, enregistrer le message d'erreur
        $error = 'Le titre et l\'article ne peuvent pas être vides.';
    } else {
        // ========== INSERTION EN BASE DE DONNÉES ==========
        // Appeler la méthode insererArticle() de l'instance Blog
        // Passer le titre et l'article en paramètres
        if ($blog->insererArticle($title, $article)) {
            // Si l'insertion a réussi (retour true)
            $success = 'Article inséré avec succès !';
            // Rediriger l'utilisateur vers index.php après 2 secondes
            // Cela affiche le message de succès pendant 2 secondes, puis redirige
            header("Refresh: 2; url=index.php");
        } else {
            // Si l'insertion a échoué (retour false)
            $error = 'Erreur lors de l\'insertion de l\'article.';
        }
    }
}
?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Insérer une nouvelle entrée de blog</title>
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
<h1>Insérer une nouvelle entrée de blog</h1>
<?php if (!empty($error)): ?>
    <p class="error">Erreur : <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>
<?php if (!empty($success)): ?>
    <p class="success"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<form method="post" action="">
    <p>
        <label for="title">Titre :</label>
        <input name="title" type="text" id="title" value="<?php echo isset($_POST['title']) ? htmlspecialchars($_POST['title']) : ''; ?>">
    </p>
    <p>
        <label for="article">Article :</label>
        <textarea name="article" id="article"><?php echo isset($_POST['article']) ? htmlspecialchars($_POST['article']) : ''; ?></textarea>
    </p>
    <p>
        <input type="submit" name="insert" value="Insérer une nouvelle entrée" id="insert">
    </p>
</form>

<a href="index.php">Retour à la liste des articles</a>
</body>
</html>
