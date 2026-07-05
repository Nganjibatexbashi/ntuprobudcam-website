<?php
require_once __DIR__ . '/config/config.php';

$page_title = 'Organizational Structure';
$page_description = 'Understand the organizational structure of NTUPROBUDCAM from Congress to Local Units';
require_once ROOT_PATH . '/includes/header.php';
?>

<!-- Page Header -->
<section class="section section-dark" style="padding: 120px 0 60px;">
    <div class="container text-center">
        <h1 style="color: white;">Organizational Structure</h1>
        <p style="color: rgba(255,255,255,0.9); font-size: 1.2rem;">The hierarchical structure of NTUPROBUDCAM from national to local level</p>
    </div>
</section>

<!-- Organizational Flowchart -->
<section class="section">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Our Structure</h2>
            <p class="section-subtitle">Click on each level to learn more about its role and responsibilities</p>
        </div>
        
        <div class="org-chart" data-aos="fade-up">
            <!-- Congress -->
            <div class="org-level" data-aos="fade-down" data-aos-delay="0">
                <div class="org-box org-box-main" onclick="showOrgDetails('congress')">
                    <div class="org-icon">
                        <i class="fas fa-landmark"></i>
                    </div>
                    <h3>Congress</h3>
                    <p>Supreme Authority</p>
                </div>
            </div>
            
            <div class="org-connector">
                <i class="fas fa-arrow-down"></i>
            </div>
            
            <!-- National Council -->
            <div class="org-level" data-aos="fade-down" data-aos-delay="100">
                <div class="org-box org-box-primary" onclick="showOrgDetails('council')">
                    <div class="org-icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3>National Council</h3>
                    <p>Policy Making Body</p>
                </div>
            </div>
            
            <div class="org-connector">
                <i class="fas fa-arrow-down"></i>
            </div>
            
            <!-- Executive Office -->
            <div class="org-level" data-aos="fade-down" data-aos-delay="200">
                <div class="org-box org-box-secondary" onclick="showOrgDetails('executive')">
                    <div class="org-icon">
                        <i class="fas fa-cog"></i>
                    </div>
                    <h3>Executive Office</h3>
                    <p>Daily Administration</p>
                </div>
            </div>
            
            <div class="org-connector">
                <i class="fas fa-arrow-down"></i>
            </div>
            
            <!-- Regional Sections -->
            <div class="org-level" data-aos="fade-down" data-aos-delay="300">
                <div class="org-box org-box-accent" onclick="showOrgDetails('regional')">
                    <div class="org-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Regional Sections</h3>
                    <p>10 Regional Offices</p>
                </div>
            </div>
            
            <div class="org-connector">
                <i class="fas fa-arrow-down"></i>
            </div>
            
            <!-- Local Units -->
            <div class="org-level" data-aos="fade-down" data-aos-delay="400">
                <div class="org-box org-box-success" onclick="showOrgDetails('local')">
                    <div class="org-icon">
                        <i class="fas fa-building"></i>
                    </div>
                    <h3>Local Units</h3>
                    <p>Grassroots Level</p>
                </div>
            </div>
        </div>
        
        <!-- Details Modal -->
        <div class="org-details" id="orgDetails">
            <div class="org-details-content">
                <button class="org-details-close" onclick="closeOrgDetails()">
                    <i class="fas fa-times"></i>
                </button>
                <div id="orgDetailsBody"></div>
            </div>
        </div>
    </div>
</section>

<!-- Detailed Structure Description -->
<section class="section section-light">
    <div class="container">
        <div class="section-header" data-aos="fade-up">
            <h2 class="section-title">Structure Details</h2>
            <p class="section-subtitle">Understanding each level of our organization</p>
        </div>
        
        <div class="row">
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                    <div class="d-flex align-center gap-3 mb-3">
                        <div class="org-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-landmark"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0;">Congress</h3>
                            <span class="badge" style="background: var(--primary-blue); color: white;">Supreme Authority</span>
                        </div>
                    </div>
                    <p style="color: var(--dark-gray);">The Congress is the supreme decision-making body of NTUPROBUDCAM, convened every four years. It brings together delegates from all regional sections to review the union's activities, amend the constitution, elect national leadership, and set strategic directions for the next term.</p>
                    <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Approves constitutional amendments</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Elects national leadership</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Sets strategic objectives</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Reviews financial reports</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                    <div class="d-flex align-center gap-3 mb-3">
                        <div class="org-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-users"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0;">National Council</h3>
                            <span class="badge" style="background: var(--secondary-gold); color: var(--primary-blue);">Policy Making</span>
                        </div>
                    </div>
                    <p style="color: var(--dark-gray);">The National Council serves as the policy-making body between Congress sessions. It meets annually to review progress, implement Congress decisions, and address emerging issues affecting professional bus drivers nationwide.</p>
                    <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Implements Congress decisions</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Approves annual budgets</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Monitors Executive Office activities</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Addresses policy matters</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-right">
                <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                    <div class="d-flex align-center gap-3 mb-3">
                        <div class="org-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0;">Executive Office</h3>
                            <span class="badge" style="background: var(--accent-green); color: white;">Administration</span>
                        </div>
                    </div>
                    <p style="color: var(--dark-gray);">The Executive Office is responsible for the day-to-day administration of the union. Led by the National President, it implements policies approved by the National Council and manages the union's operations, programs, and activities.</p>
                    <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Daily administration and management</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Program implementation</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Member services coordination</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> External representation</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6" data-aos="fade-left">
                <div class="card" style="padding: 2rem; margin-bottom: 2rem;">
                    <div class="d-flex align-center gap-3 mb-3">
                        <div class="org-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0;">Regional Sections</h3>
                            <span class="badge" style="background: var(--primary-blue-light); color: white;">Regional Coordination</span>
                        </div>
                    </div>
                    <p style="color: var(--dark-gray);">NTUPROBUDCAM has established regional sections in all ten regions of Cameroon. Each section coordinates union activities at the regional level, represents members' interests, and implements national programs adapted to local needs.</p>
                    <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Regional program coordination</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Local unit supervision</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Regional advocacy</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Member recruitment</li>
                    </ul>
                </div>
            </div>
            
            <div class="col-lg-6 offset-lg-3" data-aos="fade-up">
                <div class="card" style="padding: 2rem;">
                    <div class="d-flex align-center gap-3 mb-3">
                        <div class="org-icon" style="width: 60px; height: 60px; font-size: 1.5rem;">
                            <i class="fas fa-building"></i>
                        </div>
                        <div>
                            <h3 style="margin: 0;">Local Units</h3>
                            <span class="badge" style="background: var(--secondary-gold); color: var(--primary-blue);">Grassroots Level</span>
                        </div>
                    </div>
                    <p style="color: var(--dark-gray);">Local Units form the grassroots level of our organization, established in towns and cities across Cameroon. They are the primary point of contact for members, providing direct services, support, and representation at the local level.</p>
                    <ul style="list-style: none; padding: 0; margin-top: 1rem;">
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Direct member services</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Local issue resolution</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> Community engagement</li>
                        <li style="margin-bottom: 0.5rem;"><i class="fas fa-check text-accent mr-2"></i> New member recruitment</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
.org-chart {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 2rem 0;
}

.org-level {
    width: 100%;
    display: flex;
    justify-content: center;
}

.org-box {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem;
    text-align: center;
    min-width: 300px;
    max-width: 400px;
    box-shadow: var(--shadow-lg);
    cursor: pointer;
    transition: all var(--transition-normal);
    position: relative;
}

.org-box:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-xl);
}

.org-box-main {
    background: linear-gradient(135deg, var(--primary-blue), var(--primary-blue-light));
    color: white;
}

.org-box-main h3,
.org-box-main p {
    color: white;
}

.org-box-primary {
    background: linear-gradient(135deg, var(--secondary-gold), var(--secondary-gold-light));
    color: var(--primary-blue);
}

.org-box-primary h3,
.org-box-primary p {
    color: var(--primary-blue);
}

.org-box-secondary {
    background: linear-gradient(135deg, var(--accent-green), var(--accent-green-light));
    color: white;
}

.org-box-secondary h3,
.org-box-secondary p {
    color: white;
}

.org-box-accent {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
}

.org-box-accent h3,
.org-box-accent p {
    color: white;
}

.org-box-success {
    background: linear-gradient(135deg, #10b981, #34d399);
    color: white;
}

.org-box-success h3,
.org-box-success p {
    color: white;
}

.org-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    font-size: 2rem;
    color: white;
}

.org-box-main .org-icon {
    background: rgba(255, 255, 255, 0.2);
}

.org-box-primary .org-icon {
    background: rgba(0, 51, 102, 0.2);
}

.org-box-secondary .org-icon {
    background: rgba(255, 255, 255, 0.2);
}

.org-box-accent .org-icon {
    background: rgba(255, 255, 255, 0.2);
}

.org-box-success .org-icon {
    background: rgba(255, 255, 255, 0.2);
}

.org-box h3 {
    margin: 0 0 0.5rem;
    font-size: 1.5rem;
}

.org-box p {
    margin: 0;
    opacity: 0.9;
    font-size: 0.9rem;
}

.org-connector {
    font-size: 2rem;
    color: var(--primary-blue);
    margin: 0.5rem 0;
}

.org-details {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: var(--z-modal);
    align-items: center;
    justify-content: center;
}

.org-details.active {
    display: flex;
}

.org-details-content {
    background: var(--white);
    border-radius: var(--radius-lg);
    padding: 2rem;
    max-width: 600px;
    width: 90%;
    max-height: 80vh;
    overflow-y: auto;
    position: relative;
}

.org-details-close {
    position: absolute;
    top: 1rem;
    right: 1rem;
    width: 40px;
    height: 40px;
    border: none;
    background: var(--light-gray);
    border-radius: var(--radius-full);
    cursor: pointer;
    font-size: 1.2rem;
    transition: all var(--transition-fast);
}

.org-details-close:hover {
    background: var(--primary-blue);
    color: white;
}

@media (max-width: 768px) {
    .org-box {
        min-width: 250px;
        padding: 1.5rem;
    }
    
    .org-icon {
        width: 60px;
        height: 60px;
        font-size: 1.5rem;
    }
    
    .org-box h3 {
        font-size: 1.2rem;
    }
}
</style>

<script>
const orgDetails = {
    congress: {
        title: 'Congress',
        icon: 'fa-landmark',
        content: `
            <p>The Congress is the supreme decision-making body of NTUPROBUDCAM. It is convened every four years and brings together delegates from all regional sections.</p>
            <h4>Key Functions:</h4>
            <ul>
                <li>Approves constitutional amendments</li>
                <li>Elects national leadership (President, Vice Presidents, Secretary General, etc.)</li>
                <li>Sets strategic objectives for the union</li>
                <li>Reviews and approves financial reports</li>
                <li>Determines membership fees and dues</li>
                <li>Reviews the union's activities and achievements</li>
            </ul>
            <h4>Composition:</h4>
            <p>Delegates elected from each regional section based on membership numbers, ensuring proportional representation.</p>
        `
    },
    council: {
        title: 'National Council',
        icon: 'fa-users',
        content: `
            <p>The National Council serves as the policy-making body between Congress sessions. It meets at least once a year to review progress and address emerging issues.</p>
            <h4>Key Functions:</h4>
            <ul>
                <li>Implements decisions made by the Congress</li>
                <li>Approves annual budgets and work plans</li>
                <li>Monitors the activities of the Executive Office</li>
                <li>Addresses policy matters affecting members</li>
                <li>Makes decisions on urgent matters between Congress sessions</li>
            </ul>
            <h4>Composition:</h4>
            <p>Members of the Executive Office, regional coordinators, and representatives from each regional section.</p>
        `
    },
    executive: {
        title: 'Executive Office',
        icon: 'fa-cog',
        content: `
            <p>The Executive Office is responsible for the day-to-day administration of the union. It implements policies and manages operations.</p>
            <h4>Key Functions:</h4>
            <ul>
                <li>Daily administration and management of union affairs</li>
                <li>Implementation of programs and activities</li>
                <li>Coordination of member services</li>
                <li>External representation of the union</li>
                <li>Financial management and reporting</li>
                <li>Staff supervision and human resource management</li>
            </ul>
            <h4>Composition:</h4>
            <p>National President, Vice Presidents, Secretary General, Treasurer, and other secretaries as defined in the constitution.</p>
        `
    },
    regional: {
        title: 'Regional Sections',
        icon: 'fa-map-marked-alt',
        content: `
            <p>NTUPROBUDCAM has established regional sections in all ten regions of Cameroon to coordinate activities at the regional level.</p>
            <h4>Key Functions:</h4>
            <ul>
                <li>Coordination of union programs in the region</li>
                <li>Supervision of local units</li>
                <li>Regional advocacy and representation</li>
                <li>Member recruitment and retention</li>
                <li>Implementation of national programs at regional level</li>
                <li>Organization of regional events and activities</li>
            </ul>
            <h4>Coverage:</h4>
            <p>Adamawa, Centre, East, Far North, Littoral, North, Northwest, West, South, and Southwest regions.</p>
        `
    },
    local: {
        title: 'Local Units',
        icon: 'fa-building',
        content: `
            <p>Local Units form the grassroots level of our organization, established in towns and cities across Cameroon.</p>
            <h4>Key Functions:</h4>
            <ul>
                <li>Direct services to members at local level</li>
                <li>Resolution of local issues and conflicts</li>
                <li>Community engagement and outreach</li>
                <li>New member recruitment and orientation</li>
                <li>Collection of membership dues</li>
                <li>Organization of local meetings and activities</li>
            </ul>
            <h4>Establishment:</h4>
            <p>Local units are established in areas with sufficient member concentration, ensuring accessibility for all members.</p>
        `
    }
};

function showOrgDetails(level) {
    const details = orgDetails[level];
    if (!details) return;
    
    const modal = document.getElementById('orgDetails');
    const body = document.getElementById('orgDetailsBody');
    
    body.innerHTML = `
        <div style="text-align: center; margin-bottom: 1.5rem;">
            <i class="fas ${details.icon}" style="font-size: 3rem; color: var(--primary-blue);"></i>
            <h2 style="margin-top: 1rem;">${details.title}</h2>
        </div>
        <div style="line-height: 1.8;">
            ${details.content}
        </div>
    `;
    
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeOrgDetails() {
    const modal = document.getElementById('orgDetails');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// Close modal when clicking outside
document.getElementById('orgDetails').addEventListener('click', function(e) {
    if (e.target === this) {
        closeOrgDetails();
    }
});
</script>

<?php require_once ROOT_PATH . '/includes/footer.php'; ?>
