<?php
function TakeNotes($code, $equipmentNote, $bagNote, $spellsNote, $notesNote)
{
  if (isset($_POST["createCharacterSubmit"]))
  {
    Require 'connection.php';
    $query = $connection->prepare
    ("

    INSERT INTO Notes
    VALUES(:code, :equipmentNotes, :bagNotes, :spellNotes, :notesNote)

    ");

    // Runs and executes the query
    $success = $query->execute
    ([
      'code' => $code,
      'equipmentNotes' => $equipmentNote,
      'bagNotes'=> $bagNote,
      'spellNotes'=> $spellsNote,
      'notesNote' => $notesNote
    ]);
    $connection = NULL;
  }
}
?>
