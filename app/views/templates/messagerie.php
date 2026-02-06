<div class="block-elem">
    <div class="messagerie">
        <div class="messagerie-left">
            <h2 class="block-element-title messagerie-title">Messagerie</h2>
            <?php if ($newContact): ?>
                <a href="index.php?action=viewMessagerie&idContact=<?= $newContact->getId() ?>" 
                class="messagerie-contact selected-contact">
                    <img
                        class="messagerie-contact-image"
                        src="<?= htmlspecialchars($newContact->getImage()) ?>"
                        alt="<?= htmlspecialchars($newContact->getPseudo()) ?>"
                    >
                    <div class="messagerie-contact-detail">
                        <div class="messagerie-contact-top-row">
                            <div>
                                <?= htmlspecialchars($newContact->getPseudo()) ?>
                            </div>
                        </div>
                        <div class="messagerie-contact-message">
                        </div>
                    </div>
                </a>
            <?php endif ?>
            <?php foreach ($lastMessages as $lastMessage): ?>
                <?php 
                    [
                        'message' => $message,
                        'correspondant' => $correspondant
                    ] = $lastMessage;
                ?>
                <a href="index.php?action=viewMessagerie&idContact=<?= $correspondant->getId() ?>" 
                class="messagerie-contact
                <?= (isset($contact) && isset($correspondant) && ($contact->getId() === $correspondant->getId())) ? ' selected-contact' : '' ?>">
                    <img
                        class="messagerie-contact-image"
                        src="<?= htmlspecialchars($correspondant->getImage()) ?>"
                        alt="<?= htmlspecialchars($correspondant->getPseudo()) ?>"
                    >
                    <div class="messagerie-contact-detail">
                        <div class="messagerie-contact-top-row">
                            <div>
                                <?= htmlspecialchars($correspondant->getPseudo()) ?>
                            </div>
                            <div>
                                <?= (new \DateTime($message->getCreatedAt()))->format('m.d') ?>
                            </div>
                        </div>
                        <div class="messagerie-contact-message">
                            <?= htmlspecialchars($message->getContent()) ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php if (isset($contact)): ?>
            <div class="messagerie-right">
                <div class="correspondant-banner">
                    <img
                        class="messagerie-banner-contact-image"
                        src="<?= htmlspecialchars($contact->getImage()) ?>"
                        alt="<?= htmlspecialchars($contact->getPseudo()) ?>"
                    > 
                    <div class="messagerie-banner-contact-pseudo">
                        <?= htmlspecialchars($contact->getPseudo()) ?>
                    </div>
                </div>
                <div class="messages">
                    <?php foreach (array_reverse($conversation) as $msg): ?>
                        <?php if ($msg['sender']->getId() === $_SESSION['idUser']): ?>
                            <div class="messagerie-message-block user-message">
                                <div class="messagerie-conversation-message-info user-message-info">
                                    <div>
                                        <?= (new DateTime($msg['message']->getCreatedAt()))->format('m.d H:i') ?>
                                    </div>
                                </div>
                                <div class="messagerie-conversation-message user-message-content">
                                    <?= htmlspecialchars($msg['message']->getContent()) ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <div class="messagerie-message-block correspondant-message">
                                <div class="messagerie-conversation-message-info correspondant-message-info">
                                    <img
                                        class="message-contact-image"
                                        src="<?= htmlspecialchars($correspondant->getImage()) ?>"
                                        alt="<?= htmlspecialchars($correspondant->getPseudo()) ?>"
                                    >
                                    <div>
                                        <?= (new DateTime($msg['message']->getCreatedAt()))->format('m.d H:i') ?>
                                    </div>
                                </div>
                                <div class="messagerie-conversation-message correspondant-message-content">
                                    <?= htmlspecialchars($msg['message']->getContent()) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <form action="index.php?action=sendMessage&idContact=<?= $contactId ?>" 
                      method="post" 
                      class="messagerie-form">
                    <input type="text" 
                           name="message" 
                           id="message" 
                           class="block-element-input messagerie-input" 
                           placeholder="Votre message..."
                           required
                           autofocus>
                    <button type="submit" class="main-button full-button messagerie-button">
                        Envoyer
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="messagerie-right">
            </div>
        <?php endif; ?>
    </div>
</div>