<div class="Messagerie">
    <?php 
        echo 'Messagerie';
        echo '<br>';
        foreach ($lastMessages as $lastMessage) {
            [
                'message' => $message,
                'correspondant' => $correspondant
            ] = $lastMessage;

            echo $message->getContent();
            echo '<br>';
            echo $correspondant->getPseudo();
            echo '<br>';
            echo '<br>';
            echo '<br>';
        }
    ?>
</div>