<?php

class BookRepository 
{
    public function __construct() 
    {
    }

    public function getXLastBooks(int $x) {
        $sql = '
        select *, member.pseudo as owner, book.id as id, book.image as image
        from book 
        left join member on book.owner_id = member.id
        ORDER BY created_at DESC LIMIT ' . $x;

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute();

        $datas = $stmt->fetchAll();

        $books = array_map(fn($data) => new Book($data), $datas);

        return $books;
    }

    public function getBookById(int $id) : Book 
    {
        $sql = 'select *, member.pseudo as owner, book.id as id, book.image as image
        from book 
        left join member on book.owner_id = member.id
        where book.id = :id';

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
        $sql = 'select *, member.pseudo as owner, book.id as id, book.image as image
        from book 
        left join member on book.owner_id = member.id
        where owner_id = :ownerId';

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
        $sql = 'select *, member.pseudo as owner, book.id as id, book.image as image
        from book 
        left join member on book.owner_id = member.id
        where borrower_id = :borrowerId';

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
        $sql = '
            select *, member.pseudo as owner, book.id as id, book.image as image
            from book 
            left join member on book.owner_id = member.id 
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

    public function createBook(Book $book): Book {
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

        $bookId = DBManager::getInstance()->getPDO()->lastInsertId();
        
        return $this->getBookById($bookId);
    }

    public function setBookToLent($userId, int $bookId, string $borrowedAt) {
        $sql ="
            UPDATE book 
            set borrower_id = :borrower_id,
                borrowed_at = :borrowed_at
            where id = :id
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'id' => $bookId,
            'borrower_id' => $userId,
            'borrowed_at' => $borrowedAt,
        ]);
    }

    public function setBookToFree(int $bookId) {
        $sql ="
            UPDATE book 
            set borrower_id = NULL,
                borrowed_at = NULL
            where id = :id
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'id' => $bookId
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