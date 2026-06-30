<?php
include 'includes/db.php';
include 'includes/auth.php';

if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';

$role = $_SESSION['role'];
?>

<div class="container mt-5">

<?php if ($role == "trainer") { ?>

    <div class="card shadow">

        <div class="card-header bg-success text-white">
            <h3>Trainer Dashboard</h3>
        </div>

        <div class="card-body">

            <h2>
                Welcome,
                <?php echo htmlspecialchars($_SESSION['first_name']); ?> 👋
            </h2>

            <p class="text-muted">
                Here are your upcoming training sessions.
            </p>

            <?php

            $trainer = $conn->prepare("
                SELECT id
                FROM trainers
                WHERE member_id = ?
            ");

            $trainer->bind_param("i", $_SESSION['user_id']);
            $trainer->execute();

            $trainerResult = $trainer->get_result();

            if($trainerResult->num_rows > 0){

                $trainerData = $trainerResult->fetch_assoc();

                $trainer_id = $trainerData['id'];

                $bookings = $conn->prepare("
                    SELECT
                        members.first_name,
                        members.last_name,
                        bookings.booking_date,
                        bookings.booking_time
                    FROM bookings
                    JOIN members
                    ON bookings.user_id = members.id
                    WHERE bookings.trainer_id = ?
                    ORDER BY bookings.booking_date ASC
                ");

                $bookings->bind_param("i",$trainer_id);
                $bookings->execute();

                $result = $bookings->get_result();

                if($result->num_rows > 0){

                    echo "<table class='table table-bordered mt-4'>";

                    echo "<tr>
                            <th>Member</th>
                            <th>Date</th>
                            <th>Time</th>
                          </tr>";

                    while($row = $result->fetch_assoc()){

                        echo "<tr>";

                        echo "<td>".$row['first_name']." ".$row['last_name']."</td>";

                        echo "<td>".$row['booking_date']."</td>";

                        echo "<td>".$row['booking_time']."</td>";

                        echo "</tr>";

                    }

                    echo "</table>";

                }else{

                    echo "<div class='alert alert-info mt-3'>
                            You have no bookings yet.
                          </div>";

                }

            }else{

                echo "<div class='alert alert-warning'>
                        Your trainer account has not been linked yet.
                      </div>";

            }

            ?>

            <a href="profile.php" class="btn btn-primary">
                My Profile
            </a>

            <a href="logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>

<?php } else { ?>

    <div class="card shadow">

        <div class="card-body text-center">

            <h2>
                Welcome,
                <?php echo htmlspecialchars($_SESSION['first_name']); ?> 👋
            </h2>

            <p class="text-muted">
                You have successfully logged in to FEET TO FIT.
            </p>

            <div class="mt-4">

                <a href="profile.php" class="btn btn-primary">
                    My Profile
                </a>

                <a href="trainers.php" class="btn btn-success">
                    Trainers
                </a>

                <a href="booking.php" class="btn btn-warning">
                    Bookings
                </a>

                <?php if (isAdmin()) { ?>

                    <a href="admin.php" class="btn btn-dark">
                        Admin Panel
                    </a>

                <?php } ?>

                <a href="logout.php" class="btn btn-danger">
                    Logout
                </a>

            </div>

        </div>

    </div>
    <a href="trainer_schedule.php" class="btn btn-success">
    My Schedule
                </a>

<?php } ?>

</div>

<?php include 'includes/footer.php'; ?>