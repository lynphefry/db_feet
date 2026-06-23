<form method="POST" action="stk_push.php">

    <input type="hidden" name="amount" value="<?= $total ?>">

    <input
        type="text"
        name="phone"
        class="form-control mb-3"
        placeholder="2547XXXXXXXX"
        required>

    <button class="btn btn-success w-100">
        Pay with M-Pesa
    </button>

</form>