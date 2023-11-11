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
}