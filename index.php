<?php
require_once __DIR__ . '/recaptcha-config.php';

$enquiry_submitted = false;
$enquiry_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['enquiry_form'])) {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $interest = htmlspecialchars(trim($_POST['interest'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $recaptcha_ok = verifyRecaptcha($_POST['g-recaptcha-response'] ?? '');

    if ($name && $email && $phone && $recaptcha_ok) {
        $log_entry = date('Y-m-d H:i:s') . " | Name: $name | Email: $email | Phone: $phone | Interest: $interest | Message: $message\n";
        file_put_contents(__DIR__ . '/enquiries.log', $log_entry, FILE_APPEND | LOCK_EX);

        require_once __DIR__ . '/mail-config.php';
        $to = 'admin@caad.ac.in';
        $subject = "Quick Enquiry from $name";
        $body = "Quick Enquiry from Website\n==========================\n\nName: $name\nEmail: $email\nPhone: $phone\nInterested In: $interest\nMessage: $message\n";
        sendMail($to, $subject, $body, $email, $name);

        $enquiry_submitted = true;
    } else {
        $enquiry_error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="CAAD - Chennai Academy of Architecture and Design. Premier education for Architecture & Design Excellence in Chennai. Affiliated to Anna University, Approved by Council of Architecture.">
    <title>CAAD | Chennai Academy of Architecture and Design</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link rel="stylesheet" href="styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body class="loading">
    <!-- Page Loader Animation -->
    <div class="page-loader" id="page-loader">
        <div class="loader-content">
            <img src="assets/images/caad_logo_big.jpg" alt="CAAD Logo" class="loader-logo-img">
            <div class="loader-pulse"></div>
            <span class="loader-tagline">Chennai Academy of Architecture & Design</span>
        </div>
    </div>


    <!-- Admissions Announcement Modal -->
    <div class="modal-overlay" id="welcomeModal">
        <div class="modal-content alumni-admission-modal">
            <button class="modal-close" id="closeModal" aria-label="Close modal">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>

            <!-- Campus Image Carousel -->
            <div class="modal-carousel-wrapper">
                <div class="alumni-carousel-track" id="indexCarouselTrack">
                    <div class="alumni-carousel-slide active">
                        <img src="assets/images/uploaded_media_1769327607944.jpg" alt="CAAD Campus Life">
                        <div class="alumni-carousel-caption">
                            <h4>State-of-the-Art Campus</h4>
                            <p>Modern facilities designed to inspire creativity</p>
                        </div>
                    </div>
                    <div class="alumni-carousel-slide">
                        <img src="assets/images/caad-campus-01.jpg" alt="CAAD Architecture Studio">
                        <div class="alumni-carousel-caption">
                            <h4>Design Studios</h4>
                            <p>Where ideas take shape through hands-on practice</p>
                        </div>
                    </div>
                    <div class="alumni-carousel-slide">
                        <img src="assets/images/facilities-common-03.jpg" alt="CAAD Workshop">
                        <div class="alumni-carousel-caption">
                            <h4>Workshops &amp; Labs</h4>
                            <p>Industry-grade tools for real-world learning</p>
                        </div>
                    </div>
                    <div class="alumni-carousel-slide">
                        <img src="assets/images/caad-campus-02.jpg" alt="CAAD Campus View">
                        <div class="alumni-carousel-caption">
                            <h4>Green Campus</h4>
                            <p>A sustainable environment that reflects our values</p>
                        </div>
                    </div>
                    <div class="alumni-carousel-slide">
                        <img src="assets/images/new-building.jpg" alt="CAAD Main Building">
                        <div class="alumni-carousel-caption">
                            <h4>Architectural Excellence</h4>
                            <p>Our building itself is a lesson in design</p>
                        </div>
                    </div>
                    <div class="alumni-carousel-slide">
                        <img src="assets/images/caad-campus-05.jpg" alt="CAAD Events">
                        <div class="alumni-carousel-caption">
                            <h4>Events &amp; Exhibitions</h4>
                            <p>Showcasing student talent and innovation</p>
                        </div>
                    </div>
                </div>
                <!-- Navigation arrows -->
                <button class="alumni-carousel-btn alumni-carousel-prev" id="indexCarouselPrev" aria-label="Previous slide">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="22" height="22"><polyline points="15 18 9 12 15 6"/></svg>
                </button>
                <button class="alumni-carousel-btn alumni-carousel-next" id="indexCarouselNext" aria-label="Next slide">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" width="22" height="22"><polyline points="9 6 15 12 9 18"/></svg>
                </button>
                <!-- Dots indicator -->
                <div class="alumni-carousel-dots" id="indexCarouselDots"></div>
            </div>

            <!-- Modal Info Body -->
            <div class="modal-body">
                <img src="assets/images/caad_logo_big.jpg" alt="CAAD Logo" class="modal-logo">
                <div class="admission-blink-badge">
                    <span class="blink-dot"></span>
                    <span>Admissions Open 2026–2027</span>
                </div>
                <p class="modal-description">B.Arch. - Bachelor of Architecture (5 Years)</p>
                <p>Affiliated to Anna University, Chennai<br>Approved by Council of Architecture, New Delhi</p>
                <div style="margin: 1rem 0; padding: 0.75rem; border-radius: 8px; background: var(--color-primary-light);">
                    <p style="margin: 0; font-size: 0.9rem;"><strong>Counselling Code: 1152</strong></p>
                    <p style="margin: 0.25rem 0 0; font-size: 0.85rem;">NATA / JEE Paper 2 Qualified</p>
                </div>
                <a href="admissions.php#apply" class="btn btn-primary">Apply Now</a>
            </div>
        </div>
    </div>


    <!-- Floating CTA Button -->
    <button class="floating-cta" id="floatingCTA" aria-label="Quick Enquiry">
        <span>Quick Enquiry</span>
    </button>

    <!-- Slide-in Panel -->
    <div class="slide-panel" id="slidePanel">
        <div class="slide-panel-header">
            <h3>Quick Enquiry</h3>
            <button class="panel-close" id="panelClose" aria-label="Close panel">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
        <div class="slide-panel-body">
            <p class="panel-intro">Get in touch with us for admissions, campus tours, or any queries.</p>

            <?php if ($enquiry_submitted): ?>
            <div class="form-success" style="text-align: center; padding: 2rem 1rem;">
                <svg viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" style="width: 48px; height: 48px; margin: 0 auto 1rem;">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <h3 style="color: var(--color-primary); margin-bottom: 0.5rem;">Thank You!</h3>
                <p>Your enquiry has been submitted. We'll contact you shortly.</p>
            </div>
            <?php elseif ($enquiry_error): ?>
            <div class="form-error" style="background: #fee; border: 1px solid #c00; padding: 1rem; border-radius: 8px; margin-bottom: 1rem; color: #c00; text-align: center;">
                <p>Something went wrong. Please try again.</p>
            </div>
            <?php endif; ?>

            <?php if (!$enquiry_submitted): ?>
            <form class="enquiry-form" id="enquiryForm" action="index.php" method="POST">
                <input type="hidden" name="enquiry_form" value="1">
                <div class="form-group">
                    <label for="enquiryName">Full Name</label>
                    <input type="text" id="enquiryName" name="name" required placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="enquiryEmail">Email</label>
                    <input type="email" id="enquiryEmail" name="email" required placeholder="your@email.com">
                </div>

                <div class="form-group">
                    <label for="enquiryPhone">Phone Number</label>
                    <input type="tel" id="enquiryPhone" name="phone" required placeholder="+91 XXXXX XXXXX">
                </div>

                <div class="form-group">
                    <label for="enquiryInterest">Interested In</label>
                    <select id="enquiryInterest" name="interest" required>
                        <option value="">Select a program</option>
                        <option value="b-arch">B.Arch - Architecture</option>
                        <option value="campus-tour">Campus Tour</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="enquiryMessage">Message</label>
                    <textarea id="enquiryMessage" name="message" rows="4" placeholder="Tell us more..."></textarea>
                </div>

                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE_KEY ?>"></div>
                    <p class="recaptcha-required-msg" style="display:none; color:#c00; font-size:0.85rem; margin-top:0.4rem;">Please complete the reCAPTCHA to continue.</p>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Submit Enquiry</button>
            </form>
            <?php endif; ?>

            <div class="panel-contact-info">
                <h4>Or reach us directly</h4>
                <div class="contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    <span>+91 9710930025</span>
                </div>
                <div class="contact-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    <span>admissions@caad.ac.in</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Panel Overlay -->
    <div class="panel-overlay" id="panelOverlay"></div>

    <!-- Media Lightbox -->

    <div id="media-lightbox" class="lightbox">
        <button id="lightbox-close" class="lightbox-close" aria-label="Close Lightbox">&times;</button>
        <div class="lightbox-content-wrapper">
            <div id="lightbox-content" class="lightbox-content">
                <!-- Content injected via JS -->
            </div>
        </div>
    </div>
    <!-- Top Info Bar (Dual-Row Navbar - Row 1) -->
    <div class="top-info-bar" id="topInfoBar">
        <div class="top-bar-container">
            <div class="top-bar-left">
                <a href="tel:+919710930025" class="top-bar-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                    </svg>
                    +91 97109 30025
                </a>
                <div class="top-bar-divider"></div>
                <a href="mailto:admin@caad.ac.in" class="top-bar-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path
                            d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                    admin@caad.ac.in
                </a>
            </div>


            <div class="top-bar-right">
                <a href="https://www.facebook.com/caaborivakkam" target="_blank" class="top-bar-social"
                    aria-label="Facebook">
                    <svg viewBox="0 0 24 24">
                        <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                    </svg>
                </a>
                <a href="https://www.instagram.com/caad_official" target="_blank" class="top-bar-social"
                    aria-label="Instagram">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                    </svg>
                </a>
                <a href="https://www.youtube.com/@caadchennai" target="_blank" class="top-bar-social"
                    aria-label="YouTube">
                    <svg viewBox="0 0 24 24">
                        <path
                            d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                    </svg>
                </a>
            </div>
        </div>
    </div>

    <?php $current_page = 'home'; $nav_scrolled = false; include 'includes/nav.php'; ?>

    <!-- Hero Section - PRESERVED FROM TEMPLATE -->
    <section class="hero" id="hero">
        <!-- Background Image Slider -->
        <div class="hero-slider">
            <div class="hero-slide active"
                style="background-image: url('assets/images/uploaded_media_1769327607944.jpg');"></div>
            <div class="hero-slide" style="background-image: url('assets/images/caad-campus-01.jpg');"></div>
            <div class="hero-slide" style="background-image: url('assets/images/facilities-common-03.jpg');"></div>
            <div class="hero-slide" style="background-image: url('assets/images/caad-campus-02.jpg');"></div>
            <div class="hero-slide" style="background-image: url('assets/images/caad-campus-04.jpg');"></div>
        </div>

        <div class="hero-overlay"></div>

        <div class="hero-content">

            <div class="hero-badge">
                <span class="badge-icon">◆</span>
                <span>Admissions Open 2026</span>
            </div>

            <h1 class="hero-headline">
                Design the<br>Future.
                <span class="headline-accent">Build Your<br>Legacy.</span>
            </h1>

            <p class="hero-subheadline">
                Chennai's premier academy for Architecture & Design Excellence.
            </p>

            <div class="hero-cta-group">
                <a href="admissions.php#apply" class="btn btn-primary" id="cta-apply">
                    Apply Now
                    <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M5 12h14M12 5l7 7-7 7" />
                    </svg>
                </a>
                <a href="courses.php" class="btn btn-secondary" id="cta-explore">
                    Explore Courses
                </a>
            </div>

            <div class="hero-stats">
                <div class="stat-item">
                    <span class="stat-number">12+</span>
                    <span class="stat-label">Years of Excellence</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Alumni Network</span>
                </div>
                <div class="stat-divider"></div>
                <div class="stat-item">
                    <span class="stat-number">100%</span>
                    <span class="stat-label">Placement Rate</span>
                </div>
            </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="scroll-indicator">
            <span>Scroll to explore</span>
            <div class="scroll-line"></div>
        </div>
    </section>

    <!-- About Preview Section -->
    <section class="section about" id="about">
        <div class="container">
            <!-- Centered Header -->
            <div class="section-header">
                <span class="section-label">About CAAD</span>
                <h2 class="section-title">Shaping Architects & Designers Since 2014</h2>
            </div>

            <div class="about-grid">
                <div class="about-content">

                    <div class="about-features">

                        <a href="#" class="feature-item" data-image="assets/images/coa.jpg">
                            <div class="feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path
                                        d="M12 14l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z" />
                                    <path d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path d="M12 14v7" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h4>COA Accredited</h4>
                                <p>Council of Architecture approved programs</p>
                            </div>
                            <div class="feature-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                        <a href="#" class="feature-item" data-image="assets/images/Anna_University_Logo.png">
                            <div class="feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h4>Anna University</h4>
                                <p>Affiliated to Anna University, Chennai</p>
                            </div>
                            <div class="feature-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                        <a href="#" class="feature-item" data-image="assets/images/caad-campus-01.jpg">
                            <div class="feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h4>International MOUs</h4>
                                <p>Exchange programs with global universities</p>
                            </div>
                            <div class="feature-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                        <a href="#" class="feature-item" data-image="assets/images/facilities-common-03.jpg">
                            <div class="feature-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="feature-text">
                                <h4>Expert Faculty</h4>
                                <p>Faculty from leading design firms and practices</p>
                            </div>
                            <div class="feature-arrow">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 12h14M12 5l7 7-7 7" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- About Image Panel -->
                <div class="about-image" id="aboutImage">
                    <div class="about-image-wrapper">
                        <img src="assets/images/caad-campus-01.jpg" alt="CAAD Campus" id="aboutImageSrc">
                    </div>
                    <div class="about-image-accent"></div>
                </div>

            </div>
        </div>
    </section>


    <!-- Stacking Cards Section -->
    <section class="stacking-section" id="why-caad">
        <div class="container">
            <div class="section-header">
                <span class="section-label">ADMISSIONS OPEN FOR THE ACADEMIC YEAR 2025 – 26</span>
                <h2 class="section-title">Pathways to Creative Excellence</h2>
            </div>

            <div class="stacking-cards-container">
                <!-- Card 1 -->
                <div class="stacking-card">
                    <div class="card-inner">
                        <div class="card-content">
                            <div class="card-number">01</div>
                            <h3>B.Arch. (5 Years)</h3>
                            <div class="card-details">
                                <p><strong>Course Title:</strong> Bachelor of Architecture</p>
                                <p><strong>Eligibility:</strong> Candidates must have passed 12th or a Diploma
                                    qualification. The applicant should have taken Maths as a subject of study in the
                                    12th grade or in the Diploma.</p>
                                <p>The applicant should have cleared the NATA 2024 or JEE Paper II.</p>
                            </div>
                        </div>
                        <div class="card-image">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.51 AM.jpeg" alt="B.Arch">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- Management Team Section -->
    <section class="section management" id="management">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Our Leadership</span>
                <h2 class="section-title">Management Team</h2>
                <p class="section-subtitle">
                    Guided by visionary leaders committed to excellence in architecture education
                </p>
            </div>

            <div class="management-grid">
                <!-- Trust Card -->
                <article class="management-card trust-card">
                    <div class="trust-card-inner">
                        <div class="trust-logo-wrap">
                            <img src="assets/images/caad_logo_big.jpg" alt="CAAD Logo" class="trust-logo">
                        </div>
                        <div class="trust-divider"></div>
                        <div class="trust-info">
                            <p class="trust-label">A Unit of</p>
                            <h3 class="trust-name">Srinivasa Educational Trust</h3>
                            <p class="trust-group">Jaya Group of Institutions</p>
                            <div class="trust-tags">
                                <span class="trust-tag">COA Approved</span>
                                <span class="trust-tag">Anna University Affiliated</span>
                                <span class="trust-tag">Counselling Code: 1152</span>
                            </div>
                            <div class="trust-highlights">
                                <div class="trust-highlight-item">
                                    <span class="highlight-icon">&#10003;</span>
                                    Anna University Rank Holders — Batches 2019–2025 incl. Gold Medallists
                                </div>
                                <div class="trust-highlight-item">
                                    <span class="highlight-icon">&#10003;</span>
                                    Students placed in 300+ Architectural &amp; Allied companies
                                </div>
                                <div class="trust-highlight-item">
                                    <span class="highlight-icon">&#10003;</span>
                                    International Studios in Singapore, Malaysia, Thailand &amp; China
                                </div>
                                <div class="trust-highlight-item">
                                    <span class="highlight-icon">&#10003;</span>
                                    Maximum enrolment in national &amp; international Masters programmes
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Director -->
                <article class="management-card director-card">
                    <div class="director-inner">
                        <div class="director-image-wrap">
                            <img src="assets/images/director_new.jpg" alt="Prof. Vinodh Vijayakumar">
                        </div>
                        <div class="director-content">
                            <p class="director-label">Director</p>
                            <h3 class="director-name">Prof. Vinodh Vijayakumar</h3>
                            <p class="director-credentials">M.Arch, Ph.D</p>
                            <blockquote class="director-vision">
                                "At CAAD, we believe architecture is not just about buildings — it is about shaping the human experience. Our mission is to cultivate designers who think critically, create boldly, and lead with purpose."
                            </blockquote>
                            <div class="director-highlights">
                                <div class="director-stat">
                                    <span class="stat-num">20+</span>
                                    <span class="stat-label">Years in Architecture Education</span>
                                </div>
                                <div class="director-stat">
                                    <span class="stat-num">5+</span>
                                    <span class="stat-label">International Collaborations</span>
                                </div>
                                <div class="director-stat">
                                    <span class="stat-num">1000+</span>
                                    <span class="stat-label">Students Mentored</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="section testimonials" id="testimonials">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Student Stories</span>
                <h2 class="section-title">What Our Students Say</h2>
                <p class="section-subtitle">
                    Hear from the architects and designers who started their journey at CAAD
                </p>
            </div>

            <div class="testimonials-grid">
                <!-- Testimonial 1 -->
                <article class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                        <p class="testimonial-text">
                            "CAAD provided me with an excellent learning environment. The faculty are supportive and
                            the
                            studio culture pushed me to think beyond conventional design."
                        </p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">VD</div>
                        <div class="author-info">
                            <h4 class="author-name">Varshni D</h4>
                            <p class="author-title">Architecture Student</p>
                            <p class="author-batch">B.Arch, Current Batch</p>
                        </div>
                    </div>
                </article>

                <!-- Testimonial 2 -->
                <article class="testimonial-card featured">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                        <p class="testimonial-text">
                            "The rigorous academic program and hands-on experience at CAAD helped me achieve
                            the Anna University Gold Medal. Forever grateful to my faculty."
                        </p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">B</div>
                        <div class="author-info">
                            <h4 class="author-name">Burhanuddin</h4>
                            <p class="author-title">Anna University Gold Medalist</p>
                            <p class="author-batch">B.Arch Graduate</p>
                        </div>
                    </div>
                </article>

                <!-- Testimonial 3 -->
                <article class="testimonial-card">
                    <div class="testimonial-content">
                        <div class="quote-icon">
                            <svg viewBox="0 0 24 24" fill="currentColor">
                                <path
                                    d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z" />
                            </svg>
                        </div>
                        <p class="testimonial-text">
                            "What I love about CAAD is the supportive environment and the focus on holistic
                            development.
                            The studio work and critiques made me a better designer."
                        </p>
                    </div>
                    <div class="testimonial-author">
                        <div class="author-avatar">MM</div>
                        <div class="author-info">
                            <h4 class="author-name">Monica M</h4>
                            <p class="author-title">Interior Designer</p>
                            <p class="author-batch">CAAD Graduate</p>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>


    <!-- Campus Section -->
    <section class="section campus" id="campus">
        <div class="container">
            <!-- Centered Header -->
            <div class="section-header">
                <span class="section-label">Our Campus</span>
                <h2 class="section-title">New City Campus at Parivakkam</h2>
            </div>

            <div class="campus-grid">
                <div class="campus-content">
                    <p class="campus-text">
                        CAAD has moved to a bigger, vibrant City Campus at Parivakkam, Poonamallee Bypass. Next to CMRL Poonamallee Metro Depot, Poonamallee Bypass,
                        next to the CMRL Poonamallee Metro Depot Station. Our state-of-the-art facilities
                        are designed to inspire creativity.
                    </p>

                    <div class="campus-features">
                        <div class="campus-feature">
                            <span class="feature-number">A/C</span>
                            <span class="feature-label">Smart Classrooms</span>
                        </div>
                        <div class="campus-feature">
                            <span class="feature-number">3</span>
                            <span class="feature-label">Workshop Labs</span>
                        </div>
                        <div class="campus-feature">
                            <span class="feature-number">1</span>
                            <span class="feature-label">Materials Museum</span>
                        </div>
                        <div class="campus-feature">
                            <span class="feature-number">2</span>
                            <span class="feature-label">Hostels (M/F)</span>
                        </div>
                    </div>

                    <a href="facilities.php" class="btn btn-primary">
                        Explore Campus
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="campus-images">
                    <div class="campus-slideshow">
                        <div class="campus-slides">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.51 AM.jpeg" alt="CAAD Campus" class="campus-slide active">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.15 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.16 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.47 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.16.16 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.16.17 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.16.17 AM (1).jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.16.17 AM (2).jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.16.18 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.16.18 AM (1).jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.16.18 AM (2).jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.41 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.43 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.43 AM (1).jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.45 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.45 AM (1).jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.46 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.48 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.50 AM.jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.50 AM (1).jpeg" alt="CAAD Campus" class="campus-slide">
                            <img src="assets/images/WhatsApp Image 2026-03-18 at 10.40.50 AM (2).jpeg" alt="CAAD Campus" class="campus-slide">
                        </div>
                        <button class="campus-slide-prev" onclick="campusSlide(-1)">&#8249;</button>
                        <button class="campus-slide-next" onclick="campusSlide(1)">&#8250;</button>
                        <div class="campus-slide-dots" id="campusDots"></div>
                    </div>
                    <div class="campus-quick-facts">
                        <div class="campus-fact-item">
                            <span class="campus-fact-icon">&#128205;</span>
                            <div>
                                <strong>Location</strong>
                                <span>Parivakkam, Poonamallee Bypass. Next to CMRL Poonamallee Metro Depot, Chennai</span>
                            </div>
                        </div>
                        <div class="campus-fact-item">
                            <span class="campus-fact-icon">&#128650;</span>
                            <div>
                                <strong>Metro Access</strong>
                                <span>Near CMRL Depot Station</span>
                            </div>
                        </div>
                        <div class="campus-fact-item">
                            <span class="campus-fact-icon">&#127968;</span>
                            <div>
                                <strong>Campus Type</strong>
                                <span>Dedicated City Campus</span>
                            </div>
                        </div>
                        <div class="campus-fact-item">
                            <span class="campus-fact-icon">&#9728;</span>
                            <div>
                                <strong>Studio Space</strong>
                                <span>Purpose-built Design Labs</span>
                            </div>
                        </div>
                    </div>
                    <div class="campus-image-caption">
                        <span class="caption-icon">&#9654;</span>
                        <p>Our <strong>Architecture Design Studio</strong> at the Parivakkam City Campus — a sprawling, light-filled space where students bring structural ideas to life through physical models, collaborative critique, and hands-on design exploration.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Video Gallery Section -->
    <section class="section videos" id="videos">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Campus Life</span>
                <h2 class="section-title">Experience CAAD</h2>
                <p class="section-subtitle">
                    Discover our campus, facilities, and vibrant student community through our video gallery
                </p>
            </div>

            <div class="video-grid">
                <!-- Main Featured Video -->
                <div class="video-card video-featured">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/3cu12Iiwz-c" title="CAAD Introduction"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Welcome to CAAD</h3>
                        <p class="video-description">Discover our exclusive facilities, international study
                            opportunities, hands-on workshops, and vibrant student life.</p>
                    </div>
                </div>

                <!-- Secondary Videos -->
                <div class="video-card">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/v_9PL79ClCY" title="CAAD Facilities" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Best Infrastructure for B.Arch</h3>
                        <p class="video-description">Explore our world-class facilities designed for architecture
                            and
                            design education.</p>
                    </div>
                </div>

                <div class="video-card">
                    <div class="video-wrapper">
                        <iframe src="https://www.youtube.com/embed/gQUWFpgjb7g" title="CAAD Lecture Series"
                            frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                    <div class="video-info">
                        <h3 class="video-title">Guest Lecture Series</h3>
                        <p class="video-description">Learn from renowned architects and design experts from around
                            the
                            world.</p>
                    </div>
                </div>
            </div>

            <div class="video-cta">
                <a href="https://www.youtube.com/@CAADCHENNAIARCHITECTURE" target="_blank" rel="noopener noreferrer"
                    class="btn btn-outline-primary">
                    <svg class="btn-icon-left" viewBox="0 0 24 24" fill="currentColor" width="20" height="20">
                        <path
                            d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                    </svg>
                    View All Videos on YouTube
                </a>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="section cta-section" id="apply">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Start Your Design Journey?</h2>
                <p class="cta-text">
                    Join Chennai's most trusted architecture and design academy. Applications for 2025-26 are now
                    open.
                    <strong>Anna University Counselling Code: 1152</strong>
                </p>
                <div class="cta-buttons">
                    <a href="admissions.php#apply" class="btn btn-white">
                        Apply Now
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </a>
                    <a href="contact.php" class="btn btn-outline-white">Enquire Now</a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script>
        // ============================================
        // CAAD Premium Animation System
        // Elegant, architectural motion design
        // ============================================

        // ============================================
        // PAGE LOADER EXIT
        // ============================================
        window.addEventListener('load', () => {
            setTimeout(() => {
                const loader = document.getElementById('page-loader');
                if (loader) {
                    loader.classList.add('loaded');
                }
                document.body.classList.remove('loading');
            }, 2200); // Wait for SVG animations to complete
        });

        // ============================================
        // THEME TOGGLE SYSTEM
        // ============================================
        (function () {
            document.documentElement.setAttribute('data-theme', 'light');
        })();

        document.addEventListener('DOMContentLoaded', () => {
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', () => {
                    const currentTheme = document.documentElement.getAttribute('data-theme');
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                    document.documentElement.setAttribute('data-theme', newTheme);
                    localStorage.setItem('theme', newTheme);
                });
            }
        });

        // Navbar scroll effect with smooth transitions + Top Info Bar collapse
        const navbar = document.getElementById('navbar');
        const topInfoBar = document.getElementById('topInfoBar');
        let lastScroll = 0;

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;

            if (currentScroll > 100) {
                navbar.classList.add('scrolled');
                if (topInfoBar) topInfoBar.classList.add('hidden');
            } else {
                navbar.classList.remove('scrolled');
                if (topInfoBar) topInfoBar.classList.remove('hidden');
            }

            lastScroll = currentScroll;
        });

        // Mobile menu toggle
        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');

        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });

        // Smooth scroll for anchor links with easing
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                        // Close mobile menu if open
                        navMenu.classList.remove('active');
                        navToggle.classList.remove('active');
                    }
                }
            });
        });

        // ============================================
        // LIGHTBOX SYSTEM
        // ============================================
        const lightbox = document.getElementById('media-lightbox');
        const lightboxContent = document.getElementById('lightbox-content');
        const lightboxClose = document.getElementById('lightbox-close');

        // Function to open lightbox
        function openLightbox(content) {
            lightboxContent.innerHTML = ''; // Clear previous content
            lightboxContent.appendChild(content);
            lightbox.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        // Function to close lightbox
        function closeLightbox() {
            lightbox.classList.remove('active');
            setTimeout(() => {
                lightboxContent.innerHTML = ''; // Cleanup after animation
            }, 300);
            document.body.style.overflow = '';
        }

        // Close events
        lightboxClose.addEventListener('click', closeLightbox);
        lightbox.addEventListener('click', (e) => {
            if (e.target === lightbox || e.target.classList.contains('lightbox-content-wrapper')) {
                closeLightbox();
            }
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && lightbox.classList.contains('active')) {
                closeLightbox();
            }
        });

        // 1. Advisory Board Images
        document.querySelectorAll('.advisory-image img').forEach(img => {
            img.parentElement.addEventListener('click', () => {
                const clone = img.cloneNode();
                openLightbox(clone);
            });
        });

        // 2. Video Gallery
        document.querySelectorAll('.video-expand-btn').forEach(btn => {
            btn.addEventListener('click', (e) => {
                const wrapper = btn.closest('.video-wrapper');
                const iframe = wrapper.querySelector('iframe');
                if (iframe) {
                    const clone = iframe.cloneNode();
                    // Auto-play in modal if desired, or just show
                    openLightbox(clone);
                }
            });
        });


        // Configure reveal animations for different element types
        const revealConfig = {
            // Section headers get slow fade up
            sectionHeaders: {
                selector: '.section-header',
                class: 'reveal-fade-up-slow'
            },
            // Cards get fade up with stagger
            cards: {
                selector: '.course-card, .testimonial-card, .management-card, .collaboration-card, .award-card, .placement-category, .advisory-card',
                class: 'reveal-fade-up',
                stagger: true
            },
            // About content slides from left
            aboutContent: {
                selector: '.about-content',
                class: 'reveal-slide-left'
            },
            // About image slides from right
            aboutImage: {
                selector: '.about-image',
                class: 'reveal-slide-right'
            },
            // Campus content slides from left
            campusContent: {
                selector: '.campus-content',
                class: 'reveal-slide-left'
            },
            // Campus images slide from right
            campusImages: {
                selector: '.campus-images',
                class: 'reveal-slide-right'
            },
            // Feature items fade up with stagger
            features: {
                selector: '.feature-item, .campus-feature',
                class: 'reveal-fade-up',
                stagger: true
            },
            // CTA content
            cta: {
                selector: '.cta-content',
                class: 'reveal-fade-up-slow'
            },
            // Footer columns
            footer: {
                selector: '.footer-brand, .footer-links, .footer-contact',
                class: 'reveal-fade-up',
                stagger: true
            }
        };

        // Apply reveal classes to elements
        function initializeRevealElements() {
            Object.values(revealConfig).forEach(config => {
                const elements = document.querySelectorAll(config.selector);
                elements.forEach((el, index) => {
                    el.classList.add(config.class);

                    // Add stagger delay classes for grouped items
                    if (config.stagger) {
                        const staggerIndex = (index % 6) + 1;
                        el.classList.add(`stagger-${staggerIndex}`);
                    }
                });
            });
        }

        // Intersection Observer for scroll reveal
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -80px 0px'
        });

        // Observe all reveal elements
        function observeRevealElements() {
            const revealSelectors = Object.values(revealConfig)
                .map(c => c.selector)
                .join(', ');

            document.querySelectorAll(revealSelectors).forEach(el => {
                revealObserver.observe(el);
            });
        }

        // ============================================
        // PARALLAX EFFECT
        // ============================================

        // Campus Slideshow
        (function() {
            const slides = document.querySelectorAll('.campus-slide');
            const dotsContainer = document.getElementById('campusDots');
            let current = 0;
            let timer;

            slides.forEach((_, i) => {
                const dot = document.createElement('span');
                dot.className = 'dot' + (i === 0 ? ' active' : '');
                dot.onclick = () => goTo(i);
                dotsContainer.appendChild(dot);
            });

            function goTo(n) {
                slides[current].classList.remove('active');
                dotsContainer.children[current].classList.remove('active');
                current = (n + slides.length) % slides.length;
                slides[current].classList.add('active');
                dotsContainer.children[current].classList.add('active');
            }

            window.campusSlide = function(dir) {
                clearInterval(timer);
                goTo(current + dir);
                timer = setInterval(() => goTo(current + 1), 3500);
            };

            timer = setInterval(() => goTo(current + 1), 3500);
        })();

        function initParallax() {
            // Parallax disabled to prevent image shifting on scroll
        }



        // ============================================
        // STATS COUNTER ANIMATION
        // ============================================

        function animateStats() {
            const stats = document.querySelectorAll('.stat-number');

            const statsObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const stat = entry.target;
                        const text = stat.textContent;
                        const numMatch = text.match(/(\d+)/);

                        if (numMatch) {
                            const target = parseInt(numMatch[1]);
                            const suffix = text.replace(numMatch[0], '');
                            let current = 0;
                            const duration = 2000;
                            const increment = target / (duration / 16);

                            const timer = setInterval(() => {
                                current += increment;
                                if (current >= target) {
                                    clearInterval(timer);
                                    stat.textContent = text;
                                } else {
                                    stat.textContent = Math.floor(current) + suffix;
                                }
                            }, 16);
                        }

                        statsObserver.unobserve(stat);
                    }
                });
            }, { threshold: 0.5 });

            stats.forEach(stat => statsObserver.observe(stat));
        }

        // ============================================
        // INITIALIZE ALL ANIMATIONS
        // ============================================


        document.addEventListener('DOMContentLoaded', () => {
            // Initialize reveal system
            initializeRevealElements();
            observeRevealElements();

            // Initialize parallax
            initParallax();

            // Initialize stats animation
            animateStats();

            // Initialize hero slider
            initHeroSlider();

            // Initialize stacking cards
            // initStackingCards();

            // Show welcome modal after loader
            setTimeout(() => {
                const modal = document.getElementById('welcomeModal');
                if (modal) {
                    modal.classList.add('active');
                }
            }, 2500); // Show after loader finishes
        });

        // Hero Slider
        function initHeroSlider() {
            const slides = document.querySelectorAll('.hero-slide');
            let currentSlide = 0;

            function nextSlide() {
                slides[currentSlide].classList.remove('active');
                currentSlide = (currentSlide + 1) % slides.length;
                slides[currentSlide].classList.add('active');
            }

            // Auto-advance every 5 seconds
            setInterval(nextSlide, 5000);
        }

        // Stacking Cards Animation
        function initStackingCards() {
            const section = document.querySelector('.stacking-section');
            if (!section) return;

            const cards = document.querySelectorAll('.stacking-card');
            const cardsArray = Array.from(cards);

            window.addEventListener('scroll', () => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.offsetHeight;
                const scrollPos = window.scrollY + window.innerHeight;

                // Calculate how far through the section we are
                const sectionProgress = (scrollPos - sectionTop) / sectionHeight;

                if (sectionProgress >= 0 && sectionProgress <= 1) {
                    cards.forEach((card, index) => {
                        // Calculate when this card should start stacking
                        const cardStart = index / cards.length;
                        const cardEnd = (index + 1) / cards.length;

                        // Progress for this specific card (0 to 1)
                        const cardProgress = Math.max(0, Math.min(1,
                            (sectionProgress - cardStart) / (cardEnd - cardStart)
                        ));

                        // Cards stack from bottom to top
                        // Earlier cards stick, later cards slide over them
                        if (cardProgress < 1) {
                            // Card is still moving/stacking
                            const scale = 0.9 + (cardProgress * 0.1);
                            const yOffset = (1 - cardProgress) * 100;

                            card.style.transform = `translateX(-50%) translateY(${yOffset}px) scale(${scale})`;
                            card.style.opacity = 0.5 + (cardProgress * 0.5);
                        } else {
                            // Card is fully stacked
                            card.style.transform = `translateX(-50%) translateY(0) scale(1)`;
                            card.style.opacity = 1;
                        }

                        // Set z-index so cards stack on top of each other
                        card.style.zIndex = index + 1;
                    });
                }
            });
        }

        // Modal close functionality
        const closeModalBtn = document.getElementById('closeModal');
        const modalOverlay = document.getElementById('welcomeModal');

        if (closeModalBtn) {
            closeModalBtn.addEventListener('click', () => {
                modalOverlay.classList.remove('active');
            });
        }

        if (modalOverlay) {
            modalOverlay.addEventListener('click', (e) => {
                if (e.target === modalOverlay) {
                    modalOverlay.classList.remove('active');
                }
            });
        }

        // Feature image switching
        const featureItems = document.querySelectorAll('.feature-item[data-image]');
        const aboutImageWrapper = document.getElementById('aboutImage');
        const aboutImageEl = document.getElementById('aboutImageSrc');

        featureItems.forEach(item => {
            item.addEventListener('click', (e) => {
                e.preventDefault();

                const newImageSrc = item.getAttribute('data-image');

                if (aboutImageEl && newImageSrc) {
                    // Fade out
                    aboutImageEl.style.opacity = '0';
                    aboutImageEl.style.transition = 'opacity 0.3s ease';

                    // Change image after fade
                    setTimeout(() => {
                        aboutImageEl.src = newImageSrc;
                        // Fade in
                        aboutImageEl.style.opacity = '1';
                    }, 300);
                }

                // Remove active class from all items
                featureItems.forEach(f => f.classList.remove('active'));
                // Add active class to clicked item
                item.classList.add('active');
            });
        });

        // Slide Panel functionality
        const floatingCTA = document.getElementById('floatingCTA');
        const slidePanel = document.getElementById('slidePanel');
        const panelClose = document.getElementById('panelClose');
        const panelOverlay = document.getElementById('panelOverlay');
        const enquiryForm = document.getElementById('enquiryForm');

        function openPanel() {
            slidePanel.classList.add('active');
            panelOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closePanel() {
            slidePanel.classList.remove('active');
            panelOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (floatingCTA) {
            floatingCTA.addEventListener('click', openPanel);
        }

        if (panelClose) {
            panelClose.addEventListener('click', closePanel);
        }

        if (panelOverlay) {
            panelOverlay.addEventListener('click', closePanel);
        }

        if (enquiryForm) {
            enquiryForm.addEventListener('submit', (e) => {
                e.preventDefault();
                alert('Thank you for your enquiry! We will get back to you soon.');
                enquiryForm.reset();
                closePanel();
            });
        }

    </script>

    <script>
        // Index Page Modal Carousel System
        (function () {
            const track = document.getElementById('indexCarouselTrack');
            if (!track) return;

            const slides = track.querySelectorAll('.alumni-carousel-slide');
            const dotsContainer = document.getElementById('indexCarouselDots');
            const prevBtn = document.getElementById('indexCarouselPrev');
            const nextBtn = document.getElementById('indexCarouselNext');

            let currentIndex = 0;
            let autoplayInterval = null;
            const AUTOPLAY_DELAY = 4500;

            // Create dots
            slides.forEach((_, i) => {
                const dot = document.createElement('button');
                dot.classList.add('alumni-carousel-dot');
                if (i === 0) dot.classList.add('active');
                dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
                dot.addEventListener('click', () => goToSlide(i));
                dotsContainer.appendChild(dot);
            });

            // Create progress bar
            const progressBar = document.createElement('div');
            progressBar.classList.add('alumni-carousel-progress');
            track.parentElement.appendChild(progressBar);

            function goToSlide(index) {
                slides[currentIndex].classList.remove('active');
                dotsContainer.children[currentIndex].classList.remove('active');
                currentIndex = index;
                slides[currentIndex].classList.add('active');
                dotsContainer.children[currentIndex].classList.add('active');
                resetProgress();
            }

            function nextSlide() { goToSlide((currentIndex + 1) % slides.length); }
            function prevSlide() { goToSlide((currentIndex - 1 + slides.length) % slides.length); }

            // Progress bar animation via RAF
            let progressStart = null;
            let progressRAF = null;

            function animateProgress(timestamp) {
                if (!progressStart) progressStart = timestamp;
                const progress = Math.min((timestamp - progressStart) / AUTOPLAY_DELAY, 1);
                progressBar.style.width = (progress * 100) + '%';
                if (progress < 1) progressRAF = requestAnimationFrame(animateProgress);
            }

            function resetProgress() {
                progressStart = null;
                progressBar.style.width = '0%';
                if (progressRAF) cancelAnimationFrame(progressRAF);
                progressRAF = requestAnimationFrame(animateProgress);
            }

            function startAutoplay() {
                stopAutoplay();
                resetProgress();
                autoplayInterval = setInterval(nextSlide, AUTOPLAY_DELAY);
            }

            function stopAutoplay() {
                if (autoplayInterval) clearInterval(autoplayInterval);
                if (progressRAF) cancelAnimationFrame(progressRAF);
            }

            prevBtn.addEventListener('click', () => { prevSlide(); startAutoplay(); });
            nextBtn.addEventListener('click', () => { nextSlide(); startAutoplay(); });

            // Pause on hover
            const carousel = track.parentElement;
            carousel.addEventListener('mouseenter', stopAutoplay);
            carousel.addEventListener('mouseleave', startAutoplay);

            // Touch swipe support
            let touchStartX = 0;
            carousel.addEventListener('touchstart', (e) => {
                touchStartX = e.changedTouches[0].screenX;
                stopAutoplay();
            }, { passive: true });
            carousel.addEventListener('touchend', (e) => {
                const diff = touchStartX - e.changedTouches[0].screenX;
                if (Math.abs(diff) > 50) { if (diff > 0) nextSlide(); else prevSlide(); }
                startAutoplay();
            }, { passive: true });

            startAutoplay();
        })();
    </script>
</body>

</html>