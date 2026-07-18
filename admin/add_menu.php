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

$message = "";

if (isset($_POST['add_menu'])) {

    $food_name = mysqli_real_escape_string($conn, $_POST['food_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $category = mysqli_real_escape_string($conn, $_POST['category']);   

    $image = $_FILES['image']['name'];
    $temp_name = $_FILES['image']['tmp_name'];

    move_uploaded_file($temp_name, "../uploads/" . $image);

    $sql = "INSERT INTO menu(food_name, description, price, category, image)
            VALUES('$food_name','$description','$price','$category','$image')";

    if (mysqli_query($conn, $sql)) {
        $message = "Menu item added successfully!";
    } else {
        $message = "Something went wrong!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Add Menu Item</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header">
                    <h3>Add Menu Item</h3>
                </div>

                <div class="card-body">

                    <?php
                    if ($message != "") {
                        echo "<div class='alert alert-success'>$message</div>";
                    }
                    ?>

                    <form method="POST" enctype="multipart/form-data">

                        <div class="mb-3">
                            <label>Food Name</label>
                            <input type="text" name="food_name" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3"></textarea>
                        </div>

                        <div class="mb-3">
                            <label>Price</label>
                            <input type="number" step="0.01" name="price" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Category</label>

                            <select name="category" class="form-select">

                                <option>Veg</option>
                                <option>Non-Veg</option>
                                <option>Drinks</option>
                                <option>Dessert</option>

                            </select>

                        </div>

                        <div class="mb-3">
                            <label>Food Image</label>
                            <input type="file" name="image" class="form-control" required>
                        </div>

                        <button class="btn btn-success" name="add_menu">
                            Add Menu Item
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>