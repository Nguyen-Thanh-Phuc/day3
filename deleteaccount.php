<?php
$host = "localhost";
$username = "root";
$passwd = "";
$dbname = "demo1";

$conn = new mysqli($host, $username, $passwd, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "DELETE FROM account WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: account.php");
    exit();
} else {
    echo "Error deleting account: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
