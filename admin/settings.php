<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($_POST as $key => $value) {
        if ($key !== 'csrf_token') {
            $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = ?")->execute([$key, $value, $value]);
        }
    }
    
    header('Location: settings.php?saved=1');
    exit;
}

$settings = $pdo->query("SELECT setting_key, setting_value FROM settings")->fetchAll(PDO::FETCH_KEY_PAIR);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - NTUPROBUDCAM Admin</title>
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
                <li><a href="send-message.php"><i class="fas fa-paper-plane"></i> Send Message</a></li>
                <li><a href="settings.php" class="active"><i class="fas fa-cog"></i> Settings</a></li>
                <li style="margin-top: 2rem;"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <main class="main-content">
            <h1>Site Settings</h1>
            
            <?php if (isset($_GET['saved'])): ?>
            <div style="background: var(--accent-green); color: white; padding: 1rem; margin-bottom: 1rem; border-radius: var(--radius-sm);">
                Settings saved successfully!
            </div>
            <?php endif; ?>
            
            <div class="card" style="padding: 2rem;">
                <form method="POST">
                    <div class="form-group">
                        <label class="form-label">Site Title</label>
                        <input type="text" class="form-control" name="site_title" value="<?= htmlspecialchars($settings['site_title'] ?? SITE_NAME) ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Site Description</label>
                        <textarea class="form-control" name="site_description" rows="3"><?= htmlspecialchars($settings['site_description'] ?? SITE_FULL_NAME) ?></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Site Keywords</label>
                        <input type="text" class="form-control" name="site_keywords" value="<?= htmlspecialchars($settings['site_keywords'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Facebook URL</label>
                        <input type="url" class="form-control" name="facebook_url" value="<?= htmlspecialchars($settings['facebook_url'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Twitter URL</label>
                        <input type="url" class="form-control" name="twitter_url" value="<?= htmlspecialchars($settings['twitter_url'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">LinkedIn URL</label>
                        <input type="url" class="form-control" name="linkedin_url" value="<?= htmlspecialchars($settings['linkedin_url'] ?? '') ?>">
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Instagram URL</label>
                        <input type="url" class="form-control" name="instagram_url" value="<?= htmlspecialchars($settings['instagram_url'] ?? '') ?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Save Settings</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
