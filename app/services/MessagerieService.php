<?php

class MessagerieService
{
    private MessageRepository $messageRepository;

    private function __construct() 
    {
        $this->messageRepository = new MessageRepository();
    }

    public function createMessage(Message $message): void {
        $this->messageRepository->createMessage($message);
    }

    /**
     * return a the last message of each of the user conversation
     * @param int userId
     * @return Message[] 
     */
    public function getLastMessageOfEachDiscussionByUserId(int $userId): array {
        $messages = $this->messageRepository->getMessagesByUserId($userId);

        $encounteredReceivers = [];
        $result = [];

        foreach ($messages as $message) {
            $currConversationPair = [$message->getSenderId(), $message->getReceiverId()];
            usort($currConversationPair, fn($a, $b) => $a < $b);
            $currConversationPair = implode('-', $currConversationPair);
            if (!isset($encounteredReceivers[$currConversationPair])) {
                $result[] = $message;
                $encounteredReceivers[$currConversationPair] = true;
            }
        }

        return $result;
    }

    /**
     * return a message conversation ordered based on creation date
     * @param int userId
     * @param int contactId
     * @return Message[] 
     */
    public function getConversation(int $userId, int $contactId): array {
        $messages = $this->messageRepository->getConversationByUserIdAndContactId($userId, $contactId);
        usort(
            $messages, 
            fn(Message $messageA, Message $messageB) => $messageA->getCreatedAt() < $messageB->getCreatedAt()
        );
        return $messages;
    }

}