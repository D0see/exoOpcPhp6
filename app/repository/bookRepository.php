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
            ORDER BY book.created_at DESC LIMIT ' . $x;

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
            WHERE author LIKE :input
            OR title LIKE :input
            -- OR description LIKE :input
        ';

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);

        $input = '%' . $input . '%';
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
            set author = :author,
             title = :title,
             image = :image,
             description = :description, 
             owner_id = :owner_id,
             borrower_id = :borrower_id
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
            'borrower_id' => $book->getBorrowerId(),
        ]);
    }

    public function createBook(Book $book): Book {
        $sql ="
            INSERT INTO book (
                author, title, image, description, owner_id
            ) VALUES (
                :author, :title, :image, :description, :owner_id
            )
        ";

        $stmt = DBManager::getInstance()->getPDO()->prepare($sql);
        $stmt->execute([
            'author' => $book->getAuthor(),
            'title' => $book->getTitle(),
            'image' => $book->getImage(),
            'description' => $book->getDescription(),
            'owner_id' => $book->getOwnerId(),
        ]);

        $bookId = DBManager::getInstance()->getPDO()->lastInsertId();
        
        return $this->getBookById($bookId);
    }

    public function setBookToLent($userId, int $bookId, string $borrowedAt): void {
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

    public function setBookToFree(int $bookId): void {
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

    public function deleteBook($bookId): void {
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