<?php 

class MemberController {

    private MemberRepository $memberRepository;
    private BookRepository $bookRepository;
    private ImageUploader $imageUploader;

    public function __construct() 
    {
        $this->memberRepository = new MemberRepository();
        $this->bookRepository = new BookRepository();
        $this->imageUploader = new ImageUploader();
    }

    public function showProfile() : void
    {
        $memberId = (int) Utils::request("memberId");
        $member = $this->memberRepository->getMemberById($memberId);

        if ($_SESSION['user'] && ($memberId === $_SESSION['user']->getId())) {
            header("Location: /phpexo6/exoOpcPhp6/app/index.php?action=viewMyProfile");
        }

        $books = $this->bookRepository->getBooksByOwnerId($memberId);

        $view = new View("ProfileDetails");
        $view->render("profileDetails", [
            'member' => $member,
            'books' => $books
        ]);
    }

    public function showMyProfile() : void
    {
        $memberId = $_SESSION['idUser'];
        $member = $this->memberRepository->getMemberById($memberId);

        $books = $this->bookRepository->getBooksByOwnerId($memberId);

        $view = new View("MyProfileDetails");
        $view->render("myProfileDetails", [
            'member' => $member,
            'books' => $books
        ]);
    }

    public function connect() {

        $mail = Utils::request("mail");
        $password = Utils::request("password");

        if (empty($mail) || empty($password)) {
            throw new Exception("Tous les champs sont obligatoires.");
        }

        $memberService = new MemberService;
        $user = $memberService->getMemberByMail($mail);
        if (!$user) {
            throw new Exception("L'utilisateur demandé n'existe pas.");
        }

        if (!password_verify($password, $user->getPassword())) {
            throw new Exception("Le mot de passe est incorrect");
        }

        $_SESSION['user'] = $user;
        $_SESSION['idUser'] = $user->getId();

        Utils::redirect("home");
    }

    public function disconnect() {

        $_SESSION['user'] = null;
        $_SESSION['idUser'] = null;

        Utils::redirect("home");
    }

    public function showConnect() {

        $view = new View("Connexion");
        $view->render("connexion");
    }

    public function showRegister() {
        $view = new View("registration");
        $view->render("registration");
    }

    public function createMember() {
        $pseudo = Utils::request("pseudo", null);
        $mail = Utils::request("mail", null);
        $password = Utils::request("password", null);

        if (!isset($pseudo) || !isset($mail) || !isset($password)) {
            $view = new View("registration");
            $view->render("registration", ['errorMessage' => 'champs manquants']);
        }

        //hashpassword
        $password = password_hash($password, PASSWORD_DEFAULT);

        $member = new Member();
        $member
        ->setPseudo($pseudo)
        ->setMail($mail)
        ->setPassword($password);

        $imagePath = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imagePath = $this->imageUploader->uploadImage($_FILES['image'], 'images');
        }

        if (isset($imagePath)) {
            $member->setImage($imagePath);
        }
        
        $this->memberRepository->createMember($member);

        Utils::redirect("showConnect");
    }

    public function updateMyProfile() {

        $user = $_SESSION['user'];

        $pseudo = Utils::request("pseudo", $user->getPseudo());
        $mail = Utils::request("mail", $user->getMail());
        $password = Utils::request("password", null);

        if ($mail !== '') {
            $user->setMail($mail);
        }

        if ($pseudo !== '') {
            $user->setPseudo($pseudo);
        }

        if ($password !== '') {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $user->setPassword($password);
        }

        $this->memberRepository->updateMember($user);

        $_SESSION['user'] = $user;

        header("Location: /phpexo6/exoOpcPhp6/app/index.php?action=viewMyProfile");
        exit();
    }
}