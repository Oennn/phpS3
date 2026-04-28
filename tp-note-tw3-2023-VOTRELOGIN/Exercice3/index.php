<?php
// ============= INCLUSION DES FICHIERS NÉCESSAIRES =============
// Inclure le fichier connection.php qui contient la fonction dbConnect()
require_once 'connection.php';
// Inclure le fichier Blog.php qui contient la classe Blog pour les opérations CRUD
require_once 'Blog.php';

// ============= CONNEXION À LA BASE DE DONNÉES =============
// Appeler la fonction dbConnect() pour créer une connexion PDO
// Stocker la connexion dans $conn (sera null si erreur)
$conn = dbConnect();

// ============= INSTANCIATION DE LA CLASSE BLOG =============
// Créer une nouvelle instance de la classe Blog en passant la connexion
// Cette instance nous permettra d'appeler les méthodes de gestion du blog
$blog = new Blog($conn);

// ============= RÉCUPÉRATION DES ARTICLES =============
// Appeler la méthode obtenirDerniersArticles(5) pour récupérer les 5 articles les plus récents
// Stocker le résultat (tableau d'articles) dans la variable $articles
$articles = $blog->obtenirDerniersArticles(5);

?>
<!DOCTYPE HTML>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <title>Gérer les entrées du blog</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            margin-right: 10px;
            text-decoration: none;
            color: #007bff;
        }
        a:hover {
            text-decoration: underline;
        }
        .delete {
            color: #dc3545;
        }
    </style>
</head>

<body>
<h1>Gestion d'un Blog</h1>
<p><a href="inserer_blog.php">Insérer une nouvelle entrée</a></p>
<?php
// Afficher les articles s'ils existent
if (count($articles) > 0): ?>
    <table>
        <tr>
            <th>Créé le :</th>
            <th>Titre</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($articles as $article): ?>
            <tr>
                <td><?php echo htmlspecialchars(substr($article['created'], 0, 10)); ?></td>
                <td><?php echo htmlspecialchars($article['title']); ?></td>
                <td><a href="view_blog.php?id=<?php echo $article['article_id']; ?>">APERÇU</a></td>
                <td><a href="update_blog.php?id=<?php echo $article['article_id']; ?>">ÉDITER</a></td>
                <td><a href="supprimer_blog.php?id=<?php echo $article['article_id']; ?>" class="delete" onclick="return confirm('Êtes-vous sûr?');">SUPPRIMER</a></td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php else: ?>
    <p>Aucun article trouvé. <a href="inserer_blog.php">Créer le premier article</a></p>
<?php endif; ?>

</body>
</html>
