<?php
function fileread($path)
{
  $file = fopen($path, "r");
  $content = fread($file, filesize($path));
  fclose($file);
  return $content;
}
