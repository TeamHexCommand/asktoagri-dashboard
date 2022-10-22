<?php

$host = $_SERVER['DB_HOST'];
$user = $_SERVER['DB_USER'];
$pass = $_SERVER['DB_PASSWORD'];
$db   = $_SERVER['DB_DATABASE'];
$port = $_SERVER['DB_PORT'];

$con = mysqli_connect($host, $user, $pass, $db, $port);

// Check connection
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}