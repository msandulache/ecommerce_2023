<?php

session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/constants.php';

use App\Exceptions\RouteException;

try {
    require __DIR__ . '/src/routes.php';
} catch (\PDOException $e) {
    echo $e;
} catch (RouteException $e) {
    $homeController = new PageController();
    $homeController->notFound();
    exit;
} catch (\Exception $e) {
    echo $e;
}
