<?php

namespace App\Controller;

use App\Repository\UserRepository;
use http\Client\Curl\User;

class UserController extends Controller
{
    public function login(UserRepository $userRepository)
    {
        if($userRepository->login()) {
            header('Location: http://localhost:8100/');
        } else {
            echo $this->twig->render('login.html.twig', ['a' => 0,
                'user_id' => $this->userId, 'error' => $userRepository->error]);
        }
    }

    public function register(UserRepository $userRepository)
    {
        if($userRepository->register()) {
            header('Location: http://localhost:8100/');
        } else {
            $this->showRegisterForm();
        }
    }

    public function showRegisterForm()
    {
        echo $this->twig->render('register.html.twig', ['a' => 0, 'user_id' => $this->userId]);
    }

    public function logout(UserRepository $userRepository)
    {
        $userRepository->logout();

        header('Location: http://localhost:8100/');
    }
}