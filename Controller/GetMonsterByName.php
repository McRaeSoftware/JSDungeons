<?php
// Gets monster by name from API.
function GetMonsterByName()
{
  if(isset($_POST['getMonsterByName']))
  {
    $monsterName = (filter_input(INPUT_POST, 'monsterName', FILTER_SANITIZE_STRING)); // Sanitize the string
    $monsterName = str_replace(' ', '-', $monsterName); // Replace any whitespace with '-' symbols to work on a url
    $monsterName = strtolower($monsterName);

    if(!$monster = file_get_contents("https://api.open5e.com/monsters/".$monsterName))
    {
      $error = "error";
      return $error;
    }
    else
    {
      $monster = file_get_contents("https://api.open5e.com/monsters/".$monsterName); // Get a list of search results from the Open 5e API
      return $monster;
    }
  }
}
?>
