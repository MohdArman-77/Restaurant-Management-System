<?php

session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "admin") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");

$id = intval($_GET['id']);

mysqli_query($conn,
"DELETE FROM tables WHERE id='$id'");

header("Location: manage_tables.php");

exit();

?>