<?php

// read the input.txt file
// each line is a report
// each value is a level

// reports are judged as safe or unsafe

// to be safe, a report must have the following properties:
// The levels are either all increasing or all decreasing.
// Any two adjacent levels differ by at least one and at most three.

echo 'reading input.txt'.PHP_EOL;
$lines = file('input.txt');

if (false === $lines) {
    echo 'Failed to read input.txt'.PHP_EOL;
    exit(1);
}

$reports = [];
$safe = 0;

$unsafe = [];

foreach ($lines as $line) {
    $levels = explode(' ', $line);
    if (isSafe($levels)) {
        ++$safe;
    } else {
        $unsafe[] = $levels;
    }
    echo 'Report: '.implode(' ', $levels).' is '.(isSafe($levels) ? 'safe' : 'unsafe').PHP_EOL;
}

echo 'The number of safe reports is: '.$safe.PHP_EOL;

$unsafeFixed = checkSafety($unsafe);

echo 'The number of unsafe reports that could be fixed is: '.$unsafeFixed.PHP_EOL;

// create a function that runs through each unsafe report, and determines if it could be come safe by removing any one value

function checkSafety($unsafe)
{
    $safe = 0;
    $unsafeCount = count($unsafe);
    for ($i = 0; $i < $unsafeCount; ++$i) {
        $levels = $unsafe[$i];
        $levelsCount = count($levels);
        for ($j = 0; $j < $levelsCount; ++$j) {
            $test = $levels;
            unset($test[$j]);
            if (isSafe($test)) {
                ++$safe;
                break;
            }
        }
    }

    return $safe;
}

function isSafe($levels)
{
    $safe = false;
    $increasing = false;
    $decreasing = false;
    $diff = 0;
    $prev = 0;
    $tolerance = 0;
    foreach ($levels as $level) {
        if (0 === $prev) {
            $prev = $level;
            continue;
        }

        if ($level > $prev) {
            $increasing = true;
        } elseif ($level < $prev) {
            $decreasing = true;
        }

        $diff = abs($level - $prev);
        if ($diff < 1 || $diff > 3) {
            return false;
        }
        $prev = $level;
    }
    if ($increasing && $decreasing) {
        return false;
    }

    return true;
}
