<?php
function DeleteCharacterByCode($code)
{
  require 'connection.php';

  // Delete Notes
  $stmtNotes = $connection->prepare
  (
    "DELETE FROM Notes WHERE Note_ID = :code"
  );
  $success = $stmtNotes->execute
  ([
    'code' => $code
  ]);
  // Delete EQUIPMENT
  $stmtEquipment = $connection->prepare
  (
    "DELETE FROM Equipment WHERE Equipment_ID = :code"
  );
  $success = $stmtEquipment->execute
  ([
    'code' => $code
  ]);
  // Delete BAG
  $stmtBag = $connection->prepare
  (
    "DELETE FROM Bag WHERE Bag_ID = :code"
  );
  $success = $stmtBag->execute
  ([
    'code' => $code
  ]);
  // Delete Spells
  $stmtSpells = $connection->prepare
  (
    "DELETE FROM Spellbook WHERE Spellbook_ID = :code"
  );
  $success = $stmtSpells->execute
  ([
    'code' => $code
  ]);
  // Delete Character
  $stmtCharacter = $connection->prepare
  (
    "DELETE FROM Player_Character WHERE Code = :code"
  );
  $success = $stmtCharacter->execute
  ([
    'code' => $code
  ]);
}
?>
