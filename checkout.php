<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Checkout - Feet To Fit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">

<h2>Checkout</h2>

<form method="POST" action="mpesa.php" class="mt-4">

    <div class="mb-3">
        <label>Phone Number </label>
        <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Amount (KES)</label>
        <input type="number" name="amount" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">
        Pay with M-Pesa
    </button>

</form>

</body>
</html>