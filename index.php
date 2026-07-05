<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Home';
$page_description = 'National Trade Union of Professional Bus Drivers of Cameroon - United for Professionalism, Dignity and Safer Road Transport';
require_once ROOT_PATH . '/includes/header.php';
?>

<!-- Hero Section -->
<section class="hero" id="hero">
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <h1 class="hero-title">United for Professionalism, Dignity and Safer Road Transport</h1>
        <p class="hero-subtitle">Empowering professional bus drivers across Cameroon through advocacy, training, and collective action</p>
        <div class="hero-buttons">
            <a href="membership.php" class="btn btn-secondary btn-lg">Join Us Today</a>
            <a href="about.php" class="btn btn-outline btn-lg" style="color: white; border-color: white;">Learn More</a>
        </div>
    </div>
</section>

<!-- Statistics Section -->
<section class="stats-section">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-6 stat-item" data-aos="fade-up" data-aos-delay="0">
                <div class="stat-icon">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-number" data-target="5000">0</div>
                <div class="stat-label">Active Members</div>
            </div>
            <div class="col-md-3 col-sm-6 stat-item" data-aos="fade-up" data-aos-delay="100">
                <div class="stat-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>
                <div class="stat-number" data-target="10">0</div>
                <div class="stat-label">Regions Covered</div>
            </div>
            <div class="col-md-3 col-sm-6 stat-item" data-aos="fade-up" data-aos-delay="200">
                <div class="stat-icon">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="stat-number" data-target="150">0</div>
                <div class="stat-label">Training Programs</div>
            </div>
            <div class="col-md-3 col-sm-6 stat-item" data-aos="fade-up" data-aos-delay="300">
                <div class="stat-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <div class="stat-number" data-target="200">0</div>
                <div class="stat-label">Safety Campaigns</div>
            </div>
        </div>
    </div>
</section>

<!-- About Preview Section -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">About NTUPROBUDCAM</h2>
            <p class="section-subtitle">Learn about our mission, vision, and core values</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bullseye"></i>
                    </div>
                    <h3 class="feature-title">Our Mission</h3>
                    <p class="feature-description">To defend and promote the rights, interests, and welfare of professional bus drivers in Cameroon while ensuring road safety and professional excellence.</p>
                    <a href="about.php" class="btn btn-primary mt-3">Read More</a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-eye"></i>
                    </div>
                    <h3 class="feature-title">Our Vision</h3>
                    <p class="feature-description">To be the leading voice for professional bus drivers in Cameroon, recognized nationally and internationally for our commitment to excellence and road safety.</p>
                    <a href="about.php" class="btn btn-primary mt-3">Read More</a>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3 class="feature-title">Core Values</h3>
                    <p class="feature-description">Dignity • Fraternity • Solidarity. We uphold these principles in everything we do, ensuring every member is treated with respect and fairness.</p>
                    <a href="about.php" class="btn btn-primary mt-3">Read More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- What We Do Preview -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">What We Do</h2>
            <p class="section-subtitle">Discover our key activities and services for members</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card feature-card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-balance-scale"></i>
                    </div>
                    <h4 style="font-size: 1.2rem;">Workers' Rights</h4>
                    <p style="font-size: 0.9rem;">Protecting the rights and interests of professional bus drivers</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card feature-card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-road"></i>
                    </div>
                    <h4 style="font-size: 1.2rem;">Road Safety</h4>
                    <p style="font-size: 0.9rem;">Advocating for safer roads and driving practices</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card feature-card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-chalkboard-teacher"></i>
                    </div>
                    <h4 style="font-size: 1.2rem;">Training</h4>
                    <p style="font-size: 0.9rem;">Professional development and skills training programs</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card feature-card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-gavel"></i>
                    </div>
                    <h4 style="font-size: 1.2rem;">Legal Assistance</h4>
                    <p style="font-size: 0.9rem;">Providing legal support and representation</p>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="what-we-do.php" class="btn btn-primary btn-lg">View All Activities</a>
        </div>
    </div>
</section>

<!-- Latest News Section -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Latest News</h2>
            <p class="section-subtitle">Stay updated with our recent activities and announcements</p>
        </div>
        
        <div class="row">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM news WHERE status = 'published' ORDER BY created_at DESC LIMIT 3");
                $news = $stmt->fetchAll();
                
                if (count($news) > 0):
                    foreach ($news as $item):
            ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $item['id'] * 100 ?>">
                <div class="card">
                    <?php if ($item['image']): ?>
                    <img src="<?= UPLOADS_PATH . '/' . $item['image'] ?>" alt="<?= htmlspecialchars($item['title']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <span class="badge" style="background: var(--accent-green); color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;"><?= htmlspecialchars($item['category']) ?></span>
                        <h4 class="card-title mt-2"><?= htmlspecialchars($item['title']) ?></h4>
                        <p class="card-text"><?= substr(strip_tags($item['content']), 0, 120) ?>...</p>
                        <div class="d-flex justify-between align-center mt-3">
                            <small class="text-muted"><i class="far fa-calendar"></i> <?= date('M d, Y', strtotime($item['created_at'])) ?></small>
                            <a href="news.php" class="btn btn-primary btn-sm">_read More</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                    endforeach;
                else:
            ?>
            <div class="col-12 text-center">
                <p class="text-muted">No news articles available at the moment.</p>
            </div>
            <?php endif; ?>
            <?php
            } catch (PDOException $e) {
                echo '<div class="col-12 text-center"><p class="text-muted">Unable to load news at this time.</p></div>';
            }
            ?>
        </div>
        
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="news.php" class="btn btn-primary btn-lg">View All News</a>
        </div>
    </div>
</section>

<!-- Upcoming Events Section -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Upcoming Events</h2>
            <p class="section-subtitle">Join us at our upcoming activities and programs</p>
        </div>
        
        <div class="row">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM events WHERE status = 'upcoming' AND event_date >= CURDATE() ORDER BY event_date ASC LIMIT 3");
                $events = $stmt->fetchAll();
                
                if (count($events) > 0):
                    foreach ($events as $event):
            ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $event['id'] * 100 ?>">
                <div class="card">
                    <?php if ($event['image']): ?>
                    <img src="<?= UPLOADS_PATH . '/' . $event['image'] ?>" alt="<?= htmlspecialchars($event['title']) ?>" class="card-img-top" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="d-flex align-center gap-2 mb-2">
                            <span class="badge" style="background: var(--secondary-gold); color: var(--primary-blue); padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">
                                <i class="far fa-calendar"></i> <?= date('M d, Y', strtotime($event['event_date'])) ?>
                            </span>
                            <?php if ($event['event_time']): ?>
                            <span class="badge" style="background: var(--primary-blue); color: white; padding: 0.25rem 0.5rem; border-radius: 4px; font-size: 0.8rem;">
                                <i class="far fa-clock"></i> <?= date('H:i', strtotime($event['event_time'])) ?>
                            </span>
                            <?php endif; ?>
                        </div>
                        <h4 class="card-title"><?= htmlspecialchars($event['title']) ?></h4>
                        <p class="card-text"><?= substr(strip_tags($event['description']), 0, 100) ?>...</p>
                        <?php if ($event['location']): ?>
                        <p class="text-muted"><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($event['location']) ?></p>
                        <?php endif; ?>
                        <a href="events.php" class="btn btn-primary btn-sm mt-2">View Details</a>
                    </div>
                </div>
            </div>
            <?php 
                    endforeach;
                else:
            ?>
            <div class="col-12 text-center">
                <p class="text-muted">No upcoming events scheduled at the moment.</p>
            </div>
            <?php endif; ?>
            <?php
            } catch (PDOException $e) {
                echo '<div class="col-12 text-center"><p class="text-muted">Unable to load events at this time.</p></div>';
            }
            ?>
        </div>
        
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="events.php" class="btn btn-primary btn-lg">View All Events</a>
        </div>
    </div>
</section>

<!-- Gallery Preview Section -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Photo Gallery</h2>
            <p class="section-subtitle">Glimpses of our activities and events</p>
        </div>
        
        <div class="row">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM gallery WHERE file_type = 'image' AND featured = 1 ORDER BY created_at DESC LIMIT 6");
                $gallery = $stmt->fetchAll();
                
                if (count($gallery) > 0):
                    foreach ($gallery as $item):
            ?>
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="<?= $item['id'] * 50 ?>">
                <div class="card gallery-item" style="cursor: pointer;">
                    <img src="<?= UPLOADS_PATH . '/' . $item['file_path'] ?>" alt="<?= htmlspecialchars($item['title'] ?? 'Gallery Image') ?>" class="card-img-top" style="height: 250px; object-fit: cover;">
                    <?php if ($item['title']): ?>
                    <div class="card-body" style="padding: 1rem;">
                        <h5 style="margin: 0; font-size: 1rem;"><?= htmlspecialchars($item['title']) ?></h5>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
            <?php 
                    endforeach;
                else:
            ?>
            <div class="col-12 text-center">
                <p class="text-muted">No gallery images available at the moment.</p>
            </div>
            <?php endif; ?>
            <?php
            } catch (PDOException $e) {
                echo '<div class="col-12 text-center"><p class="text-muted">Unable to load gallery at this time.</p></div>';
            }
            ?>
        </div>
        
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="gallery.php" class="btn btn-primary btn-lg">View Full Gallery</a>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">What Our Members Say</h2>
            <p class="section-subtitle">Testimonials from our valued members</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card card-glass" style="padding: 2rem; color: white;">
                    <div class="d-flex align-center gap-2 mb-3">
                        <div style="width: 60px; height: 60px; background: var(--secondary-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary-blue);">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h5 style="margin: 0; color: var(--secondary-gold);">Jean-Pierre M.</h5>
                            <small style="color: rgba(255,255,255,0.8);">Member since 2019</small>
                        </div>
                    </div>
                    <p style="font-style: italic;">"NTUPROBUDCAM has transformed my career. The training programs and legal support have been invaluable. I feel protected and empowered."</p>
                    <div style="color: var(--secondary-gold);">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-glass" style="padding: 2rem; color: white;">
                    <div class="d-flex align-center gap-2 mb-3">
                        <div style="width: 60px; height: 60px; background: var(--secondary-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary-blue);">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h5 style="margin: 0; color: var(--secondary-gold);">Marie-Claire N.</h5>
                            <small style="color: rgba(255,255,255,0.8);">Member since 2020</small>
                        </div>
                    </div>
                    <p style="font-style: italic;">"Being part of this union has given me a voice. The solidarity among members is remarkable, and the advocacy work is making a real difference."</p>
                    <div style="color: var(--secondary-gold);">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-glass" style="padding: 2rem; color: white;">
                    <div class="d-flex align-center gap-2 mb-3">
                        <div style="width: 60px; height: 60px; background: var(--secondary-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.5rem; color: var(--primary-blue);">
                            <i class="fas fa-user"></i>
                        </div>
                        <div>
                            <h5 style="margin: 0; color: var(--secondary-gold);">Emmanuel K.</h5>
                            <small style="color: rgba(255,255,255,0.8);">Member since 2018</small>
                        </div>
                    </div>
                    <p style="font-style: italic;">"The road safety campaigns organized by NTUPROBUDCAM have helped me become a better, safer driver. I'm proud to be a member of this organization."</p>
                    <div style="color: var(--secondary-gold);">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Partners Section -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Our Partners</h2>
            <p class="section-subtitle">Collaborating with organizations for better transport services</p>
        </div>
        
        <div class="row">
            <?php
            try {
                $stmt = $pdo->query("SELECT * FROM partners WHERE status = 'active' ORDER BY order_index ASC LIMIT 8");
                $partners = $stmt->fetchAll();
                
                if (count($partners) > 0):
                    foreach ($partners as $partner):
            ?>
            <div class="col-lg-3 col-md-4 col-sm-6" data-aos="fade-up" data-aos-delay="<?= $partner['id'] * 50 ?>">
                <div class="card" style="padding: 2rem; text-align: center; transition: all 0.3s;">
                    <?php if ($partner['logo']): ?>
                    <img src="<?= UPLOADS_PATH . '/' . $partner['logo'] ?>" alt="<?= htmlspecialchars($partner['name']) ?>" style="max-width: 100%; height: 80px; object-fit: contain; margin: 0 auto;">
                    <?php else: ?>
                    <div style="width: 100px; height: 80px; background: var(--light-gray); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; margin: 0 auto;">
                        <i class="fas fa-building" style="font-size: 2rem; color: var(--medium-gray);"></i>
                    </div>
                    <?php endif; ?>
                    <h5 style="margin-top: 1rem;"><?= htmlspecialchars($partner['name']) ?></h5>
                </div>
            </div>
            <?php 
                    endforeach;
                else:
            ?>
            <div class="col-12 text-center">
                <p class="text-muted">Partner information will be displayed here.</p>
            </div>
            <?php endif; ?>
            <?php
            } catch (PDOException $e) {
                echo '<div class="col-12 text-center"><p class="text-muted">Unable to load partners at this time.</p></div>';
            }
            ?>
        </div>
        
        <div class="text-center mt-4" data-aos="fade-up">
            <a href="partners.php" class="btn btn-primary btn-lg">View All Partners</a>
        </div>
    </div>
</section>

<!-- Call to Action Section -->
<section class="section section-dark" style="background: linear-gradient(135deg, var(--accent-green), var(--accent-green-dark));">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h2 style="color: white; margin-bottom: 1rem;">Ready to Join Our Community?</h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin-bottom: 2rem;">Become a member of NTUPROBUDCAM and be part of the movement for professional excellence and road safety in Cameroon.</p>
            <div class="d-flex justify-center gap-3">
                <a href="membership.php" class="btn btn-secondary btn-lg">Join Now</a>
                <a href="contact.php" class="btn btn-outline btn-lg" style="color: white; border-color: white;">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
