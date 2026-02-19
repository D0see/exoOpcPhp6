<div class="book-details-card">
    <div class="book-details-left">
        <img
            src="<?= htmlspecialchars($book->getImage()) ?>"
            alt="<?= htmlspecialchars($book->getTitle()) ?>"
        >
    </div>
    <div class="book-details-right">
        <h2 class="block-element-title"><?= htmlspecialchars($book->getTitle()) ?></h3>
        <h3 class="block-element-subtitle">par <?= $book->getAuthor() ?></h3>
        <h4 class="table-header">______________</h4>
        <h4 class="table-header">DESCRIPTION</h4>
        <p><?= htmlspecialchars($book->getDescription()) ?></p>
        <h4 class="table-header">PROPRIETAIRE</h4>
        <a href=<?= "index.php?action=viewProfile&memberId=" . $book->getOwnerId() ?>>
            <div class="owner-bubble">
                <img
                    src="<?= htmlspecialchars($bookOwner->getImage()) ?>"
                    alt="<?= htmlspecialchars($bookOwner->getPseudo()) ?>"
                >
                <p><?= htmlspecialchars($bookOwner->getPseudo()) ?></p>
            </div>
        </a>
        <?php
            if ($_SESSION['idUser'] &&$_SESSION['idUser'] !== $book->getOwnerId()) {
                $buttonContent = 'Envoyer un message';
                $action = "viewMessagerie&idContact=" . $book->getOwnerId();
                $type = "full-button";
                require __DIR__ . '/../components/main-button.php';
            }
            if (isset($_SESSION['user']) && $book->getBorrowerId()) {
                if ($book->getBorrowerId() === $_SESSION['user']->getId()) {
                    $buttonContent = 'Rendre';
                    $action = "returnBook&idBook=" . $book->getId();
                    $type = "full-button";
                    require __DIR__ . '/../components/main-button.php';
                } 
            } else if (isset($_SESSION['user'])) {
                if ($book->getOwnerId() !== $_SESSION['user']->getId()) {
                    $buttonContent = 'Emprunter';
                    $action = "borrowBook&idBook=" . $book->getId();
                    $type = "full-button";
                    require __DIR__ . '/../components/main-button.php';
                } 
            }
        ?>
    </div>
</div>