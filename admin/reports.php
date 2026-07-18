<?php
include("../includes/auth_admin.php");
include("../includes/db.php");

// Total Customers
$customers = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM users WHERE role='customer'")
);

// Total Orders
$orders = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM orders")
);

// Total Reservations
$reservations = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT COUNT(*) AS total FROM reservations")
);

// Total Revenue
$revenue = mysqli_fetch_assoc(
    mysqli_query($conn, "SELECT SUM(total_amount) AS total FROM orders")
);

$totalRevenue = $revenue['total'] ?? 0;
?>

<!DOCTYPE html>
<html>

<head>

    <title>Reports</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../includes/navbar.php"); ?>

<div class="container mt-5">

    <h2 class="mb-4">Reports Dashboard</h2>

    <div class="row">

        <div class="col-md-3 mb-4">

            <div class="card text-center">

                <div class="card-body">

                    <h5>Total Customers</h5>

                    <h2><?php echo $customers['total']; ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card text-center">

                <div class="card-body">

                    <h5>Total Orders</h5>

                    <h2><?php echo $orders['total']; ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card text-center">

                <div class="card-body">

                    <h5>Total Reservations</h5>

                    <h2><?php echo $reservations['total']; ?></h2>

                </div>

            </div>

        </div>

        <div class="col-md-3 mb-4">

            <div class="card text-center">

                <div class="card-body">

                    <h5>Total Revenue</h5>

                    <h2>₹<?php echo $totalRevenue; ?></h2>

                </div>

            </div>

        </div>

    </div>

</div>

<?php include("../includes/footer.php"); ?>

</body>

</html>