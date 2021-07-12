<?php
require_once(__DIR__ . "/lib/benchmark.php");
// Functions
require_once(__DIR__ . "/functions/concat.php");
require_once(__DIR__ . "/functions/counter.php");
require_once(__DIR__ . "/functions/arrayfill.php");
require_once(__DIR__ . "/functions/mapfill.php");
require_once(__DIR__ . "/functions/jsondecode.php");
require_once(__DIR__ . "/functions/fileread.php");

use Helper\Benchmark;

// Get iterations
$options = [
  "iter::"
];
$opts = getopt("", $options);
$iterations = $opts['iter'];

// Guard against zero/negative iterations
if ((int)$iterations < 1) {
  $iterations = 100;
}

// Setup
$jsonPath = __DIR__ . "/data/demo.txt";
$fp = fopen($jsonPath, "r");
$jsonData = fread($fp, filesize($jsonPath));
fclose($fp);

// Benchmark
$benchmark = new Benchmark();
$benchmark
  ->setIter($iterations)
  ->add('Concatenate Strings', 'concat')
  ->add('Counter', 'counter')
  ->add('Array Fill', 'arrayfill')
  ->add('Map Fill (Associative Array)', 'mapfill')
  ->add('JSON Decode', 'jsondecode', $jsonData)
  ->add('File Read', 'fileread', __DIR__ . "/data/demo.txt")
  ->run();

// Write results to file
$resultsJSON = $benchmark->getJSON();
$results_file = fopen("/results/results-php-cli-${iterations}.json", "w");
fwrite($results_file, $resultsJSON);
fclose($results_file);
