<?php

$envPath = __DIR__ . '/.env';
// Load environment variables from .env file
$env = parse_ini_file($envPath);

// Retrieve database configuration from environment variables
$servername = $env['DB_HOST'];
$username = $env['DB_USERNAME'];
$password = $env['DB_PASSWORD'];
$dbname = $env['DB_NAME'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");
?>