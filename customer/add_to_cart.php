<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "customer") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$user_id = $_SESSION['user_id'];
$menu_id = intval($_GET['id']);

$check = mysqli_query($conn,
"SELECT * FROM cart
WHERE user_id='$user_id'
AND menu_id='$menu_id'");

if(mysqli_num_rows($check)>0){

    mysqli_query($conn,
    "UPDATE cart
    SET quantity=quantity+1
    WHERE user_id='$user_id'
    AND menu_id='$menu_id'");

}else{

    mysqli_query($conn,
    "INSERT INTO cart(user_id,menu_id,quantity)
    VALUES('$user_id','$menu_id',1)");

}

header("Location: cart.php");
exit();
?>