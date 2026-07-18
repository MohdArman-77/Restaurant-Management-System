<?php
include("../includes/auth_staff.php");
include("../includes/db.php");

$order_id = intval($_GET['id']);

$order = mysqli_query($conn,"
SELECT orders.*, users.fullname
FROM orders
JOIN users ON orders.user_id = users.id
WHERE orders.id='$order_id'
");

$order = mysqli_fetch_assoc($order);

$items = mysqli_query($conn,"
SELECT order_items.*, menu.food_name
FROM order_items
JOIN menu ON order_items.menu_id = menu.id
WHERE order_items.order_id='$order_id'
");
?>

<!DOCTYPE html>
<html>

<head>

<title>Bill</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<div class="container mt-5">

<div class="card">

<div class="card-body">

<h2 class="text-center">
Spice Haven
</h2>

<hr>

<p><strong>Order ID :</strong> #<?php echo $order['id']; ?></p>

<p><strong>Customer :</strong> <?php echo $order['fullname']; ?></p>

<p><strong>Date :</strong> <?php echo $order['order_date']; ?></p>

<table class="table table-bordered">

<tr>

<th>Food</th>
<th>Qty</th>
<th>Price</th>

</tr>

<?php while($item=mysqli_fetch_assoc($items)){ ?>

<tr>

<td><?php echo $item['food_name']; ?></td>

<td><?php echo $item['quantity']; ?></td>

<td>₹<?php echo $item['price']; ?></td>

</tr>

<?php } ?>

</table>

<h4 class="text-end">

Total : ₹<?php echo $order['total_amount']; ?>

</h4>

<div class="text-center mt-4">

<button class="btn btn-primary"
onclick="window.print();">

Print Bill

</button>

<a href="manage_orders.php"
class="btn btn-secondary">

Back

</a>

</div>

</div>

</div>

</div>

</body>

</html>