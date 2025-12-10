<?php

require('dbManager.php');

class MessageRepository 
{
    private function __construct() 
    {
    }

    /**
     * @return array of Message
     */
    public function getMessagesBySenderAndReceiverId(int $senderId, int $receiverId) : array
    {
        $sql = 'select * from message where sender_id = :senderId and receiverId = :receiverId';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'sender_id' => $senderId,
            'receiver_id' => $receiverId,
        ]);

        $datas = $stmt->fetchAll();

        $messages = array_map(fn($data) => new Message($data), $datas);

        return $messages;
    }

    public function getMessagesByReceiverId(int $receiverId) : array
    {
        $sql = 'select * from message where receiverId = :receiverId';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'receiver_id' => $receiverId,
        ]);

        $datas = $stmt->fetchAll();

        $messages = array_map(fn($data) => new Message($data), $datas);

        return $messages;
    }

    public function createMessage(Message $message): void {
        $sql ="
            INSERT INTO message (
                content, created_at, sender_id, receiver_id
            ) VALUES (
                :content, :created_at, :sender_id, :receiver_id         
            )
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'content' => $message->getContent(),
            'created_at' => $message->getCreatedAt(),
            'sender_id' => $message->getSenderId(),
            'receiver_id' => $message->getReceiverId(),
        ]);
    }

}