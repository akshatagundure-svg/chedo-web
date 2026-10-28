<?php
// Hero Section with Laptop Visual, Animated Floating Windows & Full-Width Counter Metrics
?>
<section class="chedo-hero-section relative bg-white" id="hero-section">

  <!-- Soft Radial Blue Glow Behind Laptop -->
  <div class="chedo-hero-glow" aria-hidden="true"></div>

  <div class="chedo-hero-container">
    <!-- Main Hero Content: Left Details + Right Laptop Visual -->
    <div class="chedo-hero-main">
      <!-- Subtle Background Grid Pattern -->
      <div class="chedo-hero-grid" aria-hidden="true"></div>

      <!-- Left Column: Copy & Actions -->
      <div class="chedo-hero-left">

        <!-- Eyebrow Tag -->
        <p class="chedo-hero-eyebrow">
          <?= cms('home.learn-by-doing.01', 'PRACTICAL PROGRAMMING EDUCATION PUNE') ?>
        </p>

        <!-- Main Headline -->
        <h1 class="chedo-hero-title">
          <?= cms('home.learn-by-doing.02', 'Learn by Doing') ?><br>
          <span><?= cms('home.learn-by-doing.03', 'Guided by Experts.') ?></span>
        </h1>

        <!-- Subtitle Description (Slightly Bolder: font-weight 500) -->
        <p class="chedo-hero-desc">
          <?= cms('home.learn-by-doing.04', 'Step-by-step offline mentorship to launch your tech career.') ?>
        </p>

        <!-- Chips Tint -->
        <div class="chedo-hero-chips">
          <a href="<?= cmsu('home.learn-by-doing.05', 'courses/data-science.php') ?>" class="chip-tint">
            <svg aria-hidden="true" focusable="false" class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 6 9 17l-5-5" />
            </svg>
            <?= cms('home.learn-by-doing.06', 'AI & DATA') ?>
          </a>
          <a href="<?= cmsu('home.learn-by-doing.07', 'courses/java-full-stack.php') ?>" class="chip-tint">
            <svg aria-hidden="true" focusable="false" class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 6 9 17l-5-5" />
            </svg>
            <?= cms('home.learn-by-doing.08', 'Java Full Stack') ?>
          </a>
          <a href="<?= cmsu('home.learn-by-doing.09', 'courses/python-programming.php') ?>" class="chip-tint">
            <svg aria-hidden="true" focusable="false" class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 6 9 17l-5-5" />
            </svg>
            <?= cms('home.learn-by-doing.10', 'Python') ?>
          </a>
          <a href="<?= cmsu('home.learn-by-doing.11', 'courses/data-science-foundation.php') ?>" class="chip-tint">
            <svg aria-hidden="true" focusable="false" class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M20 6 9 17l-5-5" />
            </svg>
            <?= cms('home.learn-by-doing.12', 'Data Science Foundation') ?>
          </a>
        </div>

      </div>


      <!-- Right Column: 1. Slightly Smaller Laptop + 2. Reduced Floating Windows -->
      <div class="chedo-hero-right">
        <div class="chedo-laptop-wrapper">

          <!-- The Laptop Mockup Image (Slightly smaller) -->
          <img
            src="assets/images/laptop.webp"
            srcset="assets/images/laptop-400.webp 400w, assets/images/laptop-800.webp 800w, assets/images/laptop-1080.webp 1080w, assets/images/laptop.webp 1485w"
            sizes="(max-width: 640px) 90vw, (max-width: 1024px) 50vw, 425px"
            alt="Chedo Tech Coding Environment"
            class="chedo-laptop-img"
            width="425"
            height="280"
            fetchpriority="high"
            loading="eager"
            decoding="async">

          <!-- Floating Badge 1: Live Coding (Reduced button scale) -->
          <div class="chedo-floating-badge badge-live-coding">
            <div class="badge-icon-box">
              <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.3" stroke-linecap="round" stroke-linejoin="round">
                <polyline points="16 18 22 12 16 6"></polyline>
                <polyline points="8 6 2 12 8 18"></polyline>
              </svg>
            </div>
            <span class="badge-text"><?= cms('home.learn-by-doing.13', 'Live Coding') ?></span>
          </div>

          <!-- Floating Badge 2: Real Projects (Reduced button scale) -->
          <a href="#projects" class="chedo-floating-badge badge-real-projects cursor-pointer">
            <div class="badge-icon-box">
              <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z"></path>
              </svg>
            </div>
            <span class="badge-text"><?= cms('home.learn-by-doing.14', 'Real Projects') ?></span>
          </a>

          <!-- Floating Badge 3: Personal Mentorship (Reduced button scale) -->
          <div class="chedo-floating-badge badge-mentorship">
            <div class="badge-icon-box">
              <svg viewBox="0 0 24 24" width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                <circle cx="9" cy="7" r="4"></circle>
                <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
              </svg>
            </div>
            <span class="badge-text"><?= cms('home.learn-by-doing.15', 'Personal Mentorship') ?></span>
          </div>

        </div>

        <!-- CTA Buttons -->
        <div class="chedo-hero-cta">
          <a class="chedo-btn-primary" href="<?= cmsu('home.learn-by-doing.16', 'courses.php') ?>">
            <span><?= cms('home.learn-by-doing.17', 'Explore Courses →') ?></span>
          </a>
          <a class="chedo-btn-secondary" href="<?= cmsu('home.learn-by-doing.18', 'contact.php') ?>">
            <span><?= cms('home.learn-by-doing.19', 'Talk to a Mentor') ?></span>
          </a>
        </div>
      </div>

    </div>
    <!-- 3. Full-Width Metrics Section (One Horizontal Line, Equal Spacing, Animated Counter) -->
    <div class="chedo-hero-stats">
      <!-- Metric 1: Courses -->
      <div class="chedo-stat-item">
        <div class="chedo-stat-value">
          <svg class="chedo-stat-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 19.5v-15A2.5 2.5 0 0 1 6.5 2H20v20H6.5a2.5 2.5 0 0 1 0-5H20" />
          </svg>
          <span class="chedo-stat-num">
            <span class="stat-counter" <?= cms_counter_attrs('home.learn-by-doing.20', '15+') ?>><?= cms('home.learn-by-doing.20', '15+') ?></span>
          </span>
        </div>
        <div class="chedo-stat-label"><?= cms('home.learn-by-doing.21', 'Active Courses') ?></div>
      </div>

      <!-- Metric 2: Students -->
      <div class="chedo-stat-item">
        <div class="chedo-stat-value">
          <svg class="chedo-stat-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
            <circle cx="9" cy="7" r="4"></circle>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
          </svg>
          <span class="chedo-stat-num">
            <span class="stat-counter" <?= cms_counter_attrs('home.learn-by-doing.22', '1,324+') ?>><?= cms('home.learn-by-doing.22', '1,324+') ?></span>
          </span>
        </div>
        <div class="chedo-stat-label"><?= cms('home.learn-by-doing.23', 'Students Trained') ?></div>
      </div>

      <!-- Metric 3: Since -->
      <div class="chedo-stat-item">
        <div class="chedo-stat-value">
          <svg class="chedo-stat-icon" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
            <line x1="16" y1="2" x2="16" y2="6"></line>
            <line x1="8" y1="2" x2="8" y2="6"></line>
            <line x1="3" y1="10" x2="21" y2="10"></line>
          </svg>
          <span class="chedo-stat-num">
            <span class="text-[1.25rem] font-bold text-slate-800"><?= cms('home.learn-by-doing.24', 'Since') ?> </span><span class="stat-counter" <?= cms_counter_attrs('home.learn-by-doing.25', '2015') ?>><?= cms('home.learn-by-doing.25', '2015') ?></span>
          </span>
        </div>
        <div class="chedo-stat-label"><?= cms('home.learn-by-doing.26', 'Programming Education') ?></div>
      </div>

      <!-- Metric 4: Google Reviews -->
      <div class="chedo-stat-item">
        <div class="chedo-google-rating">
          <div class="chedo-google-title">
            <span class="google-logo-text">
              <span style="color:#4285F4"><?= cms('home.learn-by-doing.27', 'G') ?></span><span style="color:#EA4335"><?= cms('home.learn-by-doing.28', 'o') ?></span><span style="color:#FBBC05"><?= cms('home.learn-by-doing.29', 'o') ?></span><span style="color:#4285F4"><?= cms('home.learn-by-doing.30', 'g') ?></span><span style="color:#34A853"><?= cms('home.learn-by-doing.31', 'l') ?></span><span style="color:#EA4335"><?= cms('home.learn-by-doing.32', 'e') ?></span>
            </span>
            <span class="google-reviews-text"><?= cms('home.learn-by-doing.33', 'Reviews') ?></span>
          </div>
          <div class="chedo-google-score">
            <strong><?= cms('home.learn-by-doing.34', '4.9') ?></strong>
            <span class="chedo-google-stars">★★★★★</span>
            <span class="chedo-google-count"><?= cms('home.learn-by-doing.35', '(253+)') ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Scoped Styles for the Hero Redesign matching Reference -->
<style>
  .chedo-hero-section {
    position: relative;
    width: 100%;
    background-color: #ffffff;
    padding: 0 0 2rem;
    margin-top: -1.5rem;
    /* overflow: hidden removed to prevent clipping top border/shadow */
  }

  /* Full Background Grid Pattern */
  .chedo-hero-grid {
    position: absolute;
    inset: 0;
    pointer-events: none;
    border-radius: 36px;
    z-index: 0;
    background-image:
      linear-gradient(to right, rgba(203, 213, 225, 0.45) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(203, 213, 225, 0.45) 1px, transparent 1px);
    background-size: 38px 38px;
    mask-image: radial-gradient(ellipse at 50% 45%, rgba(0, 0, 0, 0.9) 30%, rgba(0, 0, 0, 0.15) 80%, transparent 100%);
    -webkit-mask-image: radial-gradient(ellipse at 50% 45%, rgba(0, 0, 0, 0.9) 30%, rgba(0, 0, 0, 0.15) 80%, transparent 100%);
  }

  /* Radial Blue Glow */
  .chedo-hero-glow {
    position: absolute;
    top: 0%;
    right: -5%;
    width: 480px;
    height: 480px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.11) 0%, rgba(37, 99, 235, 0.02) 55%, transparent 70%);
    filter: blur(80px);
    pointer-events: none;
  }

  /* Outer Container */
  .chedo-hero-container {
    position: relative;
    max-width: 100%;
    margin: 0 auto;
    padding: 0 2rem;
    z-index: 10;
  }

  /* Main Layout - Clean Section (Removed heavy 3D frame) */
  .chedo-hero-main {
    position: relative;
    width: 100%;
    box-sizing: border-box;
    display: grid;
    grid-template-columns: 1.15fr 1fr;
    gap: 3rem;
    align-items: center;
    background: #ffffff;
    border-radius: 24px;
    padding: 1.75rem 3rem;
    border: 1px solid #e2e8f0;
    box-shadow: 0 0 16px 2px rgba(0, 0, 0, 0.03), 0 8px 24px -4px rgba(0, 0, 0, 0.06);
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
    margin-top: 30px;
  }

  .chedo-hero-main:hover {
    box-shadow: 0 0 20px 2px rgba(0, 0, 0, 0.04), 0 12px 32px -4px rgba(0, 0, 0, 0.08);
  }




  .chedo-google-rating {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 4px;
  }

  .chedo-google-title {
    display: flex;
    align-items: center;
    gap: 4px;
    font-family: 'Inter', sans-serif;
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: #0f172a;
    line-height: 1.1;
    margin-bottom: 0.2rem;
  }

  .google-logo-text {
    font-family: 'Inter', sans-serif;
    font-weight: 700;
    letter-spacing: -0.02em;
  }

  .google-reviews-text {
    color: #0f172a;
    font-weight: 600;
  }

  .chedo-google-score {
    display: flex;
    align-items: center;
    gap: 6px;
    font-family: 'Inter', sans-serif;
  }

  .chedo-google-score strong {
    font-size: 1rem;
    color: #475569;
    font-weight: 700;
    line-height: 1;
  }

  .chedo-google-stars {
    color: #fbbc05;
    font-size: 0.9rem;
    letter-spacing: 1px;
    line-height: 1;
  }

  .chedo-google-count {
    color: #64748b;
    font-size: 0.82rem;
    font-weight: 500;
    font-weight: 500;
  }

  /* Left Column */
  .chedo-hero-left {
    display: flex;
    flex-direction: column;
    justify-content: center;
    z-index: 2;
    margin-top: -1rem;
  }

  /* Eyebrow */
  .chedo-hero-eyebrow {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-size: 0.8rem;
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    color: #2563eb;
    /* Your theme blue text color */
    background-color: #eff6ff;
    /* Light soft blue background tint */
    padding: 0.35rem 0.75rem;
    /* Adds padding inside the box */
    border-radius: 9999px;
    /* Makes it a fully rounded pill shape */
    display: inline-block;
    width: fit-content;
    margin: 0 0 0.8rem 0;

  }

  /* Heading */
  .chedo-hero-title {
    font-family: 'Outfit', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-size: clamp(2.3rem, 4vw, 3.8rem);
    font-weight: 800;
    line-height: 1.1;
    letter-spacing: -0.03em;
    color: #0f172a;
    margin: 0 0 1rem 0;
  }

  /* 4. Subtitle Description (Slightly Bolder: font-weight 500) */
  .chedo-hero-desc {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    font-size: 1.05rem;
    font-weight: 500;
    line-height: 1.6;
    color: #475569;
    max-width: 650px;
    margin: 0 0 1.2rem 0;
  }

  /* Hero Feature Chips */
  .chedo-hero-chips {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
  }

  .chedo-hero-chips .chip-tint {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    font-size: 0.85rem;
    font-weight: 500;
    color: #1e40af;
    background-color: #eff6ff;
    border: 1px solid #dbeafe;
    padding: 0.4rem 0.75rem;
    border-radius: 9999px;
    line-height: 1.2;
    letter-spacing: -0.01em;
    transition: all 0.2s ease;
    text-decoration: none;
    white-space: nowrap;
  }

  .chedo-hero-chips .chip-tint:hover {
    background-color: #dbeafe;
    border-color: #bfdbfe;
    transform: translateY(-2px);
    box-shadow: 0 4px 6px rgba(37, 99, 235, 0.1);
  }

  .chedo-hero-chips .chip-tint svg {
    width: 14px;
    height: 14px;
    stroke-width: 2.4;
    color: #2563eb;
    flex-shrink: 0;
  }

  /* CTA Buttons */
  .chedo-hero-cta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 0.75rem;
    margin-top: 1.5rem;
    margin-bottom: 0;
  }

  .chedo-btn-primary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 40px;
    padding: 0 1.25rem;
    background-color: #2563eb !important;
    color: #ffffff !important;
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 8px;
    text-decoration: none;
    box-shadow: 0 3px 10px rgba(37, 99, 235, 0.28);
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .chedo-btn-primary:hover {
    background-color: #1d4ed8 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(37, 99, 235, 0.35);
    color: #ffffff !important;
  }

  .chedo-btn-secondary {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    height: 40px;
    padding: 0 1.25rem;
    background-color: #f1f5f9;
    color: #334155 !important;
    font-family: 'Inter', sans-serif;
    font-size: 0.85rem;
    font-weight: 600;
    border-radius: 8px;
    border: 1px solid #e2e8f0;
    text-decoration: none;
    transition: all 0.2s cubic-bezier(0.16, 1, 0.3, 1);
  }

  .chedo-btn-secondary:hover {
    background-color: #e2e8f0;
    color: #0f172a !important;
    border-color: #cbd5e1;
    transform: translateY(-2px);
  }

  /* 3. Full-Width Metrics Grid: 4 Items Per Row */
  .chedo-hero-stats {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem 1.5rem;
    width: 90%;
    margin: 2rem auto 0 auto;
  }

  .chedo-stat-item {
    background: #ffffff;
    border: 1px solid rgba(59, 130, 246, 0.15);
    border-radius: 16px;
    padding: 16px 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    justify-content: center;
    gap: 6px;
    box-shadow: 6px 0 14px rgba(0, 0, 0, 0.04);
    cursor: pointer;
    transform: translateY(0) scale(1);
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    will-change: transform, box-shadow, border-color;
    width: 100%;
    min-height: 95px;
    box-sizing: border-box;
  }

  .chedo-stat-item:hover {
    transform: translateY(-3px) scale(1.02);
    border-color: rgba(59, 130, 246, 0.4);
    box-shadow: 0 10px 20px rgba(37, 99, 235, 0.08), 0 4px 8px rgba(37, 99, 235, 0.05), inset 0 0 0 1px rgba(37, 99, 235, 0.1);
  }

  .chedo-stat-item:active {
    transform: translateY(0px) scale(0.99);
    box-shadow: 0 2px 4px rgba(37, 99, 235, 0.04);
    transition: transform 0.1s ease, box-shadow 0.1s ease;
  }

  .chedo-stat-value {
    display: flex;
    align-items: center;
    gap: 0.3rem;
    margin-bottom: 0.2rem;
    white-space: nowrap;
  }

  .chedo-star {
    color: #f59e0b;
    font-size: 1.4rem;
    line-height: 1;
  }

  .chedo-stat-icon {
    color: #2563eb;
    margin-right: 0.3rem;
    flex-shrink: 0;
  }

  .chedo-stat-num {
    font-family: 'Outfit', sans-serif;
    font-size: 1.65rem;
    font-weight: 800;
    letter-spacing: -0.03em;
    color: #0f172a;
    line-height: 1.1;
  }

  .chedo-stat-denom {
    font-size: 1.1rem;
    font-weight: 600;
    color: #64748b;
  }

  .chedo-google-icon {
    margin-left: 0.2rem;
    vertical-align: middle;
    flex-shrink: 0;
  }

  .chedo-stat-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.82rem;
    font-weight: 500;
    color: #64748b;
    line-height: 1.3;
    white-space: nowrap;
  }

  /* 1. Laptop Size */
  .chedo-hero-right {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    z-index: 5;
    padding: 0;
  }

  .chedo-laptop-wrapper {
    position: relative;
    width: 90%;
    max-width: 480px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .chedo-laptop-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
    filter: drop-shadow(0 14px 22px rgba(15, 23, 42, 0.11));
    user-select: none;
    pointer-events: none;
  }

  /* 2. Reduced Floating Window Buttons */
  .chedo-floating-badge {
    position: absolute;
    display: flex;
    align-items: center;
    gap: 0.45rem;
    padding: 0.38rem 0.68rem;
    background: #ffffff;
    border: 1px solid rgba(219, 234, 254, 0.95);
    border-radius: 10px;
    box-shadow: 0 8px 20px -3px rgba(37, 99, 235, 0.11), 0 3px 8px -2px rgba(15, 23, 42, 0.04);
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    z-index: 25;
    white-space: nowrap;
    transition: box-shadow 0.3s ease;
  }

  .badge-icon-box {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 21px;
    height: 21px;
    border-radius: 6px;
    background-color: #eff6ff;
    color: #2563eb;
    flex-shrink: 0;
  }

  .badge-text {
    font-family: 'Inter', sans-serif;
    font-size: 0.74rem;
    font-weight: 600;
    color: #1e293b;
    letter-spacing: -0.01em;
  }

  /* Badge 1: Live Coding (Lower Left matching reference) */
  .badge-live-coding {
    left: -22px;
    top: 64%;
    animation: floatLiveCoding 6s ease-in-out infinite;
    will-change: transform;
  }

  /* Badge 2: Real Projects (Upper Right matching reference) */
  .badge-real-projects {
    right: -14px;
    top: 42%;
    animation: floatRealProjects 7s ease-in-out infinite 0.7s;
    will-change: transform;
  }

  /* Badge 3: Personal Mentorship (Lower Right matching reference) */
  .badge-mentorship {
    right: 6px;
    bottom: 8%;
    animation: floatMentorship 6.5s ease-in-out infinite 1.4s;
    will-change: transform;
  }

  /* Continuous Subtle Floating Animations */
  @keyframes floatLiveCoding {

    0%,
    100% {
      transform: translateY(0) translateX(0px);
    }

    50% {
      transform: translateY(-7px) translateX(2px);
    }
  }

  @keyframes floatRealProjects {

    0%,
    100% {
      transform: translateY(0px) translateX(0px);
    }

    50% {
      transform: translateY(-7px) translateX(-2px);
    }
  }

  @keyframes floatMentorship {

    0%,
    100% {
      transform: translateY(0px) translateX(0px);
    }

    50% {
      transform: translateY(-6px) translateX(2px);
    }
  }

  /* Grid children may shrink below their content; chips wrap instead of forcing width */
  .chedo-hero-container {
    width: 100%;
    min-width: 0;
    box-sizing: border-box;
  }

  .chedo-hero-main>* {
    min-width: 0;
  }

  .chedo-hero-cta {
    flex-wrap: wrap;
  }

  .chedo-hero-stats {
    min-width: 0;
  }

  .chedo-stat-item {
    min-width: 0;
  }

  .chedo-hero-chips {
    flex-wrap: wrap;
  }

  .chedo-laptop-wrapper {
    max-width: 100%;
  }

  .chedo-laptop-img {
    max-width: 100%;
    height: auto;
  }

  /* Responsive Media Queries */
  @media (max-width: 1024px) {
    .chedo-hero-chips {
      justify-content: center;
    }

    .chedo-google-rating,
    .chedo-google-score {
      max-width: 100%;
      flex-wrap: wrap;
      justify-content: center;
    }

    .chedo-hero-section {
      min-height: auto;
      padding: 3rem 0;
    }

    .chedo-hero-main {
      grid-template-columns: 1fr;
      gap: 3rem;
      text-align: center;
      padding: 2.5rem 2rem;
      border-radius: 28px;
    }

    .chedo-hero-left {
      align-items: center;
    }

    .chedo-hero-desc {
      max-width: 540px;
    }

    .chedo-hero-cta {
      justify-content: center;
    }

    .chedo-hero-stats {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      margin-top: 2.5rem;
      gap: 1.5rem;
    }

    .chedo-stat-item {
      padding: 14px 16px;
    }

    .chedo-hero-right {
      margin-top: 0;
    }

    .badge-live-coding {
      left: 2%;
    }

    .badge-real-projects {
      right: 2%;
    }

    .badge-mentorship {
      right: 6%;
      bottom: 8%;
    }
  }

  /* ==========================================================================
     Mobile Responsive Optimizations (Screen widths <= 768px)
     Cohesive, compact, full-width first-screen hero experience
     ========================================================================== */
  @media (max-width: 768px) {

    /* 1. Hero Section & Container */
    .chedo-hero-section {
      padding: 0.5rem 0 3.5rem;
      margin-top: 0;
      min-height: calc(100vh - 64px);
      min-height: calc(100dvh - 64px);
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: flex-start;
    }

    .chedo-hero-glow {
      width: 280px;
      height: 280px;
      right: 0;
      top: 5%;
      filter: blur(60px);
      opacity: 0.8;
    }

    .chedo-hero-container {
      padding: 0 0.875rem;
      width: 100%;
      box-sizing: border-box;
    }

    /* 2. Main Hero Box */
    .chedo-hero-main {
      grid-template-columns: 1fr;
      gap: 1.25rem;
      text-align: center;
      padding: 1.35rem 1.15rem;
      border-radius: 20px;
      margin-top: 0.45rem;
      box-shadow: 0 2px 14px rgba(0, 0, 0, 0.04), 0 1px 3px rgba(0, 0, 0, 0.02);
    }

    .chedo-hero-grid {
      border-radius: 20px;
      background-size: 28px 28px;
    }

    /* 3. Left Column: Copy & Actions */
    .chedo-hero-left {
      align-items: center;
      margin-top: 0;
    }

    .chedo-hero-eyebrow {
      font-size: clamp(0.68rem, 2.5vw, 0.74rem);
      letter-spacing: 0.08em;
      margin: 0 0 0.35rem 0;
      text-align: center;
    }

    .chedo-hero-title {
      font-size: clamp(1.65rem, 6.2vw, 2.15rem);
      line-height: 1.16;
      letter-spacing: -0.025em;
      margin: 0 0 0.5rem 0;
      text-align: center;
    }

    .chedo-hero-desc {
      font-size: clamp(0.85rem, 3.1vw, 0.95rem);
      line-height: 1.45;
      max-width: 520px;
      margin: 0 auto 0.75rem auto;
      text-align: center;
    }

    /* Feature Chips */
    .chedo-hero-chips {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      gap: 0.35rem 0.45rem;
      margin: 0 auto;
    }

    .chedo-hero-chips .chip-tint {
      font-size: clamp(0.72rem, 2.5vw, 0.8rem);
      padding: 0.28rem 0.6rem;
      gap: 0.25rem;
      line-height: 1.2;
      white-space: nowrap;
    }

    .chedo-hero-chips .chip-tint svg {
      width: 12px;
      height: 12px;
    }

    /* 4. Right Column: Laptop Visual & Floating Badges */
    .chedo-hero-right {
      width: 100%;
      margin-top: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .chedo-laptop-wrapper {
      position: relative;
      width: 100%;
      max-width: clamp(260px, 72vw, 340px);
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .chedo-laptop-img {
      width: 100%;
      height: auto;
      display: block;
      object-fit: contain;
      filter: drop-shadow(0 10px 18px rgba(15, 23, 42, 0.1));
    }

    .chedo-floating-badge {
      padding: 0.28rem 0.52rem;
      border-radius: 8px;
      box-shadow: 0 4px 12px -2px rgba(37, 99, 235, 0.12), 0 2px 6px -1px rgba(15, 23, 42, 0.05);
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
    }

    .badge-icon-box {
      width: 17px;
      height: 17px;
      border-radius: 5px;
    }

    .badge-icon-box svg {
      width: 9px;
      height: 9px;
    }

    .badge-text {
      font-size: clamp(0.6rem, 2.2vw, 0.68rem);
      font-weight: 600;
    }

    .badge-live-coding {
      left: -4px;
      top: 62%;
    }

    .badge-real-projects {
      right: -4px;
      top: 36%;
    }

    .badge-mentorship {
      right: 2px;
      bottom: 4%;
    }

    /* CTA Buttons */
    .chedo-hero-cta {
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: center;
      align-items: center;
      gap: 0.65rem;
      width: 100%;
      margin-top: 0.95rem !important;
      margin-bottom: 0;
    }

    .chedo-btn-primary,
    .chedo-btn-secondary {
      flex: 1 1 0;
      max-width: 180px;
      min-width: 130px;
      height: 42px;
      padding: 0 0.85rem;
      font-size: clamp(0.8rem, 2.7vw, 0.88rem);
      border-radius: 10px;
      text-align: center;
      white-space: nowrap;
      box-sizing: border-box;
    }

    /* 5. Metrics Section: Compact 2-Column Grid */
    .chedo-hero-stats {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      width: 100%;
      margin: 1.15rem auto 0 auto;
      gap: 0.625rem;
    }

    .chedo-stat-item {
      background: #ffffff;
      border: 1px solid rgba(59, 130, 246, 0.15);
      border-radius: 14px;
      padding: 10px 12px;
      min-height: 72px;
      width: 100%;
      box-sizing: border-box;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: flex-start;
      gap: 2px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
      cursor: pointer;
    }

    .chedo-stat-value {
      display: flex;
      align-items: center;
      gap: 0.35rem;
      margin-bottom: 0;
      width: 100%;
    }

    .chedo-stat-icon {
      display: inline-flex !important;
      width: 17px;
      height: 17px;
      flex-shrink: 0;
      color: #2563eb;
      margin-right: 0.15rem;
    }

    .chedo-stat-num {
      font-family: 'Outfit', sans-serif;
      font-size: clamp(1.15rem, 4.2vw, 1.35rem);
      font-weight: 800;
      line-height: 1.1;
      color: #0f172a;
      white-space: nowrap;
    }

    .chedo-stat-num>span:not(.stat-counter) {
      font-size: 0.75em !important;
      font-weight: 700 !important;
    }

    .chedo-stat-label {
      font-family: 'Inter', sans-serif;
      font-size: clamp(0.68rem, 2.4vw, 0.78rem);
      line-height: 1.25;
      color: #64748b;
      font-weight: 500;
      white-space: normal;
      overflow: visible;
    }

    /* Metric 4: Google Reviews Card */
    .chedo-google-rating {
      display: flex;
      flex-direction: column;
      align-items: flex-start;
      justify-content: center;
      gap: 2px;
      width: 100%;
    }

    .chedo-google-title {
      display: flex;
      align-items: center;
      gap: 3px;
      font-family: 'Inter', sans-serif;
      font-size: clamp(0.95rem, 3.6vw, 1.15rem);
      font-weight: 700;
      letter-spacing: -0.02em;
      color: #0f172a;
      line-height: 1.15;
      margin-bottom: 1px;
      white-space: nowrap;
    }

    .google-logo-text {
      font-weight: 700;
      letter-spacing: -0.02em;
    }

    .google-reviews-text {
      color: #0f172a;
      font-weight: 600;
    }

    .chedo-google-score {
      display: flex;
      align-items: center;
      flex-wrap: nowrap;
      gap: 4px;
      line-height: 1;
    }

    .chedo-google-score strong {
      font-size: clamp(0.92rem, 3.2vw, 1.05rem);
      font-weight: 700;
      color: #334155;
      line-height: 1;
    }

    .chedo-google-stars {
      color: #fbbc05;
      font-size: clamp(0.72rem, 2.5vw, 0.85rem);
      letter-spacing: 0.5px;
      line-height: 1;
    }

    .chedo-google-count {
      color: #64748b;
      font-size: clamp(0.66rem, 2.2vw, 0.75rem);
      font-weight: 500;
      line-height: 1;
    }
  }

  /* Extra Small Devices (Screen widths <= 480px) */
  @media (max-width: 480px) {
    .chedo-hero-container {
      padding: 0 0.75rem;
    }

    .chedo-hero-main {
      padding: 1.1rem 0.85rem;
      gap: 1rem;
      border-radius: 18px;
    }

    .chedo-hero-grid {
      border-radius: 18px;
    }

    .chedo-hero-stats {
      margin-top: 1.05rem;
      gap: 0.55rem;
    }

    .chedo-stat-item {
      padding: 9px 10px;
      min-height: 68px;
    }
  }

  /* Ultra Small Devices (Screen widths <= 360px down to 320px) */
  @media (max-width: 360px) {
    .chedo-hero-container {
      padding: 0 0.5rem;
    }

    .chedo-hero-main {
      padding: 1rem 0.65rem;
      gap: 0.9rem;
      border-radius: 16px;
    }

    .chedo-hero-grid {
      border-radius: 16px;
    }

    .chedo-hero-title {
      font-size: 1.55rem;
    }

    .chedo-laptop-wrapper {
      max-width: 245px;
    }

    .badge-live-coding {
      left: 0;
    }

    .badge-real-projects {
      right: 0;
    }

    .badge-mentorship {
      right: 0;
    }

    .chedo-hero-cta {
      gap: 0.45rem;
    }

    .chedo-btn-primary,
    .chedo-btn-secondary {
      min-width: 120px;
      padding: 0 0.6rem;
      font-size: 0.78rem;
    }

    .chedo-hero-stats {
      margin-top: 0.95rem;
      gap: 0.45rem;
    }

    .chedo-stat-item {
      padding: 8px 7px;
      border-radius: 12px;
      min-height: 62px;
    }

    .chedo-stat-icon {
      width: 14px;
      height: 14px;
      margin-right: 0.1rem;
    }

    .chedo-stat-num {
      font-size: 1.05rem;
    }

    .chedo-stat-label {
      font-size: 0.64rem;
    }

    .chedo-google-title {
      font-size: 0.88rem;
    }

    .chedo-google-score strong {
      font-size: 0.85rem;
    }

    .chedo-google-stars {
      font-size: 0.68rem;
    }

    .chedo-google-count {
      font-size: 0.62rem;
    }
  }
</style>

<!-- Counter Animation Script for Metrics -->
<script>
  // The HTML holds the real numbers (for search engines and no-JS visitors);
  // reset them to 0 before first paint so they can count up.
  var heroReduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;
  if (!heroReduceMotion) {
    document.querySelectorAll('.stat-counter').forEach(function(el) {
      el.textContent = '0';
    });
  }

  document.addEventListener('DOMContentLoaded', function() {
    if (heroReduceMotion) return;
    var counters = document.querySelectorAll('.stat-counter');
    var animated = false;

    function easeOutExpo(t) {
      return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
    }

    function startCounting() {
      if (animated) return;
      animated = true;

      var duration = 1800; // ms
      var startTime = null;

      var counterData = Array.from(counters).map(function(el) {
        return {
          el: el,
          target: parseFloat(el.getAttribute('data-target')) || 0,
          decimals: parseInt(el.getAttribute('data-decimals')) || 0,
          suffix: el.getAttribute('data-suffix') || '',
          format: el.getAttribute('data-format') || ''
        };
      });

      function step(timestamp) {
        if (!startTime) startTime = timestamp;
        var progress = Math.min((timestamp - startTime) / duration, 1);
        var eased = easeOutExpo(progress);

        counterData.forEach(function(item) {
          var current = item.target * eased;
          var formatted = item.decimals > 0 ? current.toFixed(item.decimals) : Math.floor(current);

          if (item.format === 'comma') {
            formatted = Math.floor(current).toLocaleString('en-US');
          }

          item.el.textContent = formatted + item.suffix;
        });

        if (progress < 1) {
          requestAnimationFrame(step);
        } else {
          // Final values guarantee
          counterData.forEach(function(item) {
            var formatted = item.decimals > 0 ? item.target.toFixed(item.decimals) : item.target;
            if (item.format === 'comma') {
              formatted = item.target.toLocaleString('en-US');
            }
            item.el.textContent = formatted + item.suffix;
          });
        }
      }

      requestAnimationFrame(step);
    }

    // Use IntersectionObserver or run immediately if visible
    var heroSection = document.getElementById('hero-section');
    if ('IntersectionObserver' in window && heroSection) {
      var observer = new IntersectionObserver(function(entries) {
        if (entries[0].isIntersecting) {
          startCounting();
          observer.disconnect();
        }
      }, {
        threshold: 0.1
      });
      observer.observe(heroSection);
    } else {
      setTimeout(startCounting, 100);
    }
  });
</script>