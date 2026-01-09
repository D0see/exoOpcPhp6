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
            $memberId = 1;
            $member = $this->memberRepository->getMemberById($memberId);

            $books = $this->bookRepository->getBooksByOwnerId($memberId);

            // On affiche la page d'administration.
            $view = new View("ProfileDetails");
            $view->render("profileDetails", [
                'member' => $member,
                'books' => $books
            ]);
        }
    }