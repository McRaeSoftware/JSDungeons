<?php
// Gets all monsters from the API.
function GetAllMonsters()
{
  $monsters = file_get_contents("https://api.open5e.com/monsters/"); //Get a list of search results from the API
  return $monsters; //Return the results
}
?>
