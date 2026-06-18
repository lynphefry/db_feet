<?php
include 'db.php';

$messageSent = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contact(name,email,message)
            VALUES('$name','$email','$message')";

    if(mysqli_query($conn,$sql)){
        $messageSent = "Message sent successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>



<div class="container mt-5">

    <div class="card shadow p-4">

        <h2 class="mb-4">Contact Us</h2>

        <?php if($messageSent){ ?>
            <div class="alert alert-success">
                <?= $messageSent ?>
            </div>
        <?php } ?>

        <form method="POST">

            <input
                type="text"
                name="name"
                class="form-control mb-3"
                placeholder="Your Name"
                required>

            <input
                type="email"
                name="email"
                class="form-control mb-3"
                placeholder="Your Email"
                required>

            <textarea
                name="message"
                class="form-control mb-3"
                rows="5"
                placeholder="Your Message"
                required></textarea>

            <button class="btn btn-success">
                Send Message
            </button>

        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>