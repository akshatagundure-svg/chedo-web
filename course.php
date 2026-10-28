<?php 
$slug = $_GET['slug'] ?? '';
require_once 'includes/functions.php';
$course = get_course_by_slug($slug);

if (!$course) {
    http_response_code(404);
    $page_title = "Course Not Found";
    include 'includes/header.php';
    echo '<main class="mx-auto max-w-7xl px-5 py-24 text-center">
            <h1 class="text-3xl font-extrabold text-slate-900">Course Not Found</h1>
            <p class="mt-2 text-slate-600">The course you are looking for does not exist or has been updated.</p>
            <a href="/courses.php" class="btn-primary mt-6 inline-flex">Browse All Courses</a>
          </main>';
    include 'includes/footer.php';
    exit;
}

// The static pages in /courses/ are the primary course pages; point search engines there.
$static_pages = [
    'data-structures' => 'data-structures-algorithms',
    'mobile-app'      => 'mobile-app-development',
    'ui-ux'           => 'ui-ux-design',
];
$static_slug = $static_pages[$course['slug']] ?? $course['slug'];
$page_title = $course['meta_title'] ?: $course['title'] . ' Course in Pune | Chedo Tech';
$page_description = $course['meta_description'] ?: $course['short_description'];
$page_canonical = file_exists(__DIR__ . '/courses/' . $static_slug . '.php')
    ? 'https://chedo.in/courses/' . $static_slug . '.php'
    : 'https://chedo.in/course.php?slug=' . rawurlencode($course['slug']);
include 'includes/header.php';

$modules = get_modules($course['id']);
$projects = get_projects($course['id']);
$duration = get_course_duration($course['slug']);
$msg = $_GET['msg'] ?? '';
?>

<main id="main">

<!-- Course Hero Banner -->
<section class="relative overflow-hidden border-b border-slate-100 bg-slate-50/50 py-12 lg:py-16">
  <div class="bg-grid bg-grid-fade absolute inset-0" aria-hidden="true"></div>
  <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
    <nav aria-label="Breadcrumb" class="mb-4">
      <ol class="flex items-center gap-2 text-sm text-slate-600">
        <li><a class="transition-colors hover:text-blue-700" href="/">Home</a></li>
        <li class="text-slate-300">/</li>
        <li><a class="transition-colors hover:text-blue-700" href="/courses.php">Courses</a></li>
        <li class="text-slate-300">/</li>
        <li class="text-slate-700 font-medium"><?php echo esc($course['title']); ?></li>
      </ol>
    </nav>

    <div class="grid items-start gap-10 lg:grid-cols-12">
      <div class="lg:col-span-8">
        <div class="flex flex-wrap items-center gap-2 mb-3">
          <span class="chip-tint"><?php echo esc($course['category_name'] ?? 'Programming'); ?></span>
          <span class="chip"><?php echo esc($course['level']); ?></span>
          <span class="chip">Offline Classroom Training</span>
        </div>
        <h1 class="text-[clamp(2.2rem,5vw,3.5rem)] font-extrabold leading-[1.1] tracking-tight text-slate-900"><?php echo esc($course['title']); ?></h1>
        <p class="mt-4 max-w-2xl text-lg leading-relaxed text-slate-600"><?php echo esc($course['short_description']); ?></p>
        
        <div class="mt-6 flex flex-wrap gap-3">
          <a class="btn-wa btn-lg" href="https://wa.me/918793100815?text=Hello%20Chedo%20Tech,%20I%20am%20interested%20in%20<?php echo rawurlencode($course['title']); ?>" target="_blank" rel="noopener">
            <span aria-hidden="true">💬</span> Enquire on WhatsApp
          </a>
          <a class="btn-primary btn-lg" href="#enquireForm">Enroll / Request Batch</a>
        </div>
      </div>

      <!-- Snapshot Card -->
      <div class="lg:col-span-4">
        <div class="card p-6 shadow-sm bg-white">
          <div class="mt-4 space-y-4 text-sm">
            <div class="flex items-start gap-3">
              <span class="mt-0.5 text-blue-600">⏱️</span>
              <div><p class="font-semibold text-slate-900">Duration</p><p class="text-slate-600"><?php echo esc($duration); ?></p></div>
            </div>
            <div class="flex items-start gap-3">
              <span class="mt-0.5 text-blue-600">📍</span>
              <div><p class="font-semibold text-slate-900">Format</p><p class="text-slate-600">Offline in-person classroom</p></div>
            </div>
            <div class="flex items-start gap-3">
              <span class="mt-0.5 text-blue-600">🚀</span>
              <div><p class="font-semibold text-slate-900">Projects</p><p class="text-slate-600"><?php echo count($projects); ?> Real-World Portfolio Projects</p></div>
            </div>
            <div class="flex items-start gap-3">
              <span class="mt-0.5 text-blue-600">🎓</span>
              <div><p class="font-semibold text-slate-900">Certificate</p><p class="text-slate-600">Official Course Completion Certificate</p></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Course Details & Curriculum Grid -->
<section class="py-16 bg-white">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="grid gap-12 lg:grid-cols-12">
      
      <!-- Main Content Left -->
      <div class="lg:col-span-8 space-y-12">
        
        <!-- Overview -->
        <div>
          <h2 class="text-2xl font-extrabold text-slate-900">Course Overview</h2>
          <p class="mt-4 text-base leading-relaxed text-slate-600">
            <?php echo nl2br(esc($course['full_description'] ?: $course['short_description'])); ?>
          </p>
        </div>

        <!-- Curriculum Accordion -->
        <div id="curriculum">
          <div class="flex items-center justify-between mb-6">
            <div>
              <h2 class="mt-1 text-2xl font-extrabold text-slate-900">Curriculum Modules</h2>
            </div>
            <span class="text-xs font-semibold text-slate-600 uppercase font-mono"><?php echo count($modules); ?> Modules</span>
          </div>

          <?php if($modules): ?>
            <div class="space-y-4">
              <?php foreach($modules as $index => $m): 
                $topics = get_topics($m['id']);
              ?>
                <details class="acc-item" <?php echo $index===0 ? 'open' : ''; ?>>
                  <summary class="acc-summary">
                    <span class="acc-num"><?php echo sprintf('%02d', $index + 1); ?></span>
                    <span class="font-bold text-slate-900 text-base"><?php echo esc($m['title']); ?></span>
                    <span class="acc-chevron">+</span>
                  </summary>
                  <div class="acc-body">
                    <?php if(!empty($m['description'])): ?>
                      <p class="text-xs text-slate-600 mb-3 italic"><?php echo esc($m['description']); ?></p>
                    <?php endif; ?>

                    <?php if($topics): ?>
                      <div class="grid gap-2 sm:grid-cols-2">
                        <?php foreach($topics as $t): ?>
                          <div class="flex items-center gap-2 text-sm text-slate-600">
                            <span class="text-emerald-500 font-bold">✓</span>
                            <span><?php echo esc($t['title']); ?></span>
                          </div>
                        <?php endforeach; ?>
                      </div>
                    <?php endif; ?>
                  </div>
                </details>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>

        <!-- Real-World Projects -->
        <?php if($projects): ?>
          <div>
            <h2 class="mt-1 text-2xl font-extrabold text-slate-900 mb-6">Portfolio Projects</h2>

            <div class="grid gap-4">
              <?php foreach($projects as $pIdx => $p): ?>
                <div class="card p-6 border-l-4 border-l-blue-600 flex gap-4 items-start">
                  <span class="font-mono font-extrabold text-blue-600 text-lg">#<?php echo ($pIdx+1); ?></span>
                  <div>
                    <h3 class="font-bold text-slate-900 text-lg mb-1"><?php echo esc($p['title']); ?></h3>
                    <p class="text-sm text-slate-600 leading-relaxed"><?php echo esc($p['description']); ?></p>
                  </div>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        <?php endif; ?>

      </div>

      <!-- Sidebar Form Right -->
      <div class="lg:col-span-4" id="enquireForm">
        <div class="card p-6 shadow-md bg-white sticky top-24">
          <h3 class="text-xl font-bold text-slate-900 mb-1">Enquire For Next Batch</h3>
          <p class="text-xs text-slate-600 mb-6">Get batch timings, fee details &amp; syllabus assistance.</p>

          <?php if($msg === 'success'): ?>
            <div class="mb-4 rounded-xl bg-emerald-50 p-4 text-xs font-semibold text-emerald-700 border border-emerald-200">
              ✓ Thank you! Your inquiry has been received. Our counselor will contact you shortly.
            </div>
          <?php elseif($msg === 'error'): ?>
            <div class="mb-6 rounded-xl bg-amber-50 p-4 text-xs font-semibold text-amber-800 border border-amber-200" role="alert">
              Sorry, we couldn't save your enquiry. Please try again or message us on WhatsApp.
            </div>
          <?php endif; ?>

          <form method="post" action="/enquire-submit.php" class="space-y-4">
            <input type="hidden" name="course_id" value="<?php echo intval($course['id']); ?>">
            <input type="hidden" name="source_page" value="Course: <?php echo esc($course['title']); ?>">

            <div>
              <label class="field-label" for="enq-name">Full Name *</label>
              <input type="text" id="enq-name" name="name" class="field-input" placeholder="e.g. Rahul Sharma" required>
            </div>

            <div>
              <label class="field-label" for="enq-phone">Phone Number *</label>
              <input type="tel" id="enq-phone" name="phone" class="field-input" placeholder="e.g. +91 9876543210" required>
            </div>

            <div>
              <label class="field-label" for="enq-email">Email Address</label>
              <input type="email" id="enq-email" name="email" class="field-input" placeholder="rahul@gmail.com">
            </div>

            <div>
              <label class="field-label" for="enq-message">Batch Preference / Notes</label>
              <textarea id="enq-message" name="message" class="field-input min-h-[90px]" placeholder="Morning or evening batch preference..."></textarea>
            </div>

            <button type="submit" class="btn-primary w-full text-center">Submit Inquiry ➔</button>
          </form>

          <div class="mt-6 border-t border-slate-100 pt-4 text-center">
            <p class="text-xs text-slate-600 mb-3">Or chat with mentor directly:</p>
            <a href="https://wa.me/918793100815?text=Hi%20Chedo%20Tech,%20I%20want%20information%20for%20<?php echo rawurlencode($course['title']); ?>" target="_blank" rel="noopener" class="btn-wa w-full text-center"><span aria-hidden="true">💬</span> WhatsApp Inquiry</a>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

</main>
<?php include 'includes/footer.php'; ?>
