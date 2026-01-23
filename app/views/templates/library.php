<div class="articleList">
    <?php 
        echo '<h2> Nos livres à l’échange </h2>';
        foreach ($books as $book) {
            require __DIR__ . '/../components/book-card.php';
        }
    ?>
</div>