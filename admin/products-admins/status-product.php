<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if(!isset($_SESSION['admin_id'])) {
    echo '<script>window.location="' . ADMIN_URL . 'admins/login-admins.php"</script>';
}

if(isset($_GET['id']) && isset($_GET['status'])) {
    $id = $_GET['id'];

    if($_GET['status'] == 'verify') {
        $status = 1;
    }

    if($_GET['status'] == 'unverify') {
        $status = 0;
    }

    if(isset($status)) {
        $update = $conn->prepare("UPDATE products SET status = '" . $status . "' WHERE id = '" . $id . "'");
        $update->execute();
        echo '<script>window.location="' . ADMIN_URL . 'products-admins/show-products.php"</script>';
    }
}
?>

<?php include_once '../../includes/footer.php'; ?>