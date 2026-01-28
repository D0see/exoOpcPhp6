<div class="articleList">
    <?php 
        echo '<br>';
        echo '<h2>Les derniers livres ajoutés</h2>';
        foreach ($books as $book) {
            require __DIR__ . '/../components/book-card.php';
        }
    ?>
</div>