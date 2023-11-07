<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if(isset($_POST['submit'])) {
    if(empty($_POST['name'])) {
        echo "<script>alert('input name is empty');</script>";
    } else {
        $name = $_POST['name'];

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
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
          <form method="POST" action="" enctype="multipart/form-data">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
  </div>
<script type="text/javascript">

</script>
</body>
</html>