<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Services';
$page_description = 'Explore the services offered by NTUPROBUDCAM to support professional bus drivers in Cameroon';
require_once ROOT_PATH . '/includes/header.php';
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Our Services</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Comprehensive services designed to support and empower professional bus drivers</p>
    </div>
</section>

<!-- Services Grid -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Services Overview</h2>
            <p class="section-subtitle">Discover the range of services we offer to our members and the transport community</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-gavel" style="font-size: 4rem; color: var(--secondary-gold);"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Legal Representation</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Professional legal assistance for work-related disputes, contract reviews, and labor law matters affecting bus drivers.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Free consultation</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Court representation</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Contract review</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, var(--accent-green), var(--accent-green-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-road" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Road Safety Education</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Comprehensive road safety programs, defensive driving training, and awareness campaigns to promote safer roads.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Defensive driving courses</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Safety workshops</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Public campaigns</li>
                        </ul>
                        <a href="road-safety.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, var(--secondary-gold), var(--secondary-gold-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-graduation-cap" style="font-size: 4rem; color: var(--primary-blue);"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Training Programs</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Professional development programs, skills training, and certification support for career advancement.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Skills training</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Certification support</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Career guidance</li>
                        </ul>
                        <a href="training.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-certificate" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Professional Certification Support</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Assistance with obtaining and renewing professional certifications required for bus driving operations.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> License renewal support</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Certification guidance</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Documentation help</li>
                        </ul>
                        <a href="training.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, #ec4899, #f472b6); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-briefcase" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Employment Guidance</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Job placement assistance, career counseling, and employment opportunities within the transport sector.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Job matching</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Career counseling</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Resume building</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, #14b8a6, #2dd4bf); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-comments" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Mediation Services</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Conflict resolution and mediation services to resolve disputes between drivers, employers, and other parties.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Workplace disputes</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Conflict resolution</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Fair mediation</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, #f59e0b, #fbbf24); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-shield-alt" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Insurance Guidance</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Expert guidance on insurance options, policy selection, and claims assistance for comprehensive coverage.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Insurance consultation</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Policy comparison</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Claims assistance</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="700">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, #ef4444, #f87171); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-ambulance" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Emergency Support</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">24/7 emergency assistance for members facing urgent situations, accidents, or critical incidents.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Emergency hotline</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Accident response</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Critical support</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="800">
                <div class="card" style="height: 100%; overflow: hidden;">
                    <div style="height: 200px; background: linear-gradient(135deg, #8b5cf6, #a78bfa); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-heartbeat" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem;">Health Campaigns</h3>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Health awareness campaigns, wellness programs, and medical support for driver health and wellbeing.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Health screenings</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Wellness programs</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Health education</li>
                        </ul>
                        <a href="contact.php" class="btn btn-primary">Learn More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Service Process -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">How to Access Our Services</h2>
            <p class="section-subtitle">Simple steps to access the services you need</p>
        </div>
        
        <div class="row">
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 2rem; text-align: center; height: 100%;">
                    <div style="width: 80px; height: 80px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem; font-weight: 800;">1</div>
                    <h4 style="margin-bottom: 1rem;">Become a Member</h4>
                    <p style="color: var(--dark-gray);">Join NTUPROBUDCAM by completing the membership application process to access our services.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 2rem; text-align: center; height: 100%;">
                    <div style="width: 80px; height: 80px; background: var(--secondary-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: var(--primary-blue); font-size: 2rem; font-weight: 800;">2</div>
                    <h4 style="margin-bottom: 1rem;">Contact Us</h4>
                    <p style="color: var(--dark-gray);">Reach out to our team through phone, email, or visit your local unit to discuss your needs.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 2rem; text-align: center; height: 100%;">
                    <div style="width: 80px; height: 80px; background: var(--accent-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem; font-weight: 800;">3</div>
                    <h4 style="margin-bottom: 1rem;">Consultation</h4>
                    <p style="color: var(--dark-gray);">Receive a consultation with our experts who will assess your situation and recommend appropriate services.</p>
                </div>
            </div>
            
            <div class="col-lg-3 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="padding: 2rem; text-align: center; height: 100%;">
                    <div style="width: 80px; height: 80px; background: #6366f1; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem; color: white; font-size: 2rem; font-weight: 800;">4</div>
                    <h4 style="margin-bottom: 1rem">Service Delivery</h4>
                    <p style="color: var(--dark-gray);">Receive the requested service with ongoing support and follow-up to ensure your satisfaction.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section section-dark">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h2 style="color: white; margin-bottom: 1rem;">Ready to Access Our Services?</h2>
            <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem; margin-bottom: 2rem;">Become a member today and unlock all our premium services</p>
            <a href="membership.php" class="btn btn-secondary btn-lg">Join Now</a>
            <a href="contact.php" class="btn btn-outline btn-lg" style="color: white; border-color: white; margin-left: 1rem;">Contact Us</a>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
