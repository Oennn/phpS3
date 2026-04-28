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
// Initialiser la variable $article à null (elle contiendra les données de l'article si trouvé)
$article = null;

// ============= RÉCUPÉRATION ET VALIDATION DE L'ID =============
// Vérifier si le paramètre "id" a été fourni dans l'URL (GET)
if (isset($_GET['id'])) {
    // Récupérer la valeur de l'ID depuis l'URL
    $id = $_GET['id'];
    
    // ========== VALIDATION DE L'ID ==========
    // Vérifier que l'ID est un nombre
    // is_numeric() retourne true si la valeur est numérique
    if (!is_numeric($id)) {
        // Si ce n'est pas un nombre, enregistrer une erreur
        $error = 'ID invalide.';
    } else {
        // ========== RÉCUPÉRATION DE L'ARTICLE ==========
        // Appeler la méthode obtenirArticleById() pour récupérer l'article
        // Passer l'ID en paramètre
        $article = $blog->obtenirArticleById($id);

        // Vérifier si l'article a été trouvé
        if ($article === null) {
            // L'article n'existe pas, enregistrer une erreur
            $error = 'Article non trouvé.';
        } else {
            // ========== TRAITEMENT DE LA SUPPRESSION ==========
            // Vérifier si le formulaire de confirmation a été soumis
            // isset($_POST['confirm']): le formulaire a été soumis (méthode POST)
            // $_POST['confirm'] === 'yes': le bouton de confirmation a été cliqué
            if (isset($_POST['confirm']) && $_POST['confirm'] === 'yes') {
                // Appeler la méthode supprimerArticle() pour supprimer l'article
                if ($blog->supprimerArticle($id)) {
                    // Si la suppression a réussi
                    $success = 'Article supprimé avec succès !';
                    // Rediriger l'utilisateur vers index.php après 2 secondes
                    header("Refresh: 2; url=index.php");
                } else {
                    // Si la suppression a échoué
                    $error = 'Erreur lors de la suppression.';
                }
            }
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
    <title>Supprimer une entrée de blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
        .success {
            color: green;
            margin: 10px 0;
        }
        .confirmation {
            background-color: #f9f9f9;
            padding: 20px;
            border: 1px solid #ddd;
            margin: 20px 0;
        }
        form {
            margin-top: 20px;
        }
        button {
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border: none;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: white;
            border: none;
        }
        .btn-cancel:hover {
            background-color: #5a6268;
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
<h1>Supprimer une entrée de blog</h1>

<?php if (!empty($error)): ?>
    <p class="error">Erreur : <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<?php if (!empty($success)): ?>
    <p class="success"><?php echo htmlspecialchars($success); ?></p>
<?php endif; ?>

<?php if (isset($article) && $article !== null): ?>
    <div class="confirmation">
        <h2>Êtes-vous sûr de vouloir supprimer cet article ?</h2>
        <p><strong>Titre :</strong> <?php echo htmlspecialchars($article['title']); ?></p>
        <p><strong>Créé le :</strong> <?php echo htmlspecialchars($article['created']); ?></p>
        <p><strong>Contenu :</strong></p>
        <p><?php echo nl2br(htmlspecialchars(substr($article['article'], 0, 200) . '...')); ?></p>

        <form method="post" action="">
            <button type="submit" class="btn-delete" name="confirm" value="yes">Confirmer la suppression</button>
            <button type="button" class="btn-cancel" onclick="window.location.href='index.php';">Annuler</button>
        </form>
    </div>
<?php endif; ?>

<a href="index.php">Retour à la liste des articles</a>
</body>
</html>





