<?php
function GetArmourList()
{
  require 'connection.php';

  $sql = "SELECT Armour_ID, Name FROM Armour";

  $armourStmt = $connection->prepare($sql);
  $weaponSuccess = $armourStmt->execute();

  if($weaponSuccess && $armourStmt->rowCount() > 0)
  {
    $armourList = array();
    while($result = $armourStmt->fetch())
    {
      $armourList[] = $result;
    }
    return json_encode($armourList);
  }
  else
  {
    $error = "error"; // error finding weapons
    return $error; // error for Controller file
  }
  $connection = null;
}
?>
