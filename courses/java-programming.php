<?php
$page_title = "Java Programming Course in Pune | Chedo Tech";
$page_description = "Learn Java programming in Pune at Chedo Tech — offline, practical classes covering OOP, inheritance, interfaces, exception handling, AWT GUI and algorithms.";
$page_canonical = "https://chedo.in/courses/java-programming.php";
$page_extra_css = ['/assets/css/course-hero.css?v=20261024'];
include '../includes/header.php';
?>
<style>
  /* ==========================================================================
     CHEDO TECH COURSE PAGE — PREMIUM DESIGN SYSTEM (shared look with Data Engineer)
     ========================================================================== */
  .cp-page {
    font-family: Inter, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif;
    color: #1e293b;
    background: #ffffff;
    -webkit-font-smoothing: antialiased;
  }

  .cp-page *,
  .cp-page *::before,
  .cp-page *::after {
    box-sizing: border-box;
  }

  .cp-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 24px;
    width: 100%;
  }

  .cp-container-wide {
    max-width: 1400px;
  }

  .cp-container-mid {
    max-width: 1060px;
  }

  /* ---------------- SECTION HEADS ---------------- */
  .cp-sec-head {
    text-align: center;
    max-width: 780px;
    margin: 0 auto 44px auto;
  }

  .cp-section-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    border: 1px solid #3b82f6;
    background: #eff6ff;
    color: #2563eb;
    border-radius: 9999px;
    padding: 5px 18px;
    font-size: 11.5px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin: 0;
  }

  .cp-section-badge .cp-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #2563eb;
  }

  .cp-section-title {
    font-size: clamp(2rem, 3.8vw, 2.75rem);
    font-weight: 900;
    color: #09172e;
    letter-spacing: -0.035em;
    line-height: 1.15;
    margin: 12px 0 0 0;
  }

  .cp-section-desc {
    font-size: 15px;
    line-height: 1.65;
    color: #64748b;
    max-width: 720px;
    margin: 14px auto 0 auto;
  }

  /* ---------------- HERO (identical to Data Engineer) ---------------- */
  .cp-hero {
    background: radial-gradient(circle at 50% 0%, rgba(219, 234, 254, 0.65) 0%, rgba(240, 249, 255, 0.45) 45%, #ffffff 85%);
    position: relative;
    overflow: hidden;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-grid-overlay {
    position: absolute;
    inset: 0;
    background-image: linear-gradient(to right, rgba(203, 213, 225, 0.45) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(203, 213, 225, 0.45) 1px, transparent 1px);
    background-size: 32px 32px;
    mask-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.2) 75%, transparent 100%);
    -webkit-mask-image: radial-gradient(ellipse at center, rgba(0, 0, 0, 0.95) 0%, rgba(0, 0, 0, 0.2) 75%, transparent 100%);
    pointer-events: none;
  }

  .cp-hero-inner {
    position: relative;
    z-index: 10;
    max-width: 1400px;
    padding-top: 36px;
    padding-bottom: 64px;
  }

  .cp-crumb-wrap {
    margin-bottom: 22px;
  }

  .cp-crumb {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    color: #64748b;
    list-style: none;
    margin: 0;
    padding: 0;
  }

  .cp-crumb-link {
    color: #64748b;
    text-decoration: none;
    transition: color 0.15s;
  }

  .cp-crumb-link:hover {
    color: #1d4ed8;
  }

  .cp-crumb-sep {
    color: #cbd5e1;
  }

  .cp-crumb-cur {
    color: #0f172a;
    font-weight: 600;
  }

  .cp-hero-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 36px;
    position: relative;
    z-index: 10;
  }

  .cp-hero-left {
    flex: 1 1 50%;
    max-width: 660px;
    min-width: 0;
  }

  .cp-hero-right {
    flex: 1 1 50%;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    min-width: 0;
  }

  .cp-top-badges {
    display: flex;
    flex-wrap: nowrap;
    align-items: center;
    gap: 10px;
    margin-bottom: 20px;
    width: max-content;
    max-width: none;
  }

  .cp-top-badges > * {
    flex-shrink: 0;
    white-space: nowrap;
  }

  .cp-badge-level {
    background-color: #e11d48;
    color: #ffffff;
    font-size: 12px;
    font-weight: 800;
    border-radius: 9999px;
    padding: 4px 14px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    letter-spacing: 0.04em;
    box-shadow: 0 1px 3px rgba(225, 29, 72, 0.3);
    text-transform: uppercase;
  }

  .cp-badge-level .cp-dot {
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #ffffff;
  }

  .cp-fast-track {
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

  .cp-hero-title {
    font-size: clamp(2.2rem, 4.2vw, 3.3rem);
    font-weight: 900;
    letter-spacing: -0.035em;
    line-height: 1.05;
    margin: 0;
    text-transform: uppercase;
    background: linear-gradient(135deg, #09172e 0%, #163674 40%, #1d4ed8 75%, #2563eb 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
    color: transparent;
  }

  .cp-hero-title-long {
    font-size: clamp(2.2rem, 4.2vw, 3.3rem);
    line-height: 1.1;
  }

  .cp-hero-title-accent {
    display: inline;
  }

  .cp-hero-subtitle {
    font-size: clamp(1.4rem, 2.4vw, 1.85rem);
    font-weight: 850;
    color: #1d4ed8;
    margin: 12px 0 0 0;
    letter-spacing: -0.02em;
    line-height: 1.25;
  }

  .cp-hero-desc {
    margin: 14px 0 0 0;
    max-width: 580px;
    font-size: 15.5px;
    line-height: 1.65;
    color: #475569;
  }

  .cp-features-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 10px 10px;
    margin-top: 24px;
    max-width: 680px;
  }

  .cp-feature-pill {
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

  .cp-feature-pill:hover {
    border-color: #cbd5e1;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px rgba(0, 0, 0, 0.05);
  }

  .cp-feature-emoji {
    flex-shrink: 0;
    line-height: 1;
  }

  .cp-hero-actions {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-top: 30px;
    flex-wrap: nowrap;
  }

  .cp-hero-actions .cp-btn-primary,
  .cp-hero-actions .cp-btn-secondary,
  .cp-hero-actions .cp-wa-btn {
    white-space: nowrap;
    font-size: 14px;
    padding: 10px 18px;
  }

  .cp-btn-primary {
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

  .cp-btn-primary:hover {
    background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%);
    box-shadow: 0 6px 20px rgba(37, 99, 235, 0.45);
    transform: translateY(-1px);
  }

  .cp-btn-secondary {
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

  .cp-btn-secondary:hover {
    border-color: #94a3b8;
    background: #f8fafc;
    transform: translateY(-1px);
  }

  .cp-wa-btn {
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
    color: #16a34a;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.15);
    transition: all 0.2s ease;
  }

  .cp-wa-btn:hover {
    background: #f0fdf4;
    transform: translateY(-1px);
    box-shadow: 0 6px 16px rgba(37, 211, 102, 0.25);
  }

  .cp-wa-icon {
    width: 18px;
    height: 18px;
    fill: currentColor;
    flex-shrink: 0;
  }

  .cp-hero-notice {
    margin: 14px 0 0 0;
    font-size: 12.5px;
    color: #64748b;
    font-weight: 500;
  }

  /* Hero illustration — same floating 3D look as Data Engineer */
  .cp-hero-image-wrap {
    position: relative;
    width: 100%;
    max-width: 660px;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .cp-hero-image-wrap::before {
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

  .cp-hero-img {
    position: relative;
    z-index: 1;
    width: 100%;
    height: auto;
    display: block;
    object-fit: contain;
    filter: drop-shadow(0 14px 28px rgba(15, 23, 42, 0.08));
    transition: transform 0.35s ease;
  }

  @media (hover: hover) {
    
  }

  /* Info strip under the hero */
  .cp-strip {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 14px;
    margin-top: 48px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 14px;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.03);
    position: relative;
    z-index: 10;
  }

  .cp-strip-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 12px 14px;
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    min-width: 0;
  }

  .cp-strip-icon {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    background: #faf5ff;
    border: 1px solid #f3e8ff;
  }

  .cp-strip-card:nth-child(1) .cp-strip-icon { background: linear-gradient(135deg, #0284c7 0%, #38bdf8 100%); border: none; }
  .cp-strip-card:nth-child(3) .cp-strip-icon { background: #fff1f2; border-color: #ffe4e6; }
  .cp-strip-card:nth-child(4) .cp-strip-icon { background: #ecfdf5; border-color: #d1fae5; }
  .cp-strip-card:nth-child(5) .cp-strip-icon { background: #fffbeb; border-color: #fef3c7; }

  .cp-strip-label {
    display: block;
    font-size: 10px;
    font-weight: 850;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: #475569;
    margin: 0;
  }

  .cp-strip-card:nth-child(1) .cp-strip-label { color: #2563eb; }
  .cp-strip-card:nth-child(4) .cp-strip-label { color: #059669; }

  .cp-strip-value {
    display: block;
    font-size: 13.5px;
    font-weight: 800;
    color: #0f172a;
    line-height: 1.3;
    margin: 2px 0 0 0;
  }

  /* ---------------- LEARNING PATHWAY ---------------- */
  .cp-pathway {
    padding: 64px 0 80px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-steps {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 16px;
    max-width: 1100px;
    margin: 0 auto;
  }

  .cp-step-card {
    width: calc(25% - 12px);
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

  .cp-step-card:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 6px 14px rgba(0, 0, 0, 0.05);
  }

  .cp-step-tag {
    font-size: 11px;
    font-weight: 900;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    display: block;
    margin-bottom: 4px;
  }

  .cp-tc-blue { color: #2563eb; }
  .cp-tc-cyan { color: #0891b2; }
  .cp-tc-indigo { color: #4f46e5; }
  .cp-tc-purple { color: #9333ea; }
  .cp-tc-violet { color: #7c3aed; }
  .cp-tc-fuchsia { color: #c026d3; }
  .cp-tc-slate { color: #059669; }

  .cp-step-heading {
    font-size: 15px;
    font-weight: 850;
    color: #0f172a;
    margin: 0;
  }

  .cp-step-text,
  .cp-career-desc,
  .cp-proj-desc,
  .cp-mod-desc,
  .cp-related-desc {
    overflow-wrap: anywhere;
  }

  .cp-step-text {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.55;
    margin: 10px 0 0 0;
  }

  /* ---------------- CURRICULUM — MODULE CARDS ---------------- */
  .cp-curriculum {
    padding: 72px 0 88px 0;
    background: radial-gradient(circle at 50% 0%, rgba(224, 242, 254, 0.55) 0%, rgba(240, 249, 255, 0.35) 50%, #ffffff 85%);
    border-bottom: 1px solid #e2e8f0;
    position: relative;
    overflow: visible;
  }

  .cp-curriculum .cp-container {
    position: relative;
    z-index: 10;
  }

  /* align-items:start => opening one module never stretches its neighbours */
  .cp-mod-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 18px;
    align-items: start;
  }

  .cp-mod-slot {
    position: relative;
    min-width: 0;
  }

  /* An open card floats over the cards below it instead of pushing them down */
  .cp-mod.is-open {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    z-index: 40;
    border-color: var(--c-hover);
    box-shadow: 0 26px 50px -12px var(--c-shadow), 0 10px 22px rgba(15, 23, 42, 0.14);
  }

  @media (hover: hover) {
    .cp-mod.is-open:hover {
      transform: none;
    }
  }

  .cp-mod {
    min-width: 0;
    border-radius: 18px;
    border: 1px solid var(--c-border);
    background: linear-gradient(150deg, #ffffff 0%, var(--c-tint) 100%);
    box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04), 0 1px 3px rgba(15, 23, 42, 0.02);
    overflow: hidden;
    transition: transform 0.28s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.28s cubic-bezier(0.16, 1, 0.3, 1), border-color 0.25s ease;
  }

  @media (hover: hover) {
    .cp-mod:hover {
      transform: translateY(-4px);
      border-color: var(--c-hover);
      box-shadow: 0 14px 28px -4px var(--c-shadow), 0 6px 12px -2px rgba(15, 23, 42, 0.06);
    }
  }

  .cp-th-0 { --c-border: #bae6fd; --c-tint: #f0f9ff; --c-badge-bg: #e0f2fe; --c-badge-bd: #7dd3fc; --c-accent: #0284c7; --c-hover: #38bdf8; --c-shadow: rgba(2, 132, 199, 0.16); }
  .cp-th-1 { --c-border: #e9d5ff; --c-tint: #faf5ff; --c-badge-bg: #f3e8ff; --c-badge-bd: #d8b4fe; --c-accent: #7e22ce; --c-hover: #c084fc; --c-shadow: rgba(126, 34, 206, 0.16); }
  .cp-th-2 { --c-border: #bbf7d0; --c-tint: #f0fdf4; --c-badge-bg: #dcfce7; --c-badge-bd: #86efac; --c-accent: #15803d; --c-hover: #4ade80; --c-shadow: rgba(21, 128, 61, 0.16); }
  .cp-th-3 { --c-border: #fde68a; --c-tint: #fffbeb; --c-badge-bg: #fef3c7; --c-badge-bd: #fcd34d; --c-accent: #b45309; --c-hover: #fbbf24; --c-shadow: rgba(180, 83, 9, 0.16); }
  .cp-th-4 { --c-border: #fecdd3; --c-tint: #fff1f2; --c-badge-bg: #ffe4e6; --c-badge-bd: #fda4af; --c-accent: #be123c; --c-hover: #fb7185; --c-shadow: rgba(190, 18, 60, 0.16); }
  .cp-th-5 { --c-border: #c7d2fe; --c-tint: #eef2ff; --c-badge-bg: #e0e7ff; --c-badge-bd: #a5b4fc; --c-accent: #4338ca; --c-hover: #818cf8; --c-shadow: rgba(67, 56, 202, 0.16); }

  .cp-mod-body {
    padding: 18px 18px 14px 18px;
    display: flex;
    align-items: stretch;
    justify-content: space-between;
    gap: 14px;
  }

  .cp-mod-main {
    flex: 1;
    min-width: 0;
  }

  .cp-mod-side {
    width: 76px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    align-self: center;
  }

  .cp-mod-tile {
    width: 70px;
    height: 70px;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--c-border);
    background: linear-gradient(135deg, var(--c-badge-bg) 0%, var(--c-tint) 100%);
    box-shadow: 0 4px 14px -2px rgba(15, 23, 42, 0.06);
    padding: 8px;
    overflow: hidden;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
  }

  .cp-mod:hover .cp-mod-tile {
    transform: scale(1.05);
    box-shadow: 0 6px 18px -2px rgba(15, 23, 42, 0.1);
  }

  .cp-mod-tile img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    display: block;
    filter: drop-shadow(0 2px 4px rgba(15, 23, 42, 0.08));
  }

  .cp-mod-icon {
    width: 34px;
    height: 34px;
    display: block;
    background-color: var(--c-accent);
    -webkit-mask: var(--icon) center / contain no-repeat;
    mask: var(--icon) center / contain no-repeat;
  }

  .cp-mod-meta {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 9px;
    flex-wrap: wrap;
  }

  .cp-mod-badge {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 11px;
    font-weight: 850;
    letter-spacing: 0.04em;
    padding: 3px 9px;
    border-radius: 6px;
    border: 1px solid var(--c-badge-bd);
    background: var(--c-badge-bg);
    color: var(--c-accent);
    line-height: 1.2;
  }

  .cp-mod-count {
    font-size: 10px;
    font-weight: 800;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #64748b;
  }

  .cp-mod-title {
    font-size: 16.5px;
    font-weight: 800;
    color: #091e42;
    margin: 0 0 8px 0;
    letter-spacing: -0.015em;
    line-height: 1.3;
  }

  .cp-mod-desc {
    font-size: 12.5px;
    line-height: 1.55;
    color: #475569;
    margin: 0 0 10px 0;
  }

  .cp-mod-topics,
  .cp-mod-extra {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 5px;
  }

  .cp-mod-extra {
    margin-top: 6px;
    padding-top: 8px;
    border-top: 1px dashed #cbd5e1;
  }

  .cp-mod-extra[hidden] {
    display: none;
  }

  .cp-mod-topics li,
  .cp-mod-extra li {
    display: flex;
    align-items: baseline;
    gap: 7px;
    font-size: 12.5px;
    font-weight: 600;
    color: #334155;
    line-height: 1.4;
    word-break: break-word;
  }

  .cp-mod-topics li::before,
  .cp-mod-extra li::before {
    content: '✓';
    font-size: 11px;
    font-weight: 900;
    color: var(--c-accent);
    flex-shrink: 0;
  }

  .cp-mod-topics li strong,
  .cp-mod-extra li strong {
    font-weight: 800;
    color: #0f172a;
  }

  .cp-mod-toggle {
    margin-top: 10px;
    background: none;
    border: none;
    padding: 0;
    font-size: 12px;
    font-weight: 750;
    color: var(--c-accent);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: opacity 0.15s;
  }

  .cp-mod-toggle:hover {
    opacity: 0.8;
  }

  .cp-mod-toggle:focus-visible {
    outline: 2px solid var(--c-accent);
    outline-offset: 3px;
    border-radius: 4px;
  }

  .cp-mod-toggle .cp-chev {
    font-size: 11px;
    transition: transform 0.2s ease;
  }

  .cp-mod-toggle[aria-expanded="true"] .cp-chev {
    transform: rotate(180deg);
  }

  .cp-mod-tools {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 12px;
  }

  .cp-mod-tools span {
    font-size: 11px;
    font-weight: 700;
    color: var(--c-accent);
    background: var(--c-badge-bg);
    border: 1px solid var(--c-badge-bd);
    border-radius: 8px;
    padding: 3px 9px;
  }

  /* Equal-height module cards: every card in a row matches the tallest, strip pinned to the bottom */
  .cp-mod-grid { align-items: stretch; }
  .cp-mod-slot { display: flex; }
  .cp-mod-slot > .cp-mod { width: 100%; display: flex; flex-direction: column; }
  .cp-mod-slot > .cp-mod.is-open { position: absolute; width: auto; }
  .cp-mod-body { flex: 1 1 auto; }
  .cp-mod-strip { margin-top: auto; }
  .cp-mod-title { min-height: 2.5em; }
  .cp-mod-tile img.is-icon { width: 38px; height: 38px; filter: none; }

  .cp-mod-strip {
    padding: 8px 18px;
    background: rgba(248, 250, 252, 0.9);
    border-top: 1px solid #edf2f7;
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    font-size: 10.5px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #64748b;
  }

  .cp-mod-strip b {
    font-weight: 800;
    color: #475569;
  }

  .cp-mod-strip em {
    font-style: normal;
    font-weight: 800;
    font-size: 10px;
    color: #d97706;
  }

  /* ---------------- PORTFOLIO ---------------- */
  .cp-portfolio {
    padding: 72px 0 88px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-portfolio-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
  }

  .cp-proj-card {
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

  .cp-proj-card:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
  }

  .cp-proj-tag {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 9999px;
    font-size: 10.5px;
    font-weight: 850;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    margin-bottom: 14px;
    border: 1px solid transparent;
  }

  .cp-pth-0 .cp-proj-tag { background: #ecfeff; border-color: #cffafe; color: #0891b2; }
  .cp-pth-1 .cp-proj-tag { background: #eef2ff; border-color: #e0e7ff; color: #4338ca; }
  .cp-pth-2 .cp-proj-tag { background: #faf5ff; border-color: #f3e8ff; color: #7e22ce; }
  .cp-pth-3 .cp-proj-tag { background: #f5f3ff; border-color: #ede9fe; color: #6d28d9; }
  .cp-pth-4 .cp-proj-tag { background: #fdf4ff; border-color: #fae8ff; color: #a21caf; }
  .cp-pth-5 .cp-proj-tag { background: #eff6ff; border-color: #dbeafe; color: #1d4ed8; }

  .cp-proj-title {
    font-size: 17px;
    font-weight: 850;
    color: #0f172a;
    margin: 0 0 10px 0;
    line-height: 1.3;
  }

  .cp-proj-desc {
    font-size: 13px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
  }

  .cp-proj-footer {
    margin-top: 24px;
    padding-top: 14px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 11.5px;
  }

  .cp-proj-num {
    font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, monospace;
    color: #64748b;
  }

  .cp-proj-link {
    font-weight: 800;
    color: #2563eb;
  }

  /* ---------------- CAPSTONE ---------------- */
  .cp-capstone {
    padding: 72px 0 88px 0;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-capstone-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 28px;
    padding: 52px 40px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
    text-align: center;
  }

  .cp-capstone-card .cp-section-desc {
    margin-bottom: 0;
  }

  .cp-arch {
    display: grid;
    grid-template-columns: repeat(6, minmax(0, 1fr));
    gap: 14px;
    max-width: 920px;
    margin: 34px auto 0 auto;
    padding: 22px;
    background: #090d16;
    border: 1px solid #1e293b;
    border-radius: 18px;
    box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.35);
  }

  .cp-arch-pill {
    position: relative;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid #1e293b;
    border-radius: 12px;
    padding: 12px 8px;
    font-size: 12px;
    font-weight: 700;
    color: #e2e8f0;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    min-height: 54px;
    transition: border-color 0.2s, background 0.2s;
  }

  .cp-arch-pill:hover {
    border-color: #38bdf8;
    background: rgba(56, 189, 248, 0.08);
  }

  .cp-arch-pill:not(:last-child)::after {
    content: '›';
    position: absolute;
    right: -11px;
    top: 50%;
    transform: translateY(-50%);
    color: #38bdf8;
    font-size: 16px;
    font-weight: 900;
    line-height: 1;
  }

  .cp-capstone-notice {
    font-size: 12.5px;
    color: #64748b;
    margin: 24px 0 0 0;
  }

  .cp-capstone-action {
    margin-top: 28px;
    padding-top: 26px;
    border-top: 1px solid #f1f5f9;
    display: flex;
    justify-content: center;
  }

  /* ---------------- TOOLS ---------------- */
  .cp-tools {
    padding: 72px 0 88px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-tools-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 22px;
  }

  .cp-tool-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    position: relative;
    overflow: hidden;
  }

  .cp-tool-card::before {
    content: '';
    position: absolute;
    left: 0;
    right: 0;
    top: 0;
    height: 3px;
    background: linear-gradient(90deg, #2563eb, #38bdf8);
  }

  .cp-tool-title {
    font-size: 15px;
    font-weight: 850;
    color: #0f172a;
    margin: 0 0 16px 0;
  }

  .cp-tool-badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
  }

  .cp-tech-badge {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 8px;
    padding: 5px 11px;
    font-size: 12px;
    font-weight: 650;
    color: #334155;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.02);
  }

  /* ---------------- SKILLS ---------------- */
  .cp-skills {
    padding: 72px 0 88px 0;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-skills-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 12px 14px;
  }

  .cp-skill-pill {
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

  .cp-skill-pill:hover {
    border-color: #94a3b8;
    transform: translateY(-1px);
  }

  /* ---------------- CAREER ---------------- */
  .cp-career {
    padding: 72px 0 88px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-career-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 22px;
  }

  .cp-career-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 24px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    transition: all 0.2s ease;
    border-top: 3px solid #2563eb;
  }

  .cp-career-card:hover {
    border-color: #94a3b8;
    border-top-color: #2563eb;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.05);
  }

  .cp-career-role {
    font-size: 16px;
    font-weight: 850;
    color: #0f172a;
    margin: 0 0 10px 0;
    line-height: 1.3;
  }

  .cp-career-desc {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.6;
    margin: 0;
  }

  .cp-career-note {
    margin: 40px auto 0 auto;
    text-align: center;
    font-size: 12px;
    color: #64748b;
    max-width: 680px;
    line-height: 1.6;
  }

  /* ---------------- RELATED ---------------- */
  .cp-related {
    padding: 72px 0 88px 0;
    background: #f8fafc;
  }

  .cp-related-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-end;
    gap: 20px;
    margin-bottom: 36px;
  }

  .cp-related-header .cp-section-title {
    margin: 0;
  }

  .cp-related-link {
    font-size: 14px;
    font-weight: 800;
    color: #2563eb;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
  }

  .cp-related-link:hover {
    color: #1d4ed8;
  }

  .cp-related-link svg {
    width: 16px;
    height: 16px;
  }

  .cp-related-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 24px;
  }

  .cp-related-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    transition: all 0.2s ease;
  }

  .cp-related-card:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
  }

  .cp-related-img {
    height: 175px;
    width: 100%;
    overflow: hidden;
    background: #f1f5f9;
  }

  .cp-related-img img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform 0.3s ease;
  }

  .cp-related-card:hover .cp-related-img img {
    transform: scale(1.03);
  }

  .cp-related-body {
    padding: 24px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .cp-related-title {
    font-size: 16.5px;
    font-weight: 850;
    color: #0f172a;
    margin: 0;
  }

  .cp-related-title a {
    color: inherit;
    text-decoration: none;
    transition: color 0.15s;
  }

  .cp-related-title a:hover {
    color: #2563eb;
  }

  .cp-related-desc {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.6;
    margin: 8px 0 0 0;
    flex: 1;
  }

  .cp-related-more {
    margin-top: 18px;
    font-size: 12.5px;
    font-weight: 800;
    color: #2563eb;
    display: inline-flex;
    align-items: center;
    gap: 5px;
  }

  /* ---------------- RESPONSIVE ---------------- */
  @media (max-width: 1200px) {
    .cp-mod-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  }

  @media (max-width: 1023px) {
    .cp-tools-grid,
    .cp-career-grid,
    .cp-skills-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .cp-hero-row { flex-direction: column; gap: 32px; }
    .cp-hero-left, .cp-hero-right { flex: 1 1 100%; max-width: 100%; width: 100%; }
    .cp-strip { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .cp-step-card { width: calc(50% - 8px); }
    .cp-portfolio-grid,
    .cp-related-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .cp-arch { grid-template-columns: repeat(3, minmax(0, 1fr)); }
    .cp-arch-pill:not(:last-child)::after { display: none; }
  }

  @media (max-width: 767px) {
    .cp-container { padding: 0 16px; }
    .cp-hero-inner { padding-top: 24px; padding-bottom: 44px; }
    .cp-top-badges { flex-wrap: wrap; width: auto; }
    .cp-features-grid { grid-template-columns: 1fr; }
    .cp-strip { grid-template-columns: 1fr; }
    .cp-mod-grid,
    .cp-portfolio-grid,
    .cp-tools-grid,
    .cp-career-grid,
    .cp-related-grid { grid-template-columns: minmax(0, 1fr); }
    .cp-skills-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 10px; }
    .cp-skill-pill { border-radius: 14px; padding: 10px 12px; font-size: 12.5px; gap: 8px; }
    .cp-step-card { width: 100%; }
    .cp-pathway, .cp-curriculum, .cp-portfolio, .cp-capstone, .cp-tools, .cp-skills, .cp-career, .cp-related { padding-top: 56px; padding-bottom: 60px; }
    .cp-capstone-card { padding: 36px 20px; border-radius: 22px; }
    .cp-arch { grid-template-columns: repeat(2, minmax(0, 1fr)); padding: 14px; gap: 10px; }
    .cp-related-header { flex-direction: column; align-items: flex-start; }
    .cp-hero-actions { flex-wrap: wrap; }
    .cp-hero-actions .cp-btn-primary,
    .cp-hero-actions .cp-btn-secondary,
    .cp-hero-actions .cp-wa-btn { width: 100%; justify-content: center; }
  }

  @media (prefers-reduced-motion: reduce) {
    .cp-mod, .cp-feature-pill, .cp-step-card, .cp-proj-card, .cp-career-card, .cp-related-card, .cp-mod-tile { transition: none !important; }
  }

  /* ==========================================================================
     EXTRA COMPONENTS (about / why / how-you-learn / CTA / placeholders)
     ========================================================================== */

  /* Hero image placeholder — search the project for CHEDO_HERO_IMG_PLACEHOLDER */
  .cp-hero-placeholder {
    position: relative;
    z-index: 1;
    width: 100%;
    aspect-ratio: 3 / 2;
    border-radius: 28px;
    border: 2px dashed #93c5fd;
    background: linear-gradient(135deg, rgba(239, 246, 255, 0.9) 0%, rgba(224, 242, 254, 0.7) 100%);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 10px;
    color: #3b82f6;
    text-align: center;
    padding: 24px;
  }

  .cp-hero-placeholder svg {
    width: 44px;
    height: 44px;
    stroke: currentColor;
    fill: none;
    stroke-width: 1.6;
    stroke-linecap: round;
    stroke-linejoin: round;
    opacity: 0.8;
  }

  .cp-hero-placeholder span {
    font-size: 12px;
    font-weight: 800;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: #60a5fa;
  }

  /* Badge row variations */
  .cp-top-badges.cp-wrap {
    flex-wrap: wrap;
    width: auto;
  }

  .cp-badge-soft {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 9999px;
    padding: 4px 14px;
    font-size: 12px;
    font-weight: 700;
    color: #334155;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.04);
  }

  /* Hero strip with 4 cards */
  .cp-strip.cp-strip-4 {
    grid-template-columns: repeat(4, minmax(0, 1fr));
  }

  .cp-strip-icon svg {
    width: 20px;
    height: 20px;
  }

  .cp-strip-card:nth-child(1) .cp-strip-icon { color: #ffffff; }
  .cp-strip-card:nth-child(2) .cp-strip-icon { color: #7e22ce; }
  .cp-strip-card:nth-child(3) .cp-strip-icon { color: #e11d48; }
  .cp-strip-card:nth-child(4) .cp-strip-icon { color: #059669; }
  .cp-strip-card:nth-child(5) .cp-strip-icon { color: #d97706; }

  .cp-strip.cp-strip-3 {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }

  .cp-hero-sub {
    font-size: clamp(1.15rem, 2vw, 1.5rem);
    font-weight: 800;
    color: #1d4ed8;
    margin: 12px 0 0 0;
    letter-spacing: -0.02em;
    line-height: 1.3;
  }

  .cp-tag-row {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-top: 18px;
    max-width: 620px;
  }

  .cp-tag-pill {
    background: #ffffff;
    border: 1px solid #dbeafe;
    border-radius: 9999px;
    padding: 5px 13px;
    font-size: 12px;
    font-weight: 700;
    color: #1e40af;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
  }

  /* Sub titles (left-aligned two-column blocks) */
  .cp-sub-title {
    font-size: clamp(1.6rem, 3vw, 2.2rem);
    font-weight: 900;
    color: #09172e;
    letter-spacing: -0.03em;
    line-height: 1.18;
    margin: 0;
  }

  /* ---------------- ABOUT ---------------- */
  .cp-about {
    padding: 72px 0 88px 0;
    background: #ffffff;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-about-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 56px;
    align-items: start;
  }

  .cp-about-text {
    margin-top: 18px;
    display: flex;
    flex-direction: column;
    gap: 14px;
  }

  .cp-about-p {
    font-size: 15.5px;
    line-height: 1.75;
    color: #475569;
    margin: 0;
  }

  .cp-why-grid {
    list-style: none;
    margin: 22px 0 0 0;
    padding: 0;
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
  }

  .cp-why-card {
    display: flex;
    align-items: flex-start;
    gap: 14px;
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    transition: all 0.2s ease;
  }

  .cp-why-card:hover {
    border-color: #93c5fd;
    transform: translateY(-2px);
    box-shadow: 0 8px 18px rgba(37, 99, 235, 0.08);
  }

  .cp-why-icon {
    width: 34px;
    height: 34px;
    border-radius: 11px;
    flex-shrink: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e0f2fe 0%, #eff6ff 100%);
    border: 1px solid #bae6fd;
    color: #0284c7;
  }

  .cp-why-title {
    font-size: 14.5px;
    font-weight: 850;
    color: #0f172a;
    margin: 0;
  }

  .cp-why-desc {
    font-size: 12.5px;
    line-height: 1.6;
    color: #64748b;
    margin: 4px 0 0 0;
  }

  /* ---------------- HOW YOU LEARN ---------------- */
  .cp-learn {
    padding: 72px 0 88px 0;
    background: #f8fafc;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-learn-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.15fr) minmax(0, 1fr);
    gap: 40px;
    align-items: stretch;
  }


  /* Right column fills the same height as the left list so both end on one line */
  .cp-learn-side > .cp-mini-grid { flex: 1; grid-auto-rows: 1fr; }
  .cp-learn-side {
    display: flex;
    flex-direction: column;
    gap: 18px;
  }

  .cp-learn-side .terminal {
    box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.35);
    border-radius: 18px;
  }

  .cp-mini-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 14px;
  }

  .cp-mini-card {
    background: #ffffff;
    border: 1px solid #cbd5e1;
    border-radius: 18px;
    padding: 18px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
  }

  .cp-mini-card .cp-why-icon {
    margin-bottom: 10px;
  }

  .cp-mini-title {
    font-size: 14px;
    font-weight: 850;
    color: #0f172a;
    margin: 0;
  }

  .cp-mini-desc {
    font-size: 12.5px;
    color: #64748b;
    line-height: 1.55;
    margin: 4px 0 0 0;
  }

  /* ---------------- CTA ---------------- */
  .cp-cta {
    padding: 72px 0 88px 0;
    background: #ffffff;
  }

  .cp-cta-card {
    background: radial-gradient(circle at 50% 0%, rgba(219, 234, 254, 0.7) 0%, rgba(240, 249, 255, 0.5) 50%, #ffffff 100%);
    border: 1px solid #bfdbfe;
    border-radius: 28px;
    padding: 56px 40px;
    text-align: center;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
  }

  .cp-cta-title {
    font-size: clamp(1.8rem, 3.6vw, 2.6rem);
    font-weight: 900;
    color: #09172e;
    letter-spacing: -0.035em;
    line-height: 1.15;
    margin: 0 auto;
    max-width: 640px;
  }

  .cp-cta-desc {
    font-size: 15.5px;
    line-height: 1.7;
    color: #64748b;
    max-width: 560px;
    margin: 14px auto 0 auto;
  }

  .cp-cta-actions {
    margin-top: 28px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    flex-wrap: wrap;
  }

  .cp-cta-actions .cp-wa-btn,
  .cp-cta-actions .cp-btn-secondary,
  .cp-cta-actions .cp-btn-primary {
    font-size: 14.5px;
    padding: 12px 26px;
    white-space: nowrap;
  }

  /* Module topic descriptions (programming pages) */
  .cp-mod-topics li > span,
  .cp-mod-extra li > span {
    min-width: 0;
  }

  .cp-mod-topics li small,
  .cp-mod-extra li small {
    display: block;
    font-size: 11.5px;
    font-weight: 500;
    line-height: 1.5;
    color: #64748b;
    margin-top: 1px;
  }

  /* Project icon */
  .cp-proj-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #eef2ff 0%, #f5f3ff 100%);
    border: 1px solid #e0e7ff;
    color: #4f46e5;
    margin-bottom: 14px;
  }

  .cp-proj-card .cp-proj-icon + .cp-proj-title { margin-top: 0; }

  /* Skills as flowing pills */
  .cp-skills-auto {
    grid-template-columns: repeat(4, minmax(0, 1fr));
  }

  @media (max-width: 1023px) {
    .cp-skills-auto { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  }

  .cp-skills-auto .cp-skill-pill::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: #2563eb;
    flex-shrink: 0;
  }


  /* Phase groups (full-stack pages) */
  .cp-groups { display: flex; flex-direction: column; gap: 40px; }

  .cp-group-title {
    font-size: 18px;
    font-weight: 850;
    letter-spacing: -0.01em;
    margin: 0 0 16px 0;
    padding-left: 12px;
    border-left: 4px solid var(--g, #2563eb);
    color: var(--g, #2563eb);
    line-height: 1.3;
  }

  .cp-gt-0 { --g: #c2410c; }
  .cp-gt-1 { --g: #1d4ed8; }
  .cp-gt-2 { --g: #15803d; }
  .cp-gt-3 { --g: #7e22ce; }
  .cp-gt-4 { --g: #0e7490; }
  .cp-gt-5 { --g: #6d28d9; }

  .cp-proj-list {
    list-style: none;
    margin: 4px 0 0 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 9px;
    font-size: 13px;
    line-height: 1.5;
    color: #475569;
    font-weight: 600;
  }

  .cp-tc-green { color: #16a34a; }
  .cp-tc-orange { color: #ea580c; }

  @media (max-width: 1023px) {
    .cp-about-grid,
    .cp-learn-grid { grid-template-columns: minmax(0, 1fr); gap: 36px; }
    .cp-strip.cp-strip-4,
    .cp-strip.cp-strip-3 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  }

  @media (max-width: 767px) {
    .cp-why-grid,
    .cp-mini-grid { grid-template-columns: minmax(0, 1fr); }
    .cp-strip.cp-strip-4,
    .cp-strip.cp-strip-3 { grid-template-columns: minmax(0, 1fr); }
    .cp-about, .cp-learn, .cp-cta { padding-top: 56px; padding-bottom: 60px; }
    .cp-cta-card { padding: 38px 20px; border-radius: 22px; }
    .cp-cta-actions .cp-wa-btn,
    .cp-cta-actions .cp-btn-secondary,
    .cp-cta-actions .cp-btn-primary { width: 100%; justify-content: center; }
    .cp-skills-auto { grid-template-columns: repeat(2, minmax(0, 1fr)); }
  }

  /* ==========================================================================
     SKIN — gives the sections that keep their original markup the same look
     (used on DSA / kids pages). Everything is scoped to .cp-skin.
     ========================================================================== */
  .cp-skin > section:not(.cp-hero) {
    padding-top: 72px;
    padding-bottom: 88px;
    border-top: 0;
    border-bottom: 1px solid #e2e8f0;
  }

  .cp-skin > section:not(.cp-hero):nth-of-type(odd) { background: #f8fafc; }
  .cp-skin > section:not(.cp-hero):nth-of-type(even) { background: #ffffff; }

  .cp-skin > section:not(.cp-hero) h2 {
    font-weight: 900;
    letter-spacing: -0.035em;
    line-height: 1.15;
    color: #09172e;
    margin-top: 0;
  }

  .cp-skin > section:not(.cp-hero) h2.text-3xl,
  .cp-skin > section:not(.cp-hero) h2.text-2xl { font-size: clamp(1.9rem, 3.6vw, 2.6rem); }

  .cp-skin > section:not(.cp-hero) h3 { color: #0f172a; letter-spacing: -0.01em; }

  .cp-skin .card {
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    background: #ffffff;
  }

  .cp-skin .card-hover { transition: all 0.2s ease; }

  .cp-skin .card-hover:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
  }

  .cp-skin .chip,
  .cp-skin .chip-tint {
    border-radius: 9999px;
    border: 1px solid #dbeafe;
    background: #ffffff;
    color: #1e40af;
    font-weight: 700;
    font-size: 12.5px;
    padding: 5px 14px;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.03);
  }

  .cp-skin .project-tile {
    border: 1px solid #cbd5e1;
    border-radius: 20px;
    padding: 26px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    display: flex;
    flex-direction: column;
    transition: all 0.2s ease;
  }

  .cp-skin .project-tile:hover {
    border-color: #94a3b8;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
  }

  .cp-skin .acc-item {
    border: 1px solid #cbd5e1;
    border-radius: 18px;
    background: #ffffff;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.03);
    overflow: hidden;
  }

  .cp-skin .btn-wa,
  .cp-skin .btn-secondary,
  .cp-skin .btn-primary {
    border-radius: 9999px;
    font-weight: 700;
    font-size: 14.5px;
    padding: 11px 24px;
    text-decoration: none;
    transition: all 0.2s ease;
  }

  .cp-skin .btn-wa {
    background: #ffffff;
    color: #16a34a;
    border: 1px solid #25d366;
    box-shadow: 0 4px 12px rgba(37, 211, 102, 0.15);
  }

  .cp-skin .btn-wa:hover {
    background: #f0fdf4;
    transform: translateY(-1px);
  }

  .cp-skin .btn-secondary {
    background: #ffffff;
    color: #0f172a;
    border: 1px solid #cbd5e1;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
  }

  .cp-skin .btn-secondary:hover {
    border-color: #94a3b8;
    background: #f8fafc;
    transform: translateY(-1px);
  }

  .cp-skin .btn-primary {
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    color: #ffffff;
    border: 0;
    box-shadow: 0 4px 14px rgba(37, 99, 235, 0.35);
  }

  .cp-skin .btn-primary:hover {
    background: linear-gradient(135deg, #1e40af 0%, #1d4ed8 100%);
    transform: translateY(-1px);
  }

  .cp-skin .terminal {
    border-radius: 18px;
    box-shadow: 0 16px 36px -8px rgba(0, 0, 0, 0.35);
  }

  /* Phase / module cards that carry a full topic body (DSA pages) */
  .cp-mod-extra.cp-dsa-body {
    display: block;
    margin-top: 10px;
    padding-top: 10px;
    border-top: 1px dashed #cbd5e1;
  }

  .cp-mod-extra.cp-dsa-body[hidden] { display: none; }

  .cp-dsa-body .acc-body { padding: 0; }

  .cp-dsa-body h4 {
    font-size: 11px;
    font-weight: 850;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: #0f172a;
    margin: 10px 0 8px 0;
  }

  .cp-dsa-body ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    gap: 6px;
    font-size: 12.5px;
    font-weight: 600;
    color: #334155;
    line-height: 1.45;
  }

  .cp-dsa-body .grid { display: flex; flex-direction: column; gap: 10px; }
  .cp-dsa-body code { display: inline; white-space: normal; word-break: normal; overflow-wrap: anywhere; font-size: 11.5px; background: #eef2ff; border-radius: 4px; padding: 1px 5px; }
  .cp-dsa-body > div > div:last-child,
  .cp-dsa-body .acc-body > div:last-child { font-size: 12.5px; }

  @media (max-width: 767px) {
    .cp-skin > section:not(.cp-hero) { padding-top: 56px; padding-bottom: 60px; }
  }
</style>
<main id="main" class="cp-page">

  <section class="cp-hero">
  <div class="cp-grid-overlay" aria-hidden="true"></div>
  <div class="cp-container cp-hero-inner">
    <nav aria-label="Breadcrumb" class="cp-crumb-wrap">
        <ol class="cp-crumb">
          <li><a class="cp-crumb-link" href="<?= cmsu('course-java-programming.java-programming.01', '../index.php') ?>"><?= cms('course-java-programming.java-programming.02', 'Home') ?></a></li>
          <li class="cp-crumb-sep" aria-hidden="true">/</li>
          <li><a class="cp-crumb-link" href="<?= cmsu('course-java-programming.java-programming.03', '../courses.php') ?>"><?= cms('course-java-programming.java-programming.04', 'Courses') ?></a></li>
          <li class="cp-crumb-sep" aria-hidden="true">/</li>
          <li class="cp-crumb-cur" aria-current="page"><?= cms('course-java-programming.java-programming.05', 'Java Programming') ?></li>
        </ol>
      </nav>
    <div class="cp-hero-row">
      <div class="cp-hero-left">
        <div class="cp-top-badges cp-wrap">
          <span class="cp-badge-level"><span class="cp-dot"></span><?= cms('course-java-programming.java-programming.06', 'Programming') ?></span>
          <span class="cp-badge-soft"><?= cms('course-java-programming.java-programming.07', 'Offline classroom training') ?></span>
          <?php include __DIR__ . '/../includes/google-rating-badge.php'; ?>
          <span class="cp-fast-track">FAST-TRACK INTO THE FUTURE! 🚀</span>
        </div>
        <h1 class="cp-hero-title"><?= cms('course-java-programming.java-programming.08', 'Java Programming') ?></h1>
          <p class="cp-hero-sub"><?= cms('course-java-programming.hero-extra.sub', 'Master Java, OOP & Core Programming Concepts') ?></p>
        <p class="cp-hero-desc"><?= cms('course-java-programming.java-programming.09', 'Master Java foundations — OOP, interfaces, exceptions, GUI and algorithms.') ?></p>
          <div class="cp-tag-row"><span class="cp-tag-pill"><?= cms('course-java-programming.hero-extra.tag-01', 'OOP in Java') ?></span><span class="cp-tag-pill"><?= cms('course-java-programming.hero-extra.tag-02', 'Inheritance & Interfaces') ?></span><span class="cp-tag-pill"><?= cms('course-java-programming.hero-extra.tag-03', 'Exception Handling') ?></span><span class="cp-tag-pill"><?= cms('course-java-programming.hero-extra.tag-04', 'GUI with AWT') ?></span><span class="cp-tag-pill"><?= cms('course-java-programming.hero-extra.tag-05', 'File Handling') ?></span><span class="cp-tag-pill"><?= cms('course-java-programming.hero-extra.tag-06', 'Sorting Algorithms') ?></span></div>
        <div class="cp-hero-actions ch-actions">
          <a class="ch-btn ch-btn-primary" href="<?= cmsu('course-java-programming.hero-cta.enroll-url', '../contact.php') ?>"><?= cms('course-java-programming.hero-cta.enroll', 'Enroll Now') ?><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M5 12h14"/><path d="m13 6 6 6-6 6"/></svg></a>
          <a class="ch-btn ch-btn-ghost" href="#curriculum"><?= cms('course-java-programming.hero-cta.curriculum', 'View Curriculum') ?></a>
          <a class="ch-btn ch-btn-syllabus" href="#syllabus-container" onclick="return window.chViewSyllabus ? chViewSyllabus(event) : true;"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><path d="M14 2v6h6"/><path d="M8 13h8"/><path d="M8 17h5"/></svg><?= cms('course-java-programming.hero-cta.syllabus', 'View Full Syllabus') ?></a>
          <a class="ch-btn ch-btn-wa" data-wa data-wa-text="Hello Chedo Tech, I am interested in the Java Programming course. Please share the syllabus, fees and batch details." href="<?= cmsu('course-java-programming.hero-cta.whatsapp-url', '../contact.php') ?>"><svg viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg><?= cms('course-java-programming.hero-cta.whatsapp', 'Enquire on WhatsApp') ?></a>
        </div>
        <p class="cp-hero-notice"><?= cms('course-java-programming.java-programming.13', 'Ask us for current batch schedules and details.') ?></p>
      </div>
      <div class="cp-hero-right">
        <div class="cp-hero-image-wrap">
          <figure class="ch-frame" style="--ch-a:#c2410c;--ch-b:#fbbf24">
            <div class="ch-window">
              <div class="ch-media">
                <img src="../assets/images/courses/java-programming-hero.webp?v=20261023" alt="Java Programming Course in Pune — Chedo Tech" class="ch-img" width="1280" height="720" loading="eager" fetchpriority="high" decoding="async">
              </div>
            </div>
          </figure>
        </div>
      </div>
    </div>
    <div class="cp-strip cp-strip-4">
        <div class="cp-strip-card"><span class="cp-strip-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                  <svg aria-hidden="true" focusable="false"
                    class="h-[18px] w-[18px]"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M14 21v-3a2 2 0 0 0-4 0v3" />
                    <path d="M18 4.933V21" />
                    <path d="m4 6 7.106-3.79a2 2 0 0 1 1.788 0L20 6" />
                    <path d="m6 11-3.52 2.147a1 1 0 0 0-.48.854V19a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-5a1 1 0 0 0-.48-.853L18 11" />
                    <path d="M6 4.933V21" />
                    <circle cx="12" cy="9" r="2" />
                  </svg>
                </span><div><span class="cp-strip-label"><?= cms('course-java-programming.java-programming.14', 'Format') ?></span><span class="cp-strip-value"><?= cms('course-java-programming.java-programming.15', 'Offline, in-person classes') ?></span></div></div>
        <div class="cp-strip-card"><span class="cp-strip-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                  <svg aria-hidden="true" focusable="false"
                    class="h-[18px] w-[18px]"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                    <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                    <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                    <circle cx="9" cy="7" r="4" />
                  </svg>
                </span><div><span class="cp-strip-label"><?= cms('course-java-programming.java-programming.16', 'Who it\'s for') ?></span><span class="cp-strip-value"><?= cms('course-java-programming.java-programming.17', 'Absolute beginners to aspiring developers') ?></span></div></div>
        <div class="cp-strip-card"><span class="cp-strip-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                  <svg aria-hidden="true" focusable="false"
                    class="h-[18px] w-[18px]"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <circle cx="12" cy="12" r="6" />
                    <circle cx="12" cy="12" r="2" />
                  </svg>
                </span><div><span class="cp-strip-label"><?= cms('course-java-programming.java-programming.18', 'Method') ?></span><span class="cp-strip-value"><?= cms('course-java-programming.java-programming.19', 'Live coding, whiteboard teaching, hands-on practice') ?></span></div></div>
        <div class="cp-strip-card"><span class="cp-strip-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                  <svg aria-hidden="true" focusable="false"
                    class="h-[18px] w-[18px]"
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M4 22V4a1 1 0 0 1 .4-.8A6 6 0 0 1 8 2c3 0 5 2 7.333 2q2 0 3.067-.8A1 1 0 0 1 20 4v10a1 1 0 0 1-.4.8A6 6 0 0 1 16 16c-3 0-5-2-8-2a6 6 0 0 0-4 1.528" />
                  </svg>
                </span><div><span class="cp-strip-label"><?= cms('course-java-programming.java-programming.20', 'Progress') ?></span><span class="cp-strip-value"><?= cms('course-java-programming.java-programming.21', 'Assignments, coding tests & project checkpoints') ?></span></div></div>
    </div>
  </div>
</section>

<section class="cp-about">
    <div class="cp-container cp-about-grid">
      <div>
        <h2 class="cp-sub-title"><?= cms('course-java-programming.about-this-course.01', 'About This Course') ?></h2>
        <div class="cp-about-text">
          <p class="cp-about-p"><?= cms('course-java-programming.about-this-course.02', 'Java is one of the most widely used languages in the world, and this course builds its foundations properly: syntax, operators, control flow, strings, methods, constructors and static features first — then the OOP core of Java: inheritance, abstraction, polymorphism, interfaces, packages and access control.') ?></p>
          <p class="cp-about-p"><?= cms('course-java-programming.about-this-course.03', 'You also get exception handling, GUI programming with Applets and AWT (including event handling), file handling and sorting algorithms — taught offline with live coding and practice programs at every step.') ?></p>
        </div>
      </div>
      <div>
        <h2 class="cp-sub-title"><?= cms('course-java-programming.about-this-course.04', 'Why It Matters') ?></h2>
        <ul class="cp-why-grid">
          <li class="cp-why-card">
            <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M20 6 9 17l-5-5" />
              </svg>
            </span>
            <div>
              <h3 class="cp-why-title"><?= cms('course-java-programming.about-this-course.05', 'Deep OOP practice') ?></h3>
              <p class="cp-why-desc"><?= cms('course-java-programming.about-this-course.06', 'Inheritance, abstraction, polymorphism, interfaces and packages — Java\'s OOP model in full.') ?></p>
            </div>
          </li>
          <li class="cp-why-card">
            <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M20 6 9 17l-5-5" />
              </svg>
            </span>
            <div>
              <h3 class="cp-why-title"><?= cms('course-java-programming.about-this-course.07', 'Industry-standard language') ?></h3>
              <p class="cp-why-desc"><?= cms('course-java-programming.about-this-course.08', 'Java powers enterprise backends, Android and large-scale systems.') ?></p>
            </div>
          </li>
          <li class="cp-why-card">
            <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M20 6 9 17l-5-5" />
              </svg>
            </span>
            <div>
              <h3 class="cp-why-title"><?= cms('course-java-programming.about-this-course.09', 'Clean, strict language') ?></h3>
              <p class="cp-why-desc"><?= cms('course-java-programming.about-this-course.10', 'Type safety and strong structure make Java an excellent language for building discipline.') ?></p>
            </div>
          </li>
          <li class="cp-why-card">
            <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M20 6 9 17l-5-5" />
              </svg>
            </span>
            <div>
              <h3 class="cp-why-title"><?= cms('course-java-programming.about-this-course.11', 'Path to full stack') ?></h3>
              <p class="cp-why-desc"><?= cms('course-java-programming.about-this-course.12', 'This course is the direct foundation for our Java Full Stack Development program.') ?></p>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </section>


  <section class="cp-curriculum" id="curriculum">
  <div class="cp-grid-overlay" aria-hidden="true"></div>
    <div class="cp-container cp-container-wide">

      <div class="cp-sec-head">
        <h2 class="cp-section-title"><?= cms('course-java-programming.what-you-will-learn.01', 'What You Will Learn') ?></h2>
        <p class="cp-section-desc"><?= cms('course-java-programming.what-you-will-learn.02', 'The full course structure — every module, every topic, taught live and offline.') ?></p>
      </div>

      <?php $syl = course_syllabus('java-programming'); ?>
<?php
$cpTopic = function ($t) { $d = trim($t['description'] ?? ''); return '<strong>' . course_e($t['title'] ?? '') . '</strong>' . ($d !== '' ? '<small>' . course_e($t['description'] ?? '') . '</small>' : ''); };
$cpVisual = fn ($title, $idx = 0) => ['img', course_module_art($title, $idx)];
    ?>
    <div class="cp-mod-grid">
      <?php foreach ($syl['modules'] as $i => $m):
        $cpN = $i + 1;
        $cpTopics = $m['topics'] ?? [];
        $cpVisible = array_slice($cpTopics, 0, 4);
        $cpMore = array_slice($cpTopics, 4);
      ?>
      <div class="cp-mod-slot">
      <div class="cp-mod cp-th-<?= ($cpN - 1) % 6 ?>">
        <div class="cp-mod-body">
         <div class="cp-mod-main">
          <div class="cp-mod-meta">
            <span class="cp-mod-badge">MOD <?= sprintf('%02d', $cpN) ?></span>
            <span class="cp-mod-count"><?= count($cpTopics) ?> TOPICS</span>
          </div>
          <h3 class="cp-mod-title"><?= course_e($m['title'] ?? '') ?></h3>
          <?php if (trim($m['description'] ?? '') !== ''): ?><p class="cp-mod-desc"><?= course_e($m['description'] ?? '') ?></p><?php endif; ?>
          <ul class="cp-mod-topics">
            <?php foreach ($cpVisible as $t): ?><li><span><?= $cpTopic($t) ?></span></li><?php endforeach; ?>
          </ul>
          <?php if (!empty($cpMore)): ?>
          <ul class="cp-mod-extra" hidden>
            <?php foreach ($cpMore as $t): ?><li><span><?= $cpTopic($t) ?></span></li><?php endforeach; ?>
          </ul>
          <button type="button" class="cp-mod-toggle" aria-expanded="false" data-more="+ View <?= count($cpMore) ?> more topics" data-less="– View less" onclick="cpToggleTopics(this)">
            <span class="cp-tg-text">+ View <?= count($cpMore) ?> more topics</span><span class="cp-chev" aria-hidden="true">▾</span>
          </button>
          <?php endif; ?>
         </div>
         <?php [$cpKind, $cpFile] = $cpVisual($m['title'] ?? '', $cpN - 1); ?>
         <div class="cp-mod-side">
           <div class="cp-mod-tile">
             <img src="../assets/images/modules/<?= $cpFile ?>" class="is-art" alt="" width="80" height="80" loading="lazy" aria-hidden="true">
           </div>
         </div>
        </div>
        <div class="cp-mod-strip"><b># Module <?= $cpN ?></b><em>100% PRACTICAL</em></div>
      </div>
      </div>
      <?php endforeach; ?>
    </div>
    </div>
  </section>


  <section class="cp-skills">
    <div class="cp-container">
      <div class="cp-sec-head"><h2 class="cp-section-title"><?= cms('course-java-programming.skills-you-will-gain.01', 'Skills You Will Gain') ?></h2></div>
    <div class="cp-skills-grid cp-skills-auto"><span class="cp-skill-pill"><?= cms('course-java-programming.skills-you-will-gain.02', 'OOP in Java') ?></span><span class="cp-skill-pill"><?= cms('course-java-programming.skills-you-will-gain.03', 'Inheritance & Interfaces') ?></span><span class="cp-skill-pill"><?= cms('course-java-programming.skills-you-will-gain.04', 'Exception Handling') ?></span><span class="cp-skill-pill"><?= cms('course-java-programming.skills-you-will-gain.05', 'Static & Instance Members') ?></span><span class="cp-skill-pill"><?= cms('course-java-programming.skills-you-will-gain.06', 'GUI with AWT') ?></span><span class="cp-skill-pill"><?= cms('course-java-programming.skills-you-will-gain.07', 'File Handling') ?></span><span class="cp-skill-pill"><?= cms('course-java-programming.skills-you-will-gain.08', 'Sorting Algorithms') ?></span></div>
    </div>
  </section>

  <section class="cp-portfolio">
    <div class="cp-container">
      <div class="cp-sec-head"><h2 class="cp-section-title"><?= cms('course-java-programming.projects-you-will-build.01', 'Projects You Will Build') ?></h2>
    <p class="cp-section-desc"><?= cms('course-java-programming.projects-you-will-build.02', 'Course projects are the point — working software you finish, run and keep.') ?></p></div>
      <div class="cp-portfolio-grid"><?php foreach ($syl['projects'] as $i => $m): ?>
      <div class="cp-proj-card">
        <div>
          <span class="cp-proj-icon"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-5 w-5"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M20 20a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-7.9a2 2 0 0 1-1.69-.9L9.6 3.9A2 2 0 0 0 7.93 3H4a2 2 0 0 0-2 2v13a2 2 0 0 0 2 2Z" />
            </svg>
          </span>
          <h3 class="cp-proj-title"><?= course_e($m['title'] ?? '') ?></h3>
          <p class="cp-proj-desc"><?= course_e($m['description'] ?? '') ?></p>
        </div>
        <div class="cp-proj-footer">
          <span class="cp-proj-num">Portfolio Project #<?= sprintf('%02d', $i + 1) ?></span>
          <span class="cp-proj-link">100% Practical ➔</span>
        </div>
      </div><?php endforeach; ?></div>
    </div>
  </section>

  <section class="cp-learn">
    <div class="cp-container">

      <div class="cp-learn-grid">
        <div>
          <h2 class="cp-sub-title"><?= cms('course-java-programming.how-you-learn-here.01', 'How You Learn Here') ?></h2>
          <p class="cp-about-p cp-mt"><?= cms('course-java-programming.how-you-learn-here.02', 'Every course at Chedo Tech follows the same practical, offline method — no screen-sharing, real learning:') ?></p>
          <ul class="cp-why-grid">
            <li class="cp-why-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg>
              </span>
              <div>
                <h3 class="cp-why-title"><?= cms('course-java-programming.how-you-learn-here.03', 'Offline Classroom Training') ?></h3>
                <p class="cp-why-desc"><?= cms('course-java-programming.how-you-learn-here.04', 'Learn in person at the center — no screen-sharing, real interaction.') ?></p>
              </div>
            </li>
            <li class="cp-why-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg>
              </span>
              <div>
                <h3 class="cp-why-title"><?= cms('course-java-programming.how-you-learn-here.05', 'Whiteboard Teaching') ?></h3>
                <p class="cp-why-desc"><?= cms('course-java-programming.how-you-learn-here.06', 'Concepts are drawn, explained and discussed before they are coded.') ?></p>
              </div>
            </li>
            <li class="cp-why-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg>
              </span>
              <div>
                <h3 class="cp-why-title"><?= cms('course-java-programming.how-you-learn-here.07', 'Live Coding') ?></h3>
                <p class="cp-why-desc"><?= cms('course-java-programming.how-you-learn-here.08', 'Code is written live in class, so you see how programs are actually built.') ?></p>
              </div>
            </li>
            <li class="cp-why-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg>
              </span>
              <div>
                <h3 class="cp-why-title"><?= cms('course-java-programming.how-you-learn-here.09', 'Hands-On Practice') ?></h3>
                <p class="cp-why-desc"><?= cms('course-java-programming.how-you-learn-here.10', 'You type, run and break code yourself — every session.') ?></p>
              </div>
            </li>
            <li class="cp-why-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg>
              </span>
              <div>
                <h3 class="cp-why-title"><?= cms('course-java-programming.how-you-learn-here.11', 'Assignments & Practice Sets') ?></h3>
                <p class="cp-why-desc"><?= cms('course-java-programming.how-you-learn-here.12', 'Structured work between classes keeps progress measurable.') ?></p>
              </div>
            </li>
            <li class="cp-why-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg>
              </span>
              <div>
                <h3 class="cp-why-title"><?= cms('course-java-programming.how-you-learn-here.13', 'Problem Solving') ?></h3>
                <p class="cp-why-desc"><?= cms('course-java-programming.how-you-learn-here.14', 'Logic problems and coding challenges build real thinking skills.') ?></p>
              </div>
            </li>
            <li class="cp-why-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg>
              </span>
              <div>
                <h3 class="cp-why-title"><?= cms('course-java-programming.how-you-learn-here.15', 'Project Building') ?></h3>
                <p class="cp-why-desc"><?= cms('course-java-programming.how-you-learn-here.16', 'Every course includes projects that turn topics into working software.') ?></p>
              </div>
            </li>
            <li class="cp-why-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M20 6 9 17l-5-5" />
                </svg>
              </span>
              <div>
                <h3 class="cp-why-title"><?= cms('course-java-programming.how-you-learn-here.17', 'In-Person Support') ?></h3>
                <p class="cp-why-desc"><?= cms('course-java-programming.how-you-learn-here.18', 'Doubts cleared instantly in offline classes, with personal guidance.') ?></p>
              </div>
            </li>
          </ul>
        </div>
        <div class="cp-learn-side">
          <div class="terminal">
            <div class="terminal-bar">
              <span class="win-dot bg-red-400"></span><span class="win-dot bg-amber-400"></span><span class="win-dot bg-emerald-400"></span>
              <span class="ml-2 font-mono text-[11px] text-slate-500"><?= cms('course-java-programming.how-you-learn-here.19', 'chedo-class@institute: ~/practice') ?></span>
            </div>
            <div class="terminal-body">
              <pre><span class="term-prompt">$</span> <span class="text-slate-200">write code with the instructor</span>
<span class="term-ok">✓</span> <span class="term-dim">understand — whiteboard first</span>
<span class="term-ok">✓</span> <span class="term-dim">practice — hands-on, in class</span>
<span class="term-ok">✓</span> <span class="term-dim">build — projects, not just notes</span>
<span class="term-ok">✓</span> <span class="term-dim">support — doubts solved in person</span>
<span class="term-prompt">$</span> <span class="text-slate-200">next milestone</span><span class="term-cursor"></span></pre>
            </div>
          </div>
          <div class="cp-mini-grid">
            <div class="cp-mini-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-5 w-5"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
                  <path d="M16 3.128a4 4 0 0 1 0 7.744" />
                  <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
                  <circle cx="9" cy="7" r="4" />
                </svg>
              </span>
              <p class="cp-mini-title"><?= cms('course-java-programming.how-you-learn-here.20', 'Small Classes') ?></p>
              <p class="cp-mini-desc"><?= cms('course-java-programming.how-you-learn-here.21', 'Personal attention in every session.') ?></p>
            </div>
            <div class="cp-mini-card">
              <span class="cp-why-icon"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="h-5 w-5"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <circle cx="12" cy="12" r="10" />
                  <circle cx="12" cy="12" r="6" />
                  <circle cx="12" cy="12" r="2" />
                </svg>
              </span>
              <p class="cp-mini-title"><?= cms('course-java-programming.how-you-learn-here.22', 'Milestones') ?></p>
              <p class="cp-mini-desc"><?= cms('course-java-programming.how-you-learn-here.23', 'Assignments, tests & project checkpoints.') ?></p>
            </div>
          </div>
        </div>
      </div>

    </div>
  </section>


  <section class="cp-related">
    <div class="cp-container">
      <div class="cp-related-header">
        <div>
          <h2 class="cp-section-title"><?= cms('course-java-programming.related-courses.01', 'Related Courses') ?></h2>
        </div>
        <a class="cp-related-link" href="<?= cmsu('course-java-programming.related-courses.02', '../courses.php') ?>"><?= cms('course-java-programming.related-courses.03', 'View all courses') ?> <span class="cp-arrow"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="cp-arrow-svg"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M5 12h14" />
              <path d="m12 5 7 7-7 7" />
            </svg>
          </span></a>
      </div>
      <div class="cp-related-grid">
        <article class="cp-related-card">
          <div class="cp-related-img">
            <img src="../assets/images/courses/C++ Programming.webp" alt="C++ Programming" class="cp-related-img-el">
          </div>
          <div class="cp-related-body">
            <h3 class="cp-related-title"><?= cms('course-java-programming.related-courses.04', 'C++ Programming') ?></h3>
            <p class="cp-related-desc"><?= cms('course-java-programming.related-courses.05', 'Fundamentals, OOP with classes & objects, inheritance, polymorphism. Functions, templates, STL. Pointers, references, exception handling. File I/O, memory management.') ?></p>
            <a class="cp-related-more" href="<?= cmsu('course-java-programming.related-courses.06', '../courses/cpp-programming.php') ?>"><?= cms('course-java-programming.related-courses.07', 'Explore Course') ?> <span class="cp-arrow"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="cp-arrow-svg"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span></a>
          </div>
        </article>
        <article class="cp-related-card">
          <div class="cp-related-img">
            <img src="../assets/images/courses/Java Full Stack Development.webp" alt="Java Full Stack Development" class="cp-related-img-el">
          </div>
          <div class="cp-related-body">
            <h3 class="cp-related-title"><?= cms('course-java-programming.related-courses.08', 'Java Full Stack Development') ?></h3>
            <p class="cp-related-desc"><?= cms('course-java-programming.related-courses.09', 'Complete Java backend and frontend development including Core Java, Spring Boot, JSP, Servlets, JDBC, MySQL and REST APIs.') ?></p>
            <a class="cp-related-more" href="<?= cmsu('course-java-programming.related-courses.10', '../courses/java-full-stack.php') ?>"><?= cms('course-java-programming.related-courses.11', 'Explore Course') ?> <span class="cp-arrow"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="cp-arrow-svg"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span></a>
          </div>
        </article>
        <article class="cp-related-card">
          <div class="cp-related-img">
            <img src="../assets/images/courses/Data Structures & Algorithms.webp" alt="Data Structures & Algorithms" class="cp-related-img-el">
          </div>
          <div class="cp-related-body">
            <h3 class="cp-related-title"><?= cms('course-java-programming.related-courses.12', 'Data Structures & Algorithms') ?></h3>
            <p class="cp-related-desc"><?= cms('course-java-programming.related-courses.13', 'Comprehensive DSA covering arrays, linked lists, stacks, queues, searching, sorting, trees, graphs and advanced topics like hashing and dynamic programming.') ?></p>
            <a class="cp-related-more" href="<?= cmsu('course-java-programming.related-courses.14', '../courses/data-structures-algorithms.php') ?>"><?= cms('course-java-programming.related-courses.15', 'Explore Course') ?> <span class="cp-arrow"><!-- @license lucide-static v1.28.0 - ISC -->
                <svg aria-hidden="true" focusable="false"
                  class="cp-arrow-svg"
                  xmlns="http://www.w3.org/2000/svg"
                  width="24"
                  height="24"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span></a>
          </div>
        </article>
      </div>
    </div>
  </section>


  <section class="cp-cta">
    <div class="cp-container cp-container-mid">
      <div class="cp-cta-card">
        <div>
          <h2 class="cp-cta-title"><?= cms('course-java-programming.interested-in-the-java.01', 'Interested in the Java Programming Course?') ?></h2>
          <p class="cp-cta-desc"><?= cms('course-java-programming.interested-in-the-java.02', 'Ask us for batch schedules, curriculum details and how to enroll. Personal guidance is part of the program.') ?></p>
          <div class="cp-cta-actions">
            <a class="cp-wa-btn" data-wa data-wa-text="Hello Chedo Tech, I am interested in the Java Programming course. Please share more information." href="<?= cmsu('course-java-programming.interested-in-the-java.03', '../contact.php') ?>"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-4 w-4"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
              </svg>
              <?= cms('course-java-programming.interested-in-the-java.04', 'Enquire on WhatsApp') ?></a>
            <a class="cp-btn-secondary" href="<?= cmsu('course-java-programming.interested-in-the-java.05', '../courses.php') ?>"><?= cms('course-java-programming.interested-in-the-java.06', 'See Other Courses') ?></a>
          </div>

        </div>
      </div>
    </div>
  </section>

<script>
  /* Module cards: one open at a time. An open card floats over its neighbours (its grid slot keeps the
     collapsed height), so nothing below it ever moves. */
  function cpCloseCard(card) {
    var extra = card.querySelector('.cp-mod-extra');
    var btn = card.querySelector('.cp-mod-toggle');
    if (extra) extra.hidden = true;
    if (btn) {
      btn.setAttribute('aria-expanded', 'false');
      btn.querySelector('.cp-tg-text').textContent = btn.getAttribute('data-more');
    }
    card.classList.remove('is-open');
    if (card.parentElement) card.parentElement.style.height = '';
  }

  function cpToggleTopics(btn) {
    var card = btn.closest('.cp-mod');
    var extra = card.querySelector('.cp-mod-extra');
    if (!extra) return;
    var willOpen = btn.getAttribute('aria-expanded') !== 'true';

    document.querySelectorAll('.cp-mod.is-open').forEach(function (c) {
      if (c !== card) cpCloseCard(c);
    });

    if (!willOpen) {
      cpCloseCard(card);
      return;
    }
    var slot = card.parentElement;
    slot.style.height = card.offsetHeight + 'px';
    extra.hidden = false;
    btn.setAttribute('aria-expanded', 'true');
    btn.querySelector('.cp-tg-text').textContent = btn.getAttribute('data-less');
    card.classList.add('is-open');
  }

  document.addEventListener('keydown', function (e) {
    if (e.key === 'Escape') {
      document.querySelectorAll('.cp-mod.is-open').forEach(cpCloseCard);
    }
  });
</script>
</main>

<?php include '../includes/footer.php'; ?>