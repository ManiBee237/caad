<?php
$current_page = 'nata';

// Handle PDF access form submission
$pdf_unlocked = false;
$pdf_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pdf_form'])) {
    $pdf_name  = htmlspecialchars(trim($_POST['pdf_name'] ?? ''));
    $pdf_phone = htmlspecialchars(trim($_POST['pdf_phone'] ?? ''));

    $pdf_email = filter_var(trim($_POST['pdf_email'] ?? ''), FILTER_SANITIZE_EMAIL);

    if ($pdf_name && $pdf_phone && $pdf_email && filter_var($pdf_email, FILTER_VALIDATE_EMAIL) && preg_match('/^[0-9+\s\-]{7,15}$/', $pdf_phone)) {
        // Log the lead
        $log_entry = date('Y-m-d H:i:s') . " | NATA PDF Lead | Name: $pdf_name | Phone: $pdf_phone | Email: $pdf_email\n";
        file_put_contents(__DIR__ . '/nata_pdf_leads.log', $log_entry, FILE_APPEND | LOCK_EX);
        // Optionally notify via mail
        if (file_exists(__DIR__ . '/mail-config.php')) {
            require_once __DIR__ . '/mail-config.php';
            $to      = 'admin@caad.ac.in';
            $subject = "NATA PDF Download Lead: $pdf_name";
            $body    = "NATA Study Material Download\n============================\nName: $pdf_name\nPhone: $pdf_phone\nEmail: $pdf_email\nDate: " . date('Y-m-d H:i:s');
            sendMail($to, $subject, $body, $pdf_email, $pdf_name);
        }
        $pdf_unlocked = true;
    } else {
        $pdf_error = true;
    }
}
?>
<!DOCTYPE html>
<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="NATA 2026 guidance and coaching at CAAD Chennai - Prepare for the National Aptitude Test in Architecture with expert faculty and comprehensive study material.">
    <title>NATA 2026 | CAAD Chennai</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Serif+Display&family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        /* NATA 2026 Page Specific Styles */
        .nata-hero {
            background: linear-gradient(135deg, var(--color-dark) 0%, var(--color-dark-secondary) 100%);
            padding: 5rem 0 4rem;
            position: relative;
            overflow: hidden;
        }
        .nata-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -10%;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(184,150,92,0.12) 0%, transparent 70%);
            pointer-events: none;
        }
        .nata-badge {
            display: inline-block;
            background: var(--color-primary);
            color: var(--color-dark);
            font-weight: 700;
            font-size: 0.8rem;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 0.35rem 1rem;
            border-radius: 50px;
            margin-bottom: 1.5rem;
        }
        .nata-hero-title {
            font-family: var(--font-serif);
            font-size: clamp(2.2rem, 5vw, 3.5rem);
            color: var(--color-white);
            line-height: 1.15;
            margin-bottom: 1.25rem;
        }
        .nata-hero-title span {
            color: var(--color-primary);
        }
        .nata-hero-subtitle {
            font-size: 1.1rem;
            color: var(--color-text-secondary);
            max-width: 560px;
            line-height: 1.7;
            margin-bottom: 2.5rem;
        }
        .nata-hero-stats {
            display: flex;
            gap: 2.5rem;
            flex-wrap: wrap;
        }
        .nata-stat {
            text-align: left;
        }
        .nata-stat-number {
            font-family: var(--font-serif);
            font-size: 2rem;
            color: var(--color-primary);
            line-height: 1;
        }
        .nata-stat-label {
            font-size: 0.85rem;
            color: var(--color-text-secondary);
            margin-top: 0.25rem;
        }

        /* What is NATA */
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            align-items: start;
        }
        .info-card {
            background: var(--color-dark-secondary);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: var(--radius-lg);
            padding: 2rem;
        }
        .info-card-icon {
            width: 48px;
            height: 48px;
            background: rgba(184,150,92,0.12);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.25rem;
        }
        .info-card-icon svg {
            width: 24px;
            height: 24px;
            color: var(--color-primary);
        }
        .info-card h3 {
            font-family: var(--font-serif);
            font-size: 1.2rem;
            color: var(--color-white);
            margin-bottom: 0.75rem;
        }
        .info-card p, .info-card li {
            font-size: 0.95rem;
            color: var(--color-text-secondary);
            line-height: 1.7;
        }
        .info-card ul {
            padding-left: 1.25rem;
        }
        .info-card li {
            margin-bottom: 0.4rem;
        }

        /* Highlights strip */
        .highlight-strip {
            background: var(--color-primary);
            padding: 1.25rem 0;
        }
        .highlight-strip-inner {
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
        }
        .highlight-item {
            text-align: center;
            color: var(--color-dark);
        }
        .highlight-item strong {
            display: block;
            font-size: 1.1rem;
            font-weight: 700;
        }
        .highlight-item span {
            font-size: 0.82rem;
            opacity: 0.8;
        }

        /* Syllabus */
        .syllabus-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
        }
        .syllabus-card {
            background: var(--color-dark-secondary);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: var(--radius-lg);
            padding: 1.75rem;
            border-top: 3px solid var(--color-primary);
        }
        .syllabus-card h3 {
            font-family: var(--font-serif);
            font-size: 1.1rem;
            color: var(--color-white);
            margin-bottom: 1rem;
        }
        .syllabus-card ul {
            padding-left: 1.1rem;
        }
        .syllabus-card li {
            font-size: 0.9rem;
            color: var(--color-text-secondary);
            margin-bottom: 0.4rem;
            line-height: 1.5;
        }

        /* Why CAAD */
        .why-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        .why-card {
            display: flex;
            gap: 1rem;
            align-items: flex-start;
            background: var(--color-dark-secondary);
            border: 1px solid rgba(255,255,255,0.06);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
        }
        .why-icon {
            flex-shrink: 0;
            width: 44px;
            height: 44px;
            background: rgba(184,150,92,0.12);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .why-icon svg {
            width: 22px;
            height: 22px;
            color: var(--color-primary);
        }
        .why-card h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--color-white);
            margin-bottom: 0.4rem;
        }
        .why-card p {
            font-size: 0.88rem;
            color: var(--color-text-secondary);
            line-height: 1.6;
        }

        /* CTA */
        .nata-cta {
            background: linear-gradient(135deg, var(--color-dark-secondary), var(--color-dark));
            border: 1px solid rgba(184,150,92,0.25);
            border-radius: var(--radius-xl);
            padding: 3.5rem 2rem;
            text-align: center;
        }
        .nata-cta h2 {
            font-family: var(--font-serif);
            font-size: 2rem;
            color: var(--color-white);
            margin-bottom: 0.75rem;
        }
        .nata-cta p {
            color: var(--color-text-secondary);
            margin-bottom: 2rem;
            font-size: 1rem;
        }
        .nata-cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        /* PDF Download Section */
        .pdf-section {
            background: var(--color-dark-secondary);
        }
        .pdf-gate-wrap {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }
        .pdf-gate-left h2 {
            font-family: var(--font-serif);
            font-size: 1.9rem;
            color: var(--color-white);
            margin-bottom: 0.75rem;
        }
        .pdf-gate-left p {
            color: var(--color-text-secondary);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }
        .pdf-list-preview {
            display: flex;
            flex-direction: column;
            gap: 0.6rem;
        }
        .pdf-list-item {
            display: flex;
            align-items: center;
            gap: 0.6rem;
            font-size: 0.88rem;
            color: var(--color-text-secondary);
        }
        .pdf-list-item svg {
            width: 16px;
            height: 16px;
            color: var(--color-primary);
            flex-shrink: 0;
        }
        .pdf-form-card {
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: var(--radius-xl);
            padding: 2.25rem;
            box-shadow: 0 4px 24px rgba(0,0,0,0.07);
        }
        .pdf-form-card h3 {
            font-family: var(--font-serif);
            font-size: 1.3rem;
            color: #1a202c;
            margin-bottom: 0.4rem;
        }
        .pdf-form-card .form-sub {
            font-size: 0.88rem;
            color: #64748b;
            margin-bottom: 1.75rem;
        }
        .pdf-form-group {
            margin-bottom: 1.1rem;
        }
        .pdf-form-group label {
            display: block;
            font-size: 0.85rem;
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.4rem;
        }
        .pdf-form-group input {
            width: 100%;
            background: #f8fafc;
            border: 1.5px solid #cbd5e1;
            border-radius: 8px;
            padding: 0.75rem 1rem;
            color: #1a202c;
            font-size: 0.95rem;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-sizing: border-box;
        }
        .pdf-form-group input:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(184,150,92,0.15);
            background: #fff;
        }
        .pdf-form-group input::placeholder {
            color: #94a3b8;
        }
        .pdf-form-error {
            background: rgba(200,50,50,0.12);
            border: 1px solid rgba(200,50,50,0.3);
            border-radius: 8px;
            padding: 0.75rem 1rem;
            color: #f87171;
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
        /* Unlocked PDF cards */
        .pdf-cards-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
            gap: 1.25rem;
            margin-top: 2rem;
        }
        .pdf-download-card {
            background: var(--color-dark);
            border: 1px solid rgba(184,150,92,0.18);
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
            transition: border-color 0.2s, transform 0.2s;
        }
        .pdf-download-card:hover {
            border-color: var(--color-primary);
            transform: translateY(-3px);
        }
        .pdf-card-icon {
            width: 44px;
            height: 44px;
            background: rgba(184,150,92,0.12);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .pdf-card-icon svg {
            width: 22px;
            height: 22px;
            color: var(--color-primary);
        }
        .pdf-card-title {
            font-size: 0.92rem;
            font-weight: 600;
            color: var(--color-white);
            line-height: 1.4;
            flex: 1;
        }
        .pdf-download-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--color-primary);
            color: var(--color-dark);
            font-weight: 600;
            font-size: 0.82rem;
            padding: 0.55rem 1.1rem;
            border-radius: 6px;
            text-decoration: none;
            transition: opacity 0.2s;
            width: fit-content;
        }
        .pdf-download-btn:hover { opacity: 0.88; }
        .pdf-download-btn svg { width: 15px; height: 15px; }
        .pdf-success-note {
            background: rgba(34,197,94,0.1);
            border: 1px solid rgba(34,197,94,0.25);
            border-radius: 10px;
            padding: 1rem 1.25rem;
            color: #4ade80;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 0.6rem;
            margin-bottom: 0.5rem;
        }
        .pdf-success-note svg { width: 18px; height: 18px; flex-shrink: 0; }

        @media (max-width: 768px) {
            .pdf-gate-wrap { grid-template-columns: 1fr; gap: 2rem; }
            .info-grid, .why-grid { grid-template-columns: 1fr; }
            .syllabus-grid { grid-template-columns: 1fr; }
            .nata-hero-stats { gap: 1.5rem; }
            .highlight-strip-inner { gap: 1.5rem; }
        }
    </style>
</head>

<body>
    <?php include 'includes/loader.php'; ?>
    <?php include 'includes/nav.php'; ?>

    <!-- Hero -->
    <section class="nata-hero">
        <div class="container">
            <div class="breadcrumb" style="margin-bottom: 2rem;">
                <a href="index.php" style="color: var(--color-text-secondary);">Home</a>
                <span style="color: var(--color-text-secondary);">/</span>
                <span style="color: var(--color-primary);">NATA 2026</span>
            </div>
            <span class="nata-badge">Registration Open</span>
            <h1 class="nata-hero-title">
                NATA <span>2026</span> Guidance<br>at CAAD Chennai
            </h1>
            <p class="nata-hero-subtitle">
                Prepare for the National Aptitude Test in Architecture with experienced faculty,
                comprehensive study material, and personalised mentoring at CAAD.
            </p>
            <div class="nata-hero-stats">
                <div class="nata-stat">
                    <div class="nata-stat-number">200+</div>
                    <div class="nata-stat-label">Students Guided</div>
                </div>
                <div class="nata-stat">
                    <div class="nata-stat-number">15+</div>
                    <div class="nata-stat-label">Years Experience</div>
                </div>
                <div class="nata-stat">
                    <div class="nata-stat-number">95%</div>
                    <div class="nata-stat-label">Pass Rate</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Highlight Strip -->
    <div class="highlight-strip">
        <div class="container">
            <div class="highlight-strip-inner">
                <div class="highlight-item">
                    <strong>2 Attempts</strong>
                    <span>Per Year</span>
                </div>
                <div class="highlight-item">
                    <strong>200 Marks</strong>
                    <span>Total Score</span>
                </div>
                <div class="highlight-item">
                    <strong>Online</strong>
                    <span>Computer Based Test</span>
                </div>
                <div class="highlight-item">
                    <strong>10+2</strong>
                    <span>Minimum Qualification</span>
                </div>
                <div class="highlight-item">
                    <strong>CoA</strong>
                    <span>Conducted by Council of Architecture</span>
                </div>
            </div>
        </div>
    </div>

    <!-- PDF Download Gate -->
    <section class="section pdf-section">
        <div class="container">
            <?php if (!$pdf_unlocked): ?>
            <div class="pdf-gate-wrap">
                <!-- Left: what's inside -->
                <div class="pdf-gate-left">
                    <span class="section-label">Free Study Material</span>
                    <h2>Download NATA 2026<br>Study Notes</h2>
                    <p>Get access to CAAD's exclusive NATA preparation notes — covering all 7 sections of the exam. Enter your details to unlock the free PDFs instantly.</p>
                    <div class="pdf-list-preview">
                        <div class="pdf-list-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            01 — Visual Reasoning
                        </div>
                        <div class="pdf-list-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            02 — Logical Derivation
                        </div>
                        <div class="pdf-list-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            03 — Numerical Ability
                        </div>
                        <div class="pdf-list-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            04 — General Knowledge (Architecture & Design)
                        </div>
                        <div class="pdf-list-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            05 — Design Thinking
                        </div>
                        <div class="pdf-list-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            06 — Language Interpretation
                        </div>
                        <div class="pdf-list-item">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            07 — Design Sensitivity
                        </div>
                    </div>
                </div>

                <!-- Right: form -->
                <div class="pdf-form-card">
                    <h3>Get Free Study Notes</h3>
                    <p class="form-sub">Fill in your details to instantly unlock all 7 PDFs</p>

                    <?php if ($pdf_error): ?>
                    <div class="pdf-form-error">
                        <?php
                        $pdf_name_val  = htmlspecialchars($_POST['pdf_name'] ?? '');
                        $pdf_phone_val = htmlspecialchars($_POST['pdf_phone'] ?? '');
                        $pdf_email_val = htmlspecialchars($_POST['pdf_email'] ?? '');
                        $errors = [];
                        if (!$pdf_name_val) $errors[] = 'Full name is required.';
                        if (!$pdf_phone_val || !preg_match('/^[0-9+\s\-]{7,15}$/', $pdf_phone_val)) $errors[] = 'Enter a valid phone number (digits only, 7–15 characters).';
                        if (!$pdf_email_val || !filter_var($pdf_email_val, FILTER_VALIDATE_EMAIL)) $errors[] = 'Enter a valid email address.';
                        foreach ($errors as $err) echo '<div>⚠ ' . $err . '</div>';
                        ?>
                    </div>
                    <?php endif; ?>

                    <form method="POST" action="#study-material">
                        <input type="hidden" name="pdf_form" value="1">
                        <div class="pdf-form-group">
                            <label for="pdf_name">Full Name *</label>
                            <input type="text" id="pdf_name" name="pdf_name" required placeholder="Your name" value="<?= htmlspecialchars($_POST['pdf_name'] ?? '') ?>">
                        </div>
                        <div class="pdf-form-group">
                            <label for="pdf_phone">Phone Number *</label>
                            <input type="tel" id="pdf_phone" name="pdf_phone" required placeholder="+91 XXXXX XXXXX" value="<?= htmlspecialchars($_POST['pdf_phone'] ?? '') ?>">
                        </div>
                        <div class="pdf-form-group">
                            <label for="pdf_email">Email Address *</label>
                            <input type="email" id="pdf_email" name="pdf_email" required placeholder="you@example.com" value="<?= htmlspecialchars($_POST['pdf_email'] ?? '') ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" style="width:100%; justify-content: center; margin-top: 0.5rem;">
                            Unlock Free PDFs
                            <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                        </button>
                        <p style="font-size: 0.78rem; color: #94a3b8; margin-top: 0.9rem; text-align: center;">
                            🔒 Your information is kept private and never shared.
                        </p>
                    </form>
                </div>
            </div>

            <?php else: ?>
            <!-- Unlocked state -->
            <div class="section-header" id="study-material">
                <span class="section-label">Free Study Material</span>
                <h2 class="section-title">NATA 2026 Study Notes</h2>
                <p class="section-subtitle">Download all 7 explanatory notes below</p>
            </div>
            <div class="pdf-success-note">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                Your details have been saved. Download any or all PDFs below.
            </div>
            <div class="pdf-cards-grid">
                <?php
                $pdfs = [
                    ['file' => 'assets/NATA/01 VISUAL REASONING_EXPLANATORY NOTES.pdf',              'title' => 'Visual Reasoning'],
                    ['file' => 'assets/NATA/02 LOGICAL DERIVATION_EXPLANATORY NOTES.pdf',            'title' => 'Logical Derivation'],
                    ['file' => 'assets/NATA/03 NUMERICAL ABILITY_EXPLANATORY NOTES.pdf',             'title' => 'Numerical Ability'],
                    ['file' => 'assets/NATA/04 GENERAL KNOWLEDGE - ARCHITECTURE & DESIGN_EXPLANATORY NOTES.pdf', 'title' => 'General Knowledge — Architecture & Design'],
                    ['file' => 'assets/NATA/05 DESIGN THINKING_EXPLANATORY NOTES.pdf',              'title' => 'Design Thinking'],
                    ['file' => 'assets/NATA/06 LANGUAGE INTERPRETATION_EXPLANATORY NOTES.pdf',      'title' => 'Language Interpretation'],
                    ['file' => 'assets/NATA/07 DESIGN SENSITIVITY_EXPLANATORY NOTES.pdf',           'title' => 'Design Sensitivity'],
                ];
                foreach ($pdfs as $i => $pdf): ?>
                <div class="pdf-download-card">
                    <div class="pdf-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/></svg>
                    </div>
                    <div class="pdf-card-title">0<?= $i + 1 ?> — <?= htmlspecialchars($pdf['title']) ?></div>
                    <a href="<?= htmlspecialchars($pdf['file']) ?>" download class="pdf-download-btn">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                        Download PDF
                    </a>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- What is NATA -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Overview</span>
                <h2 class="section-title">What is NATA?</h2>
                <p class="section-subtitle">
                    The National Aptitude Test in Architecture is the gateway to B.Arch admissions across India
                </p>
            </div>
            <div class="info-grid">
                <div class="info-card">
                    <div class="info-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                    </div>
                    <h3>About NATA 2026</h3>
                    <p>NATA is a national level entrance exam conducted by the Council of Architecture (CoA) for admission to the 5-year B.Arch programme. It tests candidates on drawing, aesthetic sensitivity, critical thinking, and mathematical reasoning.</p>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    </div>
                    <h3>Key Dates 2026</h3>
                    <ul>
                        <li>Registration: January – March 2026</li>
                        <li>Attempt 1: April 2026</li>
                        <li>Attempt 2: July 2026</li>
                        <li>Results: Within 3–4 weeks of exam</li>
                        <li>Counselling: August – September 2026</li>
                    </ul>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h3>Exam Pattern</h3>
                    <ul>
                        <li>Mode: Online (Computer Based Test)</li>
                        <li>Duration: 3 hours</li>
                        <li>Total Marks: 200</li>
                        <li>Sections: Drawing, PCM, General Aptitude</li>
                        <li>No negative marking</li>
                    </ul>
                </div>
                <div class="info-card">
                    <div class="info-card-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    </div>
                    <h3>Eligibility</h3>
                    <ul>
                        <li>Passed 10+2 or equivalent with Physics, Chemistry & Maths</li>
                        <li>Minimum 50% aggregate in PCM</li>
                        <li>10+3 Diploma (any stream) holders also eligible</li>
                        <li>No upper age limit</li>
                        <li>Valid for B.Arch admissions pan-India</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Syllabus -->
    <section class="section" style="background: var(--color-dark-secondary);">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Curriculum</span>
                <h2 class="section-title">NATA 2026 Syllabus</h2>
                <p class="section-subtitle">Comprehensive coverage of all sections tested in NATA</p>
            </div>
            <div class="syllabus-grid">
                <div class="syllabus-card">
                    <h3>Drawing & Sketching</h3>
                    <ul>
                        <li>Freehand sketching</li>
                        <li>2D & 3D composition</li>
                        <li>Form transformation</li>
                        <li>Perspective drawing</li>
                        <li>Colour & texture rendering</li>
                        <li>Memory-based drawing</li>
                        <li>Imaginative drawing</li>
                    </ul>
                </div>
                <div class="syllabus-card">
                    <h3>General Aptitude</h3>
                    <ul>
                        <li>Visual perception & cognition</li>
                        <li>Architectural awareness</li>
                        <li>Logical reasoning</li>
                        <li>Mental ability</li>
                        <li>General knowledge of architecture</li>
                        <li>Sets & relations</li>
                        <li>Critical thinking</li>
                    </ul>
                </div>
                <div class="syllabus-card">
                    <h3>Physics, Chemistry & Maths</h3>
                    <ul>
                        <li>Algebra & trigonometry</li>
                        <li>Coordinate geometry</li>
                        <li>Calculus & statistics</li>
                        <li>Laws of motion & thermodynamics</li>
                        <li>Electrostatics & optics</li>
                        <li>Periodic table & bonding</li>
                        <li>Environmental chemistry</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Why CAAD for NATA -->
    <section class="section">
        <div class="container">
            <div class="section-header">
                <span class="section-label">Why Choose Us</span>
                <h2 class="section-title">NATA Coaching at CAAD</h2>
                <p class="section-subtitle">Expert guidance from architects and educators with years of coaching experience</p>
            </div>
            <div class="why-grid">
                <div class="why-card">
                    <div class="why-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    </div>
                    <div>
                        <h4>Expert Faculty</h4>
                        <p>Trained by practising architects and NATA-specialised faculty with a strong track record.</p>
                    </div>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
                    </div>
                    <div>
                        <h4>Mock Tests & Practice</h4>
                        <p>Regular full-length mock exams modelled on the latest NATA pattern with detailed feedback.</p>
                    </div>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    </div>
                    <div>
                        <h4>Study Material</h4>
                        <p>Comprehensive, updated study resources covering all NATA 2026 syllabus topics with practice sheets.</p>
                    </div>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <div>
                        <h4>Personalised Mentoring</h4>
                        <p>One-on-one doubt sessions and portfolio guidance to maximise your score potential.</p>
                    </div>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    </div>
                    <div>
                        <h4>Direct Admission Pathway</h4>
                        <p>Qualify NATA and apply directly to CAAD's B.Arch programme — no extra hurdles.</p>
                    </div>
                </div>
                <div class="why-card">
                    <div class="why-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                    </div>
                    <div>
                        <h4>Studio Environment</h4>
                        <p>Practise drawing and spatial thinking in CAAD's professional architecture studio spaces.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="section" style="background: var(--color-dark-secondary);">
        <div class="container">
            <div class="nata-cta">
                <h2>Start Your NATA 2026 Preparation</h2>
                <p>Join CAAD's NATA guidance programme and take the first step towards your architecture career.</p>
                <div class="nata-cta-buttons">
                    <a href="admissions.php#apply" class="btn btn-primary">
                        Enquire Now
                        <svg class="btn-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="tel:+919710554545" class="btn btn-outline-primary">
                        Call +91 97105 54545
                    </a>
                </div>
            </div>
        </div>
    </section>

    <?php include 'includes/footer.php'; ?>

    <script>
        (function () {
            document.documentElement.setAttribute('data-theme', 'light');
        })();

        const navToggle = document.getElementById('nav-toggle');
        const navMenu = document.getElementById('nav-menu');
        if (navToggle) {
            navToggle.addEventListener('click', () => {
                navMenu.classList.toggle('active');
                navToggle.classList.toggle('active');
            });
        }

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
