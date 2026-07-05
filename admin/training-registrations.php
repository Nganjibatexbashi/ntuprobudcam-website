<?php
session_start();
require_once '../config/config.php';
require_once ROOT_PATH . '/includes/mailer.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add') {
        $full_name = trim($_POST['full_name'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $phone = trim($_POST['phone'] ?? '');
        $training_type = trim($_POST['training_type'] ?? '');
        $region = trim($_POST['region'] ?? '');
        $company = trim($_POST['company'] ?? '');
        $status = trim($_POST['status'] ?? 'pending');
        
        $sql = "INSERT INTO training_registrations (full_name, email, phone, training_type, region, company, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$full_name, $email, $phone, $training_type, $region, $company, $status]);
    } elseif ($action === 'update_status') {
        $id = intval($_POST['id']);
        $status = trim($_POST['status'] ?? 'pending');
        
        // Get registration details before updating
        $stmt = $pdo->prepare("SELECT * FROM training_registrations WHERE id = ?");
        $stmt->execute([$id]);
        $reg = $stmt->fetch();
        
        $pdo->prepare("UPDATE training_registrations SET status = ? WHERE id = ?")->execute([$status, $id]);
        
        // Send status update email
        if ($reg) {
            $training_names = [
                'defensive' => 'Defensive Driving',
                'customer' => 'Customer Service Excellence',
                'maintenance' => 'Vehicle Maintenance',
                'firstaid' => 'First Aid & Emergency Response',
                'leadership' => 'Leadership Development',
                'labor' => 'Labor Rights & Regulations'
            ];
            $training_name = $training_names[$reg['training_type']] ?? $reg['training_type'];
            
            $to = $reg['email'];
            $subject = 'Training Registration Status Update - NTUPROBUDCAM';
            
            if ($status === 'confirmed') {
                $message = "
                <html>
                <head>
                <title>Training Registration Confirmed</title>
                </head>
                <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                <h2 style='color: #28a745;'>Training Registration Confirmed!</h2>
                <p>Dear {$reg['full_name']},</p>
                <p>Great news! Your registration for the <strong>$training_name</strong> training program has been <strong>CONFIRMED</strong>.</p>
                <p><strong>Training Details:</strong></p>
                <ul>
                    <li>Training: $training_name</li>
                    <li>Phone: {$reg['phone']}</li>
                    <li>Region: {$reg['region']}</li>
                    " . ($reg['company'] ? "<li>Company: {$reg['company']}</li>" : "") . "
                </ul>
                <p>We will contact you soon with the specific training schedule, venue, and any additional information you may need.</p>
                <p>If you have any questions, please contact us at info@ntuprobudcam.org</p>
                <p>Best regards,<br>NTUPROBUDCAM Team<br>National Trade Union of Professional Bus Drivers of Cameroon</p>
                </div>
                </body>
                </html>
                ";
            } elseif ($status === 'cancelled') {
                $message = "
                <html>
                <head>
                <title>Training Registration Cancelled</title>
                </head>
                <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
                <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
                <h2 style='color: #dc3545;'>Training Registration Status Update</h2>
                <p>Dear {$reg['full_name']},</p>
                <p>We regret to inform you that your registration for the <strong>$training_name</strong> training program has been <strong>CANCELLED</strong>.</p>
                <p><strong>Registration Details:</strong></p>
                <ul>
                    <li>Training: $training_name</li>
                    <li>Phone: {$reg['phone']}</li>
                    <li>Region: {$reg['region']}</li>
                    " . ($reg['company'] ? "<li>Company: {$reg['company']}</li>" : "") . "
                </ul>
                <p>If you believe this is an error or would like more information about this decision, please contact us at info@ntuprobudcam.org</p>
                <p>Best regards,<br>NTUPROBUDCAM Team<br>National Trade Union of Professional Bus Drivers of Cameroon</p>
                </div>
                </body>
                </html>
                ";
            }
            
            sendEmail($to, $subject, $message);
        }
    } elseif ($action === 'delete') {
        $id = intval($_POST['id']);
        $pdo->prepare("DELETE FROM training_registrations WHERE id = ?")->execute([$id]);
    }
    
    header('Location: training-registrations.php');
    exit;
}

// Filter by training type
$filter_training = isset($_GET['training']) ? trim($_GET['training']) : '';

if ($filter_training) {
    $stmt = $pdo->prepare("SELECT * FROM training_registrations WHERE training_type = ? ORDER BY created_at DESC");
    $stmt->execute([$filter_training]);
    $registrations = $stmt->fetchAll();
} else {
    $registrations = $pdo->query("SELECT * FROM training_registrations ORDER BY created_at DESC")->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Training Registrations - NTUPROBUDCAM Admin</title>
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
        .status-badge { padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; }
        .status-pending { background: #fff3cd; color: #856404; }
        .status-confirmed { background: #d4edda; color: #155724; }
        .status-cancelled { background: #f8d7da; color: #721c24; }
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
                <li><a href="training-registrations.php" class="active"><i class="fas fa-graduation-cap"></i> Training</a></li>
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li style="margin-top: 2rem;"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <main class="main-content">
            <div class="d-flex justify-between align-center mb-4">
                <h1>Training Registrations</h1>
                <button onclick="showModal()" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Registration</button>
            </div>
            
            <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                <form method="GET" class="d-flex align-center gap-3">
                    <label style="margin: 0;">Filter by Training:</label>
                    <select name="training" class="form-control form-select" style="width: auto;" onchange="this.form.submit()">
                        <option value="">All Trainings</option>
                        <option value="defensive" <?= $filter_training === 'defensive' ? 'selected' : '' ?>>Defensive Driving</option>
                        <option value="customer" <?= $filter_training === 'customer' ? 'selected' : '' ?>>Customer Service Excellence</option>
                        <option value="maintenance" <?= $filter_training === 'maintenance' ? 'selected' : '' ?>>Vehicle Maintenance</option>
                        <option value="firstaid" <?= $filter_training === 'firstaid' ? 'selected' : '' ?>>First Aid & Emergency Response</option>
                        <option value="leadership" <?= $filter_training === 'leadership' ? 'selected' : '' ?>>Leadership Development</option>
                        <option value="labor" <?= $filter_training === 'labor' ? 'selected' : '' ?>>Labor Rights & Regulations</option>
                    </select>
                    <?php if ($filter_training): ?>
                    <a href="training-registrations.php" class="btn btn-outline btn-sm">Clear Filter</a>
                    <?php endif; ?>
                </form>
            </div>
            
            <div class="card" style="padding: 2rem;">
                <?php if (count($registrations) > 0): ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Training Type</th>
                            <th>Region</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($registrations as $reg): ?>
                        <tr>
                            <td><?= htmlspecialchars($reg['full_name']) ?></td>
                            <td><?= htmlspecialchars($reg['email']) ?></td>
                            <td><?= htmlspecialchars($reg['phone']) ?></td>
                            <td><?= htmlspecialchars(ucfirst(str_replace('_', ' ', $reg['training_type']))) ?></td>
                            <td><?= htmlspecialchars($reg['region'] ?? '-') ?></td>
                            <td>
                                <span class="status-badge status-<?= $reg['status'] ?>"><?= ucfirst($reg['status']) ?></span>
                            </td>
                            <td><?= date('M d, Y', strtotime($reg['created_at'])) ?></td>
                            <td>
                                <button onclick="updateStatus(<?= $reg['id'] ?>, 'confirmed')" class="btn btn-sm" style="background: #d4edda; color: #155724; margin-right: 0.25rem;">Approve</button>
                                <button onclick="updateStatus(<?= $reg['id'] ?>, 'cancelled')" class="btn btn-sm" style="background: #f8d7da; color: #721c24; margin-right: 0.25rem;">Reject</button>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $reg['id'] ?>">
                                    <button type="submit" class="btn btn-sm" style="background: #fee; color: #c00; margin-left: 0.5rem;">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                <p style="text-align: center; color: var(--dark-gray); padding: 2rem;">No training registrations found.</p>
                <?php endif; ?>
            </div>
        </main>
    </div>
    
    <div id="registrationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: var(--radius-lg); padding: 2rem; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto;">
            <h2 style="margin-bottom: 1.5rem;">Add Training Registration</h2>
            <form method="POST" id="registrationForm">
                <input type="hidden" name="action" value="add">
                <div class="form-group">
                    <label class="form-label">Full Name</label>
                    <input type="text" class="form-control" name="full_name" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Phone</label>
                    <input type="tel" class="form-control" name="phone" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Training Type</label>
                    <select class="form-control form-select" name="training_type" required>
                        <option value="">Select Training</option>
                        <option value="defensive">Defensive Driving</option>
                        <option value="customer">Customer Service Excellence</option>
                        <option value="maintenance">Vehicle Maintenance</option>
                        <option value="firstaid">First Aid & Emergency Response</option>
                        <option value="leadership">Leadership Development</option>
                        <option value="labor">Labor Rights & Regulations</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Region</label>
                    <select class="form-control form-select" name="region">
                        <option value="">Select Region</option>
                        <option value="Adamawa">Adamawa</option>
                        <option value="Centre">Centre</option>
                        <option value="East">East</option>
                        <option value="Far North">Far North</option>
                        <option value="Littoral">Littoral</option>
                        <option value="North">North</option>
                        <option value="Northwest">Northwest</option>
                        <option value="West">West</option>
                        <option value="South">South</option>
                        <option value="Southwest">Southwest</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Company/Employer</label>
                    <input type="text" class="form-control" name="company">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-control form-select" name="status">
                        <option value="pending">Pending</option>
                        <option value="confirmed">Confirmed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="d-flex gap-2 mt-3">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" onclick="hideModal()" class="btn btn-outline">Cancel</button>
                </div>
            </form>
        </div>
    </div>
    
    <script>
        function showModal() {
            document.getElementById('registrationModal').style.display = 'flex';
        }
        
        function hideModal() {
            document.getElementById('registrationModal').style.display = 'none';
        }
        
        function updateStatus(id, status) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.innerHTML = `
                <input type="hidden" name="action" value="update_status">
                <input type="hidden" name="id" value="${id}">
                <input type="hidden" name="status" value="${status}">
            `;
            document.body.appendChild(form);
            form.submit();
        }
    </script>
</body>
</html>
