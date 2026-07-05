<?php
require_once __DIR__ . '/config/config.php';
require_once ROOT_PATH . '/includes/mailer.php';

$page_title = 'Contact Us';
$page_description = 'Contact NTUPROBUDCAM - Get in touch with our team for inquiries, support, or partnership opportunities';
require_once ROOT_PATH . '/includes/header.php';

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $success = false;
    $error = '';
    
    try {
        // Validate CSRF token
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION[CSRF_TOKEN]) {
            throw new Exception('Invalid request. Please try again.');
        }
        
        // Prepare SQL statement
        $sql = "INSERT INTO contact_messages (
            full_name, email, phone, subject, message, ip_address, status, created_at
        ) VALUES (
            :full_name, :email, :phone, :subject, :message, :ip_address, 'new', NOW()
        )";
        
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->execute([
            ':full_name' => trim($_POST['full_name']),
            ':email' => trim($_POST['email']),
            ':phone' => trim($_POST['phone'] ?? ''),
            ':subject' => trim($_POST['subject'] ?? ''),
            ':message' => trim($_POST['message']),
            ':ip_address' => $_SERVER['REMOTE_ADDR'] ?? ''
        ]);
        
        $success = true;
        
        // Send confirmation email to user
        $subject = 'Message Received - NTUPROBUDCAM';
        $message = "
        <html>
        <head>
        <title>Message Received</title>
        </head>
        <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
        <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
        <h2 style='color: #003366;'>Message Received</h2>
        <p>Dear " . htmlspecialchars($_POST['full_name']) . ",</p>
        <p>Thank you for contacting NTUPROBUDCAM. We have received your message and will get back to you as soon as possible.</p>
        <p><strong>Your Message:</strong></p>
        <p style='background: #f5f5f5; padding: 15px; border-left: 4px solid #003366;'>" . htmlspecialchars($_POST['message']) . "</p>
        <p>If you need immediate assistance, please call us at +237 123 456 789.</p>
        <p>Best regards,<br>NTUPROBUDCAM Team<br>National Trade Union of Professional Bus Drivers of Cameroon</p>
        </div>
        </body>
        </html>
        ";
        
        sendEmail($_POST['email'], $subject, $message);
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Contact Us</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Get in touch with NTUPROBUDCAM</p>
    </div>
</section>

<?php if (isset($success) && $success): ?>
<!-- Success Message -->
<section class="section">
    <div class="container">
        <div class="card" style="padding: 3rem; text-align: center; max-width: 600px; margin: 0 auto;">
            <div style="width: 100px; height: 100px; background: var(--accent-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fas fa-check" style="font-size: 3rem; color: white;"></i>
            </div>
            <h2 style="color: var(--accent-green);">Message Sent Successfully!</h2>
            <p style="color: var(--dark-gray); margin-bottom: 1.5rem;">Thank you for contacting us. We have received your message and will respond within 24-48 hours.</p>
            <a href="index.php" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
</section>
<?php else: ?>

<!-- Contact Section -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Get In Touch</h2>
            <p class="section-subtitle">We'd love to hear from you. Send us a message and we'll respond as soon as possible.</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right">
                <?php if (isset($error)): ?>
                <div class="card" style="padding: 1rem; margin-bottom: 2rem; background: #fee; border-left: 4px solid #c00;">
                    <p style="color: #c00; margin: 0;"><i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($error) ?></p>
                </div>
                <?php endif; ?>
                
                <div class="card" style="padding: 2rem;">
                    <h3 style="margin-bottom: 1.5rem;">Send us a Message</h3>
                    <form method="POST" id="contactForm" data-validate>
                        <input type="hidden" name="csrf_token" value="<?= $_SESSION[CSRF_TOKEN] ?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="full_name">Full Name *</label>
                                    <input type="text" class="form-control" id="full_name" name="full_name" required>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="email">Email *</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="phone">Phone</label>
                                    <input type="tel" class="form-control" id="phone" name="phone">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label" for="subject">Subject</label>
                                    <input type="text" class="form-control" id="subject" name="subject">
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label" for="message">Message *</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary btn-lg">Send Message</button>
                    </form>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                    <h3 style="margin-bottom: 1.5rem;">Contact Information</h3>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <div class="d-flex align-center gap-3">
                            <div style="width: 50px; height: 50px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-map-marker-alt" style="color: var(--secondary-gold);"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0;">Address</h5>
                                <p style="color: var(--dark-gray); margin: 0;"><?= SITE_ADDRESS ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <div class="d-flex align-center gap-3">
                            <div style="width: 50px; height: 50px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-phone" style="color: var(--secondary-gold);"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0;">Phone</h5>
                                <p style="color: var(--dark-gray); margin: 0;"><?= SITE_PHONE ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <div class="d-flex align-center gap-3">
                            <div style="width: 50px; height: 50px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-envelope" style="color: var(--secondary-gold);"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0;">Email</h5>
                                <p style="color: var(--dark-gray); margin: 0;"><?= SITE_EMAIL ?></p>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <div class="d-flex align-center gap-3">
                            <div style="width: 50px; height: 50px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-clock" style="color: var(--secondary-gold);"></i>
                            </div>
                            <div>
                                <h5 style="margin: 0;">Working Hours</h5>
                                <p style="color: var(--dark-gray); margin: 0;">Monday - Friday: 8:00 AM - 5:00 PM</p>
                                <p style="color: var(--dark-gray); margin: 0;">Saturday: 9:00 AM - 1:00 PM</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="card" style="padding: 2rem;">
                    <h3 style="margin-bottom: 1.5rem;">Follow Us</h3>
                    <p style="color: var(--dark-gray); margin-bottom: 1.5rem;">Stay connected with us on social media for updates and news.</p>
                    <div class="social-icons">
                        <a href="#" class="social-icon" aria-label="Facebook">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="Twitter">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="LinkedIn">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="Instagram">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-icon" aria-label="YouTube">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Find Us</h2>
            <p class="section-subtitle">Visit our office or find us on the map</p>
        </div>
        
        <div class="card" style="padding: 0; overflow: hidden;" data-aos="fade-up">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.123456789!2d11.502123!3d3.856789!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zM8PCw0NTAnMDAuMCJFIDExJzMwJzA3LjYiVDM4JzUxJzI0LjQiXw5NTk4!5e0!4m15!1s0x0%3A0x0!2zM8PCw0NTAnMDAuMCJFIDExJzMwJzA3LjYiVDM4JzUxJzI0LjQiXw5NTk4!5e0!4m5!1s0x108fbe6e6e6e6e6%3A0x6e6e6e6e6e6e6e!2sYaound%C3%A9%2C+Cameroon!5e0!3m2!1sen!2scm!4v1631234567890!5m2!1sen!2scm" 
                width="100%" 
                height="450" 
                style="border:0;" 
                allowfullscreen="" 
                loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
        </div>
    </div>
</section>

<!-- Regional Offices -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Regional Offices</h2>
            <p class="section-subtitle">Contact our regional offices across Cameroon</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1rem;">Centre Region</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt text-accent mr-2"></i>Yaoundé</p>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-phone text-accent mr-2"></i>+237 123 456 789</p>
                    <p style="color: var(--dark-gray);"><i class="fas fa-envelope text-accent mr-2"></i>centre@tuprobudcam.org</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1rem;">Littoral Region</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt text-accent mr-2"></i>Douala</p>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-phone text-accent mr-2"></i>+237 234 567 890</p>
                    <p style="color: var(--dark-gray);"><i class="fas fa-envelope text-accent mr-2"></i>littoral@tuprobudcam.org</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1rem;">Northwest Region</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt text-accent mr-2"></i>Bamenda</p>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-phone text-accent mr-2"></i>+237 345 678 901</p>
                    <p style="color: var(--dark-gray);"><i class="fas fa-envelope text-accent mr-2"></i>northwest@tuprobudcam.org</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1rem;">Southwest Region</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt text-accent mr-2"></i>Buea</p>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-phone text-accent mr-2"></i>+237 456 789 012</p>
                    <p style="color: var(--dark-gray);"><i class="fas fa-envelope text-accent mr-2"></i>southwest@tuprobudcam.org</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1rem;">West Region</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt text-accent mr-2"></i>Bafoussam</p>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-phone text-accent mr-2"></i>+237 567 890 123</p>
                    <p style="color: var(--dark-gray);"><i class="fas fa-envelope text-accent mr-2"></i>west@tuprobudcam.org</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1rem;">Adamawa Region</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-map-marker-alt text-accent mr-2"></i>Ngaoundéré</p>
                    <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-phone text-accent mr-2"></i>+237 678 901 234</p>
                    <p style="color: var(--dark-gray);"><i class="fas fa-envelope text-accent mr-2"></i>adamawa@tuprobudcam.org</p>
                </div>
            </div>
        </div>
    </div>
</section>

<?php endif; ?>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
