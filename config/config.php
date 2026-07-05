<?php
/**
 * General Configuration
 * TUPROBUDCAM Website
 */

// Site Configuration
define('SITE_NAME', 'NTUPROBUDCAM');
define('SITE_FULL_NAME', 'National Trade Union of Professional Bus Drivers of Cameroon');
define('SITE_URL', 'http://localhost/bashi');
define('SITE_EMAIL', 'contact@tuprobudcam.org');
define('SITE_PHONE', '+237 123 456 789');
define('SITE_ADDRESS', 'Yaoundé, Cameroon');

// Paths
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'] . '/bashi');
define('ASSETS_PATH', SITE_URL . '/assets');
define('UPLOADS_PATH', SITE_URL . '/uploads');

// Session Configuration
if (session_status() === PHP_SESSION_NONE) {
    ini_set('session.cookie_httponly', 1);
    ini_set('session.use_only_cookies', 1);
    ini_set('session.cookie_secure', 0); // Set to 1 if using HTTPS
    session_start();
}

// Timezone
date_default_timezone_set('Africa/Douala');

// Error Reporting (Set to 0 in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Security
define('CSRF_TOKEN', 'csrf_token');
if (!isset($_SESSION[CSRF_TOKEN])) {
    $_SESSION[CSRF_TOKEN] = bin2hex(random_bytes(32));
}

// Email Configuration (PHPMailer)
define('SMTP_HOST', 'smtp.gmail.com');
define('SMTP_PORT', 587);
define('SMTP_ENCRYPTION', 'tls');
define('SMTP_USER', 'your-email@gmail.com');
define('SMTP_PASS', 'your-app-password');
define('SMTP_FROM', 'noreply@ntuprobudcam.org');
define('SMTP_FROM_NAME', SITE_NAME);

// Pagination
define('NEWS_PER_PAGE', 6);
define('EVENTS_PER_PAGE', 6);
define('GALLERY_PER_PAGE', 12);

// File Upload Limits
define('MAX_FILE_SIZE', 5242880); // 5MB
define('ALLOWED_IMAGE_TYPES', ['image/jpeg', 'image/png', 'image/gif', 'image/webp']);
define('ALLOWED_DOC_TYPES', ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document']);

// Include Database
require_once ROOT_PATH . '/config/database.php';
?>
