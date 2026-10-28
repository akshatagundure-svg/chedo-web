<?php
$page_title = "Privacy Policy | Chedo Tech";
$page_description = "Chedo Tech privacy policy — what information our enquiry and course-finder forms collect, how it is used, the third-party services on this website, and how to ask us to delete your data.";
$page_canonical = "https://chedo.in/privacy-policy.php";
include 'includes/header.php';
?>
<main id="main">

<section class="py-16 sm:py-20">
  <div class="mx-auto max-w-3xl px-5 sm:px-8">
    <nav aria-label="Breadcrumb" class="mb-6"><ol class="flex flex-wrap items-center gap-2 text-sm text-slate-600"><li><a class="transition-colors hover:text-blue-700" href="<?= cmsu('privacy.privacy-policy.01', 'index.php') ?>"><?= cms('privacy.privacy-policy.02', 'Home') ?></a></li><li class="text-slate-300" aria-hidden="true">/</li><li class="text-slate-600" aria-current="page"><?= cms('privacy.privacy-policy.03', 'Privacy Policy') ?></li></ol></nav>
    <h1 class="text-[clamp(2rem,4.5vw,3.25rem)] font-extrabold leading-tight tracking-tight text-slate-900"><?= cms('privacy.privacy-policy.04', 'Privacy Policy') ?></h1>
    <p class="mt-3 text-sm font-medium text-slate-600"><?= cms('privacy.privacy-policy.05', 'Last updated: October 2026') ?></p>
    <p class="mt-6 leading-relaxed text-slate-600">
      <?= cms('privacy.privacy-policy.06', 'Chedo Tech (chedo.in) is a programming institute in Pune. This page explains, in plain language, what information this website collects and how it is used.') ?>
    </p>
    <section class="mt-10">
      <h2 class="text-xl font-bold tracking-tight text-slate-900"><?= cms('privacy.what-this-policy-covers.01', 'What This Policy Covers') ?></h2>
      <p class="mt-3 leading-relaxed text-slate-600"><?= cms('privacy.what-this-policy-covers.02', 'This policy describes how chedo.in ("Chedo Tech", "we", "us") handles information when you visit this website. It applies only to this website, not to any third-party platforms we may link to.') ?></p>
    </section><section class="mt-10">
      <h2 class="text-xl font-bold tracking-tight text-slate-900"><?= cms('privacy.information-you-send-us.01', 'Information You Send Us') ?></h2>
      <p class="mt-3 leading-relaxed text-slate-600"><strong class="text-slate-900"><?= cms('privacy.information-you-send-us.02', 'Course finder (contact page).') ?></strong> <?= cms('privacy.information-you-send-us.03', 'When you use the "Find My Best Courses" form, your answers (such as age, education, preferred language, interests, goal and experience) are sent to our server only to calculate course suggestions, and are not saved. If you then choose "Talk to a Mentor", WhatsApp opens on your device with your details pre-filled, and nothing is sent until you press send in WhatsApp.') ?></p>
      <p class="mt-3 leading-relaxed text-slate-600"><strong class="text-slate-900"><?= cms('privacy.information-you-send-us.04', 'Chat assistant.') ?></strong> <?= cms('privacy.information-you-send-us.05', 'When you ask the chat assistant (the owl button) a question, your question and the earlier messages in that chat are sent to our server and to NVIDIA\'s AI service to write the answer. We do not save chat messages, and the conversation is kept only in your browser until you close the tab. Please don\'t share passwords, payment details or other sensitive information in the chat.') ?></p>
      <p class="mt-3 leading-relaxed text-slate-600"><strong class="text-slate-900"><?= cms('privacy.information-you-send-us.06', 'Enquiry forms.') ?></strong> <?= cms('privacy.information-you-send-us.07', 'If you submit an enquiry form on a course page, or the contact form while JavaScript is turned off in your browser, we save the details you enter (name, phone number, email, the course you are interested in and your message) in our enquiry records so our team can contact you.') ?></p>
      <p class="mt-3 leading-relaxed text-slate-600"><?= cms('privacy.information-you-send-us.08', 'Information you send us by any of these routes, or by WhatsApp, phone, email or in person, is used only to respond to your enquiry and to help you with course guidance. We do not sell it or share it with advertisers. We keep enquiry records only for as long as we need them to follow up with you.') ?></p>
    </section><section class="mt-10">
      <h2 class="text-xl font-bold tracking-tight text-slate-900"><?= cms('privacy.information-we-collect-automatically.01', 'Information We Collect Automatically') ?></h2>
      <p class="mt-3 leading-relaxed text-slate-600"><?= cms('privacy.information-we-collect-automatically.02', 'This website does not use analytics trackers, advertising scripts or tracking cookies. Our hosting provider may keep standard server logs (such as IP addresses, browser type and requested pages) as part of normal operation and security.') ?></p>
    </section><section class="mt-10">
      <h2 class="text-xl font-bold tracking-tight text-slate-900"><?= cms('privacy.third-party-services.01', 'Third-Party Services') ?></h2>
      <p class="mt-3 leading-relaxed text-slate-600"><?= cms('privacy.third-party-services.02', 'Some parts of this website are provided by other companies, which receive your IP address when your browser loads them:') ?></p>
      <ul class="mt-3 leading-relaxed text-slate-600" style="list-style:disc;padding-left:1.5rem;">
        <li><?= cms('privacy.third-party-services.03', 'Google Maps, embedded on the contact page. Google may set cookies according to its own policy.') ?></li>
        <li><?= cms('privacy.third-party-services.04', 'Icon and slider files loaded from the cdnjs and jsDelivr content delivery networks.') ?></li>
        <li><?= cms('privacy.third-party-services.05', 'NVIDIA\'s AI service, which writes the chat assistant\'s answers.') ?></li>
        <li><?= cms('privacy.third-party-services.06', 'WhatsApp, when you click a WhatsApp button.') ?></li>
        <li><?= cms('privacy.third-party-services.07', 'The Student Login portal (chedo.web.app), which is a separate service.') ?></li>
      </ul>
      <p class="mt-3 leading-relaxed text-slate-600"><?= cms('privacy.third-party-services.08', 'These services have their own privacy policies, and we are not responsible for their practices.') ?></p>
    </section><section class="mt-10">
      <h2 class="text-xl font-bold tracking-tight text-slate-900"><?= cms('privacy.children-s-privacy.01', 'Children\'s Privacy') ?></h2>
      <p class="mt-3 leading-relaxed text-slate-600"><?= cms('privacy.children-s-privacy.02', 'We offer programming courses for children. Enquiries for students under 18 should be made by a parent or guardian, who provides any information on the child\'s behalf. If you believe a child has sent us personal information without a parent\'s knowledge, contact us and we will delete it.') ?></p>
    </section><section class="mt-10">
      <h2 class="text-xl font-bold tracking-tight text-slate-900"><?= cms('privacy.your-choices.01', 'Your Choices') ?></h2>
      <p class="mt-3 leading-relaxed text-slate-600"><?= cms('privacy.your-choices.02', 'You can contact us at any time to ask what information you have shared with us, to correct it, or to ask that we delete it. Email') ?> <a class="font-medium text-blue-700" style="text-decoration:underline;" href="<?= cmsu('privacy.your-choices.03', 'mailto:chetan2469@gmail.com') ?>"><?= cms('privacy.your-choices.04', 'chetan2469@gmail.com') ?></a><?= cms('privacy.your-choices.05', ', call') ?> <a class="font-medium text-blue-700" style="text-decoration:underline;" href="<?= cmsu('privacy.your-choices.06', 'tel:+918793100815') ?>"><?= cms('privacy.your-choices.07', '+91 87931 00815') ?></a><?= cms('privacy.your-choices.08', ', or see the') ?> <a class="font-medium text-blue-700" style="text-decoration:underline;" href="<?= cmsu('privacy.your-choices.09', '/contact.php') ?>"><?= cms('privacy.your-choices.10', 'contact page') ?></a>.</p>
    </section><section class="mt-10">
      <h2 class="text-xl font-bold tracking-tight text-slate-900"><?= cms('privacy.changes-to-this-policy.01', 'Changes to This Policy') ?></h2>
      <p class="mt-3 leading-relaxed text-slate-600"><?= cms('privacy.changes-to-this-policy.02', 'If this website adds analytics, new forms or other features that change how information is handled, we will update this page. The "Last updated" date at the top shows the latest revision.') ?></p>
    </section>
  </div>
</section>

</main>

<?php include 'includes/footer.php'; ?>
