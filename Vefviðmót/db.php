<?php
/* Connect to an ODBC database using driver invocation */
$dsn = 'mysql:charset=utf8mb4;dbname=hotel;host=localhost';
$user = 'root';
$password = '';

try {
    $dbconnect = new PDO($dsn, $user, $password);
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage();
}
?>