<section class="bg-surface-alt py-12 sm:py-16">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="mx-auto text-center max-w-3xl">
      <p class="eyebrow font-mono text-[11px] sm:text-[12px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400"></p>
      <h2 class="mt-2 text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.from-your-first-line.01', 'From Your First Line of Code to Real Applications.') ?></h2>
      <p class="mx-auto mt-2.5 max-w-2xl text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-400"><?= cms('home.from-your-first-line.02', 'A clear path — no matter where you start, you always know what comes next.') ?></p>
    </div>

    <ol class="journey mx-auto mt-10 max-w-6xl">
      <?php foreach (cms_items('home', 'journey') as $i => $step): ?>
      <li class="j-step reveal">
        <span class="j-node"><?= sprintf('%02d', $i + 1) ?></span>
        <div class="j-card card h-full p-6">
          <p class="font-mono text-[11px] font-bold tracking-widest text-blue-600"><?= esc($step['tag']) ?></p>
          <p class="mt-2 text-[15px] font-bold leading-snug text-slate-900"><?= esc($step['title']) ?></p>
          <p class="mt-2 text-sm leading-relaxed text-slate-500"><?= esc($step['description']) ?></p>
        </div>
      </li>
      <?php endforeach; ?>
    </ol>
    <p class="mt-20 text-center lg:mt-14"><a class="arrow-link" href="<?= cmsu('home.from-your-first-line.03', 'courses.php') ?>"><?= cms('home.from-your-first-line.04', 'Find your starting point') ?> <span class="arrow"><!-- @license lucide-static v1.28.0 - ISC -->
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
        </span></a></p>
  </div>
</section>

<section class="py-12 sm:py-16">
  <div class="mx-auto flex max-w-7xl flex-col items-center gap-10 px-5 sm:px-8 text-center">
    <div>
      <p class="eyebrow font-mono text-[11px] sm:text-[12px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400"></p>
      <h2 class="mt-2 text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.you-don-t-learn.01', 'You Don\'t Learn Programming by Just Watching It.') ?></h2>
      <p class="mt-3 text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-400">
        <?= cms('home.you-don-t-learn.02', 'Chedo Tech classes are fully offline: concepts are drawn on the whiteboard, code is written live, and you practice on your own machine while the instructor is right there. Assignments, coding tests and project checkpoints keep your progress measurable at every milestone.') ?>
      </p>

    </div> <!-- close heading div -->

    <div class="w-full grid lg:grid-cols-2 gap-10 items-start text-left mt-10">
      <div class="w-full">
        <ul class="mt-8 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
          <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
                <path d="m18 16 4-4-4-4" />
                <path d="m6 8-4 4 4 4" />
                <path d="m14.5 4-5 16" />
              </svg>
            </span>
            <span class="text-sm font-semibold text-slate-800"><?= cms('home.you-don-t-learn.03', 'Live Coding') ?></span>
          </li>
          <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
                <path d="M2 3h20" />
                <path d="M21 3v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V3" />
                <path d="m7 21 5-5 5 5" />
              </svg>
            </span>
            <span class="text-sm font-semibold text-slate-800"><?= cms('home.you-don-t-learn.04', 'Whiteboard Teaching') ?></span>
          </li>
          <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
                <path d="M10 8h.01" />
                <path d="M12 12h.01" />
                <path d="M14 8h.01" />
                <path d="M16 12h.01" />
                <path d="M18 8h.01" />
                <path d="M6 8h.01" />
                <path d="M7 16h10" />
                <path d="M8 12h.01" />
                <rect width="20" height="16" x="2" y="4" rx="2" />
              </svg>
            </span>
            <span class="text-sm font-semibold text-slate-800"><?= cms('home.you-don-t-learn.05', 'Hands-On Practice') ?></span>
          </li>
          <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
                <rect width="8" height="4" x="8" y="2" rx="1" ry="1" />
                <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2" />
                <path d="m9 14 2 2 4-4" />
              </svg>
            </span>
            <span class="text-sm font-semibold text-slate-800"><?= cms('home.you-don-t-learn.06', 'Assignments') ?></span>
          </li>
          <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
                <path d="M15.39 4.39a1 1 0 0 0 1.68-.474 2.5 2.5 0 1 1 3.014 3.015 1 1 0 0 0-.474 1.68l1.683 1.682a2.414 2.414 0 0 1 0 3.414L19.61 15.39a1 1 0 0 1-1.68-.474 2.5 2.5 0 1 0-3.014 3.015 1 1 0 0 1 .474 1.68l-1.683 1.682a2.414 2.414 0 0 1-3.414 0L8.61 19.61a1 1 0 0 0-1.68.474 2.5 2.5 0 1 1-3.014-3.015 1 1 0 0 0 .474-1.68l-1.683-1.682a2.414 2.414 0 0 1 0-3.414L4.39 8.61a1 1 0 0 1 1.68.474 2.5 2.5 0 1 0 3.014-3.015 1 1 0 0 1-.474-1.68l1.683-1.682a2.414 2.414 0 0 1 3.414 0z" />
              </svg>
            </span>
            <span class="text-sm font-semibold text-slate-800"><?= cms('home.you-don-t-learn.07', 'Problem Solving') ?></span>
          </li>
          <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
                <path d="M12 15v5s3.03-.55 4-2c1.08-1.62 0-5 0-5" />
                <path d="M4.5 16.5c-1.5 1.26-2 5-2 5s3.74-.5 5-2c.71-.84.7-2.13-.09-2.91a2.18 2.18 0 0 0-2.91-.09" />
                <path d="M9 12a22 22 0 0 1 2-3.95A12.88 12.88 0 0 1 22 2c0 2.72-.78 7.5-6 11a22.4 22.4 0 0 1-4 2z" />
                <path d="M9 12H4s.55-3.03 2-4c1.62-1.08 5 .05 5 .05" />
              </svg>
            </span>
            <span class="text-sm font-semibold text-slate-800"><?= cms('home.you-don-t-learn.08', 'Project Building') ?></span>
          </li>
          <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
            </span>
            <span class="text-sm font-semibold text-slate-800"><?= cms('home.you-don-t-learn.09', 'In-Person Support') ?></span>
          </li>
          <li class="flex items-center gap-3 rounded-xl border border-slate-200/80 bg-white px-4 py-3.5">
            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
            </span>
            <span class="text-sm font-semibold text-slate-800"><?= cms('home.you-don-t-learn.10', 'Milestone-Based Progress') ?></span>
          </li>
        </ul>
      </div>
      <div class="lg:pl-8">
        <div class="code-window">
          <div class="window-bar">
            <span class="win-dot bg-red-400"></span><span class="win-dot bg-amber-400"></span><span class="win-dot bg-emerald-400"></span>
            <span class="ml-2 font-mono text-xs text-slate-500"><?= cms('home.you-don-t-learn.11', 'session.py — today in class') ?></span>
          </div>
          <div class="code-body">
            <pre><span class="ln">1</span><span class="tk-cmt"># whiteboard: what is a loop?</span>
<span class="ln">2</span><span class="tk-kw">for</span> topic <span class="tk-kw">in</span> <span class="tk-str">["basics", "logic", "projects"]</span><span class="tk-p">:</span>
<span class="ln">3</span>    <span class="tk-fn">explain</span><span class="tk-p">(</span>topic<span class="tk-p">)</span>   <span class="tk-cmt"># on the board</span>
<span class="ln">4</span>    <span class="tk-fn">code</span><span class="tk-p">(</span>topic<span class="tk-p">)</span>      <span class="tk-cmt"># live, together</span>
<span class="ln">5</span>    <span class="tk-fn">practice</span><span class="tk-p">(</span>topic<span class="tk-p">)</span>  <span class="tk-cmt"># you type</span>
<span class="ln">6</span>    <span class="tk-fn">submit</span><span class="tk-p">(</span>topic<span class="tk-p">)</span>   <span class="tk-cmt"># milestone ✓</span></pre>
          </div>
        </div>
        <div class="mt-5 flex flex-wrap gap-2.5">
          <span class="chip-tint"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-3.5 w-3.5"
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
            <?= cms('home.you-don-t-learn.12', 'Printed notes') ?></span>
          <span class="chip-tint"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-3.5 w-3.5"
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
            <?= cms('home.you-don-t-learn.13', 'Mobile app for notes & schedules') ?></span>
          <span class="chip-tint"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-3.5 w-3.5"
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
            <?= cms('home.you-don-t-learn.14', 'Doubts solved in person') ?></span>
        </div>
      </div>
    </div>

  </div>
</section>

<section class="bg-surface-alt py-12 sm:py-16">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="max-w-3xl">
      <p class="eyebrow font-mono text-[11px] sm:text-[12px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400"></p>
      <h2 class="mt-2 text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.built-around-how-students.01', 'Built Around How Students Actually Learn.') ?></h2>
      <p class="mt-2.5 max-w-2xl text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-400"><?= cms('home.built-around-how-students.02', 'Six things that make a Chedo Tech classroom different from the usual coaching class.') ?></p>
    </div>

    <style>
      .masonry-grid {
        column-count: 1;
        column-gap: 1.5rem;
      }

      @media (min-width: 640px) {
        .masonry-grid {
          column-count: 2;
        }
      }

      @media (min-width: 768px) {
        .masonry-grid {
          column-count: 3;
        }
      }

      @media (min-width: 1024px) {
        .masonry-grid {
          display: grid;
          grid-template-columns: repeat(4, 1fr);
          gap: 1.5rem;
          column-count: auto;
          /* Disable CSS columns */
        }

        .masonry-grid>div {
          margin-bottom: 0 !important;
          /* Grid handles the gap */
          height: 100%;
        }

        /* 1st column: Organized Curriculum (spans 2 rows) */
        .masonry-grid> :nth-child(1) {
          grid-column: 1;
          grid-row: 1 / span 2;
          display: flex;
          flex-direction: column;
        }

        /* 2nd column: Practical Performance & Mobile App */
        .masonry-grid> :nth-child(2) {
          grid-column: 2;
          grid-row: 1;
        }

        .masonry-grid> :nth-child(3) {
          grid-column: 2;
          grid-row: 2;
        }

        /* 3rd column: AI Learning & Milestone */
        .masonry-grid> :nth-child(4) {
          grid-column: 3;
          grid-row: 1;
        }

        .masonry-grid> :nth-child(5) {
          grid-column: 3;
          grid-row: 2;
        }

        /* 4th column: In-Person Support (spans 2 rows) */
        .masonry-grid> :nth-child(6) {
          grid-column: 4;
          grid-row: 1 / span 2;
          display: flex;
          flex-direction: column;
        }
      }
    </style>
    <div class="mt-9 masonry-grid">
      <div class="bento-cell reveal break-inside-avoid mb-6 rounded-[24px] bg-white shadow-sm ring-1 ring-black/5 hover:shadow-md transition-shadow p-6 pb-12">
        <div class="flex items-start justify-between gap-4">
          <div class="flex items-center gap-3 min-w-0">
            <span class="bento-icon shrink-0"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-3 w-3"
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
            <h3 class="text-[15px] sm:text-base font-bold tracking-tight text-slate-900 truncate"><?= cms('home.built-around-how-students.03', 'Organized Curriculum') ?></h3>
          </div>
          <span class="font-mono text-[11px] font-bold text-slate-300"><?= cms('home.built-around-how-students.04', '01') ?></span>
        </div>
        <p class="mt-2 max-w-md text-[15px] leading-relaxed text-slate-600"><?= cms('home.built-around-how-students.05', 'Structured syllabus from basics to advanced, with printed notes and live coding.') ?></p>
        <div class="mt-6 flex flex-wrap gap-2">
          <span class="chip"><?= cms('home.built-around-how-students.06', 'Printed notes') ?></span><span class="chip"><?= cms('home.built-around-how-students.07', 'Live code sessions') ?></span><span class="chip"><?= cms('home.built-around-how-students.08', 'Basics and advanced') ?></span>
        </div>
      </div>
      <div class="bento-cell reveal break-inside-avoid mb-6 rounded-[24px] bg-white shadow-sm ring-1 ring-black/5 hover:shadow-md transition-shadow p-6 pb-8">
        <div class="flex items-center gap-3 min-w-0">
          <span class="bento-icon shrink-0"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-3 w-3"
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
          <h3 class="text-[15px] sm:text-base font-bold tracking-tight text-slate-900 truncate"><?= cms('home.built-around-how-students.09', 'Practical Performance') ?></h3>
        </div>
        <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('home.built-around-how-students.10', 'Project-based classroom sessions designed around real applications, not just theory.') ?></p>
      </div>
      <div class="bento-cell reveal break-inside-avoid mb-6 rounded-[24px] bg-white shadow-sm ring-1 ring-black/5 hover:shadow-md transition-shadow p-6 pb-16">
        <div class="flex items-center gap-3 min-w-0">
          <span class="bento-icon shrink-0"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-3 w-3"
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
          <h3 class="text-[15px] sm:text-base font-bold tracking-tight text-slate-900 truncate"><?= cms('home.built-around-how-students.11', 'Mobile App Access') ?></h3>
        </div>
        <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('home.built-around-how-students.12', 'Access notes, assignments, schedules, and announcements directly via our mobile app.') ?></p>
      </div>
      <div class="bento-cell reveal break-inside-avoid mb-6 rounded-[24px] bg-white shadow-sm ring-1 ring-black/5 hover:shadow-md transition-shadow p-6 pb-10">
        <div class="flex items-center gap-3 min-w-0">
          <span class="bento-icon shrink-0"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-3 w-3"
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
          <h3 class="text-[15px] sm:text-base font-bold tracking-tight text-slate-900 truncate"><?= cms('home.built-around-how-students.13', 'AI-Powered Learning') ?></h3>
        </div>
        <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('home.built-around-how-students.14', 'Offline learning enhanced with AI diagrams, smart boards, and live code visualizers.') ?></p>
      </div>
      <div class="bento-cell reveal break-inside-avoid mb-6 rounded-[24px] bg-white shadow-sm ring-1 ring-black/5 hover:shadow-md transition-shadow p-6 pb-20">
        <div class="flex items-center gap-3 min-w-0">
          <span class="bento-icon shrink-0"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-3 w-3"
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
          <h3 class="text-[15px] sm:text-base font-bold tracking-tight text-slate-900 truncate"><?= cms('home.built-around-how-students.15', 'Milestone-Based Progress') ?></h3>
        </div>
        <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('home.built-around-how-students.16', 'Measure growth with coding worksheets, practice sets, and project milestones.') ?></p>
      </div>
      <div class="bento-cell reveal break-inside-avoid mb-6 rounded-[24px] bg-white shadow-sm ring-1 ring-black/5 hover:shadow-md transition-shadow p-6 pb-14">
        <div class="flex flex-col gap-5 items-start">
          <div class="flex items-center gap-3 min-w-0">
            <span class="bento-icon shrink-0"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-3 w-3"
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
            <h3 class="text-[15px] sm:text-base font-bold tracking-tight text-slate-900 truncate"><?= cms('home.built-around-how-students.17', 'In-Person Support') ?></h3>
          </div>
          <div>
            <p class="mt-1 max-w-3xl text-sm leading-relaxed text-slate-600"><?= cms('home.built-around-how-students.18', 'Get doubts solved instantly in-person with direct, one-on-one mentorship.') ?></p>
          </div>
          <a class="btn-secondary mt-2 shrink-0" href="<?= cmsu('home.built-around-how-students.19', 'contact.php') ?>"><?= cms('home.built-around-how-students.20', 'Talk With Us') ?></a>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="relative overflow-hidden py-24 sm:py-32">
  <div class="bg-dots absolute inset-0 opacity-30" aria-hidden="true"></div>
  <p class="absolute left-[6%] top-10 font-mono text-7xl font-black text-slate-900/[0.04] select-none" aria-hidden="true">{ }</p>
  <p class="absolute right-[8%] top-16 font-mono text-6xl font-black text-slate-900/[0.04] select-none" aria-hidden="true">
    &lt;/&gt;
  </p>
  <p class="absolute bottom-12 left-[12%] font-mono text-5xl font-black text-slate-900/[0.04] select-none" aria-hidden="true"><?= cms('home.understand.01', '01') ?></p>
  <p class="absolute bottom-16 right-[14%] font-mono text-5xl font-black text-slate-900/[0.04] select-none" aria-hidden="true"><?= cms('home.understand.02', 'SQL') ?></p>
  <p class="absolute left-[44%] top-8 hidden font-mono text-4xl font-black text-slate-900/[0.04] select-none lg:block" aria-hidden="true"><?= cms('home.understand.03', 'API') ?></p>
  <p class="absolute right-[30%] bottom-8 hidden font-mono text-4xl font-black text-slate-900/[0.04] select-none lg:block" aria-hidden="true"><?= cms('home.understand.04', 'Git') ?></p>
  <div class="relative mx-auto max-w-4xl px-5 text-center sm:px-8">
    <h2 class="text-[clamp(2.4rem,5vw,4rem)] font-extrabold leading-tight tracking-tight text-slate-900"><?= cms('home.understand.05', 'Understand.') ?> <span class="text-blue-600"><?= cms('home.understand.06', 'Practice.') ?></span> <?= cms('home.understand.07', 'Build.') ?> <span class="bg-gradient-to-r from-indigo-600 to-cyan-500 bg-clip-text text-transparent"><?= cms('home.understand.08', 'Repeat.') ?></span></h2>
    <p class="mx-auto mt-6 max-w-xl text-lg text-slate-500"><?= cms('home.understand.09', 'That is the entire method. Everything else is structure, support and consistency.') ?></p>
  </div>
</section>


<section id="projects" class="py-12 sm:py-16 scroll-mt-24">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="flex flex-col items-start justify-between gap-6 w-full">
      <div class="w-full">
        <p class="eyebrow font-mono text-[11px] sm:text-[12px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400"></p>
        <h2 class="mt-2 text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white whitespace-nowrap"><?= cms('home.your-learning-should-produce.01', 'Your Learning Should Produce Something.') ?></h2>
        <p class="mt-2.5 max-w-2xl text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-400"><?= cms('home.your-learning-should-produce.02', 'These are the kinds of applications students build while learning here — every course is built around projects you actually finish.') ?></p>
      </div>
    </div>
    <div class="mt-8 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4 sm:gap-6 items-stretch w-full">
      <?php foreach (cms_items('home', 'projects') as $project): ?>
      <div class="project-tile reveal">
        <div class="flex items-center gap-3">
          <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-500 ring-1 ring-slate-200/70"><?= cms_icon($project['icon'], 'h-5 w-5') ?></span>
          <h3 class="text-[15px] font-bold leading-snug text-slate-900"><?= esc($project['title']) ?></h3>
        </div>
        <p class="text-[13px] font-medium text-slate-500"><?= cms('home.your-learning-should-produce.03', 'Built in') ?></p>
        <a class="arrow-link mt-auto text-[10.5px] leading-tight font-semibold tracking-tight" href="<?= esc(cms_clean_url($project['link_url'])) ?>"><?= esc($project['link_label']) ?> <span class="arrow"><?= cms_icon('arrow-right', 'h-3.5 w-3.5') ?></span></a>
      </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<section class="relative overflow-hidden border-y border-slate-100 bg-slate-50/70 py-12 sm:py-16 dark:border-slate-800">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="grid items-center gap-10 lg:grid-cols-2 lg:text-left text-center">
      <div>
        <p class="eyebrow font-mono text-[11px] sm:text-[12px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400"></p>
        <h2 class="mt-2 text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.turn-data-into-understanding.01', 'Turn Data Into Understanding.') ?></h2>
        <p class="mt-3 text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-400">
          <?= cms('home.turn-data-into-understanding.02', 'From Python and Pandas to machine learning, statistics and Power BI — learn to work with real data, find patterns and build dashboards that explain real problems. Two entry points:') ?>
        </p>
        <ul class="mt-6 grid grid-cols-2 gap-5">
          <li class="card p-6 flex flex-col items-center text-center h-full min-h-[320px]">
            <p class="font-mono text-[10px] font-bold tracking-widest text-slate-500 w-full text-center mb-5 uppercase"><?= cms('home.turn-data-into-understanding.03', 'FOUNDATION') ?></p>
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-cyan-50 text-cyan-600"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 3v18" />
                <rect width="18" height="18" x="3" y="3" rx="2" />
                <path d="M3 9h18" />
                <path d="M3 15h18" />
              </svg>
            </span>
            <div class="flex flex-col flex-grow items-center w-full mt-4">
              <h3 class="text-[16px] font-bold text-slate-900"><?= cms('home.turn-data-into-understanding.04', 'Data Science Foundation') ?></h3>
              <p class="mt-2.5 text-sm leading-relaxed text-slate-500 flex-grow"><?= cms('home.turn-data-into-understanding.05', 'No prior coding needed — Python basics, data handling, visualization and creative AI skills.') ?></p>
              <a class="arrow-link mt-5 text-[13px] font-semibold" href="<?= cmsu('home.turn-data-into-understanding.06', 'courses/data-science-foundation.php') ?>"><?= cms('home.turn-data-into-understanding.07', 'Explore Foundation') ?> <span class="arrow"><!-- @license lucide-static v1.28.0 - ISC -->
                  <svg aria-hidden="true" focusable="false" class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                  </svg>
                </span></a>
            </div>
          </li>
          <li class="card p-6 flex flex-col items-center text-center h-full min-h-[320px]">
            <p class="font-mono text-[10px] font-bold tracking-widest text-slate-500 w-full text-center mb-5 uppercase"><?= cms('home.turn-data-into-understanding.08', 'COMPLETE PROGRAM') ?></p>
            <span class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-violet-50 text-violet-600"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 7H4a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z" />
                <path d="M9 15h2" />
                <path d="M15 15h2" />
                <path d="M20 7h-5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h5a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Z" />
                <path d="M12 3v18" />
              </svg>
            </span>
            <div class="flex flex-col flex-grow items-center w-full mt-4">
              <h3 class="text-[16px] font-bold text-slate-900"><?= cms('home.turn-data-into-understanding.09', 'Data Science') ?></h3>
              <p class="mt-2.5 text-sm leading-relaxed text-slate-500 flex-grow"><?= cms('home.turn-data-into-understanding.10', 'The complete program — analytics, machine learning, AI, statistics, Power BI and deployment.') ?></p>
              <a class="arrow-link mt-5 text-[13px] font-semibold" href="<?= cmsu('home.turn-data-into-understanding.11', 'courses/data-science.php') ?>"><?= cms('home.turn-data-into-understanding.12', 'Explore Data Science') ?> <span class="arrow"><!-- @license lucide-static v1.28.0 - ISC -->
                  <svg aria-hidden="true" focusable="false" class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14" />
                    <path d="m12 5 7 7-7 7" />
                  </svg>
                </span></a>
            </div>
          </li>
        </ul>
        <a class="btn-primary mt-7" href="<?= cmsu('home.turn-data-into-understanding.13', 'courses/data-science.php') ?>"><?= cms('home.turn-data-into-understanding.14', 'Explore Data Science Courses') ?></a>
      </div>

      <div class="grid gap-4 sm:grid-cols-2">
        <div class="code-window sm:col-span-2">
          <div class="window-bar">
            <span class="win-dot bg-red-400"></span><span class="win-dot bg-amber-400"></span><span class="win-dot bg-emerald-400"></span>
            <span class="ml-2 font-mono text-xs text-slate-500"><?= cms('home.turn-data-into-understanding.15', 'analysis.py') ?></span>
          </div>
          <div class="code-body">
            <pre><span class="ln">1</span><span class="tk-kw">import</span> pandas <span class="tk-kw">as</span> pd
<span class="ln">2</span><span class="ln">2</span>
<span class="ln">3</span>df <span class="tk-op">=</span> pd<span class="tk-p">.</span><span class="tk-fn">read_csv</span><span class="tk-p">(</span><span class="tk-str">"sales.csv"</span><span class="tk-p">)</span>
<span class="ln">4</span>df<span class="tk-p">.</span><span class="tk-fn">describe</span><span class="tk-p">()</span>          <span class="tk-cmt"># stats</span>
<span class="ln">5</span>df<span class="tk-p">.</span><span class="tk-fn">plot</span><span class="tk-p">(</span>kind<span class="tk-op">=</span><span class="tk-str">"bar"</span><span class="tk-p">)</span>  <span class="tk-cmt"># visualize</span>
<span class="ln">6</span>model<span class="tk-p">.</span><span class="tk-fn">fit</span><span class="tk-p">(</span>X, y<span class="tk-p">)</span>        <span class="tk-cmt"># ML</span></pre>
          </div>
        </div>
        <div class="card p-5">
          <p class="font-mono text-[10px] font-bold tracking-widest text-slate-500"><?= cms('home.turn-data-into-understanding.16', 'DATA TABLE') ?></p>
          <table class="mini-table mt-3">
            <thead>
              <tr>
                <th><?= cms('home.turn-data-into-understanding.17', 'City') ?></th>
                <th><?= cms('home.turn-data-into-understanding.18', 'Sales') ?></th>
                <th><?= cms('home.turn-data-into-understanding.19', 'Growth') ?></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?= cms('home.turn-data-into-understanding.20', 'Pune') ?></td>
                <td><?= cms('home.turn-data-into-understanding.21', '1,240') ?></td>
                <td class="text-emerald-700"><?= cms('home.turn-data-into-understanding.22', '+12%') ?></td>
              </tr>
              <tr>
                <td><?= cms('home.turn-data-into-understanding.23', 'Mumbai') ?></td>
                <td><?= cms('home.turn-data-into-understanding.24', '980') ?></td>
                <td class="text-emerald-700"><?= cms('home.turn-data-into-understanding.25', '+8%') ?></td>
              </tr>
              <tr>
                <td><?= cms('home.turn-data-into-understanding.26', 'Delhi') ?></td>
                <td><?= cms('home.turn-data-into-understanding.27', '760') ?></td>
                <td class="text-rose-600"><?= cms('home.turn-data-into-understanding.28', '-3%') ?></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="card p-5">
          <p class="font-mono text-[10px] font-bold tracking-widest text-slate-500"><?= cms('home.turn-data-into-understanding.29', 'CHART') ?></p>
          <svg viewBox="0 0 200 90" class="mt-3 w-full" role="img" aria-label="Example bar chart">
            <rect x="20" y="40" width="26" height="40" rx="4" fill="#2563EB" opacity="0.9" />
            <rect x="58" y="22" width="26" height="58" rx="4" fill="#3B82F6" opacity="0.85" />
            <rect x="96" y="10" width="26" height="70" rx="4" fill="#06B6D4" opacity="0.9" />
            <rect x="134" y="30" width="26" height="50" rx="4" fill="#6366F1" opacity="0.8" />
          </svg>
        </div>
        <div class="card flex items-center gap-3 p-4 sm:col-span-2">
          <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-blue-50 text-blue-600"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <rect width="8" height="8" x="3" y="3" rx="2" />
              <path d="M7 11v4a2 2 0 0 0 2 2h4" />
              <rect width="8" height="8" x="13" y="13" rx="2" />
            </svg>
          </span>
          <div class="flex flex-wrap items-center gap-2 font-mono text-[11px] font-semibold text-slate-500">
            <span class="rounded-md bg-slate-100 px-2 py-1 text-slate-600"><?= cms('home.turn-data-into-understanding.30', 'Data') ?></span>
            <span class="text-slate-300"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-3.5 w-3.5"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </span>
            <span class="rounded-md bg-slate-100 px-2 py-1 text-slate-600"><?= cms('home.turn-data-into-understanding.31', 'Clean') ?></span>
            <span class="text-slate-300"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-3.5 w-3.5"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </span>
            <span class="rounded-md bg-slate-100 px-2 py-1 text-slate-600"><?= cms('home.turn-data-into-understanding.32', 'Model') ?></span>
            <span class="text-slate-300"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-3.5 w-3.5"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </span>
            <span class="rounded-md bg-slate-100 px-2 py-1 text-slate-600"><?= cms('home.turn-data-into-understanding.33', 'Evaluate') ?></span>
            <span class="text-slate-300"><!-- @license lucide-static v1.28.0 - ISC -->
              <svg aria-hidden="true" focusable="false"
                class="h-3.5 w-3.5"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m9 18 6-6-6-6" />
              </svg>
            </span>
            <span class="rounded-md bg-blue-600 px-2 py-1 text-white"><?= cms('home.turn-data-into-understanding.34', 'Deploy') ?></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-12 sm:py-16">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="mx-auto max-w-3xl text-center">
      <p class="eyebrow font-mono text-[11px] sm:text-[12px] font-bold uppercase tracking-widest text-blue-600 dark:text-blue-400"></p>
      <h2 class="mt-2 text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.learn-how-complete-applications.01', 'Learn How Complete Applications Work.') ?></h2>
      <p class="mt-2.5 max-w-2xl text-[16px] sm:text-[17px] leading-relaxed text-slate-600 dark:text-slate-400 mx-auto"><?= cms('home.learn-how-complete-applications.02', 'Not just one layer — see how the frontend, API, backend and database fit together, then build that whole system yourself in the MERN or Java Full Stack course.') ?></p>
    </div>
    <div class="mt-9 flex flex-col items-stretch gap-2 lg:flex-row lg:items-stretch">

      <div class="flex flex-col lg:flex-1">
        <div class="card flex-1 p-5 text-center">
          <span class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border bg-blue-50 text-blue-600 border-blue-100"><!-- @license lucide-static v1.28.0 - ISC -->
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
          <p class="mt-3 font-mono text-[11px] font-bold tracking-widest text-slate-500"><?= cms('home.learn-how-complete-applications.03', 'FRONTEND') ?></p>
          <p class="mt-1.5 text-sm font-bold text-slate-900"><?= cms('home.learn-how-complete-applications.04', 'HTML · CSS · JavaScript · React') ?></p>
          <p class="mt-1.5 text-[13px] leading-relaxed text-slate-500"><?= cms('home.learn-how-complete-applications.05', 'The interface users see and interact with.') ?></p>
        </div>
      </div>
      <div class="flex justify-center py-1 lg:flex-col lg:py-0 lg:px-1"><span class="text-slate-300 lg:rotate-90"><!-- @license lucide-static v1.28.0 - ISC -->
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
            <path d="m6 9 6 6 6-6" />
          </svg>
        </span></div>
      <div class="flex flex-col lg:flex-1">
        <div class="card flex-1 p-5 text-center">
          <span class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border bg-indigo-50 text-indigo-600 border-indigo-100"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71" />
              <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71" />
            </svg>
          </span>
          <p class="mt-3 font-mono text-[11px] font-bold tracking-widest text-slate-500"><?= cms('home.learn-how-complete-applications.06', 'API') ?></p>
          <p class="mt-1.5 text-sm font-bold text-slate-900"><?= cms('home.learn-how-complete-applications.07', 'REST') ?></p>
          <p class="mt-1.5 text-[13px] leading-relaxed text-slate-500"><?= cms('home.learn-how-complete-applications.08', 'The contract between frontend and backend.') ?></p>
        </div>
      </div>
      <div class="flex justify-center py-1 lg:flex-col lg:py-0 lg:px-1"><span class="text-slate-300 lg:rotate-90"><!-- @license lucide-static v1.28.0 - ISC -->
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
            <path d="m6 9 6 6 6-6" />
          </svg>
        </span></div>
      <div class="flex flex-col lg:flex-1">
        <div class="card flex-1 p-5 text-center">
          <span class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border bg-cyan-50 text-cyan-600 border-cyan-100"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <rect width="20" height="8" x="2" y="2" rx="2" ry="2" />
              <rect width="20" height="8" x="2" y="14" rx="2" ry="2" />
              <line x1="6" x2="6.01" y1="6" y2="6" />
              <line x1="6" x2="6.01" y1="18" y2="18" />
            </svg>
          </span>
          <p class="mt-3 font-mono text-[11px] font-bold tracking-widest text-slate-500"><?= cms('home.learn-how-complete-applications.09', 'BACKEND') ?></p>
          <p class="mt-1.5 text-sm font-bold text-slate-900"><?= cms('home.learn-how-complete-applications.10', 'Node + Express / Java + Spring Boot') ?></p>
          <p class="mt-1.5 text-[13px] leading-relaxed text-slate-500"><?= cms('home.learn-how-complete-applications.11', 'Business logic, validation and security.') ?></p>
        </div>
      </div>
      <div class="flex justify-center py-1 lg:flex-col lg:py-0 lg:px-1"><span class="text-slate-300 lg:rotate-90"><!-- @license lucide-static v1.28.0 - ISC -->
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
            <path d="m6 9 6 6 6-6" />
          </svg>
        </span></div>
      <div class="flex flex-col lg:flex-1">
        <div class="card flex-1 p-5 text-center">
          <span class="mx-auto flex h-11 w-11 items-center justify-center rounded-xl border bg-violet-50 text-violet-600 border-violet-100"><!-- @license lucide-static v1.28.0 - ISC -->
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
              <ellipse cx="12" cy="5" rx="9" ry="3" />
              <path d="M3 5V19A9 3 0 0 0 21 19V5" />
              <path d="M3 12A9 3 0 0 0 21 12" />
            </svg>
          </span>
          <p class="mt-3 font-mono text-[11px] font-bold tracking-widest text-slate-500"><?= cms('home.learn-how-complete-applications.12', 'DATABASE') ?></p>
          <p class="mt-1.5 text-sm font-bold text-slate-900"><?= cms('home.learn-how-complete-applications.13', 'MongoDB · MySQL') ?></p>
          <p class="mt-1.5 text-[13px] leading-relaxed text-slate-500"><?= cms('home.learn-how-complete-applications.14', 'Where data is stored, queried and modeled.') ?></p>
        </div>
      </div>
    </div>
    <div class="mt-10 flex flex-col items-center justify-center gap-3 sm:flex-row">
      <a class="btn-primary" href="<?= cmsu('home.learn-how-complete-applications.15', 'courses/mern-full-stack.php') ?>"><?= cms('home.learn-how-complete-applications.16', 'Explore MERN Full Stack') ?></a>
      <a class="btn-secondary" href="<?= cmsu('home.learn-how-complete-applications.17', 'courses/java-full-stack.php') ?>"><?= cms('home.learn-how-complete-applications.18', 'Explore Java Full Stack') ?></a>
    </div>
  </div>
</section>

<section class="relative overflow-hidden bg-gradient-to-br from-cyan-50/70 via-white to-indigo-50/60 py-12 sm:py-16 dark:from-slate-900 dark:via-slate-900 dark:to-slate-800">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="grid items-stretch gap-10 lg:grid-cols-2">
      <div class="lg:z-10 relative kids-text-col">
        <h2 class="text-[30px] sm:text-[36px] lg:text-[40px] font-extrabold leading-[1.08] tracking-tight text-slate-900 dark:text-white"><?= cms('home.programming-for-young.01', 'Programming for Young') ?> <br class="hidden sm:block"><?= cms('home.programming-for-young.02', 'Creators.') ?></h2>
        <p class="mt-4 inline-flex items-center gap-2 rounded-full border border-cyan-200 bg-white px-4 py-1.5 text-sm font-bold text-cyan-700">
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
            <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2" />
            <path d="M16 3.128a4 4 0 0 1 0 7.744" />
            <path d="M22 21v-2a4 4 0 0 0-3-3.87" />
            <circle cx="9" cy="7" r="4" />
          </svg>
          <?= cms('home.programming-for-young.03', 'Ages 7-16') ?>
        </p>
        <p class="mt-5 text-lg leading-relaxed text-slate-600">
          <?= cms('home.programming-for-young.04', 'A step-by-step journey: computer basics and logic building first, then Scratch, Python, web basics, games, AI tools — and finally a complete working project. Fun and practical, with level-based progress and personal attention.') ?>
        </p>
        <ul class="mt-6 space-y-2.5 text-[15px] font-medium text-slate-700">
          <li class="flex items-center gap-2.5"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-5 w-5 text-cyan-600"
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
            <?= cms('home.programming-for-young.05', 'Fun + practical learning') ?>
          </li>
          <li class="flex items-center gap-2.5"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-5 w-5 text-cyan-600"
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
            <?= cms('home.programming-for-young.06', 'Games, animations & AI projects') ?>
          </li>
          <li class="flex items-center gap-2.5"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-5 w-5 text-cyan-600"
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
            <?= cms('home.programming-for-young.07', 'Confidence building, level by level') ?>
          </li>
        </ul>
        <a class="btn-primary mt-7 inline-block" href="<?= cmsu('home.programming-for-young.08', 'courses/kids-programming.php') ?>"><?= cms('home.programming-for-young.09', 'Explore Kids Programming') ?></a>
      </div>
      <div class="h-full">
        <style>
          @media (min-width: 1024px) {
            .kids-text-col {
              width: 120% !important; /* Forces the text to use the center gap */
              max-width: none !important;
              position: relative;
              z-index: 10;
            }
          }

          .kids-programming-image-grid {
            display: flex;
            flex-direction: column;
            gap: 16px;
            width: 80%;
            margin-left: auto;
          }

          .kids-programming-image-grid .banner-img {
            width: 100%;
            height: 175px;
            object-fit: cover;
            object-position: center;
            border-radius: 16px;
          }

          .kids-programming-subgrid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            width: 100%;
          }

          .kids-programming-subgrid img {
            width: 100%;
            height: auto;
            object-fit: contain;
            display: block;
            border-radius: 16px;
          }

          @media (max-width: 1024px) {
            .kids-programming-image-grid {
              height: 500px;
            }

            .kids-programming-image-grid .banner-img,
            .kids-programming-subgrid img {
              object-position: center;
            }
          }

          @media (max-width: 640px) {
            .kids-programming-image-grid {
              height: auto;
            }

            .kids-programming-image-grid .banner-img {
              width: 100%;
            }

            .kids-programming-subgrid {
              grid-template-columns: minmax(0, 1fr);
              gap: 12px;
            }
          }
        </style>
        <div class="kids-programming-image-grid">
          <a href="<?= cmsu('home.programming-for-young.10', 'courses/data-science-foundation-kids.php') ?>" class="block w-full transition-transform duration-300 hover:scale-[1.02]">
            <img src="assets/images/courses/Data Science Foundation For Kids.webp" alt="Data Science Foundation For Kids" width="800" height="300" class="banner-img" loading="lazy">
          </a>
          <div class="kids-programming-subgrid">
            <a href="<?= cmsu('home.programming-for-young.11', 'courses/kids-programming-level-1.php') ?>" class="block w-full transition-transform duration-300 hover:scale-[1.03]">
              <img src="assets/images/courses/Kids Programming Level 1.webp" alt="Kids Programming Level 1" width="400" height="250" loading="lazy">
            </a>
            <a href="<?= cmsu('home.programming-for-young.12', 'courses/kids-programming-level-2.php') ?>" class="block w-full transition-transform duration-300 hover:scale-[1.03]">
              <img src="assets/images/courses/Kids Programming Level 2.webp" alt="Kids Programming Level 2" width="400" height="250" loading="lazy">
            </a>
            <a href="<?= cmsu('home.programming-for-young.13', 'courses/kids-programming-level-3.php') ?>" class="block w-full transition-transform duration-300 hover:scale-[1.03]">
              <img src="assets/images/courses/Kids Programming Level 3.webp" alt="Kids Programming Level 3" width="400" height="250" loading="lazy">
            </a>
            <a href="<?= cmsu('home.programming-for-young.14', 'courses/kids-programming-level-4.php') ?>" class="block w-full transition-transform duration-300 hover:scale-[1.03]">
              <img src="assets/images/courses/Kids Programming Level 4.webp" alt="Kids Programming Level 4" width="400" height="250" loading="lazy">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

