<?php
function EquipItems($code, $armour, $weapon)
{
  if (isset($_POST["createCharacterSubmit"]))
  {
    Require 'connection.php';
    $query = $connection->prepare
    ("

    INSERT INTO Equipment
    VALUES(:code, :armour, :weapon)

    ");

    // Runs and executes the query
    $success = $query->execute
    ([
      'code' => $code,
      'armour' => $armour,
      'weapon' => $weapon
    ]);
    $connection = NULL;
  }
}
?>
