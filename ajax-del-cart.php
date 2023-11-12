<?php

use App\Repository\CartRepository;

session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/constants.php';

if(isset($_POST['delete']) && isset($_POST['id'])) {

    $cartRepository = new CartRepository();
    $cartRepository->deleteItem($_POST['id']);

    echo 'item successfully removed from cart';
}