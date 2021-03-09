<?php
function SaveCharacter($code)
{
  if(isset($_POST['saveCharacterSubmit']))
  {
    require 'connection.php';

    $lvl = (filter_input(INPUT_POST, 'lvl', FILTER_SANITIZE_STRING));
    $exp = (filter_input(INPUT_POST, 'exp', FILTER_SANITIZE_STRING));
    $currentHP = (filter_input(INPUT_POST, 'currentHP', FILTER_SANITIZE_STRING));

    $equipmentNote = (filter_input(INPUT_POST, 'equipmentNote', FILTER_SANITIZE_STRING));

    $pp = (filter_input(INPUT_POST, 'pp', FILTER_SANITIZE_STRING));
    $gp = (filter_input(INPUT_POST, 'gp', FILTER_SANITIZE_STRING));
    $sp = (filter_input(INPUT_POST, 'sp', FILTER_SANITIZE_STRING));
    $cp = (filter_input(INPUT_POST, 'cp', FILTER_SANITIZE_STRING));

    $bagNote = (filter_input(INPUT_POST, 'bagNote', FILTER_SANITIZE_STRING));
    $spellsNote = (filter_input(INPUT_POST, 'spellsNote', FILTER_SANITIZE_STRING));
    $notesNote = (filter_input(INPUT_POST, 'notesNote', FILTER_SANITIZE_STRING));

    $newLvl = ExpToLevel($exp);

    $stmtNotes = $connection->prepare
    ("

    UPDATE Notes SET Equipment_Note = :equipmentNote, Bag_Note = :bagNote, Spell_Note = :spellsNote, Notes_Note = :notesNote
    WHERE Note_ID = :code;

    ");

    // Runs and executes the query
    $successNotes = $stmtNotes->execute
    ([
      'equipmentNote' => $equipmentNote,
      'bagNote' => $bagNote,
      'spellsNote' => $spellsNote,
      'notesNote' => $notesNote,
      'code' => $code
    ]);

    if($successNotes && $stmtNotes->rowCount() > 0)
    {
      echo "Notes changed";
    }
    else
    {
      echo "Notes unchanged";
    }

    $stmtEquipment = $connection->prepare
    ("

    UPDATE Bag SET Pp = :pp, Gp = :gp, Sp = :sp, Cp = :cp
    WHERE Bag_ID = :code;

    ");

    // Runs and executes the query
    $successEquipment = $stmtEquipment->execute
    ([
      'pp' => $pp,
      'gp' => $gp,
      'sp' => $sp,
      'cp' => $cp,
      'code' => $code
    ]);

    if($successEquipment && $stmtEquipment->rowCount() > 0)
    {
      echo "bag updated";
    }
    else
    {
      echo "bag unchanged";
    }

    $stmtCharacter = $connection->prepare
    ("

    UPDATE Player_Character SET Exp = :exp, Level = :newLvl,  HP = :currentHp
    WHERE Code = :code;

    ");

    // Runs and executes the query
    $successCharacter = $stmtCharacter->execute
    ([
      'exp' => $exp,
      'newLvl' => $newLvl,
      'currentHp' => $currentHP,
      'code' => $code
    ]);

    if($successCharacter && $stmtCharacter->rowCount() > 0)
    {
      if($newLvl > $lvl)
      {
        header('Location: ../View/updateCharacter.php?levelUp=true&characterID='.$code);
      }
      else
      {
        header('Location: ../View/playerCharacter.php?characterID='.$code);
      }
    }
    else
    {
      header('Location: ../View/playerCharacter.php?characterID='.$code);
    }
    $connection = null;
  }
}
?>
