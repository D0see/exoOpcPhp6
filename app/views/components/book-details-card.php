<a class="book-details" href="index.php?action=viewBook&idBook=<?= $book->getId() ?>">
    <img
        src="<?= htmlspecialchars($book->getImage()) ?>"
        alt="<?= htmlspecialchars($book->getTitle()) ?>"
    >
    <div class="book-details-description">
        <h3><?= htmlspecialchars($book->getTitle()) ?></h3>
        <h4>DESCRIPTION</h4>
        <p><?= htmlspecialchars($book->getDescription()) ?></p>
        <h4>PROPRIETAIRE</h4>
        <div>
            <img

            >
            <p><?= htmlspecialchars($bookOwner->getPseudo()) ?></p>
        </div>
    </div>
</a>