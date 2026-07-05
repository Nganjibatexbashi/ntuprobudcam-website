<?php
session_start();
require_once '../config/config.php';

// Check authentication
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add' || $action === 'edit') {
        $title = trim($_POST['title']);
        $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $title));
        $category = trim($_POST['category']);
        $author = trim($_POST['author']);
        $content = trim($_POST['content']);
        $excerpt = trim($_POST['excerpt']);
        $status = $_POST['status'] ?? 'draft';
        
        if ($action === 'add') {
            $sql = "INSERT INTO news (title, slug, category, author, content, excerpt, status) VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $slug, $category, $author, $content, $excerpt, $status]);
        } else {
            $id = intval($_POST['id']);
            $sql = "UPDATE news SET title=?, slug=?, category=?, author=?, content=?, excerpt=?, status=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $slug, $category, $author, $content, $excerpt, $status, $id]);
        }
    } elseif ($action === 'delete') {
        $id = intval($_POST['id']);
        $pdo->prepare("DELETE FROM news WHERE id = ?")->execute([$id]);
    }
    
    header('Location: news.php');
    exit;
}

// Get all news
$news = $pdo->query("SELECT * FROM news ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage News - NTUPROBUDCAM Admin</title>
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
        .badge-published { background: var(--accent-green); color: white; }
        .badge-draft { background: var(--light-gray); color: var(--dark-gray); }
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
                <li><a href="news.php" class="active"><i class="fas fa-newspaper"></i> News</a></li>
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
                <li><a href="settings.php"><i class="fas fa-cog"></i> Settings</a></li>
                <li style="margin-top: 2rem;"><a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
            </ul>
        </aside>
        
        <main class="main-content">
            <div class="d-flex justify-between align-center mb-4">
                <h1>Manage News</h1>
                <button onclick="showModal()" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add News</button>
            </div>
            
            <div class="card" style="padding: 2rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($news as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['title']) ?></td>
                            <td><?= htmlspecialchars($item['category']) ?></td>
                            <td><?= htmlspecialchars($item['author']) ?></td>
                            <td><span class="badge badge-<?= $item['status'] ?>"><?= $item['status'] ?></span></td>
                            <td><?= date('M j, Y', strtotime($item['created_at'])) ?></td>
                            <td>
                                <button onclick="editNews(<?= $item['id'] ?>)" class="btn btn-sm btn-outline">Edit</button>
                                <form method="POST" style="display: inline;">
                                    <input type="hidden" name="action" value="delete">
                                    <input type="hidden" name="id" value="<?= $item['id'] ?>">
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
    
    <div id="newsModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: var(--radius-lg); padding: 2rem; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto;">
            <h2 style="margin-bottom: 1.5rem;">Add/Edit News</h2>
            <form method="POST">
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="id" id="newsId">
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="newsTitle" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Category</label>
                    <input type="text" class="form-control" name="category" id="newsCategory">
                </div>
                <div class="form-group">
                    <label class="form-label">Author</label>
                    <input type="text" class="form-control" name="author" id="newsAuthor" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Excerpt</label>
                    <textarea class="form-control" name="excerpt" id="newsExcerpt" rows="2"></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Content</label>
                    <textarea class="form-control" name="content" id="newsContent" rows="5" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-control form-select" name="status" id="newsStatus">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
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
            document.getElementById('newsModal').style.display = 'flex';
            document.getElementById('formAction').value = 'add';
            document.getElementById('newsId').value = '';
            document.getElementById('newsTitle').value = '';
            document.getElementById('newsCategory').value = '';
            document.getElementById('newsAuthor').value = '';
            document.getElementById('newsExcerpt').value = '';
            document.getElementById('newsContent').value = '';
            document.getElementById('newsStatus').value = 'draft';
        }
        
        function hideModal() {
            document.getElementById('newsModal').style.display = 'none';
        }
        
        function editNews(id) {
            <?php foreach ($news as $item): ?>
            if (id === <?= $item['id'] ?>) {
                document.getElementById('newsModal').style.display = 'flex';
                document.getElementById('formAction').value = 'edit';
                document.getElementById('newsId').value = '<?= $item['id'] ?>';
                document.getElementById('newsTitle').value = '<?= htmlspecialchars($item['title']) ?>';
                document.getElementById('newsCategory').value = '<?= htmlspecialchars($item['category']) ?>';
                document.getElementById('newsAuthor').value = '<?= htmlspecialchars($item['author']) ?>';
                document.getElementById('newsExcerpt').value = '<?= htmlspecialchars($item['excerpt'] ?? '') ?>';
                document.getElementById('newsContent').value = '<?= htmlspecialchars($item['content']) ?>';
                document.getElementById('newsStatus').value = '<?= $item['status'] ?>';
            }
            <?php endforeach; ?>
        }
    </script>
</body>
</html>
