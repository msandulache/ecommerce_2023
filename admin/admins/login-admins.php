<?php
session_start();

include_once '../../config/config.php';
include_once '../layouts/header.php';


if (isset($_POST['submit'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $email = $_POST['email'];
        $mypassword = $_POST['password'];

        $login = $conn->query("SELECT * FROM admins WHERE email = '$email'");
        $login->execute();

        $fetch = $login->fetch(PDO::FETCH_ASSOC);

        if ($login->rowCount() > 0) {
            if (password_verify($mypassword, $fetch["mypassword"])) {
                $_SESSION['adminname'] = $fetch['adminname'];
                $_SESSION['admin_id'] = $fetch['id'];

                echo '<script>window.location="' . ADMIN_URL . 'index_old.php";</script>';

                echo 'LOGGED IN';
                exit;
            } else {
                echo "<script>alert('email or password are wrong');</script>";
            }
        } else {
            echo "<script>alert('email or password are wrong');</script>";
        }
    }
}

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mt-5">Login</h5>
                        <form method="POST" class="p-auto" action="login-admins.php">
                            <!-- Email input -->
                            <div class="form-outline mb-4">
                                <input type="email" name="email" id="form2Example1" class="form-control"
                                       placeholder="Email"/>
                            </div>


                            <!-- Password input -->
                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="form2Example2" placeholder="Password"
                                       class="form-control"/>

                            </div>


                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Login</button>


                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>