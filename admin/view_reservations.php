<?php
include("../includes/auth_admin.php");
include("../includes/db.php");

$result = mysqli_query($conn,"
SELECT reservations.*,
users.fullname,
tables.table_number
FROM reservations
JOIN users ON reservations.user_id = users.id
JOIN tables ON reservations.table_id = tables.id
ORDER BY reservations.id DESC");
?>

<!DOCTYPE html>
<html>
<head>
<title>Reservations</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<?php include("../includes/navbar.php"); ?>

<div class="container mt-5">

<h2 class="mb-4">Manage Reservations</h2>

<table class="table table-bordered">

<tr>
<th>Customer</th>
<th>Table</th>
<th>Date</th>
<th>Time</th>
<th>Guests</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['fullname']; ?></td>
<td><?php echo $row['table_number']; ?></td>
<td><?php echo $row['reservation_date']; ?></td>
<td><?php echo $row['reservation_time']; ?></td>
<td><?php echo $row['guests']; ?></td>
<td><?php echo $row['status']; ?></td>

<td>

<?php if($row['status']=="Pending"){ ?>

<a class="btn btn-success btn-sm"
href="update_reservation.php?id=<?php echo $row['id']; ?>&status=Approved">
Approve
</a>

<a class="btn btn-danger btn-sm"
href="update_reservation.php?id=<?php echo $row['id']; ?>&status=Cancelled">
Cancel
</a>

<?php } elseif($row['status']=="Approved"){ ?>

<span class="badge bg-success">Approved</span>

<?php } else { ?>

<span class="badge bg-danger">Cancelled</span>

<?php } ?>

</td>

</tr>

<?php } ?>

</table>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>