<?php
include 'includes/db.php';
include 'includes/auth.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($password != $confirm) {

        $message = "<div class='alert alert-danger'>
                        Passwords do not match.
                    </div>";

    } else {

        // Check if email exists
        $check = $conn->prepare("SELECT id FROM members WHERE email = ?");
        $check->bind_param("s", $email);
        $check->execute();

        $result = $check->get_result();

        if ($result->num_rows == 1) {

            $hashed = password_hash($password, PASSWORD_DEFAULT);

            $update = $conn->prepare("UPDATE members SET password=? WHERE email=?");
            $update->bind_param("ss", $hashed, $email);

            if ($update->execute()) {

                $message = "<div class='alert alert-success'>
                                Password changed successfully.
                                <br>
                                <a href='login.php'>Login Here</a>
                            </div>";

            } else {

                $message = "<div class='alert alert-danger'>
                                Failed to update password.
                            </div>";
            }

            $update->close();

        } else {

            $message = "<div class='alert alert-warning'>
                            Email not found.
                        </div>";
        }

        $check->close();
    }
}

include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-primary text-white">

<h3><i class="bi bi-key"></i> Forgot Password</h3>

</div>

<div class="card-body">

<?= $message ?>

<form method="POST">

<div class="mb-3">

<label>Email</label>

<input
type="email"
name="email"
class="form-control"
required>

</div>

<div class="mb-3">

<label>New Password</label>

<div class="input-group">

<input
type="password"
id="password"
name="password"
class="form-control"
required>

<button
class="btn btn-outline-secondary"
type="button"
onclick="togglePassword()">

<i class="bi bi-eye"></i>

</button>

</div>

</div>

<div class="mb-3">

<label>Confirm Password</label>

<input
type="password"
name="confirm_password"
class="form-control"
required>

</div>

<button
class="btn btn-primary w-100">

Reset Password

</button>

</form>

<div class="text-center mt-3">

<a href="login.php">
Back to Login
</a>

</div>

</div>

</div>

</div>

</div>

</div>

<script>
function togglePassword() {
    let p = document.getElementById("password");

    if (p.type === "password") {
        p.type = "text";
    } else {
        p.type = "password";
    }
}
</script>

<?php include 'includes/footer.php'; ?>