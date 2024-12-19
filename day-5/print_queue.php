<?php

function parseInput($filename)
{
    $content = file_get_contents($filename);
    [$rulesSection, $updatesSection] = explode("\n\n", $content);

    $rules = array_map(function ($line) {
        return explode('|', trim($line));
    }, explode("\n", $rulesSection));

    $updates = array_map(function ($line) {
        return explode(',', trim($line));
    }, explode("\n", $updatesSection));

    return [$rules, $updates];
}

function isUpdateInOrder($update, $rules)
{
    $positions = array_flip($update);

    foreach ($rules as $rule) {
        [$x, $y] = $rule;
        if (isset($positions[$x]) && isset($positions[$y]) && $positions[$x] > $positions[$y]) {
            return false;
        }
    }

    return true;
}

function findMiddlePageNumber($update)
{
    $middleIndex = floor(count($update) / 2);

    return $update[$middleIndex];
}

function main()
{
    [$rules, $updates] = parseInput('input.txt');
    $sum = 0;

    foreach ($updates as $update) {
        if (isUpdateInOrder($update, $rules)) {
            $sum += findMiddlePageNumber($update);
        }
    }

    echo "The sum of the middle page numbers of the correctly-ordered updates is: $sum\n";
}

main();
