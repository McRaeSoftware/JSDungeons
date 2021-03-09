<?php
function GetCharacterNotes($code)
{
  if(isset($_POST['getCharacterByCode']))
  {
    require 'connection.php';

    $sql = "SELECT * FROM Notes WHERE Note_ID = :code";

    $stmt = $connection->prepare($sql);
    $success = $stmt->execute(['code' => $code]);

    if($success && $stmt->rowCount() > 0)
    {
      // convert to JSON
      $rows = array();
      while($r = $stmt->fetch())
      {
        $rows[] = $r;
      }
      return json_encode($rows);
    }
    else
    {
      $error = "error";
      return $error; // error get session character
    }
    $connection = null;
  }
}
?>
