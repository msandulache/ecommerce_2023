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

        /*
         *


    [title] => Boudica
    [original_language] => en
    [original_title] => Boudica
    [overview] => Inspired by events in A.D. 60, Boudica follows the eponymous Celtic warrior who rules the Iceni people alongside her husband Prasutagus. When he dies at the hands of Roman soldiers, Boudica’s kingdom is left without a male heir and the Romans seize her land and property.  Driven to the edge of madness and determined to avenge her husband’s death, Boudica rallies the various tribes from the region and wages an epic war against the mighty Roman empire.
    [genre_ids] => 28,10752
    [backdrop_path] => /tj7mp7uWjVw5N73G5Hwm1bkMOcD.jpg
    [poster_path] => /ssEFC5wfFjj7lJpUgwJDOK1Xu1J.jpg
    [adult] => 0
    [video] => 0
    [popularity] => 1206
    [vote_average] => 7
    [vote_count] => 50
    [category_id] => 4
    [release_date] => 2023-10-26*/
        echo $this->twig->render('movie.html.twig', ['a' => 0, 'user_id' => $this->userId, 'movie' => $movie]);
        exit;
    }


}