<?php

class Messagerie 
{
    private MessageRepository $messageRepository;

    private function __construct() 
    {
        $this->messageRepository = new MessageRepository();
    }

    public function getLastMessageOfEachDiscussionByReceiverId(int $receiverId): array {
        $messages = $this->messageRepository->getMessagesByReceiverId($receiverId);

        usort($messages, function (Message $a, Message $b) {
            return $a->getCreatedAt() > $b->getCreatedAt();
        });

        $encounteredReceivers = [];
        $result = [];

        foreach ($messages as $message) {
            $currReceiver = $message->getReceiverId();
            if (!isset($encounteredReceivers[$currReceiver])) {
                $result[] = $message;
                $encounteredReceivers[$currReceiver] = true;
            }
        }

        return $result;
    }

}