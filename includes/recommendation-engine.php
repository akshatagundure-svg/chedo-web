<?php
// includes/recommendation-engine.php
// Chedo Tech Intelligent Career Roadmap & Recommendation Engine

declare(strict_types=1);

class ChedoRecommendationEngine
{
    /**
     * Map career goals to canonical paths and target skill sets.
     */
    private static array $careerProfiles = [
        'Java Full Stack Developer' => [
            'canonical_goal' => 'Java Full Stack Developer',
            'primary_slug' => 'java-full-stack',
            'supporting_slug' => 'java-dsa',
            'required_skills' => [
                'Core Java & OOP',
                'Data Structures & Algorithms',
                'DBMS & MySQL',
                'HTML5, CSS3 & JavaScript',
                'React.js',
                'Spring Boot & REST APIs',
                'Microservices Architecture',
                'Git & GitHub CI/CD',
                'Technical Interview Preparation'
            ],
            'estimated_months' => '5–6 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Student Management REST API',
                    'tech' => 'Java, Spring Boot, MySQL, Postman',
                    'description' => 'Build a production-style REST API implementing CRUD operations, input validation, role-based access, and relational database schema.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Full Stack E-Commerce Web Portal',
                    'tech' => 'Spring Boot, React, MySQL, Tailwind CSS, Stripe/Razorpay',
                    'description' => 'Full-featured web application featuring JWT authentication, product catalog, shopping cart, and transaction management.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Enterprise Microservices Job Portal',
                    'tech' => 'Spring Cloud, Docker, React, MySQL, Redis, AWS/Render',
                    'description' => 'Multi-service distributed architecture with API Gateway, service discovery, distributed caching, and automated CI/CD deployment.'
                ]
            ]
        ],
        'Software Developer' => [
            'canonical_goal' => 'Software Developer',
            'primary_slug' => 'java-full-stack',
            'supporting_slug' => 'data-structures',
            'required_skills' => [
                'Object-Oriented Programming (Java/C++)',
                'Data Structures & Algorithms',
                'DBMS & SQL',
                'System Architecture Fundamentals',
                'Web Technologies (HTML, CSS, JS)',
                'Backend Frameworks & REST APIs',
                'Software Testing & Git',
                'Coding Round & Interview Prep'
            ],
            'estimated_months' => '5–6 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Algorithmic Problem-Solving Suite',
                    'tech' => 'Java/C++, Data Structures, GitHub',
                    'description' => 'Implement 80+ clean, tested solutions to competitive coding problems covering graphs, trees, and dynamic programming.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Task Management & Collaboration Platform',
                    'tech' => 'Spring Boot / Node.js, MySQL, React',
                    'description' => 'Multi-user Kanban workspace with automated notifications, task tracking, and role permissions.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'High-Performance Distributed Cache Service',
                    'tech' => 'Java, Networking Sockets, Concurrency, Docker',
                    'description' => 'Custom in-memory key-value store supporting LRU eviction, multithreaded requests, and persistence.'
                ]
            ]
        ],
        'MERN Full Stack Developer' => [
            'canonical_goal' => 'MERN Full Stack Developer',
            'primary_slug' => 'mern-full-stack',
            'supporting_slug' => 'data-structures',
            'required_skills' => [
                'Modern JavaScript (ES6+)',
                'HTML5 & Advanced CSS',
                'React.js & State Management (Redux/Zustand)',
                'Node.js & Express.js',
                'MongoDB & Mongoose ORM',
                'RESTful API Development',
                'Authentication (JWT / OAuth)',
                'Full Stack Deployment & CI/CD'
            ],
            'estimated_months' => '5–6 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Responsive SaaS Landing Page & CMS API',
                    'tech' => 'HTML, Tailwind CSS, JavaScript, Express',
                    'description' => 'Pixel-perfect, high-performance responsive frontend connected to an Express backend.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Social Community & Blog Platform',
                    'tech' => 'MongoDB, Express, React, Node.js',
                    'description' => 'Complete social platform with markdown posts, comments, likes, user profiles, and image uploads.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Real-Time Team Collaboration & Chat Platform',
                    'tech' => 'MERN Stack, Socket.io, Redis, AWS S3',
                    'description' => 'Real-time multi-room messaging, online status indicators, audio/media sharing, and deployed cloud architecture.'
                ]
            ]
        ],
        'Mobile App Developer' => [
            'canonical_goal' => 'Mobile App Developer',
            'primary_slug' => 'mobile-app',
            'supporting_slug' => 'c-cpp-dsa',
            'required_skills' => [
                'Dart Programming Language',
                'Flutter Framework & Widget Lifecycle',
                'State Management (Provider / Bloc)',
                'REST API Integration',
                'Local Storage (SQLite / Hive)',
                'Firebase Auth & Push Notifications',
                'App Store & Play Store Deployment'
            ],
            'estimated_months' => '4–5 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Personal Finance & Expense Tracker App',
                    'tech' => 'Flutter, Dart, SQLite',
                    'description' => 'Mobile budget manager with category-wise charts, export options, and persistent local storage.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Live Food Delivery User App',
                    'tech' => 'Flutter, REST API, Google Maps, Razorpay',
                    'description' => 'Dynamic food ordering UI with location detection, live order tracking, and online payments.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Cross-Platform Ride Booking Ecosystem',
                    'tech' => 'Flutter, Firebase, WebSockets, Cloud Functions',
                    'description' => 'Real-time driver-passenger matching app with live geofencing, route calculations, and push notifications.'
                ]
            ]
        ],
        'Data Scientist' => [
            'canonical_goal' => 'Data Scientist',
            'primary_slug' => 'data-scientist',
            'supporting_slug' => 'data-science',
            'required_skills' => [
                'Python Programming',
                'NumPy & Pandas for Data Manipulation',
                'Data Visualization (Matplotlib & Seaborn)',
                'Applied Statistics & Probability',
                'Machine Learning Algorithms (Scikit-Learn)',
                'SQL & Relational Databases',
                'Model Evaluation & Feature Engineering',
                'Model Deployment (Streamlit / Flask)'
            ],
            'estimated_months' => '5–6 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Exploratory Data Analysis on Global Market Trends',
                    'tech' => 'Python, Pandas, Seaborn, Jupyter',
                    'description' => 'In-depth statistical exploratory data analysis uncovering actionable consumer behavioral patterns.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Customer Churn & Lifetime Value Prediction',
                    'tech' => 'Scikit-Learn, XGBoost, Streamlit',
                    'description' => 'Machine learning classification pipeline with feature importance analysis and interactive risk dashboard.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'End-to-End Predictive Health Analytics System',
                    'tech' => 'Python, MLflow, Docker, FastAPI',
                    'description' => 'Production-ready clinical prognosis predictor with automated drift detection and REST endpoints.'
                ]
            ]
        ],
        'AI / ML Engineer' => [
            'canonical_goal' => 'AI / ML Engineer',
            'primary_slug' => 'ai-engineer',
            'supporting_slug' => 'ml-engineer',
            'required_skills' => [
                'Python & Mathematical Foundations',
                'Classical Machine Learning',
                'Deep Learning (PyTorch / TensorFlow)',
                'Computer Vision & NLP Fundamentals',
                'MLOps & Model Optimization',
                'FastAPI Model Serving',
                'Docker & Cloud Deployment'
            ],
            'estimated_months' => '5–6 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Computer Vision Object Classifier',
                    'tech' => 'Python, OpenCV, PyTorch',
                    'description' => 'Convolutional neural network achieving high accuracy on industrial defect classification.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'NLP Sentiment & Entity Extraction Engine',
                    'tech' => 'HuggingFace Transformers, FastAPI',
                    'description' => 'Transformer-based text analytics microservice serving real-time predictions.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Full MLOps Automated Training Pipeline',
                    'tech' => 'Docker, MLflow, PyTorch, Kubernetes',
                    'description' => 'Autonomous retraining workflow with experiment tracking and automated model registry.'
                ]
            ]
        ],
        'Data Engineer' => [
            'canonical_goal' => 'Data Engineer',
            'primary_slug' => 'data-engineer',
            'supporting_slug' => 'data-science',
            'required_skills' => [
                'Advanced SQL & Query Optimization',
                'Python for Data Engineering',
                'Data Warehousing & Data Lakes',
                'Distributed Computing (Apache Spark)',
                'ETL Pipeline Orchestration (Airflow)',
                'Kafka Real-Time Streaming',
                'Cloud Storage & Redshift/BigQuery'
            ],
            'estimated_months' => '5–6 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Automated Web Scraper & SQL Warehouse',
                    'tech' => 'Python, PostgreSQL, Cron',
                    'description' => 'Automated ingestion pipeline extracting and staging unstructured data into 3NF normalized tables.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Batch Analytics ETL Pipeline with Apache Airflow',
                    'tech' => 'Airflow, Spark, PostgreSQL, Docker',
                    'description' => 'Scheduled multi-source aggregation workflow with automated data quality assertions.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Real-Time Financial Fraud Detection Pipeline',
                    'tech' => 'Apache Kafka, Spark Streaming, Delta Lake',
                    'description' => 'Sub-second event stream processing system identifying high-risk transactions at scale.'
                ]
            ]
        ],
        'Generative AI Engineer' => [
            'canonical_goal' => 'Generative AI Engineer',
            'primary_slug' => 'gen-ai-engineer',
            'supporting_slug' => 'ai-engineer',
            'required_skills' => [
                'Python & LLM Architecture Basics',
                'Prompt Engineering & Structured Outputs',
                'Vector Databases (ChromaDB / Pinecone)',
                'Retrieval-Augmented Generation (RAG)',
                'LangChain & LlamaIndex Frameworks',
                'Fine-Tuning Open Source LLMs (LoRA/QLoRA)',
                'Production Deployment & Guardrails'
            ],
            'estimated_months' => '5–6 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Domain-Specific Legal & Academic Assistant',
                    'tech' => 'Python, OpenAI/DeepSeek API, Streamlit',
                    'description' => 'Prompt-engineered intelligent assistant with context citation and reasoning traces.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Enterprise Document RAG Knowledge Base',
                    'tech' => 'LangChain, ChromaDB, FastAPI, React',
                    'description' => 'Multi-modal document indexing and query system with hybrid semantic and keyword search.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Autonomous Multi-Model Generative AI Suite',
                    'tech' => 'Llama 3 / Mistral, QLoRA, vLLM, Docker',
                    'description' => 'Self-hosted open-source model pipeline fine-tuned on specialized organizational datasets.'
                ]
            ]
        ],
        'Agentic AI Engineer' => [
            'canonical_goal' => 'Agentic AI Engineer',
            'primary_slug' => 'agentic-ai-engineer',
            'supporting_slug' => 'gen-ai-engineer',
            'required_skills' => [
                'Agent Architectures (ReAct, Planning, Reflection)',
                'Tool Use & Function Calling',
                'Multi-Agent Coordination (CrewAI / AutoGen / LangGraph)',
                'Persistent Memory & State Management',
                'Human-in-the-Loop Safeguards',
                'API Tool Integrations & Execution Sandboxes'
            ],
            'estimated_months' => '5–6 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Web Research & Automated Briefing Agent',
                    'tech' => 'Python, LangChain, Tavily API',
                    'description' => 'Single-agent research system that searches the web, verifies sources, and writes executive briefs.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Autonomous Software QA & Bug Hunter Team',
                    'tech' => 'CrewAI, Git, Python, Docker',
                    'description' => 'Multi-agent system consisting of Tester, Analyzer, and Fixer agents iterating on code repos.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Autonomous Enterprise Operations Assistant',
                    'tech' => 'LangGraph, Multi-Agent, Tool Calling, Vector DB',
                    'description' => 'Full-fledged agentic workflow executing business tasks across databases, emails, and CRM systems.'
                ]
            ]
        ],
        'UI/UX Designer' => [
            'canonical_goal' => 'UI/UX Designer',
            'primary_slug' => 'ui-ux',
            'supporting_slug' => 'mern-full-stack',
            'required_skills' => [
                'User Research & Persona Mapping',
                'Information Architecture & Wireframing',
                'Figma & Design Systems',
                'Typography, Color Theory & Spacing',
                'Interactive Prototyping & Micro-interactions',
                'Usability Testing & Design Handoff',
                'HTML & CSS Fundamentals for Designers'
            ],
            'estimated_months' => '3–4 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Fintech Mobile Banking Onboarding Flow',
                    'tech' => 'Figma, Wireframing, User Journey Maps',
                    'description' => 'Comprehensive low-to-high fidelity user onboarding experience with documented user testing.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Complete SaaS Design System & Web Application',
                    'tech' => 'Figma, Auto-Layout, Component Variables, Tokens',
                    'description' => 'Scalable enterprise design library covering 40+ atomic components and responsive dashboard screens.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Health & Telemedicine Interactive Prototype',
                    'tech' => 'Figma Advanced Prototyping, Usability Report',
                    'description' => 'Realistic clickable prototype simulating doctor appointments, tele-consultation, and records.'
                ]
            ]
        ],
        'Data Analyst' => [
            'canonical_goal' => 'Data Analyst',
            'primary_slug' => 'data-science-foundation',
            'supporting_slug' => 'data-science',
            'required_skills' => [
                'Advanced Microsoft Excel (Formulas, Pivot, Lookups)',
                'SQL & Relational Database Querying',
                'Power BI / Tableau Interactive Dashboards',
                'Python Basics for Data Analysis (Pandas)',
                'Business Metrics & KPI Modeling',
                'Storytelling with Data & Stakeholder Presentation'
            ],
            'estimated_months' => '3–4 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Retail Sales Performance Excel Dashboard',
                    'tech' => 'Excel, Power Query, Pivot Tables',
                    'description' => 'Automated sales report modeling seasonal revenue fluctuations and regional variance.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'E-Commerce SQL Analytics & Retention Funnel',
                    'tech' => 'MySQL, Window Functions, CTEs',
                    'description' => 'Complex SQL queries extracting cohort analysis, churn rate, and repeat customer ratios.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Executive Power BI Corporate Performance Suite',
                    'tech' => 'Power BI, DAX, Python, SQL',
                    'description' => 'Interactive executive dashboard connecting to live data feeds with drill-down capabilities.'
                ]
            ]
        ],
        'Not Sure Yet' => [
            'canonical_goal' => 'Software Developer',
            'primary_slug' => 'c-cpp-dsa',
            'supporting_slug' => 'java-programming',
            'required_skills' => [
                'Computer Science & Programming Fundamentals',
                'C / C++ Programming',
                'Data Structures & Algorithms Basics',
                'Database Basics (SQL)',
                'Career Exploration across Full Stack & AI'
            ],
            'estimated_months' => '4–5 Months',
            'projects' => [
                [
                    'level' => 'Foundation Project',
                    'title' => 'Student Record Management System in C/C++',
                    'tech' => 'C/C++, File I/O, Pointers',
                    'description' => 'Console system handling persistent file-based data records, memory pointers, and search.'
                ],
                [
                    'level' => 'Intermediate Project',
                    'title' => 'Mini Database & Query Processor',
                    'tech' => 'C++, Linked Lists, Trees',
                    'description' => 'Custom mini database engine executing basic insertion, deletion, and index traversal.'
                ],
                [
                    'level' => 'Advanced Capstone Project',
                    'title' => 'Interactive Portfolio Web App',
                    'tech' => 'HTML, CSS, JavaScript, GitHub',
                    'description' => 'Personal showcase of completed coding assignments and algorithmic practice solutions.'
                ]
            ]
        ]
    ];

    /**
     * Generate the complete personalized recommendation package.
     */
    public static function analyzeAndRecommend(array $input, PDO $pdo): array
    {
        // 1. Sanitize & Normalize Inputs
        $learningLevel = trim($input['learning_level'] ?? 'Complete Beginner');
        $careerGoal = trim($input['career_goal'] ?? 'Software Developer');
        $objective = trim($input['learning_objective'] ?? 'Job and interview preparation');
        $availability = trim($input['daily_availability'] ?? '2–4 hours');
        
        $rawKnown = $input['known_technologies'] ?? [];
        if (is_string($rawKnown)) {
            $decoded = json_decode($rawKnown, true);
            $rawKnown = is_array($decoded) ? $decoded : array_map('trim', explode(',', $rawKnown));
        }
        $knownTechs = array_values(array_filter(array_map('trim', (array)$rawKnown), function($t) {
            return $t !== '' && strtolower($t) !== 'none';
        }));

        // Normalize career profile
        $profile = self::$careerProfiles[$careerGoal] ?? self::$careerProfiles['Software Developer'];
        $recommendedCareer = $profile['canonical_goal'];

        // 2. Fetch all active CMS courses from database
        $cmsCourses = [];
        try {
            $stmt = $pdo->query("SELECT id, title, slug, level, short_description, featured FROM courses WHERE status = 1 ORDER BY sort_order ASC, id ASC");
            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $c) {
                $cmsCourses[$c['slug']] = $c;
            }
        } catch (Throwable $e) {
            error_log("RecommendationEngine: Failed to query courses: " . $e->getMessage());
        }

        // 3. Resolve Primary & Supporting CMS Courses
        $primarySlug = $profile['primary_slug'];
        $supportingSlug = $profile['supporting_slug'];

        // Adaptive course resolution based on known tech and objective
        if ($recommendedCareer === 'Java Full Stack Developer') {
            $primarySlug = 'java-full-stack';
            // If student already has basic Java/C/C++, the supporting course is Java+DSA or Data Structures
            if (in_array('Java', $knownTechs, true) || in_array('DSA', $knownTechs, true)) {
                $supportingSlug = isset($cmsCourses['java-dsa']) ? 'java-dsa' : 'data-structures';
            } else {
                $supportingSlug = 'java-programming';
            }
        } elseif ($recommendedCareer === 'Software Developer') {
            if (in_array('Java', $knownTechs, true)) {
                $primarySlug = 'java-full-stack';
                $supportingSlug = 'data-structures';
            } elseif (in_array('Python', $knownTechs, true)) {
                $primarySlug = 'python-dsa';
                $supportingSlug = 'data-structures';
            } else {
                $primarySlug = 'c-cpp-dsa';
                $supportingSlug = 'java-full-stack';
            }
        }

        $primaryCourse = $cmsCourses[$primarySlug] ?? [
            'id' => 9,
            'title' => 'Java Full Stack Development',
            'slug' => 'java-full-stack',
            'level' => 'Advanced',
            'short_description' => 'Comprehensive enterprise Java, Spring Boot, React, and MySQL training.'
        ];

        $supportingCourse = $cmsCourses[$supportingSlug] ?? [
            'id' => 14,
            'title' => 'Java + DSA Foundation',
            'slug' => 'java-dsa',
            'level' => 'Beginner',
            'short_description' => 'Master Core Java, Object-Oriented Programming, and algorithmic problem-solving.'
        ];

        // 4. Skill-Gap Analysis
        $skillGap = self::calculateSkillGap($knownTechs, $learningLevel, $recommendedCareer, $objective);

        // 5. Calculate Documented Match Scores
        $scores = self::calculateMatchScores($learningLevel, $recommendedCareer, $knownTechs, $objective, $primaryCourse, $supportingCourse);

        // 6. Generate Dynamic 5-Stage Visual Roadmap
        $roadmap = self::generateRoadmapStages($recommendedCareer, $knownTechs, $learningLevel, $primaryCourse, $supportingCourse, $cmsCourses);

        // 7. Generate Personalized Daily Study Plan
        $studyPlan = self::generateDailyStudyPlan($availability, $recommendedCareer, $objective);

        // 8. Progressively Challenging Projects
        $projects = $profile['projects'];

        // 9. Job Readiness & Placement Preparation Milestones
        $jobReadiness = self::generateJobReadinessMilestones($recommendedCareer, $objective);

        // 10. Estimated Duration
        $duration = self::calculateEstimatedDuration($availability, $learningLevel, $profile['estimated_months']);

        return [
            'career_profile' => [
                'recommended_career' => $recommendedCareer,
                'learning_level' => $learningLevel,
                'known_technologies' => $knownTechs,
                'learning_objective' => $objective,
                'daily_availability' => $availability,
                'estimated_duration' => $duration,
            ],
            'skill_gap_analysis' => $skillGap,
            'recommended_courses' => [
                'primary' => [
                    'id' => (int)$primaryCourse['id'],
                    'name' => $primaryCourse['title'],
                    'slug' => $primaryCourse['slug'],
                    'level' => $primaryCourse['level'] ?? 'Intermediate',
                    'percentage' => $scores['primary_score'],
                    'is_top_match' => true,
                    'reason' => self::buildPrimaryReason($recommendedCareer, $primaryCourse['title'], $objective),
                    'url' => '/course.php?slug=' . rawurlencode($primaryCourse['slug']),
                    'short_description' => $primaryCourse['short_description'] ?? ''
                ],
                'supporting' => [
                    'id' => (int)$supportingCourse['id'],
                    'name' => $supportingCourse['title'],
                    'slug' => $supportingCourse['slug'],
                    'level' => $supportingCourse['level'] ?? 'Foundation',
                    'percentage' => $scores['supporting_score'],
                    'is_top_match' => false,
                    'reason' => self::buildSupportingReason($supportingCourse['title'], $knownTechs, $objective),
                    'url' => '/course.php?slug=' . rawurlencode($supportingCourse['slug']),
                    'short_description' => $supportingCourse['short_description'] ?? ''
                ],
                'recommended_order' => [
                    1 => $supportingCourse['title'] . " (Foundation & Interview Problem-Solving)",
                    2 => $primaryCourse['title'] . " (Specialization, Enterprise Frameworks & Full Stack)"
                ]
            ],
            'roadmap' => $roadmap,
            'daily_study_plan' => $studyPlan,
            'project_recommendations' => $projects,
            'job_readiness' => $jobReadiness,
            'scores' => $scores
        ];
    }

    /**
     * Classifies skills into: Already Known, Needs Revision, and Needs to Learn.
     */
    private static function calculateSkillGap(array $knownTechs, string $level, string $career, string $objective): array
    {
        $alreadyKnown = [];
        $needsRevision = [];
        $needsToLearn = [];

        // All canonical skills for target career
        $targetSkills = self::$careerProfiles[$career]['required_skills'] ?? [];

        // Mapping from user selected techs to career skills
        $techMapping = [
            'Java' => 'Core Java & OOP',
            'DSA' => 'Data Structures & Algorithms',
            'SQL / MySQL' => 'DBMS & MySQL',
            'HTML' => 'HTML5, CSS3 & JavaScript',
            'CSS' => 'HTML5, CSS3 & JavaScript',
            'JavaScript' => 'HTML5, CSS3 & JavaScript',
            'React' => 'React.js',
            'Spring Boot' => 'Spring Boot & REST APIs',
            'MongoDB' => 'MongoDB & Mongoose ORM',
            'Python' => 'Python Programming',
            'C' => 'Programming Fundamentals',
            'C++' => 'Object-Oriented Programming (C++)'
        ];

        // 1. Evaluate student's known technologies
        foreach ($knownTechs as $t) {
            // Is it relevant to this career?
            $mappedSkill = $techMapping[$t] ?? $t;

            // Self-reported skills are treated as provisional:
            // If the student is a beginner or has chosen "Job and interview preparation",
            // foundational skills like Java or DSA require rigorous revision.
            if ($level === 'Complete Beginner' || $level === 'Know Basic Programming') {
                if (in_array($t, ['Java', 'DSA', 'SQL / MySQL', 'JavaScript', 'Python', 'C++'], true)) {
                    $needsRevision[] = "$t (Revision & Interview Depth)";
                } else {
                    $alreadyKnown[] = "$t (Basic)";
                }
            } else {
                if ($objective === 'Job and interview preparation' && in_array($t, ['DSA', 'Java', 'Python'], true)) {
                    $needsRevision[] = "$t (DSA Optimization & Mock Practice)";
                } else {
                    $alreadyKnown[] = $t;
                }
            }
        }

        // Add additional prior languages to already known (e.g. C, C++, Python when learning Java Full Stack)
        foreach ($knownTechs as $t) {
            if (!in_array($t, ['Java', 'Spring Boot'], true) && $career === 'Java Full Stack Developer') {
                if (!in_array($t, $alreadyKnown, true) && !in_array("$t (Basic)", $alreadyKnown, true) && !in_array("$t (Revision & Interview Depth)", $needsRevision, true)) {
                    $alreadyKnown[] = $t;
                }
            }
        }

        // 2. Determine what needs to be learned for this career
        foreach ($targetSkills as $req) {
            $covered = false;
            foreach ($alreadyKnown as $ak) {
                if (stripos($ak, $req) !== false || (isset($techMapping[$ak]) && $techMapping[$ak] === $req)) {
                    $covered = true;
                    break;
                }
            }
            if (!$covered) {
                foreach ($needsRevision as $nr) {
                    if (stripos($nr, $req) !== false) {
                        $covered = true;
                        break;
                    }
                }
            }
            if (!$covered) {
                $needsToLearn[] = $req;
            }
        }

        return [
            'already_known' => array_values(array_unique($alreadyKnown)),
            'needs_revision' => array_values(array_unique($needsRevision)),
            'needs_to_learn' => array_values(array_unique($needsToLearn))
        ];
    }

    /**
     * Compute deterministic, documented match scores (0–100%).
     */
    private static function calculateMatchScores(string $level, string $career, array $knownTechs, string $objective, array $primaryCourse, array $supportingCourse): array
    {
        // Criteria 1: Career Alignment (50 pts base)
        $primaryScore = 52;
        $supportingScore = 48;

        // Criteria 2: Known tech overlap & readiness (up to 30 pts)
        if ($career === 'Java Full Stack Developer') {
            if (in_array('Java', $knownTechs, true)) {
                $primaryScore += 18;
                $supportingScore += 24; // Needs DSA & Java foundation refinement
            }
            if (in_array('C', $knownTechs, true) || in_array('C++', $knownTechs, true)) {
                $primaryScore += 10;
                $supportingScore += 10;
            }
            if (in_array('Python', $knownTechs, true)) {
                $primaryScore += 6;
            }
        } elseif ($career === 'MERN Full Stack Developer') {
            if (in_array('JavaScript', $knownTechs, true) || in_array('HTML', $knownTechs, true)) {
                $primaryScore += 24;
            }
            if (in_array('React', $knownTechs, true)) {
                $primaryScore += 10;
            }
        } else {
            if (!empty($knownTechs)) {
                $primaryScore += 20;
                $supportingScore += 18;
            }
        }

        // Criteria 3: Learning Objective alignment (up to 20 pts)
        if ($objective === 'Job and interview preparation') {
            $primaryScore += 12;
            $supportingScore += 10; // DSA is critical for jobs
        } elseif ($objective === 'Build real-world projects') {
            $primaryScore += 14;
            $supportingScore += 6;
        } else {
            $primaryScore += 8;
            $supportingScore += 8;
        }

        // Cap scores between 75% and 98%
        $primaryScore = min(98, max(82, $primaryScore));
        $supportingScore = min(94, max(75, $supportingScore));

        return [
            'primary_score' => $primaryScore,
            'supporting_score' => $supportingScore,
            'explanation' => "Calculated using Chedo Career Index (Career Goal: 50%, Prerequisite Readiness: 30%, Learning Objective: 20%)."
        ];
    }

    /**
     * Builds the personalized 5-stage career roadmap.
     */
    private static function generateRoadmapStages(string $career, array $knownTechs, string $level, array $primaryCourse, array $supportingCourse, array $cmsCourses): array
    {
        $stages = [];

        if ($career === 'Java Full Stack Developer') {
            // Stage 1: Foundation / Revision
            $hasJavaOrDSA = in_array('Java', $knownTechs, true) || in_array('DSA', $knownTechs, true);
            $stages[] = [
                'stage_number' => 1,
                'stage_name' => 'FOUNDATION: Java & DSA Revision',
                'description' => 'Reinforce object-oriented programming in Java and master data structures and algorithms required for technical coding rounds.',
                'skills' => ['Core Java', 'OOP Principles', 'Memory Model', 'Arrays, Strings, Linked Lists', 'Stacks, Queues, Binary Trees', 'Complexity Analysis (Big O)'],
                'chedo_course' => [
                    'title' => $supportingCourse['title'],
                    'slug' => $supportingCourse['slug'],
                    'url' => '/course.php?slug=' . rawurlencode($supportingCourse['slug'])
                ],
                'duration' => '4–5 Weeks',
                'milestone' => 'Solve 60+ interview coding challenges on LeetCode/HackerRank and build a console banking application.',
                'reason' => 'Companies test DSA and Core Java logic in the initial elimination rounds before testing frameworks.'
            ];

            // Stage 2: Database Systems & Persistence
            $stages[] = [
                'stage_number' => 2,
                'stage_name' => 'EXPANSION: Relational DBMS & SQL Mastery',
                'description' => 'Design production database schemas, write complex relational queries, optimize indexes, and understand transaction ACID properties.',
                'skills' => ['Relational Data Modeling', 'SQL Joins, Subqueries & CTEs', 'Indexing & Query Optimization', 'Transactions (ACID)', 'JDBC & Connection Pooling'],
                'chedo_course' => null,
                'duration' => '3 Weeks',
                'milestone' => 'Design an enterprise database schema for an order-processing system with indexing and stored procedures.',
                'reason' => 'Every enterprise Java backend relies heavily on relational database performance.'
            ];

            // Stage 3: Web Fundamentals & Interactive UI
            $stages[] = [
                'stage_number' => 3,
                'stage_name' => 'WEB FUNDAMENTALS: Modern Frontend UI',
                'description' => 'Master responsive layouts, modern JavaScript (ES6+), DOM events, and asynchronous HTTP calls to prepare for full-stack integration.',
                'skills' => ['HTML5 Semantic Structure', 'CSS3 Flexbox & Grid', 'JavaScript ES6+ (Async/Await, Promises)', 'Fetch & REST Consumptions', 'Bootstrap / Tailwind CSS'],
                'chedo_course' => null,
                'duration' => '3–4 Weeks',
                'milestone' => 'Develop a responsive frontend interface consuming public REST APIs with dynamic filtering and validation.',
                'reason' => 'Provides the client-side foundation before mastering React and Spring Boot integration.'
            ];

            // Stage 4: Specialization - React, Spring Boot & REST APIs
            $stages[] = [
                'stage_number' => 4,
                'stage_name' => 'SPECIALIZATION: Spring Boot, REST APIs & React',
                'description' => 'Master the industry-standard enterprise Java framework, building robust RESTful microservices paired with a modern React frontend.',
                'skills' => ['Spring Core & Dependency Injection', 'Spring Boot 3 REST APIs', 'Spring Data JPA & Hibernate', 'JWT Authentication & Security', 'React Components & Hooks', 'Axios & State Management'],
                'chedo_course' => [
                    'title' => $primaryCourse['title'],
                    'slug' => $primaryCourse['slug'],
                    'url' => '/course.php?slug=' . rawurlencode($primaryCourse['slug'])
                ],
                'duration' => '8–10 Weeks',
                'milestone' => 'Develop a production-ready Full Stack E-Commerce web application with Spring Boot, MySQL, and React.',
                'reason' => 'Core industry hiring requirement for high-paying Java Full Stack Developer positions.'
            ];

            // Stage 5: Job Readiness & Interview Preparation
            $stages[] = [
                'stage_number' => 5,
                'stage_name' => 'JOB READINESS: Projects, Resume & Mock Interviews',
                'description' => 'Prepare for top MNC and startup technical rounds with daily coding drills, architectural reviews, portfolio hosting, and mock interviews.',
                'skills' => ['Full Stack Capstone Deployment', 'GitHub Portfolio & CI/CD Actions', 'System Design & Architecture Basics', 'Technical Java Interview Drills', 'Aptitude & Communication Skills', '1-on-1 Mentor Mock Interviews'],
                'chedo_course' => null,
                'duration' => '4 Weeks',
                'milestone' => 'Deploy 3 full stack projects with live URLs, finalize an ATS-optimized resume, and clear Chedo mock interviews.',
                'reason' => 'Ensures you convert technical interviews into verified job offers with confidence.'
            ];
        } else {
            // Generic 5-stage roadmap for other careers
            $targetSkills = self::$careerProfiles[$career]['required_skills'] ?? ['Programming', 'Data Structures', 'Web/AI', 'Projects'];
            $chunks = array_chunk($targetSkills, max(2, (int)ceil(count($targetSkills) / 4)));

            $stages[] = [
                'stage_number' => 1,
                'stage_name' => 'STAGE 1: Foundations & Core Concepts',
                'description' => 'Build a solid conceptual grounding in syntax, problem solving, and basic computational models.',
                'skills' => $chunks[0] ?? ['Core Syntax', 'Algorithms'],
                'chedo_course' => [
                    'title' => $supportingCourse['title'],
                    'slug' => $supportingCourse['slug'],
                    'url' => '/course.php?slug=' . rawurlencode($supportingCourse['slug'])
                ],
                'duration' => '4 Weeks',
                'milestone' => 'Complete foundational coding challenges and master fundamental principles.',
                'reason' => 'Prerequisite for understanding advanced architectural paradigms.'
            ];

            $stages[] = [
                'stage_number' => 2,
                'stage_name' => 'STAGE 2: Expansion & Data Management',
                'description' => 'Learn data management, persistence, and algorithmic optimization techniques.',
                'skills' => $chunks[1] ?? ['Data Modeling', 'Queries'],
                'chedo_course' => null,
                'duration' => '4 Weeks',
                'milestone' => 'Build structured data storage schemas and performance-optimized queries.',
                'reason' => 'Essential for real-world application data lifecycles.'
            ];

            $stages[] = [
                'stage_number' => 3,
                'stage_name' => 'STAGE 3: Core Specialization',
                'description' => 'Deep dive into ' . $career . ' tools, libraries, and design patterns.',
                'skills' => $chunks[2] ?? ['Specialization Frameworks'],
                'chedo_course' => [
                    'title' => $primaryCourse['title'],
                    'slug' => $primaryCourse['slug'],
                    'url' => '/course.php?slug=' . rawurlencode($primaryCourse['slug'])
                ],
                'duration' => '8 Weeks',
                'milestone' => 'Implement end-to-end applications demonstrating target domain competency.',
                'reason' => 'Primary industry qualification requirement.'
            ];

            $stages[] = [
                'stage_number' => 4,
                'stage_name' => 'STAGE 4: Production Projects & Integration',
                'description' => 'Connect all moving pieces into high-quality, deployable software systems.',
                'skills' => $chunks[3] ?? ['Full System Architecture', 'Cloud Deployment'],
                'chedo_course' => null,
                'duration' => '4 Weeks',
                'milestone' => 'Deploy real-world production projects on cloud infrastructure.',
                'reason' => 'Validates real-world software engineering capabilities to employers.'
            ];

            $stages[] = [
                'stage_number' => 5,
                'stage_name' => 'STAGE 5: Job Readiness & Placement Success',
                'description' => 'Comprehensive technical interview rounds, system design, portfolio, and mock interviews.',
                'skills' => ['Technical Interview Rounds', 'Resume Building', 'GitHub Showcase', 'Mock Interviews'],
                'chedo_course' => null,
                'duration' => '4 Weeks',
                'milestone' => 'Clear mock technical and HR rounds, finalize job applications.',
                'reason' => 'Translates skills into successful hiring outcomes.'
            ];
        }

        return $stages;
    }

    /**
     * Generates a tailored daily study schedule.
     */
    private static function generateDailyStudyPlan(string $availability, string $career, string $objective): array
    {
        switch ($availability) {
            case 'Less than 1 hour':
                return [
                    'total_hours' => '45–60 Minutes/day',
                    'schedule' => [
                        ['time' => '25 mins', 'activity' => 'Core Specialization Learning', 'focus' => 'Concept study, syntax & architecture reading'],
                        ['time' => '25 mins', 'activity' => 'Hands-on Coding Practice', 'focus' => 'Writing clean code & fixing exercise problems'],
                        ['time' => '10 mins', 'activity' => 'Revision & Flashcards', 'focus' => 'Reviewing key concepts and interview notes']
                    ],
                    'advice' => 'Consistency is key. 1 focused hour every single day produces dramatic long-term career growth.'
                ];
            case '1–2 hours':
                return [
                    'total_hours' => '1.5–2 Hours/day',
                    'schedule' => [
                        ['time' => '30 mins', 'activity' => 'DSA & Algorithmic Problem Solving', 'focus' => 'Solve 1-2 coding problems daily'],
                        ['time' => '45 mins', 'activity' => 'Core Framework & Specialization', 'focus' => 'Hands-on tutorials & framework deep-dive'],
                        ['time' => '30 mins', 'activity' => 'Project Implementation', 'focus' => 'Building modular components in your active project'],
                        ['time' => '15 mins', 'activity' => 'Technical Interview Review', 'focus' => 'Common interview questions & memory checkpoints']
                    ],
                    'advice' => 'Ideal pace for working professionals and college students balancing coursework.'
                ];
            case 'More than 4 hours':
                return [
                    'total_hours' => '4–5 Hours/day (Intensive Placement Track)',
                    'schedule' => [
                        ['time' => '75 mins', 'activity' => 'DSA & Competitive Coding', 'focus' => '2-3 medium/hard problems (Trees, Graphs, DP)'],
                        ['time' => '90 mins', 'activity' => 'Deep Framework Engineering', 'focus' => 'Backend microservices, security, and database indexing'],
                        ['time' => '75 mins', 'activity' => 'Full Stack Project Development', 'focus' => 'Production-ready feature development & testing'],
                        ['time' => '45 mins', 'activity' => 'System Design & Interview Prep', 'focus' => 'High-level architecture, mock tests & resume reviews']
                    ],
                    'advice' => 'Fast-track immersive schedule designed to complete the career switch in under 4 months.'
                ];
            case '2–4 hours':
            default:
                return [
                    'total_hours' => '2.5–3 Hours/day (Recommended Standard)',
                    'schedule' => [
                        ['time' => '45 mins', 'activity' => 'Data Structures & Algorithms (DSA)', 'focus' => 'Daily LeetCode/HackerRank coding problems, time-complexity analysis'],
                        ['time' => '60 mins', 'activity' => 'Career Specialization & Frameworks', 'focus' => 'Spring Boot / React development, REST APIs, and database transactions'],
                        ['time' => '45 mins', 'activity' => 'Hands-On Project Development', 'focus' => 'Implementing real-world project features, Git commits, and tests'],
                        ['time' => '30 mins', 'activity' => 'Interview Preparation & Aptitude', 'focus' => 'Core technical concepts, debugging questions, and system design']
                    ],
                    'advice' => 'Balanced, sustainable pace that guarantees maximum knowledge retention and placement success within 5–6 months.'
                ];
        }
    }

    /**
     * Job readiness curriculum milestones.
     */
    private static function generateJobReadinessMilestones(string $career, string $objective): array
    {
        return [
            'dsa_practice' => [
                'title' => 'DSA & Coding Assessment Readiness',
                'items' => [
                    'Arrays, Two Pointers, Sliding Window technique',
                    'Linked Lists, Stacks, Queues & Hash Maps',
                    'Binary Trees, Binary Search Trees & Traversals',
                    'Sorting, Searching & Recursion',
                    'Introduction to Dynamic Programming & Graphs'
                ]
            ],
            'technical_interview' => [
                'title' => 'Technical Interview Topics',
                'items' => [
                    'OOP Principles: Polymorphism, Inheritance, Encapsulation, Abstraction',
                    'Memory Management, JVM Architecture & Garbage Collection',
                    'Multithreading, Concurrency & Collections Framework',
                    'RESTful API Principles, HTTP Status Codes & Idempotency',
                    'Database Indexing, Transactions (ACID) & Normalization'
                ]
            ],
            'placement_preparation' => [
                'title' => 'Portfolio & Placement Readiness',
                'items' => [
                    'ATS-compliant Resume tailored for ' . $career,
                    'Clean GitHub portfolio with documented READMEs and live links',
                    'LinkedIn profile optimization for IT recruiters in Pune & Bangalore',
                    'Weekly 1-on-1 mock technical interviews with Chedo senior mentors',
                    'HR interview coaching, behavioral rounds & salary negotiation guidance'
                ]
            ]
        ];
    }

    private static function calculateEstimatedDuration(string $availability, string $level, string $baseMonths): string
    {
        if ($availability === 'More than 4 hours') {
            return '3.5–4.5 Months (Accelerated)';
        }
        if ($availability === 'Less than 1 hour') {
            return '7–9 Months (Self-Paced)';
        }
        return $baseMonths;
    }

    private static function buildPrimaryReason(string $career, string $courseTitle, string $objective): string
    {
        return "Directly matches your target career goal as a {$career}. Covers industry-standard enterprise frameworks, practical architecture, and job-ready skills.";
    }

    private static function buildSupportingReason(string $courseTitle, array $knownTechs, string $objective): string
    {
        $hasBasics = in_array('Java', $knownTechs, true) || in_array('C++', $knownTechs, true) || in_array('C', $knownTechs, true);
        if ($hasBasics) {
            return "Reinforces your algorithmic problem-solving and coding speed for technical elimination rounds and interview problem-solving.";
        }
        return "Builds strong programming and algorithmic fundamentals before advancing to enterprise framework development.";
    }
}
