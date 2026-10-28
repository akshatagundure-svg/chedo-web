<?php
$page_title = "Data Engineer Course in Pune | Chedo Tech";
$page_description = "Learn data science in Pune at Chedo Tech — Python, Pandas, machine learning with scikit-learn, AI (NLP, transformers), statistics, Power BI and MLOps, fully offline and project-driven.";
$page_canonical = "https://chedo.in/courses/data-engineer.php";
$page_extra_css = ['/assets/css/course-hero.css?v=20261024'];
include '../includes/header.php';
?>

<style>
  /* ==========================================================================
     CHEDO TECH DATA ENGINEER — EXACT PIXEL-ACCURATE DESIGN SYSTEM (VANILLA CSS)
     ========================================================================== */
  .data-engineer-page {
    font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: #1e293b;
    background-color: #ffffff;
    -webkit-font-smoothing: antialiased;
    box-sizing: border-box;
  }

  .data-engineer-page *,
  .data-engineer-page *::before,
  .data-engineer-page *::after {
    box-sizing: border-box;
  }

  .de-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    width: 100%;
  }

  .de-container-narrow {
    max-width: 1060px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
  }

  /* ---------------- HERO SECTION ---------------- */
  .de-hero-section {
    background: radial-gradient(circle at 50% 0%, rgba(219, 234, 254, 0.65) 0%, rgba(240, 249, 255, 0.45) 45%, #ffffff 85%);
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid #e2e8f0;
    padding: 0;
  }

  .de-grid-overlay {
    position: absolute;
    inset: 0;
    background-image: linear-gradient(to right, rgba(203, 213, 225, 0.45) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(203, 213, 225, 0.45) 1px, transparent 1px);
    background-size: 32px 32px;
    mask-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.2) 75%, transparent 100%);
    -webkit-mask-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.2) 75%, transparent 100%);
    pointer-events: none;
  }

  .de-hero-section .de-container {
    max-width: 1400px;
  }

  .de-hero-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 36px;
    position: relative;
    z-index: 10;
  }

  .de-hero-left {
    flex: 1 1 50%;
    max-width: 620px;
  }

  .de-hero-right {
    flex: 1 1 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
  }

  .de-top-badges {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    width: max-content;
    max-width: none;
  }

  .de-top-badges>* {
    flex-shrink: 0;
    white-space: nowrap;
  }

  @media (max-width: 700px) {
    .de-top-badges {
      flex-wrap: wrap;
      width: auto;
    }
  }

  .de-badge-level {
    background-color: #e11d48;
    color: #ffffff;
    font-size: 12px;
    font-weight: 800;
    border-radius: 9999px;
    padding: 4px 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    box-shadow: 0 1px 3px rgba(225, 29, 72, 0.3);
  }

  .de-badge-google {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 9999px;
    padding: 4px 14px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 12px;
    font-weight: 600;
    color: #1e293b;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
  }

  .de-fast-track {
    font-size: 11.5px;
    font-weight: 900;
    font-style: italic;
    letter-spacing: 0.05em;
    color: #6366f1;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    text-transform: uppercase;
  }

  .de-hero-title {
    font-size: clamp(2.2rem, 4.2vw, 3.3rem);
    font-weight: 950;
    letter-spacing: -0.035em;
    line-height: 1.05;
    margin: 0;
    text-transform: uppercase;
    background: linear-gradient(135deg, #09172e 0%, #163674 40%, #1d4ed8 75%, #2563eb 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  .de-hero-subtitle {
    font-size: clamp(1.4rem, 2.4vw, 1.85rem);
    font-weight: 850;
    color: #1d4ed8;
    margin: 12px 0 0 0;
    letter-spacing: -0.02em;
    line-height: 1.25;
  }

  .de-hero-desc {
    margin-top: 14px;
    max-width: 580px;
    font-size: 15.5px;
    line-height: 1.65;
    color: #475569;
  }

  /* 6 Feature Pills in 2 columns */
  .de-features-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px 10px;
    margin-top: 24px;
    max-width: 680px;
  }

  .de-feature-pill {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 9999px;
    padding: 8px 16px;
    display: flex;
    align-items: center;
    gap: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: #1e293b;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    transition: all 0.2s ease;
  }

  .de-feature-pill:hover {
    border-color: #cbd5e1;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
  }

  /* CTA Buttons */
  .de-hero-actions {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-top: 30px;
    flex-wrap: wrap;
  }

  .de-btn-primary {
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    color: #ffffff !important;
    font-weight: 700;
    font-size: 14.5px;
    border-radius: 9999px;
    padding: 11px 26px;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .de-btn-primary:hover {
    background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
    transform: translateY(-1px);
  }

  .de-btn-secondary {
    background: #ffffff;
    color: #0f172a !important;
    font-weight: 700;
    font-size: 14.5px;
    border: 1px solid #cbd5e1;
    border-radius: 9999px;
    padding: 11px 24px;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    text-decoration: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    transition: all 0.2s ease;
  }

  .de-btn-secondary:hover {
    border-color: #94a3b8;
    background: #f8fafc;
    transform: translateY(-1px);
  }

  .de-btn-whatsapp {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border-radius: 9999px;
    border: 1px solid #25d366;
    background: #ffffff;
    padding: 11px 22px;
    font-size: 14.5px;
    font-weight: 700;
    color: #16a34a !important;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.15);
    transition: all 0.2s ease;
  }

  .de-btn-whatsapp:hover {
    background: #f0fdf4;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(37, 211, 102, 0.25);
  }

  .de-wa-icon {
    width: 18px;
    height: 18px;
    fill: currentColor;
    flex-shrink: 0;
  }

  /* CTA row stays on one line on desktop */
  .de-hero-actions {
    flex-wrap: nowrap;
    gap: 10px;
  }

  .de-hero-actions .de-btn-primary,
  .de-hero-actions .de-btn-secondary,
  .de-hero-actions .de-btn-whatsapp {
    white-space: nowrap;
    font-size: 14px;
    padding: 10px 18px;
  }

  @media (max-width: 700px) {
    .de-hero-actions {
      flex-wrap: wrap;
    }

    .de-hero-actions .de-btn-primary,
    .de-hero-actions .de-btn-secondary,
    .de-hero-actions .de-btn-whatsapp {
      width: 100%;
      justify-content: center;
    }
  }

  .de-hero-notice {
    margin-top: 14px;
    font-size: 12.5px;
    color: #64748b;
    font-weight: 500;
  }

  /* Right Hero Architecture Graphic - Borderless Floating 3D View */
  .de-hero-image-wrap {
    position: relative;
    width: 100%;
    max-width: 660px;
    display: flex;
    align-items: center;
    justify-content: center;
    perspective: 1200px;
  }

  /* Ambient 3D Glow behind floating cloud platform */
  .de-hero-image-wrap::before {
    content: '';
    position: absolute;
    width: 85%;
    height: 75%;
    top: 15%;
    left: 8%;
    background: radial-gradient(ellipse at center, rgba(56, 189, 248, 0.35) 0%, rgba(99, 102, 241, 0.18) 45%, transparent 75%);
    pointer-events: none;
    z-index: 0;
    filter: blur(36px);
  }

  .de-hero-platform-card {
    position: relative;
    width: 100%;
    z-index: 1;
    background: transparent;
    border: none;
    padding: 0;
    box-shadow: none;
    border-radius: 0;
    overflow: visible;
  }

  .de-hero-platform-img {
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
    filter: drop-shadow(0 14px 28px rgba(15, 23, 42, 0.08));
    transition: transform 0.35s ease;
  }

  @media (hover: hover) {}

  /* 4-Card Horizontal Info Strip */
  .de-four-strip {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-top: 48px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 14px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    position: relative;
    z-index: 10;
  }

  .de-strip-card {
    display: flex;
    align-items: center;
    gap: 14px;
    padding: 12px 14px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
  }

  .de-strip-icon-blue {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .de-strip-icon-soft {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
  }

  .de-strip-label {
    font-size: 10px;
    font-weight: 850;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    display: block;
  }

  .de-strip-title {
    font-size: 14.5px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.25;
    margin-top: 2px;
    display: block;
  }

  .de-strip-sub {
    font-size: 11.5px;
    color: #64748b;
    margin-top: 2px;
    display: block;
  }

  /* ---------------- SECTION HEADERS ---------------- */
  .de-section-badge-outline {
    display: inline-flex;
    align-items: center;
    border: 1px solid #94a3b8;
    background: #ffffff;
    color: #0f172a;
    border-radius: 9999px;
    padding: 4px 16px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  .de-section-badge-blue {
    display: inline-flex;
    align-items: center;
    border: 1px solid #3b82f6;
    background: #eff6ff;
    color: #2563eb;
    border-radius: 9999px;
    padding: 4px 18px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  .de-section-badge-green {
    display: inline-flex;
    align-items: center;
    border: 1px solid #10b981;
    background: #ecfdf5;
    color: #059669;
    border-radius: 9999px;
    padding: 4px 18px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  .de-section-badge-teal {
    display: inline-flex;
    align-items: center;
    border: 1px solid #06b6d4;
    background: #ecfeff;
    color: #0891b2;
    border-radius: 9999px;
    padding: 4px 18px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
  }

  .de-section-title {
    font-size: clamp(2rem, 3.8vw, 2.75rem);
    font-weight: 950;
    color: #09172e;
    letter-spacing: -0.035em;
    line-height: 1.15;
    margin: 12px 0 0 0;
  }

  .de-section-desc {
    font-size: 15px;
    line-height: 1.65;
    color: #64748b;
    max-width: 720px;
    margin: 14px auto 0 auto;
  }

  /* ---------------- 2. LEARNING PATHWAY ---------------- */
  .de-pathway-section {
    padding: 64px 0 80px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .de-steps-row1 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 16px;
    margin-top: 40px;
  }

  .de-steps-row2 {
    display: flex;
    justify-content: center;
    gap: 16px;
    margin-top: 16px;
    flex-wrap: wrap;
  }

  .de-step-card-row2 {
    width: calc(25% - 12px);
  }

  .de-step-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 18px;
    padding: 24px 20px;
    text-align: center;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.2s ease;
  }

  .de-step-card:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.05);
  }

  .de-step-tag {
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    display: block;
    margin-bottom: 4px;
  }

  .de-step-heading {
    font-size: 15px;
    font-weight: 850;
    color: #0f172a;
    margin: 0;
  }

  .de-step-text,
  .de-career-desc,
  .de-portfolio-desc,
  .de-related-desc {
    overflow-wrap: anywhere;
  }

  .de-step-text {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.55;
    margin: 10px 0 0 0;
  }

  /* ==========================================================================
     3. DETAILED 19-MODULE ROADMAP — PREMIUM 4-COLUMN COMPACT SQUARE GRID
     ========================================================================== */
  .de-curriculum-section {
    padding: 72px 0 88px 0;
    background: radial-gradient(circle at 50% 0%, rgba(224, 242, 254, 0.55) 0%, rgba(240, 249, 255, 0.35) 50%, #ffffff 85%);
    border-bottom: 1px solid #e2e8f0;
    position: relative;
    overflow: visible;
  }

  /* Full-Width Container for 4-Column Grid (Eliminates wasted left & right margins) */
  .de-curriculum-section .de-container-narrow {
    max-width: 1400px;
    margin: 0 auto;
    padding: 0 24px;
    width: 100%;
  }

  /* 4-Column Roadmap Grid on Desktop */
  .data-engineer-page .roadmap-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    align-items: start;
    margin-top: 44px;
  }

  /* Compact Square-Style Module Card */
  .data-engineer-page .roadmap-grid>.module-card {
    min-width: 0;
    height: auto;
    border-radius: 18px;
    border: 1px solid #d7eaff;
    background: #ffffff;
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    overflow: hidden;
    position: relative;
    transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1),
      box-shadow 0.28s cubic-bezier(0.16, 1, 0.3, 1),
      border-color 0.25s ease;
  }

  @media (hover: hover) {
    .data-engineer-page .roadmap-grid>.module-card:hover {
      transform: translateY(-4px);
    }
  }

  .de-mod-slot {
    position: relative;
    min-width: 0;
  }

  /* An open card floats over the cards below it instead of pushing them down */
  .data-engineer-page .roadmap-grid .module-card.is-open {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    z-index: 40;
    box-shadow: 0 26px 50px -12px rgba(15, 23, 42, 0.28), 0 10px 22px rgba(15, 23, 42, 0.14) !important;
  }

  @media (hover: hover) {
    .data-engineer-page .roadmap-grid .module-card.is-open:hover {
      transform: none;
    }
  }

  /* Final row displays remaining 3 cards naturally across first 3 columns */
  .data-engineer-page .roadmap-grid>.module-card:last-child {
    grid-column: auto;
  }

  /* Inside Module Card: Two-Part Balanced Layout (Left Info + Right Image) */
  .de-card-content-wrap {
    padding: 18px 18px 14px 18px;
    display: flex;
    flex-direction: row;
    align-items: stretch;
    justify-content: space-between;
    gap: 14px;
    flex: 1;
    min-width: 0;
  }

  /* Left Side: Module number, title, topics */
  .de-card-left-col {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
  }

  /* Meta Row: Small attractive badge + Phase text */
  .de-card-meta-row {
    display: flex;
    align-items: center;
    gap: 7px;
    margin-bottom: 7px;
    flex-wrap: wrap;
  }

  .de-card-mod-badge {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 11px;
    font-weight: 850;
    letter-spacing: 0.04em;
    padding: 2.5px 8px;
    border-radius: 6px;
    border-width: 1px;
    border-style: solid;
    display: inline-flex;
    align-items: center;
    line-height: 1.2;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
  }

  .de-card-phase-label {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #64748b;
    line-height: 1.2;
  }

  /* Module Title */
  .de-card-title {
    font-size: 15.5px;
    font-weight: 800;
    color: #091e42;
    margin: 0 0 10px 0;
    letter-spacing: -0.015em;
    line-height: 1.28;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* Topics Section */
  .de-card-topics-section {
    margin-top: auto;
  }

  .de-card-topics-list {
    display: flex;
    flex-direction: column;
    gap: 4px;
  }

  .de-card-topic-item {
    font-size: 12px;
    font-weight: 600;
    color: #334155;
    display: flex;
    align-items: baseline;
    gap: 6px;
    line-height: 1.38;
  }

  .de-card-topic-check {
    font-weight: 900;
    font-size: 11px;
    flex-shrink: 0;
    line-height: 1;
  }

  .de-card-topic-text {
    flex: 1;
    min-width: 0;
    overflow-wrap: break-word;
    word-break: break-word;
  }

  .de-card-toggle-btn {
    margin-top: 8px;
    background: none;
    border: none;
    padding: 0;
    font-size: 11.5px;
    font-weight: 750;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: opacity 0.15s, transform 0.15s;
    user-select: none;
  }

  .de-card-toggle-btn:hover {
    opacity: 0.85;
    transform: translateX(1px);
  }

  .de-card-extra-topics {
    margin-top: 6px;
    padding-top: 6px;
    border-top: 1px dashed #cbd5e1;
    display: none;
    flex-direction: column;
    gap: 4px;
  }

  /* Right Side: Small Relevant Illustration / Image */
  .de-card-right-col {
    width: 76px;
    min-width: 76px;
    max-width: 82px;
    flex-shrink: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    align-self: center;
  }

  .de-card-img-tile {
    width: 70px;
    height: 70px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid #d7eaff;
    box-shadow: 0 4px 14px -2px rgba(15, 23, 42, 0.06);
    padding: 6px;
    overflow: hidden;
    position: relative;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }

  .data-engineer-page .roadmap-grid>.module-card:hover .de-card-img-tile {
    transform: scale(1.05);
    box-shadow: 0 6px 18px -2px rgba(15, 23, 42, 0.1);
  }

  .de-card-thumb-img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
    filter: drop-shadow(0 2px 4px rgba(15, 23, 42, 0.08));
    transition: transform 0.25s ease;
  }

  /* Bottom Spec Strip */
  /* Equal-height module cards */
  .data-engineer-page .roadmap-grid {
    align-items: stretch;
  }

  .de-mod-slot {
    display: flex;
  }

  .de-mod-slot>.module-card {
    width: 100%;
    height: auto;
  }

  .data-engineer-page .roadmap-grid .de-mod-slot>.module-card.is-open {
    position: absolute;
    width: auto;
  }

  .de-card-content-wrap {
    flex: 1 1 auto;
  }

  .de-card-title {
    min-height: 2.5em;
  }

  .de-card-spec-strip {
    padding: 7px 16px;
    background: rgba(248, 250, 252, 0.9);
    border-top: 1px solid #edf2f7;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 10.5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #64748b;
  }

  .de-card-spec-left {
    font-weight: 700;
    color: #475569;
  }

  .de-card-spec-mod {
    font-weight: 900;
    color: #0f172a;
  }

  .de-card-spec-tag {
    color: #d97706;
    font-weight: 800;
    font-size: 10px;
  }

  /* Responsive Breakpoints */
  @media (max-width: 1200px) {
    .data-engineer-page .roadmap-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 16px;
    }

    .de-curriculum-section .de-container-narrow {
      padding: 0 20px;
    }
  }

  @media (max-width: 640px) {
    .de-curriculum-section {
      padding: 52px 0 64px 0;
    }

    .data-engineer-page .roadmap-grid {
      grid-template-columns: 1fr;
      gap: 14px;
      margin-top: 32px;
    }

    .de-curriculum-section .de-container-narrow {
      padding: 0 16px;
    }

    .de-card-content-wrap {
      padding: 16px 14px 12px 14px;
      gap: 12px;
    }

    .de-card-right-col {
      width: 66px;
      min-width: 66px;
    }

    .de-card-img-tile {
      width: 62px;
      height: 62px;
    }

    .de-card-title {
      font-size: 15px;
    }
  }

  /* ---------------- 4. PORTFOLIO PRODUCTS ---------------- */
  .de-portfolio-section {
    padding: 72px 0 88px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .de-portfolio-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
    margin-top: 44px;
  }

  .de-portfolio-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 26px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    transition: all 0.2s ease;
  }

  .de-portfolio-card:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
  }

  .de-portfolio-tag {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 9999px;
    font-size: 10.5px;
    font-weight: 850;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 14px;
  }

  .de-portfolio-title {
    font-size: 17px;
    font-weight: 850;
    color: #0f172a;
    margin: 0 0 10px 0;
    line-height: 1.3;
  }

  .de-portfolio-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
  }

  .de-portfolio-footer {
    margin-top: 24px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 11.5px;
  }

  .de-portfolio-num {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    color: #64748b;
  }

  .de-portfolio-link {
    font-weight: 800;
    color: #2563eb;
  }

  /* ---------------- 5. CAPSTONE ---------------- */
  .de-capstone-section {
    padding: 72px 0 88px 0;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }

  .de-capstone-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 28px;
    padding: 48px 40px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    text-align: center;
  }

  .de-lakehouse-terminal {
    background: #090d16;
    border: 1px solid #1e293b;
    border-radius: 18px;
    padding: 24px 28px;
    color: #ffffff;
    max-width: 760px;
    margin: 32px auto 0 auto;
    text-align: left;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.35);
  }

  .de-terminal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-bottom: 14px;
    border-bottom: 1px solid #1e293b;
    font-size: 11.5px;
    color: #94a3b8;
  }

  .de-terminal-metrics {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 20px;
    padding: 22px 0;
    border-bottom: 1px solid #1e293b;
  }

  .de-metric-label {
    font-size: 10px;
    font-weight: 850;
    letter-spacing: 0.06em;
    color: #94a3b8;
    text-transform: uppercase;
    display: block;
  }

  .de-metric-val {
    font-size: 22px;
    font-weight: 900;
    color: #ffffff;
    margin-top: 3px;
    display: block;
    line-height: 1.2;
  }

  .de-metric-sub {
    font-size: 11px;
    font-weight: 600;
    color: #38bdf8;
    margin-top: 4px;
    display: block;
  }

  .de-terminal-footer {
    padding-top: 14px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 11px;
    color: #94a3b8;
    font-family: Inter, system-ui, sans-serif;
  }

  .de-terminal-pill {
    border: 1px solid #334155;
    border-radius: 9999px;
    padding: 3px 12px;
    color: #cbd5e1;
    font-size: 11px;
  }

  .de-arch-pills {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 12px;
    max-width: 820px;
    margin: 28px auto 0 auto;
  }

  .de-arch-pill {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 10px 8px;
    font-size: 12px;
    font-weight: 700;
    color: #1e293b;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
  }

  .de-capstone-notice {
    font-size: 12.5px;
    color: #64748b;
    margin-top: 22px;
  }

  .de-capstone-action {
    margin-top: 32px;
    padding-top: 26px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 20px;
    text-align: left;
  }

  .de-ticket-text {
    font-size: 16px;
    font-weight: 900;
    font-style: italic;
    color: #6366f1;
    display: flex;
    align-items: center;
    gap: 6px;
  }

  /* ---------------- 6. TOOLS & ECOSYSTEM ---------------- */
  .de-tools-section {
    padding: 72px 0 88px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .de-tools-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
    margin-top: 44px;
  }

  .de-tool-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
  }

  .de-tool-card-title {
    font-size: 15px;
    font-weight: 850;
    color: #0f172a;
    margin: 0 0 16px 0;
    display: flex;
    align-items: center;
    gap: 8px;
  }

  .de-tool-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .de-tech-badge {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 5px 11px;
    font-size: 12px;
    font-weight: 650;
    color: #334155;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
  }

  /* ---------------- 7. SKILLS YOU WILL GAIN ---------------- */
  .de-skills-section {
    padding: 72px 0 88px 0;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }

  .de-skills-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-top: 44px;
  }

  .de-skill-col {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .de-skill-pill {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 9999px;
    padding: 10px 18px;
    font-size: 13px;
    font-weight: 750;
    color: #1e293b;
    display: flex;
    align-items: center;
    gap: 10px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
    transition: all 0.15s ease;
  }

  .de-skill-pill:hover {
    border-color: #94a3b8;
    transform: translateY(-1px);
  }

  .de-blue-bullet {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background-color: #2563eb;
    display: inline-block;
    flex-shrink: 0;
  }

  /* ---------------- 8. CAREER DIRECTION ---------------- */
  .de-career-section {
    padding: 72px 0 88px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .de-career-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 22px;
    margin-top: 44px;
  }

  .de-career-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    transition: all 0.2s ease;
  }

  .de-career-card:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
  }

  .data-engineer-page .de-career-header {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: flex-start;
    gap: 12px;
    margin-bottom: 12px;
  }

  .data-engineer-page .de-career-icon {
    font-size: 26px;
    margin: 0;
    flex-shrink: 0;
    line-height: 1;
  }

  .data-engineer-page .de-career-role {
    font-size: 16px;
    font-weight: 850;
    color: #0f172a;
    margin: 0;
    line-height: 1.3;
    flex: 1;
  }

  .de-career-desc {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
  }

  .de-career-note {
    margin-top: 40px;
    text-align: center;
    font-size: 12px;
    color: #64748b;
    max-width: 680px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
  }

  /* ---------------- 9. RELATED PROGRAMS ---------------- */
  .de-related-section {
    padding: 72px 0 88px 0;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }

  .de-related-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    margin-bottom: 36px;
  }

  .de-related-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 24px;
  }

  .de-related-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    transition: all 0.2s ease;
  }

  .de-related-card:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
  }

  .de-related-img-wrap {
    height: 175px;
    width: 100%;
    overflow: hidden;
    background: #f1f5f9;
  }

  .de-related-img-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
  }

  .de-related-card:hover .de-related-img-wrap img {
    transform: scale(1.03);
  }

  .de-related-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
    justify-content: space-between;
  }

  .de-related-title {
    font-size: 16.5px;
    font-weight: 850;
    color: #0f172a;
    margin: 0;
  }

  .de-related-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.15s;
  }

  .de-related-title a:hover {
    color: #2563eb;
  }

  .de-related-desc {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.6;
    margin: 8px 0 0 0;
  }

  .de-related-link {
    margin-top: 18px;
    font-size: 12.5px;
    font-weight: 800;
    color: #2563eb;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none;
  }

  .de-related-link:hover {
    color: #1d4ed8;
  }

  /* ---------------- RESPONSIVE BREAKPOINTS ---------------- */
  @media (max-width: 1023px) {
    .de-hero-row {
      flex-direction: column;
      gap: 32px;
    }

    .de-hero-left,
    .de-hero-right {
      flex: 1 1 100%;
      max-width: 100%;
    }

    .de-four-strip {
      grid-template-columns: repeat(2, 1fr);
    }

    .de-steps-row1 {
      grid-template-columns: repeat(2, 1fr);
    }

    .de-step-card-row2 {
      width: calc(50% - 8px);
    }

    .data-engineer-page .roadmap-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 18px;
    }

    .de-portfolio-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .de-arch-pills {
      grid-template-columns: repeat(3, 1fr);
    }

    .de-tools-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .de-skills-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .de-career-grid {
      grid-template-columns: repeat(2, 1fr);
    }

    .de-related-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 767px) {
    .data-engineer-page .roadmap-grid {
      grid-template-columns: minmax(0, 1fr);
      gap: 16px;
    }

    .de-features-grid {
      grid-template-columns: 1fr;
    }

    .de-four-strip {
      grid-template-columns: 1fr;
    }

    .de-steps-row1 {
      grid-template-columns: 1fr;
    }

    .de-step-card-row2 {
      width: 100%;
    }

    .de-portfolio-grid {
      grid-template-columns: 1fr;
    }

    .de-arch-pills {
      grid-template-columns: repeat(3, minmax(0, 1fr));
      ;
    }

    .de-tools-grid {
      grid-template-columns: 1fr;
    }

    .de-skills-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 10px;
    }

    .de-skill-col {
      display: contents;
    }

    .de-skill-pill {
      border-radius: 14px;
      padding: 10px 12px;
      font-size: 12.5px;
      gap: 8px;
    }

    .de-career-grid {
      grid-template-columns: 1fr;
    }

    .de-related-grid {
      grid-template-columns: 1fr;
    }

    .de-terminal-metrics {
      grid-template-columns: 1fr;
      gap: 14px;
    }

    .de-capstone-action {
      flex-direction: column;
      text-align: center;
    }
  }

  @media (prefers-reduced-motion: reduce) {

    .data-engineer-page .roadmap-grid>.module-card,
    .de-feature-pill,
    .de-step-card,
    .de-portfolio-card,
    .de-career-card,
    .de-related-card {
      transition: none !important;
    }
  }
</style>

<div class="data-engineer-page">
  <main id="main">

    <!-- ==================== 1. HERO SECTION ==================== -->
    <section class="de-hero-section">
      <div class="de-grid-overlay" aria-hidden="true"></div>
      <div class="de-container">

        <!-- Hero Main Row -->
        <div class="de-hero-row">
          <!-- Left Hero Column -->
          <div class="de-hero-left">
            <!-- Top Badges Row -->
            <div class="de-top-badges">
              <!-- Pink LEVEL 3 badge -->
              <span class="de-badge-level">
                <span style="width: 6px; height: 6px; border-radius: 50%; background: #ffffff; display: inline-block;"></span>
                <?= cms('course-data-engineer.hero-badge.01', '6-Month Intensive Program') ?>
              </span>

              <!-- Google Review Badge (shared across all course pages) -->
              <?php include __DIR__ . '/../includes/google-rating-badge.php'; ?>

              <!-- Purple Fast-Track text -->
              <span class="de-fast-track">
                FAST-TRACK INTO THE FUTURE! 🚀
              </span>
            </div>

            <!-- Main Heading -->
            <h1 class="de-hero-title">
              <?= cms('course-data-engineer.data-engineer.07', 'DATA ENGINEER') ?>
            </h1>

            <!-- Program Subtitle -->
            <h2 class="de-hero-subtitle">
              <?= cms('course-data-engineer.data-engineer.08', '6-Month Complete Career Program') ?>
            </h2>

            <!-- Course Description -->
            <p class="de-hero-desc">
              <?= cms('course-data-engineer.data-engineer.09', 'From Python & Data Analytics to Machine Learning, Deep Learning, LLMs, RAG, AI Agents and Production AI Applications.') ?>
            </p>

            <!-- 6 Feature Cards (2 cols x 3 rows) -->
            <div class="de-features-grid">
              <div class="de-feature-pill">
                <span>💡</span>
                <span><?= cms('course-data-engineer.data-engineer.10', 'Beginner to Advanced') ?></span>
              </div>
              <div class="de-feature-pill">
                <span>💻</span>
                <span><?= cms('course-data-engineer.data-engineer.11', 'Hands-On Training') ?></span>
              </div>
              <div class="de-feature-pill">
                <span>🧩</span>
                <span><?= cms('course-data-engineer.data-engineer.12', 'Real-World Projects') ?></span>
              </div>
              <div class="de-feature-pill">
                <span>🧠</span>
                <span><?= cms('course-data-engineer.data-engineer.13', 'ML + Generative AI') ?></span>
              </div>
              <div class="de-feature-pill">
                <span>⚡</span>
                <span><?= cms('course-data-engineer.data-engineer.14', 'RAG + AI Agents') ?></span>
              </div>
              <div class="de-feature-pill">
                <span>🎯</span>
                <span><?= cms('course-data-engineer.data-engineer.15', 'Job-Oriented Syllabus') ?></span>
              </div>
            </div>

            <!-- Action Buttons -->
            <div class="de-hero-actions ch-actions">
              <a class="ch-btn ch-btn-primary" href="<?= cmsu('course-data-engineer.hero-cta.enroll-url', '../contact.php') ?>"><?= cms('course-data-engineer.hero-cta.enroll', 'Enroll Now') ?><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                  <path d="M5 12h14" />
                  <path d="m13 6 6 6-6 6" />
                </svg></a>
              <a class="ch-btn ch-btn-ghost" href="#curriculum"><?= cms('course-data-engineer.hero-cta.curriculum', 'View Curriculum') ?></a>
              <a class="ch-btn ch-btn-syllabus" href="#syllabus-container" onclick="return window.chViewSyllabus ? chViewSyllabus(event) : true;"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                  <path d="M14 2v6h6" />
                  <path d="M8 13h8" />
                  <path d="M8 17h5" />
                </svg><?= cms('course-data-engineer.hero-cta.syllabus', 'View Full Syllabus') ?></a>
              <a class="ch-btn ch-btn-wa" data-wa data-wa-text="Hello Chedo Tech, I am interested in the Data Engineer course. Please share the syllabus, fees and batch details." href="<?= cmsu('course-data-engineer.hero-cta.whatsapp-url', '../contact.php') ?>"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false">
                  <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                </svg><?= cms('course-data-engineer.hero-cta.whatsapp', 'Enquire on WhatsApp') ?></a>
            </div>

            <!-- Micro subtext -->
            <p class="de-hero-notice">
              <?= cms('course-data-engineer.data-engineer.19', 'Classroom batch sizes are strictly limited to ensure individual attention.') ?>
            </p>
          </div>

          <!-- Right Hero Column: Cloud Data Platform Architecture Graphic -->
          <div class="de-hero-right">
            <div class="de-hero-image-wrap">
              <figure class="ch-frame" style="--ch-a:#14b8a6;--ch-b:#38bdf8">
                <div class="ch-window">
                  <div class="ch-media">
                    <img src="../assets/images/courses/data-engineer-hero.webp" alt="<?= cms('course-data-engineer.hero-platform-img.alt', 'Data Engineering Training in Pune — Chedo Tech') ?>" class="ch-img" width="1280" height="720" loading="eager" fetchpriority="high" decoding="async">
                  </div>
                </div>
              </figure>
            </div>
          </div>
        </div>

        <!-- Horizontal Four-Card Information Strip (Matches PDF Page 1) -->
        <div class="de-four-strip">
          <!-- Card 1: Format -->
          <div class="de-strip-card">
            <div class="de-strip-icon-blue">
              🏫
            </div>
            <div>
              <span class="de-strip-label" style="color: #2563eb;">FORMAT</span>
              <span class="de-strip-title">Offline, In-Person Training</span>
              <span class="de-strip-sub">Pune Classroom Center</span>
            </div>
          </div>

          <!-- Card 2: Duration & Schedule -->
          <div class="de-strip-card">
            <div class="de-strip-icon-soft" style="background: #faf5ff; border: 1px solid #f3e8ff;">
              ⏱️
            </div>
            <div>
              <span class="de-strip-label" style="color: #475569;">DURATION & SCHEDULE</span>
              <span class="de-strip-title">6 Months Intensive</span>
              <span class="de-strip-sub">Mon to Sat Practical Batches</span>
            </div>
          </div>

          <!-- Card 3: Curriculum Coverage -->
          <div class="de-strip-card">
            <div class="de-strip-icon-soft" style="background: #fff1f2; border: 1px solid #ffe4e6;">
              🎯
            </div>
            <div>
              <span class="de-strip-label" style="color: #475569;">CURRICULUM COVERAGE</span>
              <span class="de-strip-title">19 Modules & 15+ Projects</span>
              <span class="de-strip-sub">Hands-On Labs & Capstone</span>
            </div>
          </div>

          <!-- Card 4: Target Outcomes -->
          <div class="de-strip-card">
            <div class="de-strip-icon-soft" style="background: #ecfdf5; border: 1px solid #d1fae5;">
              💼
            </div>
            <div>
              <span class="de-strip-label" style="color: #059669;">TARGET OUTCOMES</span>
              <span class="de-strip-title">Data & AI Engineer</span>
              <span class="de-strip-sub">Mock Interviews & Portfolios</span>
            </div>
          </div>
        </div>

      </div>
    </section>


    <!-- ==================== 2. LEARNING PATHWAY ==================== -->
    <section class="de-pathway-section">
      <div class="de-container">
        <div style="text-align: center; max-width: 780px; margin: 0 auto;">
          <span class="de-section-badge-outline">
            <?= cms('course-data-engineer.the-6-month-ai.01', 'LEARNING PATHWAY') ?>
          </span>
          <h2 class="de-section-title">
            <?= cms('course-data-engineer.the-6-month-ai.02', 'The 6-Month AI Career Journey') ?>
          </h2>
          <p class="de-section-desc">
            <?= cms('course-data-engineer.the-6-month-ai.03', 'Our structured roadmap builds your capabilities sequentially. We guide you from programming fundamentals through statistics, machine learning, and deep learning, all the way to modern Generative AI engineering and cloud deployment.') ?>
          </p>
        </div>

        <!-- Seven-Step Presentation: Row 1 (4 cards), Row 2 (3 cards centered) -->
        <div style="max-width: 1100px; margin: 0 auto;">
          <!-- Row 1: Steps 1 to 4 -->
          <div class="de-steps-row1 ch-journey">
            <!-- Step 1 -->
            <div class="de-step-card">
              <div>
                <span class="de-step-tag" style="color: #2563eb;"><?= cms('course-data-engineer.the-6-month-ai.04', 'STEP 1') ?></span>
                <h4 class="de-step-heading"><?= cms('course-data-engineer.the-6-month-ai.05', 'Foundation') ?></h4>
              </div>
              <p class="de-step-text"><?= cms('course-data-engineer.the-6-month-ai.06', 'Python basics, control flows, OOP & package management.') ?></p>
            </div>

            <!-- Step 2 -->
            <div class="de-step-card">
              <div>
                <span class="de-step-tag" style="color: #0891b2;"><?= cms('course-data-engineer.the-6-month-ai.07', 'STEP 2') ?></span>
                <h4 class="de-step-heading"><?= cms('course-data-engineer.the-6-month-ai.08', 'Data Analytics') ?></h4>
              </div>
              <p class="de-step-text"><?= cms('course-data-engineer.the-6-month-ai.09', 'Data manipulation, SQL, NoSQL & visualization dashboards.') ?></p>
            </div>

            <!-- Step 3 -->
            <div class="de-step-card">
              <div>
                <span class="de-step-tag" style="color: #4f46e5;"><?= cms('course-data-engineer.the-6-month-ai.10', 'STEP 3') ?></span>
                <h4 class="de-step-heading"><?= cms('course-data-engineer.the-6-month-ai.11', 'Machine Learning') ?></h4>
              </div>
              <p class="de-step-text"><?= cms('course-data-engineer.the-6-month-ai.12', 'Mathematics, statistics, regression, and model validation.') ?></p>
            </div>

            <!-- Step 4 -->
            <div class="de-step-card">
              <div>
                <span class="de-step-tag" style="color: #0f172a;"><?= cms('course-data-engineer.the-6-month-ai.13', 'STEP 4') ?></span>
                <h4 class="de-step-heading"><?= cms('course-data-engineer.the-6-month-ai.14', 'Deep Learning') ?></h4>
              </div>
              <p class="de-step-text"><?= cms('course-data-engineer.the-6-month-ai.15', 'Neural networks, CNNs, RNNs & PyTorch/TensorFlow concepts.') ?></p>
            </div>
          </div>

          <!-- Row 2: Steps 5 to 7 (Centered) -->
          <div class="de-steps-row2 ch-journey">
            <!-- Step 5 -->
            <div class="de-step-card de-step-card-row2">
              <div>
                <span class="de-step-tag" style="color: #9333ea;"><?= cms('course-data-engineer.the-6-month-ai.16', 'STEP 5') ?></span>
                <h4 class="de-step-heading"><?= cms('course-data-engineer.the-6-month-ai.17', 'Generative AI') ?></h4>
              </div>
              <p class="de-step-text"><?= cms('course-data-engineer.the-6-month-ai.18', 'Transformers, Large Language Models (LLMs) & Prompting.') ?></p>
            </div>

            <!-- Step 6 -->
            <div class="de-step-card de-step-card-row2">
              <div>
                <span class="de-step-tag" style="color: #1e293b;"><?= cms('course-data-engineer.the-6-month-ai.19', 'STEP 6') ?></span>
                <h4 class="de-step-heading"><?= cms('course-data-engineer.the-6-month-ai.20', 'AI Engineering') ?></h4>
              </div>
              <p class="de-step-text"><?= cms('course-data-engineer.the-6-month-ai.21', 'RAG systems, Vector databases, LangChain, n8n, & AI Agents.') ?></p>
            </div>

            <!-- Step 7 -->
            <div class="de-step-card de-step-card-row2">
              <div>
                <span class="de-step-tag" style="color: #059669;"><?= cms('course-data-engineer.the-6-month-ai.22', 'STEP 7') ?></span>
                <h4 class="de-step-heading"><?= cms('course-data-engineer.the-6-month-ai.23', 'Production') ?></h4>
              </div>
              <p class="de-step-text"><?= cms('course-data-engineer.the-6-month-ai.24', 'Backend APIs, MLOps, Docker, and Cloud Deployment.') ?></p>
            </div>
          </div>
        </div>

      </div>
    </section>


    <!-- ==========================================================================
       3. DETAILED 19-MODULE ROADMAP — TWO-COLUMN GRID
       ========================================================================== -->
    <section class="de-curriculum-section" id="curriculum">
      <div class="de-grid-overlay" aria-hidden="true"></div>
      <div class="de-container-narrow" style="position: relative; z-index: 10;">

        <!-- Section Header -->
        <div style="text-align: center; max-width: 780px; margin: 0 auto;">
          <span class="de-section-badge-blue">
            <?= cms('course-data-engineer.detailed-19-module-roadmap.01', 'SYLLABUS BREAKDOWN') ?>
          </span>
          <h2 class="de-section-title">
            <?= cms('course-data-engineer.detailed-19-module-roadmap.02', 'Detailed 19-Module Roadmap') ?>
          </h2>
          <p class="de-section-desc">
            <?= cms('course-data-engineer.detailed-19-module-roadmap.03', 'Review the full technical curriculum. Click on any module below to expand the list of topics, exercises, and target technology stacks.') ?>
          </p>
        </div>

        <!-- PHP Data Setup -->
        <?php
        $syl = course_syllabus('data-engineer');
        $modules = $syl['modules'] ?? [];

        // Alternating 6 vibrant accent color themes for cards
        $theme_cycles = [
          0 => [ // Mod 1: Sky Blue / Cyan
            'card_bg'      => 'linear-gradient(150deg, #ffffff 0%, #f0f9ff 100%)',
            'card_border'  => '#bae6fd',
            'badge_bg'     => '#e0f2fe',
            'badge_border' => '#7dd3fc',
            'badge_text'   => '#0284c7',
            'tile_bg'      => 'linear-gradient(135deg, #e0f2fe 0%, #f0f9ff 100%)',
            'tile_border'  => '#bae6fd',
            'accent_color' => '#0284c7',
            'hover_border' => '#38bdf8',
            'hover_shadow' => 'rgba(2, 132, 199, 0.16)',
          ],
          1 => [ // Mod 2: Purple / Violet
            'card_bg'      => 'linear-gradient(150deg, #ffffff 0%, #faf5ff 100%)',
            'card_border'  => '#e9d5ff',
            'badge_bg'     => '#f3e8ff',
            'badge_border' => '#d8b4fe',
            'badge_text'   => '#7e22ce',
            'tile_bg'      => 'linear-gradient(135deg, #f3e8ff 0%, #faf5ff 100%)',
            'tile_border'  => '#e9d5ff',
            'accent_color' => '#7e22ce',
            'hover_border' => '#c084fc',
            'hover_shadow' => 'rgba(126, 34, 206, 0.16)',
          ],
          2 => [ // Mod 3: Emerald / Green
            'card_bg'      => 'linear-gradient(150deg, #ffffff 0%, #f0fdf4 100%)',
            'card_border'  => '#bbf7d0',
            'badge_bg'     => '#dcfce7',
            'badge_border' => '#86efac',
            'badge_text'   => '#15803d',
            'tile_bg'      => 'linear-gradient(135deg, #dcfce7 0%, #f0fdf4 100%)',
            'tile_border'  => '#bbf7d0',
            'accent_color' => '#15803d',
            'hover_border' => '#4ade80',
            'hover_shadow' => 'rgba(21, 128, 61, 0.16)',
          ],
          3 => [ // Mod 4: Amber / Warm Orange
            'card_bg'      => 'linear-gradient(150deg, #ffffff 0%, #fffbeb 100%)',
            'card_border'  => '#fde68a',
            'badge_bg'     => '#fef3c7',
            'badge_border' => '#fcd34d',
            'badge_text'   => '#b45309',
            'tile_bg'      => 'linear-gradient(135deg, #fef3c7 0%, #fffbeb 100%)',
            'tile_border'  => '#fde68a',
            'accent_color' => '#b45309',
            'hover_border' => '#fbbf24',
            'hover_shadow' => 'rgba(180, 83, 9, 0.16)',
          ],
          4 => [ // Mod 5: Rose / Coral
            'card_bg'      => 'linear-gradient(150deg, #ffffff 0%, #fff1f2 100%)',
            'card_border'  => '#fecdd3',
            'badge_bg'     => '#ffe4e6',
            'badge_border' => '#fda4af',
            'badge_text'   => '#be123c',
            'tile_bg'      => 'linear-gradient(135deg, #ffe4e6 0%, #fff1f2 100%)',
            'tile_border'  => '#fecdd3',
            'accent_color' => '#be123c',
            'hover_border' => '#fb7185',
            'hover_shadow' => 'rgba(190, 18, 60, 0.16)',
          ],
          5 => [ // Mod 6: Indigo / Royal Blue
            'card_bg'      => 'linear-gradient(150deg, #ffffff 0%, #eef2ff 100%)',
            'card_border'  => '#c7d2fe',
            'badge_bg'     => '#e0e7ff',
            'badge_border' => '#a5b4fc',
            'badge_text'   => '#4338ca',
            'tile_bg'      => 'linear-gradient(135deg, #e0e7ff 0%, #eef2ff 100%)',
            'tile_border'  => '#c7d2fe',
            'accent_color' => '#4338ca',
            'hover_border' => '#818cf8',
            'hover_shadow' => 'rgba(67, 56, 202, 0.16)',
          ],
        ];

        // Specific title-specific official logos & illustrations for each of the 19 curriculum modules
        $module_visuals = [
          1  => ['img' => '../assets/images/modules/mod-01-python.png', 'alt' => 'Python for Data Engineering Official Logo'],
          2  => ['img' => '../assets/images/modules/mod-02-dsa.png', 'alt' => 'Data Structures & Algorithms Network Graph'],
          3  => ['img' => '../assets/images/modules/mod-03-sql-databases.png', 'alt' => 'SQL & Relational Databases Storage'],
          4  => ['img' => '../assets/images/modules/mod-04-data-modeling.png', 'alt' => 'Advanced SQL & Data Modeling Star Schema'],
          5  => ['img' => '../assets/images/modules/mod-05-data-warehouse.png', 'alt' => 'Enterprise Data Warehousing Architecture'],
          6  => ['img' => '../assets/images/modules/mod-06-etl-pipelines.png', 'alt' => 'ETL & Data Pipelines Processing Flow'],
          7  => ['img' => '../assets/images/modules/mod-07-pandas.png', 'alt' => 'Pandas & Data Processing Official Logo'],
          8  => ['img' => '../assets/images/modules/mod-08-big-data.png', 'alt' => 'Big Data & Distributed Computing Cluster'],
          9  => ['img' => '../assets/images/modules/mod-09-apache-spark.png', 'alt' => 'Apache Spark & PySpark Official Flame Logo'],
          10 => ['img' => '../assets/images/modules/mod-10-lakehouse.png', 'alt' => 'Data Lakes & Delta Lakehouse Architecture'],
          11 => ['img' => '../assets/images/modules/mod-11-nosql-mongodb.png', 'alt' => 'NoSQL & MongoDB Distributed Databases'],
          12 => ['img' => '../assets/images/modules/mod-12-cloud-data.png', 'alt' => 'Cloud Data Engineering AWS Azure GCP'],
          13 => ['img' => '../assets/images/modules/mod-13-apache-airflow.png', 'alt' => 'Apache Airflow Workflow Orchestration Logo'],
          14 => ['img' => '../assets/images/modules/mod-14-apache-kafka.png', 'alt' => 'Apache Kafka Real-Time Streaming Logo'],
          15 => ['img' => '../assets/images/modules/mod-15-data-governance.png', 'alt' => 'Data Quality & Governance Security Shield'],
          16 => ['img' => '../assets/images/modules/mod-16-devops-docker.png', 'alt' => 'Docker & Data Engineering DevOps Logo'],
          17 => ['img' => '../assets/images/modules/mod-17-ai-vector.png', 'alt' => 'Data Engineering & AI Vector Embeddings Integration'],
          18 => ['img' => '../assets/images/modules/mod-18-production-monitoring.png', 'alt' => 'Production Data Engineering Telemetry & Observability'],
          19 => ['img' => '../assets/images/modules/mod-19-capstone-platform.png', 'alt' => 'Industry Data Engineering Capstone Platform Trophy'],
        ];

        // Exact Real-World Project specifications from PDF reference
        $module_projects = [
          1  => "Automated Web & API Data Scraper — Multi-threaded Python pipeline saving JSON/CSV into SQL storage.",
          2  => "Custom In-Memory Stream Cache — High-throughput FIFO queues and LRU buffer implementation in Python.",
          3  => "Normalized E-Commerce DB Schema — Relational database architecture with indexes, foreign keys & ACID tests.",
          4  => "Window Function Analytics Engine — Optimized CTEs & partition aggregation across 1M+ transaction records.",
          5  => "Enterprise Star & Snowflake Schema — Dimensional modeling for retail supply chain business intelligence.",
          6  => "Cloud Data Warehouse Ingestion — Automated partition pruning, staging layers and columnar storage optimization.",
          7  => "Production Python-to-PostgreSQL ETL — End-to-end extractor with dead-letter queue, schema enforcement & alerts.",
          8  => "Real-Time Webhook Event Ingestor — FastAPI ingestion microservice handling live JSON telemetry streams.",
          9  => "Automated dbt Lineage & Test Suite — Data transformations with schema validation, freshness tests & documentation.",
          10 => "50GB Distributed PySpark Analyzer — Catalyst optimization, broadcast joins and cluster execution benchmark.",
          11 => "Real-Time Clickstream Windowing — Spark Structured Streaming with watermarking & event checkpointing.",
          12 => "Multi-Broker Kafka Event Stream — Fault-tolerant consumer-producer pipelines handling live trade alerts.",
          13 => "Mission-Critical Airflow DAGs — Automated backfills, Slack failure alerts, and cross-DAG dependencies.",
          14 => "Lakehouse with Delta Lake / Iceberg — ACID transactions, time-travel queries and zero-copy clones on cloud storage.",
          15 => "Cloud Data Stack (GCP / AWS / Snowflake) — Serverless analytical data pipelines with auto-scaling compute.",
          16 => "Dockerized CI/CD Data Stack — Containerized Kafka, Spark & Postgres deployed via GitHub Actions.",
          17 => "Vector Embedding ETL for Pinecone — Real-time pipeline feeding vector embeddings into RAG knowledge bases.",
          18 => "Prometheus & Grafana Pipeline Monitoring — SLA tracking, data anomaly detection and automated healing scripts.",
          19 => "Enterprise Capstone Data Platform — End-to-end Lakehouse integrating Kafka, Spark, dbt, Airflow & Streamlit UI.",
        ];

        // Phase calculation
        $phase_map = [
          1 => 1,
          2 => 1,
          3 => 1,
          4 => 2,
          5 => 2,
          6 => 2,
          7 => 3,
          8 => 3,
          9 => 3,
          10 => 4,
          11 => 4,
          12 => 4,
          13 => 5,
          14 => 5,
          15 => 5,
          16 => 6,
          17 => 6,
          18 => 6,
          19 => 7
        ];
        ?>

        <!-- 4-Column Grid of 19 Modules -->
        <div class="roadmap-grid">
          <?php foreach ($modules as $i => $m):
            $mod_num = $i + 1;
            $theme = $theme_cycles[$i % 6];
            $visual = $module_visuals[$mod_num] ?? [
              'img' => '../assets/images/courses/Data Engineering.webp',
              'alt' => course_e($m['title'] ?? '')
            ];
            $topics = $m['topics'] ?? [];
            $total_topics = count($topics);
            $initial_topics = array_slice($topics, 0, 4);
            $extra_topics = array_slice($topics, 4);
            $phase_num = $phase_map[$mod_num] ?? 1;
          ?>
            <div class="de-mod-slot">
              <div class="module-card" style="background: <?= $theme['card_bg'] ?>; border-color: <?= $theme['card_border'] ?>;" onmouseenter="this.style.borderColor='<?= $theme['hover_border'] ?>'; this.style.boxShadow='0 14px 28px -4px <?= $theme['hover_shadow'] ?>, 0 6px 12px -2px rgba(15,23,42,0.06)'" onmouseleave="this.style.borderColor='<?= $theme['card_border'] ?>'; this.style.boxShadow='0 2px 10px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02)'">

                <!-- Two-Part Card Body: Left Content + Right Image -->
                <div class="de-card-content-wrap">
                  <!-- Left Side: Module number badge, title, learning topics -->
                  <div class="de-card-left-col">
                    <!-- Meta Header: Badge + Phase Tag -->
                    <div class="de-card-meta-row">
                      <span class="de-card-mod-badge" style="background-color: <?= $theme['badge_bg'] ?>; border-color: <?= $theme['badge_border'] ?>; color: <?= $theme['badge_text'] ?>;">
                        MOD <?= sprintf('%02d', $mod_num) ?>
                      </span>
                      <span class="de-card-phase-label">
                        PHASE <?= $phase_num ?> • <?= $total_topics ?> TOPICS
                      </span>
                    </div>

                    <!-- Module Title -->
                    <h3 class="de-card-title">
                      <?= course_e($m['title'] ?? '') ?>
                    </h3>

                    <!-- Learning Topics List -->
                    <div class="de-card-topics-section">
                      <div class="de-card-topics-list">
                        <?php foreach ($initial_topics as $t): ?>
                          <div class="de-card-topic-item">
                            <span class="de-card-topic-check" style="color: <?= $theme['accent_color'] ?>;">✓</span>
                            <span class="de-card-topic-text"><?= course_e($t['title'] ?? '') ?></span>
                          </div>
                        <?php endforeach; ?>
                      </div>

                      <!-- Expandable Extra Topics -->
                      <?php if (!empty($extra_topics)): ?>
                        <div class="de-card-extra-topics">
                          <?php foreach ($extra_topics as $t): ?>
                            <div class="de-card-topic-item">
                              <span class="de-card-topic-check" style="color: <?= $theme['accent_color'] ?>;">✓</span>
                              <span class="de-card-topic-text"><?= course_e($t['title'] ?? '') ?></span>
                            </div>
                          <?php endforeach; ?>
                        </div>

                        <!-- Toggle Button -->
                        <button type="button" class="de-card-toggle-btn" style="color: <?= $theme['accent_color'] ?>;" data-more="+ View <?= count($extra_topics) ?> more topics" data-less="- View less" onclick="toggleCardExtraTopics(this)">
                          <span class="toggle-text">+ View <?= count($extra_topics) ?> more topics</span>
                          <span class="toggle-arrow" style="font-size: 11px;">▾</span>
                        </button>
                      <?php endif; ?>
                    </div>
                  </div>

                  <!-- Right Side: Small Relevant Illustration / Image -->
                  <div class="de-card-right-col">
                    <div class="de-card-img-tile" style="background: <?= $theme['tile_bg'] ?>; border-color: <?= $theme['tile_border'] ?>;">
                      <img src="<?= htmlspecialchars($visual['img'], ENT_QUOTES) ?>"
                        alt="<?= htmlspecialchars($visual['alt'], ENT_QUOTES) ?>"
                        class="de-card-thumb-img"
                        loading="lazy"
                        width="80"
                        height="80">
                    </div>
                  </div>
                </div>

                <!-- Pipeline Step Spec Strip -->
                <div class="de-card-spec-strip">
                  <span class="de-card-spec-left"># Pipeline Step <?= $mod_num ?></span>
                  <span class="de-card-spec-mod">MOD <?= sprintf('%02d', $mod_num) ?></span>
                  <span class="de-card-spec-tag">100% PRACTICAL ⚡</span>
                </div>

              </div>
            </div>
          <?php endforeach; ?>
        </div>

      </div>
    </section>


    <!-- ==================== 4. BUILD REAL PRODUCTS (PORTFOLIO) ==================== -->
    <section class="de-portfolio-section">
      <div class="de-container">

        <!-- Section Header -->
        <div style="text-align: center; max-width: 780px; margin: 0 auto;">
          <span class="de-section-badge-green">
            <?= cms('course-data-engineer.build-real-data-ai.01', 'PORTFOLIO') ?>
          </span>
          <h2 class="de-section-title">
            <?= cms('course-data-engineer.build-real-data-ai.02', 'Build Real Data & AI Products') ?>
          </h2>
          <p class="de-section-desc">
            <?= cms('course-data-engineer.build-real-data-ai.03', 'You won\'t just learn theory. In this program, you will build 15+ practical applications to build a strong professional portfolio.') ?>
          </p>
        </div>

        <!-- 6 Project Cards Grid -->
        <div class="de-portfolio-grid">
          <!-- Project 1 -->
          <div class="de-portfolio-card">
            <div>
              <span class="de-portfolio-tag" style="background: #ecfeff; border: 1px solid #cffafe; color: #0891b2;">
                DATA ANALYTICS
              </span>
              <h4 class="de-portfolio-title">
                Exploratory Business Dashboard
              </h4>
              <p class="de-portfolio-desc">
                Clean, analyze, and build an interactive dashboard using Pandas and Power BI, generating actionable business insights.
              </p>
            </div>
            <div class="de-portfolio-footer">
              <span class="de-portfolio-num">Portfolio Project #01</span>
              <span class="de-portfolio-link">100% Practical ➔</span>
            </div>
          </div>

          <!-- Project 2 -->
          <div class="de-portfolio-card">
            <div>
              <span class="de-portfolio-tag" style="background: #eef2ff; border: 1px solid #e0e7ff; color: #4338ca;">
                MACHINE LEARNING
              </span>
              <h4 class="de-portfolio-title">
                Customer Churn Predictor
              </h4>
              <p class="de-portfolio-desc">
                Build, optimize, and evaluate classification models in Scikit-learn to predict customer retention probabilities.
              </p>
            </div>
            <div class="de-portfolio-footer">
              <span class="de-portfolio-num">Portfolio Project #02</span>
              <span class="de-portfolio-link">100% Practical ➔</span>
            </div>
          </div>

          <!-- Project 3 -->
          <div class="de-portfolio-card">
            <div>
              <span class="de-portfolio-tag" style="background: #faf5ff; border: 1px solid #f3e8ff; color: #7e22ce;">
                DEEP LEARNING & NLP
              </span>
              <h4 class="de-portfolio-title">
                Sentiment Classifier App
              </h4>
              <p class="de-portfolio-desc">
                Deploy a semantic text classifier trained on consumer reviews utilizing tokenization, embedding matrices, and recurrent structures.
              </p>
            </div>
            <div class="de-portfolio-footer">
              <span class="de-portfolio-num">Portfolio Project #03</span>
              <span class="de-portfolio-link">100% Practical ➔</span>
            </div>
          </div>

          <!-- Project 4 -->
          <div class="de-portfolio-card">
            <div>
              <span class="de-portfolio-tag" style="background: #fdf4ff; border: 1px solid #fae8ff; color: #a21caf;">
                GENERATIVE AI
              </span>
              <h4 class="de-portfolio-title">
                Enterprise Knowledge-Base AI
              </h4>
              <p class="de-portfolio-desc">
                Implement a full-featured Retrieval-Augmented Generation (RAG) chatbot using ChromaDB to answer questions based on complex PDF uploads.
              </p>
            </div>
            <div class="de-portfolio-footer">
              <span class="de-portfolio-num">Portfolio Project #04</span>
              <span class="de-portfolio-link">100% Practical ➔</span>
            </div>
          </div>

          <!-- Project 5 -->
          <div class="de-portfolio-card">
            <div>
              <span class="de-portfolio-tag" style="background: #f0f9ff; border: 1px solid #e0f2fe; color: #0284c7;">
                AI ENGINEERING
              </span>
              <h4 class="de-portfolio-title">
                Automated AI agents with Tools
              </h4>
              <p class="de-portfolio-desc">
                Build stateful multi-agent pipelines in LangGraph capable of searching web data, calling database APIs, and generating structured JSON reports.
              </p>
            </div>
            <div class="de-portfolio-footer">
              <span class="de-portfolio-num">Portfolio Project #05</span>
              <span class="de-portfolio-link">100% Practical ➔</span>
            </div>
          </div>

          <!-- Project 6 -->
          <div class="de-portfolio-card">
            <div>
              <span class="de-portfolio-tag" style="background: #eff6ff; border: 1px solid #dbeafe; color: #1d4ed8;">
                FULL STACK AI
              </span>
              <h4 class="de-portfolio-title">
                Cloud-Deployed AI Application
              </h4>
              <p class="de-portfolio-desc">
                Compile your database, FastAPI backend, and Streamlit frontend into Docker containers and deploy them to public cloud runtimes.
              </p>
            </div>
            <div class="de-portfolio-footer">
              <span class="de-portfolio-num">Portfolio Project #06</span>
              <span class="de-portfolio-link">100% Practical ➔</span>
            </div>
          </div>
        </div>

      </div>
    </section>


    <!-- ==================== 5. FINAL CAPSTONE SECTION ==================== -->
    <section class="de-capstone-section">
      <div class="de-container">

        <!-- Outer Card -->
        <div class="de-capstone-card">
          <span class="de-section-badge-outline">
            <?= cms('course-data-engineer.final-industry-style-ai.01', 'FINAL EXAM & CAPSTONE') ?>
          </span>
          <h2 class="de-section-title">
            <?= cms('course-data-engineer.final-industry-style-ai.02', 'Final Industry-Style AI Capstone') ?>
          </h2>
          <p class="de-section-desc">
            <?= cms('course-data-engineer.final-industry-style-ai.03', 'Students design and build a production-grade, end-to-end AI application. You will handle dataset preparation, model/retrieval architecture, API server design, and public cloud deployment.') ?>
          </p>

          <!-- Dark Dashboard Terminal Mockup -->
          <div class="de-lakehouse-terminal">
            <!-- Terminal Header -->
            <div class="de-terminal-header">
              <span style="color: #cbd5e1;">https://enterprise-lakehouse.chedo.ai</span>
              <div style="display: flex; align-items: center; gap: 6px;">
                <span class="de-pulse-dot"></span>
                <span style="color: #10b981; font-weight: 850; font-size: 10.5px;">LIVE</span>
              </div>
            </div>

            <!-- 3 Metrics Columns -->
            <div class="de-terminal-metrics">
              <div>
                <span class="de-metric-label">THROUGHPUT</span>
                <span class="de-metric-val">1.42M rec/s</span>
                <span class="de-metric-sub">Kafka → Spark</span>
              </div>
              <div>
                <span class="de-metric-label">VECTOR EMBEDDINGS</span>
                <span class="de-metric-val">15.8ms</span>
                <span class="de-metric-sub">Pinecone / ChromaDB</span>
              </div>
              <div>
                <span class="de-metric-label">DEPLOYMENT</span>
                <span class="de-metric-val">Docker Run</span>
                <span class="de-metric-sub">FastAPI & Streamlit</span>
              </div>
            </div>

            <!-- Terminal Bottom Bar -->
            <div class="de-terminal-footer">
              <div class="de-terminal-pill">
                Architecture: Ingest → Transform → Model Fine-Tune → API Serve
              </div>
              <span>100% Student Engineered</span>
            </div>
          </div>

          <!-- 6 Architecture Steps Pills -->
          <div class="de-arch-pills">
            <div class="de-arch-pill"><?= cms('course-data-engineer.final-industry-style-ai.04', 'Data Extraction') ?></div>
            <div class="de-arch-pill"><?= cms('course-data-engineer.final-industry-style-ai.05', 'Vector / RAG DB') ?></div>
            <div class="de-arch-pill"><?= cms('course-data-engineer.final-industry-style-ai.06', 'Model Fine-Tuning') ?></div>
            <div class="de-arch-pill"><?= cms('course-data-engineer.final-industry-style-ai.07', 'FastAPI Backend') ?></div>
            <div class="de-arch-pill"><?= cms('course-data-engineer.final-industry-style-ai.08', 'Streamlit / Web UI') ?></div>
            <div class="de-arch-pill"><?= cms('course-data-engineer.final-industry-style-ai.09', 'Docker Cloud Run') ?></div>
          </div>

          <p class="de-capstone-notice">
            <?= cms('course-data-engineer.final-industry-style-ai.10', 'Includes code reviews, architectural documentation, and a final presentation to mentors.') ?>
          </p>

          <!-- Bottom Callout Action Row (Matches PDF Page 6 top) -->
          <div class="de-capstone-action">
            <div>
              <div class="de-ticket-text">
                YOUR TICKET TO THE FUTURE! 🚀
              </div>
              <p style="font-size: 12px; color: #64748b; margin: 3px 0 0 0;">Limited classroom seats available in Pune</p>
            </div>

            <div>
              <a href="<?= cmsu('course-data-engineer.data-engineer.16', '../contact.php') ?>" class="de-btn-primary">
                <span>Enroll Now</span>
                <span>➔</span>
              </a>
            </div>

            <div style="font-size: 12px; color: #475569; line-height: 1.5;">
              <div>📍 Pune, MH • Offline Classroom</div>
              <a href="https://wa.me/918793100815" target="_blank" rel="noopener noreferrer" style="color: #10b981; font-weight: 800; text-decoration: none; display: flex; align-items: center; justify-content: flex-end; gap: 4px;">
                <span>💬</span> WhatsApp: +91 87931 00815
              </a>
            </div>
          </div>

        </div>

      </div>
    </section>


    <!-- ==================== 6. TOOLS & ECOSYSTEM ==================== -->
    <section class="de-tools-section">
      <div class="de-container">

        <!-- Section Header -->
        <div style="text-align: center; max-width: 780px; margin: 0 auto;">
          <span class="de-section-badge-teal">
            <?= cms('course-data-engineer.tools-technologies-you-will.01', 'ECOSYSTEM') ?>
          </span>
          <h2 class="de-section-title">
            <?= cms('course-data-engineer.tools-technologies-you-will.02', 'Tools & Technologies You Will Master') ?>
          </h2>
          <p class="de-section-desc">
            <?= cms('course-data-engineer.tools-technologies-you-will.03', 'Gain hands-on command over the industry standard developer toolkit.') ?>
          </p>
        </div>

        <!-- 4 Category Cards -->
        <div class="de-tools-grid">
          <!-- Group 1 -->
          <div class="de-tool-card">
            <h4 class="de-tool-card-title">
              <span>🌐</span>
              <span><?= cms('course-data-engineer.tools-technologies-you-will.04', 'Programming & Data') ?></span>
            </h4>
            <div class="de-tool-badges">
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.05', 'Python') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.06', 'NumPy') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.07', 'Pandas') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.08', 'Matplotlib') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.09', 'Seaborn') ?></span>
            </div>
          </div>

          <!-- Group 2 -->
          <div class="de-tool-card">
            <h4 class="de-tool-card-title">
              <span>🧠</span>
              <span><?= cms('course-data-engineer.tools-technologies-you-will.10', 'Machine & Deep Learning') ?></span>
            </h4>
            <div class="de-tool-badges">
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.11', 'Scikit-learn') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.12', 'PyTorch') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.13', 'TensorFlow') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.14', 'Word Embeddings') ?></span>
            </div>
          </div>

          <!-- Group 3 -->
          <div class="de-tool-card">
            <h4 class="de-tool-card-title">
              <span>⚡</span>
              <span><?= cms('course-data-engineer.tools-technologies-you-will.15', 'Generative AI & Agents') ?></span>
            </h4>
            <div class="de-tool-badges">
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.16', 'LLMs (GPT/Gemini)') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.17', 'Hugging Face') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.18', 'LangChain') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.19', 'LangGraph') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.20', 'ChromaDB') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.21', 'FAISS') ?></span>
            </div>
          </div>

          <!-- Group 4 -->
          <div class="de-tool-card">
            <h4 class="de-tool-card-title">
              <span>🗄️</span>
              <span><?= cms('course-data-engineer.tools-technologies-you-will.22', 'Databases & Cloud') ?></span>
            </h4>
            <div class="de-tool-badges">
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.23', 'MySQL / PostgreSQL') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.24', 'MongoDB / Firebase') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.25', 'Supabase') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.26', 'FastAPI') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.28', 'Docker') ?></span>
              <span class="de-tech-badge"><?= cms('course-data-engineer.tools-technologies-you-will.29', 'GCP / AWS') ?></span>
            </div>
          </div>
        </div>

      </div>
    </section>


    <!-- ==================== 7. SKILLS YOU WILL GAIN ==================== -->
    <section class="de-skills-section">
      <div class="de-container">

        <!-- Section Header -->
        <div style="text-align: center; max-width: 780px; margin: 0 auto;">
          <h2 class="de-section-title">
            <?= cms('course-data-engineer.skills-you-will-gain.01', 'Skills You Will Gain') ?>
          </h2>
          <p class="de-section-desc">
            <?= cms('course-data-engineer.skills-you-will-gain.02', 'Our curriculum is designed to make you self-sufficient, building analytical, modeling, and system-level development capabilities.') ?>
          </p>
        </div>

        <!-- 4 Columns of Skill Pills (Matches PDF Page 6) -->
        <div class="de-skills-grid">
          <!-- Col 1 -->
          <div class="de-skill-col">
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.03', 'Python Programming') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.07', 'Business Visualization') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.11', 'Large Language Models') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.15', 'Parameter Fine-Tuning') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.19', 'Power BI Dashboards') ?>
            </div>
          </div>

          <!-- Col 2 -->
          <div class="de-skill-col">
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.04', 'Data Analytics') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.08', 'Machine Learning Models') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.12', 'Vector Databases') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.16', 'AI Agents & LangGraph') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.20', 'MLOps & Docker Containers') ?>
            </div>
          </div>

          <!-- Col 3 -->
          <div class="de-skill-col">
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.05', 'SQL & NoSQL Databases') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.09', 'Neural Networks & DL') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.13', 'Prompt Engineering') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.17', 'Backend APIs (FastAPI)') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.21', 'Cloud Deployments') ?>
            </div>
          </div>

          <!-- Col 4 -->
          <div class="de-skill-col">
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.06', 'Descriptive Statistics') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.10', 'Natural Language Processing') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.14', 'Retrieval-Augmented (RAG)') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.18', 'Web UIs (Streamlit)') ?>
            </div>
            <div class="de-skill-pill">
              <span class="de-blue-bullet"></span> <?= cms('course-data-engineer.skills-you-will-gain.22', 'n8n Workflow Automation') ?>
            </div>
          </div>
        </div>

      </div>
    </section>


    <!-- ==================== 8. CAREER DIRECTION ==================== -->
    <section class="de-career-section">
      <div class="de-container">

        <!-- Section Header -->
        <div style="text-align: center; max-width: 780px; margin: 0 auto;">
          <h2 class="de-section-title">
            <?= cms('course-data-engineer.your-future-career-rationale.01', 'Your Future Career Rationale') ?>
          </h2>
          <p class="de-section-desc">
            <?= cms('course-data-engineer.your-future-career-rationale.02', 'Graduates of this 6-month career program possess the rare intersection of classical analytics, statistical machine learning, and cutting-edge Generative AI development capabilities.') ?>
          </p>
        </div>

        <!-- 4 Career Cards (Matches PDF Page 6) -->
        <div class="de-career-grid">
          <!-- Card 1 -->
          <div class="de-career-card">
            <div class="de-career-header">
              <div class="de-career-icon">📊</div>
              <h4 class="de-career-role">
                <?= cms('course-data-engineer.your-future-career-rationale.03', 'Data Analyst') ?>
              </h4>
            </div>
            <p class="de-career-desc">
              <?= cms('course-data-engineer.your-future-career-rationale.04', 'Focus on Exploratory Data Analysis, database scripting (SQL), visualizations, and business intelligence reporting.') ?>
            </p>
          </div>

          <!-- Card 2 -->
          <div class="de-career-card">
            <div class="de-career-header">
              <div class="de-career-icon">🤖</div>
              <h4 class="de-career-role">
                <?= cms('course-data-engineer.your-future-career-rationale.05', 'Machine Learning Engineer') ?>
              </h4>
            </div>
            <p class="de-career-desc">
              <?= cms('course-data-engineer.your-future-career-rationale.06', 'Evaluate and build statistical predictive systems, classification modeling, decision logic, and serialize packages.') ?>
            </p>
          </div>

          <!-- Card 3 -->
          <div class="de-career-card">
            <div class="de-career-header">
              <div class="de-career-icon">⚡</div>
              <h4 class="de-career-role">
                <?= cms('course-data-engineer.your-future-career-rationale.07', 'AI / LLM Application Developer') ?>
              </h4>
            </div>
            <p class="de-career-desc">
              <?= cms('course-data-engineer.your-future-career-rationale.08', 'Build Retrieval-Augmented Generation workflows, AI conversational agents, tool bindings, and vector indexing.') ?>
            </p>
          </div>

          <!-- Card 4 -->
          <div class="de-career-card">
            <div class="de-career-header">
              <div class="de-career-icon">🚀</div>
              <h4 class="de-career-role">
                <?= cms('course-data-engineer.your-future-career-rationale.09', 'Generative AI Engineer') ?>
              </h4>
            </div>
            <p class="de-career-desc">
              <?= cms('course-data-engineer.your-future-career-rationale.10', 'Fine-tune hosted foundation systems, structure conversational prompts, and deploy FastAPI middleware servers.') ?>
            </p>
          </div>
        </div>

        <div class="de-career-note">
          <?= cms('course-data-engineer.your-future-career-rationale.11', '* We offer complete job-oriented support, interview preparation guidelines, and project reviews. Chedo Tech does not make unrealistic placement guarantees.') ?>
        </div>

      </div>
    </section>


    <!-- ==================== 9. RELATED PROGRAMS ==================== -->
    <section class="de-related-section">
      <div class="de-container">

        <!-- Section Header -->
        <div class="de-related-header">
          <div>
            <h2 class="de-section-title" style="margin: 0;">
              <?= cms('course-data-engineer.related-programs.01', 'Related Programs') ?>
            </h2>
          </div>
          <a href="<?= cmsu('course-data-engineer.related-programs.02', '../courses.php') ?>" class="de-related-link" style="font-size: 14px;">
            <span><?= cms('course-data-engineer.related-programs.03', 'All courses') ?></span>
            <span>➔</span>
          </a>
        </div>

        <!-- 3 Program Cards (Matches PDF Page 6 bottom / Page 7 top) -->
        <div class="de-related-grid">
          <!-- Card 1 -->
          <article class="de-related-card">
            <div class="de-related-img-wrap">
              <img src="../assets/images/courses/Data Science Foundation.webp" alt="Data Science Foundation">
            </div>
            <div class="de-related-body">
              <div>
                <h3 class="de-related-title">
                  <a href="<?= cmsu('course-data-engineer.related-programs.04', 'data-science-foundation.php') ?>">
                    <?= cms('course-data-engineer.related-programs.05', 'Data Science Foundation') ?>
                  </a>
                </h3>
                <p class="de-related-desc">
                  <?= cms('course-data-engineer.related-programs.06', 'A shorter 2-month introductory course in Python, NumPy, Pandas, and basic SQL database systems.') ?>
                </p>
              </div>
              <a href="<?= cmsu('course-data-engineer.related-programs.04', 'data-science-foundation.php') ?>" class="de-related-link">
                <span><?= cms('course-data-engineer.related-programs.07', 'View Course') ?></span>
                <span>➔</span>
              </a>
            </div>
          </article>

          <!-- Card 2 -->
          <article class="de-related-card">
            <div class="de-related-img-wrap">
              <img src="../assets/images/courses/Python Programming.webp" alt="Python Programming">
            </div>
            <div class="de-related-body">
              <div>
                <h3 class="de-related-title">
                  <a href="<?= cmsu('course-data-engineer.related-programs.08', 'python-programming.php') ?>">
                    <?= cms('course-data-engineer.related-programs.09', 'Python Programming') ?>
                  </a>
                </h3>
                <p class="de-related-desc">
                  <?= cms('course-data-engineer.related-programs.10', 'Complete foundational Python coding course, from basic types to object oriented architectures.') ?>
                </p>
              </div>
              <a href="<?= cmsu('course-data-engineer.related-programs.08', 'python-programming.php') ?>" class="de-related-link">
                <span><?= cms('course-data-engineer.related-programs.11', 'View Course') ?></span>
                <span>➔</span>
              </a>
            </div>
          </article>

          <!-- Card 3 -->
          <article class="de-related-card">
            <div class="de-related-img-wrap">
              <img src="../assets/images/courses/ML Engineering.webp" alt="ML Engineer">
            </div>
            <div class="de-related-body">
              <div>
                <h3 class="de-related-title">
                  <a href="<?= cmsu('course-data-engineer.related-programs.12', 'ml-engineer.php') ?>">
                    <?= cms('course-data-engineer.related-programs.13', 'ML Engineer') ?>
                  </a>
                </h3>
                <p class="de-related-desc">
                  <?= cms('course-data-engineer.related-programs.14', '6-month intensive machine learning & deep learning program with real-world production models.') ?>
                </p>
              </div>
              <a href="<?= cmsu('course-data-engineer.related-programs.12', 'ml-engineer.php') ?>" class="de-related-link">
                <span><?= cms('course-data-engineer.related-programs.15', 'View Course') ?></span>
                <span>➔</span>
              </a>
            </div>
          </article>
        </div>

      </div>
    </section>

  </main>
</div>

<!-- JAVASCRIPT: Accordion Module Topic Toggling -->
<script>
  /* One module open at a time; an open card floats over its neighbours so nothing below it moves */
  function deCloseCard(card) {
    var extra = card.querySelector('.de-card-extra-topics');
    var btn = card.querySelector('.de-card-toggle-btn');
    if (extra) extra.style.display = 'none';
    if (btn) {
      btn.querySelector('.toggle-arrow').style.transform = 'rotate(0deg)';
      btn.querySelector('.toggle-text').textContent = btn.getAttribute('data-more');
    }
    card.classList.remove('is-open');
    if (card.parentElement) card.parentElement.style.height = '';
  }

  function toggleCardExtraTopics(btn) {
    var card = btn.closest('.module-card');
    var extra = card.querySelector('.de-card-extra-topics');
    if (!extra) return;
    var willOpen = extra.style.display !== 'flex';

    document.querySelectorAll('.module-card.is-open').forEach(function(c) {
      if (c !== card) deCloseCard(c);
    });

    if (!willOpen) {
      deCloseCard(card);
      return;
    }
    card.parentElement.style.height = card.offsetHeight + 'px';
    extra.style.display = 'flex';
    btn.querySelector('.toggle-arrow').style.transform = 'rotate(180deg)';
    btn.querySelector('.toggle-text').textContent = btn.getAttribute('data-less');
    card.classList.add('is-open');
  }

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.module-card.is-open').forEach(deCloseCard);
    }
  });
</script>

<?php include '../includes/footer.php'; ?>