<a class="book-card" href="index.php?action=viewBook&idBook=<?= $book->getId() ?>">
    <img
        src="<?= htmlspecialchars($book->getImage()) ?>"
        alt="<?= htmlspecialchars($book->getTitle()) ?>"
    >
    <div class="book-description">
        <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
        <h4><?= htmlspecialchars($book->getDescription()) ?></h4>
        <h5><?= htmlspecialchars($book->getOwner()) ?></h5>
    </div>
</a>