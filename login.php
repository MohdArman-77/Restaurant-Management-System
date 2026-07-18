<?php
session_start();
include("includes/db.php");

$message = "";

if (isset($_POST['login'])) {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {

        $row = mysqli_fetch_assoc($result);

        if (password_verify($password, $row['password'])) {

            // Store session data
            $_SESSION['user_id'] = $row['id'];
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];

            // Redirect according to role
            if ($row['role'] == "admin") {
                header("Location: admin/dashboard.php");
            } elseif ($row['role'] == "staff") {
                header("Location: staff/dashboard.php");
            } else {
                header("Location: customer/dashboard.php");
            }

            exit();

        } else {
            $message = "Incorrect password!";
        }

    } else {
        $message = "Email not found!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header text-center">
                    <h3>Login</h3>
                </div>

                <div class="card-body">

                    <?php
                    if ($message != "") {
                        echo "<div class='alert alert-danger'>$message</div>";
                    }
                    ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button type="submit" name="login" class="btn btn-primary w-100">
                            Login
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>