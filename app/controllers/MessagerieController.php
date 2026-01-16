<?php 
/**
 * Contrôleur de la partie admin.
 */
 
class MessagerieController {

    private MessagerieService $messagerieService;

    public function __construct() 
    {
        $this->messagerieService = new MessagerieService();
    }

    public function showMessagerie() : void
    {
        $userId = $_SESSION['idUser'];
        $contactId = Utils::request("idContact");;

        $lastMessages = $this->messagerieService->getLastMessageOfEachDiscussionByUserId($userId);

        $currentConversation = null;
        if (isset($contactId)) {
           $currentConversation  = $this->messagerieService->getConversation($userId, $contactId);
        } 

        // On affiche la page d'administration.
        $view = new View("messagerie");
        $view->render("messagerie", [
            'lastMessages' => $lastMessages,
            'conversation' => $currentConversation
        ]);
    }

    public function sendMessage() {

        $userId = $_SESSION['idUser'];
        $contactId = Utils::request("idContact");
        $content = Utils::request("message");

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