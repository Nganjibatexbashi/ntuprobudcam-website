<?php
require_once __DIR__ . '/config/config.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Get news item
$stmt = $pdo->prepare("SELECT * FROM news WHERE id = ? AND status = 'published'");
$stmt->execute([$id]);
$news = $stmt->fetch();

if (!$news) {
    header('Location: news.php');
    exit;
}

// Increment views
$pdo->prepare("UPDATE news SET views = views + 1 WHERE id = ?")->execute([$id]);

$page_title = $news['title'];
$page_description = substr(strip_tags($news['content']), 0, 160);
require_once ROOT_PATH . '/includes/header.php';
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;"><?= htmlspecialchars($news['title']) ?></h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">
            <i class="far fa-calendar"></i> <?= date('F d, Y', strtotime($news['created_at'])) ?>
            <span class="mx-2">|</span>
            <i class="far fa-user"></i> <?= htmlspecialchars($news['author']) ?>
            <span class="mx-2">|</span>
            <i class="far fa-eye"></i> <?= $news['views'] ?> views
        </p>
    </div>
</section>

<!-- News Content -->
<section class="section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="card" data-aos="fade-up">
                    <?php if ($news['image']): ?>
                    <img src="<?= UPLOADS_PATH . '/' . $news['image'] ?>" alt="<?= htmlspecialchars($news['title']) ?>" style="width: 100%; height: auto; max-height: 500px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <span class="badge" style="background: var(--accent-green); color: white; padding: 0.25rem 0.5rem; border-radius: 4px;"><?= htmlspecialchars($news['category']) ?></span>
                        <div style="margin-top: 1.5rem; line-height: 1.8; font-size: 1.1rem;">
                            <?= $news['content'] ?>
                        </div>
                        
                        <div style="margin-top: 2rem; padding-top: 2rem; border-top: 1px solid var(--light-gray);">
                            <h5 style="margin-bottom: 1rem;">Share this article</h5>
                            <div class="social-icons">
                                <button onclick="sharePage('facebook')" class="social-icon" aria-label="Share on Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </button>
                                <button onclick="sharePage('twitter')" class="social-icon" aria-label="Share on Twitter">
                                    <i class="fab fa-twitter"></i>
                                </button>
                                <button onclick="sharePage('linkedin')" class="social-icon" aria-label="Share on LinkedIn">
                                    <i class="fab fa-linkedin-in"></i>
                                </button>
                                <button onclick="sharePage('whatsapp')" class="social-icon" aria-label="Share on WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4">
                <div class="card" style="padding: 2rem; margin-bottom: 2rem;" data-aos="fade-left">
                    <h4 style="margin-bottom: 1rem;">Categories</h4>
                    <ul style="list-style: none; padding: 0;">
                        <?php
                        $categories = $pdo->query("SELECT DISTINCT category FROM news WHERE status = 'published' ORDER BY category")->fetchAll(PDO::FETCH_COLUMN);
                        foreach ($categories as $cat):
                        ?>
                        <li style="margin-bottom: 0.5rem;">
                            <a href="news.php?category=<?= urlencode($cat) ?>" style="text-decoration: none; color: var(--dark-gray);">
                                <i class="fas fa-folder text-accent mr-2"></i><?= htmlspecialchars($cat) ?>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                
                <div class="card" style="padding: 2rem;" data-aos="fade-left" data-aos-delay="100">
                    <h4 style="margin-bottom: 1rem;">Recent News</h4>
                    <?php
                    $recent = $pdo->query("SELECT * FROM news WHERE status = 'published' AND id != {$news['id']} ORDER BY created_at DESC LIMIT 5")->fetchAll();
                    foreach ($recent as $item):
                    ?>
                    <div style="margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid var(--light-gray);">
                        <a href="news-detail.php?id=<?= $item['id'] ?>" style="text-decoration: none; color: var(--dark);">
                            <h6 style="margin-bottom: 0.25rem;"><?= htmlspecialchars($item['title']) ?></h6>
                            <small class="text-muted"><?= date('M d, Y', strtotime($item['created_at'])) ?></small>
                        </a>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
