<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$base = "";

if (strpos($_SERVER['PHP_SELF'], "/customer/") !== false ||
    strpos($_SERVER['PHP_SELF'], "/admin/") !== false ||
    strpos($_SERVER['PHP_SELF'], "/staff/") !== false) {

    $base = "../";
}
?>

<nav class="navbar navbar-expand-lg bg-white shadow-sm py-3">

    <div class="container">

        <a class="navbar-brand fw-bold fs-3 text-danger" href="<?php echo $base; ?>index.php">
            Spice Haven
        </a>

        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#navbarNav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav ms-auto">

                <?php if(!isset($_SESSION['user_id']) || $_SESSION['role']=="customer"){ ?>

                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo $base; ?>index.php">Home</a>
                </li>

                <?php } ?>

                <?php if(!isset($_SESSION['user_id']) || $_SESSION['role']=="customer"){ ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base; ?>customer/menu.php">
                        Menu
                    </a>
                </li>

                <?php } ?>

                <?php if(isset($_SESSION['user_id']) && $_SESSION['role']=="customer") { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>customer/profile.php">
                            Profile
                        </a>
                    </li>
                <?php } ?>

                <?php if(!isset($_SESSION['user_id'])){ ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>login.php">
                            Reservation
                        </a>
                    </li>

                <?php } ?>

                <?php if(isset($_SESSION['user_id']) && $_SESSION['role']=="customer"){ ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base; ?>customer/reserve_table.php">
                        Reservation
                    </a>
                </li>

                <?php } ?>

                <?php if(isset($_SESSION['user_id']) && $_SESSION['role']=="customer"){ ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base; ?>customer/my_reservations.php">
                        My Reservations
                    </a>
                </li>

                <?php } ?>

                <?php if(isset($_SESSION['user_id']) && $_SESSION['role']=="customer") { ?>

                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo $base; ?>customer/cart.php">
                            Cart
                        </a>
                    </li>

                <?php } ?>

                <?php if(isset($_SESSION['user_id']) && $_SESSION['role']=="customer"){ ?>

                <li class="nav-item">
                    <a class="nav-link" href="<?php echo $base; ?>customer/order_history.php">
                        Order History
                    </a>
                </li>

                <?php } ?>

            </ul>

            <?php if(isset($_SESSION['user_id'])) { ?>

            <a href="<?php echo $base; ?>logout.php" class="btn btn-danger ms-3">
                Logout
            </a>

            <?php } else { ?>

            <a href="<?php echo $base; ?>login.php" class="btn btn-outline-danger ms-3">
                Login
            </a>

            <a href="<?php echo $base; ?>register.php" class="btn btn-danger ms-2">
                Register
            </a>

            <?php } ?>

        </div>

    </div>

</nav>