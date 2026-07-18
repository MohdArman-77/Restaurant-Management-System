<?php
session_start();
include("includes/db.php");

// Get latest 3 menu items
$sql = "SELECT * FROM menu ORDER BY id DESC LIMIT 3";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spice Haven</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include("includes/navbar.php"); ?>

<!-- Hero Section -->

<section class="container py-5">

    <div class="row align-items-center">

        <div class="col-lg-6">

            <h1 class="display-4 fw-bold">
                Delicious Food,<br>
                Delivered Fresh
            </h1>

            <p class="lead mt-3">
                Experience the taste of freshly prepared meals with quick delivery and easy table reservations.
            </p>

            <?php if(isset($_SESSION['user_id']) && $_SESSION['role']=="customer"){ ?>

            <a href="customer/menu.php" class="btn btn-danger btn-lg mt-3 me-3">
                Order Now
            </a>

            <?php } else { ?>

            <a href="login.php" class="btn btn-danger btn-lg mt-3 me-3">
                Order Now
            </a>

            <?php } ?>

            <?php if(isset($_SESSION['user_id'])) { ?>

            <a href="<?php echo $base; ?>customer/reserve_table.php"
            class="btn btn-outline-dark btn-lg mt-3">
                Reserve Table
            </a>

            <?php } else { ?>

            <a href="<?php echo $base; ?>login.php"
            class="btn btn-outline-dark btn-lg mt-3">
                Reserve Table
            </a>

            <?php } ?>        

        </div>

        <div class="col-lg-6 text-center">

            <img src="assets/images/hero-food.png"
                class="img-fluid rounded"
                style="max-height:600px;"
                alt="Hero Image">

        </div>

    </div>

</section>

<!-- POPULAR DISHES START -->

<section class="container py-5">

    <h2 class="text-center mb-5">
        Popular Dishes
    </h2>

    <div class="row">

        <?php
        if(mysqli_num_rows($result) > 0){

            while($row = mysqli_fetch_assoc($result)){
        ?>

        <div class="col-md-4 mb-4">

            <div class="card shadow-sm h-100">

                <img src="uploads/<?php echo $row['image']; ?>"
                    class="card-img-top"
                    alt="<?php echo $row['food_name']; ?>"
                    style="height:250px; object-fit:cover;">

                <div class="card-body d-flex flex-column">

                    <h5 class="card-title">
                        <?php echo $row['food_name']; ?>
                    </h5>

                    <p class="card-text">
                        <?php echo $row['description']; ?>
                    </p>

                    <h6 class="text-danger">
                        ₹<?php echo $row['price']; ?>
                    </h6>

                    <a href="customer/menu.php" class="btn btn-danger btn-sm mt-auto">
                        View Menu
                    </a>

                </div>

            </div>

        </div>

        <?php
            }
        }else{
            echo "<h5 class='text-center'>No menu items available.</h5>";
        }
        ?>

    </div>

    <div class="text-center mt-4">

        <?php if(isset($_SESSION['user_id']) && $_SESSION['role']=="customer"){ ?>

        <a href="customer/menu.php" class="btn btn-outline-danger btn-lg">
            View Full Menu
        </a>

        <?php } else { ?>

        <a href="login.php" class="btn btn-outline-danger btn-lg">
            View Full Menu
        </a>

        <?php } ?>

    </div>

</section>

<?php include("includes/footer.php"); ?>

</body>
</html>




