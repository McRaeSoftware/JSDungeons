<?php
function LearnSpells($code, $known)
{
  if (isset($_POST["createCharacterSubmit"]))
  {
    Require 'connection.php';
    $query = $connection->prepare
    ("

    INSERT INTO SpellBook
    VALUES(:code, :known, :prepared)

    ");

    // Runs and executes the query
    $success = $query->execute
    ([
      'code' => $code,
      'known' => $known,
      'prepared' => "None"
    ]);
    $connection = NULL;
  }
}
?>
