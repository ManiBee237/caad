<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Sitemap of the old caad.ac.in website - Complete directory of all pages from the original CAAD website.">
    <title>Old Website Sitemap | CAAD Chennai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../styles.css?v=3">

    <style>
        .sitemap-section {
            padding: 80px 0;
        }

        .sitemap-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 32px;
            margin-top: 48px;
        }

        .sitemap-card {
            background: var(--card-bg, rgba(255, 255, 255, 0.03));
            border: 1px solid var(--border-color, rgba(255, 255, 255, 0.08));
            border-radius: 16px;
            padding: 32px;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
        }

        .sitemap-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
            border-color: var(--accent-color, #c9a96e);
        }

        .sitemap-card-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border-color, rgba(255, 255, 255, 0.08));
        }

        .sitemap-card-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background: var(--accent-color, #c9a96e);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .sitemap-card-icon svg {
            width: 20px;
            height: 20px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .sitemap-card-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.3rem;
            color: var(--text-primary, #fff);
        }

        .sitemap-card-title a {
            color: inherit;
            text-decoration: none;
            transition: color 0.2s ease;
        }

        .sitemap-card-title a:hover {
            color: var(--accent-color, #c9a96e);
        }

        .sitemap-links {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sitemap-links li {
            position: relative;
            padding-left: 20px;
        }

        .sitemap-links li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 8px;
            height: 1px;
            background: var(--accent-color, #c9a96e);
            opacity: 0.5;
        }

        .sitemap-links a {
            color: var(--text-secondary, rgba(255, 255, 255, 0.7));
            text-decoration: none;
            font-size: 0.95rem;
            transition: color 0.2s ease, padding-left 0.2s ease;
            display: inline-block;
            line-height: 1.8;
        }

        .sitemap-links a:hover {
            color: var(--accent-color, #c9a96e);
            padding-left: 4px;
        }

        .sitemap-overview {
            text-align: center;
            max-width: 640px;
            margin: 0 auto 16px;
        }

        .sitemap-overview p {
            color: var(--text-secondary, rgba(255, 255, 255, 0.7));
            font-size: 1.05rem;
            line-height: 1.7;
        }

        .sitemap-label {
            display: inline-block;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 2px 8px;
            border-radius: 4px;
            background: var(--accent-color, #c9a96e);
            color: #fff;
            margin-left: 6px;
            vertical-align: middle;
            opacity: 0.85;
        }

        .sitemap-label.external {
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-secondary, rgba(255, 255, 255, 0.7));
        }

        @media (max-width: 768px) {
            .sitemap-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .sitemap-card {
                padding: 24px;
            }

            .sitemap-section {
                padding: 48px 0;
            }
        }
    </style>
</head>

<body>
    <!-- Premium Architectural Loader -->
    <div class="arch-loader-overlay" id="archLoader">
        <div class="iso-city">
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
            <a href="../index.php" class="nav-logo">
                <img src="../assets/images/caad_logo_big.jpg" alt="CAAD Logo" class="logo-img">
                <span class="logo-tagline">Chennai Academy of Architecture & Design</span>
            </a>

            <nav class="nav-menu" id="nav-menu">
                <a href="../about.php" class="nav-link">About</a>
                <a href="../b-arch.php" class="nav-link">Courses</a>
                <a href="../admissions.php" class="nav-link">Admissions</a>
                <div class="nav-dropdown">
                    <a href="../facilities.php" class="nav-link nav-link-dropdown">
                        Facilities
                        <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </a>
                    <div class="dropdown-menu">
                        <a href="../international-exposure.php" class="dropdown-item">International Exposure</a>
                        <a href="../leisure-lifestyle.php" class="dropdown-item">Leisure & Lifestyle at CAAD</a>
                        <a href="../campus.php" class="dropdown-item">Campus</a>
                        <a href="../lab-facilities.php" class="dropdown-item">Lab Facilities & Workshops</a>
                        <a href="../library.php" class="dropdown-item">Library</a>
                        <a href="../transport.php" class="dropdown-item">Transport</a>
                        <a href="../hostel.php" class="dropdown-item">Hostel</a>
                    </div>
                </div>
                <div class="nav-dropdown">
                    <a href="../placement.php" class="nav-link nav-link-dropdown">
                        Placement
                        <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 9l6 6 6-6" />
                        </svg>
                    </a>
                    <div class="dropdown-menu">
                        <a href="../job-placement.php" class="dropdown-item">Job Placement</a>
                        <a href="../internship-placement.php" class="dropdown-item">Internship Placement</a>
                        <a href="../higher-education.php" class="dropdown-item">Higher Education</a>
                        <a href="../openings.php" class="dropdown-item">Openings</a>
                    </div>
                </div>
                <a href="../alumni.php" class="nav-link">Alumni</a>
                <a href="../events.php" class="nav-link">Events</a>
                <a href="../contact.php" class="nav-link">Contact</a>
            </nav>

            <div class="nav-actions">
                <a href="../admissions.php#apply" class="btn btn-nav">Apply Now</a>
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
                <a href="../index.php">Home</a>
                <span>/</span>
                <a href="index.php">Sitemap</a>
                <span>/</span>
                <span>Old Website</span>
            </div>
            <h1 class="page-title">Old Website Sitemap</h1>
            <p class="page-subtitle">Complete directory of all pages from caad.ac.in</p>
        </div>
    </section>

    <!-- Sitemap Content -->
    <section class="sitemap-section">
        <div class="container">
            <div class="sitemap-overview">
                <p>A comprehensive map of every page and section discovered on the original CAAD website at caad.ac.in, organized by category.</p>
            </div>

            <div class="sitemap-grid">

                <!-- Home -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                <polyline points="9 22 9 12 15 12 15 22" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Home</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/" target="_blank" rel="noopener">Homepage</a></li>
                    </ul>
                </div>

                <!-- About Us -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="12" y1="16" x2="12" y2="12" />
                                <line x1="12" y1="8" x2="12.01" y2="8" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">About Us</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/about-caad/" target="_blank" rel="noopener">About CAAD</a></li>
                        <li><a href="https://caad.ac.in/advantages-of-caad/" target="_blank" rel="noopener">Advantages of CAAD</a></li>
                        <li><a href="https://caad.ac.in/faculties/" target="_blank" rel="noopener">Faculty</a></li>
                        <li><a href="https://caad.ac.in/management-team/" target="_blank" rel="noopener">Management Team</a></li>
                        <li><a href="https://caad.ac.in/counseling-code/" target="_blank" rel="noopener">Counselling Code</a></li>
                        <li><a href="https://caad.ac.in/anti-ragging-note/" target="_blank" rel="noopener">Anti-Ragging Note</a></li>
                    </ul>
                </div>

                <!-- Courses -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" />
                                <path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Courses</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/b-arch/" target="_blank" rel="noopener">B.Arch. &mdash; Bachelor of Architecture (5 Years)</a></li>
                        <li><a href="https://caad.ac.in/diploma-in-interior-design-and-decoration/" target="_blank" rel="noopener">Diploma in Interior Design & Decoration (3 Years)</a></li>
                        <li><a href="https://caad.ac.in/pg-certificate-medical-architecture/" target="_blank" rel="noopener">M.S. Healthcare Architecture (1 Year)</a></li>
                        <li><a href="https://caad.ac.in/academic/" target="_blank" rel="noopener">Academic</a></li>
                    </ul>
                </div>

                <!-- Admissions -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                                <circle cx="8.5" cy="7" r="4" />
                                <line x1="20" y1="8" x2="20" y2="14" />
                                <line x1="23" y1="11" x2="17" y2="11" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Admissions</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/admissions/" target="_blank" rel="noopener">Admissions</a></li>
                        <li><a href="https://caad.ac.in/new-admissions/" target="_blank" rel="noopener">New Admissions</a></li>
                        <li><a href="https://caad.ac.in/caad-admission-enquiry/" target="_blank" rel="noopener">Admission Enquiry Form</a></li>
                        <li><a href="https://caad.ac.in/b-arch-admission-enquiry/" target="_blank" rel="noopener">B.Arch Admission Enquiry</a></li>
                        <li><a href="https://caad.ac.in/nata-2025-guidance/" target="_blank" rel="noopener">NATA 2025 Guidance</a></li>
                        <li><a href="https://caad.ac.in/nata-course-in-chennai/" target="_blank" rel="noopener">NATA Course in Chennai</a></li>
                        <li><a href="https://caad.ac.in/nata-study-materials-2025/" target="_blank" rel="noopener">NATA Study Materials 2025</a></li>
                        <li><a href="https://easypay.drcsystems.com/indian-bank/caad-college" target="_blank" rel="noopener">Pay Online <span class="sitemap-label external">External</span></a></li>
                    </ul>
                </div>

                <!-- Facilities -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M3 21h18M3 7v1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7H3l2-4h14l2 4M5 21V10.7M19 21V10.7" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Facilities</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/facilities/" target="_blank" rel="noopener">Facilities Overview</a></li>
                        <li><a href="https://caad.ac.in/campus/" target="_blank" rel="noopener">Campus</a></li>
                        <li><a href="https://caad.ac.in/lab-facilities-and-workshops/" target="_blank" rel="noopener">Lab Facilities & Workshops</a></li>
                        <li><a href="https://caad.ac.in/library/" target="_blank" rel="noopener">Library</a></li>
                        <li><a href="https://caad.ac.in/hostel/" target="_blank" rel="noopener">Hostel</a></li>
                        <li><a href="https://caad.ac.in/transport/" target="_blank" rel="noopener">Transport</a></li>
                        <li><a href="https://caad.ac.in/international-exposure/" target="_blank" rel="noopener">International Exposure</a></li>
                        <li><a href="https://caad.ac.in/lifestyle-at-caad/" target="_blank" rel="noopener">Leisure & Lifestyle at CAAD</a></li>
                    </ul>
                </div>

                <!-- Placement -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="2" y="7" width="20" height="14" rx="2" ry="2" />
                                <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Placement</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/job-placement/" target="_blank" rel="noopener">Job Placement</a></li>
                        <li><a href="https://caad.ac.in/internship-placement/" target="_blank" rel="noopener">Internship Placement</a></li>
                        <li><a href="https://caad.ac.in/higher-education/" target="_blank" rel="noopener">Higher Education</a></li>
                        <li><a href="https://caad.ac.in/openings/" target="_blank" rel="noopener">Openings</a></li>
                    </ul>
                </div>

                <!-- International Collaborations -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="10" />
                                <line x1="2" y1="12" x2="22" y2="12" />
                                <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">International</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/international-collaborations/" target="_blank" rel="noopener">International Collaborations</a></li>
                        <li><a href="https://caad.ac.in/international-collabration/" target="_blank" rel="noopener">International Collaboration (Legacy Page)</a></li>
                        <li><a href="https://caad.ac.in/study-mbbs-abroad/" target="_blank" rel="noopener">CAAD Int Edu Services &mdash; Study MBBS Abroad</a></li>
                    </ul>
                </div>

                <!-- Awards & Achievements -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="8" r="7" />
                                <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Awards & Achievements</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/awards/" target="_blank" rel="noopener">Awards Overview</a></li>
                        <li><a href="https://caad.ac.in/media/" target="_blank" rel="noopener">Media</a></li>
                        <li><a href="https://caad.ac.in/igbc-ap-associate/" target="_blank" rel="noopener">IGBC AP Associate</a></li>
                        <li><a href="https://caad.ac.in/university-rank-holders/" target="_blank" rel="noopener">University Rank Holders</a></li>
                        <li><a href="https://caad.ac.in/alumni-achievement/" target="_blank" rel="noopener">Alumni Achievement</a></li>
                        <li><a href="https://caad.ac.in/achievers-of-gate-2023/" target="_blank" rel="noopener">Achievers of GATE</a></li>
                    </ul>
                </div>

                <!-- Events & Publications -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                <line x1="16" y1="2" x2="16" y2="6" />
                                <line x1="8" y1="2" x2="8" y2="6" />
                                <line x1="3" y1="10" x2="21" y2="10" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Events & Publications</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/events/" target="_blank" rel="noopener">Events</a></li>
                        <li><a href="https://caad.ac.in/magazine-bulletin/" target="_blank" rel="noopener">Magazine & Bulletin</a></li>
                        <li><a href="https://caad.ac.in/palinoia-the-caad-students-magazine/" target="_blank" rel="noopener">Palinoia &mdash; Student Magazine</a></li>
                        <li><a href="https://caad.ac.in/blogs/" target="_blank" rel="noopener">Blogs</a></li>
                        <li><a href="https://caad.ac.in/live-stream/" target="_blank" rel="noopener">Live Stream</a></li>
                    </ul>
                </div>

                <!-- Contact -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" />
                                <circle cx="12" cy="10" r="3" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Contact</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/contact-us/" target="_blank" rel="noopener">Contact Us</a></li>
                    </ul>
                </div>

                <!-- Utility / Other Pages -->
                <div class="sitemap-card">
                    <div class="sitemap-card-header">
                        <div class="sitemap-card-icon">
                            <svg viewBox="0 0 24 24">
                                <circle cx="12" cy="12" r="3" />
                                <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06A1.65 1.65 0 0 0 4.68 15a1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06A1.65 1.65 0 0 0 9 4.68a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06A1.65 1.65 0 0 0 19.4 9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z" />
                            </svg>
                        </div>
                        <h3 class="sitemap-card-title">Other Pages</h3>
                    </div>
                    <ul class="sitemap-links">
                        <li><a href="https://caad.ac.in/faq-page/" target="_blank" rel="noopener">FAQ</a></li>
                        <li><a href="https://caad.ac.in/features/" target="_blank" rel="noopener">Features</a></li>
                        <li><a href="https://caad.ac.in/thank-you/" target="_blank" rel="noopener">Thank You (Form Confirmation)</a></li>
                        <li><a href="https://www.facebook.com/CAADCollege/" target="_blank" rel="noopener">Facebook <span class="sitemap-label external">External</span></a></li>
                        <li><a href="https://www.instagram.com/Caad_college/" target="_blank" rel="noopener">Instagram <span class="sitemap-label external">External</span></a></li>
                    </ul>
                </div>

            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="../index.php" class="footer-logo">
                        <img src="../assets/images/caad_logo_footer.png" alt="CAAD Logo" class="footer-logo-img">
                        <span class="logo-tagline">Chennai Academy of Architecture & Design</span>
                    </a>
                    <p class="footer-description">Shaping the future of architecture and design education since 2014.
                    </p>
                </div>

                <div class="footer-links">
                    <h4 class="footer-title">Quick Links</h4>
                    <ul>
                        <li><a href="../about.php">About Us</a></li>
                        <li><a href="../courses.php">Programs</a></li>
                        <li><a href="../admissions.php">Admissions</a></li>
                        <li><a href="../facilities.php">Facilities</a></li>
                        <li><a href="../contact.php">Contact</a></li>
                    </ul>
                </div>

                <div class="footer-links">
                    <h4 class="footer-title">Programs</h4>
                    <ul>
                        <li><a href="../b-arch.php">B.Arch Architecture</a></li>
                    </ul>
                </div>

                <div class="footer-contact">
                    <h4 class="footer-title">Contact</h4>
                    <address>
                        <p>CAAD City Campus, Parivakkam, Poonamallee Bypass. Next to CMRL Poonamallee Metro Depot, Chennai – 600 056</p>
                        <p>+91 97105 54545</p>
                        <p>admin@caad.ac.in</p>
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

        // Mobile menu toggle
        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');

        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });

        // Scroll Reveal for sitemap cards
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '0px 0px -40px 0px'
        });

        document.addEventListener('DOMContentLoaded', () => {
            const cards = document.querySelectorAll('.sitemap-card');
            cards.forEach((card, index) => {
                card.classList.add('reveal-fade-up');
                card.classList.add(`stagger-${(index % 6) + 1}`);
                revealObserver.observe(card);
            });

            // Also animate footer
            document.querySelectorAll('.footer-brand, .footer-links, .footer-contact').forEach((el, i) => {
                el.classList.add('reveal-fade-up', `stagger-${(i % 6) + 1}`);
                revealObserver.observe(el);
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
                }, 1000);
            }
        });
    </script>
</body>

</html>
