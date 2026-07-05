<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Page Not Found';
$page_description = 'The page you are looking for does not exist';
require_once ROOT_PATH . '/includes/header.php';
?>

<!-- 404 Page -->
<section class="section section-dark" style="padding: 120px 0 60px; min-height: 60vh; display: flex; align-items: center;">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h1 style="font-size: 8rem; color: var(--secondary-gold); margin: 0;">404</h1>
            <h2 style="color: white; margin-bottom: 1rem;">Page Not Found</h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin-bottom: 2rem;">The page you are looking for does not exist or has been moved.</p>
            <div class="d-flex justify-center gap-3">
                <a href="index.php" class="btn btn-secondary btn-lg">Go Home</a>
                <a href="contact.php" class="btn btn-outline btn-lg" style="color: white; border-color: white;">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
