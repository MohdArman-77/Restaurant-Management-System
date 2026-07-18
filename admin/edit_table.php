<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$id = intval($_GET['id']);

$result = mysqli_query($conn, "SELECT * FROM tables WHERE id='$id'");
$table = mysqli_fetch_assoc($result);

if(isset($_POST['update'])){

    $number = $_POST['table_number'];
    $capacity = $_POST['capacity'];
    $status = $_POST['status'];

    mysqli_query($conn,
    "UPDATE tables
    SET table_number='$number',
        capacity='$capacity',
        status='$status'
    WHERE id='$id'");

    header("Location: manage_tables.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Edit Table</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2>Edit Table</h2>

<form method="POST">

<div class="mb-3">
<label>Table Number</label>
<input type="number" class="form-control"
name="table_number"
value="<?php echo $table['table_number']; ?>" required>
</div>

<div class="mb-3">
<label>Capacity</label>
<input type="number" class="form-control"
name="capacity"
value="<?php echo $table['capacity']; ?>" required>
</div>

<div class="mb-3">
<label>Status</label>

<select name="status" class="form-control">

<option value="Available"
<?php if($table['status']=="Available") echo "selected"; ?>>
Available
</option>

<option value="Reserved"
<?php if($table['status']=="Reserved") echo "selected"; ?>>
Reserved
</option>

</select>

</div>

<button class="btn btn-success" name="update">
Update Table
</button>

</form>

</div>

</body>
</html>