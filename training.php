<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Training';
$page_description = 'Training programs, seminars, and workshops from NTUPROBUDCAM for professional development of bus drivers';
require_once ROOT_PATH . '/includes/header.php';

$success = $_SESSION['training_success'] ?? false;
$error = $_SESSION['training_error'] ?? '';
unset($_SESSION['training_success']);
unset($_SESSION['training_error']);
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Training Programs</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Professional development and skills enhancement for bus drivers</p>
    </div>
</section>

<?php if ($success): ?>
<!-- Success Message -->
<section class="section">
    <div class="container">
        <div class="card" style="padding: 3rem; text-align: center; max-width: 600px; margin: 0 auto;">
            <div style="width: 100px; height: 100px; background: var(--accent-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fas fa-check" style="font-size: 3rem; color: white;"></i>
            </div>
            <h2 style="color: var(--accent-green);">Registration Successful!</h2>
            <p style="color: var(--dark-gray); margin-bottom: 2rem;">Thank you for registering for the training program. We will contact you with further details.</p>
            <button onclick="closeMessage()" class="btn btn-primary">Continue</button>
        </div>
    </div>
</section>
<?php elseif ($error): ?>
<!-- Error Message -->
<section class="section">
    <div class="container">
        <div class="card" style="padding: 3rem; text-align: center; max-width: 600px; margin: 0 auto;">
            <div style="width: 100px; height: 100px; background: #fee; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1.5rem;">
                <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #c00;"></i>
            </div>
            <h2 style="color: #c00;">Registration Failed</h2>
            <p style="color: var(--dark-gray); margin-bottom: 2rem;"><?= htmlspecialchars($error) ?></p>
            <button onclick="closeMessage()" class="btn btn-primary">Try Again</button>
        </div>
    </div>
</section>
<?php endif; ?>

<!-- Training Programs -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Our Training Programs</h2>
            <p class="section-subtitle">Comprehensive training designed to enhance your professional skills</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="height: 100%;">
                    <div style="height: 180px; background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-car-side" style="font-size: 4rem; color: var(--secondary-gold);"></i>
                    </div>
                    <div class="card-body">
                        <h4 style="margin-bottom: 1rem;">Defensive Driving</h4>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Learn advanced defensive driving techniques to anticipate and avoid potential hazards on the road.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Hazard perception</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Emergency maneuvers</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Space management</li>
                        </ul>
                        <button onclick="showTrainingModal('defensive')" class="btn btn-primary btn-sm">Register Now</button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="height: 100%;">
                    <div style="height: 180px; background: linear-gradient(135deg, var(--accent-green), var(--accent-green-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-users-cog" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h4 style="margin-bottom: 1rem;">Customer Service Excellence</h4>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Develop skills to provide exceptional passenger service and handle difficult situations professionally.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Communication skills</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Conflict resolution</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Professional etiquette</li>
                        </ul>
                        <button onclick="showTrainingModal('customer')" class="btn btn-primary btn-sm">Register Now</button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="height: 100%;">
                    <div style="height: 180px; background: linear-gradient(135deg, var(--secondary-gold), var(--secondary-gold-light)); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-tools" style="font-size: 4rem; color: var(--primary-blue);"></i>
                    </div>
                    <div class="card-body">
                        <h4 style="margin-bottom: 1rem;">Vehicle Maintenance</h4>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Understand basic vehicle maintenance to keep your bus in optimal condition and prevent breakdowns.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Pre-trip inspections</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Routine maintenance</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Troubleshooting</li>
                        </ul>
                        <button onclick="showTrainingModal('maintenance')" class="btn btn-primary btn-sm">Register Now</button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="height: 100%;">
                    <div style="height: 180px; background: linear-gradient(135deg, #6366f1, #8b5cf6); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-first-aid" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h4 style="margin-bottom: 1rem;">First Aid & Emergency Response</h4>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Learn essential first aid skills and emergency response procedures for on-road incidents.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>CPR basics</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Injury treatment</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Emergency protocols</li>
                        </ul>
                        <button onclick="showTrainingModal('firstaid')" class="btn btn-primary btn-sm">Register Now</button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card" style="height: 100%;">
                    <div style="height: 180px; background: linear-gradient(135deg, #ec4899, #f472b6); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-user-tie" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h4 style="margin-bottom: 1rem;">Leadership Development</h4>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Develop leadership skills for those aspiring to take on leadership roles within the union or workplace.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Team management</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Decision making</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Conflict mediation</li>
                        </ul>
                        <button onclick="showTrainingModal('leadership')" class="btn btn-primary btn-sm">Register Now</button>
                    </div>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card" style="height: 100%;">
                    <div style="height: 180px; background: linear-gradient(135deg, #14b8a6, #2dd4bf); display: flex; align-items: center; justify-content: center;">
                        <i class="fas fa-balance-scale" style="font-size: 4rem; color: white;"></i>
                    </div>
                    <div class="card-body">
                        <h4 style="margin-bottom: 1rem;">Labor Rights & Regulations</h4>
                        <p style="color: var(--dark-gray); margin-bottom: 1rem;">Understand your labor rights, employment regulations, and how to protect yourself legally.</p>
                        <ul style="list-style: none; padding: 0; margin-bottom: 1.5rem;">
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Labor laws</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Contract understanding</li>
                            <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Legal procedures</li>
                        </ul>
                        <button onclick="showTrainingModal('labor')" class="btn btn-primary btn-sm">Register Now</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Training Calendar -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Training Calendar</h2>
            <p class="section-subtitle">Upcoming training sessions and schedules</p>
        </div>
        
        <div class="card" style="padding: 2rem;" data-aos="fade-up">
            <div class="row">
                <div class="col-md-4">
                    <div style="background: var(--primary-blue); color: white; padding: 2rem; text-align: center; border-radius: var(--radius-lg);">
                        <div style="font-size: 3rem; font-weight: 800;">15</div>
                        <div style="font-size: 1.2rem;">January 2026</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4 style="margin-bottom: 1rem;">Defensive Driving Workshop</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 1rem;">Join our comprehensive defensive driving workshop covering hazard perception, emergency maneuvers, and space management techniques.</p>
                    <div class="d-flex align-center gap-3">
                        <span style="color: var(--accent-green);"><i class="fas fa-map-marker-alt mr-2"></i>Yaoundé</span>
                        <span style="color: var(--accent-green);"><i class="fas fa-clock mr-2"></i>9:00 AM - 4:00 PM</span>
                        <button onclick="showTrainingModal('defensive')" class="btn btn-primary btn-sm">Register</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card" style="padding: 2rem; margin-top: 1rem;" data-aos="fade-up" data-aos-delay="100">
            <div class="row">
                <div class="col-md-4">
                    <div style="background: var(--secondary-gold); color: var(--primary-blue); padding: 2rem; text-align: center; border-radius: var(--radius-lg);">
                        <div style="font-size: 3rem; font-weight: 800;">22</div>
                        <div style="font-size: 1.2rem;">January 2026</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4 style="margin-bottom: 1rem;">Customer Service Excellence</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 1rem;">Enhance your passenger service skills with our customer service excellence training program.</p>
                    <div class="d-flex align-center gap-3">
                        <span style="color: var(--accent-green);"><i class="fas fa-map-marker-alt mr-2"></i>Douala</span>
                        <span style="color: var(--accent-green);"><i class="fas fa-clock mr-2"></i>9:00 AM - 3:00 PM</span>
                        <button onclick="showTrainingModal('customer')" class="btn btn-primary btn-sm">Register</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card" style="padding: 2rem; margin-top: 1rem;" data-aos="fade-up" data-aos-delay="200">
            <div class="row">
                <div class="col-md-4">
                    <div style="background: var(--accent-green); color: white; padding: 2rem; text-align: center; border-radius: var(--radius-lg);">
                        <div style="font-size: 3rem; font-weight: 800;">05</div>
                        <div style="font-size: 1.2rem;">February 2026</div>
                    </div>
                </div>
                <div class="col-md-8">
                    <h4 style="margin-bottom: 1rem;">First Aid & Emergency Response</h4>
                    <p style="color: var(--dark-gray); margin-bottom: 1rem;">Learn life-saving first aid skills and emergency response procedures for on-road incidents.</p>
                    <div class="d-flex align-center gap-3">
                        <span style="color: var(--accent-green);"><i class="fas fa-map-marker-alt mr-2"></i>Bamenda</span>
                        <span style="color: var(--accent-green);"><i class="fas fa-clock mr-2"></i>8:00 AM - 5:00 PM</span>
                        <button onclick="showTrainingModal('firstaid')" class="btn btn-primary btn-sm">Register</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Certification -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Certification Programs</h2>
            <p class="section-subtitle">Get certified and advance your career</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card" style="padding: 2rem; height: 100%;">
                    <div class="d-flex align-center gap-3 mb-3">
                        <div style="width: 80px; height: 80px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-certificate" style="font-size: 2rem; color: var(--secondary-gold);"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0;">Professional Driver Certification</h4>
                            <span class="badge" style="background: var(--accent-green); color: white;">Advanced</span>
                        </div>
                    </div>
                    <p style="color: var(--dark-gray); margin-bottom: 1rem;">Our comprehensive certification program validates your expertise as a professional bus driver, covering all aspects of safe and efficient operation.</p>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Written examination</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Practical driving test</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Vehicle knowledge assessment</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Customer service evaluation</li>
                    </ul>
                    <a href="contact.php" class="btn btn-primary mt-3">Learn More</a>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card" style="padding: 2rem; height: 100%;">
                    <div class="d-flex align-center gap-3 mb-3">
                        <div style="width: 80px; height: 80px; background: var(--secondary-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-award" style="font-size: 2rem; color: var(--primary-blue);"></i>
                        </div>
                        <div>
                            <h4 style="margin: 0;">Road Safety Specialist</h4>
                            <span class="badge" style="background: var(--primary-blue); color: white;">Specialized</span>
                        </div>
                    </div>
                    <p style="color: var(--dark-gray); margin-bottom: 1rem;">Specialized certification for drivers who want to become road safety advocates and trainers within their organizations.</p>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Advanced safety techniques</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Training methodology</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Safety program development</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i>Incident investigation</li>
                    </ul>
                    <a href="contact.php" class="btn btn-primary mt-3">Learn More</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Registration Modal -->
<div class="modal" id="trainingModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: var(--z-modal); align-items: center; justify-content: center;">
    <div class="modal-content" style="background: var(--white); border-radius: var(--radius-lg); padding: 2rem; max-width: 500px; width: 90%; max-height: 90vh; overflow-y: auto; position: relative;">
        <button onclick="closeTrainingModal()" style="position: absolute; top: 1rem; right: 1rem; width: 40px; height: 40px; border: none; background: var(--light-gray); border-radius: var(--radius-full); cursor: pointer; font-size: 1.2rem;">&times;</button>
        <h3 style="margin-bottom: 1.5rem;">Training Registration</h3>
        <form method="POST" action="includes/training-registration.php" id="trainingForm">
            <input type="hidden" name="csrf_token" value="<?= $_SESSION[CSRF_TOKEN] ?>">
            <input type="hidden" name="training_type" id="trainingTypeInput">
            <div class="form-group">
                <label class="form-label">Full Name *</label>
                <input type="text" class="form-control" name="full_name" required>
            </div>
            <div class="form-group">
                <label class="form-label">Email *</label>
                <input type="email" class="form-control" name="email" required>
            </div>
            <div class="form-group">
                <label class="form-label">Phone *</label>
                <input type="tel" class="form-control" name="phone" required>
            </div>
            <div class="form-group">
                <label class="form-label">Region</label>
                <select class="form-control form-select" name="region">
                    <option value="">Select Region</option>
                    <option value="Adamawa">Adamawa</option>
                    <option value="Centre">Centre</option>
                    <option value="East">East</option>
                    <option value="Far North">Far North</option>
                    <option value="Littoral">Littoral</option>
                    <option value="North">North</option>
                    <option value="Northwest">Northwest</option>
                    <option value="West">West</option>
                    <option value="South">South</option>
                    <option value="Southwest">Southwest</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Company/Employer</label>
                <input type="text" class="form-control" name="company">
            </div>
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </form>
    </div>
</div>

<script>
function showTrainingModal(type) {
    document.getElementById('trainingTypeInput').value = type;
    document.getElementById('trainingModal').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeTrainingModal() {
    document.getElementById('trainingModal').style.display = 'none';
    document.body.style.overflow = '';
}

function closeMessage() {
    const successSection = document.querySelector('section:has(h2)');
    if (successSection) {
        successSection.style.display = 'none';
    }
}

document.getElementById('trainingModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeTrainingModal();
    }
});
</script>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
