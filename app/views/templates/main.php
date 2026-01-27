<?php 


?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tom troc</title>
    <link rel="stylesheet" href="./css/style.css">
    <link
  rel="stylesheet"
  href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    />
</head>

<body>
    <header>
        <nav>
            <div class='inner-nav'>
                <div class='nav-block'>
                    <img src="/phpexo6/exoOpcPhp6/app/assets/logo.png" alt="Logo">
                    <a href="index.php?action=home" class=<?php $_GET['action'] === 'home' ? 'bold' : ''; ?>>
                        Accueil
                    </a>
                    <a href="index.php?action=viewLibrary">Nos livres à l'échange</a>
                </div>
                <div class='nav-block'>
                <?php 
                    if (isset($_SESSION['user'])) {
                        echo '
                        <a href="index.php?action=viewMessagerie">
                        <i class="fa-regular fa-comment"></i>
                            Messagerie
                        </a>';
                        echo '
                        <a href="index.php?action=viewMyProfile">
                        <i class="fa-regular fa-user"></i>
                            Mon compte
                        </a>';
                        echo '<a href="index.php?action=disconnect">Déconnexion</a>';
                        // echo '<a href="index.php?action=viewBookCreationForm">Ajouter un livre</a>';
                    } else {
                        echo '<a href="index.php?action=showConnect">Connexion</a>';
                    }
                ?>
                </div>
            </div>
        </nav>
    </header>

    <main>    
        <?= $content ?>
    </main>
    
    <footer>
        <a>Politique de confidentialité</a>
        <a>Mentions légales</a>
        <a>Tom troc</a>
        <p> logo </p>
    </footer>

</body>
</html>