<?php
// gets spell names from characters spellbook.
function GetCharacterSpells($spellbook_id)
{
  if(isset($_POST['getCharacterByCode']))
  {
    require 'connection.php';

    $sql = "SELECT * FROM Spellbook WHERE Spellbook_ID = :spellbook_id";

    $stmt = $connection->prepare($sql);
    $success = $stmt->execute(['spellbook_id' => $spellbook_id]);

    if($success && $stmt->rowCount() > 0)
    {
      $spellLists = array();
      while($r = $stmt->fetch())
      {
        $spellLists[] = $r;
      }
      return json_encode($spellLists);
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
