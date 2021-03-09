<?php
function UpdateCharacter($code)
{
  if ($_COOKIE['cookiebar'] == "CookieAllowed") // User Has Accepted Cookie policy
  {
    if (isset($_POST["updateCharacterSubmit"]))
    {
      Require 'connection.php';

      $name = (filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING));
      $alignment = (filter_input(INPUT_POST, 'alignment', FILTER_SANITIZE_STRING));
      $race = (filter_input(INPUT_POST, 'race', FILTER_SANITIZE_STRING));
      $class = (filter_input(INPUT_POST, 'class', FILTER_SANITIZE_STRING));
      $exp = (filter_input(INPUT_POST, 'exp', FILTER_SANITIZE_STRING));
      $ac = (filter_input(INPUT_POST, 'ac', FILTER_SANITIZE_STRING));
      $maxHp = (filter_input(INPUT_POST, 'maxHp', FILTER_SANITIZE_STRING));
      $STR = (filter_input(INPUT_POST, 'strength', FILTER_SANITIZE_STRING));
      $DEX = (filter_input(INPUT_POST, 'dexterity', FILTER_SANITIZE_STRING));
      $CON = (filter_input(INPUT_POST, 'constitution', FILTER_SANITIZE_STRING));
      $INT = (filter_input(INPUT_POST, 'intelligence', FILTER_SANITIZE_STRING));
      $WIS = (filter_input(INPUT_POST, 'wisdom', FILTER_SANITIZE_STRING));
      $CHA = (filter_input(INPUT_POST, 'charisma', FILTER_SANITIZE_STRING));

      $armour = (filter_input(INPUT_POST, 'armour', FILTER_SANITIZE_STRING));
      $weapon = (filter_input(INPUT_POST, 'weapon', FILTER_SANITIZE_STRING));
      $equipmentNote = (filter_input(INPUT_POST, 'equipmentNote', FILTER_SANITIZE_STRING));

      $pp = (filter_input(INPUT_POST, 'pp', FILTER_SANITIZE_STRING));
      $gp = (filter_input(INPUT_POST, 'gp', FILTER_SANITIZE_STRING));
      $sp = (filter_input(INPUT_POST, 'sp', FILTER_SANITIZE_STRING));
      $cp = (filter_input(INPUT_POST, 'cp', FILTER_SANITIZE_STRING));
      $bagNote = (filter_input(INPUT_POST, 'bagNote', FILTER_SANITIZE_STRING));

      $known = (filter_input(INPUT_POST, 'known', FILTER_SANITIZE_STRING));
      $spellsNote = (filter_input(INPUT_POST, 'spellsNote', FILTER_SANITIZE_STRING));

      $savingThrows = "";
      $proficiencies = "";
      $languages = "";

      $notesNote = (filter_input(INPUT_POST, 'notesNote', FILTER_SANITIZE_STRING));

      // for each index in the savingThrows array create a single String
      for($i = 0; $i < sizeof($_POST['savingThrow']); $i++)
      {
        $savingThrows = $savingThrows." ".$_POST['savingThrow'][$i].",";
      }
      $savingThrows = rtrim($savingThrows, ','); // Remove the last comma added in the above foreach

      // for each index in the proficiency array create a single String
      for($i = 0; $i < sizeof($_POST['proficiency']); $i++)
      {
        $proficiencies = $proficiencies." ".$_POST['proficiency'][$i].",";
      }
      $proficiencies = rtrim($proficiencies, ','); // Remove the last comma added in the above foreach

      // for each index in the language array creata a single string
      for($i = 0; $i < sizeof($_POST['language']); $i++)
      {
        $languages = $languages." ".$_POST['language'][$i].",";
      }
      $languages = rtrim($languages, ','); // Remove the last comma added in the above foreach

      $lvl = ExpToLevel($exp);

      $Error = false;
      $NameError;
      $expError;
      $acError;
      $hpError;

      if(!preg_match("/^[a-zA-Z0-9\s]*$/", $name))//Name Must contain only letters & spaces
      {
        $Error = true;
        $NameError = ":Name Must Contain only letters and spaces";
      }
      if(!preg_match("/^[0-9]*$/", $exp))//Name Must contain only numbers
      {
        $Error = true;
        $expError = ":EXP must only be a number e.g. 24000";
      }
      if(!preg_match("/^[0-9]*$/", $ac))//Name Must contain only letters & spaces
      {
        $Error = true;
        $acError = ":AC must only be a number e.g. 15";
      }
      if(!preg_match("/^[0-9]*$/", $maxHp))//Name Must contain only letters & spaces
      {
        $Error = true;
        $hpError = ":HP must only be a number e.g. 42";
      }

    }

    if($Error == true) // An Error Has Occured
    {
      $errorString = $nameError.$expError.$acError.$hpError;
      header('Location: ../View/updateCharacter.php?error='.$errorString);
    }
    else // Continue with the character update
    {

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
        echo "notes updated";
      }
      else
      {
        echo "notes unchanged";
      }

      $stmtEquipment = $connection->prepare
      ("

      UPDATE Equipment SET Armour_ID = :armour, Weapon_ID = :weapon
      WHERE Equipment_ID = :code;

      ");

      // Runs and executes the query
      $successEquipment = $stmtEquipment->execute
      ([
        'armour' => $armour,
        'weapon' => $weapon,
        'code' => $code
      ]);

      if($successEquipment && $stmtEquipment->rowCount() > 0)
      {
        echo "equipment updated";
      }
      else
      {
        echo "equipment unchanged";
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

      $stmtSpells = $connection->prepare
      ("

      UPDATE Spellbook SET Known = :known
      WHERE Spellbook_ID = :code;

      ");

      // Runs and executes the query
      $successSpells = $stmtSpells->execute
      ([
        'known' => $known,
        'code' => $code
      ]);

      if($successSpells && $stmtSpells->rowCount() > 0)
      {
        echo "spells updated";
      }
      else
      {
        echo "spells unchanged";
      }

      $newLvl = ExpToLevel($exp);
      $stmtCharacter = $connection->prepare
      ("

      UPDATE Player_Character SET Name = :name, Alignment = :alignment, Exp = :exp, Level = :lvl, RaceName = :race, ClassName = :class, AC = :ac, Max_HP = :maxhp, Strength = :str, Dexterity = :dex, Constitution = :con, Intelligence = :int, Wisdom = :wis, Charisma = :cha, Saving_Throws = :savingThrows, Proficiencies = :proficiencies, Language = :languages
      WHERE Code = :code;

      ");

      // Runs and executes the query
      $successCharacter = $stmtCharacter->execute
      ([
        'name' => $name,
        'alignment' => $alignment,
        'exp' => $exp,
        'lvl' => $lvl,
        'race' => $race,
        'class' => $class,
        'ac' => $ac,
        'maxhp' => $maxHp,
        'str' => $STR,
        'dex' => $DEX,
        'con' => $CON,
        'int' => $INT,
        'wis' => $WIS,
        'cha' => $CHA,
        'savingThrows' => $savingThrows,
        'proficiencies' => $proficiencies,
        'languages' => $languages,
        'code' => $code
      ]);

      if($successCharacter && $stmtCharacter->rowCount() > 0)
      {
        echo "character updated";
      }
      else
      {
        echo "character unchanged";
      }
    }
    $connection = null;
  }
}
?>
