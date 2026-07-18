<?php
include("../includes/auth_admin.php");
include("../includes/navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

<div class="container mt-5">

    <h2 class="mb-4">Admin Dashboard</h2>

    <div class="row">

        <div class="col-md-3 mb-3">
            <a href="view_menu.php" class="btn btn-primary w-100">
                Manage Menu
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="manage_customers.php" class="btn btn-success w-100">
                Manage Customers
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="manage_tables.php" class="btn btn-warning w-100">
                Manage Tables
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="view_reservations.php" class="btn btn-info w-100">
                Reservations
            </a>
        </div>

        <div class="col-md-3 mb-3">
            <a href="reports.php" class="btn btn-dark w-100">
                Reports
            </a>
        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>