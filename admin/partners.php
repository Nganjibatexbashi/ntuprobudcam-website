<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Create uploads directory if it doesn't exist
$uploadDir = ROOT_PATH . '/uploads/partners';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add' || $action === 'edit') {
        $id = $action === 'edit' ? intval($_POST['id']) : null;
        $name = trim($_POST['name'] ?? '');
        $category = trim($_POST['category'] ?? 'General');
        $website = trim($_POST['website'] ?? '');
        $description = trim($_POST['description'] ?? '');
        $status = trim($_POST['status'] ?? 'active');
        $order_index = intval($_POST['order_index'] ?? 0);
        
        $logo_path = null;
        
        // Handle logo upload
        if (isset($_FILES['logo']) && $_FILES['logo']['error'] === UPLOAD_ERR_OK) {
            $file = $_FILES['logo'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
            
            if (in_array($file['type'], $allowedTypes)) {
                $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
                $filename = uniqid() . '.' . $extension;
                $filepath = 'partners/' . $filename;
                
                if (move_uploaded_file($file['tmp_name'], ROOT_PATH . '/uploads/' . $filepath)) {
                    $logo_path = $filepath;
                }
            }
        }
        
        if ($action === 'add') {
            $sql = "INSERT INTO partners (name, category, website, description, logo, status, order_index) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $category, $website, $description, $logo_path, $status, $order_index]);
        } else {
            // Update existing
            if ($logo_path) {
                $sql = "UPDATE partners SET name = ?, category = ?, website = ?, description = ?, logo = ?, status = ?, order_index = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$name, $category, $website, $description, $logo_path, $status, $order_index, $id]);
            } else {
                $sql = "UPDATE partners SET name = ?, category = ?, website = ?, description = ?, status = ?, order_index = ? WHERE id = ?";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([$name, $category, $website, $description, $status, $order_index, $id]);
            }
        }
    } elseif ($action === 'delete') {
        $id = intval($_POST['id']);
        $pdo->prepare("DELETE FROM partners WHERE id = ?")->execute([$id]);
    }
    
    header('Location: partners.php');
    exit;
}

$partners = $pdo->query("SELECT * FROM partners ORDER BY order_index ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Partners - NTUPROBUDCAM Admin</title>
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
                <li><a href="partners.php" class="active"><i class="fas fa-handshake"></i> Partners</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i> Messages</a></li>
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
                <h1>Manage Partners</h1>
                <button onclick="showModal()" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Partner</button>
            </div>
            
            <div class="card" style="padding: 2rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Website</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($partners as $partner): ?>
                        <tr>
                            <td><?= htmlspecialchars($partner['name']) ?></td>
                            <td><?= htmlspecialchars($partner['category']) ?></td>
                            <td><?= htmlspecialchars($partner['website'] ?? '') ?></td>
                            <td><?= $partner['status'] ?></td>
                            <td>
                                <button onclick="editModal(<?= htmlspecialchars(json_encode($partner)) ?>)" class="btn btn-sm" style="background: var(--primary-blue); color: white; margin-right: 0.5rem;">Edit</button>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $partner['id'] ?>">
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
    
    <div id="partnerModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: var(--radius-lg); padding: 2rem; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto;">
            <h2 style="margin-bottom: 1.5rem;" id="modalTitle">Add Partner</h2>
            <form method="POST" enctype="multipart/form-data" id="partnerForm">
                <input type="hidden" name="action" value="add" id="formAction">
                <input type="hidden" name="id" value="" id="formId">
                <div class="form-group">
                    <label class="form-label">Partner Name</label>
                    <input type="text" class="form-control" name="name" id="formName" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" id="formCategory" value="General">
                </div>
                <div class="form-group">
                    <label class="form-label">Website</label>
                    <input type="url" class="form-control" name="website" id="formWebsite">
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="formDescription" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-control form-select" name="status" id="formStatus">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Order Index</label>
                    <input type="number" class="form-control" name="order_index" id="formOrderIndex" value="0">
                </div>
                <div class="form-group">
                    <label class="form-label">Logo</label>
                    <input type="file" class="form-control" name="logo" accept="image/*">
                    <small class="text-muted">Leave empty to keep existing logo when editing</small>
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
            document.getElementById('modalTitle').textContent = 'Add Partner';
            document.getElementById('formAction').value = 'add';
            document.getElementById('formId').value = '';
            document.getElementById('formName').value = '';
            document.getElementById('formCategory').value = 'General';
            document.getElementById('formWebsite').value = '';
            document.getElementById('formDescription').value = '';
            document.getElementById('formStatus').value = 'active';
            document.getElementById('formOrderIndex').value = '0';
            document.getElementById('partnerForm').reset();
            document.getElementById('partnerModal').style.display = 'flex';
        }
        
        function editModal(partner) {
            document.getElementById('modalTitle').textContent = 'Edit Partner';
            document.getElementById('formAction').value = 'edit';
            document.getElementById('formId').value = partner.id;
            document.getElementById('formName').value = partner.name;
            document.getElementById('formCategory').value = partner.category;
            document.getElementById('formWebsite').value = partner.website || '';
            document.getElementById('formDescription').value = partner.description || '';
            document.getElementById('formStatus').value = partner.status;
            document.getElementById('formOrderIndex').value = partner.order_index;
            document.getElementById('partnerModal').style.display = 'flex';
        }
        
        function hideModal() {
            document.getElementById('partnerModal').style.display = 'none';
        }
    </script>
</body>
</html>
