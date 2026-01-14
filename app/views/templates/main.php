<?php 
/**
 * Ce fichier est le template principal qui "contient" ce qui aura été généré par les autres vues.  
 * 
 * Les variables qui doivent impérativement être définie sont : 
 *      $title string : le titre de la page.
 *      $content string : le contenu de la page. 
 */

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom troc</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <header>
        <nav>
            <p>logo</p>
            <a href="index.php?action=home">Accueil</a>
            <a href="index.php?action=viewLibrary">Nos livres à l'échange</a>
            <a href="index.php?action=viewPersonalMessages">Messagerie</a>
            <a href="index.php?action=myProfile">Mon compte</a>
            <?php 
                // Si on est connecté, on affiche le bouton de déconnexion, sinon, on affiche le bouton de connexion : 
                if (isset($_SESSION['user'])) {
                    echo '<a href="index.php?action=disconnectUser">Déconnexion</a>';
                } else {
                    echo '<a href="index.php?action=connect">Connexion</a>';
                }
                ?>
        </nav>
    </header>

    <main>    
        <?= $content /* Ici est affiché le contenu réel de la page. */ ?>
    </main>
    
    <footer>
        <a>Politique de confidentialité</a>
        <a>Mentions légales</a>
        <a>Tom troc</a>
        <p> logo </p>
    </footer>

</body>
</html>