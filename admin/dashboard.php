<?php
session_start();
require_once '../config/config.php';

// Check authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Get statistics
$stats = [
    'news' => $pdo->query("SELECT COUNT(*) FROM news")->fetchColumn(),
    'events' => $pdo->query("SELECT COUNT(*) FROM events")->fetchColumn(),
    'gallery' => $pdo->query("SELECT COUNT(*) FROM gallery")->fetchColumn(),
    'documents' => $pdo->query("SELECT COUNT(*) FROM documents")->fetchColumn(),
    'members' => $pdo->query("SELECT COUNT(*) FROM membership_applications")->fetchColumn(),
    'messages' => $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn(),
    'newsletter' => $pdo->query("SELECT COUNT(*) FROM newsletter")->fetchColumn(),
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NTUPROBUDCAM</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background: var(--off-white);
        }
        .admin-layout {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: var(--primary-blue);
            color: white;
            padding: 2rem 1rem;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }
        .sidebar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: var(--secondary-gold);
        }
        .sidebar-nav {
            list-style: none;
            padding: 0;
        }
        .sidebar-nav li {
            margin-bottom: 0.5rem;
        }
        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            border-radius: var(--radius-sm);
            transition: all 0.2s;
        }
        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: rgba(255,255,255,0.1);
            color: white;
        }
        .main-content {
            margin-left: 250px;
            padding: 2rem;
            flex: 1;
        }
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-sm);
            text-align: center;
        }
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary-blue);
        }
        .stat-label {
            color: var(--dark-gray);
            font-size: 0.9rem;
        }
        @media (max-width: 768px) {
            .sidebar {
                width: 100%;
                position: relative;
                height: auto;
            }
            .main-content {
                margin-left: 0;
            }
        }
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
                <li><a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                <li><a href="news.php"><i class="fas fa-newspaper"></i> News</a></li>
                <li><a href="events.php"><i class="fas fa-calendar"></i> Events</a></li>
                <li><a href="gallery.php"><i class="fas fa-images"></i> Gallery</a></li>
                <li><a href="documents.php"><i class="fas fa-file-alt"></i> Documents</a></li>
                <li><a href="leadership.php"><i class="fas fa-users"></i> Leadership</a></li>
                <li><a href="partners.php"><i class="fas fa-handshake"></i> Partners</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i> Messages <span class="badge" style="background: var(--secondary-gold); color: var(--primary-blue);"><?= $stats['messages'] ?></span></a></li>
                <li><a href="newsletter.php"><i class="fas fa-rss"></i> Newsletter</a></li>
                <li><a href="membership.php"><i class="fas fa-user-plus"></i> Membership</a></li>
                <li><a href="training-registrations.php"><i class="fas fa-graduation-cap"></i> Training</a></li>
                <li><a href="send-message.php"><i class="fas fa-paper-plane"></i> Send Message</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li style="margin-top: 2rem;"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <main class="main-content">
            <div class="d-flex justify-between align-center mb-4">
                <h1>Dashboard</h1>
                <div>
                    <span style="color: var(--dark-gray);">Welcome, </span>
                    <strong><?= htmlspecialchars($_SESSION['admin_username']) ?></strong>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-number"><?= $stats['news'] ?></div>
                        <div class="stat-label">News Articles</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-number"><?= $stats['events'] ?></div>
                        <div class="stat-label">Events</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-number"><?= $stats['gallery'] ?></div>
                        <div class="stat-label">Gallery Items</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-number"><?= $stats['documents'] ?></div>
                        <div class="stat-label">Documents</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-number"><?= $stats['members'] ?></div>
                        <div class="stat-label">Membership Applications</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-number" style="color: var(--accent-green);"><?= $stats['messages'] ?></div>
                        <div class="stat-label">New Messages</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-number"><?= $stats['newsletter'] ?></div>
                        <div class="stat-label">Newsletter Subscribers</div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="stat-card">
                        <div class="stat-number" style="color: var(--secondary-gold);">10</div>
                        <div class="stat-label">Regional Sections</div>
                    </div>
                </div>
            </div>
            
            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card" style="padding: 2rem;">
                        <h3 style="margin-bottom: 1rem;">Recent Membership Applications</h3>
                        <?php
                        $recent_members = $pdo->query("SELECT * FROM membership_applications ORDER BY created_at DESC LIMIT 5")->fetchAll();
                        if (count($recent_members) > 0):
                        ?>
                        <ul style="list-style: none; padding: 0;">
                            <?php foreach ($recent_members as $member): ?>
                            <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--light-gray);">
                                <div class="d-flex justify-between align-center">
                                    <div>
                                        <strong><?= htmlspecialchars($member['full_name']) ?></strong>
                                        <br><small class="text-muted"><?= htmlspecialchars($member['region']) ?> - <?= htmlspecialchars($member['town']) ?></small>
                                    </div>
                                    <span class="badge" style="background: var(--light-gray);"><?= $member['status'] ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <p class="text-muted">No membership applications yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card" style="padding: 2rem;">
                        <h3 style="margin-bottom: 1rem;">Recent Contact Messages</h3>
                        <?php
                        $recent_messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5")->fetchAll();
                        if (count($recent_messages) > 0):
                        ?>
                        <ul style="list-style: none; padding: 0;">
                            <?php foreach ($recent_messages as $msg): ?>
                            <li style="padding: 0.75rem 0; border-bottom: 1px solid var(--light-gray);">
                                <div class="d-flex justify-between align-center">
                                    <div>
                                        <strong><?= htmlspecialchars($msg['full_name']) ?></strong>
                                        <br><small class="text-muted"><?= htmlspecialchars($msg['subject'] ?? 'No subject') ?></small>
                                    </div>
                                    <span class="badge" style="background: <?= $msg['status'] === 'new' ? 'var(--accent-green)' : 'var(--light-gray)' ?>; color: white;"><?= $msg['status'] ?></span>
                                </div>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                        <?php else: ?>
                        <p class="text-muted">No messages yet.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
