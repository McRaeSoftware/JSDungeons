<?php
// Removes an object / index from an array of objects.
function RemoveObject($array)
{
  $i = (filter_input(INPUT_POST, 'index', FILTER_SANITIZE_STRING));

  array_splice($array, $i, 1);

  return $array;
}
?>
