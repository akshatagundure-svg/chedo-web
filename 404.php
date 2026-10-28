<?php
http_response_code(404);
$page_title = "Page Not Found | Chedo Tech";
$page_description = "The page you are looking for could not be found. Explore Chedo Tech's programming courses or return to the homepage.";
include 'includes/header.php';
?>
<main id="main">

<section class="relative flex min-h-[70vh] items-center overflow-hidden py-20">
  <div class="bg-grid bg-grid-fade absolute inset-0" aria-hidden="true"></div>
  <div class="relative mx-auto max-w-3xl px-5 text-center sm:px-8">
    <div class="terminal mx-auto max-w-md text-left">
      <div class="terminal-bar">
        <span class="win-dot bg-red-400"></span><span class="win-dot bg-amber-400"></span><span class="win-dot bg-emerald-400"></span>
        <span class="ml-2 font-mono text-[11px] text-slate-500"><?= cms('notfound.looks-like-this-lesson.01', '404 — not found') ?></span>
      </div>
      <div class="terminal-body">
<pre><span class="term-prompt">$</span> <span class="text-slate-200">find course</span>
<span class="term-dim">error: page not found</span>
<span class="term-ok">✓</span> <span class="term-dim">hint: check the URL or head home</span></pre>
      </div>
    </div>
    <p class="mt-10 font-mono text-7xl font-black tracking-tight text-slate-200"><?= cms('notfound.looks-like-this-lesson.02', '404') ?></p>
    <h1 class="mt-3 text-[clamp(1.8rem,4vw,2.75rem)] font-extrabold tracking-tight text-slate-900"><?= cms('notfound.looks-like-this-lesson.03', 'Looks like this lesson isn\'t in our curriculum.') ?></h1>
    <p class="mx-auto mt-4 max-w-md text-lg leading-relaxed text-slate-600"><?= cms('notfound.looks-like-this-lesson.04', 'The page you\'re looking for may have moved. Explore our courses or head back home.') ?></p>
    <div class="mt-8 flex flex-col items-center justify-center gap-3 sm:flex-row">
      <a class="btn-primary btn-lg" href="<?= cmsu('notfound.looks-like-this-lesson.05', '/courses.php') ?>"><?= cms('notfound.looks-like-this-lesson.06', 'Explore Courses') ?></a>
      <a class="btn-secondary btn-lg" href="<?= cmsu('notfound.looks-like-this-lesson.07', '/index.php') ?>"><?= cms('notfound.looks-like-this-lesson.08', 'Back Home') ?></a>
    </div>
  </div>
</section>

</main>

<?php include 'includes/footer.php'; ?>
