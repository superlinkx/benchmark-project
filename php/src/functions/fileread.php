<?php
function fileread()
{
  $demoFilePath = __DIR__ . "/../data/demo.txt";
  $demoFile = fopen($demoFilePath, "r");
  $content = fread($demoFile, filesize($demoFilePath));
  fclose($demoFile);
  return $content;
}
