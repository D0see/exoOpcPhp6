<div class="articleList">
    <?php 
        echo 'library';
        foreach ($books as $book) {
            echo '<a href="index.php?action=viewBook&idBook=' . $book->getId() . '">';
            echo $book->getTitle();
            echo '</a>';
        }
    ?>
</div>