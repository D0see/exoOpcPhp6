<div class="home">
    <div class="block-element">
        <div class="introduction">
            <div class="introduction-left">
                <h2 class="block-element-title align-left">
                    Rejoignez nos lecteurs passionés
                </h2>
                <p class="block-element-text">
                    Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. 
                </p>
                <?php 
                    $buttonContent = "Découvrir";
                    $action = "viewLibrary";
                    $type = "full-button";
                    require __DIR__ . '/../components/main-button.php'; 
                ?>
            </div>
            <div class="introduction-right">
                <img class="introduction-image" src="assets/introduction.jpg  " alt="vielle homme dans une pile de livre">
            </div>
        </div>
    </div>
    <div class="block-element">
        <div class="last-books">
            <h2 class="block-element-title">
                Les derniers livres ajoutés
            </h2>
            <div class="book-display">
                <?php 
                    foreach ($books as $book) {
                        require __DIR__ . '/../components/book-card.php';
                    }
                ?>
            </div>
            <?php 
                $buttonContent = "Voir tous les livres";
                $action = "viewLibrary";
                $type = "full-button";
                require __DIR__ . '/../components/main-button.php'; 
            ?>
        </div>
    </div>
    <div class="block-element">
        <div class="how-it-works">
            <h2 class="block-element-title">
                Comment ça marche ?
            </h2>
            <p class="block-element-text">
                Échanger des livres avec TomTroc c’est simple et amusant ! Suivez ces étapes pour commencer :
            </p>
            <div class="display-simple-blocks">
                <div class="simple-block">
                    Inscrivez-vous gratuitement sur notre plateforme.
                </div>
                <div class="simple-block">
                    Ajoutez les livres que vous souhaitez échanger à votre profil.
                </div>
                <div class="simple-block">
                    Parcourez les livres disponibles chez d'autres membres.
                </div>
                <div class="simple-block">
                    Proposez un échange et discutez avec d'autres passionnés de lecture.
                </div>
            </div>
            <?php 
                $buttonContent = "Voir tous les livres";
                $action = "viewLibrary";
                $type = "hollow-button";
                require __DIR__ . '/../components/main-button.php'; 
            ?>
        </div>
    </div>
    <div class="block-element">
        <div class="outro">
            <img class="outro-image" src="assets/outro.png" alt="bibliotheque pleine de livres">
            <div class="inner-outro">
                <h2 class="block-element-title align-left">
                    Nos valeurs
                </h2>
                <p class="block-element-text">
                    Chez Tom Troc, nous mettons l'accent sur le partage, la découverte et la communauté. Nos valeurs sont ancrées dans notre passion pour les livres et notre désir de créer des liens entre les lecteurs. Nous croyons en la puissance des histoires pour rassembler les gens et inspirer des conversations enrichissantes. Notre association a été fondée avec une conviction profonde : chaque livre mérite d'être lu et partagé. Nous sommes passionnés par la création d'une plateforme conviviale qui permet aux lecteurs de se connecter, de partager leurs découvertes littéraires et d'échanger des livres qui attendent patiemment sur les étagères.
                </p>
                <p class="block-element-subtitle">
                    L’équipe Tom Troc
                </p>
                <img class="heart" src="assets/heart.png" alt="motif de coeur">
            </div>
        </div>  
    </div>
</div>