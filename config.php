<?php
// Database connection configuration
$db_host = 'localhost';
$db_port = 3306;
$db_name = 'registration';
$db_user = 'root';
$db_pass = '';

// While you are building the site, show the real error details on screen.
// Set to false when the site goes live.
$DEBUG = true;

$db_error = '';
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);   // errors become exceptions

try {
    try {
        $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name, $db_port);
    } catch (mysqli_sql_exception $ex) {
        if ((int)$ex->getCode() === 1049) {   // database does not exist yet -> create it
            $conn = mysqli_connect($db_host, $db_user, $db_pass, '', $db_port);
            mysqli_query($conn, "CREATE DATABASE IF NOT EXISTS `$db_name` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
            mysqli_select_db($conn, $db_name);
        } else {
            throw $ex;
        }
    }
    mysqli_set_charset($conn, 'utf8mb4');

    // Create the users table automatically if it is not there yet
    mysqli_query($conn, "CREATE TABLE IF NOT EXISTS portal_users (
        id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        fullname      VARCHAR(100) NOT NULL,
        email         VARCHAR(120) NOT NULL UNIQUE,
        password_hash VARCHAR(255) NOT NULL,
        created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB");
} catch (mysqli_sql_exception $ex) {
    $conn     = null;               // auth.php shows a friendly message instead of crashing
    $db_error = $ex->getMessage();
}
