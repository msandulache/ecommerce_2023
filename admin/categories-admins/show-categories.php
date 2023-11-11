<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if(!isset($_SESSION['admin_id'])) {
    echo '<script>window.location="' . ADMIN_URL . 'admins/login-admins.php"</script>';
}

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
                    <a href="<?php echo ADMIN_URL . 'categories-admins/create-category.php'; ?>" class="btn btn-primary mb-4 text-center float-right">Create
                        Categories</a>
                    <table class="table" id="tblUser">
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
                                <td><a href="<?php echo ADMIN_URL . 'categories-admins/update-category.php?id=' . $category->id; ?>" class="btn btn-warning text-white text-center ">Update </a></td>
                                <td><a href="<?php echo ADMIN_URL . 'categories-admins/delete-category.php?id=' . $category->id; ?>" class="btn btn-danger  text-center ">Delete </a></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
    <script>
        jQuery(document).ready(function($) {
            jQuery('#tblUser').DataTable();
        } );
    </script>
<?php include_once '../layouts/footer.php'; ?>