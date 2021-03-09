<?php
function GiveMoney($code, $pp, $gp, $sp, $cp)
{
  if (isset($_POST["createCharacterSubmit"]))
  {
    Require 'connection.php';
    $query = $connection->prepare
    ("

    INSERT INTO Bag
    VALUES(:code, :pp, :gp, :sp, :cp)

    ");

    // Runs and executes the query
    $success = $query->execute
    ([
      'code' => $code,
      'pp' => $pp,
      'gp'=> $gp,
      'sp'=> $sp,
      'cp' => $cp
    ]);
    $connection = NULL;
  }
}
?>
