<?php
session_start();

//host
$host = 'database';

//dbname
$dbname = "php_master";

//user
$user = 'php_master';

//pass
$pass = "secret";

$conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if($conn) {
    echo "";
} else {
    echo "error in db connection";exit;
}


$select = $conn->query("SELECT * FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'");
$select->execute();
$allProducts = $select->fetchAll(PDO::FETCH_OBJ);

$files = array('readme.txt', 'test.html', 'image.gif');

$zipname = 'bookstore.zip';

$zip = new \ZipArchive();
$zip->open($zipname, ZipArchive::CREATE);
foreach ($allProducts as $product) {
    $zip->addFile("books/" . $product->pro_file);
}
$zip->close();

header('Content-Type: application/zip');
header('Content-disposition: attachment;filename='. $zipname);
header('Content-Length: ' . filesize($zipname));
readFile($zipname);

$select = $conn->query("DELETE FROM cart WHERE user_id = '" . $_SESSION['user_id'] . "'");
$select->execute();

header("location: index.php");
?>