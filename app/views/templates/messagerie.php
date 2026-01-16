<div class="Messagerie">
    <?php 
        echo 'Messagerie';
        echo '<br>';
        foreach ($lastMessages as $lastMessage) {
            [
                'message' => $message,
                'correspondant' => $correspondant
            ] = $lastMessage;
            echo "<a href='index.php?action=viewMessagerie&idContact=" . $correspondant->getId() . "'>";
            echo $message->getContent();
            echo '<br>';
            echo $correspondant->getPseudo() . '</a>';
            echo '<br>';
            echo '<br>';
            echo '<br>';
        }

        echo 'Conversation';
        echo '<br>';
        if (isset($conversation)) {
            foreach ($conversation as $message) {
                echo $message->getContent();
                echo '<br>';
                echo $correspondant->getPseudo();
                echo '<br>';
                echo '<br>';
                echo '<br>';
            }
            echo '<br>';
            echo '
            <form action="index.php?action=sendMessage&idContact=' . $correspondant->getId() . '" method="post">
                    <input type="message" name="message" id="message" required>
                    <button class="submit">Envoyer le message</button>
            </form>
            ';
        } else {
            echo 'select a conversation';
        }
        
    ?>
</div>