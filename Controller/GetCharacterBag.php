<?php
function GetCharacterBag($bag_id)
{
  if(isset($_POST['getCharacterByCode']))
  {
    require 'connection.php';

    $sql = "SELECT * FROM Bag WHERE Bag_ID = :bag_id";

    $stmt = $connection->prepare($sql);
    $success = $stmt->execute(['bag_id' => $bag_id]);

    if($success && $stmt->rowCount() > 0)
    {
      $bagItems = array();
      while($r = $stmt->fetch())
      {
        $bagItems[] = $r;
      }
      return json_encode($bagItems);
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
