<?php

$host = 'localhost:3306';
$dbname = 'winkel_bp';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die('Databasefout: ' . $e->getMessage());
}
?>