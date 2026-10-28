<?php
// Trending Courses panel — right side of the courses.php hero.
// To change what's featured, edit this list (order = rank). Images live in assets/images/courses/.
$trending_courses = [
  [
    'name'     => 'Java Full Stack Development',
    'href'     => 'courses/java-full-stack.php',
    'img'      => 'Java Full Stack Development.webp',
    'category' => 'Development',
    'stack'    => 'Spring Boot · Hibernate · React',
  ],
  [
    'name'     => 'Data Science',
    'href'     => 'courses/data-science.php',
    'img'      => 'Data Science.webp',
    'category' => 'Data & AI',
    'stack'    => 'Pandas · Machine Learning · Power BI',
  ],
  [
    'name'     => 'MERN Full Stack Development',
    'href'     => 'courses/mern-full-stack.php',
    'img'      => 'MERN Full Stack Development.webp',
    'category' => 'Development',
    'stack'    => 'MongoDB · Express · React · Node.js',
  ],
  [
    'name'     => 'Python + DSA Foundation',
    'href'     => 'courses/python-dsa.php',
    'img'      => 'Python + DSA Foundation.webp',
    'category' => 'Programming',
    'stack'    => 'Python Core · DSA · Problem Solving',
  ],
];

$ct_total = count($trending_courses);
// Only spaces are encoded so the URLs match the course grid's <img> tags and share the browser cache.
$ct_img = function ($file) {
  return 'assets/images/courses/' . str_replace(' ', '%20', htmlspecialchars($file, ENT_QUOTES));
};
$ct_e = function ($s) {
  return htmlspecialchars($s, ENT_QUOTES);
};
?>
<aside class="ct-trend" id="ct-trend" aria-labelledby="ct-trend-title">

  <div class="ct-trend-badge" aria-hidden="true">
    <span class="ct-trend-badge-icon">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
        <circle cx="12" cy="10" r="3" />
      </svg>
    </span>
    <?= cms('courses.trending-courses.01', 'Offline · Pune') ?>
  </div>

  <div class="ct-trend-card">

    <div class="ct-trend-head">
      <span class="ct-trend-icon" aria-hidden="true">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M8.5 14.5A2.5 2.5 0 0 0 11 12c0-1.38-.5-2-1-3-1.072-2.143-.224-4.054 2-6 .5 2.5 2 4.9 4 6.5 2 1.6 3 3.5 3 5.5a7 7 0 1 1-14 0c0-1.153.433-2.294 1-3a2.5 2.5 0 0 0 2.5 2.5z" />
        </svg>
      </span>
      <div class="ct-trend-heading">
        <h2 id="ct-trend-title" class="ct-trend-title"><?= cms('courses.trending-courses.02', 'Trending Courses') ?></h2>
        <p class="ct-trend-sub"><?= cms('courses.trending-courses.03', 'Popular picks at Chedo Tech') ?></p>
      </div>
      <span class="ct-trend-count" aria-hidden="true">01 / <?= sprintf('%02d', $ct_total) ?></span>
      <button type="button" class="ct-trend-toggle" aria-label="Pause trending courses slideshow" hidden>
        <svg class="ct-icon-pause" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <rect x="6" y="5" width="4" height="14" rx="1" />
          <rect x="14" y="5" width="4" height="14" rx="1" />
        </svg>
        <svg class="ct-icon-play" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
          <path d="M7 5.5v13a1 1 0 0 0 1.5.86l11-6.5a1 1 0 0 0 0-1.72l-11-6.5A1 1 0 0 0 7 5.5z" />
        </svg>
      </button>
    </div>

    <!-- Visual showcase; the list below carries the same links for keyboard and screen-reader users. -->
    <a class="ct-feature" href="<?= $ct_e($trending_courses[0]['href']) ?>" tabindex="-1" aria-hidden="true">
      <?php foreach ($trending_courses as $i => $c): ?>
        <div class="ct-slide<?= $i === 0 ? ' is-active' : '' ?>">
          <img src="<?= $ct_img($c['img']) ?>" alt="" width="400" height="225" decoding="async">
          <div class="ct-slide-body">
            <span class="ct-slide-rank">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
                <path d="M16 7h6v6" />
                <path d="m22 7-8.5 8.5-5-5L2 17" />
              </svg>
              #<?= $i + 1 ?> Trending
            </span>
            <span class="ct-slide-name"><?= $ct_e($c['name']) ?></span>
            <span class="ct-slide-stack"><?= $ct_e($c['stack']) ?></span>
          </div>
        </div>
      <?php endforeach; ?>
      <span class="ct-feature-go">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round">
          <path d="M7 7h10v10" />
          <path d="M7 17 17 7" />
        </svg>
      </span>
    </a>

    <ol class="ct-trend-list">
      <?php foreach ($trending_courses as $i => $c): ?>
        <li>
          <a class="ct-trend-item<?= $i === 0 ? ' is-active' : '' ?>" href="<?= $ct_e($c['href']) ?>">
            <span class="ct-trend-rank" aria-hidden="true"><?= sprintf('%02d', $i + 1) ?></span>
            <img class="ct-trend-thumb" src="<?= $ct_img($c['img']) ?>" alt="" width="52" height="32" decoding="async">
            <span class="ct-trend-text">
              <span class="ct-trend-name"><?= $ct_e($c['name']) ?></span>
              <span class="ct-trend-cat"><?= $ct_e($c['category']) ?></span>
            </span>
            <svg class="ct-trend-arrow" aria-hidden="true" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14" />
              <path d="m12 5 7 7-7 7" />
            </svg>
            <span class="ct-progress" aria-hidden="true"></span>
          </a>
        </li>
      <?php endforeach; ?>
    </ol>
  </div>
</aside>

<style>
  /* ---------- Courses hero: copy (left) + trending panel (right) ---------- */
  .ct-hero-grid {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 3rem;
    align-items: center;
  }

  @media (min-width: 1024px) {
    .ct-hero-grid {
      grid-template-columns: minmax(0, 1fr) clamp(340px, 33vw, 440px);
      gap: 3.5rem;
    }
  }

  .ct-trend {
    --ct-interval: 5s;
    position: relative;
    width: 100%;
    max-width: 520px;
  }

  /* Tilted gradient card peeking out behind the panel */
  .ct-trend::before {
    content: "";
    position: absolute;
    inset: 18px -14px -14px 18px;
    border-radius: 24px;
    background: linear-gradient(135deg, #2563eb 0%, #06b6d4 100%);
    transform: rotate(3deg);
    opacity: .9;
  }

  .ct-trend-card {
    position: relative;
    padding: 14px;
    background: #fff;
    border: 1px solid rgba(226, 232, 240, .9);
    border-radius: 22px;
    box-shadow: 0 1px 2px rgba(15, 23, 42, .05), 0 30px 60px -28px rgba(37, 99, 235, .45);
  }

  /* Floating "Offline · Pune" pill, same feel as the home hero badges */
  .ct-trend-badge {
    position: absolute;
    z-index: 3;
    top: 92px;
    left: -26px;
    display: inline-flex;
    align-items: center;
    gap: 7px;
    padding: 6px 12px 6px 6px;
    border-radius: 999px;
    background: #fff;
    border: 1px solid #e2e8f0;
    box-shadow: 0 12px 28px -12px rgba(15, 23, 42, .35);
    font-size: 12px;
    font-weight: 700;
    color: #0f172a;
    white-space: nowrap;
    animation: ct-float 5s ease-in-out infinite;
  }

  .ct-trend-badge-icon {
    display: grid;
    place-items: center;
    width: 24px;
    height: 24px;
    border-radius: 999px;
    background: #eff6ff;
    color: #2563eb;
  }

  .ct-trend-badge-icon svg {
    width: 13px;
    height: 13px;
  }

  /* Header */
  .ct-trend-head {
    display: flex;
    align-items: center;
    gap: .65rem;
    padding: 2px 2px 12px;
  }

  .ct-trend-icon {
    flex: none;
    display: grid;
    place-items: center;
    width: 36px;
    height: 36px;
    border-radius: 11px;
    color: #fff;
    background: linear-gradient(135deg, #fb923c, #ef4444);
    box-shadow: 0 8px 16px -8px rgba(239, 68, 68, .7);
  }

  .ct-trend-icon svg {
    width: 18px;
    height: 18px;
  }

  .ct-trend-heading {
    flex: 1;
    min-width: 0;
  }

  /* !important beats main.css's `section h2:not(.hero-title)` size rule */
  .ct-trend .ct-trend-title {
    margin: 0;
    font-size: 15.5px !important;
    font-weight: 800;
    line-height: 1.2 !important;
    letter-spacing: -.01em !important;
    color: #0f172a;
  }

  .ct-trend-sub {
    margin: 2px 0 0;
    font-size: 12px;
    line-height: 1.3;
    color: #64748b;
  }

  .ct-trend-count {
    font: 600 11.5px/1 ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
    letter-spacing: .04em;
    color: #94a3b8;
    white-space: nowrap;
  }

  .ct-trend-toggle {
    flex: none;
    display: grid;
    place-items: center;
    width: 28px;
    height: 28px;
    border-radius: 999px;
    border: 1px solid #e2e8f0;
    background: #fff;
    color: #475569;
    cursor: pointer;
    transition: background-color .2s, border-color .2s, color .2s;
  }

  .ct-trend-toggle[hidden] {
    display: none;
  }

  .ct-trend-toggle:hover {
    background: #eff6ff;
    border-color: #bfdbfe;
    color: #1d4ed8;
  }

  .ct-trend-toggle:focus-visible,
  .ct-trend-item:focus-visible {
    outline: 2px solid #2563eb;
    outline-offset: 2px;
  }

  .ct-trend-toggle svg {
    width: 12px;
    height: 12px;
  }

  .ct-trend-toggle .ct-icon-play,
  .ct-trend.is-paused .ct-trend-toggle .ct-icon-pause {
    display: none;
  }

  .ct-trend.is-paused .ct-trend-toggle .ct-icon-play {
    display: block;
  }

  /* Featured slide */
  .ct-feature {
    position: relative;
    display: block;
    aspect-ratio: 16 / 9;
    overflow: hidden;
    border-radius: 14px;
    background: #0f172a;
    isolation: isolate;
  }

  .ct-slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    visibility: hidden;
    transition: opacity .6s ease, visibility .6s;
  }

  .ct-slide.is-active {
    opacity: 1;
    visibility: visible;
  }

  .ct-slide img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transform: scale(1.07);
    transition: transform 6s ease-out;
  }

  .ct-slide.is-active img {
    transform: scale(1);
  }

  .ct-slide::after {
    content: "";
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(2, 6, 23, .92) 0%, rgba(2, 6, 23, .5) 42%, rgba(2, 6, 23, 0) 72%);
  }

  .ct-slide-body {
    position: absolute;
    left: 0;
    right: 60px;
    bottom: 0;
    z-index: 1;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    gap: 3px;
    padding: 14px 16px;
    color: #fff;
  }

  .ct-slide-rank {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    margin-bottom: 4px;
    padding: 3px 9px 3px 7px;
    border-radius: 999px;
    font-size: 10.5px;
    font-weight: 800;
    letter-spacing: .06em;
    text-transform: uppercase;
    color: #fff;
    background: linear-gradient(135deg, #f97316, #ef4444);
    box-shadow: 0 6px 14px -6px rgba(239, 68, 68, .8);
  }

  .ct-slide-rank svg {
    width: 12px;
    height: 12px;
  }

  .ct-slide-name {
    font-size: 19px;
    font-weight: 800;
    line-height: 1.2;
    letter-spacing: -.015em;
    text-shadow: 0 1px 3px rgba(0, 0, 0, .35);
  }

  .ct-slide-stack {
    font-size: 12.5px;
    color: rgba(226, 232, 240, .92);
  }

  .ct-feature-go {
    position: absolute;
    right: 14px;
    bottom: 14px;
    z-index: 2;
    display: grid;
    place-items: center;
    width: 38px;
    height: 38px;
    border-radius: 999px;
    background: #fff;
    color: #1d4ed8;
    box-shadow: 0 8px 18px -8px rgba(0, 0, 0, .6);
    transition: transform .25s ease;
  }

  .ct-feature-go svg {
    width: 17px;
    height: 17px;
  }

  .ct-feature:hover .ct-feature-go {
    transform: translate(2px, -2px) scale(1.06);
  }

  /* Ranked list */
  .ct-trend-list {
    display: grid;
    grid-template-columns: minmax(0, 1fr);
    gap: 4px;
    margin: 10px 0 0;
    padding: 0;
    list-style: none;
  }

  .ct-trend-item {
    position: relative;
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 7px 10px 7px 8px;
    overflow: hidden;
    border: 1px solid transparent;
    border-radius: 12px;
    color: inherit;
    text-decoration: none;
    transition: background-color .2s, border-color .2s;
  }

  .ct-trend-item:hover {
    background: #f8fafc;
  }

  .ct-trend-item.is-active {
    background: #eff6ff;
    border-color: #dbeafe;
  }

  .ct-trend-rank {
    flex: none;
    width: 20px;
    font: 700 12px/1 ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
    color: #94a3b8;
  }

  .ct-trend-item.is-active .ct-trend-rank {
    color: #2563eb;
  }

  .ct-trend-thumb {
    flex: none;
    width: 52px;
    height: 32px;
    border-radius: 7px;
    object-fit: cover;
    background: #0f172a;
  }

  .ct-trend-text {
    flex: 1;
    min-width: 0;
    display: flex;
    flex-direction: column;
    gap: 1px;
  }

  .ct-trend-name {
    overflow: hidden;
    font-size: 13.5px;
    font-weight: 700;
    line-height: 1.25;
    color: #0f172a;
    white-space: nowrap;
    text-overflow: ellipsis;
  }

  .ct-trend-cat {
    font-size: 11.5px;
    line-height: 1.3;
    color: #64748b;
  }

  .ct-trend-arrow {
    flex: none;
    width: 16px;
    height: 16px;
    color: #94a3b8;
    transition: transform .2s, color .2s;
  }

  .ct-trend-item:hover .ct-trend-arrow,
  .ct-trend-item.is-active .ct-trend-arrow {
    color: #2563eb;
    transform: translateX(2px);
  }

  /* Auto-advance progress bar; its animationend moves to the next course */
  .ct-progress {
    position: absolute;
    left: 0;
    bottom: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #2563eb, #06b6d4);
    transform: scaleX(0);
    transform-origin: left;
  }

  .ct-trend.is-ready .ct-trend-item.is-active .ct-progress {
    animation: ct-progress var(--ct-interval) linear forwards;
  }

  .ct-trend.is-paused .ct-progress,
  .ct-trend.is-offscreen .ct-progress,
  .ct-trend:hover .ct-progress,
  .ct-trend:focus-within .ct-progress {
    animation-play-state: paused !important;
  }

  @keyframes ct-progress {
    to {
      transform: scaleX(1);
    }
  }

  @keyframes ct-float {
    50% {
      transform: translateY(-6px);
    }
  }

  @media (max-width: 1023px) {
    .ct-trend-badge {
      left: -10px;
    }
  }

  /* Tablet: panel spans the full width, slide on the left and list on the right */
  @media (min-width: 640px) and (max-width: 1023px) {
    .ct-trend {
      max-width: none;
    }

    .ct-trend-card {
      display: grid;
      grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr);
      column-gap: 12px;
      align-items: center;
    }

    .ct-trend-head {
      grid-column: 1 / -1;
    }

    .ct-trend-list {
      margin-top: 0;
    }
  }

  @media (max-width: 639px) {
    .ct-trend::before {
      inset: 12px -6px -8px 12px;
    }

    .ct-slide-name {
      font-size: 17px;
    }

    /* No room to float it clear of the slide text; the hero chips already say "Offline" */
    .ct-trend-badge {
      display: none;
    }

    .ct-trend-name {
      white-space: normal;
    }
  }

  @media (prefers-reduced-motion: reduce) {
    .ct-trend-badge {
      animation: none;
    }

    .ct-slide,
    .ct-slide img {
      transition: none;
    }

    .ct-slide img {
      transform: none;
    }
  }
</style>

<script>
  (function() {
    var root = document.getElementById('ct-trend');
    if (!root) return;
    var items = root.querySelectorAll('.ct-trend-item');
    var slides = root.querySelectorAll('.ct-slide');
    var feature = root.querySelector('.ct-feature');
    var count = root.querySelector('.ct-trend-count');
    var toggle = root.querySelector('.ct-trend-toggle');
    var total = items.length;
    var current = 0;

    function pad(n) {
      return (n < 10 ? '0' : '') + n;
    }

    function show(i) {
      current = (i + total) % total;
      for (var j = 0; j < total; j++) {
        items[j].classList.toggle('is-active', j === current);
        slides[j].classList.toggle('is-active', j === current);
      }
      feature.href = items[current].getAttribute('href');
      count.textContent = pad(current + 1) + ' / ' + pad(total);
    }

    Array.prototype.forEach.call(items, function(item, idx) {
      item.addEventListener('mouseenter', function() {
        show(idx);
      });
      item.addEventListener('focus', function() {
        show(idx);
      });
      item.querySelector('.ct-progress').addEventListener('animationend', function() {
        show(current + 1);
      });
    });

    // No auto-advance for reduced-motion users; hover/focus on the list still switches the slide.
    if (total < 2 || window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;

    root.classList.add('is-ready');
    toggle.hidden = false;
    toggle.addEventListener('click', function() {
      var paused = root.classList.toggle('is-paused');
      toggle.setAttribute('aria-label', (paused ? 'Play' : 'Pause') + ' trending courses slideshow');
    });

    if ('IntersectionObserver' in window) {
      new IntersectionObserver(function(entries) {
        root.classList.toggle('is-offscreen', !entries[0].isIntersecting);
      }).observe(root);
    }
  })();
</script>