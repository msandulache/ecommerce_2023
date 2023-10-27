<?php include_once 'config/config.php'; ?>
<?php include_once 'includes/header.php'; ?>

<?php

if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $pro_amount = $_POST['pro_amount'];

    $update = $conn->prepare("UPDATE cart SET pro_amount = '" . $pro_amount . "' WHERE pro_id = '" . $id . "'");
    $update->execute();
}
?>

<?php include_once 'includes/footer.php'; ?>
