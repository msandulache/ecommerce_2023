<?php

session_start();

if(!isset($_SESSION['admin_id'])) {
    echo '<script>window.location="' . ADMIN_URL . 'admins/login-admins.php"</script>';
}

session_unset();
session_destroy();

header("Location: http://localhost:8100/admin-panel/index.php");