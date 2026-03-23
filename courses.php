<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Explore the B.Arch Architecture program at CAAD Chennai. Affiliated to Anna University, approved by Council of Architecture.">
    <title>Courses | CAAD Chennai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <?php include 'includes/loader.php'; ?>
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
        </div>
        <div class="loader-text-container">
            <h2 class="loader-title">Building Dreams</h2>
            <p class="loader-subtitle">Chennai Academy of Architecture & Design</p>
        </div>
    </div>

    <!-- Navigation -->
    <?php $current_page = 'courses'; include 'includes/nav.php'; ?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Courses</span>
            </div>
            <h1 class="page-title">Our Programs</h1>
            <p class="page-subtitle">Industry-ready courses in Architecture & Design</p>
        </div>
    </section>

    <!-- Programs Overview (Stacking Cards) -->
    <section class="stacking-section horizontal-scroll-layout" id="courses-stacking">
        <div class="container">
            <div class="section-header">
                <span class="section-label">ADMISSIONS OPEN FOR THE ACADEMIC YEAR 2025 – 26</span>
                <h2 class="section-title">Courses Offered</h2>
                <p class="section-subtitle">
                    Comprehensive programs designed to transform passionate students into industry-ready professionals
                </p>
            </div>

            <!-- Navigation Controls -->
            <div class="scroll-controls">
                <button class="scroll-btn prev" aria-label="Previous card">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 18l-6-6 6-6" />
                    </svg>
                </button>
                <div class="scroll-progress-track">
                    <div class="scroll-progress-bar"></div>
                </div>
                <button class="scroll-btn next" aria-label="Next card">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 18l6-6-6-6" />
                    </svg>
                </button>
            </div>

            <div class="stacking-cards-container" id="scrollContainer">
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
                            <img src="assets/images/new-building.jpg" alt="B.Arch">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

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

        // Horizontal Scroll Logic for Courses Page
        document.addEventListener('DOMContentLoaded', () => {
            const container = document.getElementById('scrollContainer');
            if (container) {
                const prevBtn = document.querySelector('.scroll-btn.prev');
                const nextBtn = document.querySelector('.scroll-btn.next');
                const progressBar = document.querySelector('.scroll-progress-bar');

                // Scroll amount (approx card width + gap)
                const scrollAmount = 432;

                if (prevBtn && nextBtn) {
                    prevBtn.addEventListener('click', () => {
                        container.scrollBy({ left: -scrollAmount, behavior: 'smooth' });
                    });

                    nextBtn.addEventListener('click', () => {
                        container.scrollBy({ left: scrollAmount, behavior: 'smooth' });
                    });
                }

                // Update Progress Bar
                if (progressBar) {
                    const updateProgress = () => {
                        const maxScroll = container.scrollWidth - container.clientWidth;
                        const currentScroll = container.scrollLeft;
                        const percentage = (currentScroll / maxScroll) * 100;
                        progressBar.style.width = `${Math.min(100, Math.max(0, percentage))}%`;
                    };

                    container.addEventListener('scroll', updateProgress);
                    // Initial call
                    updateProgress();
                    // Update on resize
                    window.addEventListener('resize', updateProgress);
                }
            }
        });
    </script>
    <!-- NATA Guidance -->
    <section class="section" style="background: var(--color-dark-secondary);">
        <div class="container">
            <div class="nata-banner">
                <div class="nata-content">
                    <span class="section-label">NATA 2025</span>
                    <h2 class="section-title">NATA Guidance Program</h2>
                    <p>Preparing for NATA? CAAD offers comprehensive guidance and coaching for NATA 2025.
                        Our experienced faculty help you prepare for the aptitude test with practice sessions,
                        mock tests, and expert tips.</p>
                    <a href="contact.php" class="btn btn-primary" style="margin-top: 1.5rem;">
                        Register for NATA Guidance
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Study at CAAD -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Why CAAD</span>
                <h2 class="section-title">The CAAD Advantage</h2>
            </div>

            <div class="advantages-grid">
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path d="M12 14l9-5-9-5-9 5 9 5z" />
                            <path d="M12 14v7" />
                        </svg>
                    </div>
                    <h4>Experienced Faculty</h4>
                    <p>Learn from practicing architects and designers from leading firms</p>
                </div>
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4>International Exposure</h4>
                    <p>MOUs with international universities for faculty and student exchange</p>
                </div>
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <h4>State-of-the-Art Campus</h4>
                    <p>Modern studios, workshops, labs, and a dedicated materials museum</p>
                </div>
                <div class="advantage-item">
                    <div class="advantage-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <path
                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h4>Industry Placements</h4>
                    <p>Strong placement records with leading architecture and design firms</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Apply?</h2>
                <p class="cta-text">Admissions for 2025-26 are now open. Anna University Counselling Code: 1152</p>
                <div class="cta-buttons">
                    <a href="admissions.php" class="btn btn-white">Apply Now</a>
                    <a href="contact.php" class="btn btn-outline-white">Enquire Now</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
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
</body>

</html>