<?php
session_start();
include("../includes/db.php");

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

// Check admin role
if ($_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    // Get image name
    $sql = "SELECT image FROM menu WHERE id='$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Delete image from uploads folder
    if (!empty($row['image']) && file_exists("../uploads/" . $row['image'])) {
        unlink("../uploads/" . $row['image']);
    }

    // Delete record
    mysqli_query($conn, "DELETE FROM menu WHERE id='$id'");
}

header("Location: view_menu.php");
exit();
?>