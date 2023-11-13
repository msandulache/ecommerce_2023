<?php

namespace App\Controller;

use App\Repository\MovieRepository;

class MovieController extends Controller
{
    public function nowPlaying(MovieRepository $movieRepository)
    {
        $movies = $movieRepository->findByCategoryName('Now Playing');

        echo $this->twig->render('index.html.twig',
            ['a' => 1, 'user_id' => $this->userId, 'movies' => $movies]);
        exit;
    }

    public function popular(MovieRepository $movieRepository)
    {
        $movies = $movieRepository->findByCategoryName('Popular');

        echo $this->twig->render('popular.html.twig',
            ['a' => 0, 'user_id' => $this->userId, 'movies' => $movies]);
        exit;
    }

    public function romanianMovies(MovieRepository $movieRepository)
    {
        $movies = $movieRepository->findByCategoryName('Romanian Night');

        echo $this->twig->render('romanian-night.html.twig',
            ['a' => 0, 'user_id' => $this->userId, 'movies' => $movies]);
        exit;
    }

    public function frenchMovies(MovieRepository $movieRepository)
    {
        $movies = $movieRepository->findByCategoryName('Films français');

        echo $this->twig->render('french-movies.html.twig',
            ['a' => 0, 'user_id' => $this->userId, 'movies' => $movies]);
        exit;
    }

    public function getMovie(MovieRepository $movieRepository, int $movieId)
    {
        $movie = $movieRepository->findByTmdbId($movieId);

        echo $this->twig->render('movie.html.twig', ['a' => 0, 'user_id' => $this->userId, 'movie' => $movie]);
        exit;
    }


}