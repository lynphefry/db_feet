<?php
include "includes/db.php";
include "includes/auth.php";
include "includes/header.php";
include "includes/navbar.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $password   = $_POST['password'];
    $confirm    = $_POST['confirm_password'];
    $role       = $_POST['role']; // NEW

    if ($password != $confirm) {

        $message = "<div class='alert alert-danger'>Passwords do not match!</div>";

    } else {

        // Check if email already exists
        $check = $conn->prepare("SELECT id FROM members WHERE email=?");
        $check->bind_param("s", $email);
        $check->execute();
        $check->store_result();

        if ($check->num_rows > 0) {

            $message = "<div class='alert alert-warning'>Email already exists.</div>";

        } else {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // INSERT ROLE
            $stmt = $conn->prepare("
                INSERT INTO members
                (first_name, last_name, email, phone, password, role)
                VALUES
                (?, ?, ?, ?, ?, ?)
            ");

            $stmt->bind_param(
                "ssssss",
                $first_name,
                $last_name,
                $email,
                $phone,
                $hashedPassword,
                $role
            );

            if ($stmt->execute()) {

                header("Location: login.php?registered=1");
                exit();

            } else {

                $message = "<div class='alert alert-danger'>
                Registration failed: ".$conn->error."
                </div>";

            }

            $stmt->close();
        }

        $check->close();
    }
}
?>

<div class="container mt-5">

<div class="row justify-content-center">

<div class="col-md-6">

<div class="card shadow">

<div class="card-header bg-success text-white text-center">
<h3>Create Account</h3>
</div>

<div class="card-body">

<?= $message ?>

<form method="POST" autocomplete="off">

<div class="mb-3">
<label>First Name</label>
<input
type="text"
name="first_name"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Last Name</label>
<input
type="text"
name="last_name"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
autocomplete="new-email"
required>
</div>

<div class="mb-3">
<label>Phone</label>
<input
type="text"
name="phone"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Password</label>

<div class="input-group">

<input
type="password"
id="password"
name="password"
class="form-control"
autocomplete="new-password"
required>

<button
type="button"
class="btn btn-outline-secondary"
onclick="togglePassword('password')">
👁
</button>

</div>

</div>

<div class="mb-3">
<label>Confirm Password</label>

<div class="input-group">

<input
type="password"
id="confirm_password"
name="confirm_password"
class="form-control"
autocomplete="new-password"
required>

<button
type="button"
class="btn btn-outline-secondary"
onclick="togglePassword('confirm_password')">
👁
</button>

</div>

</div>

<div class="mb-3">
<label class="form-label">Register As</label>

<select
name="role"
class="form-select"
required>

<option value="">-- Select Role --</option>
<option value="trainee">Trainee</option>
<option value="trainer">Trainer</option>

</select>

</div>

<button class="btn btn-success w-100">
Register
</button>

</form>

<div class="text-center mt-3">
Already have an account?
<a href="login.php">Login</a>
</div>

</div>

</div>

</div>

</div>

</div>

<script>
function togglePassword(id){

    var input = document.getElementById(id);

    if(input.type === "password"){
        input.type = "text";
    }else{
        input.type = "password";
    }

}
</script>

<?php include "includes/footer.php"; ?>