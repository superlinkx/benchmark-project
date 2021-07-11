<?php
require_once(__DIR__ . "/lib/benchmark.php");
// Functions
require_once(__DIR__ . "/functions/concat.php");
require_once(__DIR__ . "/functions/counter.php");
require_once(__DIR__ . "/functions/arrayfill.php");
require_once(__DIR__ . "/functions/mapfill.php");
require_once(__DIR__ . "/functions/fileread.php");

use Helper\Benchmark;

$options = [
  "iter::"
];
$opts = getopt("", $options);
$iterations = $opts['iter'];

if ((int)$iterations < 1) {
  $iterations = 100;
}

$benchmark = new Benchmark();

$benchmark
  ->setIter($iterations)
  ->add('Concatenate Strings', 'concat')
  ->add('Counter', 'counter')
  ->add('Array Fill', 'arrayfill')
  ->add('Map Fill (Associative Array)', 'mapfill')
  ->add('File Read', 'fileread')
  ->run();

$resultsJSON = $benchmark->getJSON();
$results_file = fopen("/results/results-php-${iterations}.json", "w");
fwrite($results_file, $resultsJSON);
fclose($results_file);
