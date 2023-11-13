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
        $sql = "SELECT m.*, c.name as category_name 
                FROM movies AS m
                LEFT JOIN categories AS c ON c.id = m.category_id 
                WHERE m.tmdb_id = '" . $tmdbId . "'";

        $selectMovie = $this->db->query($sql);
        $selectMovie->execute();
        $movie = $selectMovie->fetch(\PDO::FETCH_ASSOC);

        if(!empty($movie)) {
            return $movie;
        }

        return [];
    }
}