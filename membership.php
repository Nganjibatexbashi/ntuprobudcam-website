<?php
require_once __DIR__ . '/config/config.php';
require_once ROOT_PATH . '/includes/mailer.php';

$page_title = 'Membership';
$page_description = 'Join NTUPROBUDCAM - Become a member and access exclusive benefits for professional bus drivers in Cameroon';
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
        
        // Generate application number
        $application_number = 'TUP' . date('Y') . str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
        
        // Handle file upload
        $photo_path = null;
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
            $allowed_types = ['image/jpeg', 'image/png', 'image/jpg'];
            $file_type = $_FILES['photo']['type'];
            $file_size = $_FILES['photo']['size'];
            
            if (!in_array($file_type, $allowed_types)) {
                throw new Exception('Invalid file type. Only JPEG and PNG images are allowed.');
            }
            
            if ($file_size > MAX_FILE_SIZE) {
                throw new Exception('File size exceeds maximum limit of 5MB.');
            }
            
            $upload_dir = ROOT_PATH . '/uploads/members/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0777, true);
            }
            
            $file_extension = pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION);
            $file_name = $application_number . '_photo.' . $file_extension;
            $upload_path = $upload_dir . $file_name;
            
            if (!move_uploaded_file($_FILES['photo']['tmp_name'], $upload_path)) {
                throw new Exception('Failed to upload photo.');
            }
            
            $photo_path = 'members/' . $file_name;
        }
        
        // Prepare SQL statement
        $sql = "INSERT INTO membership_applications (
            application_number, full_name, photo, gender, date_of_birth, region, town, 
            company, driving_license_number, license_category, phone, email, 
            years_of_experience, emergency_contact_name, emergency_contact_phone, 
            documents, status, created_at
        ) VALUES (
            :application_number, :full_name, :photo, :gender, :date_of_birth, :region, :town,
            :company, :driving_license_number, :license_category, :phone, :email,
            :years_of_experience, :emergency_contact_name, :emergency_contact_phone,
            :documents, 'pending', NOW()
        )";
        
        $stmt = $pdo->prepare($sql);
        
        // Bind parameters
        $stmt->execute([
            ':application_number' => $application_number,
            ':full_name' => trim($_POST['full_name']),
            ':photo' => $photo_path,
            ':gender' => $_POST['gender'],
            ':date_of_birth' => $_POST['date_of_birth'],
            ':region' => trim($_POST['region']),
            ':town' => trim($_POST['town']),
            ':company' => trim($_POST['company'] ?? ''),
            ':driving_license_number' => trim($_POST['driving_license_number']),
            ':license_category' => trim($_POST['license_category'] ?? ''),
            ':phone' => trim($_POST['phone']),
            ':email' => trim($_POST['email'] ?? ''),
            ':years_of_experience' => intval($_POST['years_of_experience'] ?? 0),
            ':emergency_contact_name' => trim($_POST['emergency_contact_name'] ?? ''),
            ':emergency_contact_phone' => trim($_POST['emergency_contact_phone'] ?? ''),
            ':documents' => '' // Can be extended for document uploads
        ]);
        
        $success = true;
        
        // Send confirmation email
        $subject = 'Membership Application Received - NTUPROBUDCAM';
        $message = "
        <html>
        <head>
        <title>Membership Application Received</title>
        </head>
        <body style='font-family: Arial, sans-serif; line-height: 1.6;'>
        <div style='max-width: 600px; margin: 0 auto; padding: 20px;'>
        <h2 style='color: #003366;'>Membership Application Received</h2>
        <p>Dear " . htmlspecialchars($_POST['full_name']) . ",</p>
        <p>Thank you for your interest in joining NTUPROBUDCAM. Your membership application has been successfully submitted.</p>
        <p><strong>Application Details:</strong></p>
        <ul>
            <li>Application Number: <strong>$application_number</strong></li>
            <li>Full Name: " . htmlspecialchars($_POST['full_name']) . "</li>
            <li>Phone: " . htmlspecialchars($_POST['phone']) . "</li>
            <li>Region: " . htmlspecialchars($_POST['region']) . "</li>
            <li>Town: " . htmlspecialchars($_POST['town']) . "</li>
            " . (!empty($_POST['email']) ? "<li>Email: " . htmlspecialchars($_POST['email']) . "</li>" : "") . "
        </ul>
        <p>Your application is currently <strong>Pending</strong>. We will review your application and contact you within 5-7 business days regarding the status.</p>
        <p>If you have any questions, please contact us at info@ntuprobudcam.org</p>
        <p>Best regards,<br>NTUPROBUDCAM Team<br>National Trade Union of Professional Bus Drivers of Cameroon</p>
        </div>
        </body>
        </html>
        ";
        
        if (!empty($_POST['email'])) {
            sendEmail($_POST['email'], $subject, $message);
        }
        
    } catch (Exception $e) {
        $error = $e->getMessage();
    }
}
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Membership</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Join NTUPROBUDCAM and become part of our community of professional bus drivers</p>
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
            <h2 style="color: var(--accent-green);">Application Submitted Successfully!</h2>
            <p style="color: var(--dark-gray); margin-bottom: 1.5rem;">Thank you for your interest in joining NTUPROBUDCAM. Your application has been received and is being processed.</p>
            <p style="color: var(--dark-gray); margin-bottom: 1.5rem;">Application Number: <strong><?= htmlspecialchars($application_number ?? '') ?></strong></p>
            <p style="color: var(--dark-gray); margin-bottom: 2rem;">We will contact you within 5-7 business days regarding the status of your application.</p>
            <a href="index.php" class="btn btn-primary">Return to Home</a>
        </div>
    </div>
</section>
<?php else: ?>

<!-- Membership Information -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Why Join NTUPROBUDCAM?</h2>
            <p class="section-subtitle">Discover the benefits of becoming a member</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="feature-title">Legal Protection</h3>
                    <p class="feature-description">Access to legal assistance and representation for work-related issues and disputes.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h3 class="feature-title">Free Training</h3>
                    <p class="feature-description">Complimentary access to training programs, workshops, and professional development courses.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <h3 class="feature-title">Financial Benefits</h3>
                    <p class="feature-description">Exclusive access to financial assistance programs, insurance options, and welfare support.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="feature-title">Networking</h3>
                    <p class="feature-description">Connect with fellow professional drivers across Cameroon and build valuable relationships.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <h3 class="feature-title">Voice & Advocacy</h3>
                    <p class="feature-description">Have your voice heard in policy discussions and industry decisions affecting drivers.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heartbeat"></i>
                    </div>
                    <h3 class="feature-title">Health & Safety</h3>
                    <p class="feature-description">Health campaigns, safety programs, and wellness initiatives for members and families.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Membership Requirements -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Membership Requirements</h2>
            <p class="section-subtitle">Who can become a member of NTUPROBUDCAM</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card" style="padding: 2rem;">
                    <h3 style="margin-bottom: 1.5rem;"><i class="fas fa-user-check text-accent mr-2"></i>Eligibility Criteria</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Must be a professional bus driver with valid driving license
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            At least 18 years of age
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Resident of Cameroon
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Committed to professional ethics and road safety
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Agree to abide by the union's constitution and regulations
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card" style="padding: 2rem;">
                    <h3 style="margin-bottom: 1.5rem;"><i class="fas fa-file-alt text-accent mr-2"></i>Required Documents</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-file text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Valid driving license (copy)
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-file text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            National ID card (copy)
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-file text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Passport-sized photograph
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-file text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Proof of residence
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-file text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Employment contract or letter (if employed)
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Membership Categories -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Membership Categories</h2>
            <p class="section-subtitle">Choose the membership category that suits you</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 2rem; text-align: center; border: 2px solid var(--primary-blue);">
                    <h3 style="color: var(--primary-blue);">Active Member</h3>
                    <div style="font-size: 3rem; font-weight: 800; color: var(--primary-blue); margin: 1rem 0;">10,000 FCFA</div>
                    <p style="color: var(--dark-gray); margin-bottom: 1.5rem;">Annual membership fee</p>
                    <ul style="list-style: none; padding: 0; text-align: left; margin-bottom: 2rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Full voting rights</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Legal assistance</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Free training programs</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Welfare support</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Networking opportunities</li>
                    </ul>
                    <span class="badge" style="background: var(--accent-green); color: white; padding: 0.5rem 1rem;">Most Popular</span>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 2rem; text-align: center; border: 2px solid var(--secondary-gold);">
                    <h3 style="color: var(--secondary-gold);">Associate Member</h3>
                    <div style="font-size: 3rem; font-weight: 800; color: var(--secondary-gold); margin: 1rem 0;">5,000 FCFA</div>
                    <p style="color: var(--dark-gray); margin-bottom: 1.5rem;">Annual membership fee</p>
                    <ul style="list-style: none; padding: 0; text-align: left; margin-bottom: 2rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Limited voting rights</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Basic legal consultation</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Discounted training</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Networking opportunities</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Newsletter access</li>
                    </ul>
                    <span class="badge" style="background: var(--primary-blue); color: white; padding: 0.5rem 1rem;">For Part-time Drivers</span>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 2rem; text-align: center; border: 2px solid var(--accent-green);">
                    <h3 style="color: var(--accent-green);">Honorary Member</h3>
                    <div style="font-size: 3rem; font-weight: 800; color: var(--accent-green); margin: 1rem 0;">Free</div>
                    <p style="color: var(--dark-gray); margin-bottom: 1.5rem;">By invitation only</p>
                    <ul style="list-style: none; padding: 0; text-align: left; margin-bottom: 2rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Full voting rights</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> All member benefits</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Advisory role</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Recognition in publications</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Special event access</li>
                    </ul>
                    <span class="badge" style="background: var(--secondary-gold); color: var(--primary-blue); padding: 0.5rem 1rem;">For Distinguished Individuals</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Membership Application Form -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Membership Application Form</h2>
            <p class="section-subtitle">Fill out the form below to apply for membership</p>
        </div>
        
        <?php if (isset($error)): ?>
        <div class="card" style="padding: 1rem; margin-bottom: 2rem; background: #fee; border-left: 4px solid #c00;">
            <p style="color: #c00; margin: 0;"><i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($error) ?></p>
        </div>
        <?php endif; ?>
        
        <div class="card" style="padding: 3rem;" data-aos="fade-up">
            <form method="POST" enctype="multipart/form-data" id="membershipForm" data-validate>
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
                            <label class="form-label" for="photo">Passport Photo *</label>
                            <input type="file" class="form-control" id="photo" name="photo" accept="image/jpeg,image/png,image/jpg" required>
                            <small style="color: var(--medium-gray);">Maximum size: 5MB. Formats: JPEG, PNG</small>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="gender">Gender *</label>
                            <select class="form-control form-select" id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="date_of_birth">Date of Birth *</label>
                            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label" for="years_of_experience">Years of Experience</label>
                            <input type="number" class="form-control" id="years_of_experience" name="years_of_experience" min="0" value="0">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="region">Region *</label>
                            <select class="form-control form-select" id="region" name="region" required>
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
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="town">Town/City *</label>
                            <input type="text" class="form-control" id="town" name="town" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="company">Company/Employer</label>
                            <input type="text" class="form-control" id="company" name="company">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="driving_license_number">Driving License Number *</label>
                            <input type="text" class="form-control" id="driving_license_number" name="driving_license_number" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="license_category">License Category</label>
                            <select class="form-control form-select" id="license_category" name="license_category">
                                <option value="">Select Category</option>
                                <option value="A">Category A</option>
                                <option value="B">Category B</option>
                                <option value="C">Category C</option>
                                <option value="D">Category D</option>
                                <option value="E">Category E</option>
                                <option value="F">Category F</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="phone">Phone Number *</label>
                            <input type="tel" class="form-control" id="phone" name="phone" required>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label" for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                
                <h4 style="margin: 2rem 0 1rem;">Emergency Contact</h4>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="emergency_contact_name">Emergency Contact Name</label>
                            <input type="text" class="form-control" id="emergency_contact_name" name="emergency_contact_name">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label" for="emergency_contact_phone">Emergency Contact Phone</label>
                            <input type="tel" class="form-control" id="emergency_contact_phone" name="emergency_contact_phone">
                        </div>
                    </div>
                </div>
                
                <div class="form-group" style="margin-top: 2rem;">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" id="agreement" name="agreement" required>
                        <span style="margin-left: 0.5rem;">I agree to abide by the NTUPROBUDCAM constitution and regulations, and I confirm that all information provided is accurate and true.</span>
                    </label>
                </div>
                
                <div class="form-group">
                    <label class="form-check">
                        <input type="checkbox" class="form-check-input" id="privacy" name="privacy" required>
                        <span style="margin-left: 0.5rem;">I consent to the collection and processing of my personal data in accordance with the privacy policy.</span>
                    </label>
                </div>
                
                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 1rem;">Submit Application</button>
            </form>
        </div>
    </div>
</section>

<?php endif; ?>

<!-- Member Rights & Responsibilities -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Rights & Responsibilities</h2>
            <p class="section-subtitle">Understanding your rights and responsibilities as a member</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card" style="padding: 2rem; height: 100%;">
                    <h3 style="color: var(--accent-green); margin-bottom: 1.5rem;"><i class="fas fa-user-shield mr-2"></i>Member Rights</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Right to vote in union elections
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Right to be elected to leadership positions
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Right to participate in union activities
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Right to access union services and benefits
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Right to legal representation and assistance
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Right to information about union activities
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-check-circle text-accent" style="position: absolute; left: 0; top: 5px;"></i>
                            Right to fair treatment and non-discrimination
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card" style="padding: 2rem; height: 100%;">
                    <h3 style="color: var(--primary-blue); margin-bottom: 1.5rem;"><i class="fas fa-tasks mr-2"></i>Member Responsibilities</h3>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-arrow-right text-primary" style="position: absolute; left: 0; top: 5px;"></i>
                            Pay annual membership dues on time
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-arrow-right text-primary" style="position: absolute; left: 0; top: 5px;"></i>
                            Abide by the union's constitution and regulations
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-arrow-right text-primary" style="position: absolute; left: 0; top: 5px;"></i>
                            Participate in union activities and meetings
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-arrow-right text-primary" style="position: absolute; left: 0; top: 5px;"></i>
                            Uphold professional ethics and standards
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-arrow-right text-primary" style="position: absolute; left: 0; top: 5px;"></i>
                            Promote road safety and responsible driving
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-arrow-right text-primary" style="position: absolute; left: 0; top: 5px;"></i>
                            Support fellow members and show solidarity
                        </li>
                        <li style="margin-bottom: 1rem; padding-left: 2rem; position: relative;">
                            <i class="fas fa-arrow-right text-primary" style="position: absolute; left: 0; top: 5px;"></i>
                            Maintain accurate personal information with the union
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
