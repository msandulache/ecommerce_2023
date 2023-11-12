<?php

namespace App\Repository;

class UserRepository extends Repository
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

                $login = $this->db->query("SELECT * FROM users WHERE email = '$email'");
                $login->execute();

                $fetch = $login->fetch(\PDO::FETCH_ASSOC);
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

    public function register()
    {
        if (isset($_POST['submit'])) {
            if (empty($_POST['firstname']) || empty($_POST['lastname']) ||
                empty($_POST['username']) || empty($_POST['email']) ||
                empty($_POST['password']) || !isset($_POST['chekcbox1'])) {
                $this->error = 'One or more inputs are empty';
                return false;
            } else {
                $firstname = $_POST['firstname'];
                $lastname = $_POST['lastname'];
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                $insert = $this->db->prepare("INSERT INTO users (firstname, lastname, username, email, password, created_at) VALUES (:firstname, :lastname, :username, :email, :password, :created_at)");

                $insert->execute([
                    ':firstname' => $firstname,
                    ':lastname' => $lastname,
                    ':username' => $username,
                    ':email' => $email,
                    ':password' => password_hash($password, PASSWORD_DEFAULT),
                    ':created_at' => date("Y-m-d H:i:s"),
                ]);

                return true;
            }
        }
    }

    public function logout()
    {
        session_unset();
        session_destroy();
    }
}