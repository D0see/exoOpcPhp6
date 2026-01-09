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
        //todo change this
        $userId = 1;
        $contactId = 2;

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

    public function sendMessage(string $userId, string $contactId, string $message) {

        $message = new Message();
        
        $message->setContent($message)
        ->setSenderId($userId)
        ->setReceiverId($contactId);

        $this->messagerieService->sendMessage($message);

    }
}