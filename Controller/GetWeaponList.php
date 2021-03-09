<?php
function GetWeaponList()
{
  require 'connection.php';

  $sql = "SELECT Weapon_ID, Name FROM Weapon";

  $weaponStmt = $connection->prepare($sql);
  $weaponSuccess = $weaponStmt->execute();

  if($weaponSuccess && $weaponStmt->rowCount() > 0)
  {
    $weaponList = array();
    while($result = $weaponStmt->fetch())
    {
      $weaponList[] = $result;
    }
    return json_encode($weaponList);
  }
  else
  {
    $error = "error"; // error finding weapons
    return $error; // error for Controller file
  }
  $connection = null;
}
?>
