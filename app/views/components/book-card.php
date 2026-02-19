<a class="book-card" href="index.php?action=viewBook&idBook=<?= $book->getId() ?>">
    <img
        class="book-card-image"
        src="<?= htmlspecialchars($book->getImage()) ?>"
        alt="<?= htmlspecialchars($book->getTitle()) ?>"
    >
    <div class="book-description">
        <h3 class="book-card-title"><?= htmlspecialchars($book->getTitle()) ?></h3>
        <h4 class="book-card-author"><?= htmlspecialchars($book->getAuthor()) ?></h4>
        <h5 class="book-card-owner">proposé par : <?= htmlspecialchars($book->getOwner()) ?></h5>
    </div>
</a>