<?php
include("../includes/auth_customer.php");
include("../includes/db.php");

if(isset($_POST['reserve'])){

    $user_id = $_SESSION['user_id'];
    $table_id = $_POST['table_id'];
    $date = $_POST['reservation_date'];
    $time = $_POST['reservation_time'];
    $guests = $_POST['guests'];

    mysqli_query($conn,"INSERT INTO reservations
    (user_id,table_id,reservation_date,reservation_time,guests)
    VALUES
    ('$user_id','$table_id','$date','$time','$guests')");

    header("Location: my_reservations.php");
    exit();
}

$tables = mysqli_query($conn,
"SELECT * FROM tables
WHERE status='Available'
ORDER BY table_number");
?>

<!DOCTYPE html>
<html>
<head>

<title>Reserve Table</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../includes/navbar.php"); ?>

<div class="container mt-5">

<h2 class="mb-4">Reserve a Table</h2>

<form method="POST">

<div class="mb-3">

<label>Select Table</label>

<select name="table_id" class="form-control" required>

<?php while($table=mysqli_fetch_assoc($tables)){ ?>

<option value="<?php echo $table['id']; ?>">

Table <?php echo $table['table_number']; ?>

(Capacity:
<?php echo $table['capacity']; ?>)

</option>

<?php } ?>

</select>

</div>

<div class="mb-3">

<label>Date</label>

<input type="date"
name="reservation_date"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Time</label>

<input type="time"
name="reservation_time"
class="form-control"
required>

</div>

<div class="mb-3">

<label>Guests</label>

<input type="number"
name="guests"
class="form-control"
min="1"
required>

</div>

<button class="btn btn-success" name="reserve">

Reserve Table

</button>

</form>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>