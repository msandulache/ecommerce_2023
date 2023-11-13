<?php

namespace App\Controller;

class PageController extends Controller
{
    public function contact()
    {
        echo $this->twig->render('contact.html.twig', ['a' => 0, 'user_id' => $this->userId, ]);
        exit;
    }

    public function notFound()
    {
        echo $this->twig->render('404.html.twig', ['a' => 0, 'user_id' => $this->userId, ]);
        exit;
    }
}