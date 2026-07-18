<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

if ($_SESSION['role'] != "staff") {
    header("Location: ../login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <div class="d-flex justify-content-between">

        <h2>Staff Dashboard</h2>

        <a href="../logout.php" class="btn btn-danger">
            Logout
        </a>

    </div>

    <hr>

    <h4>Welcome <?php echo $_SESSION['fullname']; ?></h4>
    
    <div class="mt-4">

    <a href="manage_orders.php" class="btn btn-primary me-2">
        Manage Orders
    </a>

    <a href="bill.php" class="btn btn-success">
        Billing
    </a>

</div>

</div>

</body>

</html>