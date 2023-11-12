<?php

use App\Repository\CartRepository;

session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/constants.php';

if(isset($_POST['submit'])) {

    $user_id = $_POST['user_id'];
    $name = $_POST['name'];
    $image = $_POST['image'];
    $price = $_POST['price'];
    $amount = $_POST['amount'];

    $cartRepository = new CartRepository();
    $cartRepository->add($user_id, $name, $image, $price, $amount);

    echo 'successfully added to cart';
}