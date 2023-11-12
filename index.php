<?php

session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/constants.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;
use App\Repository\MovieRepository;
use App\Repository\UserRepository;

try {

    $loader = new FilesystemLoader(__DIR__ . '/templates');
    $twig = new Environment($loader);

    $function = new TwigFunction('asset', function ($asset) {
        return sprintf(URL . 'public/%s', ltrim($asset, '/'));
    });
    $twig->addFunction($function);

    if ($_SERVER['REQUEST_URI'] == '/') {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Now Playing');

        echo $twig->render('index.html.twig', ['a' => 1, 'movies' => $movies]);
    } else if ($_SERVER['REQUEST_URI'] == '/popular') {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Popular');

        echo $twig->render('popular.html.twig', ['a' => 0, 'movies' => $movies]);
    } else if ($_SERVER['REQUEST_URI'] == '/romanian-movies') {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Romanian Night');

        echo $twig->render('romanian-night.html.twig', ['a' => 0, 'movies' => $movies]);
    } else if ($_SERVER['REQUEST_URI'] == '/french-movies') {
        $movieRepository = new MovieRepository();
        $movies = $movieRepository->findByCategoryName('Films français');

        echo $twig->render('french-movies.html.twig', ['a' => 0, 'movies' => $movies]);
    } else if (str_contains($_SERVER['REQUEST_URI'], '/movie/')) {

        $requestUri = explode('/', $_SERVER['REQUEST_URI']);

        if (isset($requestUri[2])) {
            $movieRepository = new MovieRepository();
            $movie = $movieRepository->findByTmdbId($requestUri[2]);

            echo $twig->render('movie.html.twig', ['a' => 0, 'movie' => $movie]);
        }
    } else if (str_contains($_SERVER['REQUEST_URI'], '/contact')) {
        echo $twig->render('contact.html.twig', ['a' => 0]);
    } else if (str_contains($_SERVER['REQUEST_URI'], '/login')) {
        $user = new UserRepository();
        if($user->login()) {
            $movieRepository = new MovieRepository();
            $movies = $movieRepository->findByCategoryName('Now Playing');

            echo $twig->render('index.html.twig', ['a' => 1, 'movies' => $movies]);
        } else {
            echo $twig->render('login.html.twig', ['a' => 0, 'error' => $user->error]);
        }
    } else {
        echo $twig->render('404.html.twig', ['a' => 0]);
    }

} catch (\PDOException $e) {
    echo $e;
} catch (\Exception $e) {
    echo $e;
}
