<?php
$page_title = "About Chedo Tech | Programming Institute in Pune";
$page_description = "Chedo Tech is a Pune-based programming institute teaching offline, practical, project-based programming since 2015 — fundamentals to full stack, with personal guidance.";
$page_canonical = "https://chedo.in/about.php";
include 'includes/header.php';
?>
<main id="main">

  <section class="relative overflow-hidden border-b border-slate-100">
    <div class="bg-grid bg-grid-fade absolute inset-0" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 pb-16 pt-14 sm:px-8 lg:pb-20 lg:pt-16">
      <nav aria-label="Breadcrumb" class="mb-6">
        <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-600">
          <li><a class="transition-colors hover:text-blue-700" href="<?= cmsu('about.practical-programming-education.01', 'index.php') ?>"><?= cms('about.practical-programming-education.02', 'Home') ?></a></li>
          <li class="text-slate-300" aria-hidden="true">/</li>
          <li class="text-slate-600" aria-current="page"><?= cms('about.practical-programming-education.03', 'About') ?></li>
        </ol>
      </nav>
      <div class="max-w-3xl">
        <h1 class="mt-3 text-[clamp(2.2rem,5vw,3.75rem)] font-extrabold leading-[1.06] tracking-tight text-slate-900"><?= cms('about.practical-programming-education.04', 'Practical Programming Education') ?><br><span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent"><?= cms('about.practical-programming-education.05', 'Since 2015.') ?></span></h1>
        <p class="mt-5 max-w-2xl text-lg leading-relaxed text-slate-600">
          <?= cms('about.practical-programming-education.06', 'Chedo Tech is a programming institute & app development center in Pune that teaches programming the way it is actually learned — offline, hands-on and project-based, from fundamentals to full stack.') ?>
        </p>
      </div>
    </div>
  </section>

  <section class="py-16 sm:py-24">
    <div class="mx-auto grid max-w-7xl gap-12 px-5 sm:px-8 lg:grid-cols-2">
      <div>
        <h2 class="mt-3 text-[clamp(1.9rem,4vw,3.25rem)] font-extrabold leading-[1.1] tracking-tight text-slate-900"><?= cms('about.a-place-where-programming.01', 'A Place Where Programming Is Taught Seriously.') ?></h2>
        <div class="mt-6 space-y-5 text-[17px] leading-relaxed text-slate-600">
          <p><?= cms('about.a-place-where-programming.02', 'Since 2015, Chedo Tech has been helping students go from zero knowledge of coding to building real projects. Our classrooms are offline — whiteboard teaching, live coding, and hands-on practice with the instructor beside you. No screen-sharing, real learning.') ?></p>
          <p><?= cms('about.a-place-where-programming.03', 'We believe a well-organized curriculum and personal guidance matter as much as the topics themselves. That is why every course follows a structured path from basics to advanced topics, with printed notes, assignments, coding tests and project checkpoints at every milestone.') ?></p>
          <p><?= cms('about.a-place-where-programming.04', 'Our programs span programming languages, full stack development, data science, mobile app development, UI/UX design and kids programming — so there is a clear next step no matter where you start.') ?></p>
        </div>
      </div>
      <div class="space-y-5">
        <div class="card p-7">

          <ul class="mt-4 space-y-3.5">
            <li class="flex items-start gap-3"><span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
              </span><span class="text-[15px] font-medium text-slate-800"><?= cms('about.a-place-where-programming.05', 'Offline training at the center') ?></span></li>
            <li class="flex items-start gap-3"><span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
              </span><span class="text-[15px] font-medium text-slate-800"><?= cms('about.a-place-where-programming.06', 'Hands-on coding in every session') ?></span></li>
            <li class="flex items-start gap-3"><span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
              </span><span class="text-[15px] font-medium text-slate-800"><?= cms('about.a-place-where-programming.07', 'Real projects, not just notes') ?></span></li>
            <li class="flex items-start gap-3"><span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
              </span><span class="text-[15px] font-medium text-slate-800"><?= cms('about.a-place-where-programming.08', 'Personal guidance and mentorship') ?></span></li>
            <li class="flex items-start gap-3"><span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
              </span><span class="text-[15px] font-medium text-slate-800"><?= cms('about.a-place-where-programming.09', 'Structured curriculum with printed notes') ?></span></li>
            <li class="flex items-start gap-3"><span class="mt-0.5 flex h-7 w-7 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
              </span><span class="text-[15px] font-medium text-slate-800"><?= cms('about.a-place-where-programming.10', 'AI-assisted teaching aids') ?></span></li>
          </ul>
        </div>
        <div class="terminal">
          <div class="terminal-bar">
            <span class="win-dot bg-red-400"></span><span class="win-dot bg-amber-400"></span><span class="win-dot bg-emerald-400"></span>
            <span class="ml-2 font-mono text-[11px] text-slate-500"><?= cms('about.a-place-where-programming.11', 'chedo — who we are') ?></span>
          </div>
          <div class="terminal-body">
            <pre><span class="term-prompt">$</span> <span class="text-slate-200">what_we_do</span>
<span class="term-ok">✓</span> <span class="term-dim">offline classroom training</span>
<span class="term-ok">✓</span> <span class="term-dim">practical, project-based learning</span>
<span class="term-ok">✓</span> <span class="term-dim">personal guidance at every step</span>
<span class="term-ok">✓</span> <span class="term-dim">organized curriculum, basics → advanced</span>
<span class="term-prompt">$</span> <span class="text-slate-200">since 2015</span><span class="term-cursor"></span></pre>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="bg-surface-alt py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mx-auto text-center max-w-3xl">
        <h2 class="mt-3 text-[clamp(1.9rem,4vw,3.25rem)] font-extrabold leading-[1.12] tracking-tight text-slate-900"><?= cms('about.the-chedo-tech-classroom.01', 'The Chedo Tech Classroom.') ?></h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg leading-relaxed text-slate-600"><?= cms('about.the-chedo-tech-classroom.02', 'Six commitments that shape how every course is taught.') ?></p>
      </div>

      <div class="mt-12 grid gap-5 md:grid-cols-2 lg:grid-cols-3">
        <div class="bento-cell reveal">
          <span class="bento-icon"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <path d="M12 5v16" />
              <path d="M20.001 19A2 2 0 0022 17V5a2 2 0 00-1.999-2L16 3.002A5 5 0 0012 5a5 5 0 00-4-2H4a2 2 0 00-2 2v12a2 2 0 001.999 2H8a5 5 0 014 2 5 5 0 014-2z" />
            </svg>
          </span>
          <h3 class="mt-4 text-lg font-bold tracking-tight text-slate-900"><?= cms('about.the-chedo-tech-classroom.03', 'Organized Curriculum') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('about.the-chedo-tech-classroom.04', 'Well-structured syllabus designed for absolute clarity — from basics to advanced topics — with printed notes and live code sessions.') ?></p>
        </div>
        <div class="bento-cell reveal">
          <span class="bento-icon"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <path d="M15.914 4a1.5 1.5 0 00-2.474-1.561l-9 9A1.5 1.5 0 005.5 14h4.002a.5.5 0 01.471.666L8.086 20a1.5 1.5 0 002.475 1.56l9-9A1.5 1.5 0 0018.5 10h-3.997a.5.5 0 01-.472-.667z" />
            </svg>
          </span>
          <h3 class="mt-4 text-lg font-bold tracking-tight text-slate-900"><?= cms('about.the-chedo-tech-classroom.05', 'Practical Performance') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('about.the-chedo-tech-classroom.06', 'We focus on project-based, hands-on learning with real applications, not just theory. Every session boosts your real-world skills.') ?></p>
        </div>
        <div class="bento-cell reveal">
          <span class="bento-icon"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <path d="M18 8V6a2 2 0 0 0-2-2H4a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h8" />
              <path d="M10 19v-3.96 3.15" />
              <path d="M7 19h5" />
              <rect width="6" height="10" x="16" y="12" rx="2" />
            </svg>
          </span>
          <h3 class="mt-4 text-lg font-bold tracking-tight text-slate-900"><?= cms('about.the-chedo-tech-classroom.07', 'Mobile App Access') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('about.the-chedo-tech-classroom.08', 'Students get access to our mobile app for downloading up-to-date notes, assignments, schedules, and important announcements in one place.') ?></p>
        </div>
        <div class="bento-cell reveal">
          <span class="bento-icon"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <path d="M11.017 2.814a1 1 0 0 1 1.966 0l1.051 5.558a2 2 0 0 0 1.594 1.594l5.558 1.051a1 1 0 0 1 0 1.966l-5.558 1.051a2 2 0 0 0-1.594 1.594l-1.051 5.558a1 1 0 0 1-1.966 0l-1.051-5.558a2 2 0 0 0-1.594-1.594l-5.558-1.051a1 1 0 0 1 0-1.966l5.558-1.051a2 2 0 0 0 1.594-1.594z" />
              <path d="M20 2v4" />
              <path d="M22 4h-4" />
              <circle cx="4" cy="20" r="2" />
            </svg>
          </span>
          <h3 class="mt-4 text-lg font-bold tracking-tight text-slate-900"><?= cms('about.the-chedo-tech-classroom.09', 'AI-Powered Learning') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('about.the-chedo-tech-classroom.10', 'We enhance offline teaching with AI visualizations, diagrams, and smart boards for a deeper and more intuitive understanding of concepts.') ?></p>
        </div>
        <div class="bento-cell reveal">
          <span class="bento-icon"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
              <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
              <path d="m9 14 2 2 4-4" />
            </svg>
          </span>
          <h3 class="mt-4 text-lg font-bold tracking-tight text-slate-900"><?= cms('about.the-chedo-tech-classroom.11', 'Milestone-Based Progress') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('about.the-chedo-tech-classroom.12', 'Track your growth with regular assignments, structured practice sets, coding tests, and project checkpoints aligned with your goals.') ?></p>
        </div>
        <div class="bento-cell reveal">
          <span class="bento-icon"><!-- @license lucide-static v1.28.0 - ISC -->
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
          <h3 class="mt-4 text-lg font-bold tracking-tight text-slate-900"><?= cms('about.the-chedo-tech-classroom.13', 'In-Person Support') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('about.the-chedo-tech-classroom.14', 'Get doubts cleared instantly in offline classes. Personal guidance, real coding help, and mentorship available anytime at the center.') ?></p>
        </div>
      </div>
    </div>
  </section>

  <section class="py-16 sm:py-24">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mx-auto text-center max-w-3xl">
        <h2 class="mt-3 text-[clamp(1.9rem,4vw,3.25rem)] font-extrabold leading-[1.12] tracking-tight text-slate-900"><?= cms('about.your-path-at-chedo.01', 'Your Path at Chedo Tech.') ?></h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg leading-relaxed text-slate-600"><?= cms('about.your-path-at-chedo.02', 'From choosing a course to building real projects — the process is simple.') ?></p>
      </div>

      <ol class="mt-12 grid gap-5 md:grid-cols-3">
        <li class="card relative p-7">
          <span class="inline-flex items-center justify-center rounded-xl bg-blue-50 px-3 py-1.5 font-mono text-base font-extrabold text-blue-700" aria-hidden="true"><?= cms('about.your-path-at-chedo.03', '01') ?></span>
          <h3 class="mt-3 flex items-center gap-2 text-lg font-bold text-slate-900"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-5 w-5 text-blue-600"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M12 5v16" />
              <path d="M20.001 19A2 2 0 0022 17V5a2 2 0 00-1.999-2L16 3.002A5 5 0 0012 5a5 5 0 00-4-2H4a2 2 0 00-2 2v12a2 2 0 001.999 2H8a5 5 0 014 2 5 5 0 014-2z" />
            </svg>
            <?= cms('about.your-path-at-chedo.04', 'Choose Your Course') ?>
          </h3>
          <p class="mt-2 text-[15px] leading-relaxed text-slate-600"><?= cms('about.your-path-at-chedo.05', 'Browse from our range of offline courses — C, Python, Java, Full Stack, Data Science, Mobile App Development, and more.') ?></p>
        </li>
        <li class="card relative p-7">
          <span class="inline-flex items-center justify-center rounded-xl bg-blue-50 px-3 py-1.5 font-mono text-base font-extrabold text-blue-700" aria-hidden="true"><?= cms('about.your-path-at-chedo.06', '02') ?></span>
          <h3 class="mt-3 flex items-center gap-2 text-lg font-bold text-slate-900"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-5 w-5 text-blue-600"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round">
              <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
              <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
              <path d="m9 14 2 2 4-4" />
            </svg>
            <?= cms('about.your-path-at-chedo.07', 'Plan & Enroll Offline') ?>
          </h3>
          <p class="mt-2 text-[15px] leading-relaxed text-slate-600"><?= cms('about.your-path-at-chedo.08', 'Meet us in person, plan your curriculum, and enroll directly at our center. Get study material, notes, and a learning schedule.') ?></p>
        </li>
        <li class="card relative p-7">
          <span class="inline-flex items-center justify-center rounded-xl bg-blue-50 px-3 py-1.5 font-mono text-base font-extrabold text-blue-700" aria-hidden="true"><?= cms('about.your-path-at-chedo.09', '03') ?></span>
          <h3 class="mt-3 flex items-center gap-2 text-lg font-bold text-slate-900"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-5 w-5 text-blue-600"
              xmlns="http://www.w3.org/2000/svg"
              width="24"
              height="24"
              viewBox="0 0 24 24"
              fill="none"
              stroke="currentColor"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round">
              <path d="M12 19h8" />
              <path d="m4 17 6-6-6-6" />
            </svg>
            <?= cms('about.your-path-at-chedo.10', 'Attend, Learn & Build Projects') ?>
          </h3>
          <p class="mt-2 text-[15px] leading-relaxed text-slate-600"><?= cms('about.your-path-at-chedo.11', 'Learn practically through hands-on coding, offline mentoring, whiteboard teaching, and real project building. No screen-sharing — real learning.') ?></p>
        </li>
      </ol>
    </div>
  </section>

  <section class="border-t border-slate-100 bg-slate-50/70 py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
      <h2 class="mt-3 text-[clamp(1.8rem,3.5vw,2.75rem)] font-extrabold tracking-tight text-slate-900"><?= cms('about.one-institute-many-paths.01', 'One Institute, Many Paths') ?></h2>
      <p class="mt-3 max-w-2xl text-slate-600"><?= cms('about.one-institute-many-paths.02', 'Whatever direction you choose, the learning method is the same: offline, practical and project-based.') ?></p>
      <div class="mt-7 flex flex-wrap gap-2.5"><span class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700"><?= cms('about.one-institute-many-paths.03', 'Programming') ?></span><span class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700"><?= cms('about.one-institute-many-paths.04', 'Full Stack Development') ?></span><span class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700"><?= cms('about.one-institute-many-paths.05', 'Data Science') ?></span><span class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700"><?= cms('about.one-institute-many-paths.06', 'DSA') ?></span><span class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700"><?= cms('about.one-institute-many-paths.07', 'Mobile App Development') ?></span><span class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700"><?= cms('about.one-institute-many-paths.08', 'UI/UX') ?></span><span class="rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700"><?= cms('about.one-institute-many-paths.09', 'Kids Programming') ?></span></div>
    </div>
  </section>


  <section class="py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
      <div class="relative overflow-hidden rounded-[2rem] border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-indigo-50 px-6 py-14 text-center sm:px-12 sm:py-16">
        <div class="bg-dots absolute inset-0 opacity-40" aria-hidden="true"></div>
        <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-blue-100/50 blur-3xl" aria-hidden="true"></div>
        <div class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-cyan-100/50 blur-3xl" aria-hidden="true"></div>
        <div class="relative">
          <h2 class="mx-auto max-w-2xl text-[clamp(1.9rem,4vw,3rem)] font-extrabold leading-tight tracking-tight text-slate-900"><?= cms('about.come-see-how-we.01', 'Come See How We Teach.') ?></h2>
          <p class="mx-auto mt-4 max-w-xl text-lg leading-relaxed text-slate-600"><?= cms('about.come-see-how-we.02', 'Visit the center, meet the instructors and see the classroom for yourself — then decide.') ?></p>
          <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
            <a class="btn-primary btn-lg" href="<?= cmsu('about.come-see-how-we.03', 'contact.php') ?>"><?= cms('about.come-see-how-we.04', 'Contact Us') ?></a>
            <a class="btn-secondary btn-lg" href="<?= cmsu('about.come-see-how-we.05', 'courses.php') ?>"><?= cms('about.come-see-how-we.06', 'Browse Courses') ?></a>
          </div>

        </div>
      </div>
    </div>
  </section>


</main>

<?php include 'includes/footer.php'; ?>