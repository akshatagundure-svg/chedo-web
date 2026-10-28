<?php
// Check if current page is a course page (excluding courses catalog)
$chedotech_script = str_replace('\\', '/', $_SERVER['SCRIPT_FILENAME'] ?? $_SERVER['PHP_SELF'] ?? '');
$chedotech_page = basename($chedotech_script);
$chedotech_is_course = (
  strpos($chedotech_script, '/courses/') !== false
  && $chedotech_page !== 'courses.php'
);

if ($chedotech_is_course):
  // Resolve course title cleanly from $page_title or breadcrumbs or filename
  $syllabus_course_name = '';
  if (!empty($course_name)) {
    $syllabus_course_name = $course_name;
  } elseif (!empty($page_title)) {
    $clean_title = html_entity_decode($page_title, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $clean_title = preg_replace('/\s*\|\s*Chedo Tech$/i', '', $clean_title);
    $clean_title = preg_replace('/\s*(Course|Training|Classes)?\s*in Pune$/i', '', $clean_title);
    $syllabus_course_name = trim($clean_title);
  }
  if (empty($syllabus_course_name)) {
    $basename = basename($chedotech_script, '.php');
    $syllabus_course_name = ucwords(str_replace('-', ' ', $basename));
  }

  // Course Syllabi registry
  $available_syllabi = [
    'c-programming.php' => [
      'title' => 'C Programming Full Syllabus',
      'badge' => '39 Topics',
      'subtitle' => 'Comprehensive curriculum from fundamentals & memory to pointers, structures & file handling',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Introduction & Programming Logic'],
        ['num' => '02', 'title' => 'Data Types & Number Systems'],
        ['num' => '03', 'title' => 'Operators & ASCII Values'],
        ['num' => '04', 'title' => 'Preprocessors & Practice Labs'],
        ['num' => '05', 'title' => 'Conditional & Branching Logic'],
        ['num' => '06', 'title' => 'Loops & Iterative Problems'],
        ['num' => '07', 'title' => 'Arrays & String Manipulation'],
        ['num' => '08', 'title' => 'Pointers & Dynamic Memory (DMA)'],
        ['num' => '09', 'title' => 'Functions, Recursion & Math'],
        ['num' => '10', 'title' => 'Structures, File Handling & Enums'],
      ],
      'topics' => [
        'Introduction',
        'How Programming Works',
        'Data Types introduction',
        'Number Systems',
        'Operators',
        'ASCII Value',
        'Preprocessors',
        'Practice Programs',
        'Conditional Statements',
        'Practice Programms',
        'Practice Solution',
        'Loop ( Iterative Statements )',
        'Practice Programms : Loop',
        'Practice Solution : Loop',
        'break and continue Statements',
        'Array',
        'Practice Programs : Array',
        'String',
        'Practice Programs : String',
        'String Functions',
        'Pointer',
        'Dynamic Memory Allocation',
        'Practice Programs',
        'Function',
        'Default function',
        'Parameterized function',
        'Return Type Function',
        'Recursive function',
        'Math Functions',
        'go to Statement',
        'Practice Programs',
        'Structure',
        'Practice Programs : Structure',
        'Macro',
        'Storage Classes',
        'File Handling',
        'Practice Programs : File Handling',
        'Enums',
        'Flowchart'
      ]
    ],
    'cpp-programming.php' => [
      'title' => 'C++ Programming Full Syllabus',
      'badge' => '41 Topics',
      'subtitle' => 'Comprehensive curriculum from OOP principles & memory to templates, STL & interview sets',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Namespaces & I/O Streams'],
        ['num' => '02', 'title' => 'OOP Principles & Dynamic Memory'],
        ['num' => '03', 'title' => 'Encapsulation & Constructors'],
        ['num' => '04', 'title' => 'static, const & Friend Functions'],
        ['num' => '05', 'title' => 'Polymorphism & Operator Overloading'],
        ['num' => '06', 'title' => 'Inheritance & Virtual Functions'],
        ['num' => '07', 'title' => 'Exception Handling & Templates'],
        ['num' => '08', 'title' => 'File Handling & Streams'],
        ['num' => '09', 'title' => 'Standard Template Library (STL)'],
        ['num' => '10', 'title' => 'Interview Question Sets (1 to 8)'],
      ],
      'topics' => [
        'Namespace',
        'Input Output operations',
        'Object Oriented Principles',
        'Dynamic memory allocation',
        'Encapsulation',
        'Constructors',
        'This Keyword',
        'Friend Function',
        'Destructor',
        'Inline function',
        'static keyword',
        'const keyword',
        'Polymorphism',
        'Constructor Overloading',
        'Operator Overloading',
        'Scope Resolution Operator ( :: )',
        'Inheritance',
        'Pure virtual function',
        'Access Modifiers',
        'Function Overriding',
        'Constructors in Inheritance',
        'Dynamic Polymorphism',
        'Exception Handling',
        'Standard Exceptions',
        'Template',
        'File Handling',
        'STL ( introduction)',
        'Vector',
        'List',
        'Stack',
        'Queue',
        'Set',
        'Map',
        'a interview Questions set - 1',
        'b interview Questions set - 2',
        'c interview Questions set - 3',
        'd interview Questions set - 4',
        'e interview Questions set - 5',
        'f interview Questions set - 6',
        'g interview Questions set - 7',
        'h interview Questions set - 8'
      ]
    ],
    'java-programming.php' => [
      'title' => 'Java Programming Full Syllabus',
      'badge' => '43 Topics',
      'subtitle' => 'Comprehensive curriculum from Java fundamentals & OOP to AWT, Applets & event handling',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Basics, Scanner & Operators'],
        ['num' => '02', 'title' => 'Wrapper Classes & Naming Conventions'],
        ['num' => '03', 'title' => 'Strings & StringBuilders'],
        ['num' => '04', 'title' => 'Methods, Constructors & this Keyword'],
        ['num' => '05', 'title' => 'Static Members, Methods & Blocks'],
        ['num' => '06', 'title' => 'Inheritance, super & Polymorphism'],
        ['num' => '07', 'title' => 'Abstraction, Abstract Classes & Interfaces'],
        ['num' => '08', 'title' => 'Packages & Access Modifiers'],
        ['num' => '09', 'title' => 'Exception Handling & Custom Exceptions'],
        ['num' => '10', 'title' => 'Applet, AWT, Event Handling & Arrays'],
      ],
      'topics' => [
        'Introduction',
        'Basic',
        'Scanner',
        'Operators',
        'Wrapper Class',
        'Java Naming Convention',
        'Practice on basics',
        'Practice on Conditional Statements',
        'String',
        'String Methods',
        'StringBuilder',
        'Methods',
        'Constructor',
        'this keyword',
        'Polymorphism',
        'Method overloading',
        'Static',
        'Static variable',
        'Static method',
        'Static block',
        'Static class',
        'Inheritance',
        'Single inheritance',
        'Multilevel inheritance',
        'Hierarchical inheritance',
        'super keyword',
        'Abstraction',
        'Abstract method',
        'Abstract class',
        'Anonymous Class',
        'Overriding',
        'Overriding vs Overloading',
        'Final Keyword',
        'Interface',
        'Package & Access Modifiers',
        'Exception handling',
        'Checked Exceptions',
        'Unchecked exceptions',
        'Custom Exception',
        'Applet',
        'Awt',
        'Event Handling Using AWT',
        'Array'
      ]
    ],
    'python-programming.php' => [
      'title' => 'Python Programming Full Syllabus',
      'badge' => '35 Topics',
      'subtitle' => 'Comprehensive curriculum from basics & data structures to OOP, threading & file handling',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Introduction & How Python Works'],
        ['num' => '02', 'title' => 'Data Types, Casting & Numbers'],
        ['num' => '03', 'title' => 'Decision Making & Conditionals'],
        ['num' => '04', 'title' => 'Loops & Loop Manipulators'],
        ['num' => '05', 'title' => 'Lists, Tuples & Practice Sets'],
        ['num' => '06', 'title' => 'Strings, Sets & Dictionaries'],
        ['num' => '07', 'title' => 'Functions, Math & Modules'],
        ['num' => '08', 'title' => 'OOP, Classes & Inheritance'],
        ['num' => '09', 'title' => 'Exception Handling & File I/O'],
        ['num' => '10', 'title' => 'Threading & Turtle Graphics'],
      ],
      'topics' => [
        'Introduction',
        'How It Works',
        'ASCII Value',
        'Data Types',
        'Number Systems',
        'Type Casting',
        'Basic Python Programs',
        'Decision Making',
        'Practice Programs',
        'Loop',
        'Loop Manipulators',
        'Practice on Conditional',
        'Practice Questions',
        'List in Python',
        'List Practice Questions',
        'String in Python',
        'String Practice',
        'Tuples in Python',
        'Tuple Practice',
        'Set in Python',
        'Set Practice Questions',
        'Dictionary in Python',
        'Dictionary Practice',
        'Function',
        'Function Practice',
        'Class',
        'Math Module',
        'Modules',
        'Inheritance',
        'Access Modifiers',
        'super Keyword',
        'Exception Handling',
        'File Handling',
        'Turtle (kids special)',
        'Threading'
      ]
    ],
    'ai-engineer.php' => [
      'title' => 'AI Engineering Full Syllabus',
      'badge' => '20 Topics',
      'subtitle' => 'Comprehensive curriculum from LLM APIs & Prompt Engineering to RAG, Agents & Cloud Deployment',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Git, GitHub & REST APIs (FastAPI)'],
        ['num' => '02', 'title' => 'LLM Fundamentals & Model APIs'],
        ['num' => '03', 'title' => 'Prompt Engineering & Structured Outputs'],
        ['num' => '04', 'title' => 'Embeddings & Vector Databases'],
        ['num' => '05', 'title' => 'Retrieval-Augmented Generation (RAG)'],
        ['num' => '06', 'title' => 'LangChain Framework & Orchestration'],
        ['num' => '07', 'title' => 'Tool Calling & Autonomous AI Agents'],
        ['num' => '08', 'title' => 'AI Evaluation (RAGAS & Metrics)'],
        ['num' => '09', 'title' => 'Docker, Containers & Cloud Deploy'],
        ['num' => '10', 'title' => 'AI Guardrails, Security & Observability'],
      ],
      'topics' => [
        'Git & GitHub',
        'APIs & REST',
        'FastAPI',
        'LLM Fundamentals',
        'LLM APIs',
        'Prompt Engineering',
        'Structured Outputs',
        'Embeddings',
        'Vector Databases',
        'RAG',
        'LangChain',
        'Model Selection & Evaluation',
        'Tool Calling & Agents — Basics',
        'AI Evaluation — RAGAS / etc.',
        'Docker',
        'Cloud Deployment',
        'AI Guardrails',
        'AI Security & Responsible AI',
        'Observability & Tracing',
        'Real-World AI Applications'
      ]
    ],
    'data-science.php' => [
      'title' => 'Data Science Full Syllabus',
      'badge' => '12 Topics',
      'subtitle' => 'Comprehensive curriculum from NumPy & Pandas to Statistics, Machine Learning & Model Explainability',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'NumPy & Vectorized Computations'],
        ['num' => '02', 'title' => 'Pandas & Data Manipulation'],
        ['num' => '03', 'title' => 'Data Cleaning & Exploratory Analysis (EDA)'],
        ['num' => '04', 'title' => 'Data Visualization (Matplotlib & Seaborn)'],
        ['num' => '05', 'title' => 'Descriptive & Inferential Statistics'],
        ['num' => '06', 'title' => 'Probability & Distributions'],
        ['num' => '07', 'title' => 'Hypothesis Testing & Significance'],
        ['num' => '08', 'title' => 'A/B Testing Methodologies'],
        ['num' => '09', 'title' => 'Feature Engineering & Preprocessing'],
        ['num' => '10', 'title' => 'Machine Learning, Evaluation & Explainability'],
      ],
      'topics' => [
        'NumPy',
        'Pandas',
        'Data Cleaning & EDA',
        'Data Visualization',
        'Statistics',
        'Probability',
        'Hypothesis Testing',
        'A/B Testing',
        'Feature Engineering',
        'Machine Learning',
        'Model Evaluation',
        'Model Interpretability & Explainability'
      ]
    ],
    'ml-engineer.php' => [
      'title' => 'ML Engineering Full Syllabus',
      'badge' => '21 Topics',
      'subtitle' => 'Comprehensive curriculum from Machine & Deep Learning to MLflow, Docker, CI/CD & End-to-End MLOps',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'NumPy & Pandas Fundamentals'],
        ['num' => '02', 'title' => 'Scikit-learn & Applied Statistics'],
        ['num' => '03', 'title' => 'Machine Learning Algorithms & Training'],
        ['num' => '04', 'title' => 'Feature Engineering & Preprocessing'],
        ['num' => '05', 'title' => 'Model Evaluation & Performance Tuning'],
        ['num' => '06', 'title' => 'Deep Learning (PyTorch & TensorFlow)'],
        ['num' => '07', 'title' => 'MLflow Experiment Tracking & Registry'],
        ['num' => '08', 'title' => 'Model Serving with FastAPI & Docker'],
        ['num' => '09', 'title' => 'CI/CD Pipelines & Cloud Deployment'],
        ['num' => '10', 'title' => 'Model Monitoring, Drift & End-to-End MLOps'],
      ],
      'topics' => [
        'NumPy',
        'Pandas',
        'Scikit-learn',
        'Statistics & Probability',
        'Machine Learning Algorithms',
        'Feature Engineering',
        'Model Training',
        'Model Evaluation',
        'Deep Learning — PyTorch',
        'TensorFlow Fundamentals',
        'MLflow — Experiment Tracking',
        'Model Registry',
        'FastAPI — Model Serving',
        'Docker',
        'Git & GitHub',
        'CI/CD for ML',
        'Cloud Platform',
        'Model Monitoring',
        'Drift Detection',
        'MLOps — End-to-End',
        'Real-World End-to-End ML Project'
      ]
    ],
    'gen-ai-engineer.php' => [
      'title' => 'Gen AI Engineer Full Syllabus',
      'badge' => '20 Topics',
      'subtitle' => 'Comprehensive curriculum from LLMs & Transformers to Advanced RAG, Fine-Tuning, PEFT/LoRA & Multimodal AI',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'LLM Fundamentals & Transformers'],
        ['num' => '02', 'title' => 'Advanced Prompt Engineering & APIs'],
        ['num' => '03', 'title' => 'Vector Embeddings & Vector Databases'],
        ['num' => '04', 'title' => 'Advanced RAG Architectures'],
        ['num' => '05', 'title' => 'LangChain & Orchestration Pipelines'],
        ['num' => '06', 'title' => 'Hugging Face Ecosystem & Pretrained Models'],
        ['num' => '07', 'title' => 'Fine-Tuning (SFT, PEFT & LoRA)'],
        ['num' => '08', 'title' => 'Function/Tool Calling & Multimodal AI'],
        ['num' => '09', 'title' => 'Guardrails, Safety & LLM Evaluation'],
        ['num' => '10', 'title' => 'FastAPI, Docker & End-to-End GenAI Projects'],
      ],
      'topics' => [
        'LLM Fundamentals',
        'Transformers',
        'Prompt Engineering — Adv',
        'LLM APIs',
        'Embeddings',
        'Vector Databases',
        'RAG — Advanced',
        'LangChain',
        'Hugging Face',
        'Fine-Tuning — SFT',
        'PEFT / LoRA',
        'LLM Evaluation',
        'Structured Outputs',
        'Function / Tool Calling',
        'Multimodal AI',
        'Guardrails & Safety',
        'FastAPI',
        'Docker',
        'Cloud Deployment',
        'End-to-End GenAI Projects'
      ]
    ],
    'agentic-ai-engineer.php' => [
      'title' => 'Agentic AI Engineer Full Syllabus',
      'badge' => '22 Topics',
      'subtitle' => 'Comprehensive curriculum from Agent Loops & Planning to MCP, LangGraph, CrewAI & Multi-Agent Systems',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'LLM Fundamentals & Tool Calling'],
        ['num' => '02', 'title' => 'Structured Outputs & Context Engineering'],
        ['num' => '03', 'title' => 'Agent Architecture & Execution Loops'],
        ['num' => '04', 'title' => 'Planning, Reasoning & Reflection Patterns'],
        ['num' => '05', 'title' => 'Agent Memory Systems & Retrieval'],
        ['num' => '06', 'title' => 'MCP (Model Context Protocol) & SDKs'],
        ['num' => '07', 'title' => 'LangGraph, CrewAI & AutoGen Frameworks'],
        ['num' => '08', 'title' => 'Multi-Agent Collaboration Systems'],
        ['num' => '09', 'title' => 'Human-in-the-Loop & Evaluation Metrics'],
        ['num' => '10', 'title' => 'Guardrails, Security & Production Deployment'],
      ],
      'topics' => [
        'LLM Fundamentals',
        'Prompt Engineering',
        'Tool Calling',
        'Structured Outputs',
        'Agent Architecture',
        'Agent Loops',
        'Planning & Reasoning Patterns',
        'Agent Memory',
        'Context Engineering',
        'MCP — Model Context Protocol',
        'OpenAI Agents SDK',
        'LangGraph',
        'CrewAI',
        'AutoGen',
        'Multi-Agent Systems',
        'Agent Evaluation',
        'Human-in-the-Loop',
        'Guardrails',
        'Tracing & Observability',
        'Agent Security — Permissions / Safety',
        'Agent Deployment — Production',
        'Real-World Agent Projects'
      ]
    ],
    'data-engineer.php' => [
      'title' => 'Data Engineer Full Syllabus',
      'badge' => '21 Topics',
      'subtitle' => 'Comprehensive curriculum from SQL, Data Modeling & ETL to Spark, Kafka, Airflow, Snowflake, Databricks & Lakehouse',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Git, Linux/Bash & Dev Environment'],
        ['num' => '02', 'title' => 'Relational Databases & Data Modeling'],
        ['num' => '03', 'title' => 'Core ETL & ELT Pipeline Architecture'],
        ['num' => '04', 'title' => 'Apache Spark (Batch & Structured Streaming)'],
        ['num' => '05', 'title' => 'Apache Kafka & Real-Time Event Streaming'],
        ['num' => '06', 'title' => 'Airflow Orchestration & dbt Transformations'],
        ['num' => '07', 'title' => 'Data Warehouses, Lakes & Lakehouse Systems'],
        ['num' => '08', 'title' => 'Modern Platforms (Databricks, Snowflake & Cloud)'],
        ['num' => '09', 'title' => 'Data Quality, Governance & CI/CD Pipelines'],
        ['num' => '10', 'title' => 'Monitoring, Alerting & End-to-End Capstone Project'],
      ],
      'topics' => [
        'Git & GitHub',
        'Linux / Bash',
        'Relational Databases',
        'Data Modeling',
        'ETL / ELT Concepts',
        'Apache Spark — Batch Processing',
        'Spark Streaming — Structured Streaming',
        'Kafka — Real-Time Data',
        'Airflow — Workflow Orchestration',
        'dbt — Data Transformation',
        'Data Warehousing',
        'Data Lakes — S3 / ADLS / GCS',
        'Lakehouse Architecture — Delta Lake / etc.',
        'Databricks',
        'Snowflake',
        'Cloud Data Platform',
        'Data Quality',
        'Data Governance & Catalogs',
        'CI/CD for Data Pipelines',
        'Monitoring & Alerting',
        'Real-World Data Engineering'
      ]
    ],
    'data-structures-algorithms.php' => [
      'title' => 'Data Structures & Algorithms Full Syllabus',
      'badge' => '37 Topics',
      'subtitle' => 'Comprehensive curriculum covering Linked Lists, Stacks, Queues, Trees, Graphs, Sorting, Recursion & Interview Problem Sets',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Singly, Doubly & Circular Linked Lists'],
        ['num' => '02', 'title' => 'Stacks, Applications & Infix/Postfix Logic'],
        ['num' => '03', 'title' => 'Queue Architectures & Applications'],
        ['num' => '04', 'title' => 'Binary Trees & Binary Search Trees (BST)'],
        ['num' => '05', 'title' => 'Threaded Binary Trees & AVL Balanced Trees'],
        ['num' => '06', 'title' => 'Graph Implementations (Adj List & Weighted)'],
        ['num' => '07', 'title' => 'Dijkstra, Prim’s & Kruskal’s Shortest Paths'],
        ['num' => '08', 'title' => 'Searching & Elementary Sorting Algorithms'],
        ['num' => '09', 'title' => 'Advanced Sorting (Quick, Merge, Heap & Radix)'],
        ['num' => '10', 'title' => 'Recursion Mastery & Technical Interview Sets'],
      ],
      'topics' => [
        'Singly Linked List',
        'Doubly Linked List',
        'Singly Circular Linked List',
        'Doubly Circular Linked List',
        'Stack',
        'Applications of Stack',
        'Expression ( Infix to Postfix )',
        'Expression ( Evaluate Postfix Expression )',
        'Queue',
        'Applications of Queue',
        'Tree',
        'Binary Tree',
        'Binary Search Tree',
        'Threaded Binary Tree ( TBT )',
        'AVL Tree',
        'Applications of Tree',
        'Graph',
        'Graph Impl using Adj List',
        'Graph Application Programs',
        'Weighted Graph IMPL',
        'Dijkstra Shortest Path',
        'Prim\'s Algorithm',
        'Kruskal\'s Algorithm',
        'Searching',
        'Sorting',
        'Bubble Sort',
        'Selection Sort',
        'Insertion Sort',
        'Quick Sort',
        'Heap Sort',
        'Merge Sort',
        'Radix Sort',
        'Recursive Functions',
        'Recursion Practice',
        'Recursion Practice (Advanced)',
        'Interview Questions - Set 1',
        'Interview Questions - Set 2'
      ]
    ],
    'mobile-app-development.php' => [
      'title' => 'Flutter & Mobile App Development Full Syllabus',
      'badge' => '71 Topics',
      'subtitle' => 'Comprehensive curriculum from Dart basics & Flutter UI widgets to state management, SQLite CRUD & Firebase Cloud Firestore',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Flutter & Dart Fundamentals and Project Setup'],
        ['num' => '02', 'title' => 'Core Layout Widgets (Container, Row, Column, Stack)'],
        ['num' => '03', 'title' => 'Lists, Grids, AppBars & Material Scaffolding'],
        ['num' => '04', 'title' => 'Buttons, Navigation Bars, Drawers & Tab Bars'],
        ['num' => '05', 'title' => 'Interactive Form Inputs (TextField, CheckBox, Radio)'],
        ['num' => '06', 'title' => 'Styling, Custom Themes, Chips & Dialogs'],
        ['num' => '07', 'title' => 'Gestures, Animations, Transformations & CustomPaint'],
        ['num' => '08', 'title' => 'Async UI (FutureBuilder, StreamBuilder & Slivers)'],
        ['num' => '09', 'title' => 'State Management Architecture (Provider Pattern)'],
        ['num' => '10', 'title' => 'Local SQLite Databases & Firebase Cloud Firestore'],
      ],
      'topics' => [
        'Introduction to Flutter & Dart',
        'Introduction to MAD',
        'Overview of Flutter and Dart',
        'Flutter Project Structure',
        'Basics of Dart',
        'PageRoute ( Navigator )',
        'Scaffold',
        'FlatButton / TextButton',
        'Container',
        'Row',
        'Column',
        'Stack',
        'Text',
        'Image',
        'Listview',
        'Gridview',
        'Appbar',
        'Data Table',
        'FlatButton / TextButton',
        'RaisedButton / ElevatedButton',
        'Bottom Navigation Bar',
        'Tab Bar',
        'IconButton',
        'FloatingActionButton',
        'Drawer',
        'TextField',
        'CheckBox',
        'Radio Button',
        'Customizing Widgets and Themes',
        'Switch',
        'Slider',
        'ProgressIndicator',
        'Card',
        'AlertDialog',
        'Wrap',
        'Padding',
        'Align',
        'Chip',
        'Expanded',
        'AspectRatio',
        'Navigator',
        'GestureDetector',
        'Divider',
        'SizedBox',
        'Spacer',
        'ClipRRect',
        'CircleAvatar',
        'ListTile',
        'SelectableText',
        'RichText',
        'Tooltip',
        'Dismissible',
        'Draggable',
        'DragTarget',
        'StreamBuilder',
        'FutureBuilder',
        'Transform',
        'Opacity',
        'InkWell',
        'CustomPaint',
        'SliverAppBar',
        'RotatedBox',
        'BottomNavigationBar',
        'TabBar',
        'SnackBar',
        'BottomSheet',
        'State Management',
        'Provider',
        'SQL Database',
        'SQL UserList Example CRUD',
        'Flutter Firebase Cloud Firestore'
      ]
    ],
    'java-full-stack.php' => [
      'title' => 'Java Full Stack Full Syllabus',
      'badge' => '53 Topics',
      'subtitle' => 'Comprehensive curriculum from Multithreading, AWT/Swing, JDBC & Collections to Servlets, JSP, MongoDB & Spring Boot REST APIs',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Multithreading & Thread Lifecycle'],
        ['num' => '02', 'title' => 'AWT GUI & Layout Management'],
        ['num' => '03', 'title' => 'Java Swing & Desktop Development'],
        ['num' => '04', 'title' => 'JDBC & MySQL Database Connectivity'],
        ['num' => '05', 'title' => 'Java Collections Framework & Data Structures'],
        ['num' => '06', 'title' => 'Networking & Socket Chat Applications'],
        ['num' => '07', 'title' => 'Java Servlets, Sessions & Cookies'],
        ['num' => '08', 'title' => 'JSP, Custom Tags & JavaBeans'],
        ['num' => '09', 'title' => 'MongoDB NoSQL Database & CRUD'],
        ['num' => '10', 'title' => 'Spring Boot REST APIs & System Design'],
      ],
      'topics' => [
        'Multithreading',
        'Runnable Interface',
        'Sleeping Thread',
        'Join method',
        'Naming Thread',
        'Priority of Thread',
        'Abstract Window Toolkit',
        'Implementation',
        'Input Components in AWT',
        'Layouts',
        'Swing',
        'Swing vs Awt',
        'Cross Platform Development',
        'Components',
        'TableView',
        'JDBC',
        'Mysql Connection',
        'Prepared Statement',
        'CRUD Applications',
        'Collection Framework',
        'Data Structures',
        'ArrayList',
        'LinkedList',
        'ArrayList vs LinkedList',
        'Queue',
        'Hashset',
        'HashMap',
        'Date and I/O',
        'Networking',
        'Half Duplex Communication',
        'Full Duplex Chatting Application using threads',
        'Servlet',
        'Servlet Session',
        'Servlet Cookies',
        'Redirecting Pages in Servlets',
        'JSP',
        'JSP Tags',
        'Importing Libraries and Classes in JSP',
        'JSP Beans',
        'Examples on JSP',
        'XML and JSON',
        'Parsing XML to Object',
        'Parsing JSON to Object',
        'File Handling',
        'RMI (Remote Method Invocation) Programming',
        'Web Services',
        'Mongodb intro',
        'MongoDB datatypes',
        'CRUD with MongoDB',
        'MongoDB query operators',
        'Fundamentals of Spring Boot REST API',
        'XML JSON',
        'System Design'
      ]
    ],
    'java-dsa.php' => [
      'title' => 'Java + DSA Full Syllabus',
      'badge' => '37 Topics',
      'subtitle' => 'Comprehensive curriculum covering Data Structures, Algorithms & Technical Interview Prep',
      'chapters_preview' => [
        ['num' => '01', 'title' => 'Singly & Doubly Linked Lists'],
        ['num' => '02', 'title' => 'Circular Linked Lists (Singly & Doubly)'],
        ['num' => '03', 'title' => 'Stacks, Applications & Expressions'],
        ['num' => '04', 'title' => 'Queue Architectures & Applications'],
        ['num' => '05', 'title' => 'Binary Trees & Binary Search Trees (BST)'],
        ['num' => '06', 'title' => 'Threaded Binary Trees & AVL Balanced Trees'],
        ['num' => '07', 'title' => 'Graph Implementations & Shortest Paths'],
        ['num' => '08', 'title' => 'Searching & Sorting Algorithms'],
        ['num' => '09', 'title' => 'Advanced Sorting & Recursive Functions'],
        ['num' => '10', 'title' => 'Technical Interview Problem Sets'],
      ],
      'topics' => [
        'Singly Linked List',
        'Doubly Linked List',
        'Singly Circular Linked List',
        'Doubly Circular Linked List',
        'Stack',
        'Applications of Stack',
        'Expression ( Infix to Postfix )',
        'Expression ( Evaluate Postfix Expression )',
        'Queue',
        'Applications of Queue',
        'Tree',
        'Binary Tree',
        'Binary Search Tree',
        'Threaded Binary Tree ( TBT )',
        'AVL Tree',
        'Applications of Tree',
        'Graph',
        'Graph Impl using Adj List',
        'Track the shortest path',
        'Weighted Graph IMPL',
        'Dijkstra Shortest Path',
        'Prim\'s Algorithm',
        'Kruskal\'s algorithm',
        'Searching',
        'Sorting',
        'Bubble Sort',
        'Selection sort',
        'Insertion Sort',
        'Quick Sort',
        'Heap Sort',
        'Merge Sort',
        'Radix Sort',
        'Recursive Functions',
        'Recursion Practice',
        'Recursion Practice Set-2',
        'Interview Questions',
        'Interview Questions Set-2'
      ]
    ]
  ];
  // Aliases
  $available_syllabi['ai-engineering.php'] = $available_syllabi['ai-engineer.php'];
  $available_syllabi['data-scientist.php'] = $available_syllabi['data-science.php'];
  $available_syllabi['ml-engineering.php'] = $available_syllabi['ml-engineer.php'];
  $available_syllabi['genai-engineer.php'] = $available_syllabi['gen-ai-engineer.php'];
  $available_syllabi['gen-ai-engineering.php'] = $available_syllabi['gen-ai-engineer.php'];
  $available_syllabi['agentic-ai-engineering.php'] = $available_syllabi['agentic-ai-engineer.php'];
  $available_syllabi['data-engineering.php'] = $available_syllabi['data-engineer.php'];
  $available_syllabi['dsa.php'] = $available_syllabi['data-structures-algorithms.php'];
  $available_syllabi['data-structures-and-algorithms.php'] = $available_syllabi['data-structures-algorithms.php'];
  $available_syllabi['flutter-development.php'] = $available_syllabi['mobile-app-development.php'];
  $available_syllabi['flutter.php'] = $available_syllabi['mobile-app-development.php'];
  $available_syllabi['mobile-app.php'] = $available_syllabi['mobile-app-development.php'];
  $available_syllabi['java-fullstack.php'] = $available_syllabi['java-full-stack.php'];
  $available_syllabi['java-full-stack-development.php'] = $available_syllabi['java-full-stack.php'];
  $available_syllabi['java-dsa-foundation.php'] = $available_syllabi['java-dsa.php'];
  $available_syllabi['java-dsa-course.php'] = $available_syllabi['java-dsa.php'];

  $active_syllabus = $available_syllabi[$chedotech_page] ?? null;

  // No hand-written syllabus for this course: build it from the course's own modules and topics (CMS / seed data)
  if (!$active_syllabus && function_exists('course_syllabus')) {
    $built_topics = [];
    $built_chapters = [];
    foreach (course_syllabus(basename($chedotech_page, '.php'))['modules'] as $mi => $mod) {
      $built_chapters[] = ['num' => sprintf('%02d', $mi + 1), 'title' => $mod['title'] ?? ''];
      $mod_topics = array_filter(array_map(fn ($t) => trim($t['title'] ?? ''), $mod['topics'] ?? []));
      foreach ($mod_topics ?: [$mod['title'] ?? ''] as $t) {
        $built_topics[] = $t;
      }
    }
    if ($built_topics) {
      $active_syllabus = [
        'title' => $syllabus_course_name . ' Full Syllabus',
        'badge' => count($built_topics) . ' Topics',
        'subtitle' => 'Complete module-by-module curriculum of the ' . $syllabus_course_name . ' course',
        'chapters_preview' => array_slice($built_chapters, 0, 10),
        'topics' => $built_topics,
      ];
    }
  }

  // Chapter preview cards for blurred background
  $default_preview_chapters = [
    ['num' => '01', 'title' => 'Foundation & Architecture'],
    ['num' => '02', 'title' => 'Core Fundamentals & Syntax'],
    ['num' => '03', 'title' => 'Practical Implementations'],
    ['num' => '04', 'title' => 'Advanced Workflows'],
    ['num' => '05', 'title' => 'Data Handling & APIs'],
    ['num' => '06', 'title' => 'Best Practices & Security'],
    ['num' => '07', 'title' => 'Industry Case Studies'],
    ['num' => '08', 'title' => 'Mini Projects & Code Labs'],
    ['num' => '09', 'title' => 'Capstone Production Project'],
    ['num' => '10', 'title' => 'And Much More...'],
  ];

  $active_preview_chapters = $active_syllabus['chapters_preview'] ?? $default_preview_chapters;
  $preview_left_col = array_slice($active_preview_chapters, 0, 5);
  $preview_right_col = array_slice($active_preview_chapters, 5, 5);

  $preview_icons = [
    'M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4',
    'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
    'M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z',
    'M13 10V3L4 14h7v7l9-11h-7z',
    'M4 7v10c0 2 1 3 3 3h10c2 0 3-1 3-3V7c0-2-1-3-3-3H7c-2 0-3 1-3 3z',
    'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
    'M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z',
    'M8 9l3 3-3 3m5 0h3M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z',
    'M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z',
    'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'
  ];
?>
  <!-- Syllabus Breakdown / OTP Section -->
  <section class="py-16 sm:py-24 bg-white relative overflow-hidden">

    <!-- Decorative background elements -->
    <div class="absolute -top-24 -right-24 w-96 h-96 bg-blue-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>
    <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-indigo-100 rounded-full mix-blend-multiply filter blur-3xl opacity-70 pointer-events-none"></div>

    <div class="relative mx-auto max-w-7xl px-5 sm:px-8">
      <div id="syllabus-container" class="bg-white max-w-6xl mx-auto relative overflow-hidden transition-all duration-300" style="border: 1px solid #e2e8f0; border-radius: 24px; box-shadow: 0 0 16px 2px rgba(0, 0, 0, 0.03), 0 8px 24px -4px rgba(0, 0, 0, 0.06);">

        <!-- State 1: Teaser with Blurred Background Chapter List -->
        <div id="syllabus-teaser" class="relative w-full min-h-[500px] sm:min-h-[540px] px-6 py-16 sm:px-16 sm:py-20 flex flex-col items-center justify-center text-center">

          <!-- Background Chapter List (Blurred) -->
          <div class="absolute inset-0 flex items-center justify-center pointer-events-none select-none overflow-hidden" aria-hidden="true">
            <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-2.5 sm:gap-3.5 px-3 sm:px-6" style="filter: blur(5px); -webkit-filter: blur(5px); opacity: 0.85;">

              <!-- Left Column: Chapters 01 to 05 -->
              <div class="flex flex-col gap-2.5 sm:gap-3">
                <?php foreach ($preview_left_col as $idx => $chap): ?>
                  <div class="flex items-center justify-between gap-3 rounded-xl sm:rounded-2xl border border-slate-200/90 bg-white/95 px-3.5 py-2.5 sm:px-4 sm:py-3 shadow-xs">
                    <div class="flex items-center gap-3">
                      <div class="flex h-7 w-7 sm:h-8 sm:w-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="<?= $preview_icons[$idx] ?>" />
                        </svg>
                      </div>
                      <div class="text-xs sm:text-sm text-slate-800">
                        <span class="font-bold text-slate-900">Chapter <?= $chap['num'] ?>:</span>
                        <span class="font-medium text-slate-700 ml-1"><?= htmlspecialchars($chap['title']) ?></span>
                      </div>
                    </div>
                    <svg class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                  </div>
                <?php endforeach; ?>
              </div>

              <!-- Right Column: Chapters 06 to 10 -->
              <div class="flex flex-col gap-2.5 sm:gap-3">
                <?php foreach ($preview_right_col as $idx => $chap):
                  $icon_idx = $idx + 5;
                  $is_last_generic = empty($active_syllabus) && ($chap['title'] === 'And Much More...');
                ?>
                  <div class="flex items-center justify-between gap-3 rounded-xl sm:rounded-2xl border border-slate-200/90 bg-white/95 px-3.5 py-2.5 sm:px-4 sm:py-3 shadow-xs">
                    <div class="flex items-center gap-3">
                      <div class="flex h-7 w-7 sm:h-8 sm:w-8 shrink-0 items-center justify-center rounded-lg bg-blue-100 text-blue-600">
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                          <path stroke-linecap="round" stroke-linejoin="round" d="<?= $preview_icons[$icon_idx] ?? 'M9 5l7 7-7 7' ?>" />
                        </svg>
                      </div>
                      <div class="text-xs sm:text-sm text-slate-800">
                        <?php if (!$is_last_generic): ?>
                          <span class="font-bold text-slate-900">Chapter <?= $chap['num'] ?>:</span>
                          <span class="font-medium text-slate-700 ml-1"><?= htmlspecialchars($chap['title']) ?></span>
                        <?php else: ?>
                          <span class="font-bold text-slate-800"><?= htmlspecialchars($chap['title']) ?></span>
                        <?php endif; ?>
                      </div>
                    </div>
                    <svg class="h-4 w-4 text-slate-400 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                    </svg>
                  </div>
                <?php endforeach; ?>
              </div>

            </div>
          </div>

          <!-- Soft Center Contrast Mask for Maximum Foreground Legibility -->
          <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_center,_rgba(251,252,254,0.96)_0%,_rgba(251,252,254,0.72)_55%,_rgba(251,252,254,0)_100%)] pointer-events-none" aria-hidden="true"></div>

          <!-- Main Content (Crisp, Readable & Centered Foreground) -->
          <div id="teaser-content" class="relative z-10 flex flex-col items-center justify-center text-center py-6 sm:py-10 px-4 max-w-2xl mx-auto transition-opacity duration-200">
            <!-- Badge -->
            <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-blue-100 text-blue-600 text-xs sm:text-sm font-semibold mb-4 sm:mb-5">
              <svg class="h-4 w-4" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 9V5a1 1 0 112 0v4h2a1 1 0 110 2h-3a1 1 0 01-1-1z" clip-rule="evenodd" />
              </svg>
              <?= cms('global.footer.01', 'Complete Course Breakdown') ?>
            </div>

            <!-- Heading -->
            <h2 class="text-2xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight text-slate-900">
              <?= cms('global.footer.02', 'Unlock the Complete Syllabus') ?>
            </h2>

            <!-- Description -->
            <p class="mt-3 sm:mt-4 text-sm sm:text-base lg:text-lg leading-relaxed text-slate-600 font-medium max-w-xl mx-auto">
              Get detailed insights into everything we cover in the <?= htmlspecialchars($syllabus_course_name) ?> course.
            </p>

            <!-- Button -->
            <div class="mt-6 sm:mt-8">
              <button type="button" class="inline-flex items-center justify-center gap-2 rounded-full bg-blue-600 px-7 sm:px-9 py-3 sm:py-3.5 text-sm sm:text-base font-bold text-white shadow-md hover:bg-blue-700 hover:shadow-lg active:scale-95 transition-all cursor-pointer" onclick="openOtpModal()">
                <span><?= cms('global.footer.03', 'Verify your phone number') ?></span>
                <svg class="h-4 w-4 sm:h-5 sm:w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                </svg>
              </button>
            </div>

            <!-- Test Mode Direct Unlock Link (Visible when OTP_TEST_MODE is true) -->
            <div class="otp-test-mode-indicator hidden mt-4">
              <button type="button" onclick="revealSyllabus()" class="inline-flex items-center gap-1.5 text-xs text-amber-700 hover:text-amber-800 bg-amber-50 hover:bg-amber-100 border border-amber-200 px-3.5 py-1.5 rounded-full font-semibold transition-colors cursor-pointer shadow-xs">
                <span class="h-1.5 w-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                <span><?= cms('global.footer.04', 'Testing Mode: Direct Unlock Syllabus →') ?></span>
              </button>
            </div>
          </div>

          <!-- In-Container Verification Popup (Centered Above Blurred Chapter List) -->
          <div id="otp-modal" class="relative z-20 hidden flex-col items-center justify-center w-full max-w-md mx-auto my-auto py-2 transition-opacity duration-200">
            <div class="w-full rounded-3xl bg-white p-6 sm:p-8 shadow-2xl relative text-left border border-slate-200/90" style="border-radius: 24px;">
              <button type="button" class="absolute right-5 top-5 text-slate-400 hover:text-slate-600 transition-colors bg-slate-50 hover:bg-slate-100 rounded-full p-1.5 cursor-pointer" onclick="closeOtpModal()" aria-label="Close modal">
                <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
              </button>

              <!-- Test Mode Notification Banner -->
              <div class="otp-test-mode-indicator hidden mb-4 rounded-xl bg-amber-50 border border-amber-200 p-2.5 text-xs text-amber-800 flex items-center justify-between">
                <div class="flex items-center gap-1.5 font-semibold">
                  <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                  <span><?= cms('global.footer.05', 'Testing Mode: OTP Bypass Active') ?></span>
                </div>
                <button type="button" onclick="revealSyllabus()" class="font-bold underline text-blue-700 hover:text-blue-900 cursor-pointer">
                  <?= cms('global.footer.06', 'Direct Unlock →') ?>
                </button>
              </div>

              <!-- Step 1 -->
              <div id="otp-step-1" class="pt-2">
                <div class="flex items-center gap-3 mb-6">
                  <div class="flex h-7 w-7 sm:h-8 sm:w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white"><?= cms('global.footer.07', '1') ?></div>
                  <div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 leading-tight"><?= cms('global.footer.08', 'Verify Phone Number') ?></h3>
                    <p class="text-xs text-slate-500 mt-1"><?= cms('global.footer.09', 'Enter your mobile number to get the full detailed syllabus on WhatsApp.') ?></p>
                  </div>
                </div>
                <div class="flex items-center gap-2 rounded-xl border border-slate-300 bg-white p-1 focus-within:border-blue-500 focus-within:ring-1 focus-within:ring-blue-500 transition-all shadow-sm hover:border-slate-400">
                  <div class="flex items-center gap-1 pl-3 pr-2 border-r border-slate-200 cursor-pointer">
                    <span class="text-sm font-semibold text-slate-700"><?= cms('global.footer.10', '+91') ?></span>
                    <svg class="h-4 w-4 text-slate-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                    </svg>
                  </div>
                  <input type="tel" id="otp-phone" class="w-full border-none bg-transparent px-2 py-2.5 text-sm text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-0" placeholder="Enter 10-digit number" maxlength="10" autocomplete="off">
                </div>
                <p id="otp-msg-1" class="mt-2 text-center text-xs text-red-500 hidden font-medium"></p>
                <button type="button" class="mt-5 w-full rounded-xl bg-blue-600 py-3.5 text-sm font-bold text-white shadow hover:bg-blue-700 hover:shadow-md transition-all active:scale-95 cursor-pointer" onclick="sendOtp()"><?= cms('global.footer.11', 'Send OTP') ?></button>
                <div class="mt-6 flex items-center justify-center gap-1.5 text-[11px] sm:text-xs text-slate-400 font-medium">
                  <svg class="h-3.5 w-3.5 sm:h-4 sm:w-4 text-slate-300" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                  </svg>
                  <?= cms('global.footer.12', 'Your number is safe with us. We never share it.') ?>
                </div>
              </div>

              <!-- Step 2 -->
              <div id="otp-step-2" class="pt-2 hidden">
                <div class="flex items-center gap-3 mb-6">
                  <div class="flex h-7 w-7 sm:h-8 sm:w-8 shrink-0 items-center justify-center rounded-full bg-blue-600 text-sm font-bold text-white"><?= cms('global.footer.13', '2') ?></div>
                  <div>
                    <h3 class="text-lg sm:text-xl font-bold text-slate-900 leading-tight"><?= cms('global.footer.14', 'Enter OTP') ?></h3>
                    <p class="text-xs text-slate-500 mt-1"><?= cms('global.footer.15', 'We have sent a 6-digit OTP to') ?> <strong id="display-phone" class="text-slate-800 font-bold"><?= cms('global.footer.16', '+91 XXXXX XXXXX') ?></strong></p>
                  </div>
                </div>
                <div class="flex gap-2 sm:gap-3 justify-between mt-2">
                  <input type="text" maxlength="1" class="otp-digit w-10 h-12 sm:w-12 sm:h-14 text-center text-lg sm:text-xl font-bold rounded-xl border border-slate-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white text-slate-900 shadow-sm" autocomplete="off" inputmode="numeric">
                  <input type="text" maxlength="1" class="otp-digit w-10 h-12 sm:w-12 sm:h-14 text-center text-lg sm:text-xl font-bold rounded-xl border border-slate-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white text-slate-900 shadow-sm" autocomplete="off" inputmode="numeric">
                  <input type="text" maxlength="1" class="otp-digit w-10 h-12 sm:w-12 sm:h-14 text-center text-lg sm:text-xl font-bold rounded-xl border border-slate-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white text-slate-900 shadow-sm" autocomplete="off" inputmode="numeric">
                  <input type="text" maxlength="1" class="otp-digit w-10 h-12 sm:w-12 sm:h-14 text-center text-lg sm:text-xl font-bold rounded-xl border border-slate-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white text-slate-900 shadow-sm" autocomplete="off" inputmode="numeric">
                  <input type="text" maxlength="1" class="otp-digit w-10 h-12 sm:w-12 sm:h-14 text-center text-lg sm:text-xl font-bold rounded-xl border border-slate-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white text-slate-900 shadow-sm" autocomplete="off" inputmode="numeric">
                  <input type="text" maxlength="1" class="otp-digit w-10 h-12 sm:w-12 sm:h-14 text-center text-lg sm:text-xl font-bold rounded-xl border border-slate-300 focus:border-blue-600 focus:ring-2 focus:ring-blue-100 transition-all bg-white text-slate-900 shadow-sm" autocomplete="off" inputmode="numeric">
                </div>
                <p id="otp-msg-2" class="mt-3 text-center text-xs text-red-500 hidden font-medium"></p>
                <button type="button" class="mt-6 w-full rounded-xl bg-blue-600 py-3.5 text-sm font-bold text-white shadow hover:bg-blue-700 hover:shadow-md transition-all active:scale-95 cursor-pointer" onclick="verifyOtp()"><?= cms('global.footer.17', 'Verify OTP') ?></button>
                <div class="mt-6 text-center text-[11px] sm:text-xs font-medium text-slate-500" id="otp-timer-box">
                  <?= cms('global.footer.18', 'Resend OTP in') ?> <span id="otp-countdown" class="text-blue-600 font-bold ml-1"><?= cms('global.footer.19', '00:30') ?></span>
                </div>
                <div class="mt-6 text-center text-[11px] sm:text-xs font-medium text-slate-500 hidden" id="otp-resend-box">
                  <?= cms('global.footer.20', 'Didn\'t receive the OTP?') ?> <button type="button" onclick="resendOtp()" class="text-blue-600 hover:text-blue-800 font-bold underline cursor-pointer ml-1"><?= cms('global.footer.21', 'Resend OTP') ?></button>
                </div>
              </div>

              <!-- Step 3: Verified Successfully -->
              <div id="otp-step-3" class="hidden flex-col items-center text-center py-6 sm:py-8">
                <div class="flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 mb-5 relative">
                  <div class="absolute inset-0 rounded-full bg-emerald-100 animate-ping opacity-50"></div>
                  <svg class="h-8 w-8 text-emerald-500 relative z-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                  </svg>
                </div>
                <h3 class="text-2xl font-extrabold text-slate-900 leading-tight"><?= cms('global.footer.22', 'Verified Successfully!') ?></h3>
                <?php if ($active_syllabus): ?>
                  <div class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-800 border border-emerald-200">
                    <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                    <span><?= htmlspecialchars($active_syllabus['badge']) ?> Unlocked!</span>
                  </div>
                  <p class="mt-3 text-sm text-slate-500 max-w-xs leading-relaxed">
                    You can now explore the complete <?= htmlspecialchars($syllabus_course_name) ?> syllabus breakdown below.
                  </p>
                  <button type="button" class="mt-7 w-full rounded-xl bg-blue-600 py-3.5 text-sm font-bold text-white shadow hover:bg-blue-700 hover:shadow-md transition-all active:scale-95 cursor-pointer" onclick="revealSyllabus()">
                    <?= cms('global.footer.23', 'View Full Syllabus →') ?>
                  </button>
                <?php else: ?>
                  <div class="mt-3 inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-800 border border-amber-200">
                    <span class="h-2 w-2 rounded-full bg-amber-500 animate-pulse"></span>
                    <span><?= cms('global.footer.24', 'Complete Syllabus Coming Soon!') ?></span>
                  </div>
                  <p class="mt-3 text-sm text-slate-500 max-w-xs leading-relaxed">
                    <?= cms('global.footer.25', 'The detailed syllabus breakdown for') ?> <strong><?= htmlspecialchars($syllabus_course_name) ?></strong> <?= cms('global.footer.26', 'is being finalized. You will receive the complete PDF on WhatsApp shortly.') ?>
                  </p>
                  <button type="button" class="mt-7 w-full rounded-xl bg-blue-600 py-3.5 text-sm font-bold text-white shadow hover:bg-blue-700 hover:shadow-md transition-all active:scale-95 cursor-pointer" onclick="revealSyllabus()">
                    <?= cms('global.footer.27', 'View Details →') ?>
                  </button>
                <?php endif; ?>
              </div>

            </div>
          </div>

        </div>

        <!-- State 2: Syllabus Content (Unlocked State) -->
        <div id="syllabus-content" class="hidden w-full flex-col text-left">
          <!-- Single Container Header with Title, Badge & Visible X Close Button -->
          <div class="flex items-center justify-between bg-white px-6 py-5 sm:px-8 sm:py-6 shrink-0" style="border-bottom: 1px solid #e2e8f0;">
            <div class="flex items-center gap-3.5 sm:gap-4">
              <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-xl bg-blue-600 text-white shadow-xs">
                <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
              </div>
              <div>
                <div class="flex items-center gap-2.5">
                  <h3 class="text-xl sm:text-2xl font-bold text-slate-900 leading-tight"><?= htmlspecialchars($active_syllabus['title'] ?? ($syllabus_course_name . ' Full Syllabus')) ?></h3>
                  <?php if ($active_syllabus): ?>
                    <span class="inline-flex items-center rounded-full bg-white px-2.5 py-0.5 text-xs font-semibold text-blue-600" style="border: 1px solid #3b82f6;"><?= htmlspecialchars($active_syllabus['badge']) ?></span>
                  <?php else: ?>
                    <span class="inline-flex items-center rounded-full bg-amber-50 border border-amber-200/80 px-2.5 py-0.5 text-[11px] font-bold text-amber-800"><?= cms('global.footer.28', 'Coming Soon!') ?></span>
                  <?php endif; ?>
                </div>
                <p class="text-xs sm:text-sm text-slate-500 mt-1"><?= htmlspecialchars($active_syllabus['subtitle'] ?? 'Detailed curriculum roadmap in progress') ?></p>
              </div>
            </div>

            <!-- Visible X Close Button at top-right corner with soft background -->
            <button type="button"
              onclick="hideSyllabus()"
              aria-label="Close syllabus"
              title="Close syllabus"
              class="flex h-8 w-8 items-center justify-center rounded-full bg-slate-100 hover:bg-slate-200 text-slate-500 hover:text-slate-800 transition-colors cursor-pointer border-0">
              <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>

          <?php if ($active_syllabus): ?>
            <!-- Unlocked Horizontal Topic Cards: 6 cols on laptops, 4 on tablets, 2 on mobile -->
            <div class="p-4 sm:p-6 lg:p-7 overflow-y-auto max-h-[72vh] custom-scrollbar" style="background-color: #f8fafc; padding: 22px 28px;">
              <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-2 sm:gap-2.5">
                <?php foreach ($active_syllabus['topics'] as $index => $topic): ?>
                  <div class="flex items-center gap-2 rounded-xl bg-white px-2.5 py-2 hover:border-blue-400 transition-all min-h-[46px]" style="border: 1px solid #e2e8f0; box-shadow: 0 1px 2px rgba(0,0,0,0.02);" title="<?= htmlspecialchars($topic) ?>">
                    <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-[5px] bg-white text-[11px] font-bold text-blue-600" style="border: 1px solid #3b82f6;">
                      <?= sprintf('%02d', $index + 1) ?>
                    </span>
                    <p class="text-[11px] sm:text-xs font-medium text-slate-800 leading-tight line-clamp-2 m-0">
                      <?= htmlspecialchars($topic) ?>
                    </p>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <!-- Bottom Footer Bar with Counselor Action -->
            <div class="bg-white px-6 py-4 sm:px-8 flex flex-col sm:flex-row items-center justify-between gap-3 shrink-0" style="border-top: 1px solid #e2e8f0;">
              <span class="text-xs text-slate-600 font-normal"><?= htmlspecialchars($syllabus_course_name) ?> syllabus unlocked &bull; <?= count($active_syllabus['topics']) ?> total modules</span>
              <div class="flex items-center gap-3">
                <a href="<?= cmsu('global.footer.29', '../contact.php') ?>" data-wa data-wa-text="Hello Chedo Tech, I have checked the <?= htmlspecialchars($syllabus_course_name) ?> syllabus (<?= count($active_syllabus['topics']) ?> topics) and would like to know batch details." class="inline-flex items-center gap-1.5 rounded-full bg-blue-600 hover:bg-blue-700 px-5 py-2 text-xs sm:text-sm font-semibold text-white shadow-xs transition-all cursor-pointer">
                  <span><?= cms('global.footer.30', 'Ask Counselor on WhatsApp →') ?></span>
                </a>
              </div>
            </div>

          <?php else: ?>
            <!-- Coming Soon Body Inside Single Container -->
            <div class="p-6 sm:p-10 lg:p-12 flex flex-col items-center justify-center text-center">

              <!-- Animated Icon Badge -->
              <div class="flex h-16 w-16 sm:h-20 sm:w-20 items-center justify-center rounded-2xl bg-blue-50 border border-blue-200/80 mb-6 text-blue-600 shadow-xs relative">
                <svg class="h-8 w-8 sm:h-10 sm:w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.75">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                </svg>
                <span class="absolute -top-1 -right-1 flex h-4 w-4">
                  <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                  <span class="relative inline-flex rounded-full h-4 w-4 bg-blue-500"></span>
                </span>
              </div>

              <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200/80 mb-4">
                <span class="h-2 w-2 rounded-full bg-blue-600 animate-pulse"></span>
                <span><?= cms('global.footer.31', 'Curriculum Update In Progress') ?></span>
              </div>

              <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-slate-900 tracking-tight leading-tight">
                <?= cms('global.footer.32', 'Complete Syllabus Coming Soon!') ?>
              </h2>

              <p class="mt-3 sm:mt-4 text-sm sm:text-base leading-relaxed text-slate-600 max-w-xl mx-auto">
                <?= cms('global.footer.33', 'We are currently finalizing the complete, in-depth curriculum modules, hands-on lab exercises, and capstone project blueprints for') ?> <strong><?= htmlspecialchars($syllabus_course_name) ?></strong>.
              </p>

              <!-- What Will Be Covered Highlight Cards -->
              <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 sm:gap-4 mt-8 w-full max-w-2xl text-left">
                <div class="p-3.5 sm:p-4 rounded-xl border border-slate-200/80 bg-white shadow-2xs">
                  <div class="flex items-center gap-2 font-bold text-xs sm:text-sm text-slate-900">
                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-blue-100 text-blue-600 text-xs">✓</span>
                    <span><?= cms('global.footer.34', 'Full Topic Map') ?></span>
                  </div>
                  <p class="text-xs text-slate-500 mt-1.5 leading-relaxed"><?= cms('global.footer.35', 'Structured week-by-week learning roadmap from beginner to advanced.') ?></p>
                </div>

                <div class="p-3.5 sm:p-4 rounded-xl border border-slate-200/80 bg-white shadow-2xs">
                  <div class="flex items-center gap-2 font-bold text-xs sm:text-sm text-slate-900">
                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-emerald-100 text-emerald-600 text-xs">✓</span>
                    <span><?= cms('global.footer.36', 'Hands-on Projects') ?></span>
                  </div>
                  <p class="text-xs text-slate-500 mt-1.5 leading-relaxed"><?= cms('global.footer.37', 'Real-world code labs, mini apps, and industry-standard assignments.') ?></p>
                </div>

                <div class="p-3.5 sm:p-4 rounded-xl border border-slate-200/80 bg-white shadow-2xs">
                  <div class="flex items-center gap-2 font-bold text-xs sm:text-sm text-slate-900">
                    <span class="flex h-5 w-5 shrink-0 items-center justify-center rounded-full bg-purple-100 text-purple-600 text-xs">✓</span>
                    <span><?= cms('global.footer.38', 'Interview Guide') ?></span>
                  </div>
                  <p class="text-xs text-slate-500 mt-1.5 leading-relaxed"><?= cms('global.footer.39', 'Curated technical interview prep and placement assistance support.') ?></p>
                </div>
              </div>

              <!-- WhatsApp Direct Brochure Notice -->
              <div class="mt-8 p-4 rounded-2xl bg-slate-50 border border-slate-200/80 max-w-xl w-full flex items-center gap-3 text-left">
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl bg-emerald-50 text-emerald-600 border border-emerald-200">
                  <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" />
                  </svg>
                </div>
                <div class="text-xs text-slate-600">
                  <p class="font-bold text-slate-800"><?= cms('global.footer.40', 'Phone number verified!') ?></p>
                  <p class="mt-0.5"><?= cms('global.footer.41', 'Our academic counselor will share the detailed PDF syllabus and upcoming batch dates with you on WhatsApp as soon as it releases.') ?></p>
                </div>
              </div>

              <!-- Action Buttons -->
              <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                <a href="<?= cmsu('global.footer.42', '../contact.php') ?>" data-wa data-wa-text="Hello Chedo Tech, I would like to know more about the <?= htmlspecialchars($syllabus_course_name) ?> syllabus and batch schedule." class="inline-flex items-center gap-2 rounded-xl bg-blue-600 px-6 py-3 text-sm font-bold text-white shadow hover:bg-blue-700 hover:shadow-md transition-all active:scale-95 cursor-pointer">
                  <span><?= cms('global.footer.43', 'Ask Counselor on WhatsApp') ?></span>
                  <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                  </svg>
                </a>
              </div>

            </div>

            <!-- Bottom Footer Bar -->
            <div class="border-t border-slate-200/80 bg-slate-50/70 px-5 py-3.5 sm:px-8 flex items-center justify-between text-xs text-slate-500 shrink-0">
              <span class="font-medium text-slate-600"><?= htmlspecialchars($syllabus_course_name) ?> syllabus updates</span>
            </div>
          <?php endif; ?>

        </div>

      </div>
    </div>
  </section>

  <!-- Syllabus & OTP Verification Logic -->
  <script>
    (function() {
      // 🛠️ Testing Mode Toggle (set to false for production live OTP verification)
      const OTP_TEST_MODE = false;

      let otpCountdownTimer = null;

      function startOtpCountdown() {
        if (otpCountdownTimer) clearInterval(otpCountdownTimer);
        let seconds = 30;
        const timerBox = document.getElementById('otp-timer-box');
        const resendBox = document.getElementById('otp-resend-box');
        const countdownEl = document.getElementById('otp-countdown');
        if (timerBox) timerBox.classList.remove('hidden');
        if (resendBox) resendBox.classList.add('hidden');
        if (countdownEl) countdownEl.textContent = '00:30';

        otpCountdownTimer = setInterval(() => {
          seconds--;
          if (countdownEl) {
            countdownEl.textContent = `00:${seconds < 10 ? '0' : ''}${seconds}`;
          }
          if (seconds <= 0) {
            clearInterval(otpCountdownTimer);
            if (timerBox) timerBox.classList.add('hidden');
            if (resendBox) resendBox.classList.remove('hidden');
          }
        }, 1000);
      }

      window.openOtpModal = function() {
        const teaserContent = document.getElementById('teaser-content');
        const otpModal = document.getElementById('otp-modal');
        if (teaserContent) teaserContent.classList.add('hidden');
        if (otpModal) {
          otpModal.classList.remove('hidden');
          otpModal.classList.add('flex');
        }
        const syllabusSection = document.getElementById('syllabus-teaser');
        if (syllabusSection) {
          syllabusSection.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
          });
        }
        setTimeout(() => {
          const phone = document.getElementById('otp-phone');
          if (phone) phone.focus();
        }, 100);
      };

      window.closeOtpModal = function() {
        if (otpCountdownTimer) clearInterval(otpCountdownTimer);
        const otpModal = document.getElementById('otp-modal');
        const teaserContent = document.getElementById('teaser-content');
        if (otpModal) {
          otpModal.classList.add('hidden');
          otpModal.classList.remove('flex');
        }
        if (teaserContent) {
          teaserContent.classList.remove('hidden');
        }
        const step1 = document.getElementById('otp-step-1');
        const step2 = document.getElementById('otp-step-2');
        const step3 = document.getElementById('otp-step-3');
        if (step1) step1.classList.remove('hidden');
        if (step2) step2.classList.add('hidden');
        if (step3) {
          step3.classList.add('hidden');
          step3.classList.remove('flex');
        }
        const phone = document.getElementById('otp-phone');
        if (phone) phone.value = '';
        document.querySelectorAll('.otp-digit').forEach(i => i.value = '');
        const msg1 = document.getElementById('otp-msg-1');
        const msg2 = document.getElementById('otp-msg-2');
        if (msg1) msg1.classList.add('hidden');
        if (msg2) msg2.classList.add('hidden');
      };

      window.revealSyllabus = function() {
        window.closeOtpModal();
        const teaser = document.getElementById('syllabus-teaser');
        const content = document.getElementById('syllabus-content');
        if (teaser) {
          teaser.classList.add('hidden');
          teaser.classList.remove('flex');
        }
        if (content) {
          content.classList.remove('hidden');
          content.classList.add('flex');
        }
        const container = document.getElementById('syllabus-container') || content;
        if (container) {
          container.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      };

      // "View Full Syllabus" button in the course hero: jump to the open syllabus, or start the phone-verify unlock
      window.chViewSyllabus = function(e) {
        if (e) e.preventDefault();
        const content = document.getElementById('syllabus-content');
        if (content && !content.classList.contains('hidden')) {
          (document.getElementById('syllabus-container') || content).scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        } else {
          window.openOtpModal();
        }
        return false;
      };

      window.hideSyllabus = function() {
        const teaser = document.getElementById('syllabus-teaser');
        const content = document.getElementById('syllabus-content');
        if (content) {
          content.classList.add('hidden');
          content.classList.remove('flex');
        }
        if (teaser) {
          teaser.classList.remove('hidden');
          teaser.classList.add('flex');
        }
        const container = document.getElementById('syllabus-container') || teaser;
        if (container) {
          container.scrollIntoView({
            behavior: 'smooth',
            block: 'nearest'
          });
        }
      };

      // OTP Inputs logic & Paste support
      document.addEventListener('DOMContentLoaded', () => {
        // Reveal test mode helpers only if enabled
        if (typeof OTP_TEST_MODE !== 'undefined' && OTP_TEST_MODE) {
          document.querySelectorAll('.otp-test-mode-indicator').forEach(el => el.classList.remove('hidden'));
        }

        // Restrict phone input to 10 digits
        const phoneInput = document.getElementById('otp-phone');
        if (phoneInput) {
          phoneInput.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/[^0-9]/g, '').slice(0, 10);
          });
          phoneInput.addEventListener('keydown', (e) => {
            if (e.key === 'Enter') {
              e.preventDefault();
              window.sendOtp();
            }
          });
        }

        const inputs = Array.from(document.querySelectorAll('.otp-digit'));
        inputs.forEach((input, index) => {
          // Auto jump to next digit
          input.addEventListener('input', (e) => {
            e.target.value = e.target.value.replace(/[^0-9]/g, '');
            if (e.target.value && index < inputs.length - 1) {
              inputs[index + 1].focus();
            }
            // If all 6 digits are filled, auto verify
            const code = inputs.map(i => i.value).join('');
            if (code.length === 6) {
              window.verifyOtp();
            }
          });

          // Auto jump to prev on backspace
          input.addEventListener('keydown', (e) => {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
              inputs[index - 1].focus();
            }
            if (e.key === 'Enter') {
              e.preventDefault();
              window.verifyOtp();
            }
          });

          // Select on focus
          input.addEventListener('focus', () => input.select());

          // Paste support across all 6 inputs
          input.addEventListener('paste', (e) => {
            e.preventDefault();
            const pasteData = (e.clipboardData || window.clipboardData).getData('text').replace(/[^0-9]/g, '');
            if (pasteData.length > 0) {
              inputs.forEach((inp, i) => {
                inp.value = pasteData[i] || '';
              });
              const lastFilled = Math.min(pasteData.length, inputs.length) - 1;
              if (inputs[lastFilled]) inputs[lastFilled].focus();
              if (pasteData.length >= 6) {
                window.verifyOtp();
              }
            }
          });
        });
      });

      window.sendOtp = async function() {
        const phoneInput = document.getElementById('otp-phone');
        if (!phoneInput) return;
        const phone = phoneInput.value.replace(/[^0-9]/g, '');
        const msg1 = document.getElementById('otp-msg-1');
        if (phone.length < 10) {
          msg1.textContent = 'Please enter a valid 10-digit mobile number.';
          msg1.classList.remove('hidden');
          return;
        }
        msg1.classList.add('hidden');

        const btn = document.querySelector('#otp-step-1 button');
        const originalText = btn ? btn.textContent : 'Send OTP';
        if (btn) {
          btn.textContent = 'Sending...';
          btn.disabled = true;
        }

        // Testing Mode: Bypass external 2Factor SMS call & auto-populate OTP
        if (typeof OTP_TEST_MODE !== 'undefined' && OTP_TEST_MODE) {
          setTimeout(() => {
            if (btn) {
              btn.textContent = originalText;
              btn.disabled = false;
            }
            document.getElementById('otp-step-1').classList.add('hidden');
            document.getElementById('otp-step-2').classList.remove('hidden');
            document.getElementById('display-phone').textContent = `+91 ${phone}`;
            document.getElementById('otp-msg-2').classList.add('hidden');
            const testCode = ['1', '2', '3', '4', '5', '6'];
            document.querySelectorAll('.otp-digit').forEach((input, index) => {
              input.value = testCode[index] || '';
            });
            const lastInput = document.querySelectorAll('.otp-digit')[5];
            if (lastInput) lastInput.focus();
          }, 150);
          return;
        }

        try {
          const sendEndpoint = window.location.pathname.includes('/courses/') ? '../send-otp.php' : 'send-otp.php';
          const res = await fetch(sendEndpoint, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              phone: phone
            })
          });
          const data = await res.json();

          if (btn) {
            btn.textContent = originalText;
            btn.disabled = false;
          }

          if (data.success) {
            document.getElementById('otp-step-1').classList.add('hidden');
            document.getElementById('otp-step-2').classList.remove('hidden');
            document.getElementById('display-phone').textContent = `+91 ${phone}`;
            document.getElementById('otp-msg-2').classList.add('hidden');
            startOtpCountdown();
            setTimeout(() => {
              const firstDigit = document.querySelector('.otp-digit');
              if (firstDigit) firstDigit.focus();
            }, 100);
          } else {
            msg1.textContent = data.message || 'Failed to send OTP.';
            msg1.classList.remove('hidden');
          }
        } catch (err) {
          if (btn) {
            btn.textContent = originalText;
            btn.disabled = false;
          }
          msg1.textContent = 'Network error. Please try again.';
          msg1.classList.remove('hidden');
        }
      };

      window.resendOtp = function() {
        const resendBox = document.getElementById('otp-resend-box');
        if (resendBox) resendBox.classList.add('hidden');
        window.sendOtp();
      };

      window.verifyOtp = async function() {
        const code = Array.from(document.querySelectorAll('.otp-digit')).map(i => i.value).join('');
        const phoneInput = document.getElementById('otp-phone');
        const phone = phoneInput ? phoneInput.value.replace(/[^0-9]/g, '') : '';
        const btn = document.querySelector('#otp-step-2 button');
        const msg2 = document.getElementById('otp-msg-2');

        if (code.length < 6) {
          msg2.textContent = 'Please enter the complete 6-digit OTP.';
          msg2.classList.remove('hidden');
          return;
        }

        const originalText = btn ? btn.textContent : 'Verify OTP';
        if (btn) {
          btn.textContent = 'Verifying...';
          btn.disabled = true;
        }
        msg2.classList.add('hidden');

        // Testing Mode: Bypass external 2Factor verification API call
        if (typeof OTP_TEST_MODE !== 'undefined' && OTP_TEST_MODE) {
          setTimeout(() => {
            if (btn) {
              btn.textContent = originalText;
              btn.disabled = false;
            }
            document.getElementById('otp-step-2').classList.add('hidden');
            document.getElementById('otp-step-3').classList.remove('hidden');
            document.getElementById('otp-step-3').classList.add('flex');
          }, 150);
          return;
        }

        try {
          const verifyEndpoint = window.location.pathname.includes('/courses/') ? '../verify-otp.php' : 'verify-otp.php';
          const res = await fetch(verifyEndpoint, {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json'
            },
            body: JSON.stringify({
              phone: phone,
              otp: code
            })
          });
          const data = await res.json();

          if (btn) {
            btn.textContent = originalText;
            btn.disabled = false;
          }

          if (data.success) {
            if (otpCountdownTimer) clearInterval(otpCountdownTimer);
            document.getElementById('otp-step-2').classList.add('hidden');
            document.getElementById('otp-step-3').classList.remove('hidden');
            document.getElementById('otp-step-3').classList.add('flex');
          } else {
            msg2.textContent = data.message || 'Invalid OTP. Please try again.';
            msg2.classList.remove('hidden');
          }
        } catch (err) {
          if (btn) {
            btn.textContent = originalText;
            btn.disabled = false;
          }
          msg2.textContent = 'Verification error. Please try again.';
          msg2.classList.remove('hidden');
        }
      };
    })();
  </script>
<?php endif; ?>

<!-- FOOTER -->

<footer class="border-t border-slate-200 bg-slate-50">

  <!-- FOOTER CUSTOM LAYOUT -->
  <style>
    /* =========================================
       FOOTER DESKTOP LAYOUT
       ========================================= */

    .chedotech-footer-grid {
      display: grid;
      grid-template-columns:
        1.35fr 1.15fr 1.15fr 1fr 0.8fr 1.1fr;

      column-gap: 42px;
      row-gap: 32px;
      align-items: start;
    }

    /* Prevent long text from forcing columns wider */
    .chedotech-footer-grid>* {
      min-width: 0;
    }

    /* Footer links */
    .chedotech-footer-grid .footer-link {
      display: inline-flex;
      align-items: flex-start;
      gap: 7px;
    }

    /* Tablet */
    @media (max-width: 1023px) {
      .chedotech-footer-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        column-gap: 32px;
        row-gap: 36px;
      }
    }

    /* Mobile */
    @media (max-width: 639px) {
      .chedotech-footer-grid {
        grid-template-columns: 1fr;
        column-gap: 0;
        row-gap: 30px;
      }
    }
  </style>


  <!-- MAIN FOOTER -->
  <div class="mx-auto max-w-7xl px-5 pb-10 pt-12 sm:px-8 lg:pt-14">

    <!--
      DESKTOP:
      Brand | Programming | Development | Other | Contact | Explore

      TABLET:
      2 columns

      MOBILE:
      1 column
    -->

    <div class="chedotech-footer-grid">


      <!-- =========================================
           1. BRAND
           ========================================= -->
      <div>

        <a href="<?= cmsu('global.footer.44', '/index.php') ?>" class="site-brand group" aria-label="Chedo Tech — Home">
          <img
            src="/assets/logo-110.webp"
            alt="Chedo Tech Logo"
            width="40"
            height="40"
            loading="lazy"
            decoding="async"
            class="site-brand-logo h-10 w-10">
          <span class="site-brand-text">
            <span class="brand-chedo"><?= cms('global.footer.45', 'Chedo') ?></span>
            <span class="brand-tech"><?= cms('global.footer.46', 'Tech') ?></span>
          </span>
        </a>


        <p class="mt-3 text-sm font-medium text-slate-600">
          <?= cms('global.footer.47', 'Programming Institute & App Development') ?>
        </p>


        <p class="mt-2 max-w-xs text-sm leading-relaxed text-slate-600">
          <?= cms('global.footer.48', 'Offline, practical programming education since 2015 — from basics to building real projects.') ?>
        </p>


        <p class="mt-4 inline-flex items-center gap-2 rounded-full border border-slate-200 bg-white px-3 py-1.5 font-mono text-[11px] font-semibold tracking-wide text-slate-600">

          <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>

          <?= cms('global.footer.49', 'Offline · Practical · Project-Based') ?>

        </p>

      </div>


      <!-- =========================================
           2. PROGRAMMING
           ========================================= -->
      <nav aria-label="Programming courses">

        <h2 class="font-mono text-[11px] font-semibold uppercase tracking-widest text-slate-600">
          <?= cms('global.footer.50', 'Programming') ?>
        </h2>

        <ul class="mt-3 space-y-1">



          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.51', '/courses/c-programming.php') ?>">
              <?= cms('global.footer.52', 'C') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.53', '/courses/cpp-programming.php') ?>">
              <?= cms('global.footer.54', 'C++') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.55', '/courses/java-programming.php') ?>">
              <?= cms('global.footer.56', 'Java') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.57', '/courses/python-programming.php') ?>">
              <?= cms('global.footer.58', 'Python') ?>
            </a>
          </li>
          <li>
            <a
              class="footer-link text-orange-600"
              href="<?= cmsu('global.footer.59', '/courses/java-dsa.php') ?>">
              <?= cms('global.footer.60', 'Java + DSA') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link text-orange-600"
              href="<?= cmsu('global.footer.61', '/courses/python-dsa.php') ?>">
              <?= cms('global.footer.62', 'Python + DSA') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link text-orange-600"
              href="<?= cmsu('global.footer.63', '/courses/c-cpp-dsa.php') ?>">
              <?= cms('global.footer.64', '(C) + (C++) + (DSA)') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.65', '/courses/data-structures-algorithms.php') ?>">
              <?= cms('global.footer.66', 'Data Structures & Algorithms') ?>
            </a>
          </li>

        </ul>

      </nav>


      <!-- =========================================
           3. DEVELOPMENT
           ========================================= -->
      <nav aria-label="Development courses">

        <h2 class="font-mono text-[11px] font-semibold uppercase tracking-widest text-slate-600">
          <?= cms('global.footer.67', 'Development') ?>
        </h2>

        <ul class="mt-3 space-y-1">

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.68', '/courses/mern-full-stack.php') ?>">
              <?= cms('global.footer.69', 'MERN Full Stack') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.70', '/courses/java-full-stack.php') ?>">
              <?= cms('global.footer.71', 'Java Full Stack') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.72', '/courses/mobile-app-development.php') ?>">
              <?= cms('global.footer.73', 'Mobile App Development') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.74', '/courses/data-science.php') ?>">
              <?= cms('global.footer.75', 'Data Science') ?>
            </a>
          </li>

        </ul>

      </nav>


      <!-- =========================================
           4. OTHER
           ========================================= -->
      <nav aria-label="Other courses">

        <h2 class="font-mono text-[11px] font-semibold uppercase tracking-widest text-slate-600">
          <?= cms('global.footer.76', 'Other') ?>
        </h2>

        <ul class="mt-3 space-y-1">

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.77', '/courses/data-science-foundation.php') ?>">
              <?= cms('global.footer.78', 'Data Science Foundation') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.79', '/courses/ui-ux-design.php') ?>">
              <?= cms('global.footer.80', 'UI/UX Design') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.81', '/courses/kids-programming.php') ?>">
              <?= cms('global.footer.82', 'Kids Programming') ?>
            </a>
          </li>

        </ul>

      </nav>


      <!-- =========================================
           5. CONTACT
           ========================================= -->
      <nav aria-label="Contact">

        <h2 class="font-mono text-[11px] font-semibold uppercase tracking-widest text-slate-600">
          <?= cms('global.footer.83', 'Contact') ?>
        </h2>

        <ul class="mt-3 space-y-1.5">


          <!-- PHONE -->
          <li>

            <a
              class="footer-link"
              href="<?= cmsu('global.footer.84', '/contact.php') ?>">

              <svg
                aria-hidden="true"
                focusable="false"
                class="mt-0.5 h-4 w-4 shrink-0"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M13.832 16.568a1 1 0 0 0 1.213-.303l.355-.465A2 2 0 0 1 17 15h3a2 2 0 0 1 2 2v3a2 2 0 0 1-2 2A18 18 0 0 1 2 4a2 2 0 0 1 2-2h3a2 2 0 0 1 2 2v3a2 2 0 0 1-.8 1.6l-.468.351a1 1 0 0 0-.292 1.233 14 14 0 0 0 6.392 6.384" />
              </svg>

              <span data-phone>
                <?= cms('global.footer.85', '+91 87931 00815') ?>
              </span>

            </a>

          </li>


          <!-- WHATSAPP -->
          <li>

            <a
              class="footer-link"
              href="<?= cmsu('global.footer.86', '/contact.php') ?>">

              <svg
                aria-hidden="true"
                focusable="false"
                class="mt-0.5 h-4 w-4 shrink-0"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M2.992 16.342a2 2 0 0 1 .094 1.167l-1.065 3.29a1 1 0 0 0 1.236 1.168l3.413-.998a2 2 0 0 1 1.099.092 10 10 0 1 0-4.777-4.719" />
              </svg>

              <span>
                <?= cms('global.footer.87', 'WhatsApp Enquiry') ?>
              </span>

            </a>

          </li>


          <!-- ADDRESS -->
          <li>

            <a
              class="footer-link"
              href="<?= cmsu('global.footer.88', '/contact.php') ?>">

              <svg
                aria-hidden="true"
                focusable="false"
                class="mt-0.5 h-4 w-4 shrink-0"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                <circle cx="12" cy="10" r="3" />
              </svg>

              <span data-address>
                <?= cms('global.footer.89', 'Ultima Business Center, Pune') ?>
              </span>

            </a>

          </li>


          <!-- EMAIL -->
          <li>

            <a
              class="footer-link"
              href="<?= cmsu('global.footer.90', '/contact.php') ?>">

              <svg
                aria-hidden="true"
                focusable="false"
                class="mt-0.5 h-4 w-4 shrink-0"
                xmlns="http://www.w3.org/2000/svg"
                width="24"
                height="24"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">
                <path d="m22 7-8.991 5.727a2 2 0 0 1-2.009 0L2 7" />

                <rect
                  x="2"
                  y="4"
                  width="20"
                  height="16"
                  rx="2" />
              </svg>

              <span data-email>
                <?= cms('global.footer.91', 'chetan2469@gmail.com') ?>
              </span>

            </a>

          </li>

        </ul>

      </nav>


      <!-- =========================================
           6. EXPLORE
           ========================================= -->
      <nav aria-label="Explore">

        <h2 class="font-mono text-[11px] font-semibold uppercase tracking-widest text-slate-600">
          <?= cms('global.footer.92', 'Explore') ?>
        </h2>

        <ul class="mt-3 space-y-1">

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.93', '/index.php') ?>">
              <?= cms('global.footer.94', 'Home') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.95', '/courses.php') ?>">
              <?= cms('global.footer.96', 'Courses') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.97', '/about.php') ?>">
              <?= cms('global.footer.98', 'About') ?>
            </a>
          </li>

          <li>
            <a
              class="footer-link"
              href="<?= cmsu('global.footer.99', '/contact.php') ?>">
              <?= cms('global.footer.100', 'Contact') ?>
            </a>
          </li>

        </ul>

      </nav>


    </div>

  </div>


  <!-- =========================================
       COPYRIGHT BAR
       ========================================= -->
  <div class="border-t border-slate-200">

    <div
      class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-3 px-5 py-5 text-sm text-slate-600 sm:flex-row sm:px-8">

      <p>
        &copy;
        <span id="year"><?= cms('global.footer.101', '2026') ?></span>
        <?= cms('global.footer.102', 'Chedo Tech. All rights reserved.') ?>
      </p>

      <a
        class="font-medium text-slate-600 transition-colors hover:text-blue-700"
        href="<?= cmsu('global.footer.103', '/privacy-policy.php') ?>">
        <?= cms('global.footer.104', 'Privacy Policy') ?>
      </a>

    </div>

  </div>

</footer>


<!-- =========================================
     WHATSAPP FLOATING BUTTON
     ========================================= -->
<a
  id="wa-fab"
  data-wa
  href="<?= cmsu('global.footer.105', '/contact.php') ?>"
  aria-label="Chat with Chedo Tech on WhatsApp"
  class="fixed bottom-5 right-5 z-40 hidden h-12 w-12 items-center justify-center rounded-full bg-[#25D366] text-white shadow-[0_16px_32px_-12px_rgba(22,163,74,0.6)] transition-transform hover:scale-105">
  <svg viewBox="0 0 16 16" fill="currentColor" style="width:1.75rem;height:1.75rem" aria-hidden="true" focusable="false">
    <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232" />
  </svg>

</a>

</body>

</html>