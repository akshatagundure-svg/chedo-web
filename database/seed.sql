INSERT INTO admins (username, password_hash, email) VALUES ('admin', '$2y$10$wVqq33dkSLtiYnM7Nz45wuVd.oKYIprxujlQgO/GyNWe3nx1AKWGC', 'chetan2469@gmail.com');
-- Default password: admin123 (change immediately)

INSERT INTO site_settings (id, site_name, phone, whatsapp, email, address, opening_hours) VALUES (1, 'Chedo Tech Programming Institute & Development Center', '+91 87931 00815', '918793100815', 'chetan2469@gmail.com', 'Office No. 217, Ultima Business Center, Shree Shantinagar Society Internal Road, Sainagar, Kondhwa Budruk, Pune, Maharashtra 411048, India', 'Mon – Sat: 9:00 AM – 9:00 PM');

INSERT INTO course_categories (name, slug, description, sort_order) VALUES 
('Programming', 'programming', 'Core programming fundamentals', 1),
('Full Stack', 'full-stack', 'End-to-end web development', 2),
('Data & AI', 'data-ai', 'Data Science, AI and Analytics', 3),
('Mobile', 'mobile', 'Mobile application development', 4),
('Design', 'design', 'UI/UX and visual design', 5),
('Computer Science', 'computer-science', 'Algorithms and data structures', 6),
('Kids', 'kids', 'Programming for young learners', 7);
