<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if(!isset($_SESSION['admin_id'])) {
    echo '<script>window.location="' . ADMIN_URL . 'admins/login-admins.php"</script>';
}

$select = $conn->query("SELECT p.*, c.name as category_name FROM products as p LEFT JOIN categories as c ON c.id = p.category_id");
$select->execute();
$products = $select->fetchAll(PDO::FETCH_OBJ);

?>
    <div class="container-fluid">

        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title mb-4 d-inline">Products</h5>
                        <a href="<?php echo ADMIN_URL; ?>products-admins/create-product.php"
                           class="btn btn-primary mb-4 text-center float-right">Create
                            Products</a>

                        <table class="table" id="tblUser">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">product</th>
                                <th scope="col">price in $$</th>
                                <th scope="col">category</th>
                                <th scope="col">status</th>
                                <th scope="col">delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <th scope="row"><?php echo $product->id; ?></th>
                                    <td><?php echo $product->name; ?></td>
                                    <td><?php echo $product->price; ?></td>
                                    <td><?php echo $product->category_name; ?></td>
                                    <?php if ($product->status > 0): ?>
                                        <td><a href="<?php echo ADMIN_URL . 'products-admins/status-product.php?id=' . $product->id; ?>&status=unverify" class="btn btn-danger text-center">Unverify</a></td>
                                    <?php else: ?>
                                        <td><a href="<?php echo ADMIN_URL . 'products-admins/status-product.php?id=' . $product->id; ?>&status=verify" class="btn btn-success text-center">Verify</a></td>
                                    <?php endif; ?>
                                    <td>
                                        <a href="<?php echo ADMIN_URL . 'products-admins/delete-product.php?id=' . $product->id; ?>"
                                           class="btn btn-danger  text-center ">delete</a></td>
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
        jQuery(document).ready(function ($) {
            jQuery('#tblUser').DataTable();
        });
    </script>
<?php include_once '../layouts/footer.php'; ?>