<?php

include_once '../../config/config.php';
include_once '../layouts/header.php';


if(isset($_GET['id'])) {

    try {
        $select = $conn->prepare("SELECT * FROM categories WHERE id = '" . $_GET['id'] . "'");
        $select->execute();

        $images = $select->fetch(PDO::FETCH_OBJ);
        $imageFile = dirname(dirname(__DIR__)) . '/categories/images/' . $images->image;
        if(file_exists($imageFile)) {
            unlink($imageFile);
        }

        $delete = $conn->prepare("DELETE FROM categories WHERE id = '" . $_GET['id'] . "'");
        $delete->execute();
        echo '<script>window.location="http://localhost:8100/admin-panel/categories-admins/show-categories.php";</script>';

    } catch(PDOException $e) {
        $e->getMessage();
    } catch(Exception $e) {
        $e->getMessage();
    }

} else {
    echo '<script>window.location="http://localhost:8100/404.php";</script>';
}
?>
