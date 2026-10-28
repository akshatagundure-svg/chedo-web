<section class="py-16 sm:py-24 bg-white">
  <div class="mx-auto max-w-7xl px-5 sm:px-8">
    <div class="mb-16 text-center sm:text-left">
      <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight text-slate-900 mb-3"><?= cms('home.skills-that-build-careers.01', 'Skills That Build Careers') ?></h2>
      <p class="text-lg text-slate-600"><?= cms('home.skills-that-build-careers.02', 'Learn practical skills. Build real projects.') ?></p>
    </div>

    <!-- Courses Grid (3 Columns on large screens) -->
    <div class="skills-grid grid gap-5 sm:gap-6 sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 items-stretch">

      <?php foreach (cms_items('home', 'skills') as $skill): ?>
      <article class="relative flex items-center gap-5 rounded-2xl border border-slate-200 bg-white p-6 transition-all hover:shadow-md hover:border-blue-200 hover:bg-blue-50/30 group">
        <div class="flex h-14 w-14 shrink-0 items-center justify-center rounded-xl bg-slate-50 text-slate-600 border border-slate-100 group-hover:bg-blue-100 group-hover:text-blue-600 group-hover:border-blue-200 transition-colors">
          <?= cms_icon($skill['icon'], 'h-6 w-6', '1.75') ?>
        </div>
        <div>
          <h3 class="text-lg font-bold tracking-tight text-slate-900"><a href="<?= esc(cms_clean_url($skill['link_url'])) ?>" class="after:absolute after:inset-0 rounded-2xl"><?= esc($skill['title']) ?></a></h3>
          <p class="mt-1 text-sm font-medium text-slate-500"><?= esc($skill['subtitle']) ?></p>
        </div>
      </article>
      <?php endforeach; ?>

    </div>
  </div>
</section>

<style>
  /* Phones: two cards per row, icon stacked above the text */
  @media (max-width: 639px) {
    .skills-grid {
      grid-template-columns: repeat(2, minmax(0, 1fr));
      gap: 0.75rem;
    }

    .skills-grid>article {
      flex-direction: column;
      align-items: flex-start;
      gap: 0.75rem;
      padding: 1rem 0.9rem;
      min-width: 0;
    }

    .skills-grid>article>div:first-child {
      width: 2.75rem;
      height: 2.75rem;
    }

    .skills-grid>article h3 {
      font-size: 0.95rem;
      line-height: 1.25;
      overflow-wrap: anywhere;
    }

    .skills-grid>article p {
      font-size: 0.75rem;
      line-height: 1.35;
      margin-top: 0.3rem;
      overflow-wrap: anywhere;
    }
  }
</style>