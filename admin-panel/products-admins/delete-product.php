<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';

if(!isset($_SESSION['admin_id'])) {
    echo '<script>window.location="' . ADMIN_URL . 'admins/login-admins.php"</script>';
}

if(isset($_GET['id'])) {

    try {
        $select = $conn->prepare("SELECT * FROM products WHERE id = '" . $_GET['id'] . "'");
        $select->execute();

        $images = $select->fetch(PDO::FETCH_OBJ);
        $imageFile = dirname(dirname(__DIR__)) . '/images/' . $images->image;
        if(file_exists($imageFile)) {
            unlink($imageFile);
        }

        $file = dirname(dirname(__DIR__)) . '/books/' . $images->file;
        if(file_exists($file)) {
            unlink($file);
        }

        $delete = $conn->prepare("DELETE FROM products WHERE id = '" . $_GET['id'] . "'");
        $delete->execute();
        echo '<script>window.location="http://localhost:8100/admin-panel/products-admins/show-products.php";</script>';

    } catch(PDOException $e) {
        $e->getMessage();
    } catch(Exception $e) {
        $e->getMessage();
    }

} else {
    echo '<script>window.location="http://localhost:8100/404.php";</script>';
}
?>
