<?php
// gets all spells from API
function GetAllSpells()
{
  $spells = file_get_contents("https://api.open5e.com/spells/"); //Get a list of search results from the API
  return $spells; //Return the results
}
?>
