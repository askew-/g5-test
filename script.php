<?php

use App\LuckyTicket;

include __DIR__ . '/src/LuckyTicket.php';

if (PHP_SAPI === 'cli') {
    [,$first, $end] = $argv;
} else {
    $first = $_GET['start'];
    $end = $_GET['end'];
}

$lucky = new LuckyTicket($first, $end);
echo $lucky->calculate();
