<?php

session_start();

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/config/constants.php';


if(
    empty($_POST['fname']) OR
    empty($_POST['lname']) OR
    empty($_POST['username']) OR
    empty($_POST['email'])
) {
    echo "<script>alert('one or more inputs are empty')</script>";
} else {
    $insert = $conn->prepare("INSERT INTO orders (email, username, fname, lname, token, price, created_at) VALUES 
                                (:email, :username, :fname, :lname, :token, :price, :created_at)");

    $email = $_POST['email'];
    $username = $_SESSION['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $token = $_POST['stripeToken'];
    $price = (isset($_SESSION['price']) ? (int)number_format($_SESSION['price'], 2) * 100: 0);
    $created_at = date("Y-m-d H:i:s");

    $insert->execute([
        ':email' => $email,
        ':username' => $username,
        ':fname' => $fname,
        ':lname' => $lname,
        ':token' => $token,
        ':price' => $price,
        ':created_at' => $created_at
    ]);
}

\Stripe\Stripe::setApiKey($stripeSecretKey);
$token = $_POST['stripeToken'];

$charge = \Stripe\Charge::create(
    array(
        'amount' => (isset($_SESSION['price']) ? (int)number_format($_SESSION['price'], 2) * 100: '0'),
        'currency' => 'ron',
        'source' => $token
    )
);

$delCart = $conn->query("DELETE FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'");
$delCart->execute();

echo 'atat';
exit;