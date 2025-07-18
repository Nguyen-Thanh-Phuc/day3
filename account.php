<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="p-4">
    <div class="container">
        <h3><a href="createAccount.php" class="btn btn-success">Create New</a></h3>
        <h1 class="mb-4">Account List</h1>

        <!-- Search form -->
        <form method="get" class="row g-3 mb-4">
            <div class="col-auto">
                <input type="text" name="keyword" class="form-control" placeholder="Search by email, name, phone" value="<?php echo htmlspecialchars($_GET['keyword'] ?? ''); ?>">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Search</button>
                <a href="account.php" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Id</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Fullname</th>
                    <th>LastLogin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $host = "localhost";
                $username = "root";
                $passwd = "";
                $dbname = "demo1";

                $conn = new mysqli($host, $username, $passwd, $dbname);
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $keyword = $_GET['keyword'] ?? '';
                $sql = "SELECT id, email, phone, fullname, last_login FROM account";
                if ($keyword !== '') {
                    $keyword = "%$keyword%";
                    $sql .= " WHERE email LIKE ? OR fullname LIKE ? OR phone LIKE ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $keyword, $keyword, $keyword);
                    $stmt->execute();
                    $result = $stmt->get_result();
                } else {
                    $result = $conn->query($sql);
                }

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$row['id']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>{$row['phone']}</td>";
                        echo "<td>{$row['fullname']}</td>";
                        echo "<td>{$row['last_login']}</td>";
                        echo "<td>
                                <a href='update.php?id={$row['id']}' class='btn btn-sm btn-primary me-1'>Update</a>
                                <a href='deleteAccount.php?id={$row['id']}' class='btn btn-sm btn-danger' onclick=\"return confirm('Are you sure?')\">Delete</a>
                              </td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' class='text-center'>No accounts found.</td></tr>";
                }

                if (isset($stmt)) $stmt->close();
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
