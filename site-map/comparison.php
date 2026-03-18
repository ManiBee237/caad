<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Side-by-side comparison of the old caad.ac.in website and the new CAAD website - pages added, removed, and restructured.">
    <title>Old vs New Sitemap Comparison | CAAD Chennai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="../styles.css?v=3">

    <style>
        /* ── Stats Banner ── */
        .stats-banner {
            padding: 48px 0 0;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 20px;
        }

        .stat-box {
            background: var(--card-bg, rgba(255, 255, 255, 0.03));
            border: 1px solid var(--border-color, rgba(255, 255, 255, 0.08));
            border-radius: 14px;
            padding: 24px 20px;
            text-align: center;
            transition: border-color 0.3s ease;
        }

        .stat-box:hover {
            border-color: var(--accent-color, #c9a96e);
        }

        .stat-number {
            font-family: 'DM Serif Display', serif;
            font-size: 2.2rem;
            color: var(--accent-color, #c9a96e);
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary, rgba(255, 255, 255, 0.6));
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        /* ── Comparison Section ── */
        .comparison-section {
            padding: 80px 0;
        }

        .comparison-intro {
            text-align: center;
            max-width: 680px;
            margin: 0 auto 48px;
        }

        .comparison-intro p {
            color: var(--text-secondary, rgba(255, 255, 255, 0.7));
            font-size: 1.05rem;
            line-height: 1.7;
        }

        /* ── Comparison Table Card ── */
        .comparison-block {
            background: var(--card-bg, rgba(255, 255, 255, 0.03));
            border: 1px solid var(--border-color, rgba(255, 255, 255, 0.08));
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 32px;
            transition: border-color 0.3s ease;
        }

        .comparison-block:hover {
            border-color: var(--accent-color, #c9a96e);
        }

        .comparison-block-header {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 20px 28px;
            background: rgba(201, 169, 110, 0.06);
            border-bottom: 1px solid var(--border-color, rgba(255, 255, 255, 0.08));
            cursor: pointer;
            user-select: none;
        }

        .comparison-block-header:hover {
            background: rgba(201, 169, 110, 0.1);
        }

        .comparison-block-icon {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background: var(--accent-color, #c9a96e);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .comparison-block-icon svg {
            width: 18px;
            height: 18px;
            stroke: #fff;
            fill: none;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

        .comparison-block-title {
            font-family: 'DM Serif Display', serif;
            font-size: 1.2rem;
            color: var(--text-primary, #fff);
            flex: 1;
        }

        .toggle-icon {
            width: 20px;
            height: 20px;
            stroke: var(--text-secondary, rgba(255, 255, 255, 0.5));
            fill: none;
            stroke-width: 2;
            transition: transform 0.3s ease;
        }

        .comparison-block.open .toggle-icon {
            transform: rotate(180deg);
        }

        .comparison-block-body {
            display: none;
            padding: 0;
        }

        .comparison-block.open .comparison-block-body {
            display: block;
        }

        /* ── Two-Column Layout ── */
        .compare-columns {
            display: grid;
            grid-template-columns: 1fr 1fr;
        }

        .compare-col {
            padding: 24px 28px;
        }

        .compare-col:first-child {
            border-right: 1px solid var(--border-color, rgba(255, 255, 255, 0.08));
        }

        .compare-col-label {
            font-size: 0.7rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .compare-col-label.old {
            color: #e07a5f;
        }

        .compare-col-label.new {
            color: #81b29a;
        }

        .compare-col-label .dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            display: inline-block;
        }

        .compare-col-label.old .dot {
            background: #e07a5f;
        }

        .compare-col-label.new .dot {
            background: #81b29a;
        }

        .compare-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .compare-list li {
            font-size: 0.9rem;
            color: var(--text-secondary, rgba(255, 255, 255, 0.7));
            line-height: 1.7;
            padding: 4px 0;
            position: relative;
            padding-left: 16px;
        }

        .compare-list li::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            width: 6px;
            height: 6px;
            border-radius: 50%;
        }

        .compare-col-label.old + .compare-list li::before {
            background: #e07a5f;
            opacity: 0.4;
        }

        .compare-col-label.new + .compare-list li::before {
            background: #81b29a;
            opacity: 0.4;
        }

        .compare-list li.removed {
            text-decoration: line-through;
            opacity: 0.45;
        }

        .compare-list li.added {
            color: #81b29a;
        }

        .compare-list li.kept {
            color: var(--text-secondary, rgba(255, 255, 255, 0.7));
        }

        /* ── Status Tags ── */
        .status-tag {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            padding: 2px 7px;
            border-radius: 4px;
            margin-left: 6px;
            vertical-align: middle;
        }

        .status-tag.added {
            background: rgba(129, 178, 154, 0.2);
            color: #81b29a;
        }

        .status-tag.removed {
            background: rgba(224, 122, 95, 0.2);
            color: #e07a5f;
        }

        .status-tag.renamed {
            background: rgba(201, 169, 110, 0.2);
            color: #c9a96e;
        }

        .status-tag.kept {
            background: rgba(255, 255, 255, 0.08);
            color: var(--text-secondary, rgba(255, 255, 255, 0.5));
        }

        /* ── Legend ── */
        .legend {
            display: flex;
            gap: 24px;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.85rem;
            color: var(--text-secondary, rgba(255, 255, 255, 0.6));
        }

        /* ── Responsive ── */
        @media (max-width: 768px) {
            .compare-columns {
                grid-template-columns: 1fr;
            }

            .compare-col:first-child {
                border-right: none;
                border-bottom: 1px solid var(--border-color, rgba(255, 255, 255, 0.08));
            }

            .comparison-section {
                padding: 48px 0;
            }

            .stats-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .stat-number {
                font-size: 1.8rem;
            }
        }
    </style>
</head>

<body>
    <!-- Premium Architectural Loader -->
    <div class="arch-loader-overlay" id="archLoader">
        <div class="iso-city">
            <div class="iso-block"><div class="side front"></div><div class="side back"></div><div class="side right"></div><div class="side left"></div><div class="side top"></div><div class="side bottom"></div></div>
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
                    <a href="../facilities.php" class="nav-link nav-link-dropdown">Facilities
                        <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6" /></svg>
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
                    <a href="../placement.php" class="nav-link nav-link-dropdown">Placement
                        <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 9l6 6 6-6" /></svg>
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
                <span>Comparison</span>
            </div>
            <h1 class="page-title">Old vs New Website</h1>
            <p class="page-subtitle">Side-by-side comparison of caad.ac.in and the redesigned site</p>
        </div>
    </section>

    <!-- Stats Banner -->
    <section class="stats-banner">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-box">
                    <div class="stat-number">~35</div>
                    <div class="stat-label">Old Pages</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number">26</div>
                    <div class="stat-label">New Pages</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number" style="color: #81b29a;">+8</div>
                    <div class="stat-label">Pages Added</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number" style="color: #e07a5f;">-17</div>
                    <div class="stat-label">Pages Removed</div>
                </div>
                <div class="stat-box">
                    <div class="stat-number" style="color: #c9a96e;">11</div>
                    <div class="stat-label">Sections</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Content -->
    <section class="comparison-section">
        <div class="container">
            <div class="comparison-intro">
                <div class="section-header">
                    <span class="section-label">Page-by-Page</span>
                    <h2 class="section-title">Section Comparison</h2>
                </div>
                <p>Click each section to expand and see what changed between the old WordPress site and the new static redesign.</p>
            </div>

            <!-- Legend -->
            <div class="legend">
                <div class="legend-item"><span class="status-tag kept">Kept</span> Present in both</div>
                <div class="legend-item"><span class="status-tag added">New</span> Added in redesign</div>
                <div class="legend-item"><span class="status-tag removed">Removed</span> Dropped from old site</div>
                <div class="legend-item"><span class="status-tag renamed">Renamed</span> Restructured / renamed</div>
            </div>

            <!-- ═══ About Us ═══ -->
            <div class="comparison-block open">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><line x1="12" y1="16" x2="12" y2="12" /><line x1="12" y1="8" x2="12.01" y2="8" /></svg>
                    </div>
                    <span class="comparison-block-title">About Us</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>About CAAD</li>
                                <li>Advantages of CAAD</li>
                                <li>Faculty</li>
                                <li>Management Team</li>
                                <li>Counselling Code</li>
                                <li>Anti-Ragging Note</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li>About CAAD <span class="status-tag kept">Kept</span></li>
                                <li class="removed">Advantages of CAAD <span class="status-tag renamed">Merged</span></li>
                                <li class="removed">Faculty <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Management Team <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Counselling Code <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Anti-Ragging Note <span class="status-tag removed">Removed</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ Courses ═══ -->
            <div class="comparison-block">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z" /><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z" /></svg>
                    </div>
                    <span class="comparison-block-title">Courses</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>B.Arch. (5 Years)</li>
                                <li>Diploma Interior Design & Decoration</li>
                                <li>M.S. Healthcare Architecture</li>
                                <li>Academic</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li>Courses Overview <span class="status-tag added">New</span></li>
                                <li>B.Arch Architecture (5 Years) <span class="status-tag kept">Kept</span></li>
                                <li>D.Arch Interior Design & Decoration (3 Years) <span class="status-tag renamed">Renamed</span></li>
                                <li>D.Des Interior Design (4 Years) <span class="status-tag added">New</span></li>
                                <li>M.S. Medical Architecture (1 Year) <span class="status-tag kept">Kept</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ Admissions ═══ -->
            <div class="comparison-block">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" /><circle cx="8.5" cy="7" r="4" /><line x1="20" y1="8" x2="20" y2="14" /><line x1="23" y1="11" x2="17" y2="11" /></svg>
                    </div>
                    <span class="comparison-block-title">Admissions</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>Admissions</li>
                                <li>New Admissions</li>
                                <li>Admission Enquiry Form</li>
                                <li>B.Arch Admission Enquiry</li>
                                <li>NATA 2025 Guidance</li>
                                <li>NATA Course in Chennai</li>
                                <li>NATA Study Materials 2025</li>
                                <li>Pay Online (External)</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li>Admissions <span class="status-tag kept">Kept</span></li>
                                <li class="removed">New Admissions <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Admission Enquiry Form <span class="status-tag removed">Removed</span></li>
                                <li class="removed">B.Arch Admission Enquiry <span class="status-tag removed">Removed</span></li>
                                <li class="removed">NATA 2025 Guidance <span class="status-tag removed">Removed</span></li>
                                <li class="removed">NATA Course in Chennai <span class="status-tag removed">Removed</span></li>
                                <li class="removed">NATA Study Materials <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Pay Online <span class="status-tag removed">Removed</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ Facilities ═══ -->
            <div class="comparison-block">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><path d="M3 21h18M3 7v1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7m0 1a3 3 0 0 0 6 0V7H3l2-4h14l2 4M5 21V10.7M19 21V10.7" /></svg>
                    </div>
                    <span class="comparison-block-title">Facilities</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>Facilities Overview</li>
                                <li>Campus</li>
                                <li>Lab Facilities & Workshops</li>
                                <li>Library</li>
                                <li>Hostel</li>
                                <li>Transport</li>
                                <li>International Exposure</li>
                                <li>Leisure & Lifestyle at CAAD</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li>Facilities Overview <span class="status-tag kept">Kept</span></li>
                                <li>Campus <span class="status-tag kept">Kept</span></li>
                                <li>Lab Facilities & Workshops <span class="status-tag kept">Kept</span></li>
                                <li>Library <span class="status-tag kept">Kept</span></li>
                                <li>Hostel <span class="status-tag kept">Kept</span></li>
                                <li>Transport <span class="status-tag kept">Kept</span></li>
                                <li>International Exposure <span class="status-tag kept">Kept</span></li>
                                <li>Leisure & Lifestyle <span class="status-tag kept">Kept</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ Placement ═══ -->
            <div class="comparison-block">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><rect x="2" y="7" width="20" height="14" rx="2" ry="2" /><path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16" /></svg>
                    </div>
                    <span class="comparison-block-title">Placement</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>Job Placement</li>
                                <li>Internship Placement</li>
                                <li>Higher Education</li>
                                <li>Openings</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li>Placement Overview <span class="status-tag added">New</span></li>
                                <li>Job Placement <span class="status-tag kept">Kept</span></li>
                                <li>Internship Placement <span class="status-tag kept">Kept</span></li>
                                <li>Higher Education <span class="status-tag kept">Kept</span></li>
                                <li>Openings <span class="status-tag kept">Kept</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ International ═══ -->
            <div class="comparison-block">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10" /><line x1="2" y1="12" x2="22" y2="12" /><path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z" /></svg>
                    </div>
                    <span class="comparison-block-title">International</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>International Collaborations</li>
                                <li>International Collaboration (Legacy)</li>
                                <li>Study MBBS Abroad</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li class="removed">International Collaborations <span class="status-tag removed">Removed</span></li>
                                <li class="removed">International Collaboration (Legacy) <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Study MBBS Abroad <span class="status-tag removed">Removed</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ Awards ═══ -->
            <div class="comparison-block">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><circle cx="12" cy="8" r="7" /><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88" /></svg>
                    </div>
                    <span class="comparison-block-title">Awards & Achievements</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>Awards Overview</li>
                                <li>Media</li>
                                <li>IGBC AP Associate</li>
                                <li>University Rank Holders</li>
                                <li>Alumni Achievement</li>
                                <li>Achievers of GATE</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li class="removed">Awards Overview <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Media <span class="status-tag removed">Removed</span></li>
                                <li class="removed">IGBC AP Associate <span class="status-tag removed">Removed</span></li>
                                <li class="removed">University Rank Holders <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Alumni Achievement <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Achievers of GATE <span class="status-tag removed">Removed</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ Events & Publications ═══ -->
            <div class="comparison-block">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2" /><line x1="16" y1="2" x2="16" y2="6" /><line x1="8" y1="2" x2="8" y2="6" /><line x1="3" y1="10" x2="21" y2="10" /></svg>
                    </div>
                    <span class="comparison-block-title">Events & Publications</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>Events</li>
                                <li>Magazine & Bulletin</li>
                                <li>Palinoia &mdash; Student Magazine</li>
                                <li>Blogs</li>
                                <li>Live Stream</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li class="removed">Events <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Magazine & Bulletin <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Palinoia <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Blogs <span class="status-tag removed">Removed</span></li>
                                <li class="removed">Live Stream <span class="status-tag removed">Removed</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ═══ Contact ═══ -->
            <div class="comparison-block">
                <div class="comparison-block-header" onclick="this.parentElement.classList.toggle('open')">
                    <div class="comparison-block-icon">
                        <svg viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z" /><circle cx="12" cy="10" r="3" /></svg>
                    </div>
                    <span class="comparison-block-title">Contact</span>
                    <svg class="toggle-icon" viewBox="0 0 24 24"><path d="M6 9l6 6 6-6" /></svg>
                </div>
                <div class="comparison-block-body">
                    <div class="compare-columns">
                        <div class="compare-col">
                            <div class="compare-col-label old"><span class="dot"></span> Old Website (caad.ac.in)</div>
                            <ul class="compare-list">
                                <li>Contact Us</li>
                            </ul>
                        </div>
                        <div class="compare-col">
                            <div class="compare-col-label new"><span class="dot"></span> New Website</div>
                            <ul class="compare-list">
                                <li>Contact Us <span class="status-tag kept">Kept</span></li>
                            </ul>
                        </div>
                    </div>
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
                    <p class="footer-description">Shaping the future of architecture and design education since 2014.</p>
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
        // Theme Toggle
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

        // Scroll Reveal
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) entry.target.classList.add('visible');
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -40px 0px' });

        document.addEventListener('DOMContentLoaded', () => {
            // Animate stat boxes
            document.querySelectorAll('.stat-box').forEach((el, i) => {
                el.classList.add('reveal-fade-up', `stagger-${(i % 6) + 1}`);
                revealObserver.observe(el);
            });

            // Animate comparison blocks
            document.querySelectorAll('.comparison-block').forEach((el, i) => {
                el.classList.add('reveal-fade-up', `stagger-${(i % 6) + 1}`);
                revealObserver.observe(el);
            });

            // Animate footer
            document.querySelectorAll('.footer-brand, .footer-links, .footer-contact').forEach((el, i) => {
                el.classList.add('reveal-fade-up', `stagger-${(i % 6) + 1}`);
                revealObserver.observe(el);
            });
        });
    </script>
    <script>
        // Remove Loader
        window.addEventListener('load', () => {
            const loader = document.getElementById('archLoader');
            if (loader) {
                setTimeout(() => {
                    loader.classList.add('fade-out');
                    setTimeout(() => { loader.style.display = 'none'; }, 600);
                }, 1000);
            }
        });
    </script>
</body>

</html>
