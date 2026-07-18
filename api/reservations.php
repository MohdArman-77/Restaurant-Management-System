<?php

include("../includes/db.php");

header("Content-Type: application/json");

$result = mysqli_query($conn,"
SELECT reservations.*,
users.fullname,
tables.table_number
FROM reservations
JOIN users ON reservations.user_id = users.id
JOIN tables ON reservations.table_id = tables.id
");

$data = array();

while($row = mysqli_fetch_assoc($result))
{
    $data[] = $row;
}

echo json_encode($data);

?>