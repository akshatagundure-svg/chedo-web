<?php
require_once __DIR__ . '/cms.php';
$page_title = $page_title ?? "Chedo Tech | Programming Institute in Pune";
$page_description = $page_description ?? "Chedo Tech is a programming institute & app development center in Pune offering offline, practical programming education since 2015 — C, Python, Java, Full Stack, Data Science, Mobile, UI/UX and Kids Programming.";
$page_canonical = $page_canonical ?? "https://chedo.in/";
$page_type = $page_type ?? "website";

// Title / description saved in the admin CMS (SEO tab) win over the defaults set by each page
$cms_seo = cms_seo(cms_page_key());
if (!empty($cms_seo['meta_title'])) {
  $page_title = $cms_seo['meta_title'];
}
if (!empty($cms_seo['meta_description'])) {
  $page_description = $cms_seo['meta_description'];
}

// Link-preview (WhatsApp / social share) image:
// admin CMS image > $page_image set by the page > thumbnail of the course page being shared > site default
$og_image = 'https://chedo.in/assets/images/og-image.png';
$og_course_thumbs = [
  'java-dsa'                      => 'Java + DSA Foundation.webp',
  'python-dsa'                    => 'Python + DSA Foundation.webp',
  'c-cpp-dsa'                     => 'C + C++ + DSA Foundation.webp',
  'c-programming'                 => 'C Programming.webp',
  'cpp-programming'               => 'C++ Programming.webp',
  'java-programming'              => 'Java Programming.webp',
  'python-programming'            => 'Python Programming.webp',
  'data-structures-algorithms'    => 'Data Structures & Algorithms.webp',
  'mern-full-stack'               => 'MERN Full Stack Development.webp',
  'java-full-stack'               => 'Java Full Stack Development.webp',
  'mobile-app-development'        => 'Mobile App Development (Flutter).webp',
  'data-science-foundation'       => 'Data Science Foundation.webp',
  'data-science'                  => 'Data Science.webp',
  'data-scientist'                => 'Data Scientist.webp',
  'ml-engineer'                   => 'ML Engineering.webp',
  'ai-engineer'                   => 'AI Engineering.webp',
  'gen-ai-engineer'               => 'Gen AI Engineering.webp',
  'agentic-ai-engineer'           => 'Agentic AI Engineering.webp',
  'data-engineer'                 => 'Data Engineering.webp',
  'ui-ux-design'                  => 'UI-UX-Design.webp',
  'kids-programming'              => 'Kids Programming.webp',
  'data-science-foundation-kids'  => 'Data Science Foundation For Kids.webp',
  'kids-programming-level-1'      => 'Kids Programming Level 1.webp',
  'kids-programming-level-2'      => 'Kids Programming Level 2.webp',
  'kids-programming-level-3'      => 'Kids Programming Level 3.webp',
  'kids-programming-level-4'      => 'Kids Programming Level 4.webp',
];
$og_script = $_SERVER['SCRIPT_NAME'] ?? '';
$og_slug = basename($og_script, '.php');
if (!empty($cms_seo['og_image'])) {
  $og_image = $cms_seo['og_image'];
} elseif (!empty($page_image)) {
  $og_image = $page_image;
} elseif (
  strpos($og_script, '/courses/') !== false && isset($og_course_thumbs[$og_slug])
  && is_file(__DIR__ . '/../assets/images/courses/' . $og_course_thumbs[$og_slug])
) {
  $og_image = 'https://chedo.in/assets/images/courses/' . rawurlencode($og_course_thumbs[$og_slug]);
}

// Navbar: work out which top-level item matches the current page
$nav_path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$nav_file = basename($nav_path);
$nav_ai_slugs = ['data-science.php', 'data-scientist.php', 'ml-engineer.php', 'ai-engineer.php', 'gen-ai-engineer.php', 'agentic-ai-engineer.php', 'data-engineer.php'];
$nav_in_courses_dir = strpos($nav_path, '/courses/') !== false;
$nav_is = [
  'home'    => ($nav_path === '/' || $nav_file === 'index.php'),
  'ai'      => ($nav_in_courses_dir && in_array($nav_file, $nav_ai_slugs, true)),
  'courses' => ($nav_file === 'courses.php' || $nav_file === 'course.php' || ($nav_in_courses_dir && !in_array($nav_file, $nav_ai_slugs, true))),
  'about'   => ($nav_file === 'about.php'),
  'contact' => ($nav_file === 'contact.php'),
];
$nav_cls = function ($key) use ($nav_is) {
  return $nav_is[$key] ? ' active' : '';
};
$nav_cur = function ($key) use ($nav_is) {
  return $nav_is[$key] ? ' aria-current="page"' : '';
};
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo htmlspecialchars($page_title); ?></title>
  <meta name="description" content="<?php echo htmlspecialchars($page_description); ?>">
  <link rel="canonical" href="<?php echo htmlspecialchars($page_canonical); ?>">
  <link rel="icon" type="image/png" href="/assets/logo-32.png">
  <link rel="apple-touch-icon" href="/assets/logo-180.png">
  <script>
    // Dark mode removed as per request
  </script>
  <meta property="og:type" content="<?php echo htmlspecialchars($page_type); ?>">
  <meta property="og:site_name" content="Chedo Tech">
  <meta property="og:title" content="<?php echo htmlspecialchars($page_title); ?>">
  <meta property="og:description" content="<?php echo htmlspecialchars($page_description); ?>">
  <meta property="og:url" content="<?php echo htmlspecialchars($page_canonical); ?>">
  <meta property="og:image" content="<?php echo htmlspecialchars($og_image); ?>">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?php echo htmlspecialchars($page_title); ?>">
  <meta name="twitter:description" content="<?php echo htmlspecialchars($page_description); ?>">
  <meta name="twitter:image" content="<?php echo htmlspecialchars($og_image); ?>">
  <link rel="preload" href="/assets/fonts/inter-latin.woff2" as="font" type="font/woff2" crossorigin>
  <?php if (!empty($nav_is['home'])): ?>
    <link rel="preload" as="image" href="/assets/images/laptop-400.webp" imagesrcset="/assets/images/laptop-400.webp 400w, /assets/images/laptop-800.webp 800w, /assets/images/laptop-1080.webp 1080w, /assets/images/laptop.webp 1485w" imagesizes="(max-width: 640px) 90vw, (max-width: 1024px) 50vw, 425px" fetchpriority="high">
  <?php elseif (!empty($page_hero_image)): ?>
    <link rel="preload" as="image" href="<?php echo htmlspecialchars($page_hero_image); ?>" fetchpriority="high">
  <?php endif; ?>
  <link rel="stylesheet" href="/assets/css/main.min.css?v=20261028b">
  <?php foreach (($page_extra_css ?? []) as $extra_css): ?>
    <link rel="stylesheet" href="<?php echo htmlspecialchars($extra_css); ?>">
  <?php endforeach; ?>
  <style>
    /* Floating WhatsApp button: always reachable, clear of notches / home bar */
    #wa-fab {
      right: max(1rem, env(safe-area-inset-right));
      bottom: max(1rem, env(safe-area-inset-bottom));
      z-index: 60;
    }

    #wa-fab::after {
      content: "";
      position: absolute;
      inset: 0;
      border-radius: 9999px;
      box-shadow: 0 0 0 0 rgba(37, 211, 102, .55);
      animation: wa-pulse 2.4s infinite;
      pointer-events: none;
    }

    @keyframes wa-pulse {
      to {
        box-shadow: 0 0 0 16px rgba(37, 211, 102, 0);
      }
    }

    @media (prefers-reduced-motion: reduce) {
      #wa-fab::after {
        animation: none;
      }
    }

    @media (max-width: 639px) {
      #wa-fab {
        width: 2rem;
        height: 2rem;
      }
    }

    /* Navbar: active state, Enquire Now button, mobile menu */
    .site-header .nav-link.active,
    .site-header .nav-link[aria-current="page"] {
      color: #1d4ed8 !important;
      background: #eff6ff;
    }

    .site-header #courses-drop-btn.active,
    .site-header #ai-data-drop-btn.active {
      color: #1d4ed8 !important;
      background: #eff6ff;
    }

    .nav-cta {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: .45rem;
      margin-left: 1rem;
      padding: .6rem 1.15rem;
      white-space: nowrap;
      border-radius: 9999px;
      font-size: 14.5px;
      font-weight: 700;
      line-height: 1;
      color: #fff;
      background: linear-gradient(135deg, #2563eb, #1d4ed8);
      box-shadow: 0 6px 16px -6px rgba(37, 99, 235, .55), inset 0 1px 0 rgba(255, 255, 255, .18);
      transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }

    .nav-cta svg {
      transition: transform .2s ease;
    }

    .nav-cta:hover {
      transform: translateY(-1px);
      background: linear-gradient(135deg, #1d4ed8, #1e40af);
      box-shadow: 0 10px 22px -8px rgba(37, 99, 235, .65), inset 0 1px 0 rgba(255, 255, 255, .18);
      color: #fff;
    }

    .nav-cta:hover svg {
      transform: translateX(3px);
    }

    .nav-cta:focus-visible {
      outline: 3px solid #93c5fd;
      outline-offset: 2px;
    }

    .nav-login {
      background: #fff;
      color: #1d4ed8;
      box-shadow: inset 0 0 0 1.5px #1d4ed8, 0 4px 6px -1px rgba(29, 78, 216, 0.1);
      margin-left: 0.5rem;
    }

    .nav-login:hover {
      background: #eff6ff;
      color: #1e40af;
      box-shadow: inset 0 0 0 1.5px #1e40af, 0 6px 12px -2px rgba(30, 64, 175, 0.15);
      transform: translateY(-1px);
    }

    .nav-cta-block {
      display: flex;
      width: 100%;
      margin: .75rem 0 .25rem;
      padding: .9rem 1rem;
      font-size: 15.5px;
    }

    .mob-link.active,
    .mob-link[aria-current="page"] {
      color: #1d4ed8;
      background: #eff6ff;
    }

    #mobile-menu nav {
      padding-bottom: 1.25rem;
    }

    #mobile-menu .mob-link {
      min-height: 48px;
    }

    #mobile-menu .mob-sub-link {
      padding-top: .6rem;
      padding-bottom: .6rem;
    }

    /* Mobile menu: opaque panel, scrolls inside the viewport */
    #mobile-menu {
      background: #ffffff !important;
      box-shadow: 0 12px 24px -8px rgba(15, 23, 42, .15);
      max-height: calc(100vh - 80px);
      max-height: calc(100dvh - 80px);
    }

    /* Mobile safety net: no sideways scroll, media never overflows */
    body {
      max-width: 100%;
      overflow-x: clip;
    }

    img,
    video,
    iframe,
    svg {
      max-width: 100%;
    }

    pre {
      overflow-x: auto;
    }

    /* Fix for clickable card areas extending beyond container */
    .card {
      position: relative;
    }

    /* 1. Fix navbar background: solid consistent color across entire width with no fade */
    .site-header {
      background-color: #ffffff !important;
      background: #ffffff !important;
      border-bottom: 1px solid #e2e8f0 !important;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.04), 0 1px 2px -1px rgba(0, 0, 0, 0.04) !important;
    }

    .site-header.is-scrolled {
      background-color: #ffffff !important;
      background: #ffffff !important;
      border-color: #e2e8f0 !important;
      box-shadow: 0 4px 20px -2px rgba(15, 23, 42, 0.08) !important;
    }

    @media (max-width: 640px) {
      .site-header>div {
        height: 64px !important;
      }
    }

    .site-header .nav-link {
      font-size: 15.5px !important;
      font-weight: 500 !important;
      padding: 0.55rem 0.95rem !important;
    }

    .site-header #courses-drop-btn,
    .site-header #ai-data-drop-btn {
      font-size: 15.5px !important;
    }

    /* 3. Fix Courses dropdown layout: shorter, wider, multi-column */
    #courses-drop .dropdown-panel {
      width: 49rem;
      max-width: calc(100vw - 2rem);
      max-height: calc(90vh - 80px);
      overflow-y: auto;
      overscroll-behavior: contain;
      scrollbar-width: thin;
      scrollbar-color: #cbd5e1 transparent;
      padding: 1rem 1.25rem 0.75rem 1.25rem;
    }

    #courses-drop .courses-dropdown-grid {
      display: grid;
      grid-template-columns: 1.2fr 1fr 1fr;
      gap: 1.25rem;
    }

    #courses-drop .dropdown-link {
      padding: 0.25rem 0.45rem;
      gap: 0.6rem;
    }

    #courses-drop .drop-head {
      padding-top: 0.15rem;
      padding-bottom: 0.25rem;
    }

    #courses-drop .drop-icon {
      width: 1.85rem;
      height: 1.85rem;
    }

    #courses-drop .dropdown-panel::-webkit-scrollbar {
      width: 5px;
    }

    #courses-drop .dropdown-panel::-webkit-scrollbar-track {
      background: transparent;
    }

    #courses-drop .dropdown-panel::-webkit-scrollbar-thumb {
      background-color: #cbd5e1;
      border-radius: 9999px;
    }

    #courses-drop .dropdown-panel::-webkit-scrollbar-thumb:hover {
      background-color: #94a3b8;
    }

    article.card {
      display: flex !important;
      flex-direction: column !important;
    }

    article.card:has(.card-img-wrap),
    article.card.\!p-0 {
      padding: 0 !important;
      overflow: hidden !important;
      border-radius: 1rem !important;
    }

    article.card.p-6 {
      padding: 1.5rem !important;
      border-radius: 1.25rem !important;
    }

    .card-img-wrap {
      width: 100% !important;
      margin: 0 !important;
      padding: 0 !important;
      overflow: hidden !important;
      line-height: 0 !important;
      display: block !important;
    }

    .card-img-wrap img {
      width: 100% !important;
      height: auto !important;
      aspect-ratio: 16 / 9 !important;
      object-fit: cover !important;
      display: block !important;
      margin: 0 !important;
      padding: 0 !important;
      border: 0 !important;
    }

    .card-body {
      padding: 0.65rem 0.75rem 0.75rem 0.75rem !important;
      display: flex !important;
      flex-direction: column !important;
    }

    article.card:has(.card-img-wrap) h3,
    article.card.\!p-0 h3 {
      margin-top: 0 !important;
      margin-bottom: 0.25rem !important;
      font-size: 0.85rem !important;
      font-weight: 700 !important;
      line-height: 1.25 !important;
    }

    article.card.p-6 h3 {
      margin-top: 0.75rem !important;
      font-size: 1.1rem !important;
      font-weight: 700 !important;
    }

    article.card .tag-wrap {
      display: flex !important;
      flex-wrap: wrap !important;
      gap: 0.25rem !important;
      margin-top: 0 !important;
      margin-bottom: 0.4rem !important;
      align-content: flex-start !important;
    }

    article.card .arrow-link {
      margin-top: 0 !important;
      padding-top: 0 !important;
      font-size: 11px !important;
      font-weight: 600 !important;
      gap: 0.25rem !important;
    }

    #group-programming .arrow-link,
    #group-development .arrow-link,
    #group-data-ai .arrow-link,
    #group-design .arrow-link,
    #group-kids .arrow-link {
      margin-top: 0 !important;
      padding-top: 0 !important;
      font-size: 9.5px !important;
      font-weight: 600 !important;
      gap: 0.2rem !important;
    }

    article.card .arrow-link svg,
    article.card .arrow-link .arrow svg {
      width: 12px !important;
      height: 12px !important;
    }

    #group-programming .arrow-link svg,
    #group-programming .arrow-link .arrow svg,
    #group-development .arrow-link svg,
    #group-development .arrow-link .arrow svg,
    #group-data-ai .arrow-link svg,
    #group-data-ai .arrow-link .arrow svg,
    #group-design .arrow-link svg,
    #group-design .arrow-link .arrow svg,
    #group-kids .arrow-link svg,
    #group-kids .arrow-link .arrow svg {
      width: 10px !important;
      height: 10px !important;
    }

    /* --- Skills That Build Careers (home-courses.php) Hover Effect --- */
    .skills-grid article,
    .j-card,
    .bento-cell,
    ul.mt-8.grid>li,
    ul.grid-cols-2.gap-5>li.card,
    .mt-9.flex>.flex>.card,
    .kids-programming-image-grid>a,
    .kids-programming-subgrid>a,
    a.card.card-hover,
    ol.mt-12.grid>li.card,
    div.mt-7>span.rounded-2xl,
    .lg\:col-span-5 .grid.gap-4>.card,
    .lg\:col-span-4>.card,
    a.border-\[\#25D366\],
    .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-4.lg\:grid-cols-7>div,
    #curriculum .border.border-slate-200.rounded-xl.bg-white,
    .grid.gap-6.sm\:grid-cols-2.lg\:grid-cols-3>div.border-slate-200,
    .grid.gap-3.sm\:grid-cols-4.lg\:grid-cols-6>div.border-slate-200,
    .grid.gap-6.sm\:grid-cols-2.lg\:grid-cols-4>div.border-slate-200,
    .grid.gap-3.grid-cols-2>div.border-slate-200,
    .grid.gap-6.sm\:grid-cols-2.md\:grid-cols-4>div.border-slate-200,
    .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-3.lg\:grid-cols-4.xl\:grid-cols-7>div,
    .grid.gap-8.md\:grid-cols-2.lg\:grid-cols-3>div.border-slate-200,
    .grid.gap-6.md\:grid-cols-2.lg\:grid-cols-3.xl\:grid-cols-4>div.relative,
    .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-3.lg\:grid-cols-4.xl\:grid-cols-6>div,
    ul.mt-6.grid.gap-3.sm\:grid-cols-2>li,
    .grid.gap-4.sm\:grid-cols-2.lg\:grid-cols-6>div,
    span.chip,
    ol.mt-10.grid.gap-5.md\:grid-cols-3>li.card,
    .mt-10.grid.gap-5.md\:grid-cols-2.lg\:grid-cols-3>article.card,
    .mt-8.grid.gap-5.md\:grid-cols-2.lg\:grid-cols-4>article.card,
    .mt-10.grid.gap-5.md\:grid-cols-2>article.card,
    .mt-8.grid.gap-5.sm\:grid-cols-2.lg\:grid-cols-4>div.card,
    .mt-10.grid.gap-4.sm\:grid-cols-2>div.card,
    .grid.grid-cols-2.gap-4>div.card,
    .mt-8.max-w-md>article.card,
    #curriculum .acc-item {
      cursor: pointer;
      transform: translateY(0) scale(1);
      transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease, background-color 0.3s ease;
      will-change: transform, box-shadow, border-color;
    }

    /* Ensure images have rounded corners to match the inset shadow */
    .kids-programming-image-grid>a,
    .kids-programming-subgrid>a {
      border-radius: 16px;
      overflow: hidden;
      border: 1px solid transparent;
    }

    @media (hover: hover) and (pointer: fine) {

      .skills-grid article:hover,
      .j-card:hover,
      .bento-cell:hover,
      ul.mt-8.grid>li:hover,
      ul.grid-cols-2.gap-5>li.card:hover,
      .mt-9.flex>.flex>.card:hover,
      .kids-programming-image-grid>a:hover,
      .kids-programming-subgrid>a:hover,
      a.card.card-hover:hover,
      ol.mt-12.grid>li.card:hover,
      div.mt-7>span.rounded-2xl:hover,
      .lg\:col-span-5 .grid.gap-4>.card:hover,
      .lg\:col-span-4>.card:hover,
      a.border-\[\#25D366\]:hover,
      .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-4.lg\:grid-cols-7>div:hover,
      #curriculum .border.border-slate-200.rounded-xl.bg-white:hover,
      .grid.gap-6.sm\:grid-cols-2.lg\:grid-cols-3>div.border-slate-200:hover,
      .grid.gap-3.sm\:grid-cols-4.lg\:grid-cols-6>div.border-slate-200:hover,
      .grid.gap-6.sm\:grid-cols-2.lg\:grid-cols-4>div.border-slate-200:hover,
      .grid.gap-3.grid-cols-2>div.border-slate-200:hover,
      .grid.gap-6.sm\:grid-cols-2.md\:grid-cols-4>div.border-slate-200:hover,
      .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-3.lg\:grid-cols-4.xl\:grid-cols-7>div:hover,
      .grid.gap-8.md\:grid-cols-2.lg\:grid-cols-3>div.border-slate-200:hover,
      .grid.gap-6.md\:grid-cols-2.lg\:grid-cols-3.xl\:grid-cols-4>div.relative:hover,
      .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-3.lg\:grid-cols-4.xl\:grid-cols-6>div:hover,
      ul.mt-6.grid.gap-3.sm\:grid-cols-2>li:hover,
      .grid.gap-4.sm\:grid-cols-2.lg\:grid-cols-6>div:hover,
      span.chip:hover,
      ol.mt-10.grid.gap-5.md\:grid-cols-3>li.card:hover,
      .mt-10.grid.gap-5.md\:grid-cols-2.lg\:grid-cols-3>article.card:hover,
      .mt-8.grid.gap-5.md\:grid-cols-2.lg\:grid-cols-4>article.card:hover,
      .mt-10.grid.gap-5.md\:grid-cols-2>article.card:hover,
      .mt-8.grid.gap-5.sm\:grid-cols-2.lg\:grid-cols-4>div.card:hover,
      .mt-10.grid.gap-4.sm\:grid-cols-2>div.card:hover,
      .grid.grid-cols-2.gap-4>div.card:hover,
      .mt-8.max-w-md>article.card:hover,
      #curriculum .acc-item:hover {
        transform: translateY(-3px) scale(1.02) !important;
        border-color: rgba(59, 130, 246, 0.4) !important;
        box-shadow: 0 10px 20px rgba(37, 99, 235, 0.08), 0 4px 8px rgba(37, 99, 235, 0.05), inset 0 0 0 1px rgba(37, 99, 235, 0.1) !important;
      }
    }

    .skills-grid article:active,
    .j-card:active,
    .bento-cell:active,
    ul.mt-8.grid>li:active,
    ul.grid-cols-2.gap-5>li.card:active,
    .mt-9.flex>.flex>.card:active,
    .kids-programming-image-grid>a:active,
    .kids-programming-subgrid>a:active,
    a.card.card-hover:active,
    ol.mt-12.grid>li.card:active,
    div.mt-7>span.rounded-2xl:active,
    .lg\:col-span-5 .grid.gap-4>.card:active,
    .lg\:col-span-4>.card:active,
    a.border-\[\#25D366\]:active,
    .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-4.lg\:grid-cols-7>div:active,
    #curriculum .border.border-slate-200.rounded-xl.bg-white:active,
    .grid.gap-6.sm\:grid-cols-2.lg\:grid-cols-3>div.border-slate-200:active,
    .grid.gap-3.sm\:grid-cols-4.lg\:grid-cols-6>div.border-slate-200:active,
    .grid.gap-6.sm\:grid-cols-2.lg\:grid-cols-4>div.border-slate-200:active,
    .grid.gap-3.grid-cols-2>div.border-slate-200:active,
    .grid.gap-6.sm\:grid-cols-2.md\:grid-cols-4>div.border-slate-200:active,
    .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-3.lg\:grid-cols-4.xl\:grid-cols-7>div:active,
    .grid.gap-8.md\:grid-cols-2.lg\:grid-cols-3>div.border-slate-200:active,
    .grid.gap-6.md\:grid-cols-2.lg\:grid-cols-3.xl\:grid-cols-4>div.relative:active,
    .grid.gap-4.sm\:grid-cols-2.md\:grid-cols-3.lg\:grid-cols-4.xl\:grid-cols-6>div:active,
    ul.mt-6.grid.gap-3.sm\:grid-cols-2>li:active,
    .grid.gap-4.sm\:grid-cols-2.lg\:grid-cols-6>div:active,
    span.chip:active,
    ol.mt-10.grid.gap-5.md\:grid-cols-3>li.card:active,
    .mt-10.grid.gap-5.md\:grid-cols-2.lg\:grid-cols-3>article.card:active,
    .mt-8.grid.gap-5.md\:grid-cols-2.lg\:grid-cols-4>article.card:active,
    .mt-10.grid.gap-5.md\:grid-cols-2>article.card:active,
    .mt-8.grid.gap-5.sm\:grid-cols-2.lg\:grid-cols-4>div.card:active,
    .mt-10.grid.gap-4.sm\:grid-cols-2>div.card:active,
    .grid.grid-cols-2.gap-4>div.card:active,
    .mt-8.max-w-md>article.card:active,
    #curriculum .acc-item:active {
      transform: translateY(0px) scale(0.99) !important;
      box-shadow: 0 2px 4px rgba(37, 99, 235, 0.04) !important;
      transition: transform 0.1s ease, box-shadow 0.1s ease;
    }
  </style>
  <script>
    window.SITE_CONFIG_OVERRIDES = <?= json_encode(cms_site_overrides(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP) ?>;
  </script>
  <script defer src="/assets/js/config.js"></script>
  <script defer src="/assets/js/main.min.js?v=20261028b"></script>
  <script defer src="/assets/js/chatbot.js?v=20261026c"></script>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "EducationalOrganization",
      "name": "Chedo Tech",
      "alternateName": "Chedo Tech — Programming Institute & App Development",
      "url": "https://chedo.in/",
      "logo": "https://chedo.in/assets/logo-180.png",
      "description": "Programming Institute & App Development in Pune — offline, practical programming education since 2015, from basics to full stack and real projects.",
      "foundingDate": "2015",
      "telephone": "+91-87931-00815",
      "email": "chetan2469@gmail.com",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Office No. 217, Ultima Business Center, Shree Shantinagar Society Internal Road, Sainagar, Kondhwa Budruk",
        "addressLocality": "Pune",
        "addressRegion": "Maharashtra",
        "postalCode": "411048",
        "addressCountry": "IN"
      }
    }
  </script>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Chedo Tech",
      "url": "https://chedo.in/"
    }
  </script>
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "ItemList",
      "name": "Chedo Tech Courses",
      "itemListElement": [{
          "@type": "ListItem",
          "position": 1,
          "name": "C Programming",
          "url": "https://chedo.in/courses/c-programming.php"
        },
        {
          "@type": "ListItem",
          "position": 2,
          "name": "C++ Programming",
          "url": "https://chedo.in/courses/cpp-programming.php"
        },
        {
          "@type": "ListItem",
          "position": 3,
          "name": "Java Programming",
          "url": "https://chedo.in/courses/java-programming.php"
        },
        {
          "@type": "ListItem",
          "position": 4,
          "name": "Python Programming",
          "url": "https://chedo.in/courses/python-programming.php"
        },
        {
          "@type": "ListItem",
          "position": 5,
          "name": "Data Structures & Algorithms",
          "url": "https://chedo.in/courses/data-structures-algorithms.php"
        },
        {
          "@type": "ListItem",
          "position": 6,
          "name": "Java + DSA",
          "url": "https://chedo.in/courses/java-dsa.php"
        },
        {
          "@type": "ListItem",
          "position": 7,
          "name": "Python + DSA",
          "url": "https://chedo.in/courses/python-dsa.php"
        },
        {
          "@type": "ListItem",
          "position": 8,
          "name": "C + C++ + DSA",
          "url": "https://chedo.in/courses/c-cpp-dsa.php"
        },
        {
          "@type": "ListItem",
          "position": 9,
          "name": "MERN Full Stack Development",
          "url": "https://chedo.in/courses/mern-full-stack.php"
        },
        {
          "@type": "ListItem",
          "position": 10,
          "name": "Java Full Stack Development",
          "url": "https://chedo.in/courses/java-full-stack.php"
        },
        {
          "@type": "ListItem",
          "position": 11,
          "name": "Mobile App Development (Flutter)",
          "url": "https://chedo.in/courses/mobile-app-development.php"
        },
        {
          "@type": "ListItem",
          "position": 12,
          "name": "Data Science Foundation",
          "url": "https://chedo.in/courses/data-science-foundation.php"
        },
        {
          "@type": "ListItem",
          "position": 13,
          "name": "Data Science",
          "url": "https://chedo.in/courses/data-science.php"
        },
        {
          "@type": "ListItem",
          "position": 14,
          "name": "Data Scientist",
          "url": "https://chedo.in/courses/data-scientist.php"
        },
        {
          "@type": "ListItem",
          "position": 15,
          "name": "ML Engineer",
          "url": "https://chedo.in/courses/ml-engineer.php"
        },
        {
          "@type": "ListItem",
          "position": 16,
          "name": "AI Engineer",
          "url": "https://chedo.in/courses/ai-engineer.php"
        },
        {
          "@type": "ListItem",
          "position": 17,
          "name": "Gen AI Engineer",
          "url": "https://chedo.in/courses/gen-ai-engineer.php"
        },
        {
          "@type": "ListItem",
          "position": 18,
          "name": "Agentic AI Engineer",
          "url": "https://chedo.in/courses/agentic-ai-engineer.php"
        },
        {
          "@type": "ListItem",
          "position": 19,
          "name": "Data Engineer",
          "url": "https://chedo.in/courses/data-engineer.php"
        },
        {
          "@type": "ListItem",
          "position": 20,
          "name": "UI/UX Design",
          "url": "https://chedo.in/courses/ui-ux-design.php"
        },
        {
          "@type": "ListItem",
          "position": 21,
          "name": "Kids Programming",
          "url": "https://chedo.in/courses/kids-programming.php"
        }
      ]
    }
  </script>
</head>

<body>
  <a class="skip-link" href="#main"><?= cms('global.header.01', 'Skip to main content') ?></a>
  <header class="site-header sticky top-0 z-50 bg-white border-b border-slate-200/80 shadow-[0_1px_3px_rgba(0,0,0,0.04)] transition-all duration-300" id="site-header">
    <div class="mx-auto flex h-[80px] max-w-7xl items-center justify-between gap-4 px-5 sm:px-8">
      <a href="<?= cmsu('global.header.02', '/index.php') ?>" class="site-brand group" aria-label="Chedo Tech — Home">
        <img src="/assets/logo-110.webp" alt="Chedo Tech Logo" width="44" height="44" decoding="async" class="site-brand-logo h-11 w-11">
        <span class="site-brand-text">
          <span class="brand-chedo"><?= cms('global.header.03', 'Chedo') ?></span>
          <span class="brand-tech"><?= cms('global.header.04', 'Tech') ?></span>
        </span>
      </a>

      <nav class="hidden items-center gap-0.5 lg:flex ml-auto" aria-label="Main navigation">
        <a class="nav-link<?php echo $nav_cls('home'); ?>" <?php echo $nav_cur('home'); ?> href="<?= cmsu('global.header.05', '/index.php') ?>"><?= cms('global.header.06', 'Home') ?></a>

        <!-- Courses Dropdown -->
        <div class="dropdown relative" id="courses-drop">
          <button id="courses-drop-btn" class="nav-link flex items-center gap-1<?php echo $nav_cls('courses'); ?>" aria-haspopup="true" aria-expanded="false">
            <?= cms('global.header.07', 'Courses') ?>
            <svg class="h-4 w-4 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>
          <div class="dropdown-panel" role="menu" aria-label="Courses">
            <div class="courses-dropdown-grid">
              <!-- Section 1: Programming -->
              <div>
                <p class="drop-head"><?= cms('global.header.08', 'Programming') ?></p>
                <div class="grid gap-0.5">
                  <a class="dropdown-link font-medium text-orange-700 animate-fade-in" href="<?= cmsu('global.header.09', '/courses/java-dsa.php') ?>">
                    <span class="drop-icon bg-orange-50 text-orange-600">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-orange-700"><?= cms('global.header.10', 'Java + DSA') ?> <span class="ml-1 rounded bg-blue-100 px-1 py-0.5 text-[9px]  text-orange-800"><?= cms('global.header.11', 'New') ?></span></span>
                  </a>
                  <a class="dropdown-link font-medium text-orange-700 animate-fade-in" href="<?= cmsu('global.header.12', '/courses/python-dsa.php') ?>">
                    <span class="drop-icon bg-yellow-50 text-blue-600 border border-yellow-200">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-orange-700"><?= cms('global.header.13', 'Python + DSA') ?> <span class="ml-1 rounded bg-blue-100 px-1 py-0.5 text-[9px]   text-blue-800"><?= cms('global.header.14', 'New') ?></span></span>
                  </a>
                  <a class="dropdown-link font-medium text-orange-700 animate-fade-in" href="<?= cmsu('global.header.15', '/courses/c-cpp-dsa.php') ?>">
                    <span class="drop-icon bg-blue-50 text-blue-600">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-orange-700"><?= cms('global.header.16', '(C) + (C++) + DSA') ?> <span class="ml-1 rounded bg-blue-100 px-1 py-0.5 text-[9px]  text-blue-800"><?= cms('global.header.17', 'New') ?></span></span>
                  </a>
                  <a class="dropdown-link" href="<?= cmsu('global.header.18', '/courses/c-programming.php') ?>">
                    <span class="drop-icon">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M8 3H7a2 2 0 0 0-2 2v5a2 2 0 0 1-2 2 2 2 0 0 1 2 2v5c0 1.1.9 2 2 2h1" />
                        <path d="M16 21h1a2 2 0 0 0 2-2v-5c0-1.1.9-2 2-2a2 2 0 0 1-2-2V5a2 2 0 0 0-2-2h-1" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-700"><?= cms('global.header.19', 'C Programming') ?></span>
                  </a>
                  <a class="dropdown-link" href="<?= cmsu('global.header.20', '/courses/cpp-programming.php') ?>">
                    <span class="drop-icon">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="m18 16 4-4-4-4" />
                        <path d="m6 8-4 4 4 4" />
                        <path d="m14.5 4-5 16" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-700"><?= cms('global.header.21', 'C++ Programming') ?></span>
                  </a>
                  <a class="dropdown-link" href="<?= cmsu('global.header.22', '/courses/java-programming.php') ?>">
                    <span class="drop-icon">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M10 2v2" />
                        <path d="M14 2v2" />
                        <path d="M16 8a1 1 0 0 1 1 1v8a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V9a1 1 0 0 1 1-1h14a4 4 0 1 1 0 8h-1" />
                        <path d="M6 2v2" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-700"><?= cms('global.header.23', 'Java Programming') ?></span>
                  </a>
                  <a class="dropdown-link" href="<?= cmsu('global.header.24', '/courses/python-programming.php') ?>">
                    <span class="drop-icon">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 22a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h8a2.4 2.4 0 0 1 1.704.706l3.588 3.588A2.4 2.4 0 0 1 20 8v12a2 2 0 0 1-2 2z" />
                        <path d="M14 2v5a1 1 0 0 0 1 1h5" />
                        <path d="M10 12.5 8 15l2 2.5" />
                        <path d="m14 12.5 2 2.5-2 2.5" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-700"><?= cms('global.header.25', 'Python Programming') ?></span>
                  </a>
                  <a class="dropdown-link" href="<?= cmsu('global.header.26', '/courses/data-structures-algorithms.php') ?>">
                    <span class="drop-icon">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="16" y="16" width="6" height="6" rx="1" />
                        <rect x="2" y="16" width="6" height="6" rx="1" />
                        <rect x="9" y="2" width="6" height="6" rx="1" />
                        <path d="M5 16v-3a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3" />
                        <path d="M12 12V8" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-700"><?= cms('global.header.27', 'Data Structures & Algorithms') ?></span>
                  </a>
                </div>
              </div>

              <!-- Section 2: Development -->
              <div>
                <p class="drop-head"><?= cms('global.header.28', 'Development') ?></p>
                <div class="grid gap-0.5">
                  <a class="dropdown-link" href="<?= cmsu('global.header.29', '/courses/mern-full-stack.php') ?>">
                    <span class="drop-icon">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10" />
                        <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20" />
                        <path d="M2 12h20" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-700"><?= cms('global.header.30', 'MERN Full Stack') ?></span>
                  </a>
                  <a class="dropdown-link" href="<?= cmsu('global.header.31', '/courses/java-full-stack.php') ?>">
                    <span class="drop-icon">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="20" height="8" x="2" y="2" rx="2" ry="2" />
                        <rect width="20" height="8" x="2" y="14" rx="2" ry="2" />
                        <line x1="6" x2="6.01" y1="6" y2="6" />
                        <line x1="6" x2="6.01" y1="18" y2="18" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-700"><?= cms('global.header.32', 'Java Full Stack') ?></span>
                  </a>
                  <a class="dropdown-link" href="<?= cmsu('global.header.33', '/courses/mobile-app-development.php') ?>">
                    <span class="drop-icon">
                      <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <rect width="14" height="20" x="5" y="2" rx="2" ry="2" />
                        <path d="M12 18h.01" />
                      </svg>
                    </span>
                    <span class="text-sm font-medium text-slate-700"><?= cms('global.header.34', 'Mobile App Development') ?></span>
                  </a>
                </div>
              </div>

              <!-- Section 3: Data & Design & Kids -->
              <div class="flex flex-col gap-y-4">
                <div>
                  <p class="drop-head"><?= cms('global.header.35', 'Data & Design') ?></p>
                  <div class="grid gap-0.5">
                    <a class="dropdown-link" href="<?= cmsu('global.header.36', '/courses/data-science-foundation.php') ?>">
                      <span class="drop-icon">
                        <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M12 3v18" />
                          <rect width="18" height="18" x="3" y="3" rx="2" />
                          <path d="M3 9h18" />
                          <path d="M3 15h18" />
                        </svg>
                      </span>
                      <span class="text-sm font-medium text-slate-700"><?= cms('global.header.37', 'Data Science Foundation') ?></span>
                    </a>
                    <a class="dropdown-link" href="<?= cmsu('global.header.38', '/courses/ui-ux-design.php') ?>">
                      <span class="drop-icon">
                        <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M12 22a1 1 0 0 1 0-20 10 9 0 0 1 10 9 5 5 0 0 1-5 5h-2.25a1.75 1.75 0 0 0-1.4 2.8l.3.4a1.75 1.75 0 0 1-1.4 2.8z" />
                          <circle cx="13.5" cy="6.5" r=".5" fill="currentColor" />
                          <circle cx="17.5" cy="10.5" r=".5" fill="currentColor" />
                          <circle cx="6.5" cy="12.5" r=".5" fill="currentColor" />
                          <circle cx="8.5" cy="7.5" r=".5" fill="currentColor" />
                        </svg>
                      </span>
                      <span class="text-sm font-medium text-slate-700"><?= cms('global.header.39', 'UI/UX Design') ?></span>
                    </a>
                  </div>
                </div>

                <div>
                  <p class="drop-head"><?= cms('global.header.40', 'Kids') ?></p>
                  <div class="grid gap-0.5">
                    <a class="dropdown-link" href="<?= cmsu('global.header.41', '/courses/kids-programming.php') ?>">
                      <span class="drop-icon">
                        <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <line x1="6" x2="10" y1="11" y2="11" />
                          <line x1="8" x2="8" y1="9" y2="13" />
                          <line x1="15" x2="15.01" y1="12" y2="12" />
                          <line x1="18" x2="18.01" y1="10" y2="10" />
                          <path d="M17.32 5H6.68a4 4 0 0 0-3.978 3.59c-.006.052-.01.101-.017.152C2.604 9.416 2 14.456 2 16a3 3 0 0 0 3 3c1 0 1.5-.5 2-1l1.414-1.414A2 2 0 0 1 9.828 16h4.344a2 2 0 0 1 1.414.586L17 18c.5.5 1 1 2 1a3 3 0 0 0 3-3c0-1.545-.604-6.584-.685-7.258-.007-.05-.011-.1-.017-.151A4 4 0 0 0 17.32 5z" />
                        </svg>
                      </span>
                      <span class="text-sm font-medium text-slate-700"><?= cms('global.header.42', 'Kids Programming') ?></span>
                    </a>
                    <a class="dropdown-link" href="<?= cmsu('global.header.43', '/courses/data-science-foundation-kids.php') ?>">
                      <span class="drop-icon">
                        <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                          <path d="M12 3v18" />
                          <rect width="18" height="18" x="3" y="3" rx="2" />
                          <path d="M3 9h18" />
                          <path d="M3 15h18" />
                        </svg>
                      </span>
                      <span class="text-sm font-medium text-slate-700"><?= cms('global.header.44', 'Kids Data Science Foundation') ?></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            <a class="mt-3 flex items-center justify-between rounded-xl bg-slate-50 px-4 py-3 text-sm font-semibold text-orange-700 transition-colors hover:bg-blue-50" href="<?= cmsu('global.header.45', '/courses.php') ?>">
              <?= cms('global.header.46', 'View all courses') ?>
              <!-- @license lucide-static v1.28.0 - ISC -->
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
                <path d="M5 12h14" />
                <path d="m12 5 7 7-7 7" />
              </svg>

            </a>
          </div>
        </div>

        <!-- 2. AI and DATA Dropdown with unique Font Awesome icons -->
        <div class="dropdown relative" id="ai-data-drop">
          <button id="ai-data-drop-btn" class="nav-link flex items-center gap-1<?php echo $nav_cls('ai'); ?>" aria-haspopup="true" aria-expanded="false">
            <?= cms('global.header.47', 'AI and DATA') ?>
            <svg class="h-4 w-4 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>
          <div class="dropdown-panel" role="menu" aria-label="AI and DATA" style="width: 16.5rem; left: auto; right: -1rem; transform-origin: top right;">
            <div class="grid gap-1 p-1">

              <!-- Item 1: Data Science -->
              <a class="dropdown-link" href="<?= cmsu('global.header.48', '/courses/data-science.php') ?>">
                <span class="drop-icon text-blue-600 bg-blue-50">
                  <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21.21 15.89A10 10 0 1 1 8 2.83" />
                    <path d="M22 12A10 10 0 0 0 12 2v10z" />
                  </svg>
                </span>
                <span class="text-sm font-medium text-slate-700"><?= cms('global.header.49', 'Data Science') ?></span>
              </a>

              <!-- Item 1b: Data Scientist -->
              <a class="dropdown-link" href="<?= cmsu('global.header.50', '/courses/data-scientist.php') ?>">
                <span class="drop-icon text-rose-600 bg-rose-50">
                  <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M3 3v18h18" />
                    <path d="m19 9-5 5-4-4-3 3" />
                  </svg>
                </span>
                <span class="text-sm font-medium text-slate-700"><?= cms('global.header.51', 'Data Scientist') ?></span>
              </a>

              <!-- Item 2: ML Engineering -->
              <a class="dropdown-link" href="<?= cmsu('global.header.52', '/courses/ml-engineer.php') ?>">
                <span class="drop-icon text-indigo-600 bg-indigo-50">
                  <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9.5 2A2.5 2.5 0 0 1 12 4.5v15a2.5 2.5 0 0 1-4.96.44 2.5 2.5 0 0 1-2.96-3.08 3 3 0 0 1-.34-5.58 2.5 2.5 0 0 1 1.32-4.24 2.5 2.5 0 0 1 4.44-5.04z" />
                    <path d="M14.5 2A2.5 2.5 0 0 0 12 4.5v15a2.5 2.5 0 0 0 4.96.44 2.5 2.5 0 0 0 2.96-3.08 3 3 0 0 0 .34-5.58 2.5 2.5 0 0 0-1.32-4.24 2.5 2.5 0 0 0-4.44-5.04z" />
                  </svg>
                </span>
                <span class="text-sm font-medium text-slate-700"><?= cms('global.header.53', 'ML Engineering') ?></span>
              </a>

              <!-- Item 3: AI Engineering -->
              <a class="dropdown-link" href="<?= cmsu('global.header.54', '/courses/ai-engineer.php') ?>">
                <span class="drop-icon text-sky-600 bg-sky-50">
                  <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="10" rx="2" />
                    <circle cx="12" cy="5" r="2" />
                    <path d="M12 7v4" />
                    <line x1="8" y1="16" x2="8.01" y2="16" />
                    <line x1="16" y1="16" x2="16.01" y2="16" />
                  </svg>
                </span>
                <span class="text-sm font-medium text-slate-700"><?= cms('global.header.55', 'AI Engineering') ?></span>
              </a>

              <!-- Item 4: Gen AI Engineering -->
              <a class="dropdown-link" href="<?= cmsu('global.header.56', '/courses/gen-ai-engineer.php') ?>">
                <span class="drop-icon text-purple-600 bg-purple-50">
                  <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="m15 4-2 4 4-2-4-2z" />
                    <path d="m5 16 9-9 3 3-9 9H5v-3z" />
                    <path d="M19 12l1 2 2 1-2 1-1 2-1-2-2-1 2-1 1-2z" />
                  </svg>
                </span>
                <span class="text-sm font-medium text-slate-700"><?= cms('global.header.57', 'Gen AI Engineering') ?></span>
              </a>

              <!-- Item 5: Agentic AI Engineering -->
              <a class="dropdown-link" href="<?= cmsu('global.header.58', '/courses/agentic-ai-engineer.php') ?>">
                <span class="drop-icon text-emerald-600 bg-emerald-50">
                  <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="6" cy="6" r="3" />
                    <circle cx="18" cy="6" r="3" />
                    <circle cx="12" cy="18" r="3" />
                    <line x1="8.5" y1="7.5" x2="15.5" y2="7.5" />
                    <line x1="7.5" y1="8.5" x2="10.5" y2="15.5" />
                    <line x1="16.5" y1="8.5" x2="13.5" y2="15.5" />
                  </svg>
                </span>
                <span class="text-sm font-medium text-slate-700"><?= cms('global.header.59', 'Agentic AI Engineering') ?></span>
              </a>

              <!-- Item 6: Data Engineering -->
              <a class="dropdown-link" href="<?= cmsu('global.header.60', '/courses/data-engineer.php') ?>">
                <span class="drop-icon text-cyan-600 bg-cyan-50">
                  <svg aria-hidden="true" focusable="false" class="h-[18px] w-[18px]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <ellipse cx="12" cy="5" rx="9" ry="3" />
                    <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" />
                    <path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3" />
                  </svg>
                </span>
                <span class="text-sm font-medium text-slate-700"><?= cms('global.header.61', 'Data Engineering') ?></span>
              </a>

            </div>
          </div>
        </div>

        <a class="nav-link<?php echo $nav_cls('about'); ?>" <?php echo $nav_cur('about'); ?> href="<?= cmsu('global.header.62', '/about.php') ?>"><?= cms('global.header.63', 'About') ?></a>
        <a class="nav-link<?php echo $nav_cls('contact'); ?>" <?php echo $nav_cur('contact'); ?> href="<?= cmsu('global.header.64', '/contact.php') ?>"><?= cms('global.header.65', 'Contact') ?></a>
        <a class="nav-cta" href="<?= cmsu('global.header.66', '/contact.php') ?>">
          <?= cms('global.header.67', 'Enquire Now') ?>
          <svg aria-hidden="true" focusable="false" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
            <path d="M5 12h14" />
            <path d="m12 5 7 7-7 7" />
          </svg>
        </a>
        <a class="nav-cta nav-login" href="<?= cmsu('global.header.68', 'https://chedo.web.app/') ?>">
          <?= cms('global.header.69', 'Student Login') ?>
        </a>
      </nav>

      <div class="flex items-center gap-2">

        <button id="menu-btn" class="flex h-11 w-11 items-center justify-center rounded-xl border border-slate-200 bg-white text-slate-700 lg:hidden" aria-label="Open menu" aria-expanded="false" aria-controls="mobile-menu">
          <!-- @license lucide-static v1.28.0 - ISC -->
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
            <path d="M4 5h16" />
            <path d="M4 12h16" />
            <path d="M4 19h16" />
          </svg>

        </button>
      </div>

      <div id="mobile-menu" class="mobile-panel lg:hidden">
        <nav aria-label="Mobile navigation" class="px-5 py-4">
          <a class="mob-link<?php echo $nav_cls('home'); ?>" <?php echo $nav_cur('home'); ?> href="<?= cmsu('global.header.70', '/index.php') ?>"><?= cms('global.header.71', 'Home') ?></a>
          <button id="mob-courses-btn" class="mob-link justify-between<?php echo $nav_cls('courses'); ?>" aria-expanded="false" aria-controls="mob-courses-list">
            <?= cms('global.header.72', 'Courses') ?>
            <!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-4 w-4 text-slate-500"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg>

          </button>
          <div id="mob-courses-list" class="hidden border-l-2 border-slate-100 pb-2 pl-3">
            <p class="drop-head"><?= cms('global.header.73', 'Programming') ?></p><a class="mob-sub-link font-semibold text-orange-600" href="<?= cmsu('global.header.74', '/courses/java-dsa.php') ?>"><?= cms('global.header.75', 'Java + DSA Course') ?></a><a class="mob-sub-link font-semibold text-blue-600" href="<?= cmsu('global.header.76', '/courses/python-dsa.php') ?>"><?= cms('global.header.77', 'Python + DSA Course') ?></a><a class="mob-sub-link font-semibold text-blue-600" href="<?= cmsu('global.header.78', '/courses/c-cpp-dsa.php') ?>"><?= cms('global.header.79', 'C + C++ + DSA Course') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.80', '/courses/c-programming.php') ?>"><?= cms('global.header.81', 'C Programming') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.82', '/courses/cpp-programming.php') ?>"><?= cms('global.header.83', 'C++ Programming') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.84', '/courses/java-programming.php') ?>"><?= cms('global.header.85', 'Java Programming') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.86', '/courses/python-programming.php') ?>"><?= cms('global.header.87', 'Python Programming') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.88', '/courses/data-structures-algorithms.php') ?>"><?= cms('global.header.89', 'Data Structures & Algorithms') ?></a>
            <p class="drop-head"><?= cms('global.header.90', 'Development') ?></p><a class="mob-sub-link" href="<?= cmsu('global.header.91', '/courses/mern-full-stack.php') ?>"><?= cms('global.header.92', 'MERN Full Stack') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.93', '/courses/java-full-stack.php') ?>"><?= cms('global.header.94', 'Java Full Stack') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.95', '/courses/mobile-app-development.php') ?>"><?= cms('global.header.96', 'Mobile App Development') ?></a>
            <p class="drop-head"><?= cms('global.header.97', 'Data & Design') ?></p><a class="mob-sub-link" href="<?= cmsu('global.header.98', '/courses/data-science-foundation.php') ?>"><?= cms('global.header.99', 'Data Science Foundation') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.100', '/courses/ui-ux-design.php') ?>"><?= cms('global.header.101', 'UI/UX Design') ?></a>
            <p class="drop-head"><?= cms('global.header.102', 'Kids') ?></p><a class="mob-sub-link" href="<?= cmsu('global.header.103', '/courses/kids-programming.php') ?>"><?= cms('global.header.104', 'Kids Programming') ?></a><a class="mob-sub-link" href="<?= cmsu('global.header.105', '/courses/data-science-foundation-kids.php') ?>"><?= cms('global.header.106', 'Kids Data Science Foundation') ?></a>
            <a class="mob-sub-link font-semibold text-orange-700" href="<?= cmsu('global.header.107', '/courses.php') ?>"><?= cms('global.header.108', 'View all courses →') ?></a>
          </div>
          <button id="mob-ai-btn" class="mob-link justify-between<?php echo $nav_cls('ai'); ?>" aria-expanded="false" aria-controls="mob-ai-list">
            <?= cms('global.header.109', 'AI and DATA') ?>
            <svg aria-hidden="true" focusable="false" class="h-4 w-4 text-slate-500" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="m6 9 6 6 6-6" />
            </svg>
          </button>
          <div id="mob-ai-list" class="hidden border-l-2 border-slate-100 pb-2 pl-3">
            <a class="mob-sub-link flex items-center gap-2" href="<?= cmsu('global.header.110', '/courses/data-science.php') ?>"><svg aria-hidden="true" focusable="false" class="w-4 h-4 text-blue-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21.21 15.89A10 10 0 1 1 8 2.83" />
                <path d="M22 12A10 10 0 0 0 12 2v10z" />
              </svg> <?= cms('global.header.111', 'Data Science') ?></a>
            <a class="mob-sub-link flex items-center gap-2" href="<?= cmsu('global.header.112', '/courses/data-scientist.php') ?>"><svg aria-hidden="true" focusable="false" class="w-4 h-4 text-rose-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 3v18h18" />
                <path d="m19 9-5 5-4-4-3 3" />
              </svg> <?= cms('global.header.113', 'Data Scientist') ?></a>
            <a class="mob-sub-link flex items-center gap-2" href="<?= cmsu('global.header.114', '/courses/ml-engineer.php') ?>"><svg aria-hidden="true" focusable="false" class="w-4 h-4 text-indigo-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9.5 2A2.5 2.5 0 0 1 12 4.5v15a2.5 2.5 0 0 1-4.96.44 2.5 2.5 0 0 1-2.96-3.08 3 3 0 0 1-.34-5.58 2.5 2.5 0 0 1 1.32-4.24 2.5 2.5 0 0 1 4.44-5.04z" />
                <path d="M14.5 2A2.5 2.5 0 0 0 12 4.5v15a2.5 2.5 0 0 0 4.96.44 2.5 2.5 0 0 0 2.96-3.08 3 3 0 0 0 .34-5.58 2.5 2.5 0 0 0-1.32-4.24 2.5 2.5 0 0 0-4.44-5.04z" />
              </svg> <?= cms('global.header.115', 'ML Engineering') ?></a>
            <a class="mob-sub-link flex items-center gap-2" href="<?= cmsu('global.header.116', '/courses/ai-engineer.php') ?>"><svg aria-hidden="true" focusable="false" class="w-4 h-4 text-sky-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="11" width="18" height="10" rx="2" />
                <circle cx="12" cy="5" r="2" />
                <path d="M12 7v4" />
                <line x1="8" y1="16" x2="8.01" y2="16" />
                <line x1="16" y1="16" x2="16.01" y2="16" />
              </svg> <?= cms('global.header.117', 'AI Engineering') ?></a>
            <a class="mob-sub-link flex items-center gap-2" href="<?= cmsu('global.header.118', '/courses/gen-ai-engineer.php') ?>"><svg aria-hidden="true" focusable="false" class="w-4 h-4 text-purple-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="m15 4-2 4 4-2-4-2z" />
                <path d="m5 16 9-9 3 3-9 9H5v-3z" />
                <path d="M19 12l1 2 2 1-2 1-1 2-1-2-2-1 2-1 1-2z" />
              </svg> <?= cms('global.header.119', 'Gen AI Engineering') ?></a>
            <a class="mob-sub-link flex items-center gap-2" href="<?= cmsu('global.header.120', '/courses/agentic-ai-engineer.php') ?>"><svg aria-hidden="true" focusable="false" class="w-4 h-4 text-emerald-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="6" cy="6" r="3" />
                <circle cx="18" cy="6" r="3" />
                <circle cx="12" cy="18" r="3" />
                <line x1="8.5" y1="7.5" x2="15.5" y2="7.5" />
                <line x1="7.5" y1="8.5" x2="10.5" y2="15.5" />
                <line x1="16.5" y1="8.5" x2="13.5" y2="15.5" />
              </svg> <?= cms('global.header.121', 'Agentic AI Engineering') ?></a>
            <a class="mob-sub-link flex items-center gap-2" href="<?= cmsu('global.header.122', '/courses/data-engineer.php') ?>"><svg aria-hidden="true" focusable="false" class="w-4 h-4 text-cyan-600 shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <ellipse cx="12" cy="5" rx="9" ry="3" />
                <path d="M3 5v14c0 1.66 4 3 9 3s9-1.34 9-3V5" />
                <path d="M3 12c0 1.66 4 3 9 3s9-1.34 9-3" />
              </svg> <?= cms('global.header.123', 'Data Engineering') ?></a>
          </div>
          <a class="mob-link<?php echo $nav_cls('about'); ?>" <?php echo $nav_cur('about'); ?> href="<?= cmsu('global.header.124', '/about.php') ?>"><?= cms('global.header.125', 'About') ?></a>
          <a class="mob-link<?php echo $nav_cls('contact'); ?>" <?php echo $nav_cur('contact'); ?> href="<?= cmsu('global.header.126', '/contact.php') ?>"><?= cms('global.header.127', 'Contact') ?></a>
          <a class="nav-cta nav-cta-block" href="<?= cmsu('global.header.128', '/contact.php') ?>"><?= cms('global.header.129', 'Enquire Now') ?> <svg aria-hidden="true" focusable="false" class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14" />
              <path d="m12 5 7 7-7 7" />
            </svg></a>
          <a class="nav-cta nav-cta-block nav-login" href="<?= cmsu('global.header.130', 'https://chedo.web.app/') ?>" style="margin-top: 0;"><?= cms('global.header.131', 'Student Login') ?></a>
        </nav>
      </div>
    </div>
  </header>