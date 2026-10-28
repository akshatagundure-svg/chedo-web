<?php
$c = file_get_contents('http://localhost:8000/contact.php');
assert(strpos($c, 'viewBox="0 0 1400 650"') !== false, 'viewBox missing');
assert(strpos($c, 'stroke="#1E232A"') !== false, 'stroke missing');
assert(strpos($c, 'stroke-width="48"') !== false, 'stroke-width missing');
assert(strpos($c, 'stroke-dasharray="10 10"') !== false, 'stroke-dasharray missing');
assert(strpos($c, 'main.min.css?v=20261028a') !== false, 'css version missing');
assert(strpos($c, 'main.min.js?v=20261028a') !== false, 'js version missing');
echo "Live contact.php verification passed 100%!\n";
