<?php
$dbHost = 'loaclhost';
$dbPort = 3306;
$dbName = 'moja_strona';
$dbUser = 'UZYTKOWNIK';
$dbPass = 'HASLO';

$dsn = "mysql:host=$dbHost;port=$dbPort;dbname=$dbName;charset=utf8mb4";

$pdo = new PDO($dsn, $dbUser, $dbPass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
]);