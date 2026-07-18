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

$id = $_GET['id'];

$sql = "SELECT * FROM menu WHERE id = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$message = "";

if(isset($_POST['update_menu'])){

    $food_name = mysqli_real_escape_string($conn,$_POST['food_name']);
    $description = mysqli_real_escape_string($conn,$_POST['description']);
    $price = $_POST['price'];
    $category = mysqli_real_escape_string($conn,$_POST['category']);

    $update = "UPDATE menu SET
                food_name='$food_name',
                description='$description',
                price='$price',
                category='$category'
                WHERE id='$id'";

    if(mysqli_query($conn,$update)){
        $message = "Menu updated successfully!";

        $sql = "SELECT * FROM menu WHERE id='$id'";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_assoc($result);

    }else{
        $message = "Update failed!";
    }

}
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Edit Menu</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card shadow">

<div class="card-header">

<h3>Edit Menu Item</h3>

</div>

<div class="card-body">

<?php
if($message!=""){
    echo "<div class='alert alert-success'>$message</div>";
}
?>

<form method="POST">

<div class="mb-3">

<label>Food Name</label>

<input type="text"
name="food_name"
class="form-control"
value="<?php echo $row['food_name']; ?>"
required>

</div>

<div class="mb-3">

<label>Description</label>

<textarea
name="description"
class="form-control"
rows="3"><?php echo $row['description']; ?></textarea>

</div>

<div class="mb-3">

<label>Price</label>

<input
type="number"
step="0.01"
name="price"
class="form-control"
value="<?php echo $row['price']; ?>"
required>

</div>

<div class="mb-3">

<label>Category</label>

<select name="category" class="form-select">

<option <?php if($row['category']=="Veg") echo "selected"; ?>>Veg</option>

<option <?php if($row['category']=="Non-Veg") echo "selected"; ?>>Non-Veg</option>

<option <?php if($row['category']=="Drinks") echo "selected"; ?>>Drinks</option>

<option <?php if($row['category']=="Dessert") echo "selected"; ?>>Dessert</option>

</select>

</div>

<button
class="btn btn-primary"
name="update_menu">

Update Menu

</button>

<a href="view_menu.php" class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

</div>

</div>

</body>

</html>