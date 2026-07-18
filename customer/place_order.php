<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "customer") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$user_id = $_SESSION['user_id'];

$result = mysqli_query($conn,
"SELECT cart.*, menu.price
FROM cart
JOIN menu ON cart.menu_id=menu.id
WHERE cart.user_id='$user_id'");

if(mysqli_num_rows($result)==0){
    header("Location: cart.php");
    exit();
}

$total = 0;

while($row=mysqli_fetch_assoc($result)){
    $total += $row['price'] * $row['quantity'];
}

mysqli_query($conn,
"INSERT INTO orders(user_id,total_amount)
VALUES('$user_id','$total')");

$order_id = mysqli_insert_id($conn);

$result = mysqli_query($conn,
"SELECT cart.*, menu.price
FROM cart
JOIN menu ON cart.menu_id=menu.id
WHERE cart.user_id='$user_id'");

while($row=mysqli_fetch_assoc($result)){

    mysqli_query($conn,
    "INSERT INTO order_items(order_id,menu_id,quantity,price)
    VALUES(
    '$order_id',
    '{$row['menu_id']}',
    '{$row['quantity']}',
    '{$row['price']}'
    )");
}

mysqli_query($conn,
"DELETE FROM cart
WHERE user_id='$user_id'");

header("Location: order_history.php");
exit();
?>