<?php

include("includes/db.php");

if(isset($_POST['register'])){

    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "INSERT INTO users(fullname,email,password)
    VALUES('$fullname','$email','$password')";

    $result = mysqli_query($conn, $query);

    if($result){

        echo "<script>
            alert('Registration Successful!');
            window.location='login.php';
        </script>";

    }else{

        echo "<script>
            alert('Registration Failed!');
        </script>";

    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="bg-light">

<div class="container">

    <div class="row justify-content-center mt-5">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-body">

                    <h2 class="text-center mb-4">Register</h2>

                    <form action="" method="POST">

                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="fullname" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <button class="btn btn-danger w-100" name="register">
                            Register
                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>