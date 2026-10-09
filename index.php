<?php
ob_start();        // buffer output so redirects (header) never fail
session_start();
include "config.php";   // database connection ($conn)
include "auth.php";     // logout / registration / login handling

$loggedIn   = !empty($_SESSION['user']);
$page_title = $loggedIn ? 'Dashboard' : 'Login';
?>
<!DOCTYPE html>
<html lang="en">

<?php include "header.php"; ?>

<?php if (!$loggedIn): ?>

<!-- ================= NOT LOGGED IN: LOGIN / REGISTER SCREEN ================= -->
<body id="page-top" class="login-page">

    <?php include "login.php"; ?>

<?php else: ?>

<!-- ================= LOGGED IN: DASHBOARD ================= -->
<body id="page-top" data-bs-spy="scroll" data-bs-target="#sideNav" data-bs-offset="74" tabindex="0">

    <?php include "navigation.php"; ?>

    <!-- Page Content-->
    <div class="container-fluid p-0">

        <div class="welcome-bar">
            Welcome back, <strong class="text-primary"><?= e($_SESSION['user']['fullname']) ?></strong>
            <span class="text-muted">&middot; <?= e($_SESSION['user']['email']) ?></span>
        </div>

        <?php include "about.php"; ?>
        <?php include "experience.php"; ?>
        <?php include "education.php"; ?>
        <?php include "skills.php"; ?>
        <?php include "interest.php"; ?>
        <?php include "awards.php"; ?>

    </div>

<?php endif; ?>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
