<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if (isset($_POST['submit'])) {

    if (empty($_POST['name']) or empty($_POST['description']) or empty($_FILES['image']['name'])) {
        echo "<script>alert('one or more inputs are empty');</script>";
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'];

        $dir = dirname(dirname(__DIR__)) . "/categories/images/" . basename($image);

        $insert = $conn->prepare("INSERT INTO categories (name, description, image, created_at) VALUES (:name, :description, :image, :created_at)");
        $insert->execute([
            ':name' => $name,
            ':description' => $description,
            ':image' => $image,
            ':created_at' => date('Y-m-d, H:i:s'),
        ]);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $dir)) {
            echo '<script>window.location="' . ADMIN_URL . 'categories-admins/show-categories.php"</script>';
        }
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

                        <div class="form-outline mb-4 mt-4">
                            <label>Name</label>
                            <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name"/>
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea name="description" placeholder="description" class="form-control"
                                      id="exampleFormControlTextarea1" rows="3"></textarea>
                        </div>

                        <div class="form-outline mb-4 mt-4">
                            <label>Image</label>
                            <input type="file" name="image" id="form2Example1" class="form-control"
                                   placeholder="image"/>
                        </div>

                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Create</button>


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