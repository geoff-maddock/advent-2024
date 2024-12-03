<?php

// day one puzzle
// read the input.txt file, and interate over each line, splitting the line into two integers

echo 'reading input.txt'.PHP_EOL;
$lines = file('input.txt');

if (false === $lines) {
    echo 'Failed to read input.txt'.PHP_EOL;
    exit(1);
}

$arrA = [];
$arrB = [];

// interate over each line, splitting the line into two integers
foreach ($lines as $line) {
    $numbers = explode('  ', $line);
    $a = (int) $numbers[0];
    $b = (int) $numbers[1];
    echo 'A: '.$a.' B: '.$b.PHP_EOL;
    $arrA[] = $a;
    $arrB[] = $b;
}

// order arrays from smallest to largest
sort($arrA);
sort($arrB);

// find the difference between the two arrays
$arrC = [];

for ($i = 0; $i < count($arrA); ++$i) {
    $arrC[] = abs($arrA[$i] - $arrB[$i]);
    // output each value in the arrays
    echo 'A: '.$arrA[$i].' B: '.$arrB[$i].' C: '.$arrC[$i].PHP_EOL;
}

// summarize the difference of all values in arrC
$sum = array_sum($arrC);

echo 'The sum of the differences between the two arrays is: '.$sum.PHP_EOL;

$arrD = [];

// count the number of times each number in arrA appears in arrB
for ($i = 0; $i < count($arrA); ++$i) {
    $count = 0;
    for ($j = 0; $j < count($arrB); ++$j) {
        if ($arrA[$i] === $arrB[$j]) {
            ++$count;
        }
    }
    $arrD[$i] = $count * $arrA[$i];
    echo 'The number '.$arrA[$i].' appears '.$count.' times in arrB'.PHP_EOL;
}

// summarize the number of times each number in arrA appears in arrB
$sum = array_sum($arrD);

echo 'The total similarity score is: '.$sum.PHP_EOL;
