<?php
$host = 'localhost';
$db = 'test'; //Database Name
$userx = 'root'; //Database Authentication Username
$passx = 'root'; //Database Authentication Password

try {
    $connectionString = 'mysql:host='.$host.';dbname='.$db;
    $conn = new PDO($connectionString, $userx, $passx);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (\PDOException $e) {
    echo $e->getMessage();die();
}
?>