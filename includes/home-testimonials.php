<section class="bg-surface-alt py-12 sm:py-16">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="mx-auto text-center max-w-3xl">
      <p class="eyebrow font-mono text-[11px] sm:text-[12px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400"></p>
      <h2 class="mt-2 text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.students-who-learned-by.01', 'Students Who Learned by Building.') ?></h2>
      <p class="mx-auto mt-2.5 max-w-2xl text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-500"><?= cms('home.students-who-learned-by.02', 'Real words from students who trained at Chedo Tech.') ?></p>
    </div>

    
    
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" media="print" onload="this.media='all'" />
    <noscript><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" /></noscript>

    <style>
      .testimonial-swiper {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
        overflow: hidden;
      }
      .testimonial-swiper .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 350px;
        height: auto;
        opacity: 0.5;
        transition: opacity 0.3s ease;
      }
      .testimonial-swiper .swiper-slide-active {
        opacity: 1;
      }
      .testimonial-swiper .swiper-button-prev,
      .testimonial-swiper .swiper-button-next {
        color: #2563eb;
        background: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
      }
      .testimonial-swiper .swiper-button-prev:after,
      .testimonial-swiper .swiper-button-next:after {
        font-size: 20px;
        font-weight: bold;
      }
      @media (max-width: 640px) {
        .testimonial-swiper .swiper-slide {
          width: 280px;
        }
      }
    
      .google-card {
        background: #ffffff;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        padding: 24px;
        display: flex;
        flex-direction: column;
        text-align: left;
        height: 100%;
        box-sizing: border-box;
      }
      .google-card-header {
        display: flex;
        align-items: center;
        gap: 16px;
        margin-bottom: 12px;
      }
      .google-card-avatar {
        width: 48px;
        height: 48px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
        flex-shrink: 0;
      }
      .av-blue { background: #dbeafe; color: #1d4ed8; }
      .av-indigo { background: #e0e7ff; color: #4338ca; }
      .av-cyan { background: #cffafe; color: #0e7490; }
      .av-violet { background: #ede9fe; color: #6d28d9; }
      .av-sky { background: #e0f2fe; color: #0369a1; }
      .av-emerald { background: #d1fae5; color: #047857; }
      
      .google-card-name {
        font-weight: 700;
        color: #0f172a;
        font-size: 16px;
        line-height: 1.2;
        margin: 0;
      }
      .google-card-date {
        color: #64748b;
        font-size: 13px;
        margin: 4px 0 0 0;
      }
      .google-card-stars {
        color: #fbbc04;
        font-size: 20px;
        letter-spacing: 2px;
        margin-bottom: 12px;
      }
      .google-card-text {
        font-size: 15px;
        color: #334155;
        line-height: 1.6;
        margin: 0 0 24px 0;
      }
      .google-card-footer {
        margin-top: auto;
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding-top: 16px;
        border-top: 1px solid #f1f5f9;
      }
      .google-card-footer-left {
        display: flex;
        align-items: center;
        gap: 8px;
      }
      .google-card-footer-text {
        font-size: 13px;
        font-weight: 500;
        color: #475569;
      }
    </style>


    <div class="swiper testimonial-swiper mt-5 group relative">
      <div class="swiper-wrapper">
        
        

      <?php
      $av_palette = ['av-blue', 'av-indigo', 'av-cyan', 'av-violet', 'av-sky', 'av-emerald'];
      foreach (cms_testimonials(12) as $r_i => $review):
        $r_words = preg_split('/\s+/', trim($review['student_name']));
        $r_initials = strtoupper(mb_substr($r_words[0], 0, 1) . (count($r_words) > 1 ? mb_substr(end($r_words), 0, 1) : ''));
      ?>
      <div class="swiper-slide"><figure class="google-card">
        <div class="google-card-header">
          <div class="google-card-avatar <?= $av_palette[$r_i % count($av_palette)] ?>"><?= esc($r_initials) ?></div>
          <div>
            <h3 class="google-card-name"><?= esc($review['student_name']) ?></h3>
            <p class="google-card-date"><?= esc($review['review_date'] ?? '') ?></p>
          </div>
        </div>
        <div class="google-card-stars"><?= str_repeat('★', max(1, min(5, (int)($review['rating'] ?? 5)))) ?></div>
        <blockquote class="google-card-text"><?= esc($review['testimonial']) ?></blockquote>
        <a href="<?= esc(cms_clean_url($review['source_url'] ?: 'https://maps.google.com/?q=Chedo+Tech+Kondhwa+Budruk+Pune')) ?>" target="_blank" rel="noopener noreferrer" class="google-card-footer" style="text-decoration: none;">
          <div class="google-card-footer-left">
            <svg style="width:20px; height:20px;" viewBox="0 0 24 24">
              <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
              <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
              <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
              <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <span class="google-card-footer-text"><?= cms('home.students-who-learned-by.03', 'View on Google') ?></span>
          </div>
          <svg style="width:20px; height:20px; color:#94a3b8;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path>
          </svg>
        </a>
      </figure></div>
      <?php endforeach; ?>
    
      
      </div>
      
      <!-- Navigation arrows -->
      <div class="swiper-button-prev opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
      <div class="swiper-button-next opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
      
      <!-- Pagination -->
      <div class="swiper-pagination mt-4"></div>
    </div>
    
    <!-- Swiper JS loaded on-demand when scrolling near testimonials -->
    <script>
      document.addEventListener("DOMContentLoaded", function() {
        var swiperContainer = document.querySelector(".testimonial-swiper");
        if (!swiperContainer) return;

        function initSwiper() {
          if (!window.Swiper) return;
          new Swiper(".testimonial-swiper", {
            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: "auto",
            loop: true,
            autoplay: {
              delay: 2000,
              disableOnInteraction: false,
            },
            coverflowEffect: {
              rotate: 0,
              stretch: -40,
              depth: 150,
              modifier: 1,
              slideShadows: false,
            },
            navigation: {
              nextEl: ".swiper-button-next",
              prevEl: ".swiper-button-prev",
            },
            pagination: {
              el: ".swiper-pagination",
              clickable: true,
            },
          });
        }

        function loadAndInit() {
          if (window.Swiper) {
            initSwiper();
            return;
          }
          var script = document.createElement("script");
          script.src = "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js";
          script.onload = initSwiper;
          document.head.appendChild(script);
        }

        if ("IntersectionObserver" in window) {
          var observer = new IntersectionObserver(function(entries, obs) {
            entries.forEach(function(entry) {
              if (entry.isIntersecting) {
                loadAndInit();
                obs.disconnect();
              }
            });
          }, { rootMargin: "300px 0px" });
          observer.observe(swiperContainer);
        } else {
          loadAndInit();
        }
      });
    </script>
  </div>
</section>

<section class="py-12 sm:py-16">
  <div class="mx-auto grid max-w-7xl items-center gap-10 px-5 sm:px-8 lg:grid-cols-2">
    <div class="relative">
      <div class="card relative overflow-hidden p-6 sm:p-8">
        <div class="bg-grid absolute inset-0 opacity-60" aria-hidden="true"></div>
        <div class="relative">
          <p class="font-mono text-xs font-bold tracking-widest text-blue-600"></p>
          <p class="mt-3 text-[clamp(1.5rem,2.5vw,2.2rem)] font-extrabold leading-tight tracking-tight text-slate-900 dark:text-white"><?= cms('home.practical-programming-education-since.01', 'Offline classes.') ?><br><?= cms('home.practical-programming-education-since.02', 'Real coding.') ?><br><?= cms('home.practical-programming-education-since.03', 'Real projects.') ?></p>
          <p class="mt-3 max-w-sm text-[15px] leading-relaxed text-slate-600 dark:text-slate-500"><?= cms('home.practical-programming-education-since.04', 'No screen-sharing, no pre-recorded lectures — a classroom where you write code with the instructor beside you.') ?></p>
          <div class="terminal mt-6">
            <div class="terminal-bar">
              <span class="win-dot bg-red-400"></span><span class="win-dot bg-amber-400"></span><span class="win-dot bg-emerald-400"></span>
              <span class="ml-2 font-mono text-[11px] text-slate-500"><?= cms('home.practical-programming-education-since.05', 'chedo-tech — Pune') ?></span>
            </div>
            <div class="terminal-body">
              <pre><span class="term-prompt">$</span> <span class="text-slate-200">chedo --since 2015 --mode offline</span>
<span class="term-ok">✓</span> <span class="term-dim">practical programming education</span>
<span class="term-ok">✓</span> <span class="term-dim">students build real projects</span>
<span class="term-ok">✓</span> <span class="term-dim">personal guidance, in person</span></pre>
            </div>
          </div>
        </div>
      </div>
      <div class="float-card -bottom-6 -right-2 hidden md:block" style="animation: float 9s ease-in-out infinite 0.5s;">
        <div class="flex items-center gap-2.5">
          <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-blue-50 text-blue-600 text-sm">🎓</span>
          <div>
            <p class="text-[13px] font-bold text-slate-900 dark:text-white"><?= cms('home.practical-programming-education-since.06', 'Since 2015') ?></p>
            <p class="text-[11px] text-slate-600 dark:text-slate-500"><?= cms('home.practical-programming-education-since.07', 'Teaching programming practically') ?></p>
          </div>
        </div>
      </div>
    </div>
    <div>
      <p class="eyebrow font-mono text-[11px] sm:text-[12px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400"></p>
      <h2 class="mt-2 text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.practical-programming-education-since.08', 'Practical Programming Education Since 2015.') ?></h2>
      <p class="mt-3 text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-500">
        <?= cms('home.practical-programming-education-since.09', 'Chedo Tech is a programming institute & app development center built on one belief: you learn to program by programming. Since 2015 we have taught offline — fundamentals to full stack — with hands-on coding, real projects and personal guidance in every class.') ?>
      </p>
      <ul class="mt-7 grid gap-3 sm:grid-cols-2">
        <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3 text-sm font-semibold text-slate-800"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-4.5 w-4.5 text-blue-600"
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
            <path d="m9 12 2 2 4-4" />
          </svg>
          <?= cms('home.practical-programming-education-since.10', 'Offline training') ?>
        </li>
        <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3 text-sm font-semibold text-slate-800"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-4.5 w-4.5 text-blue-600"
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
            <path d="m9 12 2 2 4-4" />
          </svg>
          <?= cms('home.practical-programming-education-since.11', 'Hands-on coding') ?>
        </li>
        <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3 text-sm font-semibold text-slate-800"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-4.5 w-4.5 text-blue-600"
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
            <path d="m9 12 2 2 4-4" />
          </svg>
          <?= cms('home.practical-programming-education-since.12', 'Real projects') ?>
        </li>
        <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3 text-sm font-semibold text-slate-800"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-4.5 w-4.5 text-blue-600"
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
            <path d="m9 12 2 2 4-4" />
          </svg>
          <?= cms('home.practical-programming-education-since.13', 'Personal guidance') ?>
        </li>
        <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3 text-sm font-semibold text-slate-800"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-4.5 w-4.5 text-blue-600"
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
            <path d="m9 12 2 2 4-4" />
          </svg>
          <?= cms('home.practical-programming-education-since.14', 'Structured curriculum') ?>
        </li>
        <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3 text-sm font-semibold text-slate-800"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-4.5 w-4.5 text-blue-600"
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
            <path d="m9 12 2 2 4-4" />
          </svg>
          <?= cms('home.practical-programming-education-since.15', 'In-person support') ?>
        </li>
      </ul>
      <a class="btn-primary mt-8" href="<?= cmsu('home.practical-programming-education-since.16', 'about.php') ?>"><?= cms('home.practical-programming-education-since.17', 'About Chedo Tech') ?> <span class="arrow"><!-- @license lucide-static v1.28.0 - ISC -->
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
        </span></a>
    </div>
  </div>
</section>

<section class="py-10 sm:py-14">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="relative overflow-hidden rounded-[2rem] border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-indigo-50 px-6 py-10 text-center sm:px-12 sm:py-12 dark:border-slate-800 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800">
      <div class="bg-dots absolute inset-0 opacity-40" aria-hidden="true"></div>
      <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-blue-100/50 blur-3xl" aria-hidden="true"></div>
      <div class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-cyan-100/50 blur-3xl" aria-hidden="true"></div>
      <div class="relative">
        <h2 class="mx-auto max-w-2xl text-[28px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.ready-to-start-your.01', 'Ready to Start Your Programming Journey?') ?></h2>
        <p class="mx-auto mt-3 max-w-xl text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-500"><?= cms('home.ready-to-start-your.02', 'Get personalized offline training, practical guidance and build confidence through real coding and projects.') ?></p>
        <div class="mt-6 flex flex-col items-center justify-center gap-3 sm:flex-row">
          <a class="btn-primary btn-lg" href="<?= cmsu('home.ready-to-start-your.03', 'courses.php') ?>"><?= cms('home.ready-to-start-your.04', 'Explore Courses') ?></a>
          <a class="btn-secondary btn-lg" href="<?= cmsu('home.ready-to-start-your.05', 'contact.php') ?>"><?= cms('home.ready-to-start-your.06', 'Talk With Us') ?></a>
        </div>
        <p class="mt-3 text-sm text-slate-600 dark:text-slate-500"><?= cms('home.ready-to-start-your.07', 'No prior coding knowledge required to begin.') ?></p>
      </div>
    </div>
  </div>
</section>

<section class="border-t border-slate-100 bg-slate-50/80 py-14">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="grid gap-5 md:grid-cols-3">
      <a class="card card-hover flex items-center gap-4 p-6" data-wa href="<?= cmsu('home.s14.01', 'contact.php') ?>" data-wa-text="Hello Chedo Tech, I would like to know more about your courses.">
        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-6 w-6"
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
        </span>
        <div>
          <p class="text-[15px] font-bold text-slate-900"><?= cms('home.s14.02', 'WhatsApp Enquiry') ?></p>
          <p class="text-sm text-slate-600"><?= cms('home.s14.03', 'Message us — we reply with course details.') ?></p>
        </div>
        <span class="ml-auto text-slate-300"><!-- @license lucide-static v1.28.0 - ISC -->
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
            <path d="M7 7h10v10" />
            <path d="M7 17 17 7" />
          </svg>
        </span>
      </a>
      <a class="card card-hover flex items-center gap-4 p-6" href="<?= cmsu('home.s14.04', 'contact.php') ?>">
        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
            <circle cx="12" cy="10" r="3" />
          </svg>
        </span>
        <div>
          <p class="text-[15px] font-bold text-slate-900"><?= cms('home.s14.05', 'Visit the Center') ?></p>
          <p class="text-sm text-slate-600" data-address><?= cms('home.s14.06', 'Pune — address in config') ?></p>
        </div>
        <span class="ml-auto text-slate-300"><!-- @license lucide-static v1.28.0 - ISC -->
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
            <path d="M7 7h10v10" />
            <path d="M7 17 17 7" />
          </svg>
        </span>
      </a>
      <a class="card card-hover flex items-center gap-4 p-6" href="<?= cmsu('home.s14.07', 'contact.php') ?>">
        <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-indigo-50 text-indigo-600"><!-- @license lucide-static v1.28.0 - ISC -->
          <svg aria-hidden="true" focusable="false"
            class="h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            width="24"
            height="24"
            viewBox="0 0 24 24"
            fill="none"
            stroke="currentColor"
            stroke-width="2"
            stroke-linecap="round"
            stroke-linejoin="round">
            <path d="M14.536 21.686a.5.5 0 0 0 .937-.024l6.5-19a.496.496 0 0 0-.635-.635l-19 6.5a.5.5 0 0 0-.024.937l7.93 3.18a2 2 0 0 1 1.112 1.11z" />
            <path d="m21.854 2.147-10.94 10.939" />
          </svg>
        </span>
        <div>
          <p class="text-[15px] font-bold text-slate-900"><?= cms('home.s14.08', 'Enquire Online') ?></p>
          <p class="text-sm text-slate-600"><?= cms('home.s14.09', 'Tell us your goal — we\'ll suggest the right course.') ?></p>
        </div>
        <span class="ml-auto text-slate-300"><!-- @license lucide-static v1.28.0 - ISC -->
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
            <path d="M7 7h10v10" />
            <path d="M7 17 17 7" />
          </svg>
        </span>
      </a>
    </div>
  </div>
</section>
