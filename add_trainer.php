<?php
include 'includes/db.php';
include 'includes/auth.php';

requireAdmin();

include 'includes/header.php';
include 'includes/navbar.php';

$message = "";

if (isset($_POST['add'])) {

    $first_name = trim($_POST['first_name']);
    $last_name  = trim($_POST['last_name']);
    $email      = trim($_POST['email']);
    $phone      = trim($_POST['phone']);
    $password   = $_POST['password'];
    $specialty  = trim($_POST['specialty']);
    $experience = trim($_POST['experience']);

    // Check if email already exists
    $check = $conn->prepare("SELECT id FROM members WHERE email=?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {

        $message = "<div class='alert alert-danger'>
                        Email already exists.
                    </div>";

    } else {

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Create trainer login account
        $member = $conn->prepare("
            INSERT INTO members
            (first_name,last_name,email,phone,password,role)
            VALUES (?,?,?,?,?,'trainer')
        ");

        $member->bind_param(
            "sssss",
            $first_name,
            $last_name,
            $email,
            $phone,
            $hashedPassword
        );

        if ($member->execute()) {

            $member_id = $conn->insert_id;

            // Upload image
            $image = "";

            if (!empty($_FILES['image']['name'])) {

                $image = time() . "_" . basename($_FILES['image']['name']);

                move_uploaded_file(
                    $_FILES['image']['tmp_name'],
                    "assets/images/trainers/" . $image
                );
            }

            $name = $first_name . " " . $last_name;

            // Create trainer profile
            $trainer = $conn->prepare("
                INSERT INTO trainers
                (member_id,name,specialty,experience,phone,image)
                VALUES (?,?,?,?,?,?)
            ");

            $trainer->bind_param(
                "isssss",
                $member_id,
                $name,
                $specialty,
                $experience,
                $phone,
                $image
            );

            if ($trainer->execute()) {

                $message = "
                <div class='alert alert-success'>
                    Trainer added successfully.
                </div>";

            } else {

                $message = "
                <div class='alert alert-danger'>
                    Failed to create trainer profile.<br>
                    ".$trainer->error."
                </div>";
            }

        } else {

            $message = "
            <div class='alert alert-danger'>
                Failed to create trainer account.<br>
                ".$member->error."
            </div>";

        }

    }

}
?>

<div class="container mt-5">

<div class="card shadow">

<div class="card-header bg-success text-white">
<h3>Add New Trainer</h3>
</div>

<div class="card-body">

<?= $message ?>

<form method="POST" enctype="multipart/form-data">

<div class="row">

<div class="col-md-6 mb-3">
<label>First Name</label>
<input
type="text"
name="first_name"
class="form-control"
required>
</div>

<div class="col-md-6 mb-3">
<label>Last Name</label>
<input
type="text"
name="last_name"
class="form-control"
required>
</div>

</div>

<div class="mb-3">
<label>Email</label>
<input
type="email"
name="email"
class="form-control"
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
<input
type="password"
name="password"
class="form-control"
required>
</div>

<div class="mb-3">
<label>Specialty</label>

<select
name="specialty"
class="form-select"
required>

<option value="">Choose Specialty</option>
<option>Personal Trainer</option>
<option>Yoga Trainer</option>
<option>Pilates Trainer</option>
<option>Strength Coach</option>
<option>Cardio Coach</option>
<option>Boxing Coach</option>
<option>Zumba Instructor</option>

</select>

</div>

<div class="mb-3">
<label>Experience</label>
<input
type="text"
name="experience"
class="form-control"
placeholder="e.g. 5 Years Experience">
</div>

<div class="mb-3">
<label>Trainer Photo</label>
<input
type="file"
name="image"
class="form-control">
</div>

<button
name="add"
class="btn btn-success">

Add Trainer

</button>

<a
href="admin.php"
class="btn btn-secondary">

Back

</a>

</form>

</div>

</div>

</div>

<?php include 'includes/footer.php'; ?>