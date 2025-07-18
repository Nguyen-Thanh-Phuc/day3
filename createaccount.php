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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Create Account</h1>
        <form action="processCreate.php" method="post" class="border p-4 rounded shadow-sm bg-light">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" id="email" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input name="password" id="password" type="password" class="form-control" required />
            </div>
            <div class="mb-3">
                <label for="fullname" class="form-label">Full name</label>
                <input name="fullname" id="fullname" class="form-control" />
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input name="phone" id="phone" class="form-control" />
            </div>
            <div>
                <input type="submit" value="Create" class="btn btn-success" />
                <a href="account.php" class="btn btn-secondary ms-2">Back</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
