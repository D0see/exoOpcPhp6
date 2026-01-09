<?php 
 
class BookController {

    private BookRepository $bookRepository;
    private LibraryService $libraryService;

    public function __construct() 
    {
        $this->bookRepository = new BookRepository();
        $this->libraryService = new LibraryService();
    }

    public function showPersonalLibrary() : void
    {
        //todo get the owner id here
        $ownerId = 1;
        $books = $this->libraryService->getUserBookCollection($ownerId);

        $view = new View("PersonalLibrary");
        $view->render("personalLibrary", [
            'books' => $books
        ]);
    }

    public function showLibrary() : void
    {
        $books = $this->bookRepository->getXLastBooks(4);

        $view = new View("Home");
        $view->render("home", [
            'books' => $books
        ]);
    }

    public function showBook() : void
    {
        //replace with argument book id
        $bookId = 1;
        $book = $this->bookRepository->getBookById($bookId);

        // On affiche la page d'administration.
        $view = new View("Home");
        $view->render("bookDetails", [
            'book' => $book
        ]);
    }

    public function createBook() : void
    {

        $view = new View("BookCreation");
        $view->render("bookCreation", []);
    }

    public function borrowBook() : void
    {
        $bookId = 1;
        $userId = 1;

        $books = $this->libraryService->setBookToLent($bookId, $userId);
    }

    public function returnBook() : void
    {
        $bookId = 1;
        $userId = 1;

        $books = $this->libraryService->setBookToLent($bookId, $userId);
    }

}