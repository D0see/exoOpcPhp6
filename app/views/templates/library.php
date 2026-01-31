<div class="library">
    <div class="library-header">
        <h2 class="block-element-title">
            Nos livres à l'échange
        </h2>
        <form class="library-search" action="index.php" method="GET">
            <input type="hidden" name="action" value="viewLibrary"/>
            <i class="fa-solid fa-magnifying-glass"></i>
            <input name="input" placeholder="rechercher un livre"/>
        </form>
    </div>
    <div class="library-display">
        <?php 
            foreach ($books as $book) {
                require __DIR__ . '/../components/book-card.php';
            }
        ?>
    </div>
</div>