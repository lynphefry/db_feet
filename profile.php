<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'includes/auth.php';
include 'includes/db.php';

// Check login
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

include 'includes/header.php';
include 'includes/navbar.php';


$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT * FROM members WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows == 0) {
    header("Location: logout.php");
    exit();
}

$user = $result->fetch_assoc();
?>

<div class="container mt-5">

    <div class="card shadow">

        <div class="card-header bg-primary text-white">
            <h3><i class="bi bi-person-circle"></i> My Profile</h3>
        </div>

        <div class="card-body">

            <table class="table table-bordered">

                <tr>
                    <th>First Name</th>
                    <td><?= htmlspecialchars($user['first_name']) ?></td>
                </tr>

                <tr>
                    <th>Last Name</th>
                    <td><?= htmlspecialchars($user['last_name']) ?></td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($user['email']) ?></td>
                </tr>

                <tr>
                    <th>Phone</th>
                    <td><?= htmlspecialchars($user['phone']) ?></td>
                </tr>

                <tr>
                    <th>Role</th>
                    <td><?= htmlspecialchars(ucfirst($user['role'])) ?></td>
                </tr>

            </table>

            <div class="d-flex gap-2 flex-wrap">

                <a href="edit_profile.php" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Edit Profile
                </a>

                <a href="delete_account.php"
                   class="btn btn-danger"
                   onclick="return confirm('Are you sure you want to delete your account?');">

                    <i class="bi bi-trash"></i> Delete Account

                </a>

                <a href="dashboard.php" class="btn btn-secondary">

                    <i class="bi bi-arrow-left"></i> Dashboard

                </a>

            </div>

        </div>

    </div>

</div>

<?php
$stmt->close();
$conn->close();

include 'includes/footer.php';
?>