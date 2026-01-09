<div class="articleList">
    <?php 
        echo 'personalLibrary';
        foreach ($books as $book) {
            echo $book->getTitle();
        }
    ?>
</div>