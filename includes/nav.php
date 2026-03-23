<?php
// Set $current_page before including this file
// Set $nav_scrolled = false for index.php (no 'scrolled' class)
$nav_class = (!isset($nav_scrolled) || $nav_scrolled) ? 'navbar scrolled' : 'navbar';
?>
<header class="<?= $nav_class ?>" id="navbar">
    <div class="nav-container">
        <a href="index.php" class="nav-logo">
            <img src="assets/images/caad_logo_big.jpg" alt="CAAD Logo" class="logo-img">
            <span class="logo-tagline">Chennai Academy of Architecture &amp; Design</span>
        </a>

        <nav class="nav-menu" id="nav-menu">
            <a href="about.php" class="nav-link <?= ($current_page ?? '') === 'about' ? 'active' : '' ?>">About</a>
            <a href="b-arch.php" class="nav-link <?= ($current_page ?? '') === 'courses' ? 'active' : '' ?>">Courses</a>
            <a href="admissions.php" class="nav-link <?= ($current_page ?? '') === 'admissions' ? 'active' : '' ?>">Admissions</a>
            <div class="nav-dropdown">
                <a href="facilities.php" class="nav-link nav-link-dropdown <?= in_array($current_page ?? '', ['facilities', 'international-exposure', 'leisure-lifestyle', 'campus', 'lab-facilities', 'library', 'transport', 'hostel']) ? 'active' : '' ?>">
                    Facilities
                    <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9l6 6 6-6" />
                    </svg>
                </a>
                <div class="dropdown-menu">
                    <a href="international-exposure.php" class="dropdown-item <?= ($current_page ?? '') === 'international-exposure' ? 'active' : '' ?>">International Exposure</a>
                    <a href="leisure-lifestyle.php" class="dropdown-item <?= ($current_page ?? '') === 'leisure-lifestyle' ? 'active' : '' ?>">Leisure & Lifestyle at CAAD</a>
                    <a href="campus.php" class="dropdown-item <?= ($current_page ?? '') === 'campus' ? 'active' : '' ?>">Campus</a>
                    <a href="lab-facilities.php" class="dropdown-item <?= ($current_page ?? '') === 'lab-facilities' ? 'active' : '' ?>">Lab Facilities & Workshops</a>
                    <a href="library.php" class="dropdown-item <?= ($current_page ?? '') === 'library' ? 'active' : '' ?>">Library</a>
                    <a href="transport.php" class="dropdown-item <?= ($current_page ?? '') === 'transport' ? 'active' : '' ?>">Transport</a>
                    <a href="hostel.php" class="dropdown-item <?= ($current_page ?? '') === 'hostel' ? 'active' : '' ?>">Hostel</a>
                </div>
            </div>
            <div class="nav-dropdown">
                <a href="placement.php" class="nav-link nav-link-dropdown <?= in_array($current_page ?? '', ['placement', 'job-placement', 'internship-placement', 'higher-education', 'openings']) ? 'active' : '' ?>">
                    Placement
                    <svg class="dropdown-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M6 9l6 6 6-6" />
                    </svg>
                </a>
                <div class="dropdown-menu">
                    <a href="job-placement.php" class="dropdown-item <?= ($current_page ?? '') === 'job-placement' ? 'active' : '' ?>">Job Placement</a>
                    <a href="internship-placement.php" class="dropdown-item <?= ($current_page ?? '') === 'internship-placement' ? 'active' : '' ?>">Internship Placement</a>
                    <a href="higher-education.php" class="dropdown-item <?= ($current_page ?? '') === 'higher-education' ? 'active' : '' ?>">Higher Education</a>
                    <a href="openings.php" class="dropdown-item <?= ($current_page ?? '') === 'openings' ? 'active' : '' ?>">Openings</a>
                </div>
            </div>
            <a href="alumni.php" class="nav-link <?= ($current_page ?? '') === 'alumni' ? 'active' : '' ?>">Alumni</a>
            <a href="events.php" class="nav-link <?= ($current_page ?? '') === 'events' ? 'active' : '' ?>">Events</a>
            <a href="contact.php" class="nav-link <?= ($current_page ?? '') === 'contact' ? 'active' : '' ?>">Contact</a>
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
