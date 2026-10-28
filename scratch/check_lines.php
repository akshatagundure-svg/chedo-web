<?php
$lines = file('includes/contact-main.php');
for ($i = 305; $i <= 315; $i++) {
    echo ($i + 1) . ': ' . json_encode($lines[$i]) . PHP_EOL;
}
