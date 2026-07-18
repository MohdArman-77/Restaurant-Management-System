<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");
include("../includes/navbar.php");

$result = mysqli_query($conn,"SELECT * FROM tables ORDER BY table_number");
?>

<!DOCTYPE html>
<html>
<head>
<title>Manage Tables</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2 class="mb-4">Restaurant Tables</h2>

<a href="add_table.php" class="btn btn-success mb-3">
Add Table
</a>

<table class="table table-bordered">

<tr>
<th>Table No.</th>
<th>Capacity</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php while($row=mysqli_fetch_assoc($result)){ ?>

<tr>

<td><?php echo $row['table_number']; ?></td>

<td><?php echo $row['capacity']; ?></td>

<td><?php echo $row['status']; ?></td>

<td>

<a href="edit_table.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">
Edit
</a>

<a href="delete_table.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
onclick="return confirm('Delete this table?')">
Delete
</a>

</td>

</tr>

<?php } ?>

</table>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>