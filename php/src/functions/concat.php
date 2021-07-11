<?php
function concat()
{
  $str = '';
  for ($i = 0; $i < 1000; $i++) {
    $str .= "Words\n";
  }
  return $str;
}
