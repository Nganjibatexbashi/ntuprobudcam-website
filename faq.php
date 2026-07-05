<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'FAQ';
$page_description = 'Frequently Asked Questions about NTUPROBUDCAM - membership, benefits, services, and more';
require_once ROOT_PATH . '/includes/header.php';
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Frequently Asked Questions</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Find answers to common questions about NTUPROBUDCAM</p>
    </div>
</section>

<!-- FAQ Section -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Common Questions</h2>
            <p class="section-subtitle">Get answers to frequently asked questions about membership, benefits, and services</p>
        </div>
        
        <div class="row">
            <div class="col-lg-8" data-aos="fade-up">
                <!-- Membership Questions -->
                <h3 style="margin-bottom: 1.5rem; color: var(--primary-blue);">Membership</h3>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">Who can become a member of NTUPROBUDCAM?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Any professional bus driver with a valid driving license who is at least 18 years old and resident of Cameroon can become a member. You must be committed to professional ethics and agree to abide by the union's constitution and regulations.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">What are the membership fees?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Active membership is 10,000 FCFA per year. Associate membership is 5,000 FCFA per year. Honorary membership is free and by invitation only. Fees are subject to review by the National Council.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">How do I apply for membership?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">You can apply for membership by filling out the online application form on our website. You will need to provide personal information, driving license details, and upload required documents. Your application will be reviewed, and you will be notified of the decision within 5-7 business days.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">What are the benefits of membership?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Members enjoy legal assistance, free training programs, access to welfare support, networking opportunities, voting rights, and representation in policy discussions. Members also receive discounts on various services and access to exclusive events.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Benefits Questions -->
                <h3 style="margin: 2rem 0 1.5rem; color: var(--primary-blue);">Benefits & Services</h3>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">What legal assistance does the union provide?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">We provide free legal consultation, representation in work-related disputes, contract review assistance, and labor law education. Our legal team assists members facing employment issues, accidents, or other legal matters related to their work as bus drivers.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">Are training programs free for members?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Yes, most training programs are free for active members. Associate members receive discounted rates on training programs. We offer various courses including defensive driving, customer service, vehicle maintenance, first aid, and leadership development.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">How does the union help with employment?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">We provide job placement assistance, career counseling, resume building support, and connect members with employment opportunities within the transport sector. We also negotiate better working conditions with employers on behalf of our members.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Rights & Responsibilities -->
                <h3 style="margin: 2rem 0 1.5rem; color: var(--primary-blue);">Rights & Responsibilities</h3>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">What are my rights as a member?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">As a member, you have the right to vote in union elections, be elected to leadership positions, participate in union activities, access union services and benefits, receive legal representation, and be treated fairly without discrimination.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">What are my responsibilities as a member?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Members are responsible for paying annual membership dues on time, abiding by the union's constitution and regulations, participating in union activities, upholding professional ethics, promoting road safety, supporting fellow members, and maintaining accurate personal information with the union.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Leadership & Organization -->
                <h3 style="margin: 2rem 0 1.5rem; color: var(--primary-blue);">Leadership & Organization</h3>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">How is the union leadership elected?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Leadership positions are elected during the National Congress, which convenes every four years. All active members have voting rights. Delegates from each regional section participate in the election process, ensuring proportional representation.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">How can I get involved in union leadership?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Active members can nominate themselves or be nominated for leadership positions. We encourage members to start by participating in local unit activities, attending regional meetings, and taking on volunteer roles before seeking leadership positions.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Complaints & Issues -->
                <h3 style="margin: 2rem 0 1.5rem; color: var(--primary-blue);">Complaints & Issues</h3>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">How do I file a complaint?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Complaints can be filed through your local unit, regional section, or directly at the national office. We have established procedures to handle complaints fairly and confidentially. All complaints are investigated, and members are informed of the outcome.</p>
                        </div>
                    </div>
                </div>
                
                <div class="accordion-item" style="margin-bottom: 1rem;">
                    <div class="card">
                        <div class="accordion-header" style="padding: 1.5rem; cursor: pointer; display: flex; justify-content: space-between; align-items: center;">
                            <h5 style="margin: 0;">What if I have a dispute with my employer?</h5>
                            <i class="fas fa-chevron-down"></i>
                        </div>
                        <div class="accordion-content" style="padding: 0 1.5rem 1.5rem; display: none;">
                            <p style="color: var(--dark-gray);">Contact your local unit or regional representative immediately. We provide mediation services to resolve disputes between members and employers. If necessary, we provide legal representation to protect your rights and interests.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4" data-aos="fade-left">
                <div class="card" style="padding: 2rem; position: sticky; top: 100px;">
                    <h4 style="margin-bottom: 1.5rem;">Still Have Questions?</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 1.5rem;">Can't find the answer you're looking for? Contact us directly and we'll be happy to help.</p>
                    
                    <div style="margin-bottom: 1.5rem;">
                        <h5 style="margin-bottom: 0.5rem;">Contact Information</h5>
                        <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-phone text-accent mr-2"></i><?= SITE_PHONE ?></p>
                        <p style="color: var(--dark-gray); margin-bottom: 0.5rem;"><i class="fas fa-envelope text-accent mr-2"></i><?= SITE_EMAIL ?></p>
                        <p style="color: var(--dark-gray);"><i class="fas fa-map-marker-alt text-accent mr-2"></i><?= SITE_ADDRESS ?></p>
                    </div>
                    
                    <a href="contact.php" class="btn btn-primary btn-block">Contact Us</a>
                    
                    <div style="margin-top: 2rem;">
                        <h5 style="margin-bottom: 1rem;">Quick Links</h5>
                        <ul style="list-style: none; padding: 0;">
                            <li style="margin-bottom: 0.5rem;"><a href="membership.php" style="color: var(--primary-blue);">Membership Information</a></li>
                            <li style="margin-bottom: 0.5rem;"><a href="services.php" style="color: var(--primary-blue);">Our Services</a></li>
                            <li style="margin-bottom: 0.5rem;"><a href="documents.php" style="color: var(--primary-blue);">Documents & Resources</a></li>
                            <li><a href="contact.php" style="color: var(--primary-blue);">Get in Touch</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.querySelectorAll('.accordion-header').forEach(header => {
    header.addEventListener('click', function() {
        const item = this.closest('.accordion-item');
        const content = item.querySelector('.accordion-content');
        const icon = this.querySelector('i');
        
        // Close all other items
        document.querySelectorAll('.accordion-item').forEach(otherItem => {
            if (otherItem !== item) {
                otherItem.querySelector('.accordion-content').style.display = 'none';
                otherItem.querySelector('.accordion-header i').classList.remove('fa-chevron-up');
                otherItem.querySelector('.accordion-header i').classList.add('fa-chevron-down');
            }
        });
        
        // Toggle current item
        if (content.style.display === 'none' || !content.style.display) {
            content.style.display = 'block';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            content.style.display = 'none';
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    });
});
</script>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
