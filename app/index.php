<?php

require_once 'config.php';
require_once 'autoload.php';
require('dbManager.php');

session_start();

$action = Utils::request('action', 'home');

try {
    switch ($action) {
        case 'home':
            $homeController = new HomeController();
            $homeController->showHome();
            break;
        case 'showRegister':
            $memberController = new MemberController();
            $memberController->showRegister();
            break;
        case 'register':
            $memberController = new MemberController();
            $memberController->createMember();
            break;
        case 'connect':
            $memberController = new MemberController();
            $memberController->connect();
            break;
        case 'disconnect':
            $memberController = new MemberController();
            $memberController->disconnect();
            break;
        case 'showConnect':
            $memberController = new MemberController();
            $memberController->showConnect();
            break;
        case 'viewMyProfile':
            $memberController = new MemberController();
            $memberController->showMyProfile();
            break;
        case 'viewProfile':
            $memberController = new MemberController();
            $memberController->showProfile();
            break;
        case 'viewLibrary':
            $bookController = new BookController();
            $bookController->showLibrary();
            break;
        case 'viewBook':
            $bookController = new BookController();
            $bookController->showBook();
            break;
        case 'viewBookCreationForm':
            $bookController = new BookController();
            $bookController->showBookCreationForm();
            break;
        case 'createBook':
            $bookController = new BookController();
            $bookController->createBook();
            break;
        case 'borrowBook':
            $bookController = new BookController();
            $bookController->borrowBook();
            break;
        case 'returnBook':
            $bookController = new BookController();
            $bookController->returnBook();
            break;
        case 'viewMessagerie':
            $messagerieController = new MessagerieController();
            $messagerieController->showMessagerie();
            break;
        case 'sendMessage':
            $messagerieController = new MessagerieController();
            $messagerieController->sendMessage();
            break;
        default:
            $homeController = new HomeController();
            $homeController->showHome();
    }
} catch (Exception $e) {
    // En cas d'erreur, on affiche la page d'erreur.
    $errorView = new View('Erreur');
    $errorView->render('errorPage', ['errorMessage' => $e->getMessage()]);
}
