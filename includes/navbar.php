<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow">

<div class="container">

    <a class="navbar-brand fw-bold" href="index.php">
        <i class="bi bi-heart-pulse-fill"></i> FEET TO FIT
    </a>

    <button
        class="navbar-toggler"
        type="button"
        data-bs-toggle="collapse"
        data-bs-target="#navbar">

        <span class="navbar-toggler-icon"></span>

    </button>

    <div class="collapse navbar-collapse" id="navbar">

        <ul class="navbar-nav ms-auto">

            <li class="nav-item">
                <a class="nav-link" href="index.php">
                    <i class="bi bi-house"></i> Home
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="trainers.php">
                    <i class="bi bi-people"></i> Trainers
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="booking.php">
                    <i class="bi bi-calendar-check"></i> Bookings
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="membership.php">
                    <i class="bi bi-award"></i> Membership
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="shop.php">
                    <i class="bi bi-bag"></i> Shop
                </a>
            </li>

            <?php if (isLoggedIn()) { ?>

                <?php if (isAdmin()) { ?>

                <li class="nav-item">
                    <a class="nav-link text-warning" href="admin.php">
                        <i class="bi bi-shield-lock"></i> Admin
                    </a>
                </li>

                <?php } ?>

                <li class="nav-item dropdown">

                    <a
                        class="nav-link dropdown-toggle"
                        href="#"
                        role="button"
                        data-bs-toggle="dropdown">

                        <i class="bi bi-person-circle"></i>

                        <?php echo htmlspecialchars($_SESSION['first_name']); ?>

                    </a>

                    <ul class="dropdown-menu dropdown-menu-end">

                        <li>
                            <a class="dropdown-item" href="dashboard.php">
                                <i class="bi bi-speedometer2"></i> Dashboard
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="profile.php">
                                <i class="bi bi-person"></i> Profile
                            </a>
                        </li>

                        <li>
                            <a class="dropdown-item" href="booking.php">
                                <i class="bi bi-calendar-event"></i> My Bookings
                            </a>
                        </li>

                        <li><hr class="dropdown-divider"></li>

                        <li>
                            <a class="dropdown-item text-danger" href="logout.php">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </li>

                    </ul>

                </li>

            <?php } else { ?>

                <li class="nav-item">
                    <a class="nav-link" href="login.php">
                        <i class="bi bi-box-arrow-in-right"></i> Login
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="register.php">
                        <i class="bi bi-person-plus"></i> Register
                    </a>
                </li>
<li class="nav-item">
    <a class="nav-link" href="my_orders.php">
        My Orders
    </a>
</li>
<a href="orders.php" class="btn btn-info">
    Manage Orders
</a>
            <?php } ?>

        </ul>

    </div>

</div>

</nav>