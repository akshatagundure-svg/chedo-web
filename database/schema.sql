CREATE DATABASE IF NOT EXISTS chedo_tech CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE chedo_tech;

CREATE TABLE IF NOT EXISTS admins (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(100) NOT NULL UNIQUE,
  password_hash VARCHAR(255) NOT NULL,
  email VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS site_settings (
  id INT PRIMARY KEY,
  site_name VARCHAR(255),
  logo VARCHAR(255),
  phone VARCHAR(50),
  whatsapp VARCHAR(50),
  email VARCHAR(255),
  address TEXT,
  opening_hours TEXT,
  facebook VARCHAR(255),
  instagram VARCHAR(255),
  youtube VARCHAR(255),
  linkedin VARCHAR(255),
  hero_text TEXT,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS course_categories (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  slug VARCHAR(100) NOT NULL UNIQUE,
  description TEXT,
  icon VARCHAR(50),
  sort_order INT DEFAULT 0
);

CREATE TABLE IF NOT EXISTS courses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  slug VARCHAR(255) NOT NULL UNIQUE,
  short_description TEXT,
  full_description LONGTEXT,
  category_id INT,
  level VARCHAR(50),
  featured TINYINT(1) DEFAULT 0,
  status TINYINT(1) DEFAULT 1,
  hero_text VARCHAR(255),
  meta_title VARCHAR(255),
  meta_description TEXT,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  FOREIGN KEY (category_id) REFERENCES course_categories(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS course_modules (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  group_title VARCHAR(255),
  tools TEXT,
  summary TEXT,
  sort_order INT DEFAULT 0,
  FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS course_topics (
  id INT AUTO_INCREMENT PRIMARY KEY,
  module_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  group_title VARCHAR(255),
  sort_order INT DEFAULT 0,
  FOREIGN KEY (module_id) REFERENCES course_modules(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS course_projects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  course_id INT NOT NULL,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  tag VARCHAR(100),
  subtag VARCHAR(100),
  footnote VARCHAR(255),
  sort_order INT DEFAULT 0,
  status TINYINT(1) DEFAULT 1,
  FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS testimonials (
  id INT AUTO_INCREMENT PRIMARY KEY,
  student_name VARCHAR(100) NOT NULL,
  course VARCHAR(100),
  testimonial TEXT NOT NULL,
  rating TINYINT DEFAULT 5,
  review_date VARCHAR(50),
  source VARCHAR(30) DEFAULT 'google',
  source_url VARCHAR(255),
  status TINYINT(1) DEFAULT 1,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS faqs (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question VARCHAR(255) NOT NULL,
  answer TEXT NOT NULL,
  status TINYINT(1) DEFAULT 1,
  sort_order INT DEFAULT 0,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS services (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(100) NOT NULL,
  description TEXT,
  status TINYINT(1) DEFAULT 1
);

CREATE TABLE IF NOT EXISTS enquiries (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(100) NOT NULL,
  phone VARCHAR(50),
  email VARCHAR(255),
  education VARCHAR(100),
  age INT,
  learning_level VARCHAR(100),
  career_goal VARCHAR(100),
  known_technologies JSON,
  learning_objective VARCHAR(255),
  daily_availability VARCHAR(100),
  recommended_career_path VARCHAR(100),
  recommended_course_ids JSON,
  recommendation_scores JSON,
  skill_gap_analysis JSON,
  personalized_roadmap JSON,
  daily_study_plan JSON,
  project_recommendations JSON,
  estimated_duration VARCHAR(100),
  idempotency_key VARCHAR(64),
  course_id INT,
  message TEXT,
  source_page VARCHAR(255),
  status VARCHAR(50) DEFAULT 'New',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_enquiries_career_goal (career_goal),
  INDEX idx_enquiries_created_at (created_at),
  INDEX idx_enquiries_idempotency (idempotency_key),
  FOREIGN KEY (course_id) REFERENCES courses(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS seo_settings (
  id INT AUTO_INCREMENT PRIMARY KEY,
  page VARCHAR(100) NOT NULL UNIQUE,
  meta_title VARCHAR(255),
  meta_description TEXT,
  og_image VARCHAR(255),
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- Every editable text / link on the public pages (header, footer, home, about, courses...).
-- content_key is the key used in the templates: cms('home.hero.01', 'default text').
-- default_value is the original text shipped with the site (lets the CMS offer "Reset").
CREATE TABLE IF NOT EXISTS site_content (
  id INT AUTO_INCREMENT PRIMARY KEY,
  content_key VARCHAR(160) NOT NULL UNIQUE,
  page VARCHAR(80) NOT NULL,
  section VARCHAR(120) NOT NULL,
  section_label VARCHAR(255),
  field_type VARCHAR(20) NOT NULL DEFAULT 'text',
  default_value MEDIUMTEXT,
  value MEDIUMTEXT,
  sort_order INT DEFAULT 0,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_content_page (page)
);

-- Repeating blocks the admin can add / remove / reorder (home page course cards, journey steps, projects...).
CREATE TABLE IF NOT EXISTS page_items (
  id INT AUTO_INCREMENT PRIMARY KEY,
  page VARCHAR(80) NOT NULL,
  section VARCHAR(80) NOT NULL,
  title VARCHAR(255),
  subtitle VARCHAR(255),
  description TEXT,
  tag VARCHAR(120),
  icon VARCHAR(80),
  link_label VARCHAR(255),
  link_url VARCHAR(255),
  sort_order INT DEFAULT 0,
  status TINYINT(1) DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX idx_items_page_section (page, section, sort_order)
);
