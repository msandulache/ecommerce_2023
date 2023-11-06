<?php include_once '../config/config.php'; ?>
<?php include_once '../includes/header.php'; ?>
<?php include_once '../vendor/autoload.php'; ?>
<?php include_once '../secrets.php'; ?>

<?php
if ( $_SERVER['REQUEST_METHOD']=='GET' && realpath(__FILE__) == realpath( $_SERVER['SCRIPT_FILENAME'] ) ) {
    //header( 'HTTP/1.0 403 Forbidden', TRUE, 403 );
    echo 'HTTP/1.0 403 Forbidden';
    exit;
}

if(isset($_SESSION['username'])) {
    echo '<script>window.location="' . APP_URL . 'index.php";</script>';
}

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

echo 'atat';
exit;