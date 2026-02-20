<form action="index.php?action=updateMyProfile" method='POST' enctype="multipart/form-data">    
    <div class="block-elem">
        <div class="account-block my-account-block">
            <div class="account-left my-account-left">
                <div class="account-header">
                <img class="account-image" src="<?= $member->getImage() ?>"/>
                    <div class="account-image-modify">
                        <label for="image" class="block-element-label"><?= isset($book) ? 'modifier la photo' : 'importer une photo' ?></label>
                        <input type="file" 
                            name="image" 
                            id="image" 
                            class="" 
                            value=<?= isset($book) ? $book->getImage(): ''?>
                            accept="image/*">
                    </div>
                </div>
                <div class="account-info">
                    <div class="account-left-member-since">
                        <h2 class="block-element-title"><?= $member->getPseudo() ?></h2>
                        <h3 class="block-element-label"> membre depuis <?= (new DateTime())->diff(new DateTime($member->getCreatedAt()))->y ?> an</h3>
                    </div>
                    <div class="account-left-book-num">
                        <h4>BIBLIOTHEQUE</h4>
                        <p><i class="fa-solid fa-book"></i> <?=  count($books) ?> livres</p>
                    </div>
                </div>
            </div>
            <div class="my-account-right">
                <div class="profile-form">
                    <h2 class="block-element-title">Vos informations personelles</h2>
                    <div class="input-label-combo">
                        <label for="mail" class="block-element-label">Adresse Mail</label>
                        <input type="text" 
                            name="mail" 
                            id="mail" 
                            class="block-element-input" 
                            value= <?= $member->getMail() ?>
                            >
                    </div>
                    <div class="input-label-combo">
                        <label for="password" class="block-element-label">Mot de passe</label>
                        <input type="text" 
                            name="password" 
                            id="password" 
                            class="block-element-input" 
                            placeholder=" ***"
                            >
                    </div>
                    <div class="input-label-combo">
                        <label for="pseudo" class="block-element-label">Pseudo</label>
                        <input type="pseudo" 
                            name="pseudo" 
                            id="mail"
                            class="block-element-input" 
                            value= <?= $member->getPseudo() ?>
                            >
                    </div>
                    <button
                    class="main-button hollow-button profile-form-button"
                    type="submit"
                    >
                        Enregistrer
                    </button>
                </div>
            </div>
        </div>
    </div>
</form>
<div class="block-elem">
    <div class="my-account-bottom">
        <table class="my-account-table">
            <thead>
                <tr class="table-headers">
                    <th class="table-header">PHOTO</th>
                    <th class="table-header">TITRE</th>
                    <th class="table-header">AUTEUR</th>
                    <th class="table-header">DESCRIPTION</th>
                    <th class="table-header">DISPONIBILITE</th>
                    <th class="table-header">ACTION</th>
                </tr>
            </thead>
            <tbody class="table-body">
                <?php foreach ($books as $book): ?>
                    <tr class="table-row">
                        <td class="table-data">
                            <img class="table-image" src="<?= $book->getImage() ?>" alt="">
                        </td>
                        <td class="table-data"><div><?= $book->getTitle() ?></div></td>
                        <td class="table-data"><div><?= $book->getAuthor() ?></div></td>
                        <td class="table-data table-description"><div><?= $book->getDescription() ?></div></td>
                        <td class="table-data">
                            <?php
                                $isAvailable = $book->getBorrowerId() === null;
                                require __DIR__ . '/../components/disponibility-marker.php'; 
                            ?>
                        </td>
                        <td class="table-data">
                            <div class="table-data-actions">
                                <a class="edit" href="index.php?action=showBookForm&idBook=<?= $book->getId() ?>">
                                    Éditer
                                </a>
                                <a class="delete" href="index.php?action=deleteBook&idBook=<?= $book->getId() ?>">
                                    Supprimer
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>