<?php
require_once ROOT_PATH . '/config/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <!-- SEO Meta Tags -->
    <title><?= isset($page_title) ? $page_title . ' - ' : '' ?><?= SITE_NAME ?> | <?= SITE_FULL_NAME ?></title>
    <meta name="description" content="<?= isset($page_description) ? $page_description : 'National Trade Union of Professional Bus Drivers of Cameroon - United for Professionalism, Dignity and Safer Road Transport' ?>">
    <meta name="keywords" content="NTUPROBUDCAM, bus drivers, Cameroon, trade union, road safety, professional drivers, transport union">
    <meta name="author" content="<?= SITE_NAME ?>">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph -->
    <meta property="og:title" content="<?= isset($page_title) ? $page_title : SITE_NAME ?>">
    <meta property="og:description" content="<?= isset($page_description) ? $page_description : 'National Trade Union of Professional Bus Drivers of Cameroon' ?>">
    <meta property="og:type" content="website">
    <meta property="og:url" content="<?= SITE_URL . $_SERVER['REQUEST_URI'] ?>">
    <meta property="og:image" content="<?= ASSETS_PATH ?>/images/og-image.jpg">
    <meta property="og:site_name" content="<?= SITE_NAME ?>">
    
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?= isset($page_title) ? $page_title : SITE_NAME ?>">
    <meta name="twitter:description" content="<?= isset($page_description) ? $page_description : 'National Trade Union of Professional Bus Drivers of Cameroon' ?>">
    <meta name="twitter:image" content="<?= ASSETS_PATH ?>/images/og-image.jpg">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="<?= ASSETS_PATH ?>/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= ASSETS_PATH ?>/images/apple-touch-icon.png">
    
    <!-- CSS -->
    <link rel="stylesheet" href="<?= ASSETS_PATH ?>/css/style.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Loading Animation -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
    </div>
    
    <!-- Navigation -->
    <nav class="navbar" id="navbar">
        <div class="container navbar-container">
            <a href="index.php" class="navbar-brand">
                <img src="<?= ASSETS_PATH ?>/images/logo.jpg" alt="<?= SITE_NAME ?> Logo" onerror="this.style.display='none'">
                <span><?= SITE_NAME ?></span>
            </a>
            
            <button class="navbar-toggle" id="navbarToggle" aria-label="Toggle navigation">
                <span></span>
                <span></span>
                <span></span>
            </button>
            
            <ul class="navbar-nav" id="navbarNav">
                <li><a href="index.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : '' ?>">Home</a></li>
                <li><a href="about.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : '' ?>">About</a></li>
                <li><a href="leadership.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'leadership.php' ? 'active' : '' ?>">Leadership</a></li>
                <li><a href="what-we-do.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'what-we-do.php' ? 'active' : '' ?>">What We Do</a></li>
                <li><a href="membership.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'membership.php' ? 'active' : '' ?>">Membership</a></li>
                <li><a href="services.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : '' ?>">Services</a></li>
                <li><a href="news.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'news.php' ? 'active' : '' ?>">News</a></li>
                <li><a href="events.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'events.php' ? 'active' : '' ?>">Events</a></li>
                <li><a href="gallery.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'gallery.php' ? 'active' : '' ?>">Gallery</a></li>
                <li><a href="documents.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'documents.php' ? 'active' : '' ?>">Documents</a></li>
                <li><a href="road-safety.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'road-safety.php' ? 'active' : '' ?>">Road Safety</a></li>
                <li><a href="training.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'training.php' ? 'active' : '' ?>">Training</a></li>
                <li><a href="partners.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'partners.php' ? 'active' : '' ?>">Partners</a></li>
                <li><a href="contact.php" class="nav-link <?= basename($_SERVER['PHP_SELF']) == 'contact.php' ? 'active' : '' ?>">Contact</a></li>
            </ul>
            
            <div class="navbar-extras">
                <div class="lang-switcher">
                    <button class="lang-btn active" data-lang="en">EN</button>
                    <button class="lang-btn" data-lang="fr">FR</button>
                </div>
                <div class="search-bar">
                    <input type="text" class="search-input" placeholder="Search..." id="searchInput">
                    <button class="search-btn" id="searchBtn">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>
