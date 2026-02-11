<div class="block-elem">
    <div class="account-block">
        <div class="account-left">
            <img class="account-image" src="<?php $member->getImage() ?>"/>
            <div class="account-info">
                <div class="account-left-member-since">
                    <h2 class="block-element-title"><?= $member->getPseudo() ?></h2>
                    <h3 class="block-element-label"> membre depuis <?= (new DateTime())->diff(new DateTime($member->getCreatedAt()))->y ?> an</h3>
                </div>
                <div class="account-left-book-num">
                    <h4>BIBLIOTHEQUE</h4>
                    <p>icon <?=  count($books) ?> livres</p>
                </div>
                <a class="main-button hollow-button"
                    href="index.php?action=viewMessagerie&idContact=<?= $member->getId() ?>">
                    Écrire un message
                </a>
            </div>
        </div>
        <div class="account-right">
            <table>
                <thead>
                    <tr class="table-headers">
                        <th class="table-header">PHOTO</th>
                        <th class="table-header">TITRE</th>
                        <th class="table-header">AUTEUR</th>
                        <th class="table-header">DESCRIPTION</th>
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
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

        </div>
    </div>
</div>