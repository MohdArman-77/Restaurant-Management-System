<?php

include("../includes/db.php");

header("Content-Type: application/json");

$result = mysqli_query($conn,"SELECT * FROM menu");

$data = array();

while($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

echo json_encode($data);

?>