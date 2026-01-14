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
            //todo change this to be
            $memberId = $_SESSION['idUser'];
            $member = $this->memberRepository->getMemberById($memberId);

            $books = $this->bookRepository->getBooksByOwnerId($memberId);

            // On affiche la page d'administration.
            $view = new View("ProfileDetails");
            $view->render("profileDetails", [
                'member' => $member,
                'books' => $books
            ]);
        }

        public function connectUser() {
            // On récupère les données du formulaire.
            $pseudo = Utils::request("pseudo");
            $password = Utils::request("password");

            // On vérifie que les données sont valides.
            if (empty($login) || empty($password)) {
                throw new Exception("Tous les champs sont obligatoires.");
            }

            // On vérifie que l'utilisateur existe.
            $memberService = new MemberService;
            $user = $memberService->getMemberByPseudo($login);
            if (!$user) {
                throw new Exception("L'utilisateur demandé n'existe pas.");
            }

            // On vérifie que le mot de passe est correct.
            if ($password !== $user->getPassword) {
                throw new Exception("Le mot de passe est incorrect");
            }

            // On connecte l'utilisateur.
            $_SESSION['user'] = $user;
            $_SESSION['idUser'] = $user->getId();

            // On redirige vers la page d'administration.
            Utils::redirect("home");
        }
    }