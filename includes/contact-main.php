<section class="relative overflow-hidden border-b border-slate-200">
  <div class="bg-grid bg-grid-fade absolute inset-0" aria-hidden="true"></div>
  <div class="relative mx-auto max-w-7xl px-5 pb-10 pt-10 sm:px-8 lg:pb-12 lg:pt-12">
    <nav aria-label="Breadcrumb" class="mb-6">
      <ol class="flex flex-wrap items-center gap-2 text-sm text-slate-600">
        <li><a class="transition-colors hover:text-blue-700" href="<?= cmsu('contact.talk-with.01', 'index.php') ?>"><?= cms('contact.talk-with.02', 'Home') ?></a></li>
        <li class="text-slate-300" aria-hidden="true">/</li>
        <li class="text-slate-600 font-medium" aria-current="page"><?= cms('contact.talk-with.03', 'Contact') ?></li>
      </ol>
    </nav>
    <div class="max-w-3xl">
      <div class="flex flex-wrap items-center gap-2.5 mb-2">
        <p class="hero-badge-pill hero-badge-red">
          <span class="dot"></span>
          <?= cms('contact.talk-with.04', 'CONTACT & ENQUIRY') ?>
        </p>
      </div>
      <h1 class="hero-headline mt-4">
        <?= cms('contact.talk-with.05', 'Talk With') ?> <span class="hero-underline"><?= cms('contact.talk-with.06', 'Us.') ?></span>
      </h1>
      <p class="mt-6 max-w-2xl text-[16px] sm:text-[17px] leading-[1.6] text-slate-700">
        <?= cms('contact.talk-with.07', 'Planning to start programming? Want batch details? Have a question about a course?') ?><br>
        <?= cms('contact.talk-with.08', 'Message us on WhatsApp, call the center, or visit us in person — we are happy to help.') ?>
      </p>
    </div>
  </div>
</section>

<!-- SECTION 2: 2x2 CONTACT CARDS (40%) + GOOGLE MAP (60%) -->
<section class="py-10 sm:py-14 bg-white">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="grid gap-8 lg:grid-cols-12 items-stretch">

      <!-- LEFT (40%): Clean 2x2 Grid of Contact Options -->
      <!-- LEFT (40%): Clean 2x2 Grid of Contact Options -->
      <div class="lg:col-span-5 flex flex-col justify-between space-y-4 lg:space-y-0">

        <div class="grid gap-4 sm:grid-cols-2 h-full">

          <!-- 1. WhatsApp -->
          <div class="card p-4 sm:p-5 flex flex-col justify-between border border-slate-200 shadow-sm rounded-xl bg-white hover:border-slate-300 transition-colors">

            <div>
              <div class="flex items-center gap-2">

                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-emerald-50 text-emerald-600 shrink-0">
                  <svg
                    aria-hidden="true"
                    focusable="false"
                    class="h-3.5 w-3.5"
                    xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round">
                    <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
                  </svg>
                </span>

                <h2
                  class="text-slate-900"
                  style="font-size:16px !important; font-weight:600 !important; line-height:1.2 !important; margin:0 !important;">
                  <?= cms('contact.whatsapp.01', 'WhatsApp') ?>
                </h2>
              </div>

              <p class="mt-2 text-xs leading-relaxed text-slate-500">
                <?= cms('contact.whatsapp.02', 'Quick answers & details.') ?>
              </p>

              <div class="mt-1.5 text-xs font-semibold text-emerald-700 truncate" data-phone>
                <?= cms('contact.whatsapp.03', '+91 87931 00815') ?>
              </div>
            </div>

            <a
              class="hero-btn-secondary w-full mt-4 !h-[34px] !text-xs !px-2 truncate text-center flex items-center justify-center"
              data-wa
              href="<?= cmsu('contact.whatsapp.04', 'https://wa.me/918793100815') ?>"
              target="_blank"
              rel="noopener"
              data-wa-text="Hello Chedo Tech, I would like to know more about your courses.">
              <?= cms('contact.whatsapp.05', 'Chat on WhatsApp') ?>
            </a>

          </div>


          <!-- 2. Phone -->
          <div class="card p-4 sm:p-5 flex flex-col justify-between border border-slate-200 shadow-sm rounded-xl bg-white hover:border-slate-300 transition-colors">

            <div>
              <div class="flex items-center gap-2">

                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-blue-50 text-blue-600 shrink-0 text-xs">
                  📞
                </span>

                <h2
                  class="text-slate-900"
                  style="font-size:16px !important; font-weight:600 !important; line-height:1.2 !important; margin:0 !important;">
                  <?= cms('contact.whatsapp.06', 'Phone') ?>
                </h2>

              </div>

              <p class="mt-2 text-xs leading-relaxed text-slate-500">
                <?= cms('contact.whatsapp.07', 'Mon–Sat: 9 AM – 9 PM.') ?>
              </p>

              <div class="mt-1.5 text-xs font-semibold text-blue-700 truncate" data-phone>
                <?= cms('contact.whatsapp.08', '+91 87931 00815') ?>
              </div>
            </div>

            <a
              class="hero-btn-secondary w-full mt-4 !h-[34px] !text-xs !px-2 truncate text-center flex items-center justify-center"
              href="<?= cmsu('contact.whatsapp.09', 'tel:+918793100815') ?>"
              data-phone-link>
              <?= cms('contact.whatsapp.10', 'Call Center') ?>
            </a>

          </div>


          <!-- 3. Visit Center -->
          <div class="card p-4 sm:p-5 flex flex-col justify-between border border-slate-200 shadow-sm rounded-xl bg-white hover:border-slate-300 transition-colors">

            <div>
              <div class="flex items-center gap-2">

                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-indigo-50 text-indigo-600 shrink-0 text-xs">
                  📍
                </span>

                <h2
                  class="text-slate-900"
                  style="font-size:16px !important; font-weight:600 !important; line-height:1.2 !important; margin:0 !important;">
                  <?= cms('contact.whatsapp.11', 'Visit Center') ?>
                </h2>

              </div>

              <p class="mt-2 text-xs leading-relaxed text-slate-500 line-clamp-2">
                <?= cms('contact.whatsapp.12', 'Ultima Business Center, Kondhwa Budruk, Pune.') ?>
              </p>
            </div>

            <a
              class="hero-btn-secondary w-full mt-4 !h-[34px] !text-xs !px-2 truncate text-center flex items-center justify-center"
              data-maps-link
              href="<?= cmsu('contact.whatsapp.13', 'https://maps.google.com/?q=Chedo+Tech+Kondhwa+Budruk+Pune') ?>"
              target="_blank"
              rel="noopener">
              <?= cms('contact.whatsapp.14', 'Open Maps') ?>
            </a>

          </div>


          <!-- 4. Email -->
          <div class="card p-4 sm:p-5 flex flex-col justify-between border border-slate-200 shadow-sm rounded-xl bg-white hover:border-slate-300 transition-colors">

            <div>
              <div class="flex items-center gap-2">

                <span class="flex h-6 w-6 items-center justify-center rounded-md bg-cyan-50 text-cyan-600 shrink-0 text-xs">
                  ✉️
                </span>

                <h2
                  class="text-slate-900"
                  style="font-size:16px !important; font-weight:600 !important; line-height:1.2 !important; margin:0 !important;">
                  <?= cms('contact.whatsapp.15', 'Email') ?>
                </h2>

              </div>

              <p class="mt-2 text-xs leading-relaxed text-slate-500">
                <?= cms('contact.whatsapp.16', 'Syllabus & queries.') ?>
              </p>

              <div class="mt-1.5 text-xs font-semibold text-cyan-700 truncate" data-email>
                <?= cms('contact.whatsapp.17', 'chetan2469@gmail.com') ?>
              </div>
            </div>

            <a
              class="hero-btn-secondary w-full mt-4 !h-[34px] !text-xs !px-2 truncate text-center flex items-center justify-center"
              href="<?= cmsu('contact.whatsapp.18', 'mailto:chetan2469@gmail.com') ?>"
              data-email-link>
              <?= cms('contact.whatsapp.19', 'Send Email') ?>
            </a>

          </div>

        </div>
      </div>

      <!-- RIGHT (60%): Large Normal Roadmap Google Map -->
      <div class="lg:col-span-7">
        <div class="card border border-slate-200 shadow-sm rounded-xl overflow-hidden h-full flex flex-col min-h-[360px] lg:min-h-[420px]">
          <div class="flex items-center justify-start border-b border-slate-200 px-5 py-3 bg-slate-50">
            <?php include __DIR__ . '/google-rating-badge.php'; ?>
          </div>
          <div class="relative flex-1 w-full bg-slate-100 min-h-[320px]">
            <iframe id="map-frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4444.879541925663!2d73.87886519999999!3d18.458559599999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2ea94eb00cb69%3A0xccd325c6e812ae0d!2sChedo%20Tech!5e0!3m2!1sen!2sin!4v1785695566881!5m2!1sen!2sin" class="absolute inset-0 h-full w-full border-0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Chedo Tech Google Maps Location"></iframe>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

<!-- SECTION 3: INTELLIGENT CAREER ROADMAP & RECOMMENDATION ASSESSMENT -->
<style>
  /* Screen-reader utility for accessible hidden inputs */
  .sr-only {
    position: absolute !important;
    width: 1px !important;
    height: 1px !important;
    padding: 0 !important;
    margin: -1px !important;
    overflow: hidden !important;
    clip: rect(0, 0, 0, 0) !important;
    white-space: nowrap !important;
    border-width: 0 !important;
  }

  /* Enhanced Interactive Tech Pill Buttons */
  .tech-pill-btn {
    border-color: #cbd5e1;
    background-color: #ffffff;
    color: #334155;
    box-shadow: 0 1px 2px rgba(15, 23, 42, 0.04);
    touch-action: manipulation;
    -webkit-tap-highlight-color: transparent;
    user-select: none;
    -webkit-user-select: none;
    cursor: pointer;
    transition: all 0.16s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .tech-pill-btn:hover {
    border-color: #93c5fd !important;
    background-color: #f8fafc !important;
    color: #1e3a8a !important;
    transform: translateY(-1px);
    box-shadow: 0 3px 8px -2px rgba(37, 99, 235, 0.12);
  }
  .tech-pill-btn:active {
    transform: translateY(0) scale(0.96);
  }
  .tech-pill-btn:focus-within {
    outline: none !important;
    box-shadow: 0 0 0 2px #ffffff, 0 0 0 4px #2563eb !important;
  }

  /* ACTIVE / SELECTED STATE */
  .tech-pill-btn.is-selected {
    border-color: #2563eb !important;
    background-color: #eff6ff !important;
    color: #1d4ed8 !important;
    font-weight: 700 !important;
    box-shadow: 0 2px 8px rgba(37, 99, 235, 0.22) !important;
  }
  .tech-pill-btn.is-selected .pill-indicator {
    background-color: #2563eb !important;
    border-color: #2563eb !important;
    color: #ffffff !important;
  }
  .tech-pill-btn.is-selected .pill-check {
    display: inline-block !important;
  }
  .tech-pill-btn.is-selected .pill-plus {
    display: none !important;
  }

  /* None option distinctive style */
  .tech-pill-btn.tech-pill-none.is-selected {
    border-color: #d97706 !important;
    background-color: #fffbeb !important;
    color: #b45309 !important;
  }
  .tech-pill-btn.tech-pill-none.is-selected .pill-indicator {
    background-color: #d97706 !important;
    border-color: #d97706 !important;
    color: #ffffff !important;
  }

  /* Custom styled selects */
  .form-select-custom {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2364748b' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
    background-position: right 0.75rem center;
    background-repeat: no-repeat;
    background-size: 1.25em 1.25em;
    padding-right: 2.5rem;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
  }
</style>

<section id="enquireForm" class="py-12 sm:py-16 bg-[#f8fafc] border-y border-slate-200">
  <div class="mx-auto max-w-[1360px] px-4 sm:px-6 lg:px-8">
    <!-- Notice: Using enquiry-form-card instead of card to prevent global card-click redirect hijacking -->
    <div class="enquiry-form-card p-6 sm:p-10 lg:p-12 shadow-sm border border-slate-200 rounded-3xl bg-white">
      <div class="text-center max-w-2xl mx-auto">
        <p class="hero-badge-pill hero-badge-red !h-[28px] !px-3 !text-[11px] mb-4">
          <span class="dot"></span>
          <?= cms('contact.send-us-an-enquiry.01', 'CAREER ASSESSMENT & RECOMMENDATION') ?>
        </p>
        <h2 class="hero-headline !text-[30px] sm:!text-[36px]"><?= cms('contact.send-us-an-enquiry.02', 'Personalized Career Roadmap') ?></h2>
        <p class="mt-3 text-[14px] sm:text-[15px] leading-relaxed text-slate-600">
          <?= cms('contact.send-us-an-enquiry.03', 'Complete our 5-question skill assessment to get a personalized learning roadmap, skill-gap analysis, recommended Chedo courses, and a customized daily study schedule.') ?>
        </p>
      </div>
      <?php $enquiry_msg = $_GET['msg'] ?? ''; ?>
      <?php if ($enquiry_msg === 'success'): ?>
        <p class="mt-6 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-center text-sm font-semibold text-emerald-700" role="status"><?= cms('contact.send-us-an-enquiry.04', 'Thank you! Your assessment has been received. Our team will contact you shortly.') ?></p>
      <?php elseif ($enquiry_msg === 'error'): ?>
        <p class="mt-6 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-center text-sm font-semibold text-amber-800" role="alert"><?= cms('contact.send-us-an-enquiry.05', 'Sorry, we couldn\'t process your assessment. Please fill in your name and phone number, or message us on WhatsApp.') ?></p>
      <?php endif; ?>

      <form id="enquiry-form" method="post" action="/enquire-submit.php" class="mt-8" novalidate>

        <!-- Group 1: Student Information -->
        <div class="mb-8 p-5 sm:p-6 rounded-xl border border-slate-200 bg-slate-50/50">
          <div class="flex items-center gap-2.5 mb-4">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-blue-100 text-blue-700 text-xs font-bold shrink-0">1</span>
            <div>
              <h3 class="text-[15px] font-bold text-slate-900"><?= cms('contact.send-us-an-enquiry.06', 'Your Details') ?></h3>
              <p class="text-xs text-slate-500">Provide your contact info so mentors can share your roadmap.</p>
            </div>
          </div>
          <div class="grid gap-x-5 gap-y-4 sm:grid-cols-2 lg:grid-cols-4">
            <div>
              <label class="block text-[13px] font-semibold text-slate-700 mb-1" for="f-name"><?= cms('contact.send-us-an-enquiry.07', 'Full Name *') ?></label>
              <input required class="w-full h-[44px] px-3.5 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-name" name="name" type="text" placeholder="e.g. Rohan Deshmukh" autocomplete="name">
            </div>
            <div>
              <label class="block text-[13px] font-semibold text-slate-700 mb-1" for="f-phone"><?= cms('contact.send-us-an-enquiry.08', 'Phone Number (WhatsApp) *') ?></label>
              <input required class="w-full h-[44px] px-3.5 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-phone" name="phone" type="tel" placeholder="e.g. 98765 43210" autocomplete="tel">
            </div>
            <div>
              <label class="block text-[13px] font-semibold text-slate-700 mb-1" for="f-email">Email Address <span class="text-xs text-slate-400 font-normal">(Optional)</span></label>
              <input class="w-full h-[44px] px-3.5 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-email" name="email" type="email" placeholder="e.g. rohan@example.com" autocomplete="email">
            </div>
            <div class="grid grid-cols-2 gap-3">
              <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-1" for="f-education"><?= cms('contact.send-us-an-enquiry.10', 'Education *') ?></label>
                <select required class="form-select-custom w-full h-[44px] px-3 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-education" name="education">
                  <option value="">Select</option>
                  <option value="10th">10th</option>
                  <option value="12th">12th</option>
                  <option value="Diploma">Diploma</option>
                  <option value="Bachelor's" selected>Bachelor's (BE/BTech/BCA/BSc)</option>
                  <option value="Master's">Master's (ME/MTech/MCA/MSc)</option>
                  <option value="Working Professional">Working Professional</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div>
                <label class="block text-[13px] font-semibold text-slate-700 mb-1" for="f-age"><?= cms('contact.send-us-an-enquiry.09', 'Age') ?></label>
                <input class="w-full h-[44px] px-3 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-age" name="age" type="number" min="5" max="100" placeholder="e.g. 21">
              </div>
            </div>
          </div>
        </div>

        <!-- Group 2: Skill & Roadmap Assessment (Questions 1 - 5) -->
        <div class="mb-8 p-5 sm:p-6 rounded-xl border border-slate-200 bg-white shadow-xs">
          <div class="flex items-center gap-2.5 mb-5 pb-3 border-b border-slate-100">
            <span class="flex h-7 w-7 items-center justify-center rounded-lg bg-indigo-100 text-indigo-700 text-xs font-bold shrink-0">2</span>
            <div>
              <h3 class="text-[15px] font-bold text-slate-900">Career &amp; Skill Assessment</h3>
              <p class="text-xs text-slate-500">Answer 5 quick questions to calculate your personalized career blueprint.</p>
            </div>
          </div>

          <div class="grid gap-x-6 gap-y-6 sm:grid-cols-2">
            <!-- Question 1: Current Learning Level -->
            <div>
              <div class="flex items-center gap-2 mb-1.5">
                <span class="inline-flex items-center justify-center h-5 px-2 rounded-md bg-blue-100 text-blue-700 text-[11px] font-bold">Q1</span>
                <label class="block text-[13px] font-semibold text-slate-800" for="f-learning-level">
                  Current Learning Level *
                </label>
              </div>
              <p class="text-xs text-slate-500 mb-2">Select your existing coding background</p>
              <select required class="form-select-custom w-full h-[44px] px-3.5 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-learning-level" name="learning_level">
                <option value="">— Select Your Level —</option>
                <option value="Complete Beginner">Complete Beginner (No prior coding)</option>
                <option value="Know Basic Programming" selected>Know Basic Programming (Loops, Functions, Basic Syntax)</option>
                <option value="Intermediate">Intermediate (Built basic projects / know OOP &amp; DS)</option>
                <option value="Advanced / Working Professional">Advanced / Working Professional</option>
              </select>
            </div>

            <!-- Question 2: Career Goal -->
            <div>
              <div class="flex items-center gap-2 mb-1.5">
                <span class="inline-flex items-center justify-center h-5 px-2 rounded-md bg-blue-100 text-blue-700 text-[11px] font-bold">Q2</span>
                <label class="block text-[13px] font-semibold text-slate-800" for="f-career-goal">
                  Target Career Goal *
                </label>
              </div>
              <p class="text-xs text-slate-500 mb-2">Select your primary role objective</p>
              <select required class="form-select-custom w-full h-[44px] px-3.5 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-career-goal" name="career_goal">
                <option value="">— Select Target Career —</option>
                <option value="Java Full Stack Developer" selected>Java Full Stack Developer</option>
                <option value="MERN Full Stack Developer">MERN Full Stack Developer</option>
                <option value="Software Developer">Software Developer (General / SDE)</option>
                <option value="Mobile App Developer">Mobile App Developer (Flutter)</option>
                <option value="Data Analyst">Data Analyst</option>
                <option value="Data Scientist">Data Scientist</option>
                <option value="AI / ML Engineer">AI / ML Engineer</option>
                <option value="Data Engineer">Data Engineer</option>
                <option value="Generative AI Engineer">Generative AI Engineer</option>
                <option value="Agentic AI Engineer">Agentic AI Engineer</option>
                <option value="UI/UX Designer">UI/UX Designer</option>
                <option value="Not Sure Yet">Not Sure Yet (Need Mentor Guidance)</option>
              </select>
            </div>

            <!-- Question 3: Technologies Already Known (Multi-select) -->
            <div class="sm:col-span-2">
              <div class="flex flex-wrap items-center justify-between gap-2 mb-2">
                <div class="flex items-center gap-2">
                  <span class="inline-flex items-center justify-center h-5 px-2 rounded-md bg-blue-100 text-blue-700 text-[11px] font-bold">Q3</span>
                  <label class="text-[13px] font-bold text-slate-900">
                    Technologies Already Known <span class="text-xs text-slate-500 font-normal">(Select all that apply)</span>
                  </label>
                </div>
                <span id="tech-selection-count" class="text-[11px] font-semibold text-slate-600 bg-slate-100 px-3 py-1 rounded-full border border-slate-200 transition-all">
                  0 Selected
                </span>
              </div>
              <p class="text-xs text-slate-500 mb-3">
                Click any technology you have practiced. Clicking a selected technology deselects it. Selecting "None" clears individual languages.
              </p>

              <div id="tech-selector" class="flex flex-wrap gap-2.5 sm:gap-3 p-4 sm:p-5 rounded-2xl border border-slate-200 bg-slate-50/80 shadow-xs" role="group" aria-label="Technologies Already Known">
                <?php
                $availableTechs = [
                    'C' => 'C',
                    'C++' => 'C++',
                    'Java' => 'Java',
                    'Python' => 'Python',
                    'HTML' => 'HTML',
                    'CSS' => 'CSS',
                    'JavaScript' => 'JavaScript',
                    'React' => 'React',
                    'SQL / MySQL' => 'SQL / MySQL',
                    'MongoDB' => 'MongoDB',
                    'DSA' => 'DSA',
                    'Spring Boot' => 'Spring Boot',
                    'None' => 'None (Beginner)'
                ];
                foreach ($availableTechs as $val => $label): 
                  $isNone = ($val === 'None');
                ?>
                  <label class="tech-pill-btn group relative inline-flex items-center gap-2 px-3.5 sm:px-4 py-2 sm:py-2.5 rounded-xl text-xs sm:text-[13px] font-medium border-2 cursor-pointer select-none transition-all duration-150 <?= $isNone ? 'tech-pill-none' : '' ?>">
                    <input type="checkbox" name="known_technologies[]" value="<?= htmlspecialchars($val) ?>" class="tech-checkbox sr-only" tabindex="0" aria-label="<?= htmlspecialchars($label) ?>">
                    <span class="pill-indicator flex h-4 w-4 shrink-0 items-center justify-center rounded-full text-[10px] font-bold transition-all border border-slate-300 bg-white text-slate-400 group-hover:border-blue-400 group-hover:text-blue-500">
                      <span class="pill-check hidden font-bold">✓</span>
                      <span class="pill-plus text-[11px] font-semibold leading-none">+</span>
                    </span>
                    <span class="pill-title tracking-tight"><?= htmlspecialchars($label) ?></span>
                  </label>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Question 4: Primary Learning Objective -->
            <div>
              <div class="flex items-center gap-2 mb-1.5">
                <span class="inline-flex items-center justify-center h-5 px-2 rounded-md bg-blue-100 text-blue-700 text-[11px] font-bold">Q4</span>
                <label class="block text-[13px] font-semibold text-slate-800" for="f-learning-objective">
                  Primary Learning Objective *
                </label>
              </div>
              <p class="text-xs text-slate-500 mb-2">What is your immediate goal?</p>
              <select required class="form-select-custom w-full h-[44px] px-3.5 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-learning-objective" name="learning_objective">
                <option value="">— Select Objective —</option>
                <option value="Job and interview preparation" selected>Job and interview preparation</option>
                <option value="Learn programming fundamentals">Learn programming fundamentals</option>
                <option value="Improve problem-solving / DSA">Improve problem-solving / DSA</option>
                <option value="Build real-world projects">Build real-world projects</option>
                <option value="Career switching">Career switching</option>
                <option value="Explore new technologies">Explore new technologies</option>
              </select>
            </div>

            <!-- Question 5: Daily Learning Availability -->
            <div>
              <div class="flex items-center gap-2 mb-1.5">
                <span class="inline-flex items-center justify-center h-5 px-2 rounded-md bg-blue-100 text-blue-700 text-[11px] font-bold">Q5</span>
                <label class="block text-[13px] font-semibold text-slate-800" for="f-daily-availability">
                  Daily Learning Availability *
                </label>
              </div>
              <p class="text-xs text-slate-500 mb-2">Hours you can allocate per day</p>
              <select required class="form-select-custom w-full h-[44px] px-3.5 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-daily-availability" name="daily_availability">
                <option value="">— Select Hours —</option>
                <option value="Less than 1 hour">Less than 1 hour</option>
                <option value="1–2 hours">1–2 hours</option>
                <option value="2–4 hours" selected>2–4 hours (Recommended)</option>
                <option value="More than 4 hours">More than 4 hours (Intensive)</option>
              </select>
            </div>

            <!-- Optional Message -->
            <div class="sm:col-span-2">
              <label class="block text-[13px] font-semibold text-slate-700 mb-1" for="f-message">Specific Target Companies or Background <span class="text-xs text-slate-400 font-normal">(Optional)</span></label>
              <textarea class="w-full px-3.5 py-2.5 rounded-lg border border-slate-300 bg-white text-[14px] text-slate-900 shadow-xs focus:border-blue-600 focus:ring-3 focus:ring-blue-100 transition-all outline-none" id="f-message" name="message" rows="2" placeholder="e.g. Preparing for TCS / Infosys NQT, product company interviews, or college placement drive"></textarea>
            </div>
          </div>
        </div>

        <div class="text-center mt-2 pt-2">
          <button id="btn-get-recommendation" type="submit" class="hero-btn-primary w-full sm:w-auto !px-8 !py-3.5 shadow-md hover:shadow-lg transition-all">
            <span>Generate My Career Roadmap</span>
            <svg aria-hidden="true" focusable="false" class="h-4 w-4 ml-2 inline transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M5 12h14" />
              <path d="m12 5 7 7-7 7" />
            </svg>
          </button>
          <p class="mt-3 text-[12px] leading-relaxed text-slate-500">
            🔒 Instant personalized skill-gap analysis &amp; learning roadmap stored in our database.
          </p>
          <p id="form-note" class="hidden mt-3 rounded-xl border border-amber-200 bg-amber-50 px-4 py-3 text-[13px] font-medium leading-relaxed text-amber-800"></p>
        </div>
      </form>

      <!-- UPGRADED COMPREHENSIVE RECOMMENDATION RESULTS SECTION -->
      <div id="recommendation-results" class="hidden mt-10 sm:mt-12 transition-all">

        <!-- A. Header & Career Profile Summary -->
        <div class="text-center mb-8 border-b border-slate-100 pb-8">
          <div class="inline-flex items-center gap-2 rounded-full bg-blue-50 px-3.5 py-1 text-xs font-semibold text-blue-700 mb-3 border border-blue-100">
            <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
            Personalized Career Blueprint
          </div>
          <h3 id="res-career-title" class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight"></h3>
          <p class="text-slate-600 mt-2 text-sm sm:text-[15px] max-w-xl mx-auto leading-relaxed">
            Here is your personalized roadmap, skill-gap breakdown, recommended Chedo courses, and daily study schedule based on your profile.
          </p>

          <!-- Profile Badges Grid -->
          <div id="res-profile-meta" class="mt-6 flex flex-wrap items-center justify-center gap-2 sm:gap-2.5 max-w-3xl mx-auto text-xs">
            <!-- Injected by JS -->
          </div>
        </div>

        <!-- B. Skill-Gap Analysis -->
        <div class="mb-10 p-6 sm:p-7 rounded-2xl bg-slate-50/70 border border-slate-200 shadow-xs">
          <div class="flex flex-wrap items-center justify-between gap-2 mb-5">
            <div class="flex items-center gap-2.5">
              <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-100 text-blue-700 text-sm font-bold">📊</div>
              <div>
                <h4 class="text-base sm:text-[17px] font-bold text-slate-900 tracking-tight">Skill-Gap Analysis</h4>
                <p class="text-xs text-slate-500">Benchmark against target career requirements</p>
              </div>
            </div>
          </div>

          <div class="grid gap-4 sm:grid-cols-3">
            <!-- Already Known -->
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-emerald-200/80 shadow-xs flex flex-col justify-between">
              <div>
                <div class="flex items-center gap-2 text-emerald-800 font-bold text-xs mb-3 uppercase tracking-wide">
                  <span class="h-2 w-2 rounded-full bg-emerald-500"></span> Already Known
                </div>
                <div id="gap-already-known" class="flex flex-wrap gap-1.5">
                  <!-- Pills injected by JS -->
                </div>
              </div>
            </div>

            <!-- Needs Revision -->
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-amber-200/80 shadow-xs flex flex-col justify-between">
              <div>
                <div class="flex items-center gap-2 text-amber-800 font-bold text-xs mb-3 uppercase tracking-wide">
                  <span class="h-2 w-2 rounded-full bg-amber-500"></span> Needs Revision
                </div>
                <div id="gap-needs-revision" class="flex flex-wrap gap-1.5">
                  <!-- Pills injected by JS -->
                </div>
              </div>
            </div>

            <!-- Needs to Learn -->
            <div class="p-4 sm:p-5 rounded-xl bg-white border border-blue-200/80 shadow-xs flex flex-col justify-between">
              <div>
                <div class="flex items-center gap-2 text-blue-800 font-bold text-xs mb-3 uppercase tracking-wide">
                  <span class="h-2 w-2 rounded-full bg-blue-500"></span> Needs to Learn
                </div>
                <div id="gap-needs-to-learn" class="flex flex-wrap gap-1.5">
                  <!-- Pills injected by JS -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <!-- C. Visual Learning Roadmap (Inspired by Serpentine Highway Reference) -->
        <div class="mb-12 roadmap-wrapper-card" id="roadmap-card-section">
          <div class="roadmap-header">
            <div class="roadmap-badge">
              <svg class="w-3.5 h-3.5 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM10.05 15a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd" />
              </svg>
              <span>Milestone Learning Journey</span>
            </div>
            <h4 class="roadmap-title">Personalized Career Roadmap</h4>
            <p class="roadmap-subtitle">Follow this step-by-step milestone path designed to take you from foundational concepts to enterprise placement readiness.</p>
          </div>

          <div class="roadmap-flow-container" id="roadmap-flow-container">
            <!-- Highway Road SVG -->
            <svg viewBox="0 0 1400 650" preserveAspectRatio="none" class="w-full h-full absolute inset-0 pointer-events-none roadmap-highway-svg" id="highway-svg" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
              <defs>
                <filter id="road-shadow-filter" x="-10%" y="-20%" width="120%" height="150%">
                  <feDropShadow dx="0" dy="8" stdDeviation="6" flood-color="#0f172a" flood-opacity="0.25" />
                </filter>
              </defs>
              <!-- Hidden compatibility paths for scripts referencing shadow/curb -->
              <path id="road-path-shadow" fill="none" stroke="transparent" stroke-width="0" style="display:none;"></path>
              <path id="road-path-curb" fill="none" stroke="transparent" stroke-width="0" style="display:none;"></path>
              <!-- Base Track: Thick dark charcoal asphalt stroke with elevated 3D shadow -->
              <path id="road-path-surface" fill="none" stroke="#1E232A" stroke-width="48" stroke-linecap="round" stroke-linejoin="round" filter="url(#road-shadow-filter)" d="M 20 320 C 73.5 320, 84.2 255, 127 255 C 254 255, 254 395, 381 395 C 508 395, 508 255, 635 255 C 762 255, 762 395, 889 395 C 1016 395, 1016 255, 1143 255 C 1239 255, 1258 325, 1335 325"></path>
              <!-- Center Divider: Crisp dashed white lane marking -->
              <path id="road-path-dash" fill="none" stroke="#FFFFFF" stroke-width="3" stroke-dasharray="10 10" stroke-linecap="round" stroke-linejoin="round" d="M 20 320 C 73.5 320, 84.2 255, 127 255 C 254 255, 254 395, 381 395 C 508 395, 508 255, 635 255 C 762 255, 762 395, 889 395 C 1016 395, 1016 255, 1143 255 C 1239 255, 1258 325, 1335 325"></path>
            </svg>

            <!-- Stages Container: ID matches existing 'roadmap-timeline' so JS targets it cleanly -->
            <div id="roadmap-timeline" class="roadmap-stages-wrapper">
              <!-- Stages dynamically injected by JS -->
            </div>

            <!-- Final Goal Milestone -->
            <div class="roadmap-goal-wrap" id="roadmap-goal-wrap">
              <div class="roadmap-goal-icon" aria-hidden="true">🏆</div>
              <div class="roadmap-goal-title">Placement Ready</div>
              <div class="roadmap-goal-subtitle">Career Transition Complete</div>
            </div>
          </div>
        </div>

        <!-- Interactive Stage Details Modal -->
        <div class="stage-modal-backdrop" id="roadmap-stage-modal" aria-hidden="true">
          <div class="stage-modal-card" role="dialog" aria-modal="true">
            <div class="stage-modal-header">
              <button class="stage-modal-close" id="stage-modal-close-btn" type="button" aria-label="Close stage details">&times;</button>
              <div class="stage-modal-tag" id="stage-modal-tag">STAGE 01</div>
              <h4 class="stage-modal-title" id="stage-modal-title">FOUNDATION: Java &amp; DSA Revision</h4>
              <div class="stage-modal-meta">
                <span class="stage-duration-tag" id="stage-modal-duration">⏱ 4–5 Weeks</span>
              </div>
            </div>
            <div class="stage-modal-body">
              <div>
                <div class="modal-section-title">Overview &amp; Objectives</div>
                <p class="stage-modal-desc" id="stage-modal-desc"></p>
              </div>
              <div>
                <div class="modal-section-title">Key Technologies &amp; Skills Covered</div>
                <div class="stage-modal-skills" id="stage-modal-skills"></div>
              </div>
              <div>
                <div class="modal-section-title">Practical Project Milestone</div>
                <div class="stage-modal-milestone" id="stage-modal-milestone"></div>
              </div>
              <div id="stage-modal-reason-box" style="display:none;">
                <div class="modal-section-title">Why This Stage Is Critical</div>
                <div class="stage-modal-reason" id="stage-modal-reason"></div>
              </div>
            </div>
            <div class="stage-modal-footer">
              <button class="stage-nav-btn" id="stage-modal-prev-btn" type="button">&larr; Previous Stage</button>
              <div id="stage-modal-action-box"></div>
              <button class="stage-nav-btn" id="stage-modal-next-btn" type="button">Next Stage &rarr;</button>
            </div>
          </div>
        </div>

        <!-- D. Recommended Chedo Courses -->
        <div class="mb-10">
          <div class="flex items-center gap-2.5 mb-5">
            <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-100 text-blue-700 text-sm font-bold">🎓</div>
            <div>
              <h4 class="text-base sm:text-[17px] font-bold text-slate-900 tracking-tight">Recommended Chedo Tech Courses</h4>
              <p class="text-xs text-slate-500">Curated programs designed to close your specific skill gaps</p>
            </div>
          </div>
          <div id="recommendation-cards" class="grid gap-5 md:grid-cols-2">
            <!-- Cards injected via JS -->
          </div>
        </div>

        <!-- E. Daily Study Plan -->
        <div class="mb-10 p-6 sm:p-7 rounded-2xl bg-white border border-slate-200 shadow-xs">
          <div class="flex items-center justify-between mb-5 flex-wrap gap-2">
            <div class="flex items-center gap-2.5">
              <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-100 text-blue-700 text-sm font-bold">⏰</div>
              <div>
                <h4 class="text-base sm:text-[17px] font-bold text-slate-900 tracking-tight">Personalized Daily Study Plan</h4>
                <p class="text-xs text-slate-500">Structured time blocks tailored to your daily availability</p>
              </div>
            </div>
            <span id="study-plan-badge" class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-50 text-blue-700 border border-blue-100"></span>
          </div>

          <div id="study-plan-items" class="grid gap-3 sm:grid-cols-2">
            <!-- Injected by JS -->
          </div>
          <div id="study-plan-advice-wrap" class="mt-4 p-3.5 rounded-xl bg-amber-50/60 border border-amber-200/70 text-xs text-amber-900 flex items-start gap-2.5">
            <span class="text-amber-500 font-bold shrink-0">💡</span>
            <p id="study-plan-advice" class="leading-relaxed"></p>
          </div>
        </div>

        <!-- F. Project Recommendations -->
        <div class="mb-10">
          <div class="flex items-center gap-2.5 mb-5">
            <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-blue-100 text-blue-700 text-sm font-bold">💻</div>
            <div>
              <h4 class="text-base sm:text-[17px] font-bold text-slate-900 tracking-tight">Recommended Portfolio Projects</h4>
              <p class="text-xs text-slate-500">Practical projects to showcase your abilities to recruiters</p>
            </div>
          </div>
          <div id="project-cards" class="grid gap-4 sm:grid-cols-3">
            <!-- Injected by JS -->
          </div>
        </div>

        <!-- G. Job Readiness & Placement Preparation -->
        <div class="mb-10 p-6 sm:p-7 rounded-2xl bg-gradient-to-br from-slate-900 via-slate-800 to-slate-900 text-white shadow-md border border-slate-800">
          <div class="flex items-center gap-2.5 mb-5">
            <div class="flex h-8 w-8 items-center justify-center rounded-xl bg-white/10 text-white text-sm font-bold">🏆</div>
            <div>
              <h4 class="text-base sm:text-[17px] font-bold text-white tracking-tight">Placement &amp; Job Readiness Preparation</h4>
              <p class="text-xs text-slate-400">Preparation tracks included to ensure interview confidence</p>
            </div>
          </div>
          <div id="job-readiness-content" class="grid gap-4 sm:grid-cols-3 text-xs">
            <!-- Injected by JS -->
          </div>
        </div>

        <!-- H. Mentor Consultation (WhatsApp) -->
        <div class="relative overflow-hidden rounded-2xl border border-blue-200 bg-gradient-to-br from-blue-50/80 via-white to-blue-50/40 px-6 py-8 text-center sm:px-10 shadow-xs">
          <h4 class="text-lg sm:text-[19px] font-bold text-slate-900 mb-2 tracking-tight">Discuss Your Roadmap with a Chedo Mentor</h4>
          <p class="text-xs sm:text-[14px] text-slate-600 mb-6 max-w-lg mx-auto leading-relaxed">
            Have questions about your roadmap, batch timings, or course syllabus? Connect directly with our senior instructors on WhatsApp.
          </p>
          <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
            <a id="btn-wa-recommendation" href="#" target="_blank" rel="noopener" class="hero-btn-primary inline-flex items-center justify-center w-full sm:w-auto !px-7 !py-3 shadow-md hover:shadow-lg transition-all">
              <svg aria-hidden="true" focusable="false" class="h-4 w-4 mr-2 inline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
              </svg>
              Talk to a Mentor on WhatsApp
            </a>
            <button type="button" onclick="document.getElementById('enquiry-form').classList.remove('hidden'); document.getElementById('recommendation-results').classList.add('hidden');" class="hero-btn-secondary w-full sm:w-auto !px-6 !py-3 text-xs sm:text-[13px] font-semibold text-slate-700 bg-white hover:bg-slate-50 border border-slate-300">
              Recalculate Assessment
            </button>
          </div>
        </div>

      </div>
    </div>
  </div>
</section>

<!-- SECTION 4: PREFER TO TALK IN PERSON? CTA -->
<section class="py-12 sm:py-16 bg-white">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="relative overflow-hidden rounded-[2rem] border border-slate-200 bg-slate-50 px-6 py-12 text-center sm:px-12 sm:py-16">
      <div class="bg-grid absolute inset-0 opacity-40" aria-hidden="true"></div>
      <div class="relative z-10">
        <h2 class="hero-headline mx-auto max-w-2xl !text-[32px] sm:!text-[38px]"><?= cms('contact.prefer-to-talk-in.01', 'Prefer to Talk in') ?> <span class="hero-underline"><?= cms('contact.prefer-to-talk-in.02', 'Person?') ?></span></h2>
        <p class="mx-auto mt-4 max-w-xl text-[16px] sm:text-[17px] leading-[1.6] text-slate-600"><?= cms('contact.prefer-to-talk-in.03', 'Visit the center to plan your curriculum, get study material and enroll directly with a learning schedule.') ?></p>
        <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
          <a class="hero-btn-primary !px-6" href="<?= cmsu('contact.prefer-to-talk-in.04', 'courses.php') ?>"><?= cms('contact.prefer-to-talk-in.05', 'Browse Courses First') ?></a>
          <a class="hero-btn-secondary !px-6" data-wa href="<?= cmsu('contact.prefer-to-talk-in.06', 'contact.php') ?>" data-wa-text="Hello Chedo Tech, I would like to visit the center. When can I come?"><?= cms('contact.prefer-to-talk-in.07', 'Plan a Visit') ?></a>
        </div>
      </div>
    </div>
  </div>
</section>