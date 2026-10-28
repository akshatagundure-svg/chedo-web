<?php
$html = file_get_contents('http://localhost:8000/contact.php');
assert(strpos($html, 'roadmap-stage-modal') !== false, 'Modal missing in contact.php');
assert(strpos($html, 'stage-modal-card') !== false, 'Modal card missing in contact.php');
assert(strpos($html, 'main.min.css?v=20261027d') !== false, 'CSS version mismatch');
assert(strpos($html, 'main.min.js?v=20261027e') !== false, 'JS version mismatch');
assert(strpos($html, 'roadmap-wrapper-card') !== false, 'roadmap-wrapper-card missing');
assert(strpos($html, 'roadmap-flow-container') !== false, 'roadmap-flow-container missing');
assert(strpos($html, 'highway-svg') !== false, 'highway-svg missing');
assert(strpos($html, 'road-path-surface') !== false, 'road-path-surface missing');
assert(strpos($html, 'road-path-dash') !== false, 'road-path-dash missing');
assert(strpos($html, 'roadmap-timeline') !== false, 'roadmap-timeline missing');
assert(strpos($html, 'roadmap-goal-wrap') !== false, 'roadmap-goal-wrap missing');
echo "All contact.php HTML, Modal, CSS, and JS assertions PASSED!\n";
