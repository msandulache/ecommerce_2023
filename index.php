<?php

session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/constants.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;
use App\Repository\CartRepository;

try {

    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    $function = new TwigFunction('asset', function ($asset) {
        return sprintf(URL . 'public/%s', ltrim($asset, '/'));
    });
    $twig->addFunction($function);

    if (isset($_SESSION['user_id'])) {
        $userId = $_SESSION['user_id'];
    } else {
        $userId = 0;
    }

    if ($_SERVER['REQUEST_URI'] == '/') {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Now Playing');

        echo $twig->render('index.html.twig', ['a' => 1, 'user_id' => $userId, 'movies' => $movies]);
    } else if ($_SERVER['REQUEST_URI'] == '/popular') {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Popular');

        echo $twig->render('popular.html.twig', ['a' => 0, 'user_id' => $userId, 'movies' => $movies]);
    } else if ($_SERVER['REQUEST_URI'] == '/romanian-movies') {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Romanian Night');

        echo $twig->render('romanian-night.html.twig', ['a' => 0, 'user_id' => $userId, 'movies' => $movies]);
    } else if ($_SERVER['REQUEST_URI'] == '/french-movies') {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Films français');

        echo $twig->render('french-movies.html.twig', ['a' => 0, 'user_id' => $userId, 'movies' => $movies]);
    } else if (str_contains($_SERVER['REQUEST_URI'], '/movie/')) {

        $requestUri = explode('/', $_SERVER['REQUEST_URI']);

        if (isset($requestUri[2])) {
            $movieRepository = new MovieRepository();
            $movie = $movieRepository->findByTmdbId($requestUri[2]);

            echo $twig->render('movie.html.twig', ['a' => 0, 'user_id' => $userId, 'movie' => $movie]);
        }
    } else if (str_contains($_SERVER['REQUEST_URI'], '/contact')) {
        echo $twig->render('contact.html.twig', ['a' => 0, 'user_id' => $userId, ]);
    } else if (str_contains($_SERVER['REQUEST_URI'], '/register')) {
        $user = new UserRepository();
        if($user->register()) {
            $movieRepository = new MovieRepository();
            $movies = $movieRepository->findByCategoryName('Now Playing');

            echo $twig->render('index.html.twig', ['a' => 1, 'user_id' => $userId, 'movies' => $movies]);
        } else {
            echo $twig->render('register.html.twig', ['a' => 0, 'user_id' => $userId, 'error' => $user->error]);
        }
    } else if (str_contains($_SERVER['REQUEST_URI'], '/login')) {
        $user = new UserRepository();
        if($user->login()) {
            $movieRepository = new MovieRepository();
            $movies = $movieRepository->findByCategoryName('Now Playing');

            echo $twig->render('index.html.twig', ['a' => 1, 'user_id' => $userId, 'movies' => $movies]);
        } else {
            echo $twig->render('login.html.twig', ['a' => 0, 'user_id' => $userId, 'error' => $user->error]);
        }
    } else if (str_contains($_SERVER['REQUEST_URI'], '/logout')) {
        $user = new UserRepository();
        $user->logout();

        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Now Playing');

        echo $twig->render('index.html.twig', ['a' => 1, 'user_id' => $userId, 'movies' => $movies]);
    } else if (str_contains($_SERVER['REQUEST_URI'], '/cart')) {

        $cartRepository = new CartRepository();
        $items = $cartRepository->showItems();
        echo $twig->render('cart.html.twig', ['a' => 1, 'user_id' => $userId, 'items' => $items]);
    } else if (str_contains($_SERVER['REQUEST_URI'], '/thank-you')) {
        echo $twig->render('thank-you.html.twig', ['a' => 1, 'user_id' => $userId]);
    } else {
        echo $twig->render('404.html.twig', ['a' => 0, 'user_id' => $userId, ]);
    }

} catch (\PDOException $e) {
    echo $e;
} catch (\Exception $e) {
    echo $e;
}
