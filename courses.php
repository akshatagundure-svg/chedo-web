<?php
$page_title = "Programming Courses in Pune | Chedo Tech";
$page_description = "Explore Chedo Tech's offline programming courses in Pune — C, C++, Java, Python, DSA, MERN, Java Full Stack, Mobile App Development, Data Science, UI/UX and Kids Programming.";
$page_canonical = "https://chedo.in/courses.php";
include 'includes/header.php';
?>
<main id="main" class="courses-page">
  <style>
    /* Remove unnecessary stretching, height fits content */
    .courses-page .grid > .card {
      height: max-content;
    }
    /* Reduce excessive bottom whitespace in the card body */
    .courses-page .grid > .card .card-body {
      padding-bottom: 16px !important;
    }
    /* Keep consistent, compact spacing above the link */
    .courses-page .grid > .card .arrow-link {
      margin-top: 16px !important;
    }
  </style>

  <section class="relative overflow-hidden border-b border-slate-100">
    <div class="bg-grid bg-grid-fade absolute inset-0" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 pb-16 pt-14 sm:px-8 lg:pb-20 lg:pt-16">
      <nav aria-label="Breadcrumb" class="mb-6">
        <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-600">
          <li><a class="transition-colors hover:text-blue-700" href="<?= cmsu('courses.courses-built-around.01', 'index.php') ?>"><?= cms('courses.courses-built-around.02', 'Home') ?></a></li>
          <li class="text-slate-300" aria-hidden="true">/</li>
          <li class="text-slate-600" aria-current="page"><?= cms('courses.courses-built-around.03', 'Courses') ?></li>
        </ol>
      </nav>
      <div class="ct-hero-grid">
        <div class="ct-hero-copy max-w-3xl">
          <h1 class="mt-3 text-[clamp(2.2rem,5vw,3.75rem)] font-extrabold leading-[1.06] tracking-tight text-slate-900"><?= cms('courses.courses-built-around.04', 'Courses Built Around') ?><br><span class="bg-gradient-to-r from-blue-600 to-cyan-500 bg-clip-text text-transparent"><?= cms('courses.courses-built-around.05', 'Real Practice.') ?></span></h1>
          <p class="mt-5 max-w-2xl text-lg leading-relaxed text-slate-600">
            <?= cms('courses.courses-built-around.06', 'You can start your programming career with zero knowledge of coding. Every course here takes you from fundamentals to building real projects — taught offline, in person, in Pune.') ?>
          </p>
          <div class="mt-7 flex flex-wrap gap-2">
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
              <?= cms('courses.courses-built-around.07', 'Offline classroom training') ?></span>
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
              <?= cms('courses.courses-built-around.08', 'Beginner friendly') ?></span>
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
              <?= cms('courses.courses-built-around.09', 'Project based') ?></span>
          </div>
          <nav class="mt-10 flex flex-wrap gap-2" aria-label="Course categories">
            <a class="chip transition-colors hover:border-blue-300 hover:text-blue-700" href="#group-programming"><?= cms('courses.courses-built-around.10', 'Programming Courses') ?></a><a class="chip transition-colors hover:border-blue-300 hover:text-blue-700" href="#group-development"><?= cms('courses.courses-built-around.11', 'Development Courses') ?></a><a class="chip transition-colors hover:border-blue-300 hover:text-blue-700" href="#group-data-ai"><?= cms('courses.courses-built-around.12', 'Data & AI Courses') ?></a><a class="chip transition-colors hover:border-blue-300 hover:text-blue-700" href="#group-design"><?= cms('courses.courses-built-around.13', 'Design') ?></a><a class="chip transition-colors hover:border-blue-300 hover:text-blue-700" href="#group-kids"><?= cms('courses.courses-built-around.14', 'Kids Programming') ?></a>
          </nav>
        </div>

        <?php include __DIR__ . '/includes/courses-trending.php'; ?>
      </div>
    </div>
  </section>

  <!-- =========================================================
     PROGRAMMING COURSES
     ========================================================= -->

  <section class="scroll-mt-24 py-10" id="group-programming">

    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mb-7 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
            <?= cms('courses.programming-courses.01', 'Programming Courses') ?>
          </h2>

          <p class="mt-1.5 max-w-xl text-[15px] text-slate-600">
            <?= cms('courses.programming-courses.02', 'Languages that build your logic and fundamentals — the right place to start.') ?>
          </p>
        </div>
        
        <div class="flex items-center gap-2 pb-1">
          <div class="relative">
            <select id="programming-filter" class="appearance-none rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-sm font-medium text-slate-700 shadow-sm outline-none transition-colors hover:border-slate-300 focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 text-center">
              <option value="all"><?= cms('courses.programming-courses.03', 'All Courses') ?></option>
              <option value="group-programming"><?= cms('courses.programming-courses.04', 'Programming Languages') ?></option>
              <option value="group-development"><?= cms('courses.programming-courses.05', 'Development') ?></option>
              <option value="group-data-ai"><?= cms('courses.programming-courses.06', 'AI & Data') ?></option>
            </select>
          </div>
        </div>
      </div>

      <script>
        document.getElementById('programming-filter').addEventListener('change', function(e) {
          const sectionId = e.target.value;
          if (sectionId !== 'all') {
            const section = document.getElementById(sectionId);
            if (section) {
              section.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
          } else {
            // Scroll to top of courses if 'All' is selected
            window.scrollTo({ top: 0, behavior: 'smooth' });
          }
        });
      </script>


      <div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-6">


        <!-- 1. JAVA + DSA -->
        <article class="card card-hover flex flex-col !p-0 overflow-hidden border-orange-100 bg-gradient-to-br from-orange-50/10 to-amber-50/5" data-category="programming">

          <div class="card-img-wrap">
            <img src="assets/images/courses/Java + DSA Foundation.webp" alt="Java + DSA Foundation" width="400" height="225" class="w-full h-full object-cover">
          </div>

          <div class="card-body flex flex-col p-3">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.programming-courses.07', 'courses/java-dsa.php') ?>"><?php echo esc(get_course_title('java-dsa', 'Java + DSA Foundation')); ?></a>
            </h3>

            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.08', 'Java Core') ?></span>
              <!-- Removed: OOP &amp; Collections. Kept here for future use. -->
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.09', 'DSA + Trees') ?></span>
              <!-- Removed: Interview Prep. Kept here for future use. -->
            </div>

            <span class="arrow-link ">
              <?= cms('courses.programming-courses.10', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" focusable="false" class="h-4 w-4"
                  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>


        <!-- 2. PYTHON + DSA -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden border-blue-100 bg-gradient-to-br from-blue-50/10 to-yellow-50/5"
          data-category="programming">
          <div class="card-img-wrap">
            <img src="assets/images/courses/Python + DSA Foundation.webp"
              alt="Python + DSA Foundation"
              width="400" height="225" class="w-full h-full object-cover">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a class="after:absolute after:inset-0" href="<?= cmsu('courses.programming-courses.11', 'courses/python-dsa.php') ?>"><?php echo esc(get_course_title('python-dsa', 'Python + DSA Foundation')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.12', 'Python Core') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.13', 'DSA Tools') ?></span>
              <!-- Removed: Complexity & Coding Patterns -->
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.programming-courses.14', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24"
                  fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- 3. C + C++ + DSA -->
        <article class="card card-hover flex flex-col !p-0 overflow-hidden border-blue-100 bg-gradient-to-br from-blue-50/10 to-indigo-50/5"
          data-category="programming">
          <div class="card-img-wrap">
            <img src="assets/images/courses/C + C++ + DSA Foundation.webp"
              alt="C + C++ + DSA Foundation"
              width="400" height="225" class="w-full h-full object-cover">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.programming-courses.15', 'courses/c-cpp-dsa.php') ?>"><?php echo esc(get_course_title('c-cpp-dsa', 'C + C++ + DSA Foundation')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.16', 'Logic Building') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.17', 'OOP + STL') ?></span>

              <!-- Removed: Interview Prep  & Data Structures & Trees. -->

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.programming-courses.18', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>


        <!-- 4. C PROGRAMMING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="programming">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/C Programming.webp"
              alt="C Programming"
              width="400" height="225" class="w-full h-full object-cover">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.programming-courses.19', 'courses/c-programming.php') ?>"><?php echo esc(get_course_title('c-programming', 'C Programming')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.20', 'Intro to Programming') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.21', 'Conditionals') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.programming-courses.22', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>


        <!-- 5. C++ PROGRAMMING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="programming">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/C++ Programming.webp"
              alt="C++ Programming"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.programming-courses.23', 'courses/cpp-programming.php') ?>"><?php echo esc(get_course_title('cpp-programming', 'C++ Programming')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.24', 'Namespaces') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.25', 'Dynamic Memory') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.programming-courses.26', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>


        <!-- 6. JAVA PROGRAMMING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="programming">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Java Programming.webp"
              alt="Java Programming"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.programming-courses.27', 'courses/java-programming.php') ?>"><?php echo esc(get_course_title('java-programming', 'Java Programming')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.28', 'Basic Syntax') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.29', 'Conditionals') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.programming-courses.30', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>


        <!-- 7. PYTHON PROGRAMMING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="programming">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Python Programming.webp"
              alt="Python Programming"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.programming-courses.31', 'courses/python-programming.php') ?>"><?php echo esc(get_course_title('python-programming', 'Python Programming')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.32', 'Data Types + Operators') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.33', 'if / elif / else') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.programming-courses.34', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>


        <!-- 8. DATA STRUCTURES -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="programming">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Data Structures & Algorithms.webp"
              alt="Data Structures & Algorithms"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.programming-courses.35', 'courses/data-structures-algorithms.php') ?>"><?php echo esc(get_course_title('data-structures', 'Data Structures & Algorithms')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.36', 'Arrays') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.programming-courses.37', 'Singly Linked List') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.programming-courses.38', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>

      </div>
    </div>

  </section>


  <!-- =========================================================
     DEVELOPMENT COURSES
     ========================================================= -->

  <section class="scroll-mt-24 py-10" id="group-development">

    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mb-7 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

        <div>

          <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
            <?= cms('courses.development-courses.01', 'Development Courses') ?>
          </h2>

          <p class="mt-1.5 max-w-xl text-[15px] text-slate-600">
            <?= cms('courses.development-courses.02', 'Complete stacks for building real applications — web and mobile.') ?>
          </p>

        </div>

      </div>


      <div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-6">


        <!-- 9. MERN -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="full-stack">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/MERN Full Stack Development.webp"
              alt="MERN Full Stack Development"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.development-courses.03', 'courses/mern-full-stack.php') ?>"><?php echo esc(get_course_title('mern-full-stack', 'MERN Full Stack Development')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.development-courses.04', 'HTML') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.development-courses.05', 'ES6+') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.development-courses.06', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>


        <!-- 10. JAVA FULL STACK -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="full-stack">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Java Full Stack Development.webp"
              alt="Java Full Stack Development"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.development-courses.07', 'courses/java-full-stack.php') ?>"><?php echo esc(get_course_title('java-full-stack', 'Java Full Stack Development')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.development-courses.08', 'Core Java') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.development-courses.09', 'Collections') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.development-courses.10', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>


        <!-- 11. MOBILE APP -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="mobile">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Mobile App Development (Flutter).webp"
              alt="Mobile App Development (Flutter)"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.development-courses.11', 'courses/mobile-app-development.php') ?>"><?php echo esc(get_course_title('mobile-app', 'Mobile App Development (Flutter)')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.development-courses.12', 'Intro to Mobile Apps') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.development-courses.13', 'Widgets + Layouts') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.development-courses.14', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>

      </div>

    </div>

  </section>


  <!-- =========================================================
     DATA & AI COURSES
     ========================================================= -->

  <section class="scroll-mt-24 py-10" id="group-data-ai">

    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mb-7 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

        <div>

          <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
            <?= cms('courses.data-ai-courses.01', 'Data & AI Courses') ?>
          </h2>

          <p class="mt-1.5 max-w-xl text-[15px] text-slate-600">
            <?= cms('courses.data-ai-courses.02', 'From data basics to machine learning, statistics and Power BI.') ?>
          </p>

        </div>

      </div>


      <div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-6">
        <!-- 12. DATA SCIENCE FOUNDATION -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="data-ai">
          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Data Science Foundation.webp"
              alt="Data Science Foundation"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>
          <div class="card-body flex flex-grow flex-col p-5">
            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.data-ai-courses.03', 'courses/data-science-foundation.php') ?>"><?php echo esc(get_course_title('data-science-foundation', 'Data Science Foundation')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.04', 'Logical Thinking') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.05', 'Variables + Loops') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.data-ai-courses.06', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- 1. DATA SCIENCE -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="data-ai">
          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Data Science.webp"
              alt="Data Science"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>
          <div class="card-body flex flex-grow flex-col p-5">
            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.data-ai-courses.07', 'courses/data-science.php') ?>"><?php echo esc(get_course_title('data-science', 'Data Science')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.08', 'Intro to Python') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.09', 'Data Persistence') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.data-ai-courses.10', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- DATA SCIENTIST -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="data-ai">
          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Data Scientist.webp"
              alt="Data Scientist"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>
          <div class="card-body flex flex-grow flex-col p-5">
            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.data-ai-courses.11', 'courses/data-scientist.php') ?>"><?php echo esc(get_course_title('data-scientist', 'Data Scientist')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.12', 'Advanced Analytics') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.13', 'Machine Learning') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.data-ai-courses.14', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- 2. ML ENGINEERING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="data-ai">
          <div class="card-img-wrap">
            <img
              src="assets/images/courses/ML Engineering.webp"
              alt="ML Engineering"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>
          <div class="card-body flex flex-grow flex-col p-5">
            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.data-ai-courses.15', 'courses/ml-engineer.php') ?>"><?php echo esc(get_course_title('ml-engineer', 'ML Engineering')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.16', 'Machine Learning') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.17', 'Data Analytics') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.data-ai-courses.18', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- 3. AI ENGINEERING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="data-ai">
          <div class="card-img-wrap">
            <img
              src="assets/images/courses/AI Engineering.webp"
              alt="AI Engineering"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>
          <div class="card-body flex flex-grow flex-col p-5">
            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.data-ai-courses.19', 'courses/ai-engineer.php') ?>"><?php echo esc(get_course_title('ai-engineer', 'AI Engineering')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.20', 'Deep Learning & NLP') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.21', 'AI Engineering') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.data-ai-courses.22', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- 4. GEN AI ENGINEERING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="data-ai">
          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Gen AI Engineering.webp"
              alt="Gen AI Engineering"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>
          <div class="card-body flex flex-grow flex-col p-5">
            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.data-ai-courses.23', 'courses/gen-ai-engineer.php') ?>"><?php echo esc(get_course_title('gen-ai-engineer', 'Gen AI Engineering')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.24', 'Generative AI') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.25', 'Deep Learning & NLP') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.data-ai-courses.26', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- 5. AGENTIC AI ENGINEERING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="data-ai">
          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Agentic AI Engineering.webp"
              alt="Agentic AI Engineering"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>
          <div class="card-body flex flex-grow flex-col p-5">
            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.data-ai-courses.27', 'courses/agentic-ai-engineer.php') ?>"><?php echo esc(get_course_title('agentic-ai-engineer', 'Agentic AI Engineering')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.28', 'Generative AI') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.29', 'AI Engineering') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.data-ai-courses.30', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- 6. DATA ENGINEERING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="data-ai">
          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Data Engineering.webp"
              alt="Data Engineering"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>
          <div class="card-body flex flex-grow flex-col p-5">
            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.data-ai-courses.31', 'courses/data-engineer.php') ?>"><?php echo esc(get_course_title('data-engineer', 'Data Engineering')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.32', 'Data Analytics') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.data-ai-courses.33', 'Machine Learning') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.data-ai-courses.34', 'Explore Course') ?>
              <span class="arrow">
                <svg aria-hidden="true" class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>
      </div>

    </div>

  </section>


  <!-- =========================================================
     DESIGN
     ========================================================= -->

  <section class="scroll-mt-24 py-10" id="group-design">

    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mb-7 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

        <div>

          <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
            <?= cms('courses.design.01', 'Design') ?>
          </h2>

          <p class="mt-1.5 max-w-xl text-[15px] text-slate-600">
            <?= cms('courses.design.02', 'Interfaces, brands and design systems with modern AI-powered tools.') ?>
          </p>

        </div>

      </div>


      <div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-6">


        <!-- 14. UI/UX DESIGN -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="design">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/UI-UX-Design.webp"
              alt="UI/UX Design"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.design.03', 'courses/ui-ux-design.php') ?>"><?php echo esc(get_course_title('ui-ux', 'UI-UX Design')); ?></a>
            </h3>

            <div class="tag-wrap">

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.design.04', 'Graphics + Social Posts') ?></span>

              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.design.05', 'Auto-Layout + Components') ?></span>

            </div>

            <span class="arrow-link mt-auto">
              <?= cms('courses.design.06', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>

          </div>
        </article>

      </div>

    </div>

  </section>


  <!-- =========================================================
     KIDS PROGRAMMING
     ========================================================= -->

  <section class="scroll-mt-24 py-10" id="group-kids">

    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mb-7 flex flex-col gap-2 sm:flex-row sm:items-end sm:justify-between">

        <div>

          <h2 class="mt-2 text-2xl font-extrabold tracking-tight text-slate-900 sm:text-3xl">
            <?= cms('courses.kids-programming.01', 'Kids Programming') ?>
          </h2>

          <p class="mt-1.5 max-w-xl text-[15px] text-slate-600">
            <?= cms('courses.kids-programming.02', 'Step-by-step coding for ages 7–16 — fun, practical and confidence-building.') ?>
          </p>

        </div>

      </div>


      <div class="grid grid-cols-2 gap-6 md:grid-cols-4 lg:grid-cols-6">


        <!-- 15. KIDS PROGRAMMING -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="kids">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Kids Programming.webp"
              alt="Kids Programming"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.kids-programming.03', 'courses/kids-programming.php') ?>"><?php echo esc(get_course_title('kids-programming', 'Kids Programming')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.kids-programming.04', 'Computer Basics') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.kids-programming.05', 'Python Basics') ?></span>

            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.kids-programming.06', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- DATA SCIENCE FOUNDATION FOR KIDS -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="kids">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Data Science Foundation For Kids.webp"
              alt="Data Science Foundation For Kids"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.kids-programming.07', 'courses/data-science-foundation-kids.php') ?>"><?php echo esc(get_course_title('data-science-foundation-kids', 'Data Science Foundation for Kids')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.kids-programming.08', 'Logical Thinking') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.kids-programming.09', 'Data Basics') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.kids-programming.10', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>

        <!-- KIDS PROGRAMMING LEVEL 1 -->
        <article
          class="card card-hover flex flex-col !p-0 overflow-hidden"
          data-category="kids">

          <div class="card-img-wrap">
            <img
              src="assets/images/courses/Kids Programming Level 1.webp"
              alt="Kids Programming Level 1"
              width="400" height="225" class="w-full h-full object-cover" loading="lazy" decoding="async">
          </div>

          <div class="card-body flex flex-grow flex-col p-5">

            <h3
              class="font-bold tracking-tight text-slate-900"
              >
              <a
                class="after:absolute after:inset-0"
                href="<?= cmsu('courses.kids-programming.11', 'courses/kids-programming-level-1.php') ?>"><?php echo esc(get_course_title('kids-programming-level-1', 'Kids Programming Level 1')); ?></a>
            </h3>
            <div class="tag-wrap">
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.kids-programming.12', 'Computer Basics') ?></span>
              <span class="rounded-md border border-slate-200 bg-transparent px-2 py-0.5 text-[10px] font-medium leading-tight text-slate-600"><?= cms('courses.kids-programming.13', 'Block Coding') ?></span>
            </div>
            <span class="arrow-link mt-auto">
              <?= cms('courses.kids-programming.14', 'Explore Course') ?>
              <span class="arrow">
                <svg
                  aria-hidden="true"
                  class="h-4 w-4"
                  viewBox="0 0 24 24"
                  fill="none"
                  stroke="currentColor"
                  stroke-width="2"
                  stroke-linecap="round"
                  stroke-linejoin="round">
                  <path d="M5 12h14" />
                  <path d="m12 5 7 7-7 7" />
                </svg>
              </span>
            </span>
          </div>
        </article>
      </div>
    </div>
  </section>

  <section class="bg-surface-alt py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mx-auto text-center max-w-3xl">
        <h2 class="mt-3 text-[clamp(1.9rem,4vw,3.25rem)] font-extrabold leading-[1.12] tracking-tight text-slate-900"><?= cms('courses.not-sure-where-to.01', 'Not Sure Where to Start?') ?></h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg leading-relaxed text-slate-600"><?= cms('courses.not-sure-where-to.02', 'Three common starting points — pick the one that matches your goal.') ?></p>
      </div>

      <div class="mt-10 grid gap-5 md:grid-cols-3">
        <div class="card card-hover relative p-6">

          <h3 class="mt-2 text-lg font-bold tracking-tight text-slate-900"><?= cms('courses.not-sure-where-to.03', 'Completely new to programming') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('courses.not-sure-where-to.04', 'Start with our Java + DSA, Python + DSA, or C + C++ + DSA Foundation courses (recommended) for strong logic and coding interviews. Or choose Python or C Programming.') ?></p>
          <p class="mt-3 text-sm"><a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.05', 'courses/java-dsa.php') ?>"><?= cms('courses.not-sure-where-to.06', 'Java + DSA') ?></a> &middot; <a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.07', 'courses/python-dsa.php') ?>"><?= cms('courses.not-sure-where-to.08', 'Python + DSA') ?></a> &middot; <a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.09', 'courses/c-cpp-dsa.php') ?>"><?= cms('courses.not-sure-where-to.10', 'C + C++ + DSA') ?></a></p>
        </div>
        <div class="card card-hover relative p-6">
          <h3 class="mt-2 text-lg font-bold tracking-tight text-slate-900"><?= cms('courses.not-sure-where-to.11', 'Want to build websites or apps') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('courses.not-sure-where-to.12', 'Go straight into MERN Full Stack, Java Full Stack or Mobile App Development — they begin with the fundamentals.') ?></p>
          <p class="mt-3 text-sm"><a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.13', 'courses/mern-full-stack.php') ?>"><?= cms('courses.not-sure-where-to.14', 'MERN Full Stack Development') ?></a> · <a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.15', 'courses/java-full-stack.php') ?>"><?= cms('courses.not-sure-where-to.16', 'Java Full Stack Development') ?></a> · <a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.17', 'courses/mobile-app-development.php') ?>"><?= cms('courses.not-sure-where-to.18', 'Mobile App Development (Flutter)') ?></a></p>
        </div>
        <div class="card card-hover relative p-6">
          <h3 class="mt-2 text-lg font-bold tracking-tight text-slate-900"><?= cms('courses.not-sure-where-to.19', 'Curious about data and AI') ?></h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('courses.not-sure-where-to.20', 'Start with Data Science Foundation (no coding needed), then move into the complete Data Science program.') ?></p>
          <p class="mt-3 text-sm"><a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.21', 'courses/data-science-foundation.php') ?>"><?= cms('courses.not-sure-where-to.22', 'Data Science Foundation') ?></a> · <a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.23', 'courses/data-science.php') ?>"><?= cms('courses.not-sure-where-to.24', 'Data Science') ?></a></p>
        </div>
      </div>
      <p class="mt-8 text-center text-[15px] text-slate-600"><?= cms('courses.not-sure-where-to.25', 'Still not sure?') ?> <a class="font-semibold text-blue-700 hover:underline" href="<?= cmsu('courses.not-sure-where-to.26', 'contact.php') ?>"><?= cms('courses.not-sure-where-to.27', 'Talk with us') ?></a> <?= cms('courses.not-sure-where-to.28', '— we will help you choose.') ?></p>
    </div>
  </section>

  <section class="py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">

      <div class="mx-auto text-center max-w-3xl">
        <h2 class="mt-3 text-[clamp(1.9rem,4vw,3.25rem)] font-extrabold leading-[1.12] tracking-tight text-slate-900"><?= cms('courses.enrolling-is-simple.01', 'Enrolling Is Simple.') ?></h2>
        <p class="mx-auto mt-4 max-w-2xl text-lg leading-relaxed text-slate-600"><?= cms('courses.enrolling-is-simple.02', 'Join Chedo Tech and master programming through fully offline, personalized training with real-world applications.') ?></p>
      </div>

      <ol class="mt-10 grid gap-5 md:grid-cols-3">
        <li class="card relative p-6">
          <span class="inline-flex items-center justify-center rounded-lg bg-blue-50 px-2.5 py-1 font-mono text-sm font-extrabold text-blue-700" aria-hidden="true"><?= cms('courses.enrolling-is-simple.03', '01') ?></span>
          <h3 class="mt-2 flex items-center gap-2 text-[15px] font-bold text-slate-900"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-4 w-4 text-blue-600"
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
            <?= cms('courses.enrolling-is-simple.04', 'Choose Your Course') ?>
          </h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('courses.enrolling-is-simple.05', 'Browse from our range of offline courses — C, Python, Java, Full Stack, Data Science, Mobile App Development, and more.') ?></p>
        </li>
        <li class="card relative p-6">
          <span class="inline-flex items-center justify-center rounded-lg bg-blue-50 px-2.5 py-1 font-mono text-sm font-extrabold text-blue-700" aria-hidden="true"><?= cms('courses.enrolling-is-simple.06', '02') ?></span>
          <h3 class="mt-2 flex items-center gap-2 text-[15px] font-bold text-slate-900"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-4 w-4 text-blue-600"
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
            <?= cms('courses.enrolling-is-simple.07', 'Plan & Enroll Offline') ?>
          </h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('courses.enrolling-is-simple.08', 'Meet us in person, plan your curriculum, and enroll directly at our center. Get study material, notes, and a learning schedule.') ?></p>
        </li>
        <li class="card relative p-6">
          <span class="inline-flex items-center justify-center rounded-lg bg-blue-50 px-2.5 py-1 font-mono text-sm font-extrabold text-blue-700" aria-hidden="true"><?= cms('courses.enrolling-is-simple.09', '03') ?></span>
          <h3 class="mt-2 flex items-center gap-2 text-[15px] font-bold text-slate-900"><!-- @license lucide-static v1.28.0 - ISC -->
            <svg aria-hidden="true" focusable="false"
              class="h-4 w-4 text-blue-600"
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
            <?= cms('courses.enrolling-is-simple.10', 'Attend, Learn & Build Projects') ?>
          </h3>
          <p class="mt-2 text-sm leading-relaxed text-slate-600"><?= cms('courses.enrolling-is-simple.11', 'Learn practically through hands-on coding, offline mentoring, whiteboard teaching, and real project building. No screen-sharing — real learning.') ?></p>
        </li>
      </ol>
    </div>
  </section>


  <section class="py-16 sm:py-20">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
      <div class="relative overflow-hidden rounded-[2rem] border border-blue-100 bg-gradient-to-br from-blue-50 via-white to-indigo-50 px-6 py-14 text-center sm:px-12 sm:py-16">
        <div class="bg-dots absolute inset-0 opacity-40" aria-hidden="true"></div>
        <div class="absolute -left-24 -top-24 h-64 w-64 rounded-full bg-blue-100/50 blur-3xl" aria-hidden="true"></div>
        <div class="absolute -bottom-24 -right-24 h-64 w-64 rounded-full bg-cyan-100/50 blur-3xl" aria-hidden="true"></div>
        <div class="relative">
          <h2 class="mx-auto max-w-2xl text-[clamp(1.9rem,4vw,3rem)] font-extrabold leading-tight tracking-tight text-slate-900"><?= cms('courses.pick-a-course-and.01', 'Pick a Course and Start Building.') ?></h2>
          <p class="mx-auto mt-4 max-w-xl text-lg leading-relaxed text-slate-600"><?= cms('courses.pick-a-course-and.02', 'Browse the catalog above — or talk with us first. We will help you plan your curriculum and learning schedule.') ?></p>
          <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
            <a class="btn-primary btn-lg" href="#group-programming"><?= cms('courses.pick-a-course-and.03', 'Browse Courses') ?></a>
            <a class="btn-secondary btn-lg" href="<?= cmsu('courses.pick-a-course-and.04', 'contact.php') ?>"><?= cms('courses.pick-a-course-and.05', 'Talk With Us') ?></a>
          </div>

        </div>
      </div>
    </div>
  </section>


</main>

<?php include 'includes/footer.php'; ?>

