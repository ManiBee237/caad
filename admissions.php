<?php
$form_submitted = false;
$form_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $program = htmlspecialchars(trim($_POST['program'] ?? ''));
    $qualification = htmlspecialchars(trim($_POST['qualification'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    if ($name && $email && $phone && $program) {
        // Save submission to log file
        $log_entry = date('Y-m-d H:i:s') . " | Name: $name | Email: $email | Phone: $phone | Program: $program | Qualification: $qualification | Message: $message\n";
        file_put_contents(__DIR__ . '/admissions_submissions.log', $log_entry, FILE_APPEND | LOCK_EX);

        require_once __DIR__ . '/mail-config.php';
        $to = 'admin@caad.ac.in';
        $subject = "New Admission Enquiry from $name";
        $body = "New Admission Enquiry\n=====================\n\nName: $name\nEmail: $email\nPhone: $phone\nProgram: $program\nQualification: $qualification\nMessage: $message\n";
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
        content="Admissions at CAAD Chennai - Apply for B.Arch program. Anna University Counselling Code 1152. Admissions open for 2025-26.">
    <title>Admissions | CAAD Chennai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- Premium Architectural Loader -->
    <div class="arch-loader-overlay" id="archLoader">
        <div class="iso-city">
            <!-- 9 Blocks for a 3x3 Grid -->
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
            <div class="iso-block">
                <div class="side front"></div>
                <div class="side back"></div>
                <div class="side right"></div>
                <div class="side left"></div>
                <div class="side top"></div>
                <div class="side bottom"></div>
            </div>
        </div>
        <div class="loader-text-container">
            <h2 class="loader-title">Building Dreams</h2>
            <p class="loader-subtitle">Chennai Academy of Architecture & Design</p>
        </div>
    </div>

    <!-- Navigation -->
    <header class="navbar scrolled" id="navbar">
        <div class="nav-container">
            <a href="index.php" class="nav-logo">
                <img src="assets/images/caad_logo_big.jpg" alt="CAAD Logo" class="logo-img">
                <span class="logo-tagline">Chennai Academy of Architecture & Design</span>
            </a>

            <nav class="nav-menu" id="nav-menu">
                <a href="about.php" class="nav-link">About</a>
                <a href="b-arch.php" class="nav-link">Courses</a>
                <a href="admissions.php" class="nav-link active">Admissions</a>
                <div class="nav-dropdown">
                    <a href="facilities.php" class="nav-link nav-link-dropdown">
                        Facilities
                        <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </a>
                    <div class="dropdown-menu">
                        <a href="international-exposure.php" class="dropdown-item">International Exposure</a>
                        <a href="leisure-lifestyle.php" class="dropdown-item">Leisure & Lifestyle at CAAD</a>
                        <a href="campus.php" class="dropdown-item">Campus</a>
                        <a href="lab-facilities.php" class="dropdown-item">Lab Facilities & Workshops</a>
                        <a href="library.php" class="dropdown-item">Library</a>
                        <a href="transport.php" class="dropdown-item">Transport</a>
                        <a href="hostel.php" class="dropdown-item">Hostel</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <a href="placement.php" class="nav-link nav-link-dropdown">
                        Placement
                        <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </a>
                    <div class="dropdown-menu">
                        <a href="job-placement.php" class="dropdown-item">Job Placement</a>
                        <a href="internship-placement.php" class="dropdown-item">Internship Placement</a>
                        <a href="higher-education.php" class="dropdown-item">Higher Education</a>
                        <a href="openings.php" class="dropdown-item">Openings</a>
                    </div>
                </div>
                <a href="alumni.php" class="nav-link">Alumni</a>
                <a href="events.php" class="nav-link">Events</a>
                <a href="contact.php" class="nav-link">Contact</a>
                <a href="admissions.php" class="nav-link">NATA</a>
            </nav>

            <div class="nav-actions">
                <a href="admissions.php#apply" class="btn btn-nav">Apply Now</a>
                <button class="nav-toggle" id="nav-toggle" aria-label="Toggle menu">
                    <span class="hamburger"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Admissions</span>
            </div>
            <h1 class="page-title">Admissions 2025-26</h1>
            <p class="page-subtitle">Begin your journey in architecture and design</p>
        </div>
    </section>

    <!-- Enquiry Form -->
    <section class="section" id="apply" style="background: var(--color-dark-secondary);">
        <div class="container">
            <div class="form-section">
                <div class="form-header">
                    <span class="section-label">Enquire Now</span>
                    <h2 class="section-title">Start Your Application</h2>
                    <p class="section-subtitle">Fill in your details and our admissions team will get in touch</p>
                </div>

                <?php if ($form_submitted): ?>
                <div class="form-success" style="text-align: center; padding: 3rem 1rem;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="var(--color-primary)" stroke-width="2" style="width: 64px; height: 64px; margin: 0 auto 1.5rem;">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <h3 style="color: var(--color-primary); margin-bottom: 0.5rem;">Thank You!</h3>
                    <p>Your enquiry has been submitted successfully. Our admissions team will contact you shortly.</p>
                </div>
                <?php elseif ($form_error): ?>
                <div class="form-error" style="background: #fee; border: 1px solid #c00; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; color: #c00; text-align: center;">
                    <p>Something went wrong. Please try again or contact us directly at admin@caad.ac.in</p>
                </div>
                <?php endif; ?>

                <?php if (!$form_submitted): ?>
                <form class="enquiry-form" action="admissions.php#apply" method="POST">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="name">Full Name *</label>
                            <input type="text" id="name" name="name" required placeholder="Enter your full name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" required placeholder="Enter your email">
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number *</label>
                            <input type="tel" id="phone" name="phone" required placeholder="+91 XXXXX XXXXX">
                        </div>
                        <div class="form-group">
                            <label for="program">Program Interested In *</label>
                            <select id="program" name="program" required>
                                <option value="">Select a program</option>
                                <option value="barch">B.Arch Architecture (5 Years)</option>
                            </select>
                        </div>
                        <div class="form-group full-width">
                            <label for="qualification">Current Qualification</label>
                            <input type="text" id="qualification" name="qualification"
                                placeholder="e.g., 12th Science with Maths">
                        </div>
                        <div class="form-group full-width">
                            <label for="message">Message (Optional)</label>
                            <textarea id="message" name="message" rows="4"
                                placeholder="Any questions or additional information..."></textarea>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        Submit Enquiry
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </button>
                </form>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Admission Banner -->
    <section class="section">
        <div class="container">
            <div class="admission-banner">
                <div class="admission-badge">
                    <span class="badge-label">Anna University</span>
                    <span class="badge-code">Counselling Code: 1152</span>
                </div>
                <h2>Admissions Are Now Open</h2>
                <p>Apply for B.Arch program for the academic year 2025-26</p>
            </div>
        </div>
    </section>

    <!-- Programs Comparison -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Programs</span>
                <h2 class="section-title">Choose Your Program</h2>
            </div>

            <div class="comparison-grid">
                <div class="comparison-card">
                    <h3>B.Arch Architecture</h3>
                    <div class="comparison-details">
                        <div class="comparison-row">
                            <span class="label">Duration</span>
                            <span class="value">5 Years</span>
                        </div>
                        <div class="comparison-row">
                            <span class="label">Eligibility</span>
                            <span class="value">12th with Maths</span>
                        </div>
                        <div class="comparison-row">
                            <span class="label">Entrance</span>
                            <span class="value">NATA / JEE Paper 2</span>
                        </div>
                        <div class="comparison-row">
                            <span class="label">Affiliation</span>
                            <span class="value">Anna University</span>
                        </div>
                        <div class="comparison-row">
                            <span class="label">Approval</span>
                            <span class="value">COA Approved</span>
                        </div>
                    </div>
                    <a href="b-arch.php" class="btn btn-outline-primary" style="width: 100%;">Learn More</a>
                </div>

            </div>
        </div>
    </section>

    <!-- How to Apply -->
    <section class="section" style="background: var(--color-dark-secondary);">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Process</span>
                <h2 class="section-title">How to Apply</h2>
            </div>

            <div class="steps-grid">
                <div class="step-card">
                    <div class="step-number">1</div>
                    <h4>Check Eligibility</h4>
                    <p>Verify you meet the eligibility criteria for your chosen program</p>
                </div>
                <div class="step-card">
                    <div class="step-number">2</div>
                    <h4>Prepare Documents</h4>
                    <p>10th & 12th marksheets, NATA/JEE score (for B.Arch), photos, ID proof</p>
                </div>
                <div class="step-card">
                    <div class="step-number">3</div>
                    <h4>Submit Enquiry</h4>
                    <p>Fill the enquiry form below or contact us directly</p>
                </div>
                <div class="step-card">
                    <div class="step-number">4</div>
                    <h4>Counselling</h4>
                    <p>For B.Arch: Use counselling code 1152 in Anna University counselling</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info -->
    <section class="section">
        <div class="container">
            <div class="contact-banner">
                <h3>Need Help with Admissions?</h3>
                <p>Call us: <strong>+91 97105 54545</strong> | <strong>+91 97109 30025</strong></p>
                <p>Email: <strong>admin@caad.ac.in</strong></p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="index.php" class="footer-logo">
                        <img src="assets/images/caad_logo_big.jpg" alt="CAAD Logo" class="logo-img">
                        <span class="logo-tagline">Chennai Academy of Architecture & Design</span>
                    </a>
                    <p class="footer-description">Shaping the future of architecture and design education since 2014.
                    </p>
                </div>
                <div class="footer-links">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul>
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="courses.php">Programs</a></li>
                        <li><a href="admissions.php">Admissions</a></li>
                        <li><a href="contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4 class="footer-title">Contact</h4>
                    <address>
                        <p>CAAD City Campus, Parivakkam, Poonamallee Bypass. Next to CMRL Poonamallee Metro Depot, Chennai – 600 056</p>
                        <p>+91 97105 54545 | admin@caad.ac.in</p>
                    </address>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Chennai Academy of Architecture and Design.</p>
            </div>
        </div>
    </footer>

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

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }
            });
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