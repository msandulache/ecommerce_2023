<?php

require_once('../vendor/autoload.php');
include_once '../config/config.php';
include_once '../includes/header.php';


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

foreach($genres as $genre) {
    $select = $conn->query("SELECT * FROM genres WHERE tmdb_id = '" . $genre['id'] . "'");
    $select->execute();
    $selectGenre = $select->fetch(PDO::FETCH_ASSOC);
    if(empty($selectGenre)) {
        $sql = sprintf("INSERT INTO genres(tmdb_id, name, created_at) VALUES('%s', '%s', '%s')",
            $genre['id'],
            $genre['name'],
            date('Y-m-d H:i:s')
        );

        $conn->query($sql);
    } else {
        $update = $conn->prepare("UPDATE genres SET 
                    tmdb_id=:tmdb_id,
                    name=:name
                        WHERE id='" . $selectGenre['id'] . "'");

        $update->execute([
            ':tmdb_id' => $genre['id'],
            ':name' => $genre['name']
        ]);

    }

}

echo '<pre>';
print_r($body);


