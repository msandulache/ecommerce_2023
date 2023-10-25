<?php

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

?>