<?php

require_once 'config/config.php';

$action = $_REQUEST[$variableName] ?? $defaultValue;

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
            $LibraryController = new LibraryController();
            $LibraryController->showPersonalLibrary();
            break;
        case 'viewLibrary':
            $LibraryController = new LibraryController();
            $LibraryController->showLibrary();
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
            $textingController = new TextingController();
            $textingController->showTexts();
            break;
        case 'viewConversation':
            $textingController = new TextingController();
            $textingController->showConversation();
            break;
        case 'sendMessage':
            $textingController = new TextingController();
            $textingController->sendMessage();
            break;
        default:
            $homeController->showHome();
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
