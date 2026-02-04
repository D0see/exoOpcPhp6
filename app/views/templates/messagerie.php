<div class="block-elem">
    <div class="messagerie">
        <div class="messagerie-left">
            <h2 class="block-element-title messagerie-title">Messagerie</h2>
            <?php foreach ($lastMessages as $lastMessage): ?>
                <?php 
                    [
                        'message' => $message,
                        'correspondant' => $correspondant
                    ] = $lastMessage;
                ?>
                <a href="index.php?action=viewMessagerie&idContact=<?= $correspondant->getId() ?>" 
                class="messagerie-contact">
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
                                <?= (new \DateTime($message->getCreatedAt()))->format('H:i') ?>
                            </div>
                        </div>
                        <div class="messagerie-contact-message">
                            <?= htmlspecialchars($message->getContent()) ?>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
        <?php if (isset($conversation)): ?>
            <div class="messagerie-right">
                <div class="messages">
                    <?php foreach ($conversation as $msg): ?>
                        <?php if ($msg['sender']->getId() === $_SESSION['idUser']): ?>
                            <div class="messagerie-message-block user-message">
                                <div class="messagerie-conversation-message-info user-message-info">
                                    <div>
                                        <?= (new \DateTime($message->getCreatedAt()))->format('H:i') ?>
                                    </div>
                                </div>
                                <div class="messagerie-conversation-message user-message">
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
                                        <?= (new \DateTime($message->getCreatedAt()))->format('H:i') ?>
                                    </div>
                                </div>
                                <div class="messagerie-conversation-message correspondant-message">
                                    <?= htmlspecialchars($msg['message']->getContent()) ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <form action="index.php?action=sendMessage&idContact=<?= $correspondant->getId() ?>" 
                      method="post" 
                      class="messagerie-form">
                    <input type="text" 
                           name="message" 
                           id="message" 
                           class="block-element-input messagerie-input" 
                           placeholder="Votre message..."
                           required>
                    <button type="submit" class="main-button full-button messagerie-button">
                        Envoyer
                    </button>
                </form>
            </div>
        <?php else: ?>
            <div class="conversation__empty">
                <p class="conversation__empty-text">Select a conversation</p>
            </div>
        <?php endif; ?>
    </div>
</div>