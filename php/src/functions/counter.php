<?php
function counter() {
  $count = 0;
  for ($i = 0; $i < 10000; $i++) {
    $count++;
  }
  return $count;
}