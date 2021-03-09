<?php
function GetCharacterArmour($armour_id)
{
  if(isset($_POST['getCharacterByCode']))
  {
    require 'connection.php';

    $search_Armour = "SELECT * FROM Armour WHERE Armour_ID = :armour_id";

    $armourStmt = $connection->prepare($search_Armour);
    $armourSuccess = $armourStmt->execute(['armour_id' => $armour_id]);

    if($armourSuccess && $armourStmt->rowCount() > 0)
    {
      $armourObject = array();
      while($result = $armourStmt->fetch())
      {
        $armourObject[] = $result;
      }
      return json_encode($armourObject);
    }
    else
    {
      $error = "error rty"; // error finding weapojn
      return $error; // error for Controller file
    }
    $connection = null;
  }
}
?>
