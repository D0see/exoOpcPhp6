<div class="messagerie">
    <div class="messagerie__sidebar">
        <h2 class="messagerie__title">Messagerie</h2>
        <div class="messagerie__contacts">
            <?php foreach ($lastMessages as $lastMessage): ?>
                <?php 
                    [
                        'message' => $message,
                        'correspondant' => $correspondant
                    ] = $lastMessage;
                ?>
                <a href="index.php?action=viewMessagerie&idContact=<?= $correspondant->getId() ?>" 
                   class="contact-item">
                    <div class="contact-item__preview">
                        <?= htmlspecialchars($message->getContent()) ?>
                    </div>
                    <div class="contact-item__name">
                        <?= htmlspecialchars($correspondant->getPseudo()) ?>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="messagerie__main">
        <h2 class="messagerie__title">Conversation</h2>
        
        <?php if (isset($conversation)): ?>
            <div class="conversation">
                <div class="conversation__messages">
                    <?php foreach ($conversation as $msg): ?>
                        <div class="message">
                            <div class="message__content">
                                <?= htmlspecialchars($msg['message']->getContent()) ?>
                            </div>
                            <div class="message__sender">
                                <?= htmlspecialchars($msg['sender']->getPseudo()) ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <form action="index.php?action=sendMessage&idContact=<?= $correspondant->getId() ?>" 
                      method="post" 
                      class="message-form">
                    <input type="text" 
                           name="message" 
                           id="message" 
                           class="message-form__input" 
                           placeholder="Votre message..."
                           required>
                    <button type="submit" class="message-form__submit">
                        Envoyer le message
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