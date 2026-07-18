<?php

include("../includes/db.php");

header("Content-Type: application/json");

$result = mysqli_query($conn,"
SELECT orders.*, users.fullname
FROM orders
JOIN users ON orders.user_id = users.id
");

$data = array();

while($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

echo json_encode($data);

?>