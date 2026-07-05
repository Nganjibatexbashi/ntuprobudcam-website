<?php
require_once __DIR__ . '/../config/config.php';
require_once ROOT_PATH . '/includes/mailer.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
    exit;
}

$email = trim($_POST['email'] ?? '');

if (empty($email)) {
    echo json_encode(['success' => false, 'message' => 'Email is required']);
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo json_encode(['success' => false, 'message' => 'Invalid email address']);
    exit;
}

try {
    // Check if already subscribed
    $stmt = $pdo->prepare("SELECT id FROM newsletter WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        echo json_encode(['success' => false, 'message' => 'You are already subscribed to our newsletter']);
        exit;
    }
    
    // Insert new subscriber
    $sql = "INSERT INTO newsletter (email, full_name, status, created_at) VALUES (?, ?, 'active', NOW())";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email, '']);
    
    // Send confirmation email
    $subject = 'Newsletter Subscription Confirmed - NTUPROBUDCAM';
    $message = "
    <html>
    <head>
    <title>Newsletter Subscription Confirmed</title>
    </head>
    <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
    <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
    <h2 style='color: #003366;'>Welcome to NTUPROBUDCAM Newsletter!</h2>
    <p>Thank you for subscribing to our newsletter.</p>
    <p>You will now receive updates about:</p>
    <ul>
        <li>Latest news and announcements</li>
        <li>Upcoming events and training programs</li>
        <li>Road safety tips and resources</li>
        <li>Membership benefits and opportunities</li>
    </ul>
    <p>We respect your privacy and you can unsubscribe at any time by clicking the unsubscribe link in our emails.</p>
    <p>If you have any questions, please contact us at info@ntuprobudcam.org</p>
    <p>Best regards,<br>NTUPROBUDCAM Team<br>National Trade Union of Professional Bus Drivers of Cameroon</p>
    </div>
    </body>
    </html>
    ";
    
    sendEmail($email, $subject, $message);
    
    echo json_encode(['success' => true, 'message' => 'Thank you for subscribing!']);
    
} catch (Exception $e) {
    echo json_encode(['success' => false, 'message' => 'Subscription failed. Please try again.']);
}
