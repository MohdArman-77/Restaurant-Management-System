<?php
session_start();

if(!isset($_SESSION['user_id']) || $_SESSION['role']!="customer"){
    header("Location: ../login.php");
    exit();
}

header("Location: menu.php");
exit();