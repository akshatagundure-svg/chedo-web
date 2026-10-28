<?php
$c = file_get_contents('assets/css/main.css');
preg_match_all('/.*(?:margin-left:\s*-|word-spacing).*/', $c, $matches);
print_r($matches[0]);
