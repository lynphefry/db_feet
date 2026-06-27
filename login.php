<?php
include "includes/auth.php";
include "includes/db.php";

if (isLoggedIn()) {
    header("Location: dashboard.php");
    exit();
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, first_name, password, role FROM members WHERE email=?");
    $stmt->bind_param("s", $email);
    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows == 1) {

        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['first_name'] = $user['first_name'];
            $_SESSION['role'] = $user['role'];

            header("Location: dashboard.php");
            exit();

        } else {

            $message = "<div class='alert alert-danger'>Invalid email or password.</div>";

        }

    } else {

        $message = "<div class='alert alert-danger'>Invalid email or password.</div>";

    }

    $stmt->close();
}

include "includes/header.php";
include "includes/navbar.php";
?>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-5">

            <div class="card shadow">

                <div class="card-header bg-success text-white text-center">
<div class="mb-3">
    <label class="form-label">Login As</label>

    <select name="role" class="form-select" required>
        <option value="trainee">Trainee</option>
        <option value="trainer">Trainer</option>
    </select>
</div>
                    <h3>Login</h3>

                </div>

                <div class="card-body">

                    <?= $message ?>

                    <form method="POST" autocomplete="off">

                        <input type="text" style="display:none">
                        <input type="password" style="display:none">

                        <div class="mb-3">

                            <label>Email</label>
<input
    type="email"
    name="email"
    id="email"
    class="form-control"
    autocomplete="new-email"
    spellcheck="false"
    autocapitalize="off"
    required>

                        </div>

                        <div class="mb-3">

                            <label>Password</label>

                            <div class="input-group">

                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    placeholder="Enter your password"
                                    autocomplete="new-password"
                                    required>

                                <button
                                    class="btn btn-outline-secondary"
                                    type="button"
                                    onclick="togglePassword()">

                                    👁

                                </button>

                            </div>

                        </div>

                        <div class="text-end mb-3">

                            <a href="forgot_password.php">
                                Forgot Password?
                            </a>

                        </div>

                        <button class="btn btn-success w-100">

                            Login

                        </button>

                    </form>

                    <div class="text-center mt-3">

                        Don't have an account?

                        <a href="register.php">

                            Register

                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

function togglePassword(){

    var password=document.getElementById("password");

    if(password.type==="password"){

        password.type="text";

    }else{

        password.type="password";

    }

}

window.onload=function(){

document.getElementById("email").value="";
document.getElementById("password").value="";

}

</script>

<?php include "includes/footer.php"; ?>