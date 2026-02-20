<div class="block-elem book-form-block">
    <div class="book-form-header">
        <?php
                if (isset($book)) {
                    echo '<a class="block-element-subtitle" href="index.php?action=viewMyProfile">< retour</a>';
                }
        ?>
        <h2 class="block-element-title"><?= isset($book) ? 'Modifier les informations' : 'Création de livre' ?></h2>
    </div>
    <form action="index.php?action=<?= isset($book) ? 'editBook' : 'createBook' ?>" method="post" enctype="multipart/form-data" class="book-form">
        <?php if (isset($book)): ?>
            <input type="hidden" name="bookId" value="<?= htmlspecialchars($book->getId()) ?>">
        <?php endif; ?>
        <div class="book-form-left">
            <label for="title" class="block-element-label">Photo</label>
            <?php
                if (isset($book)) {
                    echo '<img 
                        src="' . htmlspecialchars($book->getImage()) . '"
                        alt="' . htmlspecialchars($book->getTitle()) . '">';
                }
            ?>
            <div class="input-label-combo">
                <label for="image" class="block-element-label"><?= isset($book) ? 'modifier la photo' : 'importer une photo' ?></label>
                <input type="file" 
                    name="image" 
                    id="image" 
                    class="" 
                    value=<?= isset($book) ? $book->getImage(): ''?>
                    accept="image/*">
            </div>
        </div>
        <div class="book-form-right">
            <div class="input-label-combo">
                <label for="title" class="block-element-label">Titre</label>
                <input type="text" 
                    name="title" 
                    id="title" 
                    class="block-element-input" 
                    placeholder="titre"
                    value="<?= isset($book) ? $book->getTitle(): ''?>"
                    >
            </div>

            <div class="input-label-combo">
                <label for="author" class="block-element-label">Auteur</label>
                <input type="text" 
                    name="author" 
                    id="author" 
                    class="block-element-input" 
                    placeholder="auteur"
                    value="<?= isset($book) ? $book->getAuthor(): ''?>"
                    >
            </div>

            

            <div class="input-label-combo">
                <label for="description" class="block-element-label">Commentaire</label>
                <textarea name="description" 
                        id="description" 
                        class="block-element-input block-element-text-area" 
                        rows="6"
                        placeholder="description"
                        ><?= isset($book) ? $book->getDescription(): ''?></textarea>
            </div>

            <div class="input-label-combo">
                <label for="disponibility" class="block-element-label">Disponibilité</label>
                <select name="disponibility" class="block-element-input">
                    <option value="1" <?= (isset($book) && $book->getBorrowerId() !== null) ? 'disabled' : '' ?>>Disponible</option>
                    <option value="0" <?= (isset($book) && $book->getBorrowerId() !== null) ? 'selected' : '' ?>>Non disponible</option>
                </select>
            </div>

            <div class="form-actions">
                <button type="submit" class="main-button full-button connexion-button">Valider</button>
            </div>
        </div>
    </form>
</div>