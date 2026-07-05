<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Partners';
$page_description = 'Our partners and sponsors - NTUPROBUDCAM collaborates with government, transport companies, and organizations';
require_once ROOT_PATH . '/includes/header.php';

// Get partners
$stmt = $pdo->query("SELECT * FROM partners WHERE status = 'active' ORDER BY order_index ASC");
$partners = $stmt->fetchAll();
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Our Partners</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Collaborating with organizations to advance our mission</p>
    </div>
</section>

<!-- Partners Section -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Our Strategic Partners</h2>
            <p class="section-subtitle">Organizations that support and collaborate with NTUPROBUDCAM</p>
        </div>
        
        <?php if (count($partners) > 0): ?>
        <div class="row">
            <?php foreach ($partners as $partner): ?>
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="<?= $partner['id'] * 50 ?>">
                <div class="card" style="padding: 2rem; text-align: center; transition: all 0.3s;">
                    <?php if ($partner['logo']): ?>
                    <img src="<?= UPLOADS_PATH . '/' . $partner['logo'] ?>" alt="<?= htmlspecialchars($partner['name']) ?>" style="max-width: 100%; height: 100px; object-fit: contain; margin: 0 auto 1rem;">
                    <?php else: ?>
                    <div style="width: 100px; height: 100px; background: var(--light-gray); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-building" style="font-size: 2rem; color: var(--medium-gray);"></i>
                    </div>
                    <?php endif; ?>
                    <h5 style="margin-bottom: 0.5rem;"><?= htmlspecialchars($partner['name']) ?></h5>
                    <?php if ($partner['category']): ?>
                    <span class="badge" style="background: var(--light-gray); color: var(--dark-gray); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;"><?= htmlspecialchars($partner['category']) ?></span>
                    <?php endif; ?>
                    <?php if ($partner['website']): ?>
                    <div style="margin-top: 1rem;">
                        <a href="<?= htmlspecialchars($partner['website']) ?>" target="_blank" class="btn btn-outline btn-sm">Visit Website</a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <?php else: ?>
        <div class="text-center" data-aos="fade-up">
            <div style="padding: 3rem;">
                <i class="fas fa-handshake" style="font-size: 4rem; color: var(--light-gray); margin-bottom: 1rem;"></i>
                <h3>Partner Information Coming Soon</h3>
                <p class="text-muted">Our partner information will be displayed here.</p>
            </div>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Partnership Categories -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Partnership Categories</h2>
            <p class="section-subtitle">Types of organizations we collaborate with</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-landmark" style="font-size: 2rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h4>Government</h4>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Ministries and government agencies supporting transport sector development</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: var(--secondary-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-bus" style="font-size: 2rem; color: var(--primary-blue);"></i>
                    </div>
                    <h4>Transport Companies</h4>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Bus companies and transport operators across Cameroon</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: var(--accent-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-globe" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4>International Organizations</h4>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Global organizations and international unions</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: #6366f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-hands-helping" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4>NGOs</h4>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Non-governmental organizations focused on road safety and labor rights</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: #ec4899; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-shield-alt" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4>Insurance Companies</h4>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Insurance providers offering coverage for transport operators</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: #f59e0b; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-university" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4>Banks</h4>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Financial institutions supporting our members and operations</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: #14b8a6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-star" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4>Sponsors</h4>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Corporate sponsors supporting our programs and initiatives</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="700">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: #8b5cf6; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-graduation-cap" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4>Educational Institutions</h4>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Training institutions and academic partners</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Become a Partner -->
<section class="section section-dark">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h2 style="color: white; margin-bottom: 1rem;">Become a Partner</h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin-bottom: 2rem;">Join our network of partners and contribute to advancing professional bus driving in Cameroon</p>
            <a href="contact.php" class="btn btn-secondary btn-lg">Contact Us About Partnership</a>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
