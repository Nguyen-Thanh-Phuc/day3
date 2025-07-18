<?php
$host = "localhost";
$username = "root";
$passwd = "";
$dbname = "demo1";


$conn = new mysqli($host, $username, $passwd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
