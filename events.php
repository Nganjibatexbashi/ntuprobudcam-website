<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Events';
$page_description = 'Upcoming and past events from NTUPROBUDCAM - Register for our activities and programs';
require_once ROOT_PATH . '/includes/header.php';

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * EVENTS_PER_PAGE;

// Filter
$status = isset($_GET['status']) ? trim($_GET['status']) : '';

// Build query
$where = ["1=1"];
$params = [];

if ($status) {
    $where[] = "status = ?";
    $params[] = $status;
}

$whereClause = implode(' AND ', $where);

// Get total count
$countSql = "SELECT COUNT(*) FROM events WHERE $whereClause";
$countStmt = $pdo->prepare($countSql);
$countStmt->execute($params);
$totalEvents = $countStmt->fetchColumn();
$totalPages = ceil($totalEvents / EVENTS_PER_PAGE);

// Get events
$sql = "SELECT * FROM events WHERE $whereClause ORDER BY event_date DESC LIMIT " . EVENTS_PER_PAGE . " OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$events = $stmt->fetchAll();
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Events</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Join us at our upcoming activities and programs</p>
    </div>
</section>

<!-- Filter -->
<section class="section section-light">
    <div class="container">
        <div class="card" style="padding: 2rem;" data-aos="fade-up">
            <div class="d-flex align-center gap-3 flex-wrap">
                <strong style="color: var(--primary-blue);">Filter by:</strong>
                <a href="events.php" class="btn <?= $status === '' ? 'btn-primary' : 'btn-outline' ?>">All Events</a>
                <a href="events.php?status=upcoming" class="btn <?= $status === 'upcoming' ? 'btn-primary' : 'btn-outline' ?>">Upcoming</a>
                <a href="events.php?status=ongoing" class="btn <?= $status === 'ongoing' ? 'btn-primary' : 'btn-outline' ?>">Ongoing</a>
                <a href="events.php?status=completed" class="btn <?= $status === 'completed' ? 'btn-primary' : 'btn-outline' ?>">Completed</a>
            </div>
        </div>
    </div>
</section>

<!-- Events Grid -->
<section class="section">
    <div class="container">
        <?php if (count($events) > 0): ?>
        <div class="row">
            <?php foreach ($events as $event): ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $event['id'] * 50 ?>">
                <div class="card" style="height: 100%;">
                    <?php if ($event['image']): ?>
                    <img src="<?= UPLOADS_PATH . '/' . $event['image'] ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                    <div style="height: 200px; background: linear-gradient(135deg, var(--accent-green), var(--accent-green-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-calendar-alt" style="font-size: 3rem; color: white;"></i>
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="d-flex justify-between align-center mb-2">
                            <span class="badge" style="background: var(--primary-blue); color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;"><?= ucfirst($event['status']) ?></span>
                            <?php if ($event['event_date'] >= date('Y-m-d')): ?>
                            <span class="badge" style="background: var(--secondary-gold); color: var(--primary-blue); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">
                                <i class="far fa-clock"></i> <?= date('M d', strtotime($event['event_date'])) ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <h4 class="card-title"><?= htmlspecialchars($event['title']) ?></h4>
                        <p class="card-text"><?= substr(strip_tags($event['description']), 0, 100) ?>...</p>
                        <div class="mt-3">
                            <?php if ($event['location']): ?>
                            <p style="margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt text-accent mr-2"></i><?= htmlspecialchars($event['location']) ?></p>
                            <?php endif; ?>
                            <?php if ($event['event_time']): ?>
                            <p style="margin-bottom: 0.5rem;"><i class="far fa-clock text-accent mr-2"></i><?= date('H:i', strtotime($event['event_time'])) ?></p>
                            <?php endif; ?>
                        </div>
                        <?php if ($event['status'] === 'upcoming' && $event['event_date'] >= date('Y-m-d')): ?>
                        <button onclick="showRegistrationModal(<?= $event['id'] ?>)" class="btn btn-primary btn-sm mt-2">Register Now</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        
        <!-- Pagination -->
        <?php if ($totalPages > 1): ?>
        <div class="d-flex justify-center mt-4" data-aos="fade-up">
            <nav>
                <ul class="pagination" style="display: flex; gap: 0.5rem; list-style: none; padding: 0;">
                    <?php if ($page > 1): ?>
                    <li><a href="?page=<?= $page - 1 ?>&status=<?= urlencode($status) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;">Previous</a></li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $page): ?>
                    <li><span class="btn btn-primary" style="padding: 0.5rem 1rem;"><?= $i ?></span></li>
                    <?php else: ?>
                    <li><a href="?page=<?= $i ?>&status=<?= urlencode($status) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;"><?= $i ?></a></li>
                    <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li><a href="?page=<?= $page + 1 ?>&status=<?= urlencode($status) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
        
        <?php else: ?>
        <div class="text-center" data-aos="fade-up">
            <div style="padding: 3rem;">
                <i class="fas fa-calendar-alt" style="font-size: 4rem; color: var(--light-gray); margin-bottom: 1rem;"></i>
                <h3>No Events Found</h3>
                <p class="text-muted">No events match your filter criteria.</p>
                <a href="events.php" class="btn btn-primary mt-3">View All Events</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Registration Modal -->
<div class="modal" id="registrationModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: var(--z-modal); align-items: center; justify-content: center;">
    <div class="modal-content" style="background: var(--white); border-radius: var(--radius-lg); padding: 2rem; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; position: relative;">
        <button onclick="closeRegistrationModal()" style="position: absolute; top: 1rem; right: 1rem; width: 40px; height: 40px; border: none; background: var(--light-gray); border-radius: var(--radius-full); cursor: pointer; font-size: 1.2rem;">&times;</button>
        <h3 style="margin-bottom: 1.5rem;">Event Registration</h3>
        <form method="POST" action="includes/event-registration.php" id="registrationForm">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION[CSRF_TOKEN] ?>">
            <input type="hidden" name="event_id" id="eventIdInput">
            <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label class="form-label">Phone Number</label>
                <input type="tel" class="form-control" name="phone">
            </div>
            <div class="form-group">
                <label class="form-label">Organization</label>
                <input type="text" class="form-control" name="organization">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>
</div>

<script>
function showRegistrationModal(eventId) {
    document.getElementById('eventIdInput').value = eventId;
    document.getElementById('registrationModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeRegistrationModal() {
    document.getElementById('registrationModal').style.display = 'none';
    document.body.style.overflow = '';
}

document.getElementById('registrationModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeRegistrationModal();
    }
});
</script>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
