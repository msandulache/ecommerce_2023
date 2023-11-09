<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if(!isset($_SESSION['admin_id'])) {
    echo '<script>window.location="' . ADMIN_URL . 'admins/login-admins.php"</script>';
}

if(isset($_POST['submit'])) {
    if(empty($_POST['email']) || empty($_POST['adminname']) || empty($_POST['password'])) {
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $email = $_POST['email'];
        $adminname = $_POST['adminname'];
        $mypassword = $_POST['password'];

        $insert = $conn->prepare("INSERT INTO admins (adminname, email, mypassword, created_at) VALUES (:adminname, :email, :mypassword, :created_at)");
        $insert->execute([
            ':adminname' => $adminname,
            ':email' => $email,
            ':mypassword'   => password_hash($mypassword,PASSWORD_DEFAULT),
            ':created_at' => date('Y-m-d, H:i:s'),
        ]);

        echo '<script>window.location="http://localhost:8100/admin-panel/admins/admins.php";</script>';

    }
}

?>

    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-5 d-inline">Create Admins</h5>
                        <form method="POST" action="" enctype="multipart/form-data">
                            <!-- Email input -->
                            <div class="form-outline mb-4 mt-4">
                                <input type="email" name="email" id="form2Example1" class="form-control"
                                       placeholder="email"/>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="text" name="adminname" id="form2Example1" class="form-control"
                                       placeholder="adminname"/>
                            </div>
                            <div class="form-outline mb-4">
                                <input type="password" name="password" id="form2Example1" class="form-control"
                                       placeholder="password"/>
                            </div>
                            <!-- Submit button -->
                            <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create
                            </button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php include_once '../layouts/footer.php'; ?>