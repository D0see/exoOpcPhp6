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
        $bookId = Utils::request("idBook");

        $book = $this->bookRepository->getBookById($bookId);

        $view = new View("Book");
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
        $bookId = Utils::request("idBook", -1);
        $userId = $_SESSION['idUser'];

        $books = $this->libraryService->borrowBook($bookId, $userId, (new DateTime('now'))->format('Y-m-d H:i:s'));

        $view = new View("Book");
        $view->render("bookDetails", [
            'book' => $this->libraryService->getBook($bookId)
        ]);
    }

    public function returnBook() : void
    {
        $bookId = Utils::request("idBook", -1);
        $userId = $_SESSION['idUser'];

        $books = $this->libraryService->returnBook($bookId, $userId);

        $view = new View("Book");
        $view->render("bookDetails", [
            'book' => $this->libraryService->getBook($bookId)
        ]);
    }

}