    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4 col-sm-6 footer-section">
                    <h4 class="footer-title">About NTUPROBUDCAM</h4>
                    <p><?= SITE_FULL_NAME ?> is dedicated to promoting professionalism, dignity, and safety in road transport across Cameroon.</p>
                    <div class="social-icons mt-3">
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
                
                <div class="col-md-2 col-sm-6 footer-section">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="index.php">Home</a></li>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="membership.php">Membership</a></li>
                        <li><a href="services.php">Services</a></li>
                        <li><a href="news.php">News</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 col-sm-6 footer-section">
                    <h4 class="footer-title">Resources</h4>
                    <ul class="footer-links">
                        <li><a href="documents.php">Documents</a></li>
                        <li><a href="road-safety.php">Road Safety</a></li>
                        <li><a href="training.php">Training</a></li>
                        <li><a href="events.php">Events</a></li>
                        <li><a href="gallery.php">Gallery</a></li>
                        <li><a href="faq.php">FAQ</a></li>
                    </ul>
                </div>
                
                <div class="col-md-3 col-sm-6 footer-section">
                    <h4 class="footer-title">Newsletter</h4>
                    <p>Subscribe to our newsletter for updates and news.</p>
                    <form class="newsletter-form" id="newsletterForm">
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your email" required id="newsletterEmail">
                        </div>
                        <button type="submit" class="btn btn-secondary btn-block">Subscribe</button>
                    </form>
                    
                    <h4 class="footer-title mt-4">Contact Us</h4>
                    <ul class="footer-links">
                        <li><i class="fas fa-map-marker-alt mr-2"></i> <?= SITE_ADDRESS ?></li>
                        <li><i class="fas fa-phone mr-2"></i> <?= SITE_PHONE ?></li>
                        <li><i class="fas fa-envelope mr-2"></i> <?= SITE_EMAIL ?></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row align-center justify-between">
                    <div class="col-md-6">
                        <p>&copy; <?= date('Y') ?> <?= SITE_NAME ?>. All rights reserved.</p>
                    </div>
                    <div class="col-md-6 text-right">
                        <a href="privacy-policy.php" class="text-muted">Privacy Policy</a>
                        <span class="mx-2">|</span>
                        <a href="terms.php" class="text-muted">Terms of Service</a>
                        <span class="mx-2">|</span>
                        <a href="sitemap.php" class="text-muted">Sitemap</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    
    <!-- Back to Top Button -->
    <button class="back-to-top" id="backToTop" aria-label="Back to top">
        <i class="fas fa-arrow-up"></i>
    </button>
    
    <!-- Dark Mode Toggle -->
    <button class="theme-toggle" id="themeToggle" aria-label="Toggle dark mode">
        <i class="fas fa-moon"></i>
    </button>
    
    <!-- WhatsApp Floating Button -->
    <a href="https://wa.me/237123456789" class="whatsapp-float" target="_blank" aria-label="WhatsApp">
        <i class="fab fa-whatsapp"></i>
    </a>
    
    <!-- JavaScript -->
    <script src="<?= ASSETS_PATH ?>/js/main.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true,
            offset: 100
        });
    </script>
</body>
</html>
