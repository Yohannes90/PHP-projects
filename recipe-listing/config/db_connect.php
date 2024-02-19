<?php
    // initialize a new instance of the Dotenv\Dotenv class and call the load() to load env variables
    require_once __DIR__ . '/../vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();

    $dbHost = $_ENV['DB_HOST'];
    $dbUser = $_ENV['DB_USER'];
    $dbPassword = $_ENV['DB_PASSWORD'];
    $dbName = $_ENV['DB_NAME'];

    $conn = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName);
    if (!$conn) {
        echo("Connection error: ". mysqli_connect_error());
    } else {
        echo("Connection successful");
    }

?>
