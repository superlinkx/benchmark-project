<?php
require_once(__DIR__ . "/concat.php");
require_once(__DIR__ . "/helpers/benchmark.php");

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
  ->run();

$resultsJSON = $benchmark->getJSON();
$results_file = fopen("/results/results-php-${iterations}.json", "w");
fwrite($results_file, $resultsJSON);
fclose($results_file);
