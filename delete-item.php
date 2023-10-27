<?php include_once 'config/config.php'; ?>
<?php include_once 'includes/header.php'; ?>

<?php

if(isset($_POST['delete'])) {
    $id = $_POST['id'];

    $update = $conn->prepare("DELETE FROM cart WHERE pro_id = '" . $id . "'");
    $update->execute();
}
?>

<?php include_once 'includes/footer.php'; ?>
