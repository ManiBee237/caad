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
        if (file_exists(__DIR__ . '/mail-config.php')) {
            require_once __DIR__ . '/mail-config.php';
            $date = date('d M Y, h:i A');

            // --- PDF attachments list ---
            $pdf_files = [
                ['path' => __DIR__ . '/assets/NATA/01 VISUAL REASONING_EXPLANATORY NOTES.pdf',              'name' => '01 - Visual Reasoning.pdf'],
                ['path' => __DIR__ . '/assets/NATA/02 LOGICAL DERIVATION_EXPLANATORY NOTES.pdf',            'name' => '02 - Logical Derivation.pdf'],
                ['path' => __DIR__ . '/assets/NATA/03 NUMERICAL ABILITY_EXPLANATORY NOTES.pdf',             'name' => '03 - Numerical Ability.pdf'],
                ['path' => __DIR__ . '/assets/NATA/04 GENERAL KNOWLEDGE - ARCHITECTURE & DESIGN_EXPLANATORY NOTES.pdf', 'name' => '04 - General Knowledge Architecture & Design.pdf'],
                ['path' => __DIR__ . '/assets/NATA/05 DESIGN THINKING_EXPLANATORY NOTES.pdf',              'name' => '05 - Design Thinking.pdf'],
                ['path' => __DIR__ . '/assets/NATA/06 LANGUAGE INTERPRETATION_EXPLANATORY NOTES.pdf',      'name' => '06 - Language Interpretation.pdf'],
                ['path' => __DIR__ . '/assets/NATA/07 DESIGN SENSITIVITY_EXPLANATORY NOTES.pdf',           'name' => '07 - Design Sensitivity.pdf'],
            ];

            // --- 1. Email PDFs to the user ---
            $user_subject = "Your NATA 2026 Study Notes from CAAD Chennai";
            $user_body    = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head><meta charset="UTF-8"><meta name="viewport" content="width=device-width,initial-scale=1.0"></head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:'Segoe UI',Arial,sans-serif;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:40px 0;">
    <tr><td align="center">
      <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">

        <!-- Header -->
        <tr>
          <td style="background:linear-gradient(135deg,#1a2035 0%,#2d3a55 100%);padding:40px;text-align:center;">
            <div style="display:inline-block;background:rgba(184,150,92,0.15);border:1px solid rgba(184,150,92,0.4);border-radius:8px;padding:8px 18px;margin-bottom:16px;">
              <span style="color:#b8965c;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">NATA 2026 Study Material</span>
            </div>
            <h1 style="margin:0;color:#ffffff;font-size:26px;font-weight:700;">Hi $pdf_name,</h1>
            <p style="margin:10px 0 0;color:rgba(255,255,255,0.6);font-size:15px;">Your free NATA 2026 study notes are attached below.</p>
          </td>
        </tr>

        <!-- Gold strip -->
        <tr>
          <td style="background:#b8965c;padding:12px 40px;text-align:center;">
            <p style="margin:0;color:#1a2035;font-size:13px;font-weight:600;">7 PDFs attached to this email — save them for your preparation!</p>
          </td>
        </tr>

        <!-- Body -->
        <tr>
          <td style="padding:36px 40px 20px;">
            <p style="margin:0 0 20px;color:#374151;font-size:15px;line-height:1.7;">Thank you for your interest in CAAD's NATA guidance programme. We have attached all 7 study notes covering every section of the NATA 2026 exam.</p>

            <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border-radius:10px;overflow:hidden;">
              <tr style="background:#1a2035;">
                <td style="padding:10px 16px;color:#b8965c;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;">#</td>
                <td style="padding:10px 16px;color:#b8965c;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;">Study Note</td>
              </tr>
              <tr><td style="padding:9px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">01</td><td style="padding:9px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Visual Reasoning</td></tr>
              <tr><td style="padding:9px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">02</td><td style="padding:9px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Logical Derivation</td></tr>
              <tr><td style="padding:9px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">03</td><td style="padding:9px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Numerical Ability</td></tr>
              <tr><td style="padding:9px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">04</td><td style="padding:9px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">General Knowledge — Architecture &amp; Design</td></tr>
              <tr><td style="padding:9px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">05</td><td style="padding:9px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Design Thinking</td></tr>
              <tr><td style="padding:9px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">06</td><td style="padding:9px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Language Interpretation</td></tr>
              <tr><td style="padding:9px 16px;color:#64748b;font-size:13px;">07</td><td style="padding:9px 16px;color:#1a2035;font-size:13px;font-weight:500;">Design Sensitivity</td></tr>
            </table>
          </td>
        </tr>

        <!-- Next step -->
        <tr>
          <td style="padding:8px 40px 36px;">
            <div style="background:rgba(184,150,92,0.08);border:1px solid rgba(184,150,92,0.2);border-radius:10px;padding:20px 24px;">
              <p style="margin:0 0 6px;color:#1a2035;font-size:14px;font-weight:700;">Ready to take the next step?</p>
              <p style="margin:0 0 16px;color:#64748b;font-size:13px;line-height:1.6;">Join CAAD's B.Arch programme and get expert NATA coaching directly on campus.</p>
              <a href="https://caad.ac.in/admissions.php" style="display:inline-block;background:linear-gradient(135deg,#b8965c,#d4af7a);color:#ffffff;font-weight:700;font-size:13px;padding:12px 28px;border-radius:8px;text-decoration:none;">Apply for Admissions</a>
            </div>
          </td>
        </tr>

        <!-- Footer -->
        <tr>
          <td style="background:#f8fafc;border-top:1px solid #e2e8f0;padding:24px 40px;text-align:center;">
            <p style="margin:0;color:#64748b;font-size:13px;font-weight:600;">CAAD — Chennai Academy of Architecture &amp; Design</p>
            <p style="margin:6px 0 0;color:#94a3b8;font-size:12px;">+91 97105 54545 &nbsp;|&nbsp; admin@caad.ac.in &nbsp;|&nbsp; caad.ac.in</p>
          </td>
        </tr>

      </table>
    </td></tr>
  </table>
</body>
</html>
HTML;
            sendMail($pdf_email, $user_subject, $user_body, 'admin@caad.ac.in', 'CAAD Chennai', true, $pdf_files);

            // --- 2. Admin notification (no attachments) ---
            $to      = 'admin@caad.ac.in';
            $subject = "New NATA Study Material Lead - $pdf_name";
            $date    = date('d M Y, h:i A');
            $body    = <<<HTML
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body style="margin:0;padding:0;background:#f1f5f9;font-family:'Segoe UI',Arial,sans-serif;">

  <table width="100%" cellpadding="0" cellspacing="0" style="background:#f1f5f9;padding:40px 0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;width:100%;background:#ffffff;border-radius:16px;overflow:hidden;box-shadow:0 4px 24px rgba(0,0,0,0.08);">

          <!-- Header -->
          <tr>
            <td style="background:linear-gradient(135deg,#1a2035 0%,#2d3a55 100%);padding:36px 40px;text-align:center;">
              <div style="display:inline-block;background:rgba(184,150,92,0.15);border:1px solid rgba(184,150,92,0.4);border-radius:8px;padding:8px 18px;margin-bottom:16px;">
                <span style="color:#b8965c;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;">NATA 2026 — Study Material</span>
              </div>
              <h1 style="margin:0;color:#ffffff;font-size:26px;font-weight:700;letter-spacing:-0.5px;">New PDF Download Lead</h1>
              <p style="margin:10px 0 0;color:rgba(255,255,255,0.55);font-size:14px;">Someone just unlocked the NATA study notes</p>
            </td>
          </tr>

          <!-- Alert Banner -->
          <tr>
            <td style="background:#b8965c;padding:12px 40px;text-align:center;">
              <p style="margin:0;color:#1a2035;font-size:13px;font-weight:600;">A new lead has been captured — follow up soon!</p>
            </td>
          </tr>

          <!-- Lead Details -->
          <tr>
            <td style="padding:36px 40px 24px;">
              <h2 style="margin:0 0 20px;color:#1a2035;font-size:16px;font-weight:700;text-transform:uppercase;letter-spacing:1px;border-bottom:2px solid #f1f5f9;padding-bottom:12px;">Lead Details</h2>

              <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                  <td style="padding:12px 16px;background:#f8fafc;border-radius:8px;margin-bottom:8px;display:block;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="32" valign="middle">
                          <div style="width:32px;height:32px;background:rgba(184,150,92,0.12);border-radius:8px;text-align:center;line-height:32px;font-size:14px;color:#b8965c;font-weight:700;">N</div>
                        </td>
                        <td style="padding-left:12px;" valign="middle">
                          <p style="margin:0;font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Full Name</p>
                          <p style="margin:2px 0 0;font-size:15px;color:#1a2035;font-weight:600;">$pdf_name</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr><td style="height:8px;"></td></tr>
                <tr>
                  <td style="padding:12px 16px;background:#f8fafc;border-radius:8px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="32" valign="middle">
                          <div style="width:32px;height:32px;background:rgba(184,150,92,0.12);border-radius:8px;text-align:center;line-height:32px;font-size:14px;color:#b8965c;font-weight:700;">P</div>
                        </td>
                        <td style="padding-left:12px;" valign="middle">
                          <p style="margin:0;font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Phone Number</p>
                          <p style="margin:2px 0 0;font-size:15px;color:#1a2035;font-weight:600;">$pdf_phone</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr><td style="height:8px;"></td></tr>
                <tr>
                  <td style="padding:12px 16px;background:#f8fafc;border-radius:8px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="32" valign="middle">
                          <div style="width:32px;height:32px;background:rgba(184,150,92,0.12);border-radius:8px;text-align:center;line-height:32px;font-size:14px;color:#b8965c;font-weight:700;">E</div>
                        </td>
                        <td style="padding-left:12px;" valign="middle">
                          <p style="margin:0;font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Email Address</p>
                          <p style="margin:2px 0 0;font-size:15px;color:#1a2035;font-weight:600;">$pdf_email</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
                <tr><td style="height:8px;"></td></tr>
                <tr>
                  <td style="padding:12px 16px;background:#f8fafc;border-radius:8px;">
                    <table width="100%" cellpadding="0" cellspacing="0">
                      <tr>
                        <td width="32" valign="middle">
                          <div style="width:32px;height:32px;background:rgba(184,150,92,0.12);border-radius:8px;text-align:center;line-height:32px;font-size:14px;color:#b8965c;font-weight:700;">T</div>
                        </td>
                        <td style="padding-left:12px;" valign="middle">
                          <p style="margin:0;font-size:11px;color:#94a3b8;text-transform:uppercase;letter-spacing:0.8px;font-weight:600;">Submitted At</p>
                          <p style="margin:2px 0 0;font-size:15px;color:#1a2035;font-weight:600;">$date</p>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- What they downloaded -->
          <tr>
            <td style="padding:0 40px 32px;">
              <h2 style="margin:0 0 14px;color:#1a2035;font-size:16px;font-weight:700;text-transform:uppercase;letter-spacing:1px;border-bottom:2px solid #f1f5f9;padding-bottom:12px;">PDFs Unlocked</h2>
              <table width="100%" cellpadding="0" cellspacing="0" style="background:#f8fafc;border-radius:10px;overflow:hidden;">
                <tr style="background:#1a2035;">
                  <td style="padding:10px 16px;color:#b8965c;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;">#</td>
                  <td style="padding:10px 16px;color:#b8965c;font-size:11px;font-weight:700;letter-spacing:1px;text-transform:uppercase;">Study Note</td>
                </tr>
                <tr><td style="padding:8px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">01</td><td style="padding:8px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Visual Reasoning</td></tr>
                <tr><td style="padding:8px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">02</td><td style="padding:8px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Logical Derivation</td></tr>
                <tr><td style="padding:8px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">03</td><td style="padding:8px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Numerical Ability</td></tr>
                <tr><td style="padding:8px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">04</td><td style="padding:8px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">General Knowledge — Architecture &amp; Design</td></tr>
                <tr><td style="padding:8px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">05</td><td style="padding:8px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Design Thinking</td></tr>
                <tr><td style="padding:8px 16px;color:#64748b;font-size:13px;border-bottom:1px solid #e2e8f0;">06</td><td style="padding:8px 16px;color:#1a2035;font-size:13px;font-weight:500;border-bottom:1px solid #e2e8f0;">Language Interpretation</td></tr>
                <tr><td style="padding:8px 16px;color:#64748b;font-size:13px;">07</td><td style="padding:8px 16px;color:#1a2035;font-size:13px;font-weight:500;">Design Sensitivity</td></tr>
              </table>
            </td>
          </tr>

          <!-- CTA -->
          <tr>
            <td style="padding:0 40px 36px;text-align:center;">
              <a href="mailto:$pdf_email" style="display:inline-block;background:linear-gradient(135deg,#b8965c,#d4af7a);color:#ffffff;font-weight:700;font-size:14px;padding:14px 32px;border-radius:8px;text-decoration:none;letter-spacing:0.3px;">Reply to $pdf_name</a>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#f8fafc;border-top:1px solid #e2e8f0;padding:24px 40px;text-align:center;">
              <p style="margin:0;color:#94a3b8;font-size:12px;">This is an automated notification from <strong style="color:#64748b;">CAAD Chennai</strong> — caad.ac.in</p>
              <p style="margin:6px 0 0;color:#cbd5e1;font-size:11px;">Chennai Academy of Architecture &amp; Design</p>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
HTML;
            sendMail($to, $subject, $body, $pdf_email, $pdf_name, true);
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
                        <div style="margin-top:1rem;padding-top:1rem;border-top:1px solid rgba(255,255,255,0.08);">
                            <p style="font-size:0.8rem;color:var(--color-primary);font-weight:700;margin-bottom:0.6rem;text-transform:uppercase;letter-spacing:0.08em;">+ Bite-Size MCQ Practice Sets</p>
                            <div class="pdf-list-item">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2m-6 9l2 2 4-4"/></svg>
                                26 Bite-Size MCQ Sets — Day-wise Practice
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: form -->
                <div class="pdf-form-card">
                    <h3>Get Free Study Notes</h3>
                    <p class="form-sub">Fill in your details to unlock 7 Study Notes + 26 MCQ Practice Sets</p>

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
            <!-- Sent state -->
            <div id="study-material">
                <!-- Success banner -->
                <div style="text-align:center;padding:2rem 1rem 2.5rem;">
                    <div style="width:64px;height:64px;background:rgba(34,197,94,0.1);border:2px solid rgba(34,197,94,0.3);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#22c55e" stroke-width="2.5" width="30" height="30"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2 style="font-family:var(--font-serif);font-size:1.8rem;color:var(--color-white);margin-bottom:0.6rem;">Study Material Unlocked!</h2>
                    <p style="color:var(--color-text-secondary);font-size:1rem;line-height:1.7;margin-bottom:0.25rem;">
                        Study notes have been emailed to <strong style="color:var(--color-primary);"><?= htmlspecialchars($pdf_email) ?></strong>.
                    </p>
                    <p style="color:var(--color-text-secondary);font-size:0.88rem;">Download everything directly below — Notes &amp; MCQ sets in two sections.</p>
                </div>

                <!-- Section: Study Notes -->
                <div style="margin-bottom:3rem;">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                        <span style="display:inline-block;background:var(--color-primary);color:var(--color-dark);font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;padding:0.3rem 0.85rem;border-radius:50px;">Study Notes</span>
                        <span style="font-size:0.85rem;color:var(--color-text-secondary);">7 explanatory PDFs covering all NATA sections</span>
                    </div>
                    <div class="pdf-cards-grid">
                        <?php
                        $notes = [
                            ['01 VISUAL REASONING_EXPLANATORY NOTES.pdf',                         '01 — Visual Reasoning'],
                            ['02 LOGICAL DERIVATION_EXPLANATORY NOTES.pdf',                       '02 — Logical Derivation'],
                            ['03 NUMERICAL ABILITY_EXPLANATORY NOTES.pdf',                        '03 — Numerical Ability'],
                            ['04 GENERAL KNOWLEDGE - ARCHITECTURE & DESIGN_EXPLANATORY NOTES.pdf','04 — General Knowledge: Architecture &amp; Design'],
                            ['05 DESIGN THINKING_EXPLANATORY NOTES.pdf',                          '05 — Design Thinking'],
                            ['06 LANGUAGE INTERPRETATION_EXPLANATORY NOTES.pdf',                  '06 — Language Interpretation'],
                            ['07 DESIGN SENSITIVITY_EXPLANATORY NOTES.pdf',                       '07 — Design Sensitivity'],
                        ];
                        foreach ($notes as $note): ?>
                        <div class="pdf-download-card">
                            <div class="pdf-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                            </div>
                            <div class="pdf-card-title"><?= $note[1] ?></div>
                            <a href="assets/NATA/<?= rawurlencode($note[0]) ?>" download class="pdf-download-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Download
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Section: MCQ Practice Sets -->
                <div style="margin-bottom:2.5rem;">
                    <div style="display:flex;align-items:center;gap:0.75rem;margin-bottom:1.25rem;">
                        <span style="display:inline-block;background:rgba(184,150,92,0.15);border:1px solid rgba(184,150,92,0.35);color:var(--color-primary);font-size:0.75rem;font-weight:700;letter-spacing:0.08em;text-transform:uppercase;padding:0.3rem 0.85rem;border-radius:50px;">MCQ Practice Sets</span>
                        <span style="font-size:0.85rem;color:var(--color-text-secondary);">26 bite-size MCQ sets for daily practice</span>
                    </div>
                    <div class="pdf-cards-grid">
                        <?php
                        $mcq_sets = ['01','02','03','04','05','08','10','11','12','13','14','15','16','17','18','19','20','22','23','24','25','26','27','28','29','30'];
                        foreach ($mcq_sets as $num): ?>
                        <div class="pdf-download-card">
                            <div class="pdf-card-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 5H7a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-2M9 5a2 2 0 0 0 2 2h2a2 2 0 0 0 2-2M9 5a2 2 0 0 0 2-2h2a2 2 0 0 0 2 2m-6 9l2 2 4-4"/></svg>
                            </div>
                            <div class="pdf-card-title">Bite-Size MCQ — Set <?= $num ?></div>
                            <a href="assets/NATA/MCQ/<?= $num ?>_BITESIZE%20MCQ.pdf" download class="pdf-download-btn">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
                                Download
                            </a>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;padding-top:0.5rem;">
                    <a href="admissions.php#apply" class="btn btn-primary">Apply to CAAD</a>
                    <a href="index.php" class="btn btn-outline-primary">Back to Home</a>
                </div>
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
