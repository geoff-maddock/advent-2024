<?php

# --- Day 3: Mull It Over ---

// read in input
echo 'reading input.txt'.PHP_EOL;
$data = file_get_contents('input.txt');

if (false === $data) {
    echo 'Failed to read input.txt'.PHP_EOL;
    exit(1);
}

// create an array of valid multiplication functions by parsing the input
$validMul = [];
$firstInt = [];
$secondInt = [];
$sum = 0;



// split the whole string by the segments that start with do()
echo "Segments".PHP_EOL;
$segments = preg_split('/(?=do\(\))|(?=don\'t\(\))/', $data);
foreach ($segments as $key => $segment) {

    // for each segment that does not start with don't() call getValidMul
    if (strpos($segment, "don't(") === false) {

        echo "[".$key."] ".$segment.PHP_EOL;
        $sum = $sum + getValidMul($segment);
    }


}

echo 'The sum of the valid multiplication functions is: '.$sum.PHP_EOL;


// get the sum of the valid multiplication functions from a string
function getValidMul($data) {

    // create a regex pattern that matches the valid multiplication functions
    // starts with mul( and ends with )
    // the first number is a positive integer between 0 and 999
    // the second number is a positive integer between 0 and 999

    $pattern = '/mul\((\d{1,3}),(\d{1,3})\)/';

    // use preg match all to get the valid matches in the data
    if (preg_match_all($pattern, $data, $matches)) {

        $validMul = $matches[0];
        $firstInt = $matches[1];
        $secondInt = $matches[2];
        
    }

    $sum = 0;

    // output each of the validMul elements on a new line
    foreach ($validMul as $key => $mul) {
        echo $mul;

        echo " ";
        echo $firstInt[$key];
        echo " x ";
        echo $secondInt[$key];

        $sum = $sum + $firstInt[$key] * $secondInt[$key];

        echo PHP_EOL;
    }

    return $sum;
}




