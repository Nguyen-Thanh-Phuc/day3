<?php
$host = "localhost";
$username = "root";
$passwd = "";
$dbname = "demo1";

$conn = new mysqli($host, $username, $passwd, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_POST['email'];
$fullname = $_POST['fullname'];
$phone = $_POST['phone'];

$sql = "INSERT INTO account (email, password, fullname, phone, last_login) 
        VALUES (?, ?, ?, ?, NOW())";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $email, $password, $fullname, $phone);

if ($stmt->execute()) {
    echo "Account created successfully. <a href='account.php'>Back to list</a>";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
