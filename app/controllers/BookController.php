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
        $books = $this->bookRepository->getXLastBooks(24);

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

    public function showBookCreationForm() : void
    {

        $view = new View("BookCreation");
        $view->render("bookCreation", []);
    }

    public function createBook() : void
    {
        $title = Utils::request("title", null);
        $author = Utils::request("author", null);
        $image = Utils::request("image", null);
        $description = Utils::request("description", null);

        if (!isset($title) || !isset($author) || !isset($description)) {
            $view = new View("BookCreation");
            $view->render("bookCreation", ['errorMessage' => 'champs manquants']);
        }

        $book = new Book();
        $book
        ->setTitle($title)
        ->setAuthor($author)
        ->setDescription($description)
        ->setOwnerId($_SESSION['idUser'])
        ->setStateId(1);

        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->imageUploader->uploadImage($_FILES['image'], 'images');
        }

        if (isset($imagePath)) {
            $book->setImage($imagePath);
        }
        
        $book = $this->bookRepository->createBook($book);
        $view = new View('Book Details');
        $view->render("bookDetails", [
            'book' => $book
        ]);
    }

    public function borrowBook() : void
    {
        $bookId = Utils::request("idBook", -1);
        $userId = $_SESSION['idUser'];

        $this->libraryService->borrowBook($bookId, $userId, (new DateTime('now'))->format('Y-m-d H:i:s'));
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
        $bookId = Utils::request("idBook", -1);
        $userId = $_SESSION['idUser'];

        $this->libraryService->returnBook($bookId, $userId);
        $book = $this->libraryService->getBook($bookId);
        $bookOwner = $this->memberRepository->getMemberById($book->getOwnerId());

        $view = new View("Book");
        $view->render("bookDetails", [
            'book' => $book,
            'bookOwner' => $bookOwner
        ]);
    }

}