<?php
function mapfill()
{
  $map = [];
  for ($i = 0; $i < 1000; $i++) {
    $map["word" . $i] = "Word\n";
  }
  return $map;
}
