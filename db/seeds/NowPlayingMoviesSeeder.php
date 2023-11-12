<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class NowPlayingMoviesSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * https://book.cakephp.org/phinx/0/en/seeding.html
     */
    public function run(): void
    {
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET', 'https://api.themoviedb.org/3/movie/now_playing', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MWZiMjI2MzFjYmRkOTZiMzZlMWFhZDBiYjI3YmFmMSIsInN1YiI6IjY0NTUwNTAyZDQ4Y2VlMDBmY2VlYTBjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.UB6TNHT7P4Wce6O5hzDoc5sV3bf0Ox3W0Y7h4G6nroA',
                'accept' => 'application/json',
            ],
        ]);

        $body = $response->getBody()->getContents();
        $body = json_decode($body, true);
        $movies = $body['results'];

        $category = $this->fetchRow('SELECT * FROM categories WHERE name = "Now playing" AND status = 1');

        $data = [];

        if(!empty($category)) {

            $this->execute('DELETE FROM movies WHERE category_id = ' . $category['id']);

            foreach ($movies as $movie) {
                $data[] = [
                    'tmdb_id' => $movie['id'],
                    'title' => $movie['title'],
                    'original_language' => $movie['original_language'],
                    'original_title' => $movie['original_title'],
                    'overview' => $movie['overview'],
                    'genre_ids' => implode(",", $movie['genre_ids']),
                    'backdrop_path' => $movie['backdrop_path'],
                    'poster_path' => $movie['poster_path'],
                    'adult' => ($movie['adult'] == true ? 1 : 0),
                    'video' => ($movie['video'] == true ? 1 : 0),
                    'popularity' => $movie['popularity'],
                    'vote_average' => $movie['vote_average'],
                    'vote_count' => $movie['vote_count'],
                    'category_id' => $category['id'],
                    'release_date' => $movie['release_date'],
                ];
            }

            $movies = $this->table('movies');

            $movies->insert($data)
                ->saveData();
        }
    }
}
