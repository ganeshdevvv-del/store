<?php
session_start();
$flash = $_SESSION["flash"] ?? "";
$flash_type = $_SESSION["flash_type"] ?? "success";
unset($_SESSION["flash"], $_SESSION["flash_type"]);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Send Us a Message</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      min-height: 100vh;
      display: grid;
      place-items: center;
      padding: 24px;
      font-family: Arial, Helvetica, sans-serif;
      color: #172033;
      background:
        linear-gradient(rgba(17, 35, 48, 0.24), rgba(17, 35, 48, 0.24)),
        radial-gradient(ellipse at 15% 45%, #54745e 0 7%, transparent 18%),
        radial-gradient(ellipse at 92% 48%, #527b4d 0 8%, transparent 19%),
        linear-gradient(135deg, #cbd8dc, #eef2f1 45%, #a9b9bc);
      overflow-x: hidden;
    }

    /* Soft office-like background details */
    body::before {
      content: "";
      position: fixed;
      inset: 0;
      z-index: -1;
      background:
        linear-gradient(90deg, transparent 0 8%, rgba(255,255,255,.28) 8.3% 8.7%, transparent 9% 90%, rgba(255,255,255,.3) 90.3% 90.7%, transparent 91%),
        repeating-linear-gradient(0deg, transparent 0 105px, rgba(255,255,255,.28) 107px 112px),
        linear-gradient(180deg, rgba(255,255,255,.55), transparent 38%, rgba(43,64,69,.12));
      filter: blur(5px);
    }

    .contact-card {
      width: min(100%, 720px);
      padding: 32px 38px 30px;
      background: rgba(255, 255, 255, 0.96);
      border: 1px solid rgba(255, 255, 255, 0.8);
      border-radius: 15px;
      box-shadow: 0 18px 50px rgba(24, 39, 54, 0.18);
    }

    h1 {
      margin-bottom: 9px;
      font-size: clamp(24px, 4vw, 32px);
      font-weight: 700;
      letter-spacing: -0.7px;
    }

    .intro {
      margin-bottom: 24px;
      color: #718096;
      font-size: 14px;
      line-height: 1.5;
    }

    .flash-message {
      margin-bottom: 18px;
      padding: 12px 16px;
      border-radius: 8px;
      font-size: 14px;
      font-weight: 600;
      animation: fadeIn 0.3s ease-in;
    }

    .flash-success {
      background: #e8f5e9;
      color: #2e7d32;
      border: 1px solid #a5d6a7;
    }

    .flash-error {
      background: #ffebee;
      color: #c62828;
      border: 1px solid #ef9a9a;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-8px); }
      to { opacity: 1; transform: translateY(0); }
    }

    .form-grid {
      display: grid;
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 18px 24px;
    }

    .field {
      min-width: 0;
    }

    .field.full-width {
      grid-column: 1 / -1;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #273449;
      font-size: 13px;
      font-weight: 600;
    }

    .required {
      color: #ef4444;
    }

    input,
    select,
    textarea {
      width: 100%;
      border: 1px solid #dce3ec;
      border-radius: 8px;
      outline: none;
      background: #fff;
      color: #243247;
      font: inherit;
      font-size: 13px;
      transition: border-color .2s, box-shadow .2s;
    }

    input,
    select {
      height: 46px;
      padding: 0 14px;
    }

    textarea {
      min-height: 105px;
      padding: 13px 14px;
      resize: vertical;
    }

    input::placeholder,
    textarea::placeholder {
      color: #9aa6b7;
    }

    input:focus,
    select:focus,
    textarea:focus {
      border-color: #1769f5;
      box-shadow: 0 0 0 3px rgba(23, 105, 245, .12);
    }

    select {
      appearance: none;
      cursor: pointer;
      background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='14' height='14' viewBox='0 0 24 24' fill='none' stroke='%23718096' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 14px center;
      padding-right: 38px;
    }

    .btn-row {
      display: flex;
      gap: 12px;
      margin-top: 18px;
    }

    button, .btn-link {
      flex: 1;
      min-height: 48px;
      border: 0;
      border-radius: 9px;
      font-size: 14px;
      font-weight: 700;
      cursor: pointer;
      transition: background .2s, transform .2s;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      justify-content: center;
    }

    button {
      background: #0864f7;
      color: #fff;
      box-shadow: 0 5px 12px rgba(8, 100, 247, .2);
    }

    button:hover {
      background: #0055df;
      transform: translateY(-1px);
    }

    button:active {
      transform: translateY(0);
    }

    .btn-link {
      background: #f0f4f8;
      color: #334155;
      border: 1px solid #dce3ec;
    }

    .btn-link:hover {
      background: #e2e8f0;
      transform: translateY(-1px);
    }

    .arrow {
      margin-left: 7px;
      font-size: 17px;
      vertical-align: -1px;
    }

    @media (max-width: 560px) {
      body {
        padding: 16px;
      }

      .contact-card {
        padding: 25px 20px;
      }

      .form-grid {
        grid-template-columns: 1fr;
        gap: 16px;
      }

      .field.full-width {
        grid-column: auto;
      }

      .btn-row {
        flex-direction: column;
      }
    }
  </style>
</head>
<body>
  <main class="contact-card">
    <h1>Send Us a Message</h1>
    <p class="intro">Fill out the form below and we'll get back to you soon.</p>

    <?php if ($flash !== ""): ?>
      <div class="flash-message flash-<?= htmlspecialchars($flash_type) ?>" role="status">
        <?= htmlspecialchars($flash, ENT_QUOTES | ENT_SUBSTITUTE, "UTF-8") ?>
      </div>
    <?php endif; ?>

    <form id="contactForm" method="POST" action="registerform.php">
      <div class="form-grid">
        <div class="field">
          <label for="name">Your Name <span class="required">*</span></label>
          <input type="text" id="name" name="name" placeholder="Enter your name" required>
        </div>

        <div class="field">
          <label for="email">Email Address <span class="required">*</span></label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="field">
          <label for="phone">Phone Number</label>
          <input type="tel" id="phone" name="phone" placeholder="Enter your phone number">
        </div>

        <div class="field">
          <label for="subject">Subject <span class="required">*</span></label>
          <select id="subject" name="subject" required>
            <option value="" selected disabled>Select a subject</option>
            <option value="General Inquiry">General Inquiry</option>
            <option value="Project Discussion">Project Discussion</option>
            <option value="Support">Support</option>
            <option value="Feedback">Feedback</option>
            <option value="Other">Other</option>
          </select>
        </div>

        <div class="field full-width">
          <label for="message">Message <span class="required">*</span></label>
          <textarea id="message" name="message" placeholder="Tell us about your project or requirements..." required></textarea>
        </div>
      </div>

      <div class="btn-row">
        <button type="submit">Send Message <span class="arrow">→</span></button>
        <a href="view.php" class="btn-link">View Registrations</a>
      </div>
    </form>
  </main>
</body>
</html>
