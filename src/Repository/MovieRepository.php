<?php

namespace App\Repository;

class MovieRepository extends Repository
{
    public function findByCategoryName($categoryName)
    {
        $selectCategory = $this->db->query("SELECT * FROM categories WHERE name = '" . $categoryName . "'");
        $selectCategory->execute();
        $category = $selectCategory->fetch(\PDO::FETCH_ASSOC);

        if(!empty($category)) {
            $selectMovie = $this->db->query("SELECT * FROM movies WHERE category_id = '" . $category['id'] . "'");
            $selectMovie->execute();
            $movies = $selectMovie->fetchAll(\PDO::FETCH_ASSOC);

            return $movies;
        }

        return [];
    }

    public function findByTmdbId($tmdbId)
    {
        $selectMovie = $this->db->query("SELECT * FROM movies WHERE tmdb_id = '" . $tmdbId . "'");
        $selectMovie->execute();
        $movie = $selectMovie->fetch(\PDO::FETCH_ASSOC);

        if(!empty($movie)) {
            return $movie;
        }

        return [];
    }
}