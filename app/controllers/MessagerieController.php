<?php 
/**
 * Contrôleur de la partie admin.
 */
 
class MessagerieController {

    private MessagerieService $messagerieService;
    private MemberRepository $memberRepository;

    public function __construct() 
    {
        $this->messagerieService = new MessagerieService();
        $this->memberRepository = new MemberRepository();
    }

    public function showMessagerie() : void
    {
        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }

        $userId = $_SESSION['idUser'];
        $contactId = (int) Utils::request("idContact");;

        $contact = $contactId ? $this->memberRepository->getMemberById($contactId) : null;
        $lastMessages = $this->messagerieService->getLastMessageOfEachDiscussionByUserId($userId);

        $currentConversation = [];
        if (isset($contactId)) {
           $currentConversation  = $this->messagerieService->getConversation($userId, $contactId);
        }

        $newContact = null;
        
        $isNewContact = $contactId ? true : false;
        foreach($lastMessages as $message) {
            if ($message['correspondant']->getId() == $contactId) {
                $isNewContact = false;
                break;
            }
        }

        if ($isNewContact) {
            $newContact = $this->memberRepository->getMemberById($contactId);
        }

        if ($newContact->getId() === $_SESSION['idUser']) {
            Utils::redirect("home");
        }

        // On affiche la page d'administration.
        $view = new View("messagerie");
        $view->render("messagerie", [
            'lastMessages' => $lastMessages,
            'conversation' => $currentConversation,
            'contact' => $contact,
            'newContact' => $newContact,
            'contactId' => $contactId
        ]);
    }

    public function sendMessage() {

        if (!isset($_SESSION['user'])) {
            Utils::redirect("home");
        }

        $userId = $_SESSION['idUser'];
        $contactId = (int) Utils::request("idContact");
        $content = Utils::request("message");

        if ($userId === $contactId) {
            Utils::redirect("home");
        }

        $message = new Message();
        
        $message
        ->setContent($content)
        ->setSenderId($userId)
        ->setReceiverId($contactId)
        ->setCreatedAt((new DateTime('now'))->format('Y-m-d H:i:s'));

        $this->messagerieService->createMessage($message); 

        Utils::redirect("viewMessagerie", [
            'idContact' => $contactId
        ]);
    }
}