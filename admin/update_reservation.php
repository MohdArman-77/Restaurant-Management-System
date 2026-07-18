<?php
include("../includes/auth_admin.php");
include("../includes/db.php");

$id = intval($_GET['id']);
$status = $_GET['status'];

if (!in_array($status, ['Approved', 'Cancelled'])) {
    die("Invalid status.");
}

$res = mysqli_query($conn,
"SELECT * FROM reservations WHERE id='$id'");

$row = mysqli_fetch_assoc($res);

mysqli_query($conn,
"UPDATE reservations
SET status='$status'
WHERE id='$id'");

if($status=="Approved"){

    mysqli_query($conn,
    "UPDATE tables
    SET status='Reserved'
    WHERE id='{$row['table_id']}'");

}

if($status=="Cancelled"){

    mysqli_query($conn,
    "UPDATE tables
    SET status='Available'
    WHERE id='{$row['table_id']}'");

}

header("Location: view_reservations.php");
exit();
?>