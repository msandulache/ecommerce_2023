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
    $movieRepository = new MovieRepository();
    $homeController = new MovieController();
    $homeController->nowPlaying($movieRepository);
});

$router->addRoute('GET', '/popular', function () {
    $movieRepository = new MovieRepository();
    $homeController = new MovieController();
    $homeController->popular($movieRepository);
});

$router->addRoute('GET', '/romanian-movies', function () {
    $movieRepository = new MovieRepository();
    $homeController = new MovieController();
    $homeController->romanianMovies($movieRepository);
});

$router->addRoute('GET', '/french-movies', function () {
    $movieRepository = new MovieRepository();
    $homeController = new MovieController();
    $homeController->frenchMovies($movieRepository);
});

$router->addRoute('GET', '/movie/:movieID', function ($movieID) {
    $movieRepository = new MovieRepository();
    $homeController = new MovieController();
    $homeController->getMovie($movieRepository, $movieID);
});

$router->addRoute('GET', '/contact', function () {
    $homeController = new PageController();
    $homeController->show();
});

$router->addRoute('GET', '/register', function () {
    $movieRepository = new UserRepository();
    $homeController = new UserController();
    $homeController->showRegisterForm($movieRepository);
});

$router->addRoute('POST', '/register', function () {
    $movieRepository = new UserRepository();
    $homeController = new UserController();
    $homeController->register($movieRepository);
});

$router->addRoute('GET', '/login', function () {
    $movieRepository = new UserRepository();
    $homeController = new UserController();
    $homeController->login($movieRepository);
});

$router->addRoute('GET', '/logout', function () {
    $movieRepository = new UserRepository();
    $homeController = new UserController();
    $homeController->logout($movieRepository);
});

$router->addRoute('GET', '/cart', function () {
    $movieRepository = new CartRepository();
    $homeController = new CartController();
    $homeController->cart($movieRepository);
});

$router->addRoute('GET', '/thank-you', function () {
    $movieRepository = new CartRepository();
    $homeController = new CartController();
    $homeController->thankYou($movieRepository);
});

$router->addRoute('GET', '/checkout', function () {
    $movieRepository = new CartRepository();
    $homeController = new CartController();
    $homeController->checkout($movieRepository);
});

$router->addRoute('GET', '/charge', function () {
    $movieRepository = new CartRepository();
    $homeController = new CartController();
    $homeController->charge($movieRepository);
});

$router->matchRoute();