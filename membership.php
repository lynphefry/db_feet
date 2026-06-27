<?php
include 'includes/db.php';
include 'includes/auth.php';
include 'includes/header.php';
include 'includes/navbar.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}
?>

<div class="container mt-5">

    <h1 class="text-center fw-bold">Membership Plans</h1>

    <p class="text-center text-muted mb-5">
        Choose a membership package that supports your fitness goals.
    </p>

    <div class="row text-center mb-5">

        <div class="col-md-4">
            <h3>500+</h3>
            <p>Active Members</p>
        </div>

        <div class="col-md-4">
            <h3>20+</h3>
            <p>Professional Trainers</p>
        </div>

        <div class="col-md-4">
            <h3>50+</h3>
            <p>Weekly Classes</p>
        </div>

    </div>

    <div class="row g-4">

        <!-- BASIC -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">

                <div class="card-header bg-info text-white">
                    💪 BASIC
                </div>

                <div class="card-body">

                    <h1 class="fw-bold">Ksh 2,000</h1>
                    <p class="text-muted">Per Month</p>

                    <ul class="list-unstyled mt-3">
                        <li>✔ Gym Access</li>
                        <li>✔ Locker Room Access</li>
                        <li>✔ Fitness Assessment</li>
                    </ul>

                </div>

                <div class="card-footer">

                    <form action="mpesa.php" method="POST">

                        <input type="hidden" name="plan" value="Basic">
                        <input type="hidden" name="amount" value="2000">

                        <input
                            type="text"
                            name="phone"
                            class="form-control mb-2"
                            placeholder="2547XXXXXXXX"
                            required>

                        <button class="btn btn-success w-100">
                            Pay with M-Pesa
                        </button>

                    </form>

                </div>

            </div>
        </div>

        <!-- PREMIUM -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">

                <div class="card-header bg-info text-white">
                    🏋️ PREMIUM
                </div>

                <div class="card-body">

                    <h1 class="fw-bold">Ksh 5,000</h1>
                    <p class="text-muted">Per Month</p>

                    <ul class="list-unstyled mt-3">
                        <li>✔ Full Gym Access</li>
                        <li>✔ Personal Trainer</li>
                        <li>✔ Diet & Nutrition Plan</li>
                        <li>✔ Locker Room Access</li>
                        <li>✔ Fitness Assessment</li>
                    </ul>

                </div>

                <div class="card-footer">

                    <form action="mpesa.php" method="POST">

                        <input type="hidden" name="plan" value="Premium">
                        <input type="hidden" name="amount" value="5000">

                        <input
                            type="text"
                            name="phone"
                            class="form-control mb-2"
                            placeholder="2547XXXXXXXX"
                            required>

                        <button class="btn btn-success w-100">
                            Pay with M-Pesa
                        </button>

                    </form>

                </div>

            </div>
        </div>

        <!-- VIP -->
        <div class="col-md-4">
            <div class="card shadow h-100 text-center">

                <div class="card-header bg-warning text-dark">
                    👑 VIP
                </div>

                <div class="card-body">

                    <h1 class="fw-bold">Ksh 8,000</h1>
                    <p class="text-muted">Per Month</p>

                    <ul class="list-unstyled mt-3">
                        <li>✔ Everything in Premium</li>
                        <li>✔ Unlimited Classes</li>
                        <li>✔ Priority Booking</li>
                        <li>✔ Nutrition Coaching</li>
                        <li>✔ VIP Support</li>
                    </ul>

                </div>

                <div class="card-footer">

                    <form action="mpesa.php" method="POST">

                        <input type="hidden" name="plan" value="VIP">
                        <input type="hidden" name="amount" value="8000">

                        <input
                            type="text"
                            name="phone"
                            class="form-control mb-2"
                            placeholder="2547XXXXXXXX"
                            required>

                        <button class="btn btn-success w-100">
                            Pay with M-Pesa
                        </button>

                    </form>

                </div>

            </div>
        </div>

    </div>

</div>

<?php include 'includes/footer.php'; ?>