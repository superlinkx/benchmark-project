<?php

namespace Helper;

class Memory
{
  private function getRSS()
  {
    return getrusage()['ru_maxrss'] * 1024; //RSS is in KB
  }
  private function getHeapTotal()
  {
    return memory_get_usage(true);
  }
  private function getHeapUsed()
  {
    return memory_get_usage();
  }
  public function getMemoryUsage()
  {
    return [
      'rss' => $this->getRSS(),
      'heapTotal' => $this->getHeapTotal(),
      'heapUsed' => $this->getHeapUsed(),
    ];
  }
}
