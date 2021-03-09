<?php
function GetPlayerCharacters($userid)
{
  require 'connection.php';

  $sql = "SELECT * FROM Player_Character WHERE User_ID = :userid";

  $stmt = $connection->prepare($sql);
  $success = $stmt->execute(['userid' => $userid]);

  if($success && $stmt->rowCount() > 0)
  {
    $playerCharacters = array();
    while($r = $stmt->fetch())
    {
      $playerCharacters[] = $r;
    }
    return json_encode($playerCharacters);
  }
  else
  {
    $error = "error"; // error finding a players characters
    return $error; // error for Controller file
  }
  $connection = null;
}
?>
