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
                    <a href="index.php?action=home" class=<?php echo $viewName === 'home' ? 'bold' : ''; ?>>
                        Accueil
                    </a>
                    <a href="index.php?action=viewLibrary" class=<?php echo $viewName === 'library' ? 'bold' : ''; ?>>Nos livres à l'échange</a>
                </div>
                <div class='nav-block'>
                <?php 
                    if (isset($_SESSION['user'])) {
                        echo '
                        <a href="index.php?action=viewMessagerie" class= ' . ($viewName === 'messagerie' ? 'bold' : '') . '>
                        <i class="fa-regular fa-comment"></i>
                            Messagerie
                        </a>';
                        echo '
                        <a href="index.php?action=viewMyProfile" class= ' . ($viewName === 'profileDetails' ? 'bold' : '') . '>
                        <i class="fa-regular fa-user"></i>
                            Mon compte
                        </a>';
                        echo '<a href="index.php?action=disconnect">Déconnexion</a>';
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
        <div class="inner-footer">
            <a>Politique de confidentialité</a>
            <a>Mentions légales</a>
            <a>Tom troc© </a>
            <img src="/phpexo6/exoOpcPhp6/app/assets/footerlogo.png" alt="footer-logo" class="footer-logo">
        </div>
    </footer>

</body>
</html>