<?php
include("../includes/auth_customer.php");
include("../includes/db.php");

$result=mysqli_query($conn,"
SELECT reservations.*,tables.table_number
FROM reservations
JOIN tables
ON reservations.table_id=tables.id
WHERE user_id='{$_SESSION['user_id']}'
ORDER BY id DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>My Reservations</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../includes/navbar.php"); ?>

<div class="container mt-5">

<h2 class="mb-4">My Reservations</h2>

<table class="table table-bordered">

<tr>

<th>Table</th>
<th>Date</th>
<th>Time</th>
<th>Guests</th>
<th>Status</th>

</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['table_number']; ?></td>

<td><?php echo $row['reservation_date']; ?></td>

<td><?php echo $row['reservation_time']; ?></td>

<td><?php echo $row['guests']; ?></td>

<td><?php echo $row['status']; ?></td>

</tr>

<?php } ?>

</table>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>