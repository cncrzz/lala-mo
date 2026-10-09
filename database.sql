-- OPTIONAL: config.php now creates the database and table automatically.
CREATE DATABASE IF NOT EXISTS registration
    CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

USE registration;

CREATE TABLE IF NOT EXISTS portal_users (
    id            INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    fullname      VARCHAR(100) NOT NULL,
    email         VARCHAR(120) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,
    created_at    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;
