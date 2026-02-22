<?php 
 
class BookController {

    private BookRepository $bookRepository;
    private MemberRepository $memberRepository;
    private LibraryService $libraryService;
    private ImageUploader $imageUploader;

    public function __construct() 
    {
        $this->bookRepository = new BookRepository();
        $this->libraryService = new LibraryService();
        $this->imageUploader = new ImageUploader();
        $this->memberRepository = new MemberRepository();
    }

    public function showPersonalLibrary() : void
    {
        //todo get the owner id here
        $ownerId = $_SESSION['idUser'];
        $books = $this->libraryService->getUserBookCollection($ownerId);

        $view = new View("PersonalLibrary");
        $view->render("personalLibrary", [
            'books' => $books
        ]);
    }

    public function showLibrary() : void
    {
        $input = Utils::request("input", null);
        if (isset($input)) {
            $books = $this->libraryService->getBooksContainingInput($input);
        } else {
            $books = $this->bookRepository->getXLastBooks(24);
        }
        

        $view = new View("Library");
        $view->render("library", [
            'books' => $books
        ]);
    }

    public function showBook() : void
    {
        $bookId = Utils::request("idBook");

        $book = $this->bookRepository->getBookById($bookId);
        $bookOwner = $this->memberRepository->getMemberById($book->getOwnerId());
        
        $view = new View("Book");
        $view->render("bookDetails", [
            'book' => $book,
            'bookOwner' => $bookOwner
        ]);
    }

    public function createBook() : void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }

        $title = Utils::request("title", null);
        $author = Utils::request("author", null);
        $description = Utils::request("description", null);
        $disponibility = Utils::request("disponibility", null);

        if (!isset($title) || !isset($author) || !isset($description)) {
            $view = new View("BookCreation");
            $view->render("bookCreation", ['errorMessage' => 'champs manquants']);
        }

        $book = new Book();
        $book
        ->setTitle($title)
        ->setAuthor($author)
        ->setDescription($description)
        ->setOwnerId($_SESSION['idUser']);

        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->imageUploader->uploadImage($_FILES['image'], 'images');
        }

        if (isset($imagePath)) {
            $book->setImage($imagePath);
        }

        if ($disponibility === '0') {
            $book->setBorrowerId($_SESSION['idUser']);
        }
        
        $book = $this->bookRepository->createBook($book);
        $view = new View("bookDetails");
        $view->render("bookDetails", [
            'book' => $book,
            'bookOwner' => $_SESSION['user']
        ]);
        
    }
    
    public function editBook(): void
    {

        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }

        $bookId = Utils::request("bookId", -1);
        $idUser = $_SESSION['idUser'];

        $title = Utils::request("title", '');
        $author = Utils::request("author", '');
        $description = Utils::request("description", '');
        $description = trim($description);
        $disponibility = Utils::request("disponibility", null);

        $book = $this->libraryService->getBook($bookId);

        $book
        ->setTitle($title)
        ->setAuthor($author)
        ->setDescription($description);

        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->imageUploader->uploadImage($_FILES['image'], 'images');
        }

        if (isset($imagePath)) {
            $book->setImage($imagePath);
        }

        if ($disponibility === '0') {
            $book->setBorrowerId($_SESSION['idUser']);
        } else if ($disponibility === '1') {
            $book->setBorrowerId(null);
        }

        $this->libraryService->updateBook($book, $idUser);
        
        $view = new View("bookDetails");
        $view->render("bookDetails", [
            'book' => $book,
            'bookOwner' => $_SESSION['user']
        ]);
    }

    public function borrowBook() : void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }

        $bookId = Utils::request("idBook", -1);
        $userId = $_SESSION['idUser'];

        $this->libraryService->borrowBook($userId, $bookId,  (new DateTime('now'))->format('Y-m-d H:i:s'));
        $book = $this->libraryService->getBook($bookId);
        $bookOwner = $this->memberRepository->getMemberById($book->getOwnerId());

        $view = new View("Book");
        $view->render("bookDetails", [
            'book' => $book,
            'bookOwner' => $bookOwner
        ]);
    }

    public function returnBook() : void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }

        $bookId = Utils::request("idBook", -1);
        $userId = $_SESSION['idUser'];

        $book = $this->libraryService->getBook($bookId);
        $bookOwner = $this->memberRepository->getMemberById($book->getOwnerId());

        if ($userId !== $book->getBorrowerId()) {
            Utils::redirect("home");
        }
        
        $this->libraryService->returnBook($bookId);

        $book->setBorrowerId(null);
        $book->setBorrowedAt(null);

        $view = new View("Book");
        $view->render("bookDetails", [
            'book' => $book,
            'bookOwner' => $bookOwner
        ]);
    }

    public function deleteBook(): void
    {
        $bookId = Utils::request("idBook", -1);
        $idUser = $_SESSION['idUser'];

        $book = $this->libraryService->getBook($bookId);
        $this->libraryService->deleteBook($book, $idUser);

        header("Location: /phpexo6/exoOpcPhp6/app/index.php?action=viewMyProfile");
    }

    public function showBookForm(): void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }

        $bookId = Utils::request("idBook", null);
        $idUser = $_SESSION['idUser'];
        
        if (isset($bookId)) {
            $book = $this->libraryService->getBook((int) $bookId);
            if ($book->getOwnerId() !== $idUser) {
                Utils::redirect("home");
            }
        } else {
            $book = null;
        }
        
        $view = new View("BookForm");
        $view->render("bookForm", [
            'book' => $book
        ]);
        
    }

}