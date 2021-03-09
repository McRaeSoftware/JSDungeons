<?php
// Gets spell by name from API
function GetSpellByName()
{
  if(isset($_POST['getSpellByName']))
  {
    $spellName = (filter_input(INPUT_POST, 'spellName', FILTER_SANITIZE_STRING)); // Sanitize the string
    $spellName = str_replace(' ', '-', $spellName); //Replace any whitespace with '-' symbols to work in the API
    $spellName = strtolower($spellName);

    if(!$spell = file_get_contents("https://api.open5e.com/spells/".$spellName))
    {
      $error = "error";
      return $error;
    }
    else
    {
      $spell = file_get_contents("https://api.open5e.com/spells/".$spellName); //Get a list of search results from the Open5E API
      return $spell;
    }
  }
}
?>
