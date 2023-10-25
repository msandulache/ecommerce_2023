<?php
include_once '../config/config.php';
include_once '../includes/header.php';

if(isset($_SESSION['username'])) {
    echo '<script>window.location="' . APP_URL . 'index.php";</script>';
}

if(isset($_POST['submit'])) {
    if(empty($_POST['email']) || empty($_POST['mypassword'])) {
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {

        $email = $_POST['email'];
        $mypassword = $_POST['mypassword'];

        $login = $conn->query("SELECT * FROM users WHERE email = '$email'");
        $login->execute();

        $fetch = $login->fetch(PDO::FETCH_ASSOC);
        if($login->rowCount() > 0) {
            if(password_verify($mypassword, $fetch["mypassword"])) {
                $_SESSION['username'] = $fetch['username'];
                $_SESSION['user_id'] = $fetch['id'];

                echo '<script>window.location="' . APP_URL . 'index.php";</script>';
            } else {
                echo "<script>alert('email or password are wrong');</script>";
            }
        } else {
            echo "<script>alert('email or password are wrong');</script>";
        }
    }
}

?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form class="form-control mt-5" method="POST" action="login.php">
                    <h4 class="text-center mt-3"> Login </h4>
                   
                    <div class="">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="">
                            <input type="email"  class="form-control" id="email" value="" name="email">
                        </div>
                    </div>
                    <div class="">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="">
                            <input type="password" class="form-control" id="inputPassword" name="mypassword">
                        </div>
                    </div>
                    <button name="submit" class="w-100 btn btn-lg btn-primary mt-4" type="submit">Login</button>

                </form>
            </div>
        </div>
    </div>

<?php include ('../includes/footer.php'); ?>