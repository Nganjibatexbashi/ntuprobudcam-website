<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Gallery';
$page_description = 'Photo and video gallery from NTUPROBUDCAM events and activities';
require_once ROOT_PATH . '/includes/header.php';

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * GALLERY_PER_PAGE;

// Filter
$category = isset($_GET['category']) ? trim($_GET['category']) : '';
$type = isset($_GET['type']) ? trim($_GET['type']) : '';

// Build query
$where = ["1=1"];
$params = [];

if ($category) {
    $where[] = "category = ?";
    $params[] = $category;
}

if ($type) {
    $where[] = "file_type = ?";
    $params[] = $type;
}

$whereClause = implode(' AND ', $where);

// Get total count
$countSql = "SELECT COUNT(*) FROM gallery WHERE $whereClause";
$countStmt = $pdo->prepare($countSql);
$countStmt->execute($params);
$totalItems = $countStmt->fetchColumn();
$totalPages = ceil($totalItems / GALLERY_PER_PAGE);

// Get gallery items
$sql = "SELECT * FROM gallery WHERE $whereClause ORDER BY created_at DESC LIMIT " . GALLERY_PER_PAGE . " OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$galleryItems = $stmt->fetchAll();

// Get categories
$categories = $pdo->query("SELECT DISTINCT category FROM gallery ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Gallery</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Photos and videos from our activities and events</p>
    </div>
</section>

<!-- Filter -->
<section class="section section-light">
    <div class="container">
        <div class="card" style="padding: 2rem;" data-aos="fade-up">
            <div class="row align-center">
                <div class="col-md-6">
                    <div class="d-flex align-center gap-3 flex-wrap">
                        <strong style="color: var(--primary-blue);">Type:</strong>
                        <a href="gallery.php?category=<?= urlencode($category) ?>" class="btn <?= $type === '' ? 'btn-primary' : 'btn-outline' ?>">All</a>
                        <a href="gallery.php?type=image&category=<?= urlencode($category) ?>" class="btn <?= $type === 'image' ? 'btn-primary' : 'btn-outline' ?>">Photos</a>
                        <a href="gallery.php?type=video&category=<?= urlencode($category) ?>" class="btn <?= $type === 'video' ? 'btn-primary' : 'btn-outline' ?>">Videos</a>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control form-select" onchange="window.location.href=this.value">
                            <option value="gallery.php">All Categories</option>
                            <?php foreach ($categories as $cat): ?>
                            <option value="gallery.php?category=<?= urlencode($cat) ?>&type=<?= urlencode($type) ?>" <?= $category === $cat ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid -->
<section class="section">
    <div class="container">
        <?php if (count($galleryItems) > 0): ?>
        <div class="row">
            <?php foreach ($galleryItems as $item): ?>
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="<?= $item['id'] * 30 ?>">
                <div class="card gallery-item" style="cursor: pointer; overflow: hidden;">
                    <?php if ($item['file_type'] === 'image'): ?>
                    <img src="<?= UPLOADS_PATH . '/' . $item['file_path'] ?>" alt="<?= htmlspecialchars($item['title'] ?? 'Gallery Image') ?>" class="card-img-top" style="height: 250px; object-fit: cover; transition: transform 0.3s;" loading="lazy">
                    <?php else: ?>
                    <div style="height: 250px; background: var(--dark); display: flex; align-items:中心; justify-content: center; position: relative;">
                        <i class="fas fa-play-circle" style="font-size: 4rem; color: var(--secondary-gold);"></i>
                    </div>
                    <?php endif; ?>
                    <?php if ($item['title']): ?>
                    <div class="card-body" style="padding: 1rem;">
                        <h6 style="margin: 0;"><?= htmlspecialchars($item['title']) ?></h6>
                        <?php if ($item['category']): ?>
                        <small class="text-muted"><?= htmlspecialchars($item['category']) ?></small>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
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
                    <li><a href="?page=<?= $page - 1 ?>&category=<?= urlencode($category) ?>&type=<?= urlencode($type) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;">Previous</a></li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $page): ?>
                    <li><span class="btn btn-primary" style="padding: 0.5rem 1rem;"><?= $i ?></span></li>
                    <?php else: ?>
                    <li><a href="?page=<?= $i ?>&category=<?= urlencode($category) ?>&type=<?= urlencode($type) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;"><?= $i ?></a></li>
                    <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li><a href="?page=<?= $page + 1 ?>&category=<?= urlencode($category) ?>&type=<?= urlencode($type) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
        
        <?php else: ?>
        <div class="text-center" data-aos="fade-up">
            <div style="padding: 3rem;">
                <i class="fas fa-images" style="font-size: 4rem; color: var(--light-gray); margin-bottom: 1rem;"></i>
                <h3>No Gallery Items Found</h3>
                <p class="text-muted">No items match your filter criteria.</p>
                <a href="gallery.php" class="btn btn-primary mt-3">View All Items</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox -->
<div class="lightbox" id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.9); z-index: var(--z-modal); align-items: center; justify-content: center;">
    <button class="lightbox-close" onclick="closeLightbox()" style="position: absolute; top: 20px; right: 20px; width: 50px; height: 50px; border: none; background: rgba(255,255,255,0.2); border-radius: 50%; cursor: pointer; font-size: 1.5rem; color: white; transition: all 0.3s;">&times;</button>
    <button class="lightbox-prev" onclick="navigateLightbox(-1)" style="position: absolute; left: 20px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; border: none; background: rgba(255,255,255,0.2); border-radius: 50%; cursor: pointer; font-size: 1.5rem; color: white; transition: all 0.3s;">&lt;</button>
    <button class="lightbox-next" onclick="navigateLightbox(1)" style="position: absolute; right: 20px; top: 50%; transform: translateY(-50%); width: 50px; height: 50px; border: none; background: rgba(255,255,255,0.2); border-radius: 50%; cursor: pointer; font-size: 1.5rem; color: white; transition: all 0.3s;">&gt;</button>
    <img id="lightboxImage" src="" alt="" style="max-width: 90%; max-height: 90%; object-fit: contain;">
    <div id="lightboxCaption" style="position: absolute; bottom: 20px; left: 50%; transform: translateX(-50%); color: white; text-align: center; padding: 1rem;"></div>
</div>

<script>
const galleryItems = <?= json_encode($galleryItems) ?>;
let currentIndex = 0;

function openLightbox(index) {
    currentIndex = index;
    const item = galleryItems[index];
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCaption = document.getElementById('lightboxCaption');
    
    lightboxImage.src = '<?= UPLOADS_PATH ?>/' + item.file_path;
    lightboxCaption.textContent = item.title || '';
    lightbox.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.style.display = 'none';
    document.body.style.overflow = '';
}

function navigateLightbox(direction) {
    currentIndex += direction;
    if (currentIndex < 0) currentIndex = galleryItems.length - 1;
    if (currentIndex >= galleryItems.length) currentIndex = 0;
    
    const item = galleryItems[currentIndex];
    document.getElementById('lightboxImage').src = '<?= UPLOADS_PATH ?>/' + item.file_path;
    document.getElementById('lightboxCaption').textContent = item.title || '';
}

// Add click handlers to gallery items
document.querySelectorAll('.gallery-item').forEach((item, index) => {
    item.addEventListener('click', () => openLightbox(index));
});

// Close on background click
document.getElementById('lightbox').addEventListener('click', function(e) {
    if (e.target === this) {
        closeLightbox();
    }
});

// Keyboard navigation
document.addEventListener('keydown', function(e) {
    const lightbox = document.getElementById('lightbox');
    if (lightbox.style.display === 'flex') {
        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') navigateLightbox(-1);
        if (e.key === 'ArrowRight') navigateLightbox(1);
    }
});
</script>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
