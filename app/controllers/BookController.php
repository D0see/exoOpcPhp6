<?php 
 
class BookController {

    private BookRepository $bookRepository;

    public function __construct() 
    {
        $this->bookRepository = new BookRepository();
    }

    public function showPersonalLibrary() : void
    {
        $books = $this->bookRepository->getXLastBooks(4);

        // On affiche la page d'administration.
        $view = new View("Home");
        $view->render("home", [
            'books' => $books
        ]);
    }

    public function showLibrary() : void
    {
        $books = $this->bookRepository->getXLastBooks(4);

        // On affiche la page d'administration.
        $view = new View("Home");
        $view->render("home", [
            'books' => $books
        ]);
    }

    public function showBook() : void
    {
        $books = $this->bookRepository->getXLastBooks(4);

        // On affiche la page d'administration.
        $view = new View("Home");
        $view->render("home", [
            'books' => $books
        ]);
    }

    public function addBook() : void
    {
        $books = $this->bookRepository->getXLastBooks(4);

        // On affiche la page d'administration.
        $view = new View("Home");
        $view->render("home", [
            'books' => $books
        ]);
    }

    public function borrowBook() : void
    {
        $books = $this->bookRepository->getXLastBooks(4);

        // On affiche la page d'administration.
        $view = new View("Home");
        $view->render("home", [
            'books' => $books
        ]);
    }

}