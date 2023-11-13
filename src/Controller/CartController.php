<?php

namespace App\Controller;

use App\Repository\CartRepository;

class CartController extends Controller
{
    public function cart(CartRepository $cartRepository)
    {
        $items = $cartRepository->showItems();
        echo $this->twig->render('cart.html.twig',
            ['a' => 0, 'user_id' => $this->userId, 'items' => $items]);
    }

    public function checkout()
    {
        echo $twig->render('checkout.html.twig', ['a' => 0, 'user_id' => $this->userId]);
    }

    public function charge()
    {
        \Stripe\Stripe::setApiKey($stripeSecretKey);
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create(
            array(
                'amount' => (isset($_SESSION['price']) ? (int)number_format($_SESSION['price'], 2) * 100: '0'),
                'currency' => 'ron',
                'source' => $token
            )
        );

        $cart = new CartRepository();
        $cart->deleteAllItems();
        echo $twig->render('thank-you.html.twig', ['a' => 0, 'user_id' => $userId]);
    }

    public function thankYou()
    {
        echo $this->twig->render('thank-you.html.twig', ['a' => 0, 'user_id' => $this->userId]);
    }




}