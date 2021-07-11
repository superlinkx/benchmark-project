<?php
require_once(__DIR__ . "/lib/benchmark.php");
require_once(__DIR__ . "/functions/concat.php");
require_once(__DIR__ . "/functions/counter.php");
require_once(__DIR__ . "/functions/arrayfill.php");

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
  ->run();

$resultsJSON = $benchmark->getJSON();
$results_file = fopen("/results/results-php-${iterations}.json", "w");
fwrite($results_file, $resultsJSON);
fclose($results_file);
