<?php
// Syllabus / projects of the static course pages (courses/*.php), read from the CMS tables
// courses, course_modules, course_topics and course_projects (admin: "Courses" + "Syllabus Management").
//
//   $syl = course_syllabus('c-programming');   // file name of the page, without .php
//   $syl['modules']  => [ ['title', 'description', 'topics' => [ ['title', 'description'], ... ]], ... ]
//   $syl['projects'] => [ ['tag', 'title', 'description'], ... ]
//
// Pages loop over these arrays and keep their own markup. When the database has no modules / projects for
// the course (or is unreachable) the original content shipped in database/course_pages_seed.json is used.

require_once __DIR__ . '/functions.php';

if (!function_exists('course_syllabus')) {
    /** File name of a static page -> slug used in the courses table (they differ for three courses). */
    function course_db_slug(string $pageSlug): string
    {
        static $map = [
            'data-structures-algorithms' => 'data-structures',
            'mobile-app-development'     => 'mobile-app',
            'ui-ux-design'               => 'ui-ux',
        ];
        return $map[$pageSlug] ?? $pageSlug;
    }

    function course_seed(string $pageSlug): array
    {
        static $seed = null;
        if ($seed === null) {
            $file = __DIR__ . '/../database/course_pages_seed.json';
            $seed = is_file($file) ? (json_decode((string)file_get_contents($file), true) ?: []) : [];
        }
        return $seed[$pageSlug] ?? [];
    }

    function course_syllabus(string $pageSlug): array
    {
        global $pdo;
        static $cache = [];
        if (isset($cache[$pageSlug])) {
            return $cache[$pageSlug];
        }
        $modules = [];
        $projects = [];
        $course = null;
        if ($pdo) {
            try {
                $course = get_course_by_slug(course_db_slug($pageSlug)) ?: null;
                if ($course) {
                    foreach (get_modules($course['id']) as $m) {
                        $m['topics'] = get_topics($m['id']);
                        $m['tools'] = course_tools($m['tools'] ?? '');
                        $modules[] = $m;
                    }
                    $projects = get_projects($course['id']);
                }
            } catch (Throwable $e) {
                error_log('course_syllabus: ' . $e->getMessage());
                $modules = $projects = [];
            }
        }
        $seed = course_seed($pageSlug);
        $seedModules = $seed['modules'] ?? [];
        foreach ($seedModules as $k => $sm) {
            $seedModules[$k]['tools'] = course_tools($sm['tools'] ?? []);
        }
        return $cache[$pageSlug] = [
            'course'   => $course,
            'modules'  => $modules ?: $seedModules,
            'projects' => $projects ?: ($seed['projects'] ?? []),
        ];
    }

    /** Module tools are stored one per line; pages loop over them like over topics: [['title' => 'Pandas'], ...]. */
    function course_tools($v): array
    {
        $lines = is_array($v) ? $v : explode("\n", (string)$v);
        $out = [];
        foreach ($lines as $line) {
            $line = trim((string)$line);
            if ($line !== '') {
                $out[] = ['title' => $line];
            }
        }
        return $out;
    }

    /**
     * Modules grouped under their "PHASE ..." heading (course_modules.group_title; consecutive modules share a group).
     * Each module also gets '_n', its 1-based position in the whole course, used for the "MOD 07" badges.
     * @return array<int, array{title:string, modules:array}>
     */
    function course_groups(array $modules): array
    {
        $groups = [];
        foreach (array_values($modules) as $n => $m) {
            $m['_n'] = $n + 1;
            $title = (string)($m['group_title'] ?? '');
            $last = count($groups) - 1;
            if ($last < 0 || $groups[$last]['title'] !== $title) {
                $groups[] = ['title' => $title, 'group_title' => $title, 'modules' => []];
                $last++;
            }
            $groups[$last]['modules'][] = $m;
        }
        return $groups;
    }

    /**
     * Projects grouped under a heading (course_projects.tag; consecutive projects with the same tag form a group).
     * @return array<int, array{tag:string, projects:array}>
     */
    function course_project_groups(array $projects): array
    {
        $groups = [];
        foreach ($projects as $p) {
            $tag = (string)($p['tag'] ?? '');
            $last = count($groups) - 1;
            if ($last < 0 || $groups[$last]['tag'] !== $tag) {
                $groups[] = ['tag' => $tag, 'projects' => []];
                $last++;
            }
            $groups[$last]['projects'][] = $p;
        }
        return $groups;
    }

    /** Topics of a module grouped under column headings (course_topics.group_title; consecutive topics share a group). */
    function course_topic_groups(array $topics): array
    {
        $groups = [];
        foreach ($topics as $t) {
            $title = (string)($t['group_title'] ?? '');
            $last = count($groups) - 1;
            if ($last < 0 || $groups[$last]['title'] !== $title) {
                $groups[] = ['title' => $title, 'topics' => []];
                $last++;
            }
            $groups[$last]['topics'][] = $t;
        }
        return $groups;
    }

    /** Escaped text in which <code>...</code> is kept (used for lines such as "enumerate(), zip() and sorted()"). */
    function course_rich($v): string
    {
        $parts = preg_split('~(<code>.*?</code>)~is', (string)$v, -1, PREG_SPLIT_DELIM_CAPTURE);
        $out = '';
        foreach ($parts as $p) {
            if (preg_match('~^<code>(.*)</code>$~is', $p, $m)) {
                $out .= '<code>' . course_e($m[1]) . '</code>';
            } else {
                $out .= course_e($p);
            }
        }
        return $out;
    }

    /**
     * Body of one phase of the combined DSA courses (c-cpp-dsa, java-dsa, python-dsa): one list, or several
     * columns when the topics carry a group_title, plus an optional summary line (course_modules.summary).
     * $style 'dots' = bold label + text, 'plain' = "• text";  $accent = tailwind colour name of the phase.
     */
    function course_dsa_body(array $m, string $style, string $accent): void
    {
        $groups = course_topic_groups($m['topics'] ?? []);
        $dots = $style === 'dots';
        $ulClass = $dots ? 'space-y-3 text-sm text-slate-600' : 'space-y-2 text-sm text-slate-600';
        $list = function (array $topics) use ($dots, $accent, $ulClass): string {
            $h = '<ul class="' . $ulClass . '">';
            foreach ($topics as $t) {
                if ($dots) {
                    $h .= '<li class="flex items-start gap-2"><span class="h-1.5 w-1.5 rounded-full bg-' . course_e($accent) . '-500 mt-2 shrink-0"></span>'
                        . '<div><strong>' . course_e($t['title'] ?? '') . '</strong> ' . course_rich($t['description'] ?? '') . '</div></li>';
                } else {
                    $h .= '<li>• ' . course_rich($t['title'] ?? '') . '</li>';
                }
            }
            return $h . '</ul>';
        };
        echo '<div class="acc-body">';
        if (count($groups) === 1 && $groups[0]['title'] === '') {
            echo $list($groups[0]['topics']);
        } elseif ($groups) {
            echo '<div class="grid gap-6 md:grid-cols-2">';
            foreach ($groups as $g) {
                echo '<div><h4 class="text-sm font-extrabold text-slate-900 uppercase tracking-wider mb-3">' . course_e($g['title']) . '</h4>' . $list($g['topics']) . '</div>';
            }
            echo '</div>';
        }
        if (trim((string)($m['summary'] ?? '')) !== '') {
            echo '<div class="mt-6 border-t border-slate-100 pt-4 bg-' . course_e($accent) . '-50/20 rounded-xl p-4">'
                . '<p class="mt-1 text-sm text-slate-700"><strong>' . course_e($m['summary']) . '</strong></p></div>';
        }
        echo '</div>';
    }

    /** Plain text from the database, escaped like cms(). */
    function course_e($v): string
    {
        return htmlspecialchars((string)$v, ENT_QUOTES, 'UTF-8');
    }

    /** Text that may contain <br>, <strong>, <em>, <span>, <code> (everything else stripped). */
    function course_html($v): string
    {
        return strip_tags((string)$v, '<br><strong><em><b><i><span><code>');
    }

    function course_url($v): string
    {
        return htmlspecialchars(cms_clean_url((string)$v), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Picture shown in a module card on the static course pages (assets/images/modules/<file>), picked from the
     * module title. The first matching rule wins, so specific topics come before generic ones.
     */
    function course_module_art(string $title, int $idx = 0): string
    {
        static $rules = [
            ['~capstone~i', 'mod-19-capstone-platform.png'],
            ['~kafka|event-driven~i', 'mod-14-apache-kafka.png'],
            ['~airflow~i', 'mod-13-apache-airflow.png'],
            ['~spark~i', 'mod-09-apache-spark.png'],
            ['~python~i', 'mod-01-python.png'],
            ['~mlops|observability|monitoring|production readiness~i', 'mod-18-production-monitoring.png'],
            ['~security|guardrail|authenticat|authoriz~i', 'art-security.webp'],
            ['~pandas|data handling|data processing|data preparation|data manipulation|working with data~i', 'mod-07-pandas.png'],
            ['~\brag\b|retrieval~i', 'art-rag.webp'],
            ['~embedding|vector~i', 'mod-17-ai-vector.png'],
            ['~mongo|nosql~i', 'mod-11-nosql-mongodb.png'],
            ['~sql|postgres|database|jdbc|jpa|hibernate|local storage~i', 'mod-03-sql-databases.png'],
            ['~ci/cd|devops~i', 'art-cicd.webp'],
            ['~docker|container|kubernetes~i', 'mod-16-devops-docker.png'],
            ['~deploy|cloud~i', 'mod-12-cloud-data.png'],
            ['~workflow|automation|langchain|langgraph|background job~i', 'art-automation.webp'],
            ['~multimodal~i', 'art-multimodal.webp'],
            ['~fine-tun|model adaptation~i', 'art-fine-tuning.webp'],
            ['~prompt~i', 'art-prompt-engineering.webp'],
            ['~agent|tool calling|function calling~i', 'art-ai-agent.webp'],
            ['~natural language|\bnlp\b|language processing~i', 'art-nlp.webp'],
            ['~deep learning|neural|pytorch|tensorflow~i', 'art-neural-network.webp'],
            ['~creative|photoshop~i', 'art-creative-ai.webp'],
            ['~large language|\bllms?\b|transformer|generative|genai|hugging face|open-source|ai integration|ai-enabled|ai application~i', 'art-llm.webp'],
            ['~power bi|business intelligence|dashboard~i', 'art-dashboard-bi.webp'],
            ['~regression~i', 'art-regression.webp'],
            ['~classification~i', 'art-classification.webp'],
            ['~unsupervised|cluster~i', 'art-clustering.webp'],
            ['~feature eng|feature sel~i', 'art-feature-engineering.webp'],
            ['~evaluation|optimi~i', 'art-model-evaluation.webp'],
            ['~time series|forecast~i', 'art-time-series.webp'],
            ['~statistic|probability|math~i', 'art-statistics.webp'],
            ['~numpy|numerical~i', 'art-arrays.webp'],
            ['~visuali|analytics|analysis|introduction to data~i', 'art-data-viz.webp'],
            ['~machine learning|\bml\b~i', 'art-machine-learning.webp'],
            ['~flutter|\bdart\b|mobile|android|\bios\b~i', 'art-mobile-app.webp'],
            ['~navigation|routing|\bstate\b~i', 'art-navigation-state.webp'],
            ['~react|design system|canva~i', 'art-design-system.webp'],
            ['~branding|visual identity~i', 'art-branding.webp'],
            ['~ui components|responsive|css|frontend|\bgui\b~i', 'art-responsive-ui.webp'],
            ['~figma|coreldraw|\bui\b|\bux\b|wireframe|prototype|design tool~i', 'art-ui-design.webp'],
            ['~interview~i', 'art-interview-prep.webp'],
            ['~hashing~i', 'art-hashing.webp'],
            ['~search~i', 'art-searching.webp'],
            ['~recursion~i', 'art-recursion.webp'],
            ['~tree|heap|graph|pathway~i', 'art-graphs.webp'],
            ['~control flow|control structure~i', 'art-control-flow.webp'],
            ['~linear|array|string|collection|data type~i', 'art-arrays.webp'],
            ['~data structure|\bdsa\b~i', 'mod-02-dsa.png'],
            ['~dynamic programming|problem|pattern~i', 'art-problem-solving.webp'],
            ['~sort|algorithm~i', 'art-sorting.webp'],
            ['~\bstl\b|template|generic~i', 'art-stl-templates.webp'],
            ['~memory|pointer|advanced c\b~i', 'art-memory-pointers.webp'],
            ['~oop|object|class|inherit|polymorph|abstract|interface~i', 'art-oop.webp'],
            ['~exception|error~i', 'art-exceptions.webp'],
            ['~\btest|quality~i', 'art-testing.webp'],
            ['~file|media~i', 'art-file-handling.webp'],
            ['~function|method|modul~i', 'art-functions.webp'],
            ['~control|flow|condition|loop|decision|\bgit\b|version~i', 'art-control-flow.webp'],
            ['~microservice|monolith~i', 'art-microservices.webp'],
            ['~\brest\b|\bapis?\b|backend|http|express|node|spring~i', 'art-rest-api.webp'],
            ['~redis|cach|performance~i', 'art-performance.webp'],
            ['~real-time|realtime|async~i', 'art-realtime.webp'],
            ['~system design|architecture|clean code|integration~i', 'art-system-design.webp'],
            ['~computer basics~i', 'art-computer-basics.webp'],
            ['~block coding|coding start~i', 'art-block-coding.webp'],
            ['~game~i', 'art-game-dev.webp'],
            ['~logic|thinking|puzzle~i', 'art-logic-puzzle.webp'],
            ['~project|mastery|presentation|practical~i', 'art-project-rocket.webp'],
            ['~html|\bweb\b|browser|\bdom\b|next\.?js~i', 'art-web-dev.webp'],
            ['~javascript|typescript|es6~i', 'art-prog-basics.webp'],
            ['~intro|basic|fundamental|foundation|getting started|overview|\bjava\b|c\+\+|programming~i', 'art-prog-basics.webp'],
        ];
        static $fallback = ['art-prog-basics.webp', 'art-functions.webp', 'art-problem-solving.webp', 'art-system-design.webp', 'art-logic-puzzle.webp', 'art-project-rocket.webp'];
        foreach ($rules as [$re, $file]) {
            if (preg_match($re, $title)) {
                return $file;
            }
        }
        return $fallback[$idx % count($fallback)];
    }
}
