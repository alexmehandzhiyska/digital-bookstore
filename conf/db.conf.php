<?php
// Database settings. Change these for your database configuration.
$dbConfig = [
    'host' => 'localhost',
    'username' => 'root',
    'password' => '',
    'name' => 'digital-bookstore'
];

// Create a connection to the database.
$db = new mysqli($dbConfig['host'], $dbConfig['username'], $dbConfig['password'], $dbConfig['name']);

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}