<?php

class Book extends AbstractEntity
{

    private string  $author;
    private string  $title;
    private ?string $image       = null;
    private string  $description;
    private int     $ownerId;
    private ?string $owner = null;
    private ?int    $borrowerId = null;
    private int     $stateId;
    private string  $createdAt;
    private ?string $borrowedAt = null;

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getOwnerId(): int
    {
        return $this->ownerId;
    }

    public function getOwner(): string|null
    {
        return $this->owner;
    }

    public function getBorrowerId(): ?int
    {
        return $this->borrowerId;
    }

    public function getStateId(): int
    {
        return $this->stateId;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getBorrowedAt(): ?string
    {
        return $this->borrowedAt;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;
        return $this;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;
        return $this;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function setOwnerId(?int $ownerId): self
    {
        $this->ownerId = $ownerId;
        return $this;
    }

    public function setOwner(string|null $owner): self
    {
        $this->owner = $owner;
        return $this;
    }

    public function setBorrowerId(?int $borrowerId): self
    {
        $this->borrowerId = $borrowerId;
        return $this;
    }

    public function setStateId(int $stateId): self
    {
        $this->stateId = $stateId;
        return $this;
    }

    public function setCreatedAt(string $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function setBorrowedAt(string | null $borrowedAt): self
    {
        $this->borrowedAt = $borrowedAt;
        return $this;
    }
}