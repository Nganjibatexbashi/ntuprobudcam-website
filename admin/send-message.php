<?php
session_start();
require_once '../config/config.php';
require_once ROOT_PATH . '/includes/mailer.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

$success = '';
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'send') {
        $recipients = $_POST['recipients'] ?? '';
        $subject = trim($_POST['subject'] ?? '');
        $message = trim($_POST['message'] ?? '');
        $custom_emails = trim($_POST['custom_emails'] ?? '');
        
        if (empty($subject) || empty($message)) {
            $error = 'Subject and message are required.';
        } else {
            $emails = [];
            
            // Get emails based on recipient selection
            switch ($recipients) {
                case 'members':
                    $stmt = $pdo->query("SELECT DISTINCT email FROM membership_applications WHERE email != ''");
                    $results = $stmt->fetchAll();
                    foreach ($results as $row) {
                        $emails[] = $row['email'];
                    }
                    break;
                    
                case 'training':
                    $stmt = $pdo->query("SELECT DISTINCT email FROM training_registrations WHERE email != ''");
                    $results = $stmt->fetchAll();
                    foreach ($results as $row) {
                        $emails[] = $row['email'];
                    }
                    break;
                    
                case 'newsletter':
                    $stmt = $pdo->query("SELECT DISTINCT email FROM newsletter WHERE email != '' AND status = 'active'");
                    $results = $stmt->fetchAll();
                    foreach ($results as $row) {
                        $emails[] = $row['email'];
                    }
                    break;
                    
                case 'all':
                    // Combine all
                    $emails = [];
                    $stmt = $pdo->query("SELECT DISTINCT email FROM membership_applications WHERE email != ''");
                    $results = $stmt->fetchAll();
                    foreach ($results as $row) {
                        $emails[] = $row['email'];
                    }
                    $stmt = $pdo->query("SELECT DISTINCT email FROM training_registrations WHERE email != ''");
                    $results = $stmt->fetchAll();
                    foreach ($results as $row) {
                        $emails[] = $row['email'];
                    }
                    $stmt = $pdo->query("SELECT DISTINCT email FROM newsletter WHERE email != '' AND status = 'active'");
                    $results = $stmt->fetchAll();
                    foreach ($results as $row) {
                        $emails[] = $row['email'];
                    }
                    $emails = array_unique($emails);
                    break;
                    
                case 'custom':
                    if (!empty($custom_emails)) {
                        $emails = array_map('trim', explode(',', $custom_emails));
                        $emails = array_filter($emails, function($email) {
                            return filter_var($email, FILTER_VALIDATE_EMAIL);
                        });
                    }
                    break;
                    
                case 'specific':
                    $selected_emails = $_POST['selected_emails'] ?? [];
                    if (is_array($selected_emails)) {
                        $emails = array_filter($selected_emails, function($email) {
                            return filter_var($email, FILTER_VALIDATE_EMAIL);
                        });
                    }
                    break;
            }
            
            if (empty($emails)) {
                $error = 'No valid email addresses found for the selected recipients.';
            } else {
                $sent_count = 0;
                $failed_count = 0;
                
                $email_body = "
                <html>
                <head>
                <title>Message from NTUPROBUDCAM</title>
                </head>
                <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                <h2 style='color: #003366;'>Message from NTUPROBUDCAM</h2>
                <p>Dear Member,</p>
                <div style='background: #f5f5f5; padding: 15px; border-left: 4px solid #003366; margin: 1rem 0;'>
                    " . nl2br(htmlspecialchars($message)) . "
                </div>
                <p>If you have any questions, please contact us at info@ntuprobudcam.org</p>
                <p>Best regards,<br>NTUPROBUDCAM Team<br>National Trade Union of Professional Bus Drivers of Cameroon</p>
                </div>
                </body>
                </html>
                ";
                
                foreach ($emails as $email) {
                    if (sendEmail($email, $subject, $email_body)) {
                        $sent_count++;
                    } else {
                        $failed_count++;
                    }
                }
                
                $success = "Message sent to $sent_count recipients. " . ($failed_count > 0 ? "$failed_count failed." : '');
            }
        }
    }
}

// Get all users for specific user selection
$all_users = [];
$members = $pdo->query("SELECT DISTINCT full_name, email FROM membership_applications WHERE email != ''")->fetchAll();
foreach ($members as $m) {
    $all_users[] = ['name' => $m['full_name'], 'email' => $m['email'], 'type' => 'Member'];
}
$training = $pdo->query("SELECT DISTINCT full_name, email FROM training_registrations WHERE email != ''")->fetchAll();
foreach ($training as $t) {
    $all_users[] = ['name' => $t['full_name'], 'email' => $t['email'], 'type' => 'Training'];
}
$newsletter = $pdo->query("SELECT DISTINCT email FROM newsletter WHERE email != '' AND status = 'active'")->fetchAll();
foreach ($newsletter as $n) {
    $all_users[] = ['name' => $n['email'], 'email' => $n['email'], 'type' => 'Newsletter'];
}
// Remove duplicates by email
$unique_emails = [];
$all_users = array_filter($all_users, function($user) use (&$unique_emails) {
    if (in_array($user['email'], $unique_emails)) {
        return false;
    }
    $unique_emails[] = $user['email'];
    return true;
});
// Re-index array
$all_users = array_values($all_users);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Message - NTUPROBUDCAM Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { background: var(--off-white); }
        .admin-layout { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: var(--primary-blue); color: white; padding: 2rem 1rem; position: fixed; height: 100vh; overflow-y: auto; }
        .sidebar-brand { font-size: 1.5rem; font-weight: 700; margin-bottom: 2rem; color: var(--secondary-gold); }
        .sidebar-nav { list-style: none; padding: 0; }
        .sidebar-nav li { margin-bottom: 0.5rem; }
        .sidebar-nav a { display: flex; align-items: center; gap: 0.75rem; padding: 0.75rem 1rem; color: rgba(255,255,255,0.8); text-decoration: none; border-radius: var(--radius-sm); }
        .sidebar-nav a:hover, .sidebar-nav a.active { background: rgba(255,255,255,0.1); color: white; }
        .main-content { margin-left: 250px; padding: 2rem; flex: 1; }
    </style>
</head>
<body>
    <div class="admin-layout">
        <aside class="sidebar">
            <div class="sidebar-brand">
                <img src="../assets/images/logo.jpg" alt="NTUPROBUDCAM Logo" style="height: 60px; margin-bottom: 0.5rem;">
                <div>NTUPROBUDCAM</div>
            </div>
            <ul class="sidebar-nav">
                <li><a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="news.php"><i class="fas fa-newspaper"></i> News</a></li>
                <li><a href="events.php"><i class="fas fa-calendar"></i> Events</a></li>
                <li><a href="gallery.php"><i class="fas fa-images"></i> Gallery</a></li>
                <li><a href="documents.php"><i class="fas fa-file-alt"></i> Documents</a></li>
                <li><a href="leadership.php"><i class="fas fa-users"></i> Leadership</a></li>
                <li><a href="partners.php"><i class="fas fa-handshake"></i> Partners</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="newsletter.php"><i class="fas fa-rss"></i> Newsletter</a></li>
                <li><a href="membership.php"><i class="fas fa-user-plus"></i> Membership</a></li>
                <li><a href="training-registrations.php"><i class="fas fa-graduation-cap"></i> Training</a></li>
                <li><a href="send-message.php" class="active"><i class="fas fa-paper-plane"></i> Send Message</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li style="margin-top: 2rem;"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <main class="main-content">
            <h1>Send Message to Users</h1>
            
            <?php if ($success): ?>
            <div style="background: #d4edda; color: #155724; padding: 1rem; margin-bottom: 1rem; border-radius: var(--radius-sm);">
                <?= htmlspecialchars($success) ?>
            </div>
            <?php endif; ?>
            
            <?php if ($error): ?>
            <div style="background: #f8d7da; color: #721c24; padding: 1rem; margin-bottom: 1rem; border-radius: var(--radius-sm);">
                <?= htmlspecialchars($error) ?>
            </div>
            <?php endif; ?>
            
            <div class="card" style="padding: 2rem;">
                <form method="POST">
                    <input type="hidden" name="action" value="send">
                    
                    <div class="form-group">
                        <label class="form-label">Recipients</label>
                        <select class="form-control form-select" name="recipients" id="recipients" onchange="toggleRecipientOptions()" required>
                            <option value="">Select Recipients</option>
                            <option value="members">Membership Applicants</option>
                            <option value="training">Training Registrants</option>
                            <option value="newsletter">Newsletter Subscribers</option>
                            <option value="all">All Users (Combined)</option>
                            <option value="specific">Specific Users</option>
                            <option value="custom">Custom Email Addresses</option>
                        </select>
                    </div>
                    
                    <div class="form-group" id="customEmailsGroup" style="display: none;">
                        <label class="form-label">Custom Email Addresses (comma-separated)</label>
                        <textarea class="form-control" name="custom_emails" rows="3" placeholder="email1@example.com, email2@example.com, email3@example.com"></textarea>
                        <small class="text-muted">Separate multiple emails with commas</small>
                    </div>
                    
                    <div class="form-group" id="specificUsersGroup" style="display: none;">
                        <label class="form-label">Select Specific Users</label>
                        <div style="max-height: 300px; overflow-y: auto; border: 1px solid var(--light-gray); padding: 1rem; border-radius: var(--radius-sm);">
                            <div style="margin-bottom: 1rem;">
                                <label style="font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" id="selectAllUsers" onchange="toggleAllUsers()"> Select All
                                </label>
                            </div>
                            <?php foreach ($all_users as $user): ?>
                            <div style="margin-bottom: 0.5rem;">
                                <label style="cursor: pointer; display: flex; align-items: center; gap: 0.5rem;">
                                    <input type="checkbox" name="selected_emails[]" value="<?= htmlspecialchars($user['email']) ?>" class="user-checkbox">
                                    <span><?= htmlspecialchars($user['name']) ?></span>
                                    <span style="color: var(--dark-gray); font-size: 0.85rem;">(<?= htmlspecialchars($user['email']) ?>)</span>
                                    <span style="background: var(--light-gray); padding: 0.1rem 0.5rem; border-radius: 4px; font-size: 0.75rem;"><?= htmlspecialchars($user['type']) ?></span>
                                </label>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <small class="text-muted">Select the users you want to send the message to</small>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Subject</label>
                        <input type="text" class="form-control" name="subject" required placeholder="Enter message subject">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Message</label>
                        <textarea class="form-control" name="message" rows="8" required placeholder="Enter your message here..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane mr-2"></i>Send Message</button>
                </form>
            </div>
            
            <div class="card" style="padding: 2rem; margin-top: 2rem;">
                <h3>Recipient Statistics</h3>
                <div class="row">
                    <div class="col-md-3">
                        <div style="background: var(--light-gray); padding: 1.5rem; border-radius: var(--radius-sm); text-align: center;">
                            <h4 style="margin: 0; font-size: 2rem; color: var(--primary-blue);">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(DISTINCT email) as count FROM membership_applications WHERE email != ''");
                                echo $stmt->fetch()['count'];
                                ?>
                            </h4>
                            <p style="margin: 0.5rem 0 0;">Members</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="background: var(--light-gray); padding: 1.5rem; border-radius: var(--radius-sm); text-align: center;">
                            <h4 style="margin: 0; font-size: 2rem; color: var(--accent-green);">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(DISTINCT email) as count FROM training_registrations WHERE email != ''");
                                echo $stmt->fetch()['count'];
                                ?>
                            </h4>
                            <p style="margin: 0.5rem 0 0;">Training</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="background: var(--light-gray); padding: 1.5rem; border-radius: var(--radius-sm); text-align: center;">
                            <h4 style="margin: 0; font-size: 2rem; color: var(--secondary-gold);">
                                <?php
                                $stmt = $pdo->query("SELECT COUNT(DISTINCT email) as count FROM newsletter WHERE email != '' AND status = 'active'");
                                echo $stmt->fetch()['count'];
                                ?>
                            </h4>
                            <p style="margin: 0.5rem 0 0;">Newsletter</p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div style="background: var(--light-gray); padding: 1.5rem; border-radius: var(--radius-sm); text-align: center;">
                            <h4 style="margin: 0; font-size: 2rem; color: var(--dark-gray);">
                                <?php
                                $all_emails = [];
                                $stmt = $pdo->query("SELECT DISTINCT email FROM membership_applications WHERE email != ''");
                                foreach ($stmt->fetchAll() as $row) $all_emails[] = $row['email'];
                                $stmt = $pdo->query("SELECT DISTINCT email FROM training_registrations WHERE email != ''");
                                foreach ($stmt->fetchAll() as $row) $all_emails[] = $row['email'];
                                $stmt = $pdo->query("SELECT DISTINCT email FROM newsletter WHERE email != '' AND status = 'active'");
                                foreach ($stmt->fetchAll() as $row) $all_emails[] = $row['email'];
                                echo count(array_unique($all_emails));
                                ?>
                            </h4>
                            <p style="margin: 0.5rem 0 0;">Total Users</p>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    
    <script>
        function toggleRecipientOptions() {
            const recipients = document.getElementById('recipients').value;
            const customGroup = document.getElementById('customEmailsGroup');
            const specificGroup = document.getElementById('specificUsersGroup');
            
            customGroup.style.display = recipients === 'custom' ? 'block' : 'none';
            specificGroup.style.display = recipients === 'specific' ? 'block' : 'none';
        }
        
        function toggleAllUsers() {
            const selectAll = document.getElementById('selectAllUsers');
            const checkboxes = document.querySelectorAll('.user-checkbox');
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }
    </script>
</body>
</html>
