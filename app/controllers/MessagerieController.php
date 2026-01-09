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

        $lastMessages = $this->messagerieService->getLastMessageOfEachDiscussionByUserId($userId);

        // On affiche la page d'administration.
        $view = new View("messagerie");
        $view->render("messagerie", [
            'lastMessages' => $lastMessages
        ]);
    }
}