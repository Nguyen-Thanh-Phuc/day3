<?php
$host = "localhost";
$username = "root";
$passwd = "";
$dbname = "demo1";

$conn = new mysqli($host, $username, $passwd, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $_GET['id'] ?? null;
if (!$id) {
    die("Invalid ID.");
}

$sql = "SELECT * FROM account WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    die("Account not found.");
}
$account = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h1 class="mb-4">Update Account</h1>
        <form action="processUpdate.php" method="post" class="border p-4 rounded bg-light shadow-sm">
            <input type="hidden" name="id" value="<?php echo $account['id']; ?>" />

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input name="email" id="email" class="form-control" value="<?php echo $account['email']; ?>" required />
            </div>

            <div class="mb-3">
                <label for="fullname" class="form-label">Full name</label>
                <input name="fullname" id="fullname" class="form-control" value="<?php echo $account['fullname']; ?>" />
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input name="phone" id="phone" class="form-control" value="<?php echo $account['phone']; ?>" />
            </div>

            <div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="account.php" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
