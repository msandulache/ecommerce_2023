<?php

use App\Repository\CartRepository;

session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/constants.php';

if(isset($_POST['reset'])) {

    $cartRepository = new CartRepository();
    $cartRepository->deleteAllItems();

    echo 'all items successfully removed from cart';
}