<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Leadership';
$page_description = 'Meet the leadership team of NTUPROBUDCAM - dedicated professionals serving the interests of bus drivers in Cameroon';
require_once ROOT_PATH . '/includes/header.php';
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Our Leadership</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Meet the dedicated team leading NTUPROBUDCAM forward</p>
    </div>
</section>

<!-- Executive Leadership -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Executive Office</h2>
            <p class="section-subtitle">The national leadership team guiding our union</p>
        </div>
        
        <div class="row">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM leadership WHERE status = 'active' ORDER BY order_index ASC");
                $leaders = $stmt->fetchAll();
                
                if (count($leaders) > 0):
                    foreach ($leaders as $leader):
            ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $leader['id'] * 50 ?>">
                <div class="card" style="text-align: center; overflow: visible;">
                    <div style="position: relative; margin-top: -40px; margin-bottom: 20px;">
                        <?php if ($leader['photo']): ?>
                        <img src="<?= UPLOADS_PATH . '/' . $leader['photo'] ?>" alt="<?= htmlspecialchars($leader['full_name']) ?>" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid var(--secondary-gold); box-shadow: var(--shadow-lg);">
                        <?php else: ?>
                        <div style="width: 120px; height: 120px; background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light)); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto; border: 4px solid var(--secondary-gold); box-shadow: var(--shadow-lg);">
                            <i class="fas fa-user" style="font-size: 3rem; color: white;"></i>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="card-body">
                        <span class="badge" style="background: var(--secondary-gold); color: var(--primary-blue); padding: 0.25rem 0.75rem; border-radius: var(--radius-full); font-weight: 600;"><?= htmlspecialchars($leader['position']) ?></span>
                        <?php if ($leader['role']): ?>
                        <p style="color: var(--accent-green); font-weight: 500; margin: 0.5rem 0;"><?= htmlspecialchars($leader['role']) ?></p>
                        <?php endif; ?>
                        <h3 style="margin: 0.5rem 0;"><?= htmlspecialchars($leader['full_name']) ?></h3>
                        <?php if ($leader['biography']): ?>
                        <p style="color: var(--dark-gray); font-size: 0.9rem; margin: 1rem 0;"><?= substr(strip_tags($leader['biography']), 0, 150) ?>...</p>
                        <?php endif; ?>
                        
                        <div class="social-icons justify-center mt-3">
                            <?php if ($leader['email']): ?>
                            <a href="mailto:<?= htmlspecialchars($leader['email']) ?>" class="social-icon" style="width: 35px; height: 35px; font-size: 0.9rem;" aria-label="Email">
                                <i class="fas fa-envelope"></i>
                            </a>
                            <?php endif; ?>
                            <?php if ($leader['phone']): ?>
                            <a href="tel:<?= htmlspecialchars($leader['phone']) ?>" class="social-icon" style="width: 35px; height: 35px; font-size: 0.9rem;" aria-label="Phone">
                                <i class="fas fa-phone"></i>
                            </a>
                            <?php endif; ?>
                            <?php if ($leader['facebook']): ?>
                            <a href="<?= htmlspecialchars($leader['facebook']) ?>" target="_blank" class="social-icon" style="width: 35px; height: 35px; font-size: 0.9rem;" aria-label="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <?php endif; ?>
                            <?php if ($leader['twitter']): ?>
                            <a href="<?= htmlspecialchars($leader['twitter']) ?>" target="_blank" class="social-icon" style="width: 35px; height: 35px; font-size: 0.9rem;" aria-label="Twitter">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <?php endif; ?>
                            <?php if ($leader['linkedin']): ?>
                            <a href="<?= htmlspecialchars($leader['linkedin']) ?>" target="_blank" class="social-icon" style="width: 35px; height: 35px; font-size: 0.9rem;" aria-label="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    endforeach;
                else:
            ?>
            <div class="col-12 text-center">
                <div class="card" style="padding: 3rem;">
                    <i class="fas fa-users" style="font-size: 4rem; color: var(--light-gray); margin-bottom: 1rem;"></i>
                    <p class="text-muted">Leadership profiles will be displayed here.</p>
                </div>
            </div>
            <?php endif; ?>
            <?php
            } catch (PDOException $e) {
                echo '<div class="col-12 text-center"><p class="text-muted">Unable to load leadership profiles at this time.</p></div>';
            }
            ?>
        </div>
    </div>
</section>

<!-- Leadership Roles Description -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Leadership Responsibilities</h2>
            <p class="section-subtitle">Understanding the roles within our organizational structure</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-crown"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">National President</h4>
                    <p style="color: var(--dark-gray);">Provides overall leadership, represents the union nationally and internationally, presides over meetings, and ensures the implementation of union decisions.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-user-tie"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Vice Presidents</h4>
                    <p style="color: var(--dark-gray);">Assist the President, represent the union in their absence, and oversee specific portfolios or regional coordination as assigned.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-file-alt"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Secretary General</h4>
                    <p style="color: var(--dark-gray);">Manages administrative operations, maintains records, handles correspondence, and ensures compliance with union procedures and legal requirements.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-coins"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Treasurer</h4>
                    <p style="color: var(--dark-gray);">Manages union finances, maintains financial records, prepares budgets, ensures proper accounting of funds, and presents financial reports.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Communication Secretary</h4>
                    <p style="color: var(--dark-gray);">Manages internal and external communications, handles media relations, coordinates public relations, and maintains the union's information channels.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Legal Secretary</h4>
                    <p style="color: var(--dark-gray);">Provides legal advice, represents members in legal matters, ensures compliance with labor laws, and coordinates with legal professionals.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Health & Safety Secretary</h4>
                    <p style="color: var(--dark-gray);">Promotes occupational health and safety, coordinates wellness programs, and ensures safe working conditions for all members.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Education Secretary</h4>
                    <p style="color: var(--dark-gray);">Coordinates training programs, educational workshops, and professional development initiatives for union members.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="800">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-sitemap"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Organization Secretary</h4>
                    <p style="color: var(--dark-gray);">Manages organizational structure, coordinates regional sections, oversees membership recruitment, and maintains member records.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Regional Representatives -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Regional Representatives</h2>
            <p class="section-subtitle">Leaders representing NTUPROBUDCAM across Cameroon's regions</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">Adamawa Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="50">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">Centre Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">East Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="150">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">Far North Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">Littoral Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="250">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">North Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">Northwest Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="350">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">West Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">South Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="450">
                <div class="card" style="padding: 1.5rem; text-align: center;">
                    <div style="width: 70px; height: 70px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-map-marker-alt" style="font-size: 1.5rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h5 style="margin-bottom: 0.5rem;">Southwest Region</h5>
                    <p style="color: var(--dark-gray); font-size: 0.9rem;">Regional Coordinator</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Leadership -->
<section class="section section-dark">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h2 style="color: white; margin-bottom: 1rem;">Get in Touch with Leadership</h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin-bottom: 2rem;">Have questions or need to reach our leadership team?</p>
            <a href="contact.php" class="btn btn-secondary btn-lg">Contact Us</a>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
