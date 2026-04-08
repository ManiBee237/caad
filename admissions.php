<?php
require_once __DIR__ . '/recaptcha-config.php';

$form_submitted = false;
$form_error = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(trim($_POST['name'] ?? ''));
    $email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
    $phone = htmlspecialchars(trim($_POST['phone'] ?? ''));
    $program = htmlspecialchars(trim($_POST['program'] ?? ''));
    $qualification = htmlspecialchars(trim($_POST['qualification'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));
    $recaptcha_ok = verifyRecaptcha($_POST['g-recaptcha-response'] ?? '');

    if ($name && $email && $phone && $program && $recaptcha_ok) {
        // Save submission to log file
        $log_entry = date('Y-m-d H:i:s') . " | Name: $name | Email: $email | Phone: $phone | Program: $program | Qualification: $qualification | Message: $message\n";
        file_put_contents(__DIR__ . '/admissions_submissions.log', $log_entry, FILE_APPEND | LOCK_EX);

        if (file_exists(__DIR__ . '/mail-config.php')) {
            require_once __DIR__ . '/mail-config.php';
            $to      = 'admin@caad.ac.in';
            $subject = "New Admission Enquiry from $name";
            $date    = date('d M Y, h:i A');
            $msgHtml = $message ? nl2br($message) : '<em style="color:#999;">No message provided</em>';
            $qualHtml = $qualification ?: '<em style="color:#999;">Not specified</em>';
            $htmlBody = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>New Admission Enquiry</title>
</head>
<body style="margin:0;padding:0;background:#f4f4f4;font-family:'Segoe UI',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f4f4f4;padding:30px 0;">
    <tr><td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:12px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.10);">

        <!-- Header -->
        <tr>
          <td style="background:linear-gradient(135deg,#1a1a2e 0%,#16213e 60%,#c9a84c 100%);padding:40px 40px 32px;text-align:center;">
            <p style="margin:0 0 6px;font-size:13px;letter-spacing:3px;color:#c9a84c;text-transform:uppercase;font-weight:600;">CAAD Chennai</p>
            <h1 style="margin:0;font-size:26px;color:#ffffff;font-weight:700;letter-spacing:0.5px;">New Admission Enquiry</h1>
            <p style="margin:10px 0 0;font-size:13px;color:rgba(255,255,255,0.6);">Received on $date</p>
          </td>
        </tr>

        <!-- Greeting -->
        <tr>
          <td style="padding:32px 40px 8px;">
            <p style="margin:0;font-size:15px;color:#444;line-height:1.6;">A prospective student has submitted an admission enquiry through the website. Here are their details:</p>
          </td>
        </tr>

        <!-- Details Card -->
        <tr>
          <td style="padding:16px 40px 8px;">
            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f9f7f2;border-radius:10px;border:1px solid #e8e0cc;overflow:hidden;">
              <tr>
                <td style="padding:18px 24px;border-bottom:1px solid #e8e0cc;">
                  <p style="margin:0 0 3px;font-size:11px;text-transform:uppercase;letter-spacing:1.5px;color:#c9a84c;font-weight:700;">Full Name</p>
                  <p style="margin:0;font-size:16px;color:#1a1a2e;font-weight:600;">$name</p>
                </td>
              </tr>
              <tr>
                <td style="padding:18px 24px;border-bottom:1px solid #e8e0cc;">
                  <p style="margin:0 0 3px;font-size:11px;text-transform:uppercase;letter-spacing:1.5px;color:#c9a84c;font-weight:700;">Email Address</p>
                  <p style="margin:0;font-size:15px;color:#1a1a2e;"><a href="mailto:$email" style="color:#1a6ecb;text-decoration:none;">$email</a></p>
                </td>
              </tr>
              <tr>
                <td style="padding:18px 24px;border-bottom:1px solid #e8e0cc;">
                  <p style="margin:0 0 3px;font-size:11px;text-transform:uppercase;letter-spacing:1.5px;color:#c9a84c;font-weight:700;">Phone Number</p>
                  <p style="margin:0;font-size:15px;color:#1a1a2e;"><a href="tel:$phone" style="color:#1a6ecb;text-decoration:none;">$phone</a></p>
                </td>
              </tr>
              <tr>
                <td style="padding:18px 24px;border-bottom:1px solid #e8e0cc;">
                  <p style="margin:0 0 3px;font-size:11px;text-transform:uppercase;letter-spacing:1.5px;color:#c9a84c;font-weight:700;">Program of Interest</p>
                  <p style="margin:0;font-size:15px;color:#1a1a2e;">$program</p>
                </td>
              </tr>
              <tr>
                <td style="padding:18px 24px;border-bottom:1px solid #e8e0cc;">
                  <p style="margin:0 0 3px;font-size:11px;text-transform:uppercase;letter-spacing:1.5px;color:#c9a84c;font-weight:700;">Current Qualification</p>
                  <p style="margin:0;font-size:15px;color:#1a1a2e;">$qualHtml</p>
                </td>
              </tr>
              <tr>
                <td style="padding:18px 24px;">
                  <p style="margin:0 0 3px;font-size:11px;text-transform:uppercase;letter-spacing:1.5px;color:#c9a84c;font-weight:700;">Message</p>
                  <p style="margin:0;font-size:15px;color:#1a1a2e;line-height:1.6;">$msgHtml</p>
                </td>
              </tr>
            </table>
          </td>
        </tr>

        <!-- CTA -->
        <tr>
          <td style="padding:24px 40px 8px;text-align:center;">
            <a href="mailto:$email" style="display:inline-block;background:linear-gradient(135deg,#c9a84c,#e8c97a);color:#1a1a2e;font-weight:700;font-size:14px;padding:14px 36px;border-radius:50px;text-decoration:none;letter-spacing:0.5px;">Reply to $name</a>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td style="padding:24px 40px 32px;text-align:center;border-top:1px solid #eee;margin-top:16px;">
            <p style="margin:0;font-size:12px;color:#999;line-height:1.6;">This email was automatically generated from the CAAD website admission enquiry form.<br>Centre for Advanced Architectural Design, Chennai.</p>
          </td>
        </tr>

      </table>
    </td></tr>
  </table>
</body>
</html>
HTML;
            sendMail($to, $subject, $htmlBody, $email, $name, true);
        } else {
            error_log("mail-config.php not found — skipping email for admission enquiry from $name");
        }

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
        content="Admissions at CAAD Chennai - Apply for B.Arch program. Anna University Counselling Code 1152. Admissions open for 2026-2027.">
    <title>Admissions | CAAD Chennai</title>

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

    <?php $current_page = 'admissions'; include 'includes/nav.php'; ?>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container">
            <div class="breadcrumb">
                <a href="index.php">Home</a>
                <span>/</span>
                <span>Admissions</span>
            </div>
            <h1 class="page-title">Admissions 2026-2027</h1>
            <p class="page-subtitle">Begin your journey in architecture and design</p>
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
                    <div class="form-group">
                        <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITE_KEY ?>"></div>
                        <p class="recaptcha-required-msg" style="display:none; color:#c00; font-size:0.85rem; margin-top:0.4rem;">Please complete the reCAPTCHA to continue.</p>
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
                <p>Apply for B.Arch program for the academic year 2026-2027</p>
            </div>
        </div>
    </section>

    <!-- Programs Comparison -->






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