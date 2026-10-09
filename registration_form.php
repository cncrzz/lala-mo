<!-- Registration form (shown in the Register tab of login.php) -->
<?php echo $message; ?>

<form action="index.php" method="POST">
    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">

    <div class="mb-3">
        <label for="fullname" class="form-label">Full Name</label>
        <input type="text" class="form-control" id="fullname" name="fullname" value="<?= e($reg_fullname) ?>" required>
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email Address</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= e($reg_email) ?>" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password <small class="text-muted">(min. 8 characters)</small></label>
        <input type="password" class="form-control" id="password" name="password" minlength="8" required>
    </div>
    <div class="mb-3">
        <label for="confirm" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" id="confirm" name="confirm" minlength="8" required>
    </div>
    <button type="submit" name="register_submit" class="btn btn-primary w-100">Register Account</button>
</form>
