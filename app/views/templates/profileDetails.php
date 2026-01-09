<div class="articleList">
    <?php 
        echo 'profile details';
        echo '<br>';
        echo $member->getPseudo();
        echo '<br>';
        echo 'personalLibrary';
        foreach ($books as $book) {
            echo $book->getTitle();
        }
    ?>
</div>