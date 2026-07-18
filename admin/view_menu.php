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

$sql = "SELECT * FROM menu ORDER BY id DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="d-flex justify-content-between mb-4">

        <h2>Menu Items</h2>

        <a href="add_menu.php" class="btn btn-success">
            Add New Item
        </a>

    </div>

    <table class="table table-bordered table-hover">

        <thead class="table-dark">

            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Food Name</th>
                <th>Description</th>
                <th>Category</th>
                <th>Price</th>
                <th>Action</th>
            </tr>

        </thead>

        <tbody>

        <?php while($row = mysqli_fetch_assoc($result)) { ?>

            <tr>

                <td><?php echo $row['id']; ?></td>

                <td>
                    <img src="../uploads/<?php echo $row['image']; ?>"
                         width="80"
                         height="60">
                </td>

                <td><?php echo $row['food_name']; ?></td>

                <td><?php echo $row['description']; ?></td>

                <td><?php echo $row['category']; ?></td>

                <td>₹ <?php echo $row['price']; ?></td>

                <td>

                    <a href="edit_menu.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-primary btn-sm">
                        Edit
                    </a>

                    <a href="delete_menu.php?id=<?php echo $row['id']; ?>"
                       class="btn btn-danger btn-sm">
                        Delete
                    </a>

                </td>

            </tr>

        <?php } ?>

        </tbody>

    </table>

</div>

</body>
</html>