<?php

require('dbManager.php');

class bookRepository 
{
    private function __construct() 
    {
    }

    public function getBookById(int $id) : Book 
    {
        $sql = 'select * from book where id = :id';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'id' => $id,
        ]);

        $data = $stmt->fetch();

        return new Book($data);
    }

    /**
     * @return array of Book
     */
    public function getBooksByOwnerId(int $ownerId) : array
    {
        $sql = 'select * from book where owner_id = :ownerId';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'ownerId' => $ownerId,
        ]);

        $datas = $stmt->fetchAll();

        $books = array_map(fn($data) => new Book($data), $datas);

        return $books;
    }

    public function updateBook(Book $book): void {
        $sql ="
            UPDATE book 
            set author = :author 
            set title = :title 
            set image = :image 
            set description = :description 
            set owner_id = :owner_id 
            set state_id = :state_id 
            where id = :id
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'id' => $book->getId(),
            'author' => $book->getAuthor(),
            'title' => $book->getTitle(),
            'image' => $book->getImage(),
            'description' => $book->getDescription(),
            'owner_id' => $book->getOwnerId(),
            'state_id' => $book->getStateId(),
        ]);
    }

    public function createBook(Book $book): void {
        $sql ="
            INSERT INTO book (
                author, title, image, description, owner_id, state_id
            ) VALUES (
                :author, :title, :image, :description, :owner_id, :state_id
            )
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'author' => $book->getAuthor(),
            'title' => $book->getTitle(),
            'image' => $book->getImage(),
            'description' => $book->getDescription(),
            'owner_id' => $book->getOwnerId(),
            'state_id' => $book->getStateId(),
        ]);
    }
}