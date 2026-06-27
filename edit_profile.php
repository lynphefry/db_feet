<?php
include 'includes/auth.php';
include 'includes/db.php';

// User must be logged in
if (!isLoggedIn()) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$message = "";

// Update profile
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);

    // Check if email already belongs to another user
    $check = $conn->prepare("SELECT id FROM members WHERE email = ? AND id != ?");
    $check->bind_param("si", $email, $user_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {

        $message = "<div class='alert alert-danger'>
                        Email already exists.
                    </div>";

    } else {

        $stmt = $conn->prepare("
            UPDATE members
            SET first_name=?, last_name=?, email=?, phone=?
            WHERE id=?
        ");

        $stmt->bind_param(
            "ssssi",
            $first_name,
            $last_name,
            $email,
            $phone,
            $user_id
        );

        if ($stmt->execute()) {

            $_SESSION['first_name'] = $first_name;

            $message = "<div class='alert alert-success'>
                            Profile updated successfully.
                        </div>";

        } else {

            $message = "<div class='alert alert-danger'>
                            Failed to update profile.
                        </div>";
        }

        $stmt->close();
    }

    $check->close();
}

// Fetch current user
$stmt = $conn->prepare("SELECT * FROM members WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();

$result = $stmt->get_result();
$user = $result->fetch_assoc();

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-7">

<div class="card shadow">

<div class="card-header bg-warning">

<h3>
<i class="bi bi-pencil-square"></i>
Edit Profile
</h3>

</div>

<div class="card-body">

<?= $message ?>

<form method="POST">

<div class="mb-3">

<label class="form-label">First Name</label>

<input
type="text"
name="first_name"
class="form-control"
value="<?= htmlspecialchars($user['first_name']) ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Last Name</label>

<input
type="text"
name="last_name"
class="form-control"
value="<?= htmlspecialchars($user['last_name']) ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Email</label>

<input
type="email"
name="email"
class="form-control"
value="<?= htmlspecialchars($user['email']) ?>"
required>

</div>

<div class="mb-3">

<label class="form-label">Phone</label>

<input
type="text"
name="phone"
class="form-control"
value="<?= htmlspecialchars($user['phone']) ?>"
required>

</div>

<div class="d-flex gap-2">

<button
type="submit"
class="btn btn-warning">

<i class="bi bi-check-circle"></i>
Update Profile

</button>

<a
href="profile.php"
class="btn btn-secondary">

<i class="bi bi-arrow-left"></i>
Cancel

</a>

</div>

</form>

</div>

</div>

</div>

</div>

</div>

<?php
$stmt->close();
$conn->close();

include 'includes/footer.php';
?>