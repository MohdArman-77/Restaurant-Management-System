<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "customer") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");
include("../includes/navbar.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT cart.*, menu.food_name, menu.price, menu.image
FROM cart
JOIN menu ON cart.menu_id=menu.id
WHERE cart.user_id='$user_id'");
?>

<!DOCTYPE html>
<html>
<head>

<title>Cart</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<h2 class="mb-4">My Cart</h2>

<table class="table table-bordered">

<tr>

<th>Image</th>
<th>Food</th>
<th>Price</th>
<th>Qty</th>
<th>Total</th>
<th>Action</th>

</tr>

<?php

$grand_total=0;

while($row=mysqli_fetch_assoc($result)){

$total=$row['price']*$row['quantity'];

$grand_total+=$total;

?>

<tr>

<td width="120">

<img src="../uploads/<?php echo $row['image']; ?>"
width="100">

</td>

<td><?php echo $row['food_name']; ?></td>

<td>₹<?php echo $row['price']; ?></td>

<td><?php echo $row['quantity']; ?></td>

<td>₹<?php echo $total; ?></td>

<td>

<a href="remove_from_cart.php?id=<?php echo $row['id']; ?>"
class="btn btn-danger btn-sm">

Remove

</a>

</td>

</tr>

<?php } ?>

<tr>

<td colspan="4" align="right">

<strong>Grand Total</strong>

</td>

<td>

<strong>₹<?php echo $grand_total; ?></strong>

</td>

<td></td>

</tr>

</table>

<a href="place_order.php" class="btn btn-success">
    Place Order
</a>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>