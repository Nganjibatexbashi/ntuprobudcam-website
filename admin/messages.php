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
    
    if ($action === 'read') {
        $pdo->prepare("UPDATE contact_messages SET status = 'read' WHERE id = ?")->execute([$id]);
    } elseif ($action === 'delete') {
        $pdo->prepare("DELETE FROM contact_messages WHERE id = ?")->execute([$id]);
    } elseif ($action === 'reply') {
        $message_id = intval($_POST['message_id']);
        $reply = trim($_POST['reply'] ?? '');
        
        // Get original message
        $stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = ?");
        $stmt->execute([$message_id]);
        $msg = $stmt->fetch();
        
        if ($msg && !empty($reply)) {
            // Send reply email
            require_once ROOT_PATH . '/includes/mailer.php';
            
            $subject = 'Re: ' . ($msg['subject'] ?? 'Your message to NTUPROBUDCAM');
            $body = "
            <html>
            <head>
            <title>Reply from NTUPROBUDCAM</title>
            </head>
            <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
            <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
            <h2 style='color: #003366;'>Reply from NTUPROBUDCAM</h2>
            <p>Dear {$msg['full_name']},</p>
            <p>Thank you for contacting us. Here is our response:</p>
            <div style='background: #f5f5f5; padding: 15px; border-left: 4px solid #003366; margin: 1rem 0;'>
                " . nl2br(htmlspecialchars($reply)) . "
            </div>
            <p>If you have any further questions, please don't hesitate to contact us.</p>
            <p>Best regards,<br>NTUPROBUDCAM Team<br>National Trade Union of Professional Bus Drivers of Cameroon</p>
            </div>
            </body>
            </html>
            ";
            
            sendEmail($msg['email'], $subject, $body);
            
            // Mark as replied
            $pdo->prepare("UPDATE contact_messages SET status = 'replied' WHERE id = ?")->execute([$message_id]);
        }
        
        header('Location: messages.php');
        exit;
    }
    
    header('Location: messages.php');
    exit;
}

// Filter by status
$filter_status = isset($_GET['status']) ? trim($_GET['status']) : '';

if ($filter_status) {
    $stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE status = ? ORDER BY created_at DESC");
    $stmt->execute([$filter_status]);
    $messages = $stmt->fetchAll();
} else {
    $messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC")->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - NTUPROBUDCAM Admin</title>
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
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 1rem; text-align: left; border-bottom: 1px solid var(--light-gray); }
        .badge { padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem; }
        .badge-new { background: var(--accent-green); color: white; }
        .badge-read { background: var(--light-gray); color: var(--dark-gray); }
        .badge-replied { background: var(--primary-blue); color: white; }
        .message-preview { max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
        .message-full { background: #f9f9f9; padding: 1rem; border-radius: 8px; margin: 0.5rem 0; font-size: 0.9rem; }
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
                <li><a href="messages.php" class="active"><i class="fas fa-envelope"></i> Messages</a></li>
                <li><a href="newsletter.php"><i class="fas fa-rss"></i> Newsletter</a></li>
                <li><a href="membership.php"><i class="fas fa-user-plus"></i> Membership</a></li>
                <li><a href="training-registrations.php"><i class="fas fa-graduation-cap"></i> Training</a></li>
                <li><a href="send-message.php"><i class="fas fa-paper-plane"></i> Send Message</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li style="margin-top: 2rem;"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <main class="main-content">
            <h1>Contact Messages</h1>
            
            <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                <form method="GET" class="d-flex align-center gap-3">
                    <label style="margin: 0;">Filter by Status:</label>
                    <select name="status" class="form-control form-select" style="width: auto;" onchange="this.form.submit()">
                        <option value="">All Messages</option>
                        <option value="new" <?= $filter_status === 'new' ? 'selected' : '' ?>>New</option>
                        <option value="read" <?= $filter_status === 'read' ? 'selected' : '' ?>>Read</option>
                        <option value="replied" <?= $filter_status === 'replied' ? 'selected' : '' ?>>Replied</option>
                    </select>
                    <?php if ($filter_status): ?>
                    <a href="messages.php" class="btn btn-outline btn-sm">Clear Filter</a>
                    <?php endif; ?>
                </form>
            </div>
            
            <div class="card" style="padding: 2rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($messages as $msg): ?>
                        <tr>
                            <td><?= htmlspecialchars($msg['full_name']) ?></td>
                            <td><?= htmlspecialchars($msg['email']) ?></td>
                            <td><?= htmlspecialchars($msg['subject'] ?? 'No subject') ?></td>
                            <td>
                                <div class="message-preview" title="<?= htmlspecialchars($msg['message']) ?>">
                                    <?= htmlspecialchars(substr($msg['message'], 0, 50)) ?>...
                                </div>
                            </td>
                            <td><span class="badge badge-<?= $msg['status'] ?>"><?= ucfirst($msg['status']) ?></span></td>
                            <td><?= date('M j, Y', strtotime($msg['created_at'])) ?></td>
                            <td>
                                <button onclick="viewMessage(<?= $msg['id'] ?>)" class="btn btn-sm btn-outline">View</button>
                                <?php if ($msg['status'] !== 'replied'): ?>
                                <button onclick="showReplyModal(<?= $msg['id'] ?>)" class="btn btn-sm btn-primary">Reply</button>
                                <?php endif; ?>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $msg['id'] ?>">
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
    
    <!-- View Message Modal -->
    <div id="viewModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: var(--radius-lg); padding: 2rem; max-width: 700px; width: 90%; max-height: 90vh; overflow-y: auto;">
            <h2 style="margin-bottom: 1.5rem;">Message Details</h2>
            <div id="viewContent"></div>
            <button onclick="hideViewModal()" class="btn btn-outline mt-3">Close</button>
        </div>
    </div>
    
    <!-- Reply Modal -->
    <div id="replyModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: var(--radius-lg); padding: 2rem; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto;">
            <h2 style="margin-bottom: 1.5rem;">Reply to Message</h2>
            <form method="POST" id="replyForm">
                <input type="hidden" name="action" value="reply">
                <input type="hidden" name="message_id" id="replyMessageId">
                <div class="form-group">
                    <label class="form-label">Original Message:</label>
                    <div id="originalMessage" class="message-full"></div>
                </div>
                <div class="form-group">
                    <label class="form-label">Your Reply:</label>
                    <textarea class="form-control" name="reply" rows="6" required></textarea>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Send Reply</button>
                    <button type="button" onclick="hideReplyModal()" class="btn btn-outline">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        const messages = <?= json_encode($messages) ?>;
        
        function viewMessage(id) {
            const msg = messages.find(m => m.id === id);
            if (msg) {
                const content = `
                    <p><strong>From:</strong> ${msg.full_name}</p>
                    <p><strong>Email:</strong> ${msg.email}</p>
                    <p><strong>Phone:</strong> ${msg.phone || 'N/A'}</p>
                    <p><strong>Subject:</strong> ${msg.subject || 'No subject'}</p>
                    <p><strong>Date:</strong> ${new Date(msg.created_at).toLocaleString()}</p>
                    <p><strong>Message:</strong></p>
                    <div class="message-full">${msg.message}</div>
                `;
                document.getElementById('viewContent').innerHTML = content;
                document.getElementById('viewModal').style.display = 'flex';
            }
        }
        
        function hideViewModal() {
            document.getElementById('viewModal').style.display = 'none';
        }
        
        function showReplyModal(id) {
            const msg = messages.find(m => m.id === id);
            if (msg) {
                document.getElementById('replyMessageId').value = id;
                document.getElementById('originalMessage').innerHTML = msg.message;
                document.getElementById('replyModal').style.display = 'flex';
            }
        }
        
        function hideReplyModal() {
            document.getElementById('replyModal').style.display = 'none';
        }
    </script>
</body>
</html>
