<?php

namespace Helper;

require_once(__DIR__ . "/memory.php");

use Helper\Memory;

class Benchmark
{
  private $iterations = 1;
  private $benchmarks = [];
  private $results = [];
  private $memory;

  public function __construct()
  {
    $this->memory = new Memory();
  }

  private function runBenchmark($benchmark)
  {
    $rawTimings = [];
    for ($i = 0; $i < $this->iterations; $i++) {
      $start = microtime(true);
      $benchmark['benchmark'](...$benchmark['params']);
      $end = microtime(true);
      $cpuTime = ($end - $start) * 1000000; //Convert seconds to microseconds
      $rawTimings[] = $cpuTime;
    }
    $memUsed = $this->memory->getMemoryUsage();
    $average = $this->calculateAverage($rawTimings);
    return ['memUsed' => $memUsed, 'rawTimings' => $rawTimings, 'average' => $average];
  }
  private function calculateAverage($timings)
  {
    return number_format(array_reduce($timings, function ($accumulator, $value) {
      return $accumulator + $value;
    }) / $this->iterations, 3);
  }

  public function setIter($iterations)
  {
    $this->iterations = $iterations;
    return $this;
  }
  public function add($name, $benchmark, ...$params)
  {
    $this->benchmarks[$name] = ['benchmark' => $benchmark, 'params' => $params];
    return $this;
  }
  public function run()
  {
    foreach ($this->benchmarks as $name => $benchmark) {
      printf("Running benchmark %s...\n", $name);
      $this->results[$name] = $this->runBenchmark($benchmark);
      printf("Direct Time Average: %sµs\n", $this->results[$name]['average']);
      printf(
        "Memory Usage: (rss: %sMB, heapTotal: %sMB, heapUsed: %sMB)\n",
        number_format($this->results[$name]['memUsed']['rss'] / (1024 * 1024), 6),
        number_format($this->results[$name]['memUsed']['heapTotal'] / (1024 * 1024), 6),
        number_format($this->results[$name]['memUsed']['heapUsed'] / (1024 * 1024), 6)
      );
    }
  }
  public function getJSON()
  {
    return json_encode($this->results);
  }
}
