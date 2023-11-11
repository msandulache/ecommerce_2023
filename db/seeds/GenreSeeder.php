<?php

declare(strict_types=1);

use Phinx\Seed\AbstractSeed;

class GenreSeeder extends AbstractSeed
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

        $response = $client->request('GET', 'https://api.themoviedb.org/3/genre/movie/list?language=en', [
            'headers' => [
                'Authorization' => 'Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI5MWZiMjI2MzFjYmRkOTZiMzZlMWFhZDBiYjI3YmFmMSIsInN1YiI6IjY0NTUwNTAyZDQ4Y2VlMDBmY2VlYTBjMyIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.UB6TNHT7P4Wce6O5hzDoc5sV3bf0Ox3W0Y7h4G6nroA',
                'accept' => 'application/json',
            ],
        ]);

        $body = $response->getBody()->getContents();
        $body = json_decode($body, true);
        $genres = $body['genres'];

        $data = [];
        foreach($genres as $genre) {
            $data[] = [
                'tmdb_id'    => $genre['id'],
                'name' => $genre['name'],
            ];
        }

        $genres = $this->table('genres');
        $genres->truncate();

        $genres->insert($data)
            ->saveData();

    }
}
