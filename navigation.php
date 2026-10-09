<?php
$navUser = $_SESSION['user'] ?? ['fullname' => 'Guest'];
$initial = function_exists('mb_substr')
    ? mb_strtoupper(mb_substr($navUser['fullname'], 0, 1))
    : strtoupper(substr($navUser['fullname'], 0, 1));
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top" id="sideNav">
    <a class="navbar-brand js-scroll-trigger" href="#page-top">
        <span class="d-block d-lg-none">Portal Dashboard</span>
        <span class="d-none d-lg-block">
            <?php if (file_exists("assets/img/profile.jpg")): ?>
                <img class="img-fluid img-profile rounded-circle mx-auto mb-2" src="assets/img/profile.jpg" alt="Profile" />
            <?php else: ?>
                <div class="avatar-initial mx-auto mb-2"><?= e($initial) ?></div>
            <?php endif; ?>
        </span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav">
            <li class="nav-item d-none d-lg-block pb-3 small text-muted">Signed in as<br><strong class="text-white"><?= e($navUser['fullname']) ?></strong></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#about">About</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#experience">Experience</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Education</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">Skills</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#interests">Interests</a></li>
            <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#awards">Awards</a></li>
            <li class="nav-item mt-4"><a class="nav-link text-danger font-weight-bold" href="index.php?logout=true"><i class="fas fa-sign-out-alt"></i> Log Out</a></li>
        </ul>
    </div>
</nav>
