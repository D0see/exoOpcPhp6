<?php

class LibraryService
{
    private BookRepository $bookRepository;

    public function __construct() 
    {
        $this->bookRepository = new BookRepository();
    }

    /**
     * @param string input
     * @return Book[]
     */
    public function getBooksContainingInput(string $input) {
        $books = $this->bookRepository->getBooksContainingInput($input);

        return $books;
    }

    /**
     * @param int borrowerId
     * @return Book[]
     */
    public function getUserBorrowedBooks($borrowerId) {
        $books = $this->bookRepository->getBooksByBorrowerId($borrowerId);

        return $books;
    }

    /**
     * @param int borrowerId
     * @return Book[]
     */
    public function getUserBookCollection($ownerId) {
        $books = $this->bookRepository->getBooksByOwnerId($ownerId);

        return $books;
    }

    /**
     * @param int bookid
     * @return Book
     */
    public function getBook($bookId) {
        return $this->bookRepository->getBookById($bookId);
    }

    public function borrowBook($userId, $bookId, $borrowedAt) {
        return $this->bookRepository->setBookToLent($bookId, $userId, $borrowedAt);
    }

    public function returnBook($bookId) {
        return $this->bookRepository->setBookToFree($bookId);
    }

    public function addBook(Book $book) {
        return $this->bookRepository->createBook($book);
    }

    public function deleteBook($bookId) {
        return $this->bookRepository->deleteBook($bookId);
    }
}