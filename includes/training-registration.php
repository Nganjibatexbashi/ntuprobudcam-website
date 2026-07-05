<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/mailer.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../training.php');
    exit;
}

// Validate CSRF token
if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION[CSRF_TOKEN]) {
    $_SESSION['error'] = 'Invalid request. Please try again.';
    header('Location: ../training.php');
    exit;
}

$success = false;
$error = '';

try {
    $full_name = trim($_POST['full_name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $training_type = trim($_POST['training_type'] ?? '');
    $region = trim($_POST['region'] ?? '');
    $company = trim($_POST['company'] ?? '');
    
    // Validation
    if (empty($full_name) || empty($email) || empty($phone) || empty($training_type)) {
        throw new Exception('Please fill in all required fields.');
    }
    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        throw new Exception('Please enter a valid email address.');
    }
    
    // Check if training_registrations table exists, if not create it
    $pdo->exec("CREATE TABLE IF NOT EXISTS training_registrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        full_name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        phone VARCHAR(20) NOT NULL,
        training_type VARCHAR(50) NOT NULL,
        region VARCHAR(100),
        company VARCHAR(100),
        status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci");
    
    // Insert registration
    $sql = "INSERT INTO training_registrations (full_name, email, phone, training_type, region, company) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$full_name, $email, $phone, $training_type, $region, $company]);
    
    // Send confirmation email
    $training_names = [
        'defensive' => 'Defensive Driving',
        'customer' => 'Customer Service Excellence',
        'maintenance' => 'Vehicle Maintenance',
        'firstaid' => 'First Aid & Emergency Response',
        'leadership' => 'Leadership Development',
        'labor' => 'Labor Rights & Regulations'
    ];
    $training_name = $training_names[$training_type] ?? $training_type;
    
    $subject = 'Training Registration Confirmation - NTUPROBUDCAM';
    $message = "
    <html>
    <head>
    <title>Training Registration Confirmation</title>
    </head>
    <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
    <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
    <h2 style='color: #003366;'>Training Registration Confirmation</h2>
    <p>Dear $full_name,</p>
    <p>Thank you for registering for the <strong>$training_name</strong> training program with NTUPROBUDCAM.</p>
    <p><strong>Registration Details:</strong></p>
    <ul>
        <li>Training: $training_name</li>
        <li>Phone: $phone</li>
        <li>Region: $region</li>
        " . ($company ? "<li>Company: $company</li>" : "") . "
    </ul>
    <p>Your registration is currently <strong>Pending</strong>. We will review your application and contact you with further details about the training schedule and venue.</p>
    <p>If you have any questions, please contact us at info@ntuprobudcam.org</p>
    <p>Best regards,<br>NTUPROBUDCAM Team<br>National Trade Union of Professional Bus Drivers of Cameroon</p>
    </div>
    </body>
    </html>
    ";
    
    sendEmail($email, $subject, $message);
    
    $success = true;
    
} catch (Exception $e) {
    $error = $e->getMessage();
}

$_SESSION['training_success'] = $success;
$_SESSION['training_error'] = $error;

header('Location: ../training.php');
exit;
