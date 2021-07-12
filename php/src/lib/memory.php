<?php

namespace Helper;

class Memory
{
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
      'heapTotal' => $this->getHeapTotal(),
      'heapUsed' => $this->getHeapUsed(),
    ];
  }
}
