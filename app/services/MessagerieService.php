<?php

class MessagerieService
{
    private MessageRepository $messageRepository;
    private MemberRepository $memberRepository;

    public function __construct() 
    {
        $this->messageRepository = new MessageRepository();
        $this->memberRepository = new MemberRepository();
    }

    public function createMessage(Message $message): void {
        $this->messageRepository->createMessage($message);
    }

    /**
     * return a the last message of each of the user conversation
     * @param int userId
     * @return array
     */
    public function getLastMessageOfEachDiscussionByUserId(int $userId): array {
        $messages = $this->messageRepository->getMessagesByUserId($userId);

        usort($messages, function (Message $a, Message $b) {
            return (new \DateTime($b->getCreatedAt()))->getTimestamp() - (new \DateTime($a->getCreatedAt()))->getTimestamp();
        });

        $encounteredCorrespondant = [];
        $result = [];

        foreach ($messages as $message) {
            $correspondantId = $message->getReceiverId() === $userId ?
            $message->getSenderId() : 
            $message->getReceiverId();

            $correspondant = $this->memberRepository->getMemberById($correspondantId);

            if (!isset($encounteredCorrespondant[$correspondantId])) {
                $result[] = [
                    'message' => $message,
                    'correspondant' => $correspondant
                ];
                $encounteredCorrespondant[$correspondantId] = true;
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
            fn (Message $messageA, Message $messageB) =>
                (new \DateTime($messageA->getCreatedAt()))->getTimestamp()
                - (new \DateTime($messageB->getCreatedAt()))->getTimestamp()
        );

        return $messages;
    }

}