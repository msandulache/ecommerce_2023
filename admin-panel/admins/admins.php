<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

?>
<?php
$select = $conn->query("SELECT * FROM admins");
$select->execute();
$admins = $select->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container-fluid">

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Admins</h5>
                    <a href="create-admins.php" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Adminname</th>
                            <th scope="col">Email</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($admins as $admin): ?>
                            <tr>
                                <th scope="row"><?php echo $admin->id; ?></th>
                                <td><?php echo $admin->adminname; ?></td>
                                <td><?php echo $admin->email; ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
<script type="text/javascript">

</script>
</body>
</html>