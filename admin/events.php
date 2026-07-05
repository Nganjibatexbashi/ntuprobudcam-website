<?php
session_start();
require_once '../config/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    if ($action === 'add' || $action === 'edit') {
        $title = trim($_POST['title']);
        $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', $title));
        $description = trim($_POST['description']);
        $event_date = $_POST['event_date'];
        $event_time = $_POST['event_time'];
        $location = trim($_POST['location']);
        $venue = trim($_POST['venue']);
        $status = $_POST['status'] ?? 'upcoming';
        
        if ($action === 'add') {
            $sql = "INSERT INTO events (title, slug, description, event_date, event_time, location, venue, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $slug, $description, $event_date, $event_time, $location, $venue, $status]);
        } else {
            $id = intval($_POST['id']);
            $sql = "UPDATE events SET title=?, slug=?, description=?, event_date=?, event_time=?, location=?, venue=?, status=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$title, $slug, $description, $event_date, $event_time, $location, $venue, $status, $id]);
        }
    } elseif ($action === 'delete') {
        $id = intval($_POST['id']);
        $pdo->prepare("DELETE FROM events WHERE id = ?")->execute([$id]);
    }
    
    header('Location: events.php');
    exit;
}

$events = $pdo->query("SELECT * FROM events ORDER BY event_date DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Events - NTUPROBUDCAM Admin</title>
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
        .badge-upcoming { background: var(--primary-blue); color: white; }
        .badge-ongoing { background: var(--accent-green); color: white; }
        .badge-completed { background: var(--light-gray); color: var(--dark-gray); }
        .badge-cancelled { background: #c00; color: white; }
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
                <li><a href="events.php" class="active"><i class="fas fa-calendar"></i> Events</a></li>
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
                <h1>Manage Events</h1>
                <button onclick="showModal()" class="btn btn-primary"><i class="fas fa-plus mr-2"></i>Add Event</button>
            </div>
            
            <div class="card" style="padding: 2rem;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($events as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['title']) ?></td>
                            <td><?= date('M j, Y', strtotime($item['event_date'])) ?></td>
                            <td><?= htmlspecialchars($item['location']) ?></td>
                            <td><span class="badge badge-<?= $item['status'] ?>"><?= $item['status'] ?></span></td>
                            <td>
                                <button onclick="editEvent(<?= $item['id'] ?>)" class="btn btn-sm btn-outline">Edit</button>
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
    
    <div id="eventModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 1000; align-items: center; justify-content: center;">
        <div style="background: white; border-radius: var(--radius-lg); padding: 2rem; max-width: 600px; width: 90%; max-height: 90vh; overflow-y: auto;">
            <h2 style="margin-bottom: 1.5rem;">Add/Edit Event</h2>
            <form method="POST">
                <input type="hidden" name="action" id="formAction" value="add">
                <input type="hidden" name="id" id="eventId">
                <div class="form-group">
                    <label class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="eventTitle" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="eventDescription" rows="3" required></textarea>
                </div>
                <div class="form-group">
                    <label class="form-label">Event Date</label>
                    <input type="date" class="form-control" name="event_date" id="eventDate" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Event Time</label>
                    <input type="time" class="form-control" name="event_time" id="eventTime">
                </div>
                <div class="form-group">
                    <label class="form-label">Location</label>
                    <input type="text" class="form-control" name="location" id="eventLocation">
                </div>
                <div class="form-group">
                    <label class="form-label">Venue</label>
                    <input type="text" class="form-control" name="venue" id="eventVenue">
                </div>
                <div class="form-group">
                    <label class="form-label">Status</label>
                    <select class="form-control form-select" name="status" id="eventStatus">
                        <option value="upcoming">Upcoming</option>
                        <option value="ongoing">Ongoing</option>
                        <option value="completed">Completed</option>
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
            document.getElementById('eventModal').style.display = 'flex';
            document.getElementById('formAction').value = 'add';
            document.getElementById('eventId').value = '';
            document.getElementById('eventTitle').value = '';
            document.getElementById('eventDescription').value = '';
            document.getElementById('eventDate').value = '';
            document.getElementById('eventTime').value = '';
            document.getElementById('eventLocation').value = '';
            document.getElementById('eventVenue').value = '';
            document.getElementById('eventStatus').value = 'upcoming';
        }
        
        function hideModal() {
            document.getElementById('eventModal').style.display = 'none';
        }
        
        function editEvent(id) {
            <?php foreach ($events as $item): ?>
            if (id === <?= $item['id'] ?>) {
                document.getElementById('eventModal').style.display = 'flex';
                document.getElementById('formAction').value = 'edit';
                document.getElementById('eventId').value = '<?= $item['id'] ?>';
                document.getElementById('eventTitle').value = '<?= htmlspecialchars($item['title']) ?>';
                document.getElementById('eventDescription').value = '<?= htmlspecialchars($item['description']) ?>';
                document.getElementById('eventDate').value = '<?= $item['event_date'] ?>';
                document.getElementById('eventTime').value = '<?= $item['event_time'] ?? '' ?>';
                document.getElementById('eventLocation').value = '<?= htmlspecialchars($item['location'] ?? '') ?>';
                document.getElementById('eventVenue').value = '<?= htmlspecialchars($item['venue'] ?? '') ?>';
                document.getElementById('eventStatus').value = '<?= $item['status'] ?>';
            }
            <?php endforeach; ?>
        }
    </script>
</body>
</html>
