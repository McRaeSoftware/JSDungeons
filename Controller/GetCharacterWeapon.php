<?php
function GetCharacterWeapon($weapon_id)
{
  if(isset($_POST['getCharacterByCode']))
  {
    require 'connection.php';

    $search_Weapon = "SELECT * FROM Weapon WHERE Weapon_ID = :weapon_id";

    $weaponStmt = $connection->prepare($search_Weapon);
    $weaponSuccess = $weaponStmt->execute(['weapon_id' => $weapon_id]);

    if($weaponSuccess && $weaponStmt->rowCount() > 0)
    {
      $weaponObject = array();
      while($result = $weaponStmt->fetch())
      {
        $weaponObject[] = $result;
      }
      return json_encode($weaponObject);
    }
    else
    {
      $error = "error qwe"; // error finding armour
      return $error; // error for Controller file
    }
    $connection = null;
  }
}
?>
