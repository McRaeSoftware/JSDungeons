<?php
//Generate Unique Code for characters
function GenerateUniqueCode($userid)
{
  $day = dechex(date('d'));
  $month = dechex(date('m'));
  $year = dechex(date('y'));
  $hour = dechex(date('H'));
  $minute = dechex(date('i'));
  $second = dechex(date('s'));

  $code = $day.$month.$year.$hour.$minute.$second.$userid;

  return $code;
}
?>
