<?php
function ExpToLevel($exp)
{
  if($exp < 300)
  {
    $lvl = 1;
  }
  else if ($exp < 900)
  {
    $lvl = 2;
  }
  else if ($exp < 2700)
  {
    $lvl = 3;
  }
  else if ($exp < 6500)
  {
    $lvl = 4;
  }
  else if ($exp < 14000)
  {
    $lvl = 5;
  }
  else if ($exp < 23000)
  {
    $lvl = 6;
  }
  else if ($exp < 34000)
  {
    $lvl = 7;
  }
  else if ($exp < 48000)
  {
    $lvl = 8;
  }
  else if ($exp < 64000)
  {
    $lvl = 9;
  }
  else if ($exp < 85000)
  {
    $lvl = 10;
  }
  else if ($exp < 100000)
  {
    $lvl = 11;
  }
  else if ($exp < 120000)
  {
    $lvl = 12;
  }
  else if ($exp < 140000)
  {
    $lvl = 13;
  }
  else if ($exp < 165000)
  {
    $lvl = 14;
  }
  else if ($exp < 195000)
  {
    $lvl = 15;
  }
  else if ($exp < 225000)
  {
    $lvl = 16;
  }
  else if ($exp < 265000)
  {
    $lvl = 17;
  }
  else if ($exp < 305000)
  {
    $lvl = 18;
  }
  else if ($exp < 355000)
  {
    $lvl = 19;
  }
  else if ($exp >= 355000)
  {
    $lvl = 20;
  }
  return $lvl;
}

?>
