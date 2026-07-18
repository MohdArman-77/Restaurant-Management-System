<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "customer") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$user_id = $_SESSION['user_id'];
$id = intval($_GET['id']);

mysqli_query($conn,
"DELETE FROM cart
WHERE id='$id'
AND user_id='$user_id'");

header("Location: cart.php");

exit();

?>