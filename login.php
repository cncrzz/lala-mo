<!-- ============ LOGIN SCREEN (first thing visitors see) ============ -->
<div id="login" class="container d-flex flex-column justify-content-center align-items-center py-5">

    <div class="text-center mb-4">
        <h1 class="mb-1">Member <span class="text-primary">Portal</span></h1>
        <p class="mb-0">Sign in to open your dashboard, or create a new account.</p>
    </div>

    <div class="card p-4 p-md-5 shadow-lg w-100" style="max-width: 480px;">

        <!-- Tabs -->
        <ul class="nav nav-pills nav-fill mb-4" id="authTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $active_tab === 'login' ? 'active' : '' ?>" id="login-tab"
                        data-bs-toggle="pill" data-bs-target="#login-pane" type="button" role="tab">Log In</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link <?= $active_tab === 'register' ? 'active' : '' ?>" id="register-tab"
                        data-bs-toggle="pill" data-bs-target="#register-pane" type="button" role="tab">Register</button>
            </li>
        </ul>

        <div class="tab-content">

            <!-- LOG IN -->
            <div class="tab-pane fade <?= $active_tab === 'login' ? 'show active' : '' ?>" id="login-pane" role="tabpanel">
                <?php echo $login_message; ?>

                <form action="index.php" method="POST">
                    <input type="hidden" name="csrf" value="<?= e(csrf_token()) ?>">
                    <div class="mb-3">
                        <label for="login_email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="login_email" name="login_email" required>
                    </div>
                    <div class="mb-3">
                        <label for="login_password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="login_password" name="login_password" required>
                    </div>
                    <button type="submit" name="login_submit" class="btn btn-primary w-100 mb-3">Log In</button>
                </form>

                <div class="text-center">
                    <small class="text-muted">Don't have an account? Open the <strong>Register</strong> tab.</small>
                </div>
            </div>

            <!-- REGISTER -->
            <div class="tab-pane fade <?= $active_tab === 'register' ? 'show active' : '' ?>" id="register-pane" role="tabpanel">
                <?php include "registration_form.php"; ?>
            </div>

        </div>
    </div>
</div>
