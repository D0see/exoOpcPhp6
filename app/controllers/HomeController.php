    <?php 
    
    class HomeController {

        private BookRepository $bookRepository;

        public function __construct() 
        {
            $this->bookRepository = new BookRepository();
        }

        public function showHome() : void
        {

            $books = $this->bookRepository->getXLastBooks(4);

            // On affiche la page d'administration.
            $view = new View("Home");
            $view->render("home", [
                'books' => $books
            ]);
        }
    }