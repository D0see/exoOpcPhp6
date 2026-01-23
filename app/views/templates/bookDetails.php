<div class="articleList">
    <?php 
        require __DIR__ . '/../components/book-details-card.php';
        if ($book->getBorrowerId()) {
            echo '<p>borrowed</p>';
            if ($book->getBorrowerId() === $_SESSION['user']->getId()) {
                echo "<a href='index.php?action=returnBook&idBook=" . $book->getId() . "'>";
                echo "return book";
                echo "</a>";
            } else {
                echo "unavailable";
            }
        } else {
            echo '<p>free</p>';
            if ($book->getOwnerId() !== $_SESSION['user']->getId()) {
                echo "<a href='index.php?action=borrowBook&idBook=" . $book->getId() . "'>";
                echo "borrow book";
                echo "</a>";
            } else {
                echo "this is your book :)";
            }
        }
    ?>
</div>