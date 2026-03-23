<?php
require_once __DIR__ . '/recaptcha-config.php';

$form_submitted = false;
$form_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $subject_field = htmlspecialchars(trim($_POST['subject'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $recaptcha_ok = verifyRecaptcha($_POST['g-recaptcha-response'] ?? '');

    if ($name && $email && $subject_field && $message && $recaptcha_ok) {
        $log_entry = date('Y-m-d H:i:s') . " | Name: $name | Email: $email | Phone: $phone | Subject: $subject_field | Message: $message\n";
        file_put_contents(__DIR__ . '/contact_submissions.log', $log_entry, FILE_APPEND | LOCK_EX);

        require_once __DIR__ . '/mail-config.php';
        $to = 'admin@caad.ac.in';
        $subject = "New Contact Message from $name - $subject_field";
        $body = "New Contact Form Message\n========================\n\nName: $name\nEmail: $email\nPhone: $phone\nSubject: $subject_field\nMessage: $message\n";
        sendMail($to, $subject, $body, $email, $name);

        $form_submitted = true;
    } else {
        $form_error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Contact CAAD Chennai - Address, phone, email, and enquiry form. Located at Parivakkam, Poonamallee Bypass. Next to CMRL Poonamallee Metro Depot, Poonamallee Bypass, near Metro Station.">
    <title>Contact Us | CAAD Chennai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>

<body>
    <?php include 'includes/loader.php'; ?>

    <?php $current_page = 'contact'; include 'includes/nav.php'; ?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Contact</span>
            </div>
            <h1 class="page-title">Contact Us</h1>
            <p class="page-subtitle">We'd love to hear from you</p>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="section">
        <div class="container">
            <div class="contact-grid">
                <!-- Contact Info -->
                <div class="contact-info">
                    <span class="section-label">Get in Touch</span>
                    <h2 class="section-title">Reach Out to Us</h2>
                    <p class="about-text">
                        Have questions about admissions, programs, or campus facilities?
                        Our team is here to help you make the right decision for your future.
                    </p>

                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="contact-text">
                                <h4>Address</h4>
                                <p>CAAD City Campus<br>
                                    Parivakkam, Poonamallee Bypass. Next to CMRL Poonamallee Metro Depot, Poonamallee Bypass<br>
                                    Next to CMRL Poonamallee Metro Depot<br>
                                    Chennai – 600 056</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div class="contact-text">
                                <h4>Phone</h4>
                                <p><a href="tel:+919710554545">+91 97105 54545</a></p>
                                <p><a href="tel:+919710930025">+91 97109 30025</a></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="contact-text">
                                <h4>Email</h4>
                                <p><a href="mailto:admin@caad.ac.in">admin@caad.ac.in</a></p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path
                                        d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                                </svg>
                            </div>
                            <div class="contact-text">
                                <h4>Website</h4>
                                <p><a href="https://caad.ac.in" target="_blank">www.caad.ac.in</a></p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Links -->
                    <div class="social-section">
                        <h4>Follow Us</h4>
                        <div class="social-links-large">
                            <a href="#" class="social-link-lg" aria-label="Facebook">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="#" class="social-link-lg" aria-label="Instagram">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" />
                                </svg>
                            </a>
                            <a href="#" class="social-link-lg" aria-label="YouTube">
                                <svg viewBox="0 0 24 24" fill="currentColor">
                                    <path
                                        d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="contact-form-wrapper">
                    <h3>Send Us a Message</h3>
                    <?php if ($form_submitted): ?>
                    <div class="form-success" style="text-align: center; padding: 3rem 1rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" style="width: 64px; height: 64px; margin: 0 auto 1.5rem;">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <h3 style="color: var(--color-primary); margin-bottom: 0.5rem;">Message Sent!</h3>
                        <p>Thank you for reaching out. We'll get back to you shortly.</p>
                    </div>
                    <?php elseif ($form_error): ?>
                    <div class="form-error" style="background: #fee; border: 1px solid #c00; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; color: #c00; text-align: center;">
                        <p>Something went wrong. Please try again or contact us directly at admin@caad.ac.in</p>
                    </div>
                    <?php endif; ?>

                    <?php if (!$form_submitted): ?>
                    <form class="contact-form" action="contact.php" method="POST">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required placeholder="Enter your name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="+91 XXXXX XXXXX">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject *</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a topic</option>
                                <option value="admissions">Admissions Enquiry</option>
                                <option value="barch">B.Arch Program</option>
                                <option value="nata">NATA Guidance</option>
                                <option value="campus">Campus Visit</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="message">Message *</label>
                            <textarea id="message" name="message" rows="5" required
                                placeholder="How can we help you?"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE_KEY ?>"></div>
                            <p class="recaptcha-required-msg" style="display:none; color:#c00; font-size:0.85rem; margin-top:0.4rem;">Please complete the reCAPTCHA to continue.</p>
                        </div>
                        <button type="submit" class="btn btn-primary" style="width: 100%;">
                            Send Message
                            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M5 12h14M12 5l7 7-7 7" />
                            </svg>
                        </button>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section (Placeholder) -->
    <section class="section" style="background: var(--color-dark-secondary); padding: var(--space-2xl) 0;">
        <div class="container">
            <div class="map-placeholder">
                <div class="map-content">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                        <path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <h3>Find Us on the Map</h3>
                    <p>CAAD City Campus, Parivakkam, Poonamallee Bypass. Next to CMRL Poonamallee Metro Depot, Poonamallee Bypass</p>
                    <p>Near CMRL Poonamallee Metro Depot Station</p>
                    <a href="https://maps.google.com/?q=CAAD+Chennai+Parivakkam" target="_blank"
                        class="btn btn-outline-primary" style="margin-top: 1rem;">
                        Open in Google Maps
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script>
        // Theme Toggle System
        (function () {
            document.documentElement.setAttribute('data-theme', 'light');
        })();

        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            });
        }

        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');
        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });


    </script>
    <script>
        // Remove Loader on Page Load
        window.addEventListener('load', () => {
            const loader = document.getElementById('archLoader');
            if (loader) {
                setTimeout(() => {
                    loader.classList.add('fade-out');
                    setTimeout(() => {
                        loader.style.display = 'none';
                    }, 600);
                }, 1000); // Minimum view time
            }
        });
    </script>
</body>

</html>