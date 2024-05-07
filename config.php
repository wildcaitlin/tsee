<?php

$host = "127.0.0.1";
$dbname = "tse";
$username = "root";
$password = "";

$conn = mysqli_connect($host, $username, $password, $dbname);

// Check for connection errors
if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}
