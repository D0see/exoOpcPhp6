<div class="home">
    <div class="block-element">
        <div class="introduction">
            <div class="introduction-left">
                <h2 class="block-element-title">
                    Rejoignez nos lecteurs passionés
                </h2>
                <p class="block-element-text">
                    Donnez une nouvelle vie à vos livres en les échangeant avec d'autres amoureux de la lecture. Nous croyons en la magie du partage de connaissances et d'histoires à travers les livres. 
                </p>
                <?php 
                    $buttonContent = "Découvrir";
                    $action = "viewLibrary";
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
                require __DIR__ . '/../components/main-button.php'; 
            ?>
        </div>
    </div>
</div>