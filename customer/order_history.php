<?php
include("../includes/auth_customer.php");

include("../includes/db.php");
include("../includes/navbar.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT *
FROM orders
WHERE user_id='$user_id'
ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Order History</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">My Orders</h2>

<table class="table table-bordered">

<tr>

<th>Order ID</th>
<th>Total</th>
<th>Status</th>
<th>Date</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td>#<?php echo $row['id']; ?></td>

<td>₹<?php echo $row['total_amount']; ?></td>

<td><?php echo $row['order_status']; ?></td>

<td><?php echo $row['order_date']; ?></td>

</tr>

<?php } ?>

</table>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>