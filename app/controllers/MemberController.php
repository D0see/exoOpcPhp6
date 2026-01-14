    <?php 
    
    class MemberController {

        private MemberRepository $memberRepository;
        private BookRepository $bookRepository;

        public function __construct() 
        {
            $this->memberRepository = new MemberRepository();
            $this->bookRepository = new BookRepository();
        }

        public function showProfile() : void
        {
            $memberId =Utils::request("memberId");
            $member = $this->memberRepository->getMemberById($memberId);

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

            $view = new View("ProfileDetails");
            $view->render("profileDetails", [
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

            if ($password !== $user->getPassword) {
                throw new Exception("Le mot de passe est incorrect");
            }

            $_SESSION['user'] = $user;
            $_SESSION['idUser'] = $user->getId();

            Utils::redirect("home");
        }
    }