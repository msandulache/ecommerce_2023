<?php
    session_start();

    define('APP_URL', "http://localhost:8100/");
?>

<?php include_once '/var/www/html/config/config.php'; ?>

<?php

if(isset($_SESSION['user_id'])) {
    $number = $conn->query("SELECT COUNT(*) as products FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'");
    $number->execute();

    $getNumber = $number->fetch(PDO::FETCH_ASSOC);
}

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/5c5946fe44.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <title>Bookstore</title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-dark" >
    <div class="container" style="margin-top: none">
        <a class="navbar-brand  text-white" href="#">Bookstore</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active  text-white" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link  text-white" href="http://localhost/bookstore/contact.php">Contact</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active  text-white" aria-current="page" href="http://localhost/bookstore/shopping/cart.php"><i class="fas fa-shopping-cart"></i>(<?php echo isset($getNumber['products']) ? $getNumber['products'] : '0'; ?>)</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active  text-white" aria-current="page" href="http://localhost/bookstore/categories/index.php">Categories</a>
                </li>
                <?php if(isset($_SESSION['username'])): ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle  text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php echo $_SESSION['username']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                            <li><a class="dropdown-item" href="auth/logout.php">Log out</a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="auth/login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link  text-white" href="auth/register.php">Register</a>
                    </li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>