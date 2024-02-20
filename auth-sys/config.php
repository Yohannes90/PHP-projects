<?php

    // initialize a new instance of the Dotenv\Dotenv class and call the load() to load env variables
    require_once __DIR__ . '/vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUser = $_ENV['DB_USER'];
    $dbPassword = $_ENV['DB_PASSWORD'];
    $dbName = $_ENV['DB_NAME'];

    $conn = new PDO("mysql:host=$dbHost;dbName=$dbName;", $dbUser, $dbPassword);

    if ($conn == true) {
        echo("Connection successful");
    }



?>
