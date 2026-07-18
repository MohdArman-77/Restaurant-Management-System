<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != "customer") {
    header("Location: ../login.php");
    exit();
}

include("../includes/db.php");
include("../includes/navbar.php");

$result = mysqli_query($conn, "SELECT * FROM menu ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h2 class="text-center mb-4">Restaurant Menu</h2>

    <div class="row">

        <?php
        if(mysqli_num_rows($result)>0){

            while($row=mysqli_fetch_assoc($result)){
        ?>

        <div class="col-md-4 mb-4">

            <div class="card h-100">

                <img src="../uploads/<?php echo $row['image']; ?>"
                     class="card-img-top"
                     style="height:220px;object-fit:cover;">

                <div class="card-body">

                    <h5><?php echo $row['food_name']; ?></h5>

                    <p><?php echo $row['description']; ?></p>

                    <p>
                        <strong>Category:</strong>
                        <?php echo $row['category']; ?>
                    </p>

                    <h5 class="text-success">
                        ₹<?php echo $row['price']; ?>
                    </h5>

                    <a href="add_to_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-primary w-100">
                        Add to Cart
                    </a>
                </div>

            </div>

        </div>

        <?php
            }
        }else{
            echo "<h4 class='text-center'>No Menu Items Available</h4>";
        }
        ?>

    </div>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>