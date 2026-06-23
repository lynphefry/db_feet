<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">

        <a class="navbar-brand" href="index.php">FEET TO FIT</a>

        <div class="navbar-nav ms-auto">

            <a class="nav-link text-white" href="index.php">Home</a>
            <a class="nav-link text-white" href="trainers.php">Trainers</a>
            <a class="nav-link text-white" href="classes.php">Classes</a>
            <a class="nav-link text-white" href="schedule.php">Schedule</a>
            <a class="nav-link text-white" href="membership.php">Membership</a>
            <a class="nav-link text-white" href="shop.php">Shop</a>
            <a class="nav-link text-white" href="contact.php">Contact</a>
<a class="nav-link text-white" href="account.php">My Dashboard</a>
            <?php if (isLoggedIn()) : ?>
                <a class="nav-link text-white" href="my_bookings.php">My Bookings</a>
                <a class="nav-link text-danger" href="logout.php">Logout</a>
            <?php else : ?>
                <a class="nav-link text-success" href="login.php">Login</a>
                <a class="nav-link text-info" href="register.php">Register</a>
            <?php endif; ?>

        </div>

    </div>
</nav>