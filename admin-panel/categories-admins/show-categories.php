<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

$select = $conn->query("SELECT * FROM categories");
$select->execute();
$categories = $select->fetchAll(PDO::FETCH_OBJ);

?>
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Categories</h5>
                    <a href="create-category.php" class="btn btn-primary mb-4 text-center float-right">Create
                        Categories</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">name</th>
                            <th scope="col">update</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($categories as $category): ?>
                            <tr>
                                <th scope="row"><?php echo $category->id; ?></th>
                                <td><?php echo $category->name; ?></td>
                                <td><a href="#" class="btn btn-warning text-white text-center ">Update </a></td>
                                <td><a href="#" class="btn btn-danger  text-center ">Delete </a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<?php include_once '../layouts/footer.php'; ?>