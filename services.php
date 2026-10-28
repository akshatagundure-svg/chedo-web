<?php
$page_title = "Our Services | Chedo Tech";
$page_description = "Chedo Tech offers offline programming education, app development services, corporate training, and custom software solutions in Pune.";
$page_canonical = "https://chedo.in/services.php";
include 'includes/header.php';
?>

<main id="main">

  <section class="relative overflow-hidden border-b border-slate-100 bg-slate-50/50 py-12 lg:py-16">
    <div class="bg-grid bg-grid-fade absolute inset-0" aria-hidden="true"></div>
    <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
      <nav aria-label="Breadcrumb" class="mb-4">
        <ol class="flex items-center gap-2 text-sm text-slate-600">
          <li><a class="transition-colors hover:text-blue-700" href="<?= cmsu('services.education-app-development.01', '/') ?>"><?= cms('services.education-app-development.02', 'Home') ?></a></li>
          <li class="text-slate-300">/</li>
          <li class="text-slate-700 font-medium"><?= cms('services.education-app-development.03', 'Services') ?></li>
        </ol>
      </nav>
      <div class="max-w-3xl">
        <h1 class="mt-2 text-[clamp(2.2rem,5vw,3.75rem)] font-extrabold leading-[1.1] tracking-tight text-slate-900"><?= cms('services.education-app-development.04', 'Education & App Development.') ?></h1>
        <p class="mt-4 text-base leading-relaxed text-slate-600 sm:text-lg">
          <?= cms('services.education-app-development.05', 'In addition to classroom training, Chedo Tech provides custom software development, mobile app building, and institutional training.') ?>
        </p>
      </div>
    </div>
  </section>

  <section class="py-16 bg-white">
    <div class="mx-auto max-w-7xl px-5 sm:px-8">
      <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

        <div class="card p-8 card-hover flex flex-col justify-between">
          <div>
            <div class="bento-icon mb-4">🎓</div>
            <h3 class="text-xl font-bold text-slate-900 mb-2"><?= cms('services.classroom-training.01', 'Classroom Training') ?></h3>
            <p class="text-sm text-slate-600 leading-relaxed mb-6"><?= cms('services.classroom-training.02', 'Hands-on, offline programming courses in C, Python, Java, Full Stack, Data Science, and Mobile Apps.') ?></p>
          </div>
          <a href="<?= cmsu('services.classroom-training.03', '/courses.php') ?>" class="arrow-link"><?= cms('services.classroom-training.04', 'Explore Courses') ?> <span class="arrow">➔</span></a>
        </div>

        <div class="card p-8 card-hover flex flex-col justify-between">
          <div>
            <div class="bento-icon mb-4">📱</div>
            <h3 class="text-xl font-bold text-slate-900 mb-2"><?= cms('services.classroom-training.05', 'Mobile & Web Development') ?></h3>
            <p class="text-sm text-slate-600 leading-relaxed mb-6"><?= cms('services.classroom-training.06', 'We build production-ready mobile applications (Flutter/React Native) and modern web platforms for clients.') ?></p>
          </div>
          <a href="<?= cmsu('services.classroom-training.07', '/contact.php') ?>" class="arrow-link"><?= cms('services.classroom-training.08', 'Discuss Project') ?> <span class="arrow">➔</span></a>
        </div>

        <div class="card p-8 card-hover flex flex-col justify-between">
          <div>
            <div class="bento-icon mb-4">🏢</div>
            <h3 class="text-xl font-bold text-slate-900 mb-2"><?= cms('services.classroom-training.09', 'Corporate & College Workshops') ?></h3>
            <p class="text-sm text-slate-600 leading-relaxed mb-6"><?= cms('services.classroom-training.10', 'Customized tech bootcamps, workshops, and skill enhancement sessions for engineering colleges and teams.') ?></p>
          </div>
          <a href="<?= cmsu('services.classroom-training.11', '/contact.php') ?>" class="arrow-link"><?= cms('services.classroom-training.12', 'Request Workshop') ?> <span class="arrow">➔</span></a>
        </div>

      </div>
    </div>
  </section>

</main>
<?php include 'includes/footer.php'; ?>