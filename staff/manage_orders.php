<?php
include("../includes/auth_staff.php");
include("../includes/db.php");
include("../includes/navbar.php");

$result = mysqli_query($conn,"
SELECT orders.*, users.fullname
FROM orders
JOIN users ON orders.user_id = users.id
ORDER BY orders.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>

<title>Manage Orders</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">Manage Orders</h2>

<table class="table table-bordered table-striped">

<tr>

<th>ID</th>
<th>Customer</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td>#<?php echo $row['id']; ?></td>

<td><?php echo $row['fullname']; ?></td>

<td>₹<?php echo $row['total_amount']; ?></td>

<td><?php echo $row['order_status']; ?></td>

<td><?php echo $row['order_date']; ?></td>

<td>

<a href="update_order.php?id=<?php echo $row['id']; ?>"
class="btn btn-primary btn-sm">
Update Status
</a>

<a href="bill.php?id=<?php echo $row['id']; ?>"
class="btn btn-success btn-sm">
Bill
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>