<?php
function GetCharacterEquipment($equipment_id)
{
  if(isset($_POST['getCharacterByCode']))
  {
    require 'connection.php';

    $sql = "SELECT * FROM Equipment WHERE Equipment_ID = :equipment_id";

    $stmt = $connection->prepare($sql);
    $success = $stmt->execute(['equipment_id' => $equipment_id]);

    if($success && $stmt->rowCount() > 0)
    {
      $equipmentIDs = array();
      while($r = $stmt->fetch())
      {
        $equipmentIDs[] = $r;
      }
      return json_encode($equipmentIDs);
    }
    else
    {
      $error = "error"; // error finding equipment
      return $error; // error for Controller file
    }
    $connection = null;
  }
}
?>
