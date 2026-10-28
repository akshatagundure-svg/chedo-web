<?php
// Google rating pill shown in every course page hero. Update the numbers here once and all pages follow.
// Styles: .google-badge in assets/css/main.css (copied into main.min.css).
$google_rating  = '4.9';
$google_reviews = '253+';
?>
<a class="hero-badge-pill google-badge" href="<?= cmsu('global.rating.01', 'https://maps.google.com/?q=Chedo+Tech+Kondhwa+Budruk+Pune') ?>" data-maps-link
  target="_blank" rel="noopener" title="See our reviews on Google"
  aria-label="Rated <?= $google_rating ?> out of 5 from <?= $google_reviews ?> Google reviews (opens in a new tab)">
  <svg class="google-badge-logo" viewBox="0 0 24 24" aria-hidden="true">
    <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" />
    <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84A11 11 0 0 0 12 23z" />
    <path fill="#FBBC05" d="M5.84 14.09A6.6 6.6 0 0 1 5.49 12c0-.73.13-1.43.35-2.09V7.07H2.18A11 11 0 0 0 1 12c0 1.78.43 3.45 1.18 4.93l3.66-2.84z" />
    <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1A11 11 0 0 0 2.18 7.07l3.66 2.84C6.71 7.31 9.14 5.38 12 5.38z" />
  </svg>
  <span class="google-badge-score"><?= $google_rating ?></span>
  <span class="google-badge-stars" aria-hidden="true">★★★★★</span>
  <span class="google-badge-count"><?= $google_reviews ?> reviews</span>
</a>
