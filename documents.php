<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Documents';
$page_description = 'Download official documents from NTUPROBUDCAM including statutes, regulations, and reports';
require_once ROOT_PATH . '/includes/header.php';

// Pagination
$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$offset = ($page - 1) * 12;

// Search and filter
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$category = isset($_GET['category']) ? trim($_GET['category']) : '';

// Build query
$where = ["1=1"];
$params = [];

if ($search) {
    $where[] = "(title LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if ($category) {
    $where[] = "category = ?";
    $params[] = $category;
}

$whereClause = implode(' AND ', $where);

// Get total count
$countSql = "SELECT COUNT(*) FROM documents WHERE $whereClause";
$countStmt = $pdo->prepare($countSql);
$countStmt->execute($params);
$totalDocs = $countStmt->fetchColumn();
$totalPages = ceil($totalDocs / 12);

// Get documents
$sql = "SELECT * FROM documents WHERE $whereClause ORDER BY created_at DESC LIMIT 12 OFFSET $offset";
$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$documents = $stmt->fetchAll();

// Get categories
$categories = $pdo->query("SELECT DISTINCT category FROM documents ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Documents</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Access official documents, statutes, and resources</p>
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
                            <input type="text" class="form-control" name="search" placeholder="Search documents..." value="<?= htmlspecialchars($search) ?>">
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

<!-- Documents Grid -->
<section class="section">
    <div class="container">
        <?php if (count($documents) > 0): ?>
        <div class="row">
            <?php foreach ($documents as $doc): ?>
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="<?= $doc['id'] * 30 ?>">
                <div class="card" style="height: 100%; text-align: center; padding: 2rem;">
                    <div style="width: 80px; height: 80px; background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light)); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-file-pdf" style="font-size: 2.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;"><?= htmlspecialchars($doc['title']) ?></h5>
                    <?php if ($doc['description']): ?>
                    <p style="color: var(--dark-gray); font-size: 0.9rem; margin-bottom: 1rem;"><?= substr(strip_tags($doc['description']), 0, 80) ?>...</p>
                    <?php endif; ?>
                    <?php if ($doc['category']): ?>
                    <span class="badge" style="background: var(--light-gray); color: var(--dark-gray); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;"><?= htmlspecialchars($doc['category']) ?></span>
                    <?php endif; ?>
                    <div style="margin-top: 1rem;">
                        <small class="text-muted"><i class="fas fa-download"></i> <?= $doc['downloads'] ?> downloads</small>
                    </div>
                    <a href="includes/download.php?id=<?= $doc['id'] ?>" class="btn btn-primary btn-sm mt-2" onclick="incrementDownload(<?= $doc['id'] ?>)">
                        <i class="fas fa-download mr-2"></i>Download
                    </a>
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
                <i class="fas fa-file-alt" style="font-size: 4rem; color: var(--light-gray); margin-bottom: 1rem;"></i>
                <h3>No Documents Found</h3>
                <p class="text-muted">No documents match your search criteria.</p>
                <a href="documents.php" class="btn btn-primary mt-3">View All Documents</a>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Document Categories -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Document Categories</h2>
            <p class="section-subtitle">Browse documents by category</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-gavel" style="font-size: 2.5rem; color: var(--primary-blue); margin-bottom: 1rem;"></i>
                    <h5>Statutes</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Constitution and governing documents</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-book" style="font-size: 2.5rem; color: var(--secondary-gold); margin-bottom: 1rem;"></i>
                    <h5>Regulations</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Internal rules and procedures</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-file-contract" style="font-size: 2.5rem; color: var(--accent-green); margin-bottom: 1rem;"></i>
                    <h5>Forms</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Application and request forms</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-chart-bar" style="font-size: 2.5rem; color: #6366f1; margin-bottom: 1rem;"></i>
                    <h5>Reports</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Annual and activity reports</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-envelope-open-text" style="font-size: 2.5rem; color: #ec4899; margin-bottom: 1rem;"></i>
                    <h5>Communiqués</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Meeting announcements and updates</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-road" style="font-size: 2.5rem; color: #f59e0b; margin-bottom: 1rem;"></i>
                    <h5>Road Safety</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Safety guides and materials</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-graduation-cap" style="font-size: 2.5rem; color: #8b5cf6; margin-bottom: 1rem;"></i>
                    <h5>Training</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Training materials and guides</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="700">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <i class="fas fa-info-circle" style="font-size: 2.5rem; color: #14b8a6; margin-bottom: 1rem;"></i>
                    <h5>General</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Other informational documents</p>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function incrementDownload(docId) {
    // AJAX call to increment download count
    fetch('includes/increment-download.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + docId + '&type=document'
    }).catch(error => console.error('Error:', error));
}
</script>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
