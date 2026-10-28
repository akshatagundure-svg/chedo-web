# Chedo.in RAG scrape (2026-09-17)

Full public-site extract of https://chedo.in for retrieval-augmented generation.

## What was crawled

There is no sitemap.xml / robots.txt. Every internal `chedo.in` link found in HTML was followed.

Live pages (HTTP 200):

| Page | URL |
|---|---|
| Home | https://chedo.in/ |
| About | https://chedo.in/about.php |
| Contact | https://chedo.in/contact.php |
| Courses catalog | https://chedo.in/courses.php |
| Privacy policy | https://chedo.in/privacy-policy.php |
| C Programming | https://chedo.in/courses/c-programming.php |
| C++ Programming | https://chedo.in/courses/cpp-programming.php |
| Java Programming | https://chedo.in/courses/java-programming.php |
| Python Programming | https://chedo.in/courses/python-programming.php |
| Data Structures & Algorithms | https://chedo.in/courses/data-structures-algorithms.php |
| Java + DSA Foundation | https://chedo.in/courses/java-dsa.php |
| Python + DSA Foundation | https://chedo.in/courses/python-dsa.php |
| C + C++ + DSA Foundation | https://chedo.in/courses/c-cpp-dsa.php |
| MERN Full Stack | https://chedo.in/courses/mern-full-stack.php |
| Java Full Stack | https://chedo.in/courses/java-full-stack.php |
| Mobile App Development (Flutter) | https://chedo.in/courses/mobile-app-development.php |
| Data Science Foundation | https://chedo.in/courses/data-science-foundation.php |
| Data Science | https://chedo.in/courses/data-science.php |
| UI/UX Design | https://chedo.in/courses/ui-ux-design.php |
| Kids Programming | https://chedo.in/courses/kids-programming.php |

`https://chedo.in/index.php` is the same HTML as the homepage.

Checked and **not published** (HTTP 404): `/terms.php`, `/faq.php`, `/blog.php`, `/internship.php`, `/placements.php`, `/gallery.php`, `/*.html` aliases from JSON-LD.

## Files

- `pages/*.md` — one markdown file per live page (JSON-LD + full visible text)
- `syllabi/*.md` — same course pages labelled as syllabus documents
- `chedo_full_corpus.md` — all pages concatenated
- `chedo_rag_chunks.jsonl` — 169 overlapping chunks (`id`, `url`, `title`, `page_type`, `chunk_index`, `text`)
- `manifest.json` — page list and counts
- `raw/*.html` — original HTML snapshots
- `extract_rag.py` — extractor used to build this folder

## RAG usage

Load `chedo_rag_chunks.jsonl` (embed the `text` field). Filter by `page_type` (`course` vs `institute`) or `url` when the user asks for a specific syllabus.

Do not invent fees, batch dates, internships or placement numbers — those are not on the crawled pages.
