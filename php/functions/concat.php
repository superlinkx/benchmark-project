<?php
function concat()
{
  $str = '';
  for ($i = 0; $i < 1000; $i++) {
    $str .= "Hello World\n";
  }
  return $str;
}
