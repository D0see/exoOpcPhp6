<?php

require_once 'config.php';
require_once 'autoload.php';

$action = Utils::request('action', 'home');

try {
    switch ($action) {
        case 'home':
            $homeController = new HomeController();
            $homeController->showHome();
            break;
        case 'register':
            $homeController = new MemberController();
            $homeController->showRegister();
            break;
        case 'connect':
            $homeController = new MemberController();
            $homeController->showConnect();
            break;
        case 'viewProfile':
            $profileController = new MemberController();
            $profileController->showProfile();
            break;
        case 'viewPersonalLibrary':
            $bookController = new BookController();
            $bookController->showPersonalLibrary();
            break;
        case 'viewLibrary':
            $bookController = new BookController();
            $bookController->showLibrary();
            break;
        case 'viewBook':
            $bookController = new BookController();
            $bookController->showBook();
            break;
        case 'addBook':
            $bookController = new BookController();
            $bookController->addBook();
            break;
        case 'borrowBook':
            $bookController = new BookController();
            $bookController->updateBookState();
            break;
        case 'viewPersonalMessages':
            $messagerieController = new MessagerieController();
            $messagerieController->showTexts();
            break;
        case 'viewConversation':
            $messagerieController = new MessagerieController();
            $messagerieController->showConversation();
            break;
        case 'sendMessage':
            $messagerieController = new MessagerieController();
            $messagerieController->sendMessage();
            break;
        default:
            $homeController->showHome();
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
