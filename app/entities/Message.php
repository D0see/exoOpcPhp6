<?php

class Message extends AbstractEntity
{
    private string $content;
    private string $createdAt;
    private int    $senderId;
    private int    $receiverId;

    public function getContent(): string
    {
        return $this->content;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getSenderId(): int
    {
        return $this->senderId;
    }

    public function getReceiverId(): int
    {
        return $this->receiverId;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;
        return $this;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setSenderId(int $senderId): self
    {
        $this->senderId = $senderId;
        return $this;
    }

    public function setReceiverId(int $receiverId): self
    {
        $this->receiverId = $receiverId;
        return $this;
    }
}