<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\TwigFunction;

class Controller
{
    protected $twig;
    protected $userId;

    function __construct()
    {
        $loader = new FilesystemLoader(dirname(dirname(__DIR__)) . '/templates');
        $this->twig = new Environment($loader);

        $function = new TwigFunction('asset', function ($asset) {
            return sprintf(URL . 'public/%s', ltrim($asset, '/'));
        });
        $this->twig->addFunction($function);

        if (isset($_SESSION['user_id'])) {
            $this->userId = $_SESSION['user_id'];
        } else {
            $this->userId = 0;
        }
    }
}