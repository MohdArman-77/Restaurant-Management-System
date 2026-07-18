<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "staff") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$id = intval($_GET['id']);

if(isset($_POST['update'])){

    $status = $_POST['status'];

    mysqli_query($conn,
    "UPDATE orders
    SET order_status='$status'
    WHERE id='$id'");

    header("Location: manage_orders.php");
    exit();
}

$result = mysqli_query($conn,
"SELECT * FROM orders
WHERE id='$id'");

$order = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>

<title>Update Order</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2>Update Order Status</h2>

<form method="POST">

<div class="mb-3">

<label>Status</label>

<select name="status" class="form-control">

<option <?php if($order['order_status']=="Pending") echo "selected"; ?>>
Pending
</option>

<option <?php if($order['order_status']=="Preparing") echo "selected"; ?>>
Preparing
</option>

<option <?php if($order['order_status']=="Completed") echo "selected"; ?>>
Completed
</option>

</select>

</div>

<button class="btn btn-success" name="update">

Update

</button>

</form>

</div>

</body>
</html>