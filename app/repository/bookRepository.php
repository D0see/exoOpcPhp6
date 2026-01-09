<?php

class BookRepository 
{
    public function __construct() 
    {
    }

    public function getXLastBooks(int $x) {
        $sql = 'select * from book ORDER BY created_at DESC LIMIT ' . $x;

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute();

        $datas = $stmt->fetchAll();

        $books = array_map(fn($data) => new Book($data), $datas);

        return $books;
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

    /**
     * @return array of Book
     */
    public function getBooksByBorrowerId(int $borrowerId) : array
    {
        $sql = 'select * from book where borrower_id = :borrowerId';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'borrowerId' => $borrowerId,
        ]);

        $datas = $stmt->fetchAll();

        $books = array_map(fn($data) => new Book($data), $datas);

        return $books;
    }

    /**
     * @return array of Book
     */
    public function getBooksContainingInput(string $input) : array
    {
        $sql = 'SELECT * from book 
                WHERE author LIKE %:input%
                OR content LIKE %:input%
                OR description LIKE %:input%
                ';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'input' => $input,
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

    public function setBookToLent($userId, $bookId) {
        $sql ="
            UPDATE book 
            set borrowerId = :borrower_id 
            set state_id = :state_id 
            where id = :id
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'id' => $bookId,
            'borrower_id' => $userId,
            'state_id' => 2,
        ]);
    }

    public function setBookToFree($bookId) {
        $sql ="
            UPDATE book 
            set state_id = :state_id 
            set borrower_id = NULL
            where id = :id
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'id' => $bookId,
            'state_id' => 1,
            //todo build enum for state id
        ]);
    }

    public function deleteBook($bookId) {
        $sql ="
            Delete from book 
            where id = :id
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'id' => $bookId,
        ]);
    }

}