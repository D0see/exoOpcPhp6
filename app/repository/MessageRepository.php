<?php

class MessageRepository 
{
    public function __construct() 
    {
    }

    /**
     * @return array of Message
     */
    public function getConversationByUserIdAndContactId(int $userId, int $contactId) : array
    {
        $sql = '
        SELECT * FROM message
        WHERE (sender_id = :userId AND receiver_id = :contactId)
        OR (sender_id = :contactId AND receiver_id = :userId)
        ORDER BY created_at ASC
        ';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'userId' => $userId,
            'contactId' => $contactId,
        ]);

        $datas = $stmt->fetchAll();

        $messages = array_map(fn($data) => new Message($data), $datas);

        return $messages;
    }

    public function getMessagesByUserId(int $userId) : array
    {
        $sql = 'SELECT * FROM message WHERE receiver_id = :userId OR sender_id = :userId';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'userId' => $userId,
        ]);

        $datas = $stmt->fetchAll();

        $messages = array_map(fn($data) => new Message($data), $datas);

        return $messages;
    }

    public function createMessage(Message $message): void {
        $sql ="
            INSERT INTO message (
                content, sender_id, receiver_id
            ) VALUES (
                :content, :sender_id, :receiver_id         
            )
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'content' => $message->getContent(),
            'sender_id' => $message->getSenderId(),
            'receiver_id' => $message->getReceiverId(),
        ]);
    }

}