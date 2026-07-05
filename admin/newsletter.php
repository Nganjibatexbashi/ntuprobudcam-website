<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $id = intval($_POST['id']);
    
    if ($action === 'delete') {
        $pdo->prepare("DELETE FROM newsletter WHERE id = ?")->execute([$id]);
    }
    
    header('Location: newsletter.php');
    exit;
}

$subscribers = $pdo->query("SELECT * FROM newsletter ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsletter - NTUPROBUDCAM Admin</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--light-gray); }
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
                <li><a href="newsletter.php" class="active"><i class="fas fa-rss"></i> Newsletter</a></li>
                <li><a href="membership.php"><i class="fas fa-user-plus"></i> Membership</a></li>
                <li><a href="training-registrations.php"><i class="fas fa-graduation-cap"></i> Training</a></li>
                <li><a href="send-message.php"><i class="fas fa-paper-plane"></i> Send Message</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li style="margin-top: 2rem;"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <main class="main-content">
            <h1>Newsletter Subscribers</h1>
            
            <div class="card" style="padding: 2rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Email</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th>Subscribed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($subscribers as $sub): ?>
                        <tr>
                            <td><?= htmlspecialchars($sub['email']) ?></td>
                            <td><?= htmlspecialchars($sub['full_name'] ?? '') ?></td>
                            <td><?= $sub['status'] ?></td>
                            <td><?= date('M j, Y', strtotime($sub['created_at'])) ?></td>
                            <td>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $sub['id'] ?>">
                                    <button type="submit" class="btn btn-sm" style="background: #fee; color: #c00;">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
