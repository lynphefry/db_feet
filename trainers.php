<?php
include 'includes/db.php';
include 'includes/auth.php';

include 'includes/header.php';
include 'includes/navbar.php';

// Search
if (isset($_GET['search']) && trim($_GET['search']) != "") {

    $search = "%" . trim($_GET['search']) . "%";

    $stmt = $conn->prepare("
        SELECT *
        FROM trainers
        WHERE name LIKE ?
        ORDER BY name ASC
    ");

    $stmt->bind_param("s", $search);
    $stmt->execute();
    $result = $stmt->get_result();

} else {

    $result = $conn->query("
        SELECT *
        FROM trainers
        ORDER BY name ASC
    ");
}
?>

<div class="container mt-5">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h2 class="fw-bold">Our Trainers</h2>

        <?php if (isAdmin()) { ?>

            <a href="add_trainer.php" class="btn btn-success">
                + Add Trainer
            </a>

        <?php } ?>

    </div>

    <!-- Search -->

    <form method="GET" class="mb-4">

        <div class="input-group">

            <input
                type="text"
                name="search"
                class="form-control"
                placeholder="Search trainer..."
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">

            <button class="btn btn-primary">
                Search
            </button>

        </div>

    </form>

    <div class="row">

        <?php if ($result->num_rows > 0) { ?>

            <?php while ($trainer = $result->fetch_assoc()) { ?>

                <div class="col-md-4 mb-4">

                    <div class="card shadow h-100">

                        <?php
                        $image = !empty($trainer['image'])
                            ? "assets/images/trainers/" . $trainer['image']
                            : "assets/images/trainers/default.jpg";
                        ?>

                        <img
                            src="<?php echo $image; ?>"
                            class="card-img-top"
                            style="height:320px; object-fit:cover;"
                            alt="Trainer">

                        <div class="card-body text-center">

                            <h4>
                                <?php echo htmlspecialchars($trainer['name']); ?>
                            </h4>

                            <p class="text-success fw-bold">

                                <?php echo htmlspecialchars($trainer['specialty']); ?>

                            </p>

                            <?php if (!empty($trainer['experience'])) { ?>

                                <p class="text-muted">

                                    <?php echo htmlspecialchars($trainer['experience']); ?>

                                </p>

                            <?php } ?>

                        </div>

                        <?php if (isAdmin()) { ?>

                            <div class="card-footer text-center">

                                <a
                                    href="edit_trainer.php?id=<?php echo $trainer['id']; ?>"
                                    class="btn btn-warning btn-sm">

                                    Edit

                                </a>

                                <a
                                    href="delete_trainer.php?id=<?php echo $trainer['id']; ?>"
                                    class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this trainer?');">

                                    Delete

                                </a>

                            </div>

                        <?php } ?>

                    </div>

                </div>

            <?php } ?>

        <?php } else { ?>

            <div class="col-12">

                <div class="alert alert-warning text-center">

                    No trainers found.

                </div>

            </div>

        <?php } ?>

    </div>

</div>

<?php include 'includes/footer.php'; ?>