<?php

namespace App\Repository;

class UserRepository
{
    public string $error = '';

    public function login()
    {
        if (isset($_POST['submit'])) {
            if (empty($_POST['email']) || empty($_POST['password'])) {
                $this->error = 'One or more inputs are empty';
                return false;
            } else {
                $email = $_POST['email'];
                $mypassword = $_POST['password'];

                $login = $conn->query("SELECT * FROM users WHERE email = '$email'");
                $login->execute();

                $fetch = $login->fetch(PDO::FETCH_ASSOC);
                if ($login->rowCount() > 0) {
                    if (password_verify($mypassword, $fetch["password"])) {
                        $_SESSION['username'] = $fetch['username'];
                        $_SESSION['user_id'] = $fetch['id'];

                        return true;
                    } else {
                        $this->error = 'E-mail or password are wrong';
                        return false;
                    }
                } else {
                    $this->error = 'E-mail or password are wrong';
                    return false;
                }
            }
        }
    }
}