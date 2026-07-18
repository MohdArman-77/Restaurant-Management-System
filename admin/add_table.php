<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

if(isset($_POST['add'])){

    $number=$_POST['table_number'];
    $capacity=$_POST['capacity'];

    mysqli_query($conn,"INSERT INTO tables(table_number,capacity)
    VALUES('$number','$capacity')");

    header("Location: manage_tables.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Add Table</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Add Table</h2>

<form method="POST">

<div class="mb-3">
<label>Table Number</label>
<input type="number" name="table_number" class="form-control" required>
</div>

<div class="mb-3">
<label>Capacity</label>
<input type="number" name="capacity" class="form-control" required>
</div>

<button class="btn btn-success" name="add">
Add Table
</button>

</form>

</div>

</body>
</html>