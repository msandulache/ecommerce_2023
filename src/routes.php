<?php

use App\Controller\CartController;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use App\Repository\CartRepository;
use App\Controller\MovieController;
use App\Controller\PageController;
use App\Controller\UserController;
use App\Router;

$router = new Router();

$router->addRoute('GET', '/', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new MovieRepository();
    $homeController = new MovieController($cartRepository);
    $homeController->nowPlaying($movieRepository);
});

$router->addRoute('GET', '/popular', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new MovieRepository();
    $homeController = new MovieController($cartRepository);
    $homeController->popular($movieRepository);
});

$router->addRoute('GET', '/romanian-movies', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new MovieRepository();
    $homeController = new MovieController($cartRepository);
    $homeController->romanianMovies($movieRepository);
});

$router->addRoute('GET', '/french-movies', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new MovieRepository();
    $homeController = new MovieController($cartRepository);
    $homeController->frenchMovies($movieRepository);
});

$router->addRoute('GET', '/movie/:movieID', function ($movieID) {
    $cartRepository = new CartRepository();
    $movieRepository = new MovieRepository();
    $homeController = new MovieController($cartRepository);
    $homeController->getMovie($movieRepository, $movieID);
});

$router->addRoute('GET', '/contact', function () {
    $cartRepository = new CartRepository();
    $homeController = new PageController($cartRepository);
    $homeController->show();
});

$router->addRoute('GET', '/register', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new UserRepository();
    $homeController = new UserController($cartRepository);
    $homeController->showRegisterForm($movieRepository);
});

$router->addRoute('POST', '/register', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new UserRepository();
    $homeController = new UserController($cartRepository);
    $homeController->register($movieRepository);
});

$router->addRoute('GET', '/login', function () {
    $cartRepository = new CartRepository();
    $homeController = new UserController($cartRepository);
    $homeController->showLoginForm();
});

$router->addRoute('POST', '/login', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new UserRepository();
    $homeController = new UserController($cartRepository);
    $homeController->login($movieRepository);
});

$router->addRoute('GET', '/logout', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new UserRepository();
    $homeController = new UserController($cartRepository);
    $homeController->logout($movieRepository);
});

$router->addRoute('GET', '/cart', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new CartRepository();
    $homeController = new CartController($cartRepository);
    $homeController->cart($movieRepository);
});

$router->addRoute('GET', '/thank-you', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new CartRepository();
    $homeController = new CartController($cartRepository);
    $homeController->thankYou($movieRepository);
});

$router->addRoute('GET', '/checkout', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new CartRepository();
    $homeController = new CartController($cartRepository);
    $homeController->checkout($movieRepository);
});

$router->addRoute('GET', '/charge', function () {
    $cartRepository = new CartRepository();
    $movieRepository = new CartRepository();
    $homeController = new CartController($cartRepository);
    $homeController->charge($movieRepository);
});

$router->matchRoute();