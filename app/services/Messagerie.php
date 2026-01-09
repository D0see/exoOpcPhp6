<?php

class Messagerie 
{
    private MessageRepository $messageRepository;
    private MemberRepository $memberRepository;

    private function __construct() 
    {
        $this->messageRepository = new MessageRepository();
        $this->memberRepository = new MemberRepository();
    }

    public function getLastMessageOfEachDiscussionByReceiverId(int $receiverId): array {
        $messages = $this->messageRepository->getMessagesByReceiverId($receiverId);

        usort($messages, function (Message $a, Message $b) {
            return $a->getCreatedAt() > $b->getCreatedAt();
        });

        $encounteredReceivers = [];
        $result = [];

        foreach ($messages as $message) {
            $correspondantId = $message->getReceiverId() === $receiverId ?
            $message->getSenderId() : 
            $message->getReceiverId();

            $correspondant = $memberRepository->getMemberById($correspondantId);

            if (!isset($encounteredReceivers[$correspondantId])) {
                $result[] = [
                    'message' => $message,
                    'correspondant' => $correspondant
                ];
                $encounteredReceivers[$correspondantId] = true;
            }
        }

        return $result;
    }

}