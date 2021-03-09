<?php
// Gets spell information from api
function GetKnownSpells($spellList)
{
  $spellList = strtolower($spellList);
  $spellList = str_replace(', ', '%2C', $spellList);
  $spellList = str_replace(' ', '-', $spellList);

  if(!$spellsKnown = file_get_contents("https://api.open5e.com/spells/?slug_iexact&slug__in=".$spellList))
  {
    $error = "error";
    return $error;
  }
  else
  {
    $spellsKnown = file_get_contents("https://api.open5e.com/spells/?slug_iexact&slug__in=".$spellList); //Get a list of search results from the Open5E API
    return $spellsKnown;
  }
}
?>
