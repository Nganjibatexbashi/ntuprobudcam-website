<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Road Safety';
$page_description = 'Road safety resources, tips, and campaigns from NTUPROBUDCAM - promoting safer roads in Cameroon';
require_once ROOT_PATH . '/includes/header.php';
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Road Safety</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">Promoting safer roads and responsible driving across Cameroon</p>
    </div>
</section>

<!-- Road Safety Hero -->
<section class="section">
    <div class="container">
        <div class="card card-glass" style="padding: 3rem; text-align: center; background: linear-gradient(135deg, var(--accent-green), var(--accent-green-dark)); color: white;" data-aos="fade-up">
            <i class="fas fa-shield-alt" style="font-size: 4rem; color: var(--secondary-gold); margin-bottom: 1.5rem;"></i>
            <h2 style="color: var(--secondary-gold); margin-bottom: 1rem;">Safety First, Always</h2>
            <p style="font-size: 1.2rem; max-width: 800px; margin: 0 auto;">At NTUPROBUDCAM, road safety is at the heart of everything we do. We are committed to reducing accidents, saving lives, and creating a safer transport environment for all road users in Cameroon.</p>
        </div>
    </div>
</section>

<!-- Safety Tips -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Essential Safety Tips</h2>
            <p class="section-subtitle">Key practices for safe and responsible driving</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-tachometer-alt"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Speed Management</h4>
                    <p style="color: var(--dark-gray);">Always adhere to speed limits. Adjust your speed according to road conditions, weather, and traffic. Remember: speed kills, but safe driving saves lives.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-bed"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Fatigue Prevention</h4>
                    <p style="color: var(--dark-gray);">Never drive when tired. Take regular breaks on long journeys. Get adequate rest before driving. Fatigue impairs reaction time and decision-making abilities.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-mobile-alt"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Avoid Distractions</h4>
                    <p style="color: var(--dark-gray);">Keep your focus on the road. Avoid using mobile phones while driving. Don't eat, drink, or engage in activities that take your attention away from driving.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-car-crash"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Defensive Driving</h4>
                    <p style="color: var(--dark-gray);">Anticipate potential hazards. Maintain safe following distances. Be aware of your surroundings and expect the unexpected from other road users.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-wine-bottle"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Never Drink and Drive</h4>
                    <p style="color: var(--dark-gray);">Alcohol impairs judgment, coordination, and reaction time. If you plan to drink, arrange for a designated driver or use alternative transportation.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                <div class="card" style="padding: 2rem;">
                    <div class="feature-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                        <i class="fas fa-seatbelt"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Wear Seatbelts</h4>
                    <p style="color: var(--dark-gray);">Always wear your seatbelt and ensure all passengers do the same. Seatbelts significantly reduce the risk of serious injury in case of an accident.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Bus Inspection Checklist -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Bus Inspection Checklist</h2>
            <p class="section-subtitle">Pre-trip vehicle inspection checklist for bus drivers</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1.5rem; color: var(--accent-green);"><i class="fas fa-check-circle mr-2"></i>Exterior Inspection</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Tires - check pressure, tread depth, and condition</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Lights - headlights, brake lights, turn signals</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Mirrors - adjust for proper visibility</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Windshield and wipers - clean and functional</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Body - check for damage or loose parts</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Fluids - check oil, coolant, and windshield washer</span>
                        </li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card" style="padding: 2rem;">
                    <h4 style="margin-bottom: 1.5rem; color: var(--accent-green);"><i class="fas fa-check-circle mr-2"></i>Interior Inspection</h4>
                    <ul style="list-style: none; padding: 0;">
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Seatbelts - ensure all are functional</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Emergency exits - check for proper operation</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Fire extinguisher - ensure accessible and charged</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">First aid kit - check supplies</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Dashboard - warning lights and gauges</span>
                        </li>
                        <li style="margin-bottom: 0.75rem; padding-left: 2rem; position: relative;">
                            <input type="checkbox" style="position: absolute; left: 0; top: 4px;">
                            <span style="margin-left: 1.5rem;">Brakes and steering - test before departure</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Driver Wellness -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Driver Wellness</h2>
            <p class="section-subtitle">Maintaining physical and mental health for safe driving</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: var(--primary-blue); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-heartbeat" style="font-size: 2rem; color: var(--secondary-gold);"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Regular Health Check-ups</h4>
                    <p style="color: var(--dark-gray);">Schedule regular medical check-ups to monitor vision, hearing, and overall health. Early detection of health issues prevents accidents.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: var(--secondary-gold); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-utensils" style="font-size: 2rem; color: var(--primary-blue);"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Healthy Nutrition</h4>
                    <p style="color: var(--dark-gray);">Maintain a balanced diet. Avoid heavy meals before driving. Stay hydrated by drinking water regularly during your shifts.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card" style="padding: 2rem; text-align: center;">
                    <div style="width: 80px; height: 80px; background: var(--accent-green); border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                        <i class="fas fa-brain" style="font-size: 2rem; color: white;"></i>
                    </div>
                    <h4 style="margin-bottom: 1rem;">Mental Health</h4>
                    <p style="color: var(--dark-gray);">Manage stress through healthy coping mechanisms. Take breaks when needed. Seek support if experiencing mental health challenges.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Emergency Procedures -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Emergency Procedures</h2>
            <p class="section-subtitle">What to do in case of an emergency</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                    <h4 style="margin-bottom: 1rem; color: #ef4444;"><i class="fas fa-exclamation-triangle mr-2"></i>In Case of Accident</h4>
                    <ol style="padding-left: 1.5rem; line-height: 1.8;">
                        <li style="margin-bottom: 0.5rem;">Stop immediately and secure the vehicle</li>
                        <li style="margin-bottom: 0.5rem;">Check for injuries and call emergency services</li>
                        <li style="margin-bottom: 0.5rem;">Set up warning triangles or flares</li>
                        <li style="margin-bottom: 0.5rem;">Exchange information with other parties involved</li>
                        <li style="margin-bottom: 0.5rem;">Document the scene with photos if safe</li>
                        <li style="margin-bottom: 0.5rem;">Contact your employer and union representative</li>
                        <li>File an accident report with authorities</li>
                    </ol>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                    <h4 style="margin-bottom: 1rem; color: #f59e0b;"><i class="fas fa-first-aid mr-2"></i>Medical Emergency</h4>
                    <ol style="padding-left: 1.5rem; line-height: 1.8;">
                        <li style="margin-bottom: 0.5rem;">Pull over safely if possible</li>
                        <li style="margin-bottom: 0.5rem;">Call emergency services immediately</li>
                        <li style="margin-bottom: 0.5rem;">Assess the situation and provide first aid if trained</li>
                        <li style="margin-bottom: 0.5rem;">Inform passengers and keep them calm</li>
                        <li style="margin-bottom: 0.5rem;">Contact dispatch for further instructions</li>
                        <li style="margin-bottom: 0.5rem;">Cooperate with emergency responders</li>
                        <li>Document the incident for reporting</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Safety Campaigns -->
<section class="section section-dark">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title" style="color: white;">Our Safety Campaigns</h2>
            <p class="section-subtitle" style="color: rgba(255,255,255,0.9);">Initiatives we've launched to promote road safety</p>
        </div>
        
        <div class="row">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="0">
                <div class="card card-glass" style="padding: 2rem; text-align: center; color: white;">
                    <i class="fas fa-bullhorn" style="font-size: 3rem; color: var(--secondary-gold); margin-bottom: 1rem;"></i>
                    <h4 style="color: var(--secondary-gold);">Public Awareness</h4>
                    <p>Regular campaigns to educate the public about sharing the road safely with buses and commercial vehicles.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="card card-glass" style="padding: 2rem; text-align: center; color: white;">
                    <i class="fas fa-chalkboard-teacher" style="font-size: 3rem; color: var(--secondary-gold); margin-bottom: 1rem;"></i>
                    <h4 style="color: var(--secondary-gold);">Driver Training</h4>
                    <p>Comprehensive defensive driving courses for our members and the broader driving community.</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="card card-glass" style="padding: 2rem; text-align: center; color: white;">
                    <i class="fas fa-handshake" style="font-size: 3rem; color: var(--secondary-gold); margin-bottom: 1rem;"></i>
                    <h4 style="color: var(--secondary-gold);">Partnership Programs</h4>
                    <p>Collaboration with government agencies and NGOs to implement road safety initiatives nationwide.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Call to Action -->
<section class="section">
    <div class="container text-center">
        <div data-aos="fade-up">
            <h2 style="margin-bottom: 1rem;">Commit to Safety Today</h2>
            <p style="font-size: 1.2rem; color: var(--dark-gray); margin-bottom: 2rem;">Join our road safety initiatives and help make Cameroon's roads safer for everyone</p>
            <a href="membership.php" class="btn btn-primary btn-lg">Join NTUPROBUDCAM</a>
            <a href="contact.php" class="btn btn-outline btn-lg" style="margin-left: 1rem;">Contact Us</a>
        </div>
    </div>
</section>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
