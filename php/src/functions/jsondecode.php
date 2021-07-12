<?php
function jsondecode($json)
{
  return json_decode($json, true); // Convert to associative array, since that was the input type
}
