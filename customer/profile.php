<?php
include("../includes/auth_customer.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];

if (isset($_POST['update'])) {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    mysqli_query($conn,"
    UPDATE users
    SET fullname='$fullname',
        email='$email'
    WHERE id='$user_id'
    ");

    echo "<script>alert('Profile Updated Successfully');</script>";
}

$result = mysqli_query($conn,"
SELECT * FROM users
WHERE id='$user_id'
");

$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>

<head>

<title>My Profile</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body>

<?php include("../includes/navbar.php"); ?>

<div class="container mt-5">

<h2 class="mb-4">My Profile</h2>

<form method="POST">

<div class="mb-3">

<label class="form-label">Full Name</label>

<input
type="text"
name="fullname"
class="form-control"
value="<?php echo $user['fullname']; ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?php echo $user['email']; ?>"
required>

</div>

<button
type="submit"
name="update"
class="btn btn-primary">

Update Profile

</button>

</form>

</div>

<?php include("../includes/footer.php"); ?>

</body>
</html>