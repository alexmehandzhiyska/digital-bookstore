<?php
    $host = "localhost";
    $username = "root";
    $password = "";
    $name = "digital-bookstore-test";

    $dsn = "mysql:host=$host;dbname=$name;";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $pdo_conn = new PDO($dsn, $username, $password, $options);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

?>