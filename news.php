<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'News';
$page_description = 'Latest news and updates from NTUPROBUDCAM - National Trade Union of Professional Bus Drivers of Cameroon';
require_once ROOT_PATH . '/includes/header.php';

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * NEWS_PER_PAGE;

// Search and filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

// Build query
$where = ["status = 'published'"];
$params = [];

if ($search) {
    $where[] = "(title LIKE ? OR content LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category) {
    $where[] = "category = ?";
    $params[] = $category;
}

$whereClause = implode(' AND ', $where);

// Get total count
$countSql = "SELECT COUNT(*) FROM news WHERE $whereClause";
$countStmt = $pdo->prepare($countSql);
$countStmt->execute($params);
$totalNews = $countStmt->fetchColumn();
$totalPages = ceil($totalNews / NEWS_PER_PAGE);

// Get news items
$sql = "SELECT * FROM news WHERE $whereClause ORDER BY created_at DESC LIMIT " . NEWS_PER_PAGE . " OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$newsItems = $stmt->fetchAll();

// Get categories
$categories = $pdo->query("SELECT DISTINCT category FROM news WHERE status = 'published' ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">News & Updates</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Stay informed with the latest news from NTUPROBUDCAM</p>
    </div>
</section>

<!-- Search and Filter -->
<section class="section section-light">
    <div class="container">
        <div class="card" style="padding: 2rem;" data-aos="fade-up">
            <form method="GET" action="">
                <div class="row align-center">
                    <div class="col-md-5">
                        <div class="form-group">
                            <input type="text" class="form-control" name="search" placeholder="Search news..." value="<?= htmlspecialchars($search) ?>">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <select class="form-control form-select" name="category">
                                <option value="">All Categories</option>
                                <?php foreach ($categories as $cat): ?>
                                <option value="<?= htmlspecialchars($cat) ?>" <?= $category === $cat ? 'selected' : '' ?>><?= htmlspecialchars($cat) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary btn-block">Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>

<!-- News Grid -->
<section class="section">
    <div class="container">
        <?php if (count($newsItems) > 0): ?>
        <div class="row">
            <?php foreach ($newsItems as $item): ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $item['id'] * 50 ?>">
                <div class="card" style="height: 100%;">
                    <?php if ($item['image']): ?>
                    <img src="<?= UPLOADS_PATH . '/' . $item['image'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <?php else: ?>
                    <div style="height: 200px; background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-newspaper" style="font-size: 3rem; color: var(--secondary-gold);"></i>
                    </div>
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="d-flex justify-between align-center mb-2">
                            <span class="badge" style="background: var(--accent-green); color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;"><?= htmlspecialchars($item['category']) ?></span>
                            <small class="text-muted"><i class="far fa-calendar"></i> <?= date('M d, Y', strtotime($item['created_at'])) ?></small>
                        </div>
                        <h4 class="card-title"><?= htmlspecialchars($item['title']) ?></h4>
                        <p class="card-text"><?= substr(strip_tags($item['content']), 0, 150) ?>...</p>
                        <div class="d-flex justify-between align-center mt-3">
                            <small class="text-muted"><i class="far fa-user"></i> <?= htmlspecialchars($item['author']) ?></small>
                            <small class="text-muted"><i class="far fa-eye"></i> <?= $item['views'] ?> views</small>
                        </div>
                        <a href="news-detail.php?id=<?= $item['id'] ?>" class="btn btn-primary btn-sm mt-2">Read More</a>
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
                    <li><a href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;">Previous</a></li>
                    <?php endif; ?>
                    
                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                    <?php if ($i == $page): ?>
                    <li><span class="btn btn-primary" style="padding: 0.5rem 1rem;"><?= $i ?></span></li>
                    <?php else: ?>
                    <li><a href="?page=<?= $i ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;"><?= $i ?></a></li>
                    <?php endif; ?>
                    <?php endfor; ?>
                    
                    <?php if ($page < $totalPages): ?>
                    <li><a href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>&category=<?= urlencode($category) ?>" class="btn btn-outline" style="padding: 0.5rem 1rem;">Next</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
        
        <?php else: ?>
        <div class="text-center" data-aos="fade-up">
            <div style="padding: 3rem;">
                <i class="fas fa-newspaper" style="font-size: 4rem; color: var(--light-gray); margin-bottom: 1rem;"></i>
                <h3>No News Found</h3>
                <p class="text-muted">No news articles match your search criteria.</p>
                <a href="news.php" class="btn btn-primary mt-3">View All News</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Newsletter Section -->
<section class="section section-dark">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h2 style="color: white; margin-bottom: 1rem;">Subscribe to Our Newsletter</h2>
            <p style="color: rgba(255,255,255,0.9); margin-bottom: 2rem;">Get the latest news and updates delivered to your inbox</p>
            <form class="newsletter-form" style="max-width: 500px; margin: 0 auto;" id="newsPageNewsletter">
                <div class="d-flex gap-2">
                    <input type="email" class="form-control" placeholder="Your email address" required id="newsletterEmailNews">
                    <button type="submit" class="btn btn-secondary">Subscribe</button>
                </div>
            </form>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
