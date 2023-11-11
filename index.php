<?php

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/constants.php';

use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

$loader = new FilesystemLoader(__DIR__ . '/templates');
$twig = new Environment($loader);

$function = new TwigFunction('asset', function ($asset) {
    return sprintf(URL . 'public/%s', ltrim($asset, '/'));
});
$twig->addFunction($function);

echo $twig->render('index.html.twig', ['a' => 1]);
