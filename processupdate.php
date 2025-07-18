<?php
$host = "localhost";
$username = "root";
$passwd = "";
$dbname = "demo1";

$conn = new mysqli($host, $username, $passwd, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_POST['id'];
$email = $_POST['email'];
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];

$sql = "UPDATE account SET email = ?, fullname = ?, phone = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sssi", $email, $fullname, $phone, $id);

if ($stmt->execute()) {
    header("Location: account.php");
    exit();
} else {
    echo "Error updating account: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
