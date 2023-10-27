<?php include_once 'config/config.php'; ?>
<?php include_once 'includes/header.php'; ?>

<?php

if(isset($_POST['delete'])) {
    $update = $conn->prepare("DELETE FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'");
    $update->execute();
}
?>

<?php include_once 'includes/footer.php'; ?>
