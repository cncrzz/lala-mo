<?php
/* ============================================================
   AUTH: logout, registration and login handling
   (included by index.php after session_start() and config.php)
   ============================================================ */

function e($v): string { return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8'); }

function alert(string $type, string $text): string {
    return '<div class="alert alert-' . $type . '">' . e($text) . '</div>';
}

/* Red alert; when $DEBUG is true it also shows the technical reason */
function alert_fail(string $text, string $detail = ''): string {
    global $DEBUG;
    if (!empty($DEBUG) && $detail !== '') { $text .= '  [debug: ' . $detail . ']'; }
    return alert('danger', $text);
}

function csrf_token(): string {
    if (empty($_SESSION['csrf'])) { $_SESSION['csrf'] = bin2hex(random_bytes(32)); }
    return $_SESSION['csrf'];
}
function csrf_check(): bool {
    return isset($_POST['csrf'], $_SESSION['csrf']) && hash_equals($_SESSION['csrf'], $_POST['csrf']);
}

$login_message = '';     // shown on the Log In tab
$message       = '';     // shown on the Register tab
$active_tab    = 'login';
$reg_fullname  = '';
$reg_email     = '';

/* ---------- LOGOUT ---------- */
if (isset($_GET['logout'])) {
    $_SESSION = [];
    session_destroy();
    header('Location: index.php');
    exit;
}

if (isset($_GET['registered'])) {
    $login_message = alert('success', 'Registration successful! You can now log in.');
}

/* ---------- REGISTRATION ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register_submit']) && empty($_SESSION['user'])) {
    $active_tab   = 'register';
    $reg_fullname = trim($_POST['fullname'] ?? '');
    $reg_email    = strtolower(trim($_POST['email'] ?? ''));
    $pass         = $_POST['password'] ?? '';
    $confirm      = $_POST['confirm'] ?? '';

    if (!csrf_check()) {
        $message = alert_fail('Your session expired. Please refresh the page and try again.', 'CSRF token mismatch - sessions may not be working');
    } elseif ($conn === null) {
        $message = alert_fail('Cannot connect to the database.', $db_error);
    } elseif (strlen($reg_fullname) < 2 || strlen($reg_fullname) > 100) {
        $message = alert_fail('Please enter your full name.');
    } elseif (!filter_var($reg_email, FILTER_VALIDATE_EMAIL)) {
        $message = alert_fail('Please enter a valid email address.');
    } elseif (strlen($pass) < 8 || strlen($pass) > 72) {
        $message = alert_fail('Password must be 8 to 72 characters.');
    } elseif ($pass !== $confirm) {
        $message = alert_fail('Passwords do not match.');
    } else {
        try {
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $stmt = mysqli_prepare($conn, 'INSERT INTO portal_users (fullname, email, password_hash) VALUES (?, ?, ?)');
            mysqli_stmt_bind_param($stmt, 'sss', $reg_fullname, $reg_email, $hash);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
            header('Location: index.php?registered=1');
            exit;
        } catch (mysqli_sql_exception $ex) {
            $message = ((int)$ex->getCode() === 1062)       // duplicate email
                ? alert_fail('That email is already registered.')
                : alert_fail('Registration failed. Please try again.', $ex->getMessage());
        }
    }
}

/* ---------- LOGIN ---------- */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login_submit']) && empty($_SESSION['user'])) {
    $login_email = strtolower(trim($_POST['login_email'] ?? ''));
    $login_pass  = $_POST['login_password'] ?? '';

    if (!csrf_check()) {
        $login_message = alert_fail('Your session expired. Please refresh the page and try again.', 'CSRF token mismatch - sessions may not be working');
    } elseif ($login_email === '' || $login_pass === '') {
        $login_message = alert_fail('Please enter your email and password.');
    } elseif ($conn === null) {
        $login_message = alert_fail('Cannot connect to the database.', $db_error);
    } else {
        try {
            $stmt = mysqli_prepare($conn, 'SELECT id, fullname, email, password_hash FROM portal_users WHERE email = ? LIMIT 1');
            mysqli_stmt_bind_param($stmt, 's', $login_email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $r_id, $r_name, $r_email, $r_hash);
            $found = (bool)mysqli_stmt_fetch($stmt);
            mysqli_stmt_close($stmt);

            if ($found && password_verify($login_pass, $r_hash)) {
                session_regenerate_id(true);
                $_SESSION['user'] = [
                    'id'       => $r_id,
                    'fullname' => $r_name,
                    'email'    => $r_email,
                ];
                header('Location: index.php');
                exit;
            }
            $login_message = alert_fail(
                'Invalid email or password.',
                $found ? 'password does not match' : 'no account with that email - register first'
            );
        } catch (mysqli_sql_exception $ex) {
            $login_message = alert_fail('Login failed. Please try again.', $ex->getMessage());
        }
    }
}
