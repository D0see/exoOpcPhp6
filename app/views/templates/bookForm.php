<div class="block-elem">
    <a>retour</a>
        <h2 class="block-element-title"><?= isset($book) ? 'Modifier les informations' : 'Création de livre' ?></h2>
    <div class="book-form">
        <div class="book-form-left">
            <div class="input-label-combo">
                <label for="image" class="block-element-label">Book Cover Image</label>
                <input type="file" 
                    name="image" 
                    id="image" 
                    class="form-file" 
                    value=<?= isset($book) ? $book->getImage(): ''?>
                    accept="image/*">
            </div>
        </div>
        <div class="book-form-right">
            <form action="index.php?action=<?= isset($book) ? 'updateBook' : 'createBook' ?>" method="post" enctype="multipart/form-data" class="book-form">
                
                <div class="input-label-combo">
                    <label for="title" class="block-element-label">Title</label>
                    <input type="text" 
                        name="title" 
                        id="title" 
                        class="block-element-input" 
                        placeholder="titre"
                        value=<?= isset($book) ? $book->getTitle(): ''?>
                        required>
                </div>

                <div class="input-label-combo">
                    <label for="author" class="block-element-label">Author</label>
                    <input type="text" 
                        name="author" 
                        id="author" 
                        class="block-element-input" 
                        placeholder="auteur"
                        value=<?= isset($book) ? $book->getAuthor(): ''?>
                        >
                </div>

                

                <div class="input-label-combo">
                    <label for="description" class="block-element-label">Description</label>
                    <textarea name="description" 
                            id="description" 
                            class="block-element-input" 
                            rows="6"
                            placeholder="description"
                            value=
                            >
                        <?= isset($book) ? $book->getDescription(): ''?>
                    </textarea>
                </div>

                <div class="input-label-combo">
                    <label for="disponibility" class="block-element-label">Disponibility</label>
                    <select name="disponibility" class="block-element-input">
                        <option value="1" <?= (isset($book) && $book->getBorrowerId() !== null) ? 'disabled' : '' ?>>Disponible</option>
                        <option value="0" <?= (isset($book) && $book->getBorrowerId() !== null) ? 'selected' : '' ?>>Non disponible</option>
                    </select>
                </div>

                <div class="form-actions">
                    <button type="submit" class="form-actions__submit">
                        <?= isset($book) ? 'Modifier le livre' : 'Création de livre'?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>