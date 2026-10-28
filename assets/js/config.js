/* ============================================================
   Chedo Tech — Site Configuration
   ============================================================ */
window.SITE_CONFIG = {
  name: "Chedo Tech",
  tagline: "Programming Institute & Development Center",
  domain: "https://chedo.in",

  /* Phone — display format and tel: format */
  phoneDisplay: "+91 87931 00815",
  phoneTel: "+918793100815",

  /* WhatsApp number — digits only, with country code. */
  whatsapp: "918793100815",

  /* Email */
  email: "chetan2469@gmail.com",

  /* Center address + Google Maps */
  address: "Office No. 217, Ultima Business Center, Shree Shantinagar Society Internal Road, Sainagar, Kondhwa Budruk, Pune, Maharashtra 411048, India",
  mapsUrl: "https://maps.google.com/?q=Chedo+Tech+Kondhwa+Budruk+Pune",
  mapsEmbed: "https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4444.879541925663!2d73.87886519999999!3d18.458559599999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bc2ea94eb00cb69%3A0xccd325c6e812ae0d!2sChedo%20Tech!5e0!3m2!1sen!2sin!4v1785695566881!5m2!1sen!2sin",

  /* Hours & Rating */
  hours: "Mon – Sat: 9:00 AM – 9:00 PM",
  googleRating: "4.9 / 5",
  googleReviews: "253+ reviews"
};

/* Values saved in the admin CMS (Website Settings) are printed into the page by includes/header.php and win over the defaults above. */
if (window.SITE_CONFIG_OVERRIDES) {
  Object.assign(window.SITE_CONFIG, window.SITE_CONFIG_OVERRIDES);
}
